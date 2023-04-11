<?php
defined('security') or die('Access denied'); // Add light protection against file access

// We check whether it gives us information $user from $_COOKIE (0--beforeController.php)
isUserLogined($user);

// Get user login and password
$login = clean($_GET['email']);
$token = clean($_GET['token']);

// Email validate
if (checkEmail($login))
	setAlert(checkEmail($login), 'error', PATH);

// Trying to get a user by the requested login
$user = getUser($login);

// If the user is found, but the token is incorrect, then we notify the user about it
if (!arrExist($user))
	setAlert('No user found to activate', 'error', PATH);

// If the user is found, but the token is incorrect, then we notify the user about it
if ($user['email_confirmed'] === 'yes')
	setAlert('This user is already activated', 'error', PATH);

// If the user is found, but the token is incorrect, then we notify the user about it
if ($user['email_token'] !== $token)
	setAlert('Token is incorrect', 'error', PATH);

// Set authorisation data
authData('set', $user['id'], $user['token']);

// Update user data
$toDb['email_confirmed'] = 'yes';
$toDb['email_token']     = '';

// Update images in bd
editRecord('users', $toDb, 'id = '.$user['id']);

// General settings
$alert['text'] = 'Your account has been successfully activated!'; // 
$alert['type'] = 'success'; // success | info | warn | error

// Notify the user of the response status
setAlert($alert['text'], $alert['type'], gotToProfile());