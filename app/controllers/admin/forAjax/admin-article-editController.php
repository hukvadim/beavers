<?php
defined('security') or die('Access denied'); // Add light protection against file access

// The table to which we will add a new record
$insertTable = 'articles';

// Id always comes with a form
$id = clean($_POST['id']);

// If the id is not passed, we generate an error
if (!$id)
	jsonAlert('ID not found in POST method');

// Get user data
$recordData = getOneRow($insertTable, ['id' => $id]);

// Alert settings
$alert['text'] = 'Record edit successfully!'; 
$alert['type'] = 'success'; // success | info | warn | error

// The avatar is optional, so we make a similar entry
$image      = $_FILES['image'];
$imageExist = (empty($image['name'])) ? false : true;

// Generate data and check its accuracy
$toDb['title']      = clean($_POST['title']);
$toDb['link']       = generateLink($toDb['title']);
$toDb['meta_title'] = $toDb['title'];
$toDb['date_add']   = time();
$toDb['cat_id']     = clean($_POST['category']);
$toDb['user_id']    = clean($user['id']);
$toDb['text_sm']    = addslashes($_POST['text-small']);
$toDb['text']       = addslashes($_POST['article']);
$toDb['published']  = clean($_POST['published']);

// Validate data before add
$error = []; // Variable for error
$error[] = checkCategoryExist($rivers, $toDb['cat_id']);        // Check category
$error[] = checkValue('title', $toDb['title']);                 // Check title
$error[] = checkValue('description', $toDb['text_sm'], 2, 200); // Check description
$error[] = checkValue('article', $toDb['text'], 2, 5000);     // Check article
$error[] = ($imageExist) ? checkImageFile($image, true) : ''; // Check avatar

// If there are errors, we display them
if (arrExist(array_filter($error)))
	jsonAlert($error, 'error');

// Check if the link exists in already added category
isUrlExist($insertTable, $toDb['link'], 'link', $id);

// Upload pictures to the project
if ($imageExist) {
	$toDb['img']         = uploadImage('image', $id.'-card', $filePath['article'], 380, 300); // Image for card
	$toDb['img_article'] = uploadImage('image', $id.'-preview', $filePath['article'], 825, 500, false); // Image for article preview
	$toDb['meta_img']    = uploadImage('image', $id.'-social', $filePath['article'], 900, 900, false); // Image for social
}

// Update images in bd
editRecord($insertTable, $toDb, 'id = '.$id);

// Create a response text
jsonAlert($alert['text'], $alert['type'], $url['admin-articles']);