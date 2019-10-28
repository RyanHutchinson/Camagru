<?php
class Controller extends Database{

    public static function CreateView($viewname){
        require_once("./includes/views/$viewname.php");
        self::test();
    }

    public static function test(){
        $thing = self::query("SELECT * FROM users"); //------------------------okok I am getting it
        //print_r($thing);
        print_r();
    }

}
?>