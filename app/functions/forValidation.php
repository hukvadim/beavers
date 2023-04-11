<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
 * Checking the correctness of the ulr
 */
function isUrl($value)
{
	return (filter_var($value, FILTER_SANITIZE_URL)) ? true : false;
}


/**
 * Checking Email
 */
function isEmail($value) {
	return (filter_var($value, FILTER_VALIDATE_EMAIL)) ? true : false;
}



/**
 * Check if a given text string is of required length
 */
function checkValue($label, $text, $minNum = 2, $maxNum = 200)
{
	// Checking for existence
	if (!$text)
		return ucfirst($label).' is empty.';

	// Counting the number of characters
	$textLength = strlen($text);

	// Check the text for the minimum value
	if ($textLength < $minNum)
		return 'Field '.$label.' minimum value '.$minNum;

	// Check the text for the maxinum value
	if ($textLength > $maxNum)
		return 'Field '.$label.' maximum value '.$minNum;

	// By default, return false
	return false;
}




/**
 * Check the correctness of the email and generate a text error
 */
function checkEmail($email = false)
{
	// Checking for existence
	if (!$email) return 'Email is empty.';

	// Check email for correctness
	if (!isEmail($email)) return 'Email is not correct.';
}




/**
 * Validate password
 */
function checkPassword($password = false, $min = 4, $max = 85, $required = false)
{
	// Checking for existence
	if (!$password and $required)
		return 'Password is empty.';

	// If the password is required, we do additional checks
	if ($password and $required) {

		// Password must be at least N characters
		if (strlen($password) < $min)
			return "The password must contain at least $min characters";

		// Password must be at least N characters
		if (strlen($password) > $max)
			return "The password should contain no more than $max characters.";

		// // Password must contain at least one uppercase letter, one lowercase letter, and one number
		// if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $password))
		// 	return "Password must contain at least one uppercase letter, one lowercase letter, and one number";

		// Password must not contain spaces
		if (strpos($password, ' ') !== false)
			return 'Password must not contain spaces';
	}
}




/**
 * Check if the link exists
 * @param  boolean $bdName   [ Name of the database ]
 * @param  boolean $linkPush [ Link value ]
 * @param  boolean $linkGet  [ The key in the database that is responsible for the link ]
 * @param  boolean $idVal    [ The value of id ]
 * @param  boolean $idKey    [ The key in the database that is responsible for the id ]
 * @return boolean           [ true || redirect ]
 */
function isUrlExist($bdName = false, $linkPush = false, $linkGet = 'link', $idVal = false, $idKey = 'id')
{
	// If the link is not passed immediately generate an error
	if(!$linkPush)
		exit( jsonAlert('The link has not been passed.') );

	// Check links to prohibited characters
	if(!isUrl($linkPush))
		exit( jsonAlert('The link contains prohibited characters. Only Latin characters are allowed.') );

	// Extract the previous value of the reference if we update something to compare the old reference and the new one
	$where[$linkGet] = $linkPush;

	// Trying to extract data with id and link
	$infoRecord = getOneRow($bdName, $where, implode(',', [$idKey, $linkGet]));

	// If the passed id means we are updating something
	if($idVal) {
		if(arrExist($infoRecord) and $infoRecord[$idKey] != $idVal)
			exit( jsonAlert('Such a link already exists. Change the title, link is made from the title.') );
	} else {
		if(arrExist($infoRecord))
			exit( jsonAlert('Such a link already exists.') );
	}

	// None of the checks should fail and the function should return true
	return true;
}




/**
 * Check the category before adding it
 */
function checkCategoryExist($catList, $catID = false)
{
	// Checking for existence
	if (!$catID) return 'Category not selected';

	// Check if the category id is in the array of published categories
	$catExist = (arrExist($catList)) ? in_array($catID, array_column($catList, 'id')) : false;

	// If we receive an unknown category id, we generate an error
	if (!$catExist) return 'Category was not found.';
}




/**
 * Check if uploaded file is an image with PNG or JPG/JPEG file extension.
 *
 * @param array $file Array representing the uploaded file.
 * @return bool Returns true if the file is a PNG or JPG/JPEG image, false otherwise.
 */
function checkImageFile($file = false, $textError = false)
{
	// Base check
	if(!$file) return;

	// Check if file extension is either PNG or JPG/JPEG.
	$allowedExtensions = ['png', 'jpg', 'jpeg'];
	$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	if (!in_array($extension, $allowedExtensions))
		return (!$textError) ? false : 'Image resolution is not allowed. Only the following are allowed '.implode(', ', $allowedExtensions);

	// Check if file is an image.
	if (filesize($file['tmp_name']) >= MAX_SIZE)
		return (!$textError) ? false : 'The image size is too large.'.formatBytes(MAX_SIZE);
}