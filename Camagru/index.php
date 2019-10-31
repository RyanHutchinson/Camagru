<?php
session_start();
require_once('./includes/routes/routes.php');

function __autoload($class) {
    if(file_exists('./includes/classes/' . $class . '.php')){
        require_once './includes/classes/' . $class . '.php';
	}else if(file_exists('./includes/controllers/' . $class . '.php')){
        require_once './includes/controllers/' . $class . '.php';
	}
};

if(!in_array($_GET['url'], Route::$valid_routes)){
    Route::setDestination('404');
}
?>