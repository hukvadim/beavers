<?php
	define('security', TRUE); // Add light protection against file access

	// Connect the config file
	include 'app/config.php';

	// Connect the base controller
	include 'app/baseController.php';


	/**
	 * View html
	 */

	// HTML head
	include $systemOption['view'].'system--head.php';

	// Switch the page
	include $systemOption['view'].'page--'.$systemOption['page'].'.php';

	// HTML footer
	include $systemOption['view'].'system--footer.php';
	