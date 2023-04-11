<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
 * Sending an activation email to the user
 */
function sendUserActivation($user = [])
{
	// Base check
	if (!arrExist($user)) return;

	// Receive the activation link
	$activation = getLinkActivation($user['email']);

	// We send an email if the link and token is generated
	if (!$activation['link'] || !$activation['token']) return false;

	// Update user data
	$toDb['email_token'] = $activation['token'];

	// Update images in bd
	editRecord('users', $toDb, 'id = '.$user['id']);

	// Params for email template
	$emailParams['showParams']     = false; // Show or hide (true / false) settings for an email template in console
	$emailParams['emailTemplate']  = 'emailActivation.html';
	$emailParams['fullName']       = viewFullName($user['name'], $user['surname']);
	$emailParams['activationLink'] = $activation['link'];

	// Subject of the letter
	$subject = 'Profile activation letter on the website '.ucfirst(DOMAIN);

	// Send an html email to the mail
	return sendEmail($user['email'], $emailParams, $subject);
}




/**
 * Sending an new password to the user
 */
function sendNewPassword($user = [])
{
	// Base check
	if (!arrExist($user)) return;

	// Receive the activation link
	$activation = getLinkActivation($user['email'], 'change-password');

	// We send an email if the link and token is generated
	if (!$activation['link'] || !$activation['token']) return false;

	// Update user data
	$toDb['email_token']   = $activation['token'];
	$toDb['email_newpass'] = getTmpPassword();

	// Update images in bd
	editRecord('users', $toDb, 'id = '.$user['id']);

	// Params for email template
	$emailParams['showParams']         = false; // Show or hide (true / false) settings for an email template in console
	$emailParams['emailTemplate']      = 'emailPasswordReminder.html';
	$emailParams['fullName']           = viewFullName($user['name'], $user['surname']);
	$emailParams['recoverLink']        = $activation['link'];
	$emailParams['recoverNewPassword'] = $toDb['email_newpass'];

	// Subject of the letter
	$subject = 'Link for password recovery.';

	// Send an html email to the mail
	return sendEmail($user['email'], $emailParams, $subject);
}




/**
 * Get user data
 */
function getUser($value = false, $byKey = 'email')
{
	// Forming the data to be extracted from the database
	$where['published'] = 'show';

	// We can add an array of keys and values to where or just pass a string
	if (is_array($value))
		$where = array_merge($where, $value);
	else
		$where[$byKey] = $value;

	// Return data
	return getOneRow('users', $where);
}




/**
 * Get all users
 */
function getUserList()
{
	// Forming the data to be extracted from the database
	$where['published'] = 'show';

	// Return data
	return getAllRows('users', $where);
}




/**
 * Extract articles related to the category
 */
function getUserRecords($userId = false, $catId = false)
{
	// Base check
	if (!$userId) return;

	// Create $where array
	$where['user_id'] = $userId;
	$where['cat_id']  = ($catId) ? $catId : false;

	// Return articles array
	return getAllRecords($where, ($catId) ? false : true, false);
}




/**
 * Create an array of existing articles about the user
 */
function getUserCategoryOfRecords($userId = false, $catId = false)
{
	// Base check
	if (!$userId) return;

	// Create $where array
	$where['published'] = 'show';
	$where['user_id']   = $userId;
	$where['cat_id']    = ($catId) ? $catId : '';

	// Base sql query
	$sql = "
		SELECT DISTINCT
			category.title,
			category.link
		FROM
			articles
		INNER JOIN
			category ON category.id = articles.cat_id
		WHERE
			".implodeSqlWhere($where, 'articles');

	// Return data
	return getSqlStr($sql);
}