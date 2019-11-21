<?php

/******************************************************************************/
/********************************ROUTE SETTER & VIEW INVOKER*******************/
/******************************************************************************/

class Route{

    public static $valid_routes  = array();//-----------------------------------array to set valid routes into

    public static function set($route, $function){//----------------------------set routes as per includes/routes/routes.php which calls this function
        self::$valid_routes[] = $route;
        
        if($_GET['url'] == $route){//-------------------------------------------if the current url is in the array
            $function->__invoke();//--------------------------------------------invoke the createview function call set in the above routes.php
        }
    }

/***************pathing janky nonsense*****************************************/

    public static function setDestination($dest = ""){//------------------------function redirects the page as per the passed in route
        header("location:" . self::getDestination($dest, true));
    }

    public static function getDestination($dest = "", $full = false){//---------sets the relative path
        $tmp = explode('/', $_SERVER['REQUEST_URI']);
        $tmp[count($tmp) - 1] = $dest;
        $tmp = implode('/', $tmp);
        if ($full)
            $tmp = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $tmp;
        return $tmp;
    }
}
?>