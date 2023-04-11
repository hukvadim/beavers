<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
 * Get all users fro, db
 */
function getAllUsers($filter = 'all', $orderBy = 'users.id DESC')
{
	// Use this bd
	$db = 'users';

	// For sort
	switch ($filter) {
		case 'published':
			$where['published'] = 'show';
			break;

		case 'hidden':
			$where['published'] = 'hide';
			break;

		case 'unactivated':
			$where['email_confirmed'] = 'no';
			break;
		
		case 'all':
		default:
			$where = false;
	}

	// Return data
	$result['list'] = getAllRows($db, $where, '*', 'ORDER BY '.$orderBy.setOffset(10));

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd($db, $where) : 0;

	// Return data
	return $result;
}




/**
 * Get all articles from db
 */
function getAllArticles($filter = 'all', $filterID = false, $orderBy = 'articles.id DESC')
{
	// Use this bd
	$db = 'articles';

	// For sort
	switch ($filter) {
		case 'published':
			$where['published'] = 'show';
			break;

		case 'hidden':
			$where['published'] = 'hide';
			break;

		case 'category':
			if ($filterID) $where['cat_id'] = $filterID;
			break;

		case 'user':
			if ($filterID) $where['user_id'] = $filterID;
			break;
		
		case 'all':
		default:
			$where = false;
	}

	// Return data
	$result['list'] = getAllRows($db, $where, '*', 'ORDER BY '.$orderBy.setOffset(6));

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd($db, $where) : 0;

	// Return data
	return $result;
}




/**
 * Get all comments from db
 */
function getAllComments($filter = 'all', $filterID = false, $orderBy = 'comments.id DESC')
{
	// Use this bd
	$db = 'comments';

	// For sort
	switch ($filter) {
		case 'published':
			$where['published'] = 'show';
			break;

		case 'hidden':
			$where['published'] = 'hide';
			break;

		case 'user':
			if ($filterID) $where['user_id'] = $filterID;
			break;
		
		case 'all':
		default:
			$where = false;
	}

	// Add where sql part
	$whereSql = (arrExist($where)) ? "WHERE ".implodeSqlWhere($where, $db) : '';

	// Base sql query
	$sql = "
		SELECT
			$db.*,
			articles.title as article_title,
			articles.img as article_img,
			users.name as user_name,
			users.surname as user_surname,
			users.avatar_cache_num
		FROM
			$db
		INNER JOIN
			users ON users.id = $db.user_id
		INNER JOIN
			articles ON articles.id = $db.article_id
		$whereSql
		ORDER BY ".$orderBy.setOffset(10);

	// Return data
	$result['list'] = getSqlStr($sql);

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd($db, $where) : 0;

	// Return data
	return $result;
}




/**
 * Get all users fro, db
 */
function getAllCategories($filter = 'all', $orderBy = 'category.id DESC')
{
	// Use this bd
	$db = 'category';

	// For sort
	switch ($filter) {
		case 'published':
			$where['published'] = 'show';
			break;

		case 'hidden':
			$where['published'] = 'hide';
			break;

		case 'all':
		default:
			$where = false;
	}

	// Return data
	$result['list'] = getAllRows($db, $where, '*', 'ORDER BY '.$orderBy.setOffset(10));

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd($db, $where) : 0;

	// Return data
	return $result;
}





/**
 * Set search cart array
 */
function setSearchCard($searchCard = [])
{
	$card['urlEdit']   = ($searchCard['urlEdit'])   ? $searchCard['urlEdit']   : '';
	$card['urlDel']    = ($searchCard['urlDel'])    ? $searchCard['urlDel']    : '';
	$card['cardImg']   = ($searchCard['cardImg'])   ? $searchCard['cardImg'].addTmpView() : '';
	$card['cardTitle'] = ($searchCard['cardTitle']) ? substr($searchCard['cardTitle'], 0, 100) : '';
	$card['cardText']  = ($searchCard['cardText'])  ? substr($searchCard['cardText'], 0, 200)  : '';
	return $card;
}




/**
 * Universal search function
 */
function searchResult($searchTerm = '', $searchType = 'users', $searchFields = [])
{
	// Checking for existence
	if (empty($searchTerm)) return json_encode('');

	// Name of the melon database by which to search
	$dbName = $searchType;

	// Connect to the database
	$db = connect_db();

	// Construct the search query
	$query = "
		SELECT
			$dbName.*
		FROM
			$dbName
		WHERE ";

	// We will store the parameters here
	$params = [];

	// Form part of the sql query
	foreach ($searchFields as $field) {
		$query .= "$dbName.$field LIKE ? OR ";
		$params[] = "%$searchTerm%";
	}
	$query = rtrim($query, "OR ");

	// Set limit result
	$query .= " ORDER BY $dbName.id DESC LIMIT 8";

	// Prepare and execute the query
	$stmt = $db->prepare($query);
	$stmt->execute($params);

	// Return the search results
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// If the array is not empty, start reformatting
	if (arrExist($result)) {

		// Switch the search according to the page type
		switch ($searchType) {
			case 'articles':
				$result = reformatSearchArticles($result, $searchType);
				break;
			case 'users':
				$result = reformatSearchUser($result, $searchType);
				break;
		}
	}

	// Return the array required for the template
	return $result;
}




/**
 * Universal search function
 */
function searchCommentsResult($searchTerm = '')
{
	// Checking for existence
	if (empty($searchTerm)) return json_encode('');

	// Name of the melon database by which to search
	$dbName = 'comments';

	// Search by this array
	$searchFields = ['comments.text', 'articles.title', 'users.name', 'users.surname'];

	// Connect to the database
	$db = connect_db();

	// Construct the search query
	$query = "
		SELECT
			$dbName.*,
			articles.title as article_title,
			articles.img as article_img,
			users.name as user_name,
			users.surname as user_surname
		FROM
			$dbName
		INNER JOIN
			users ON users.id = $dbName.user_id
		INNER JOIN
			articles ON articles.id = $dbName.article_id
		WHERE ";

	// We will store the parameters here
	$params = [];

	// Form part of the sql query
	foreach ($searchFields as $field) {
		$query .= "$field LIKE ? OR ";
		$params[] = "%$searchTerm%";
	}
	$query = rtrim($query, "OR ");

	// Set limit result
	$query .= " ORDER BY $dbName.id DESC LIMIT 8";

	// Prepare and execute the query
	$stmt = $db->prepare($query);
	$stmt->execute($params);

	// Return the search results
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Default return array
	$data = [];

	// If the array is not empty, start reformatting
	if (arrExist($result)) {

		// We go through all the records and form an array to return
		foreach ($result as $key => $value) {
			// Required array format
			$searchCard['urlEdit']   = $GLOBALS['url']['adminType'].'comments'.$GLOBALS['url']['admin-edit'].$value['id'];
			$searchCard['urlDel']    = $GLOBALS['url']['adminType'].'comments'.$GLOBALS['url']['admin-delete'].$value['id'];
			$searchCard['cardImg']   = viewImg($value['article_img'], 'article');
			$searchCard['cardTitle'] = viewFullName($value['user_name'], $value['user_surname']).' <small>('.clean($value['article_title']).')</small>';
			$searchCard['cardText'] = $value['text'];

			$data[$key] = setSearchCard($searchCard);
		}
	}

	// Return the array required for the template
	return $data;
}




/**
 * Reformatting the array to the one needed for output to the html template
 */
function reformatSearchArticles($result = [], $pageType = '')
{
	// Create an array to return
	$data = [];

	// We go through all the records and form an array to return
	foreach ($result as $key => $value) {
		// Required array format
		$searchCard['urlEdit']   = $GLOBALS['url']['adminType'].$pageType.$GLOBALS['url']['admin-edit'].$value['id'];
		$searchCard['urlDel']    = $GLOBALS['url']['adminType'].$pageType.$GLOBALS['url']['admin-delete'].$value['id'];
		$searchCard['cardImg']   = viewImg($value['img'], 'article');
		$searchCard['cardTitle'] = $value['title'];

		$data[$key] = setSearchCard($searchCard);
	}

	
	// We additionally check the array and return the array we need for sure
	return $data;
}




/**
 * Reformatting the array to the one needed for output to the html template
 */
function reformatSearchUser($result = [], $pageType = '')
{
	// Create an array to return
	$data = [];

	// We go through all the records and form an array to return
	foreach ($result as $key => $value) {
		// Required array format
		$searchCard['urlEdit']   = $GLOBALS['url']['adminType'].$pageType.$GLOBALS['url']['admin-edit'].$value['id'];
		$searchCard['urlDel']    = $GLOBALS['url']['adminType'].$pageType.$GLOBALS['url']['admin-delete'].$value['id'];
		$searchCard['cardImg']   = viewImg($value['avatar'], 'user');
		$searchCard['cardTitle'] = viewFullName($value['name'], $value['surname']);

		$data[$key] = setSearchCard($searchCard);
	}

	
	// We additionally check the array and return the array we need for sure
	return $data;
}
