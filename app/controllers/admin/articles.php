<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Name of the database we are going to work with in this section
$sectionName = 'articles';

// Path to the files that will be used in this section
$sectionFilePath = $filePath['article'];

// Set filter part of url
$url['admin-filter-cat'] = $url['admin-filter'].'category'.'&id=';
$url['admin-filter-user'] = $url['admin-filter'].'user'.'&id=';

// Switch to the appropriate page type
switch ($pageType) {
	case $sectionName.'--delete':

		// Id for delete data
		$id = clean($_GET['delete-id']);

		// Get images from db
		$imgData = getOneRow($sectionName, ['id' => $id], 'img, img_article, meta_img');

		// Set images array
		if (arrExist($imgData)) {
			foreach ($imgData as $img)
				$delImages[] = $sectionFilePath.$img;

			// If successfully deleted
			deleteImages($delImages);
		}

		// Delete from the database
		deleteItem($sectionName, $id);

		// Request when deleting a deletion
		redirect($url['admin-'.$sectionName]);
		break;
	case $sectionName.'--add':

		break;
	
	case $sectionName.'--edit':

		// If this edit requires generating a record id
		$id = clean($_GET['edit-id']);

		// Checking id for existence
		if (!$id) return 'Article ID not passed';

		// Display user info
		$recordData = getOneRow($sectionName, ['id' => $id]);

		break;
	
	case $sectionName:
	default:
		
		// When passing a filter, we form its id
		$filterID = (clean($_GET['id'])) ? clean($_GET['id']) : false;

		// Set other filter data
		if ($_GET['filter'] == 'category') {
			$activeFilter = 'category';
			$filterCatID = $filterID;
		}
		if ($_GET['filter'] == 'user') {
			$activeFilter = 'user';
			$filterUserID = $filterID;
		}

		// Display all data
		$listData = getAllArticles($activeFilter, $filterID);

		// Display all users
		$listUsers = getAllUsers();

		break;
}
