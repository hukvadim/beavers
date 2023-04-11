<?php
defined('security') or die('Access denied'); // Add light protection against file access


/**
 * Connecting to the database
 */
function connect_db($type = 'PDO') {
	try {
		// Connecting
		$handler = new PDO('mysql:host='.HOST.';dbname='.DB.'; charset=utf8', USER, PASS);

		// Returning the connection
		$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Return connection
		return $handler;

	// View error connection
	} catch(PDOException $e) { die('Connection failed: ' . $e->getMessage()); }
}




/**
 * Database prepare query function
 */
function getSql($table = false, $where = false, $fields = '*', $sqlEnd = '')
{
	// Checking for the existence of a table value
	if (!$table)
		exit('The table name parameter is not passed');

	// // Checking for the existence of array where 
	// if (!arrExist($where))
	// 	exit('Array $where is empty');

	// BD connection
	$db = connect_db();

	// Build the query
	$query = 'SELECT ' . $fields . ' FROM ' . $table . ' ';

	// Array for filling parameters
	$params = array();

	// Go through the parameters and generate values for the sql query and an array of values
	if (arrExist($where)) {

		// Set more sql query
		$query .= 'WHERE ';

		// Write sql where
		foreach ($where as $field => $value) {
			$query .= $field . ' = ? AND ';
			$params[] = $value;
		}
	}

	// Add a place for values to the query
	$query = rtrim($query, ' AND ');

	// Add the ability to add something to the request
	if($sqlEnd)
		$query .= ' '.$sqlEnd;

	// Prepare the statement
	$stmt = $db->prepare($query);

	// Bind the parameters
	foreach ($params as $key => $value)
		$stmt->bindValue($key + 1, $value);

	// Execute the statement
	$stmt->execute();

	// Check for errors
	if ($stmt->errorCode() != '00000') {
		$errorInfo = $stmt->errorInfo();
		exit('Query failed: ' . $errorInfo[2] . '<br>' . $query);
	}

	// Return prepare connection
	return $stmt;
}




/**
 * Execute sql query
 */
function getSqlStr($query = false, $fetchAll = true)
{
	// Base check
	if(!$query) return;

	// BD connection
	$db = connect_db();

	// Trying to fulfil the request
	try {
		$stmt = $db->prepare($query);
		$stmt->execute();
	} catch (PDOException $e) { die('Query failed: ' . $e->getMessage() . "<br>". $query); }

	// Counting the number of records
	$rowCount = $stmt->rowCount();

	// By condition, we return one or all of them
	if($rowCount >= 1 and !$fetchAll) return $stmt->fetch(PDO::FETCH_ASSOC);
	elseif($rowCount > 1 || $fetchAll) return $stmt->fetchAll(PDO::FETCH_ASSOC);
}