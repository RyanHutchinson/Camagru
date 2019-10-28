<?php

require_once('./includes/routes.php');

function __autoload($class) {
	if(file_exists('./includes/classes/' . $class . '.php')){
		require_once './includes/classes/' . $class . '.php';
	}else if(file_exists('./includes/controllers/' . $class . '.php')){
		require_once './includes/controllers/' . $class . '.php';
	}
};

//print_r(Route::$valid_routes);//-------------------Prints out the current routes stored.

?>