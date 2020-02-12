<?php namespace Config;

define("ADM", "Admin");
define("User", "User");
define("ROOT", dirname(__DIR__) . "/");
//BD
define('DB_HOST', 'localhost');
define('DB_NAME', 'MoviePass');
define('DB_USER', 'root');
define('DB_PASS', '');
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass/");
define('ROOT_VIEW', '/MoviePass');
define("VIEWS_PATH", "Views/");
define("API_PATH", "Api/");
define("CONFIG_API_PATH", "Config/");
define("CSS_PATH", "/MoviePass/Views/css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", VIEWS_PATH . "img/");
define("QR_ROUTE", ROOT . "/QR");
define("QR_IMG", ROOT . "/QR/temp/");
?>




