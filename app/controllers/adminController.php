<?php
defined('security') or die('Access denied'); // Add light protection against file access

// If there is no user label, then switch to the main page
isAdministrator($user);

// Connect the admin config file for the website
include 'admin/config.php';

// Connect the rest of the controller according to the type
if(!@include('admin/'.$pageTypeClean.'.php'))
	include('admin/'.$mainPage.'.php');

// In this page, we will switch to the desired admin page
$systemOption['page'] = 'admin';
