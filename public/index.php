<?php

// Define root directory path
define('ROOT_PATH', dirname(__FILE__));
define('ROOT_DIR', '/public/');

// var_dump(date_default_timezone_get(), date('h:i:s'));

/**
 * Run Composer Autoloader
*/

use Illuminates\Application;

require_once __DIR__ . "/../vendor/autoload.php";


/**
 * run the application
 */
$application = new Application;
$application->start();

// echo "<br>";
// var_dump(date_default_timezone_get(), date('h:i:s'));
