<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Display all articles for the main page
$records = getAllRecords();

// Seo data
$seo['title'] = 'Home page';