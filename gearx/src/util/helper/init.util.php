<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once __DIR__ . '/../../../vendor/autoload.php';


$auth = '';

if (isset($_SESSION['auth'])) {
  $auth = $_SESSION['auth'];
}


$layout   = __DIR__ . '/../../view/layout/';
$lang     = __DIR__ . '/../../util/languages/';
$func     = __DIR__ . '/../../util/functions/';
$icons    = '/assets/icons';
$css      = '/assets/css/';
$js       = '/assets/js/';
define('IMAGES', '/assets/images/');

// NOTE: MVC
define('MODEL', __DIR__ . '/../../model/');
define('VIEW', __DIR__ . '/../../view/');
define('CTRL', __DIR__ . '/../../controller/');
define('REPO', __DIR__ . '/../../repo/');
define('ROUTE', __DIR__ . '/../../route/');
define('DTO', __DIR__ . '/../../dto/');
define('UTIL', __DIR__ . '/../../util/');
define('DB', __DIR__ . '/../../util/db/db.util.php');

include $func . 'functions.php';
include $lang . 'english.php';
include $layout . 'header.php';
