<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Change the page to be connected
$systemOption['page'] = 'profile-other-user';

// Where for sql
$where['link'] = clean($_GET['data1']);

// Trying to extract the other user
$userDetail = getUser($where);

// Active category
$activeProfileCat = clean($_GET['data3']);

// Get category data
$catInfo = getCategoryByLink($activeProfileCat);

// Display all articles for the main page
$records = getUserRecords($userDetail['id'], $catInfo['id']);

// Зробити масив категорій з існуючих статтей
$categoryRecords = getUserCategoryOfRecords($userDetail['id']);

// Seo data
$seo['title'] = 'User profile '.viewFullName($userDetail['name'], $userDetail['surname']);