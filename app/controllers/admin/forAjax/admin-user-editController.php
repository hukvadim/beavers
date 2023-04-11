<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Id always comes with a form
$id = clean($_POST['id']);

// If the id is not passed, we generate an error
if (!$id)
	jsonAlert('ID not found in POST method');

// Get user data
$userData = getOneRow('users', ['id' => $id]);

// General settings
$alert['text'] = 'User successfully updated.'; // 
$alert['type'] = 'success'; // success | info | warn | error

// The avatar is optional, so we make a similar entry
$avatar      = $_FILES['avatar'];
$avatarExist = (empty($avatar['name'])) ? false : true;

// Generate data and check its accuracy
$toDb['email']           = clean($_POST['email']);
$toDb['name']            = clean($_POST['name']);
$toDb['surname']         = clean($_POST['surname']);
$toDb['type']            = clean($_POST['type']);

// Check for the existence of a publication field
if (!empty($_POST['published'])) {
	$toDb['published'] = clean($_POST['published']);
}

// Check for the existence of the user activation field
if (!empty($_POST['email_confirmed'])) {
	$toDb['email_confirmed'] = clean($_POST['email_confirmed']);
}


// Validate data before add
$error = []; // Variable for error
$error[] = checkValue('email', $toDb['email'], 2, 100);         // Check email
$error[] = checkValue('name', $toDb['name'], 2, 50);            // Check name
$error[] = checkValue('surname', $toDb['surname'], 2, 50);      // Check surname
$error[] = ($avatarExist) ? checkImageFile($avatar, true) : ''; // Check avatar

// Make password variable
$password = clean($_POST['password']);

// If password exist
if (!empty($password)) {
	$toDb['password'] = $password;
	$error[] = checkPassword($password, 4, 85, true);
}

// If there are errors, we display them
if (arrExist(array_filter($error)))
	jsonAlert($error, 'error');

// If password exist 
if ($password) {

	// After all the checks, we can encode the password
	$passwordEncode = encodePassword($toDb['password']);

	// Add DB data
	$toDb['password'] = $passwordEncode['value'];
	$toDb['token']    = $passwordEncode['token'];
}

// Upload pictures to the project
if (!empty($_FILES['avatar']['name'])) {
	uploadImage('avatar', $userData['id'].'-sm', $filePath['user'], 30, 30); // Avatar small we will quietly store it on the side, we will not enter it into the database
	$toDb['avatar']           = uploadImage('avatar', $userData['id'], $filePath['user'], 200, 200); // Avatar normal
	$toDb['avatar_cache_num'] = $userData['avatar_cache_num'] + 1;
}

// If the link has changed
if ($userData['link'] !== $toDb['link'])
	$toDb['link'] = generateLink($userData['id'].'-'.$toDb['name'].'-'.$toDb['surname']);

// Update images in bd
editRecord('users', $toDb, 'id = '.$userData['id']);

// Create a response text
jsonAlert($alert['text'], $alert['type'], $url['admin-users']);