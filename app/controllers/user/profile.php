<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Change the page to be connected
$systemOption['page'] = 'profile';

// Active category
$activeProfileCat = clean($_GET['data2']);

// Get category data
$catInfo = getCategoryByLink($activeProfileCat);

// Display all articles for the main page
$records = getUserRecords($user['id'], $catInfo['id']);

// Зробити масив категорій з існуючих статтей
$categoryRecords = getUserCategoryOfRecords($user['id']);

// Seo data
$seo['title'] = 'Profile page';