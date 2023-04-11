<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Name of the database we are going to work with in this section
$sectionName = 'users';

// Path to the files that will be used in this section
$sectionFilePath = $filePath['user'];

// Switch to the appropriate page type
switch ($pageType) {
	case $sectionName.'--delete':

		// Id for delete data
		$id = clean($_GET['delete-id']);

		// Get images from db
		$imgData = getOneRow($sectionName, ['id' => $id], 'avatar');

		// Set images array
		if (arrExist($imgData)) {
			// foreach ($imgData as $img)
			// 	$delImages[] = $img;
			$delImages[] = $sectionFilePath.$imgData['avatar'];
			$delImages[] = $sectionFilePath.setImgSm($imgData['avatar']);

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
		if (!$id) return 'User ID not passed';

		// Display user info
		$userData = getOneRow($sectionName, ['id' => $id]);

		break;
	
	case $sectionName:
	default:

		// Display all users
		$listData = getAllUsers($activeFilter);
		break;
}
