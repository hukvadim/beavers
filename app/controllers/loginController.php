<?php
defined('security') or die('Access denied'); // Add light protection against file access

// We check whether it gives us information $user from $_COOKIE (0--beforeController.php)
isUserLogined($user);

// Seo data
$seo['title'] = 'Login / Sign up';