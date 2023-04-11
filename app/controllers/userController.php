<?php
defined('security') or die('Access denied'); // Add light protection against file access

// If there is no user label, then switch to the main page
isUserRegistered($user, 'Only authorized users can access this page.');

// Switch user page type
$userTypes['main']     = 'profile';
$userTypes['category'] = 'profile';
$userTypes['edit']     = 'profile-edit';
$userTypes['detail']   = 'user-detail';
$userTypes['activity'] = 'user-activity';
$userTypes['bookmark'] = 'user-bookmark';

// Switch admin page type
$userTypes['users']     = 'profile-edit';

// Get user view in relation to type 
$pageData = (clean($_GET['data1'])) ? clean($_GET['data1']) : 'main';

// If the type is not found, then this is the user view
$pageType = (array_key_exists($pageData, $userTypes)) ? $userTypes[$pageData] : $userTypes['detail'];

// If it asks to view another profile, but the link corresponds to an authorized user, then just display the profile
if ($pageType === 'user-detail' and $user['link'] == $pageData)
	$pageType = $userTypes['main'];

// Change the page to be connected
$systemOption['page'] = 'user-'.$pageType;

// Connect the rest of the controller according to the type
include 'user/'.$pageType.'.php';
