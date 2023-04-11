<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Name of the database we are going to work with in this section
$sectionName = 'comments';

// Set filter part of url
$url['admin-filter-article'] = $url['admin-filter'].'article'.'&id=';
$url['admin-filter-user'] = $url['admin-filter'].'user'.'&id=';

// Switch to the appropriate page type
switch ($pageType) {
	case $sectionName.'--delete':

		// Id for delete data
		$id = clean($_GET['delete-id']);

		// Delete from the database
		deleteItem($sectionName, $id);

		// Request when deleting a deletion
		redirect($url['admin-'.$sectionName]);
		break;
	
	case $sectionName.'--edit':

		// If this edit requires generating a record id
		$id = clean($_GET['edit-id']);

		// Checking id for existence
		if (!$id) return 'Comment ID not passed';

		// Display user info
		$recordData = getOneRow($sectionName, ['id' => $id]);

		// Get all users
		$listUsers = getAllUsers();

		// Display all data
		$listArticles = getAllArticles();
		break;
	
	case $sectionName:
	default:

		// Display all data
		$listData = getAllComments($activeFilter, $filterID);

		break;
}
