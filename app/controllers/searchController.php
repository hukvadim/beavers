<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Search value
$searchVal = (clean($_GET['query'])) ? clean($_GET['query']) : '';

// When the page loads, we immediately look for the results
$records['list'] = search($searchVal, ['title', 'text', 'text_sm']);

// Seo data
$seo['title'] = 'Search page';