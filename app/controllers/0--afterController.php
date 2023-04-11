<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Add css class to the html body tag
$systemOption['bodyCssClass'] .= ' page-'.$systemOption['page'];

// If the title is not specified, we make some default text
$seo['title'] = ($seo['title']) ? $seo['title'].' | '.PROJECTNAME : 'Each beaver should have own house | '.PROJECTNAME;

// If the picture of the social network is not specified, we take the default
if (!$seo['banner'])
	$seo['banner'] = $filePath['img'].$systemOption['socialImage'];

// Make array for social image
// $seo['banner'] = setSocialImg($seo['banner']);