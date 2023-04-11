<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Change the page to be connected
$systemOption['page'] = 'bookmark';

// Add class to body
$systemOption['bodyCssClass'] .= ' page-profile';

// Seo data
$seo['title'] = 'User bookmark';
