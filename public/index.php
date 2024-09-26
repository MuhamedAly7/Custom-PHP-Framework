<?php
// Define root directory path
define('ROOT_PATH', dirname(__FILE__));
define('ROOT_DIR', '/public/');


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