<?php

require_once('./includes/routes.php');

function __autoload($class) {
	if(file_exists('./includes/classes/' . $class . '.php')){
		require_once './includes/classes/' . $class . '.php';
	}else if(file_exists('./includes/controllers/' . $class . '.php')){
		require_once './includes/controllers/' . $class . '.php';
	}
};

 if(!in_array($_GET['url'], Route::$valid_routes)){
	 header("location: http://localhost:8080/camagru/Camagru/404");
 }

//print_r(Route::$valid_routes);//-------------------Prints out the current routes stored.

?>