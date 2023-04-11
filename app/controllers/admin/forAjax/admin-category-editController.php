<?php
defined('security') or die('Access denied'); // Add light protection against file access

// The table to which we will add a new record
$insertTable = 'category';

// Id always comes with a form
$id = clean($_POST['id']);

// If the id is not passed, we generate an error
if (!$id)
	jsonAlert('ID not found in POST method');

// Get user data
$recordData = getOneRow($insertTable, ['id' => $id]);

// Alert settings
$alert['text'] = 'Category edit successfully!'; 
$alert['type'] = 'success'; // success | info | warn | error

// The avatar is optional, so we make a similar entry
$image      = $_FILES['image'];
$imageExist = (empty($image['name'])) ? false : true;

// Generate data and check its accuracy
$toDb['title']      = clean($_POST['title']);
$toDb['link']       = generateLink($toDb['title']);
$toDb['meta_title'] = $toDb['title'];
$toDb['published']  = clean($_POST['published']);

// Validate data before add
$error = []; // Variable for error
$error[] = checkValue('title', $toDb['title']);               // Check title
$error[] = ($imageExist) ? checkImageFile($image, true) : ''; // Check avatar

// If there are errors, we display them
if (arrExist(array_filter($error)))
	jsonAlert($error, 'error');

// Check if the link exists in already added category
isUrlExist($insertTable, $toDb['link'], 'link', $id);

// Upload pictures to the project
if ($imageExist) {
	$updateImg['img']      = uploadImage('image', $id.'-card', $filePath['category'], 53, 36); // Image for card
	$updateImg['meta_img'] = uploadImage('image', $id.'-social', $filePath['category'], 900, 900, false); // Image for social
}

// Update images in bd
editRecord($insertTable, $toDb, 'id = '.$id);

// Create a response text
jsonAlert($alert['text'], $alert['type'], $url['admin-category']);