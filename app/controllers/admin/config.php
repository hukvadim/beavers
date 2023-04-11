<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Main page if page not found
$mainPage = 'users';

// Type of page to be displayed
if (!isset($pageType))
	$pageType = (clean($_GET['data1'])) ? clean($_GET['data1']) : $mainPage;

// General page type
$pageTypeClean = $pageType;

// Activate filter variable
$activeFilter = (clean($_GET['filter'])) ? clean($_GET['filter']) : false;

// Set filter part of url
$url['admin-filter'] = $url['adminType'].$pageType.$url['admin-filter'];

// Set edit part of url
$url['admin-edit'] = $url['adminType'].$pageType.$url['admin-edit'];

// Set edit part of url
$url['admin-add'] = $url['adminType'].$pageType.$url['admin-add'];

// Set edit part of url
$url['admin-delete'] = $url['adminType'].$pageType.$url['admin-delete'];

// Create an output type for addition
if (isset($_GET['add']))
	$pageType = $pageType.'--add';

// Create an output type for editing
if (isset($_GET['edit-id']))
	$pageType = $pageType.'--edit';

// Create an output type for editing
if (isset($_GET['delete-id']))
	$pageType = $pageType.'--delete';
