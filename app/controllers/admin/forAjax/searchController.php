<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Search value
$searchVal = (clean($_POST['query'])) ? clean($_POST['query']) : '';

// By default, we return an empty array
$result = [];

// If the search query is not empty, we look for
if (!empty($searchVal)) {

	// Switch by type
	switch ($pageType) {
		case 'comments':
			// Search for the value in the database
			$result = searchCommentsResult($searchVal);
			break;

		case 'articles':
			// Search for the value in the database
			$result = searchResult($searchVal, $pageType, ['title', 'text', 'text_sm']);
			break;
		
		case 'users':
			// Search for the value in the database
			$result = searchResult($searchVal, $pageType, ['name', 'surname']);
			break;
	}

}

exit( json_encode($result) );
