<?php

class Route{

    public static $valid_routes  = array();

    public static function set($route, $function){
        self::$valid_routes[] = $route;

        if($_GET['url'] == $route){
            $function->__invoke();
        }
    }

}
?>