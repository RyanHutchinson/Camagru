<?php
class Controller extends Database{

    public static function CreateView($viewname){
        require_once("./includes/views/$viewname.php");
    } 

}
?>