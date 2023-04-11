<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Active category
$activeCat = clean($_GET['data1']);

// Get category data
$catInfo = getCategoryByLink($activeCat);

// Check if category exist in database
if (!arrExist($catInfo)) {

	// If it is not found in the database at all, should display a 404 error
	$systemOption['setError'] = true;

} else {

	// Display all articles for the main page
	$records = getCatRecords($catInfo['id']);

	// Seo data
	$seo['title'] = $catInfo['title'];
}

