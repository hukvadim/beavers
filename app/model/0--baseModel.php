<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
 * Count the number of records in the database
 */
function countDataInBd($bdName, $where = false, $keyId = 'id')
{
	return getOneRow($bdName, $where, "COUNT($keyId) as countData")['countData'];
}




/**
 * Get a single record
 */
function getOneRow($table = false, $where = false, $fields = '*', $sqlEnd = '')
{
	// Prepare connection
	$stmt = getSql($table, $where, $fields, $sqlEnd);

	// Retrieve the record
	$record = $stmt->fetch(PDO::FETCH_ASSOC);

	// Return single data
	return (arrExist($record)) ? $record : false;
}




/**
 * Get a list of records
 */
function getAllRows($table = false, $where = false, $fields = '*', $sqlEnd = '')
{
	// Prepare connection
	$stmt = getSql($table, $where, $fields, $sqlEnd);

	// Retrieve the record
	$record = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Return list of data
	return (arrExist($record)) ? $record : false;
}




/**
 * Adds a new record to the specified table in the database
 */
function addRecord($table, $data)
{
	// Connect to the database
	$db = connect_db();

	// Build the query
	$columns = implode(', ', array_keys($data));
	$values  = implode(', ', array_fill(0, count($data), '?'));

	// Sql part
	$sql = "INSERT INTO $table ($columns) VALUES ($values)";

	// Prepare the statement
	$stmt = $db->prepare($sql);

	// Bind the values
	$i = 1;
	foreach ($data as $value) {
		$stmt->bindValue($i++, $value);
	}

	// Execute the statement
	$result = $stmt->execute();

	// Return answer
	return $db->lastInsertId();
}




/**
 * Edit record in a MySQL table
 */
function editRecord($table, $data, $where)
{
	// Connect to the database
	$db = connect_db();

	// Build the SET clause of the SQL query
	$setClause = '';
	foreach ($data as $column => $value) {
		$setClause .= "`$column` = :$column,";
	}
	$setClause = rtrim($setClause, ',');

	// Build the full SQL query
	$sql = "UPDATE `$table` SET $setClause WHERE $where";

	// Prepare the query
	$stmt = $db->prepare($sql);

	// Bind the parameters
	foreach ($data as $column => $value) {
		$stmt->bindValue(":$column", $value);
	}

	// Checking the execution of the request
	try {
		$data = $stmt->execute();
	} catch (Exception $e) {
		die('Connection failed: ' . $e->getMessage());
	}

	// Execute the query
	return ($data) ? true : false;
}




/**
 * Universal search function
 */
function search($searchTerm, $searchFields)
{
	// Connect to the database
	$db = connect_db();

	// Construct the search query
	$query = "
	SELECT
		articles.id,
		articles.link,
		articles.title,
		articles.text_sm,
		articles.img,
		category.title as cat_name,
		category.link as cat_link,
		users.name as user_name,
		users.surname as user_surname,
		users.link as user_link,
		users.avatar_cache_num,
		users.avatar as user_avatar
	FROM
		articles
	INNER JOIN
		users ON users.id = articles.user_id
	INNER JOIN
		category ON category.id = articles.cat_id
	WHERE ";

	// We will store the parameters here
	$params = [];

	// Form part of the sql query
	foreach ($searchFields as $field) {
		$query .= "articles.$field LIKE ? OR ";
		$params[] = "%$searchTerm%";
	}
	$query = rtrim($query, "OR ");

	// Set limit result
	$query .= ' ORDER BY articles.id DESC LIMIT 8';

	// Prepare and execute the query
	$stmt = $db->prepare($query);
	$stmt->execute($params);

	// Return the search results
	return  $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Select all published categories
 */
function getCategoryList()
{
	// Forming the data to be extracted from the database
	$where['published'] = 'show';

	// Get this data
	$fields[] = 'id';
	$fields[] = 'link';
	$fields[] = 'img';
	$fields[] = 'title';

	// Return data
	return getAllRows('category', $where, implode(',', $fields));
}



/**
 * Get category data
 */
function getCategoryByLink($link = false)
{
	// Forming the data to be extracted from the database
	$where['published'] = 'show';
	$where['link']      = $link;

	// Return data
	return getOneRow('category', $where);
}




/**
 * We update the number of views
 */
function setViewNum($id = false, $viewNum = 0)
{
	// Base check
	if (!$id) return;

	// Key for cookie
	$viewKey = 'viewIdList';

	// Try to get data from cookie
	$viewIdList = (isset($_COOKIE[$viewKey])) ? explode('|', $_COOKIE[$viewKey]) : [];

	// Check whether the article is already in the reviewed list
	if (in_array($id, $viewIdList)) return;

	// Add values to the array
	$viewIdList[] = $id;

	// Update view num
	editRecord('articles', ['view_num' => ++$viewNum], 'id = '.$id);

	// Updating the list of viewed materials
	setcookie($viewKey, implode('|', $viewIdList), strtotime('+1 hour'), '/', DOMAIN);
}






/**
 * Get the data from a single article
 */
function getOneRecord($link = false)
{
	if(!$link) return;

	// Where for base sql and for count function
	$where['published'] = 'show';
	$where['link']      = $link;

	// Base sql query
	$sql = "
	SELECT
		articles.*,
		category.title as cat_name,
		category.link as cat_link,
		users.name as user_name,
		users.surname as user_surname,
		users.link as user_link,
		users.avatar_cache_num,
		users.avatar as user_avatar
	FROM
		articles
	INNER JOIN
		users ON users.id = articles.user_id
	INNER JOIN
		category ON category.id = articles.cat_id
	WHERE
	".implodeSqlWhere($where, 'articles');

	// Return data from BD
	return getSqlStr($sql, false);
}





/**
 * Select all published categories
 */
function getAllRecords($whereMore = [], $catInfo = true, $userInfo = true, $orderBy = 'articles.view_num DESC')
{
	// Where for base sql and for count function
	$where['published'] = 'show';

	// Merge two array for where info
	$where = array_filter(array_merge($where, $whereMore));

	// Add sql part to select
	$sqlSelect = '';

	// If category information does not need to be displayed
	if ($catInfo)
		$sqlSelect .= 'category.title as cat_name, category.link as cat_link,';

	// If user information does not need to be displayed
	if ($userInfo)
		$sqlSelect .= 'users.name as user_name, users.surname as user_surname, users.link as user_link, users.avatar as user_avatar,';

	// Base sql query
	$sql = "
		SELECT
			$sqlSelect
			articles.id,
			articles.link,
			articles.title,
			articles.text_sm,
			articles.img,
			users.avatar_cache_num
		FROM
			articles
		INNER JOIN
			users ON users.id = articles.user_id
		INNER JOIN
			category ON category.id = articles.cat_id
		WHERE
			".implodeSqlWhere($where, 'articles')."
		ORDER BY ".$orderBy.setOffset();

	// Return data
	$result['list'] = getSqlStr($sql);

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd('articles', $where) : 0;

	// Return data
	return $result;
}










/**
 * Select all published categories
 */
function getAllActivityRecords($listID = false, $catInfo = true, $orderBy = 'articles.id DESC')
{
	// Base check
	if (!$listID) return;

	// Where for base sql and for count function
	$where['published'] = 'show';

	// Add sql part to select
	$sqlSelect = '';

	// If category information does not need to be displayed
	$sqlSelect .= 'category.title as cat_name, category.link as cat_link,';

	// If user information does not need to be displayed
	$sqlSelect .= 'users.name as user_name, users.surname as user_surname, users.link as user_link, users.avatar as user_avatar,';

	// Collecting the id for the request
	$whereIdIn = "articles.id IN ($listID)";

	// Base sql query
	$sql = "
		SELECT
			$sqlSelect
			articles.id,
			articles.link,
			articles.title,
			articles.text_sm,
			articles.img,
			users.avatar_cache_num
		FROM
			articles
		INNER JOIN
			users ON users.id = articles.user_id
		INNER JOIN
			category ON category.id = articles.cat_id
		WHERE
			".implodeSqlWhere($where, 'articles')." AND $whereIdIn
		ORDER BY ".$orderBy.setOffset();

	// Return data
	$result['list'] = getSqlStr($sql);

	// Sql count 
	$sql = "SELECT COUNT(id) as countData FROM articles WHERE published = 'show' AND $whereIdIn";

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? getSqlStr($sql, false)['countData'] : 0;

	// Return data
	return $result;
}




/**
 * Extract articles related to the category
 */
function getCatRecords($catId = false)
{
	// Base check
	if (!$catId) return;

	// Create array
	$where['cat_id'] = $catId;

	// Return articles array
	return getAllRecords($where, false);
}




/**
 * Extract comments related to the article
 */
function getComments($articleId = false, $perPage = PER_PAGE, $orderBy = 'comments.date_add DESC')
{
	// Base check
	if (!$articleId) return;

	// Where for base sql and for count function
	$where['published']  = 'show';
	$where['article_id'] = $articleId;

	// Base sql query
	$sql = "
		SELECT
			comments.id,
			comments.date_add,
			comments.text,
			users.name as user_name,
			users.surname as user_surname,
			users.link as user_link,
			users.avatar as user_avatar,
			users.avatar_cache_num
		FROM
			comments
		INNER JOIN
			users ON users.id = comments.user_id
		WHERE
			".implodeSqlWhere($where, 'comments')."
		ORDER BY ".$orderBy.setOffset($perPage);

	// Return data
	$result['list'] = getSqlStr($sql);

	// Count the number of records and add to the array
	$result['totalNum'] = (arrExist($result['list'])) ? countDataInBd('comments', $where) : 0;

	// Return data
	return $result;
}



/**
 * We are limiting the number of comments per article
 */
function checkCommentLimit($articleID = false, $userID = false, $maxNum = 4)
{
	// Check for missing parameters
	if (!$articleID || !$userID)
		return 'Missing required parameters';

	// Make sql query
	$sql = "SELECT COUNT(id) as count FROM comments
			WHERE article_id = $articleID AND user_id = $userID AND date_add >= ".strtotime('-2 hours');

	// Return data
	$result = getSqlStr($sql, false);

	// Four result is maximum
	return ($result['count'] >= $maxNum) ? 'The limit for sending comments has been reached. '.$maxNum.' comments per hour' : '';
}



/**
 * Check the article before adding it
 */
function checkArticleExist($articleID = false)
{
	// Checking for existence
	if (!$articleID) return 'Article ID not passed';

	// Check if the category id is in the array of published categories
	$exist = getOneRow('articles', ['id' => $articleID], 'id');

	// If we receive an unknown category id, we generate an error
	return (!arrExist($exist)) ? 'Article with this ID not found...' : '';
}




/**
 * Delete from data base
 */
function deleteItem($table = false, $delId = false)
{
	// Checking for existence
	if (!$table || !$delId) return;

	// Base sql query
	$sql = "DELETE FROM $table WHERE id = $delId";

	// Return data
	getSqlStr($sql);

	return true;
}





/**
 * For convenience, we split it into files
 */
include 'userModel.php';