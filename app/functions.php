<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
* Unpacking the array to make it look good
*/
function print_arr($arr)
{
	// Print an array in a nice format
	echo '<pre>'; print_r($arr); echo "</pre>";
}



/**
 * Checking an array for existence for foreach
 */
function arrExist($data = false)
{
	// The cycle requires a check
	return (is_array($data) AND !empty($data)) ? true : false;
}



/**
* Clean up text
*/
function viewStr($value = false)
{
	// Clean up the text that will be displayed on the site from the database
	return ($value) ? stripslashes($value) : false;
}



/**
* Clean up text for input value
*/
function viewValue($value = false)
{
	// Clean up the text that will be displayed on the site from the database
	return ($value) ? htmlspecialchars(stripslashes($value)) : false;
}



/**
* View image or a blank image
*/
function viewImg($img = false, $path = 'img')
{
	// Display an image with the correct path or give a path to an empty image
	return ($img) ? setPath($path).$img : setPath('img').NO_IMG;
}



/**
* Clean up text for img alt
*/
function viewImgAlt($value = false)
{
	// Clean up the text that will be displayed on the site from the database
	return ($value) ? htmlspecialchars(stripslashes($value)) : false;
}



/**
 * Clear cache and refresh on load
 */
function addTmpView($tmpNum = 'none')
{
	// Sometimes the cache remembers css and js files, so we knock them down
	return ($tmpNum !== 'none') ? '?v='.$tmpNum : '?v='.time();
}



/**
* We clean up the data as much as possible
*/
function clean($data)
{
	// https://www.php.net/manual/en/function.htmlspecialchars
	// https://www.php.net/manual/en/function.strip-tags
	// https://www.php.net/manual/en/function.addslashes
	// https://www.php.net/manual/en/function.trim
	return htmlspecialchars(strip_tags(addslashes(trim($data))));
}



/**
 * Помічник для sql добавляємо скобки
 */
function sqlPlus($val = '')
{
	return '"'.clean($val).'"';
}




/**
 * The file output function
 */
function setPath($filePathKey = false)
{
	// In order to avoid the trouble of paths, we will take them from the global array $filePath
	return ($filePathKey) ? PATH.$GLOBALS['filePath'][$filePathKey] : PATH.$GLOBALS['filePath']['img'];
}



/**
 * Making the element active
 */
function isActive($valOne = false, $valTwo = false, $returnStr = 'active', $defaultActive = false)
{
	// Make an element active (for example, an active category)
	$result = ($valOne == $valTwo) ? $returnStr : false;

	// Checking whether to return the default value
	return (!$valTwo and $defaultActive) ? $returnStr : $result; 
}



/**
 * View format date
 */
function viewDate($time = false, $format = 'd.m.Y H:i:s')
{
	// https://www.php.net/manual/ru/function.date.php
	return ($time) ? date($format, $time) : false;
}



/**
 * Get the page number
 */
function getPageNum()
{
	return isset($_GET['page']) ? (int) clean($_GET['page']) : 1;
}



/**
 * View name and surname
 */
function viewFullName($name = false, $surname = false)
{
	return trim($name.' '.$surname);
}



/**
 * Making text from an array without duplicate values
 */
function arrayToString($arr = [], $glue = "\n\r")
{
	return (arrExist($arr)) ? implode($glue, array_filter($arr)) : false;
}



/**
 * Create a token
 */
function generateToken()
{
	return base64_encode(random_bytes(16));
}


/**
 * Tooltip ale
 */
function setUserTooltip($user = false, $placement = 'bottom')
{
	return ($user) ? '' : 'data-bs-toggle="tooltip" data-bs-title="Registration required" data-bs-placement="'.$placement.'"';
}



/**
 * Return number for LIMIT OFFSET
 */
function setOffset($perPage = PER_PAGE)
{
	// Get page number from GET
	$page = getPageNum();

	// Return text part for sql with offset number
	return ($page > 1) ? ' LIMIT '.$perPage.' OFFSET '.($page - 1) * $perPage : ' LIMIT '.$perPage;
}



/**
 * Often you need to redirect to the main profile page
 */
function gotToProfile()
{
	return $GLOBALS['url']['user'];
}



/**
 * A good number output will eventually need to be prefixed with a number (thousand, million...).
 */
function prettyNum($num)
{
	return number_format($num, 0, '', ' ');
}




/**
 * Check if the user is registered
 */
function isUserRegistered($user = false, $text = 'Only registered users have access to this section', $json = false)
{
	if(!arrExist($user)) {
		if ($json)
			exit(jsonAlert($text, PATH));

		setAlert($text, 'error', PATH);
	}
}




/**
 * Check if the user is registered and administrator
 */
function isAdministrator($user = false, $text = 'Only site administrators can access this page', $json = false)
{
	if(!arrExist($user) || $user['type'] !== 'admin') {
		if ($json)
			exit(jsonAlert($text, PATH));

		setAlert($text, 'error', PATH);
	}
}




/**
 * Check if the user is logined
 */
function isUserLogined($user = false, $text = 'You have already logined the site.', $json = false)
{
	if(arrExist($user)) {
		if ($json)
			exit(jsonAlert($text, 'error', gotToProfile()));

		setAlert($text, 'error', gotToProfile());
	}
}



/**
 * For a sql query, you need to combine an array with a key
 */
function implodeSqlWhere($value = false, $prefix = '')
{
	if (!is_array($value)) return;

	// We will collect the updated values in this array
	$where = [];

	// We go through the values, add the prefix, and create the required record format
	foreach ($value as $key => $val) {
		if ($val)
			$where[] = $prefix .'.'. $key . '=' . sqlPlus($val);
	}

	// Use implode to separate several values with the addition of AND
	return implode(' AND ', $where);
}



/**
 * Convert size name to megabytes
 */
function formatBytes($size, $precision = 2)
{
	$base     = log($size, 1024);
	$suffixes = ['', 'k', 'm'];
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}




/**
 * Look for patterns in the text
 */
function getTextPatterns($string = '')
{
	// Create an array of values that are in the text
	preg_match_all('/\$\{(.*?)\}/', $string, $regexResult);

	// Clearing the array and returning it
	return array_unique(array_pop($regexResult));
}




/**
* View link to href
*/
function setLink($link = false, $page = false)
{
	// If this is a link to some system partition
	if ($link && $page === false) {
		return $GLOBALS['url'][$link];
	
	// If this is a reference to a parameter in the
	} else {
		return ($link) ? $GLOBALS['url'][$page].$link : '#';
	}
}




/**
 * For the profile avatar, we will not make a separate record in the database, we will change it via php
 */
function setImgSm($avatar = false)
{
	// Base check
	if(!$avatar) return;

	// Break the name into parts
	$avatar = explode('.', $avatar);

	// До назви добавляємо sm
	return $avatar[0].'-sm.'.$avatar[1];
}




/**
 * We make a link from the title
 */
function generateLink($title)
{
	// Convert title to lowercase and replace spaces with hyphens
	$title = strtolower(str_replace(' ', '-', $title));

	// Remove any characters that are not letters, numbers, hyphens, or underscores
	$title = preg_replace('/[^a-zA-Z0-9-_]/', '', $title);

	// Trim any hyphens or underscores from the beginning and end of the title
	$title = trim($title, '-_');

	// Return the resulting link
	return $title;
}




/**
 * Redirect to the page
 */
function redirect($path = false)
{
	// Page to which you want to redirect
	if($path)
		$redirect = $path;

	// If the page is not passed, take the parameter from  
	if (!$redirect)
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;

	// Take user to the right page
	header('Location: '.$redirect);

	// No need to execute the code further
	exit();
}




/**
 * Set $_SESSION['answer'] for js
 */
function setAlert($value = false, $type = 'success', $redirect = false)
{
	// Check if the message was transmitted
	if (!$value) return;

	// Generate session data that will be passed to the footer 
	$data['type']  = $type;
	$data['value'] = $value;

	// Encode data for transfer to js
	$_SESSION['answer'] = json_encode($data);

	// In the standard behaviour of the form, we pass the html from the handler back to the form
	if($redirect) {

		// We expect in $redirect true but we can pass a link instead of true
		redirect(is_bool($redirect) ? false : $redirect);
	}
}



/**
 * Set alert for ajax response
 */
function jsonAlert($value = false, $type = 'error', $redirect = false, $callback = false, $callbackArray = [])
{
	// Check if the message was transmitted
	if (!$value) return;

	// Generate main data
	$data['type']  = $type;
	$data['value'] = (arrExist($value)) ? arrayToString($value) : $value;

	// If you need to send the user somewhere, create a link
	if($redirect) $data['link'] = $redirect;

	// We are sending a message that an additional function needs to be performed
	if($callback) $data['callFunc'] = $callback;

	// We are sending a message that an additional function needs to be performed
	if(arrExist($callbackArray)) $data['callFuncData'] = $callbackArray;

	// Encode data for ajax response
	exit( json_encode($data) );
}



/**
 * View pagination html
 */
function viewPagination($countRecords = false, $perPage = PER_PAGE)
{
	// Base check
	if (!isset($countRecords)) return;

	// Current page number
	$currentPage = getPageNum();

	// Make url from server url
	$url = ($_SERVER['REQUEST_URI'] === '/') ? 'https://'.DOMAIN.'/'.substr($_SERVER['REQUEST_URI'], 1) .'?page=' : 'https://'.DOMAIN.'/'.substr($_SERVER['REQUEST_URI'], 1) .'&page=';

	// Calculate the start and end links based on the current page and number of links to display
	$end = ceil($countRecords / $perPage);

	// If the number of pages is greater than zero, then we output html
	if ($end > 1) {

		// Html pagination start
		echo '<nav aria-label="pagination articles"><ul class="pagination justify-content-center">';

		// Display the numbered links
		for ($i = 1; $i <= $end; $i++) {
			if ($i == $currentPage)
				echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
			else
				echo "<li class='page-item'><a class='page-link' href='$url$i'>$i</a></li>";
		}
	}

	// Html pagination end
	echo '</ul></nav>';
}





/**
 * View html breadcrumb
 */
function viewBreadcrumb($breadcrumb = [])
{
	if (!arrExist($breadcrumb)) return;

	echo '<nav class="breadcrumb-hold"><ol class="breadcrumb">';

		// Home page
		echo '<li class="breadcrumb-item"><a href="'.PATH.'" class="breadcrumb-link animate">Home</a></li>';

		// Else pages
		foreach ($breadcrumb as $data)
			echo '<li class="breadcrumb-item"><a href="'.$data['link'].'" class="breadcrumb-link animate">'.$data['value'].'</a></li>';

	echo '</ol></nav>';
}



/**
 * Encode the password
 */
function encodePassword($password = false)
{
	// Generate a random token
	$result['token'] = generateToken();

	// Hash the password with the token
	$hash = password_hash($password . $result['token'], PASSWORD_DEFAULT);

	// Return the encoded password and token as a string
	$result['value'] = $hash . ':' . $result['token'];

	// Return result array
	return $result;
}

/**
 * To log in, check the password for correctness
 */
function verifyPassword($password = false, $encodedPassword = false, $emailPassword = false)
{
	// Split the encoded password and token
	list($hash, $token) = explode(':', $encodedPassword, 2);

	// Check the temporary password
	$emailPassword = ($emailPassword and $password === $emailPassword) ? true : false;

	// Verify the password by hashing it with the stored token and comparing the hashes
	$password = password_verify($password . $token, $hash);

	// The variables will be true / false, so we can check them together
	return ($password || $emailPassword) ? true : false;
}


/**
 * Hang up and receive data for user augmentation
 */
function authData($type = 'get', $id = false, $token = false)
{
	// Key for $_COOKIE
	$setKeyId    = 'userId';
	$setKeyToken = 'userToken';

	// Regarding the type, we perform the following functionality
	switch ($type) {
		case 'delete':
			// To delete, you need to specify a date in the past
			setcookie($setKeyId, '', strtotime('-1 day'), '/', DOMAIN);
			setcookie($setKeyToken, '', strtotime('-1 day'), '/', DOMAIN);

			// Take you to the main page
			redirect(PATH);
			break;

		case 'get':
			// Check if there is an authorisation tag.
			// We do not do serious checks, if the date of the tag passes, it will be deleted by itself.
			$userId    = clean($_COOKIE[$setKeyId]);
			$userToken = clean($_COOKIE[$setKeyToken]);

			// If there is no label at all, then end the code execution
			if (!$userId || !$userToken) return false;

			// Where for sql
			$where['id']    = $userId;
			$where['token'] = $userToken;

			// Trying to extract the user
			$user = getUser($where);

			// I decided not to enter the small avatar into the database, so here we form its value
			$user['avatar_sm'] = setImgSm($user['avatar']);

			// Returning user array or false
			return (arrExist($user)) ? $user : false;
			break;

		case 'set':
		default:
			// Create an authorization tag
			if ($id and $token) {
				setcookie($setKeyId, $id, strtotime('+5 days'), '/', DOMAIN);
				setcookie($setKeyToken, $token, strtotime('+5 days'), '/', DOMAIN);
			}
			return true;
	}
}




/**
 * Send a letter using the mail function
 */
function goMail($sendToEmail = false, $subject = false, $message = false, $name = false, $from = false)
{
	// Base cehck
	if (!$sendToEmail) return;

	// From which email to send
	if (!$from) $from = 'noreply@'.DOMAIN;

	// Project name or user name
	if (!$name) $name = DOMAIN;

	// Create headers for sending
	$headers  = 'From: '. viewStr($name) . ' <'. $from .'>';
	$headers .= 'Content-type: text/html;charset=utf-8;';
	$headers .= 'X-Mailer: PHP/' . phpversion();

	// Sending a letter
	return mail($sendToEmail, $subject, viewStr($message), $headers);
}




/**
 * Extract the entire html of the template
 */
function getEmailTemplate($emailTemplate = false, $params = false)
{
	// Base check
	if(!$emailTemplate) return;

	// Extract the html template
	$emailTemplateHtml = file_get_contents('app/view/email-templates/'.$emailTemplate);

	// Replace the template text with the value
	if ($emailTemplateHtml and arrExist($params))
		$emailTemplateHtml = setTextTemplate($emailTemplateHtml, $params);

	// Return email template with inserted values in the text
	return ($emailTemplateHtml) ? $emailTemplateHtml : '';
}




/**
 * Sending an html email with substituted parameters to the mail
 */
function sendEmail($email = false, $emailParams = [], $subject = 'Letter from the site '.DOMAIN)
{
	// Base check
	if (!$email || !arrExist($emailParams)) return;

	// Добавляємо параметри
	$emailParams['projectLink'] = PATH;
	$emailParams['projectName'] = DOMAIN;

	// Settings for email
	$message = getEmailTemplate($emailParams['emailTemplate'], $emailParams);

	// Let's see if there are any other values left unchanged
	$textPatterns = getTextPatterns($message);

	// If there are any text templates without values, an error is generated
	if (arrExist($textPatterns))
		jsonAlert('We can\'t send the letter. There are no values in the email template: '.implode(', ', $textPatterns));

	// Sending a letter
	return goMail($email, $subject, $message);
}




/**
 * Replace text using a template
 */
function setTextTemplate($string = false, $params = false)
{
	// General check for existence
	if (strlen($string) === 0) return;

	// Look for patterns in the text
	$regexResult = getTextPatterns($string);

	// Check if you need to show the parameters
	if ($params['showParams'])
		exit( print_arr($regexResult) );
		// exit( jsonAlert($regexResult) );

	// If the array is created, then we go through
	if (arrExist($regexResult)) {
		foreach ($regexResult as $key) {

			// Writing a new meaning
			if ($params[$key])
				$string = str_replace('${' . $key . '}', $params[$key], $string);
		}
	}

	// Return the new string
	return $string;
}




/**
 * Generate an activation link
 */
function getLinkActivation($email = false, $ulrKey = 'user-email-active')
{
	// Base check
	if(!$email) return;

	// Add email for php function
	$result['email'] = $email;

	// Generate a random token
	$result['token'] = generateToken();

	// Set other link params
	$result['link'] = $GLOBALS['url'][$ulrKey].'&'.http_build_query($result);

	// Return result array
	return $result;
}



/**
 * Generate a new password
 */
function getTmpPassword($number = 6) 
{
	// Base check
	if (!is_numeric($number))
		$number = 6;

	// Array of characters from which we will generate a password
	$arr = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0','.',',','(',')','[',']','!','?','&','%','*','{','}'];

	// Save the generated password here
	$pass = '';

	// Generate password
	for($i = 0; $i < $number; $i++) {
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
	}

	// Return generated password
	return $pass;
}



/**
 * Display information about the image for the social network
 */
function setSocialImg($imgWithPath = false)
{
	// Base check
	if (!$imgWithPath) return;

	// If image exist make array
	if (file_exists($imgWithPath)) {

		// Get info about image
		$imageSize = getimagesize($imgWithPath);

		// Infomation to write to the head
		$returnImage = [
			'name'        => $imgName,
			'imgWithPath' => PATH.$imgWithPath,
			'width'       => $imageSize[0],
			'height'      => $imageSize[1],
			'mime'        => $imageSize['mime']
		];

		// Return array with information
		return $returnImage;
	}
}



/**
 * Word declension (hour, hours, hours)
 */
function declensionWord($number = false, $word  = false, $viewWithNum = true)
{
	if (!$word) return;
	$ar     = [2, 0, 1, 1, 1, 2];
	$index  = ($number%100 > 4 && $number%100 < 20) ? 2 : $ar[min($number%10, 5)];
	return $number.' '.$word[$index];
}



/**
 * Display the number of days between a given date and the current date
 */
function timeAgo($date)
{
	// Check if $date is valid
	if (!is_numeric($date) && !is_string($date)) return;

	// Convert $date to a timestamp if it's a string
	if (!is_numeric($date) && is_string($date))
		$date = strtotime($date);

	// Get today's date
	$now = time();
	
	// Get the time difference
	$diff = $now - $date;

	// Define periods in seconds
	$minute = 60;
	$hour   = 60 * $minute;
	$day    = 24 * $hour;
	$month  = 30 * $day;
	$year   = 12 * $month;

	// Calculate the number of years, months, and days
	$years  = floor($diff / $year);
	$months = floor(($diff - $years * $year) / $month);
	$days   = floor(($diff - $years * $year - $months * $month) / $day);

	// Create the response
	if ($years > 0) {
		return declensionWord($years, ['year ago', 'years ago', 'years ago']);
	} elseif ($months > 0) {
		return declensionWord($months, ['month ago', 'months ago', 'months ago']);
	} elseif ($days > 0) {
		return declensionWord($days, ['day ago', 'days ago', 'days ago']);
	} else {
		return 'Today';
	}
}



/**
 * Recursively scans a directory and returns an array of files and subdirectories.
 */
function scanDirectory($directory, $skip = [])
{
	// Remove any trailing directory separator from the directory path
	$directory = rtrim($directory, DIRECTORY_SEPARATOR);

	// Initialize an empty array to hold the results
	$results = [];

	// Loop through each file and subdirectory in the directory
	foreach (glob($directory . DIRECTORY_SEPARATOR . '*') as $file) {

		// Skip any files or subdirectories in the skip array
		if (in_array(basename($file), $skip)) {
			continue;
		}

		// If the file is a directory, recursively call the scanDirectory function
		if (is_dir($file)) {
			$results[basename($file)] = scanDirectory($file, $skip);
		} 
		// If the file is not a directory, add it to the results array
		else {
			$results[] = basename($file);
		}
	}

	// Return the array of files and subdirectories
	return $results;
}



/**
 * Delete images
 */
function deleteImages($images = [])
{
	// Checking for existence
	if (!arrExist($images)) return;

	// Go through the array and delete pictures
	foreach($images as $image) {
		if(file_exists($image))
			unlink($image);
	}
}



/**
 * User's activity when viewing an article using a cookie
 */
function setUserActivity($articleID = false, $maxArticles = 20)
{
	// Cookie key
	$cookieName = 'user_activity';
	
	// Get all activity
	$allArticles = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : '';

	// If exist add to list
	if ($allArticles) {

		// Make array from string 
		$allArticles = explode(',', $allArticles);

		// If there is no entry in the array, then add it
		if (!in_array($articleID, $allArticles)) {

			// If the limit is exceeded, remove the oldest article
			if (count($allArticles) >= $maxArticles)
				array_shift($allArticles);
			
			$allArticles[] = $articleID;
		}

		// Reformatting back to text
		$cookieValue = implode(',', $allArticles);

	// If not exist create value
	} else {
		$cookieValue = $articleID;
	}

	// Set time for activity
	$cookieExpiration = strtotime('+5 days'); // 1 day

	// Remember activity
	setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
}







/**
 * Break down functions into parts to make them easier to find
 */
include 'functions/database.php';
include 'functions/forFiles.php';
include 'functions/forValidation.php';