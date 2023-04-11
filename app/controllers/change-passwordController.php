<?php
defined('security') or die('Access denied'); // Add light protection against file access

// We check whether it gives us information $user from $_COOKIE (0--beforeController.php)
isUserLogined($user);

// Create a variable for checking
$login = clean($_GET['email']);
$token = clean($_GET['token']);

// Email validate
if (checkEmail($login))
	setAlert(checkEmail($login), 'error', PATH);

// Trying to get a user by the requested login
$userExist = getUser($login);

// If the user is found, but the token is incorrect, then we notify the user about it
if (!arrExist($userExist))
	setAlert('No user found to activate', 'error', PATH);

// If the user is found, but the token is incorrect, then we notify the user about it
if ($userExist['email_confirmed'] === 'no')
	setAlert('This user is not activated!', 'error', PATH);

// If the user is found, but the token is incorrect, then we notify the user about it
if ($userExist['email_token'] !== $token)
	setAlert('Token is incorrect', 'error', PATH);

// Seo data
$seo['title'] = 'Change your password';