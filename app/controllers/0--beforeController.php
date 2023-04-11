<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Logout
if ($_GET['logout'])
	authData('delete');

// Connect the main model for the website
include $systemOption['model'].'0--baseModel.php';

// Get user data
$user = authData('get');

// To override false in the user variable, enter the user array
$systemOption['admin'] = ($user['type'] === 'admin') ? true : false;

// If the user is an administrator, connect the administrator model
if ($systemOption['admin']) {

	// Connect the admin model for the website
	include $systemOption['model'].'adminModel.php';
}


// For meta tag canonical
$canonical = ($_SERVER['REDIRECT_URL']) ? PATH.substr($_SERVER['REDIRECT_URL'], 1) : PATH;

// We need categories on each page, so we extract the entire list
$rivers = getCategoryList();
