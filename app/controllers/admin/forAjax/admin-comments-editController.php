<?php
defined('security') or die('Access denied'); // Add light protection against file access

// The table to which we will add a new record
$insertTable = 'comments';

// Id always comes with a form
$id = clean($_POST['id']);

// If the id is not passed, we generate an error
if (!$id)
	jsonAlert('ID not found in POST method');

// Alert settings
$alert['text'] = 'Comment edit successfully!'; 
$alert['type'] = 'success'; // success | info | warn | error

// Generate data and check its accuracy
$toDb['text']       = addslashes(trim($_POST['comment']));
$toDb['published']  = clean($_POST['published']);
$toDb['article_id'] = clean($_POST['article_id']);
$toDb['user_id']    = clean($_POST['user_id']);

// Validate data before add
$error = []; // Variable for error
$error[] = checkValue('comment', $toDb['text'], 5, 600);

// If there are errors, we display them
if (arrExist(array_filter($error)))
	jsonAlert($error, 'error');

// Update images in bd
editRecord($insertTable, $toDb, 'id = '.$id);

// Create a response text
jsonAlert($alert['text'], $alert['type'], $url['admin-comments']);