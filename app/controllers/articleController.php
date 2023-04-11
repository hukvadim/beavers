<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Get link
$link = clean($_GET['data1']);

// Page info
$article = getOneRecord($link);

// Check if category exist in database
if (!arrExist($article)) {

	// If it is not found in the database at all, should display a 404 error
	$systemOption['setError'] = true;

} else {

	// Seo data
	$seo['title'] = $article['title'];

	// Array for breadcrumb 
	$i = 0;
	$breadcrumb[$i]['link']  = $url['category'].$article['cat_link'];
	$breadcrumb[$i]['value'] = $article['cat_name'];

	// Add a viewing number
	setViewNum($article['id'], $article['view_num']);

	// Set activity mark
	setUserActivity($article['id']);

	// Comments per page
	$commentsPerPage = 6;

	// Get comments
	$comments = getComments($article['id'], $commentsPerPage);

	// Change no result image
	$systemOption['noResultImg']  = 'no-result-v2.png';
	$systemOption['noResultText'] = 'No comments found.<br>Be the first to comment!';
}

