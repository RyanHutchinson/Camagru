<?php

class Route{

    public static $valid_routes  = array();

    public static function set($route, $function){
        self::$valid_routes[] = $route;

        if($_GET['url'] == $route){
            $function->__invoke();
        }
    }

    public static function setDestination($dest = ""){ //TODO: Remove me if not used
        $tmp = self::getDestination($dest);
        header("location:" . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $tmp);
    }

    public static function getDestination($dest = ""){
        $tmp = explode('/', $_SERVER['REQUEST_URI']);
        $tmp[count($tmp) - 1] = $dest;
        $tmp = implode('/', $tmp);
        return $tmp;
    }

}
?>