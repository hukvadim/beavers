<?php
defined('security') or die('Access denied'); // Add light protection against file access
// Change the page to be connected
$systemOption['page'] = 'user-activity';

// Add class to body
$systemOption['bodyCssClass'] .= ' page-profile';

// Seo data
$seo['title'] = 'User activity';

// Cookie key
$cookieName = 'user_activity';

// Get all activity
$allArticles = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : '';

// Get records list
$records = getAllActivityRecords($allArticles);
