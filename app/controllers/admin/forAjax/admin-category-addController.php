<?php
defined('security') or die('Access denied'); // Add light protection against file access


// The table to which we will add a new record
$insertTable = 'category';

// Alert settings
$alert['text'] = 'Category successfully added!'; 
$alert['type'] = 'success'; // success | info | warn | error

// Generate data and check its accuracy
$toDb['title']      = clean($_POST['title']);
$toDb['link']       = generateLink($toDb['title']);
$toDb['meta_title'] = $toDb['title'];
$toDb['published']  = clean($_POST['published']);

// Validate data before add
$error = []; // Variable for error
$error[] = checkImageFile($_FILES['image'], true);              // Check avatar
$error[] = checkValue('title', $toDb['title']);                 // Check title

// If there are errors, we display them
if (arrExist(array_filter($error)))
	jsonAlert($error, 'error');

// Check if the link exists in already added category
isUrlExist($insertTable, $toDb['link']);

// Call the add function
$insertID = addRecord($insertTable, $toDb);

// Upload pictures to the project
$updateImg['img']         = uploadImage('image', $insertID.'-card', $filePath['category'], 53, 36); // Image for card
$updateImg['meta_img']    = uploadImage('image', $insertID.'-social', $filePath['category'], 900, 900, false); // Image for social

// Update images in bd
editRecord($insertTable, $updateImg, 'id = '.$insertID);

// Create a response text
setAlert($alert['text'], $alert['type']);
jsonAlert($alert['text'], $alert['type'], $url['admin-category']);