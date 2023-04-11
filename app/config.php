<?php
defined('security') or die('Access denied'); // Add light protection against file access

// Initializes session data to remember some user data
session_start();

// Attitude to errors
// error_reporting(E_ALL); //0, E_ALL

// Settings for the database
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http') {

	define('DOMAIN', 'beavers');
	define('PATH',   'http://'.DOMAIN.'/');
	define('HOST',   'localhost');
	define('USER',   'root');
	define('PASS',   'root');
	define('DB',     'beavers');

} else {

	define('DOMAIN', 'inderio.com');
	define('PATH',   'https://'.DOMAIN.'/');
	define('HOST',   'inderio.mysql.tools');
	define('USER',   'inderio_beavers');
	define('PASS',   '^)knkV46Y7');
	define('DB',     'inderio_beavers');

}

// Project name
define('PROJECTNAME', 'Beavers community');

// The way to the admin part
define('ADMINPATH', PATH.'admin/');

// Displaying a partition by default
define('DEFAULTPAGE', 'home');

// Number of results on the page
define('PER_PAGE', 2);

// Allowed file size in bytes (1 MB = 1048576 Bytes)
define('MAX_SIZE', 10485760);

// Default blank image
define('NO_IMG', 'no-img.jpg');

// Path to files where there is functionality.
// * In the admin part, add "../" in the file admin/index.php
if(!$systemOption['vendorApp'])
	$systemOption['vendorApp'] = 'app/';

// Connect the function file only once
if(!require_once($systemOption['vendorApp'].'functions.php'))
	die('functions.php not found');

// Path to the html part of the page
$systemOption['view'] = $systemOption['vendorApp'].'view/';

// Admin path to the html part of the page
$systemOption['adminView'] = 'app/view/';

// Path to the controllers
$systemOption['controller'] = 'controllers/';

// Path to the model
$systemOption['model'] = 'app/model/';

// Switch whether to load the controller or just issue a message
$systemOption['errorControllerNeed'] = true;

// If it is not found in the database at all, should display a 404 error
$systemOption['setError'] = false;

// Path to action for ajax
$systemOption['fileForAjax'] = PATH.'ajax.php';

// Displaying a partition by default or need page from GET
$systemOption['page'] = (clean($_GET['view'])) ? clean($_GET['view']) : DEFAULTPAGE;

// You can set your own picture for the social network
$systemOption['socialImage'] = 'social.jpg';

// No result info
$systemOption['noResultImg']  = 'no-result-v1.png';
$systemOption['noResultText'] = 'No results found';

// Need to add a css class to the body? To do this, we have this array entry
$systemOption['bodyCssClass'] = '';

// Switcher admin & user
$systemOption['admin'] = false;

// Breadcrumb array key => link, 
$breadcrumb = [];

// The path to the files
$filePath['css']  = 'css/';
$filePath['img']  = 'img/';
$filePath['js']   = 'js/';
$filePath['libs'] = 'libs/';

$filePath['favicon']  = $filePath['img'].'favicon/';
$filePath['category'] = $filePath['img'].'category/';
$filePath['article']  = $filePath['img'].'article/';
$filePath['user']     = $filePath['img'].'user/';


// List of links that we will have on the site
$url['home']            = PATH;
$url['view']            = PATH.'?view=';
$url['data1']           = '&data1=';
$url['data2']           = '&data2=';
$url['data3']           = '&data3=';
$url['filter']          = '&filter=';
$url['search']          = $url['view'].'search';
$url['category']        = $url['view'].'category'.$url['data1'];
$url['article']         = $url['view'].'article'.$url['data1'];
$url['article-add']     = $url['view'].'article-add';
$url['login']           = $url['view'].'login';
$url['recover']         = $url['view'].'recover';
$url['change-password'] = $url['view'].'change-password';
$url['user-logout']     = PATH.'?logout=true';
$url['user']            = $url['view'].'user';
$url['user-detail']     = $url['user'].$url['data1'];
$url['user-edit']       = $url['user'].$url['data1'].'edit';
$url['user-category']   = $url['user'].$url['data1'].'category';
$url['user-activity']   = $url['user'].$url['data1'].'activity';
$url['user-bookmark']   = $url['user'].$url['data1'].'bookmark';
$url['admin']           = $url['view'].'admin';
$url['adminType']       = $url['admin'].$url['data1'];
$url['admin-add']       = '&add=true';
$url['admin-edit']      = '&edit-id=';
$url['admin-delete']    = '&delete-id=';
$url['admin-users']     = $url['adminType'].'users';
$url['admin-articles']  = $url['adminType'].'articles';
$url['admin-category']  = $url['adminType'].'category';
$url['admin-comments']  = $url['adminType'].'comments';
$url['admin-filter']    = $url['filter'];

$url['user-email-active'] = $url['view'].'user-active';

