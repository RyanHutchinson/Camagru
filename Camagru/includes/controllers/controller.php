<?php
class Controller extends Database{

    public static function CreateView($viewname){
        require_once('./includes/views/layout/header.php');
        require_once("./includes/views/$viewname.php");
        require_once('./includes/views/layout/footer.php');
    }

    public static function bodyTest($line){

        $i = 0;
        
        while($i < 50){
            echo'<p>'.$line.'</p>';
            $i++;
        }
    }

    // FIXME:--------------Login Container Stuff--------------------------------
    public static function loginContainer($user){
        
        if($user == ''){
            echo'<a href="' . LOGIN_PATH . '">Login</a>';
        }else{
            echo'
            <a href="' . LOGOUT_PATH . '">Logout</a>
            <a href="' . PROFILE_PATH . '">' . $user . '</a>
                 ';
        }

    }
    

}
?>