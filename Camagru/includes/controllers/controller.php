<?php
class Controller extends Database{

    public static function CreateView($viewname){
        require_once("./includes/views/$viewname.php");
        //self::test();
    }

    public static function test(/* put in an argument $arg or summin */){
   //     $thing = self::query('SELECT * FROM users WHERE Membertype=?;', array(2));
   //     $thing = self::query("SELECT * FROM users"/*here would be $arg as per above */);
        echo"<pre>";
        print_r($thing);//------- this is for checking raw retrieved data.
        echo"</pre>";
    }


}
?>