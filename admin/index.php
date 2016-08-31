<?php 
define('APP_PATH',dirname(__FILE__).'/');
define('_THEME',APP_PATH.'include/');
define('_INCS',APP_PATH.'lib/');
//CORE
require_once ('../lib/cl.user.php');
require_once (_INCS.'check_user.php');

include ('include/navbar.php');
include ('pages/home.php');

 ?>