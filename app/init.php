<?php
spl_autoload_register(function($class) {
	require_once $_SERVER['DOCUMENT_ROOT']."/app/core/{$class}.php";
});

/*require_once 'core/DataBase.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Check.php';*/
