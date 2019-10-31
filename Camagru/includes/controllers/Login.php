<?php
class Login extends Controller{

    //TODO: Fix the css in the below forms. Get it into the .css file
    private function camaLogin($username, $password) {//error no input
        if (empty($username) || empty($password)) {
            return ('
            <div style="padding-top:10px; color: red"> 
            <p>Please enter a Username & Password!</p>
            </div>
            ');
        }

        // FIXME: implement $hashp = hash('whirlpool', $password);
        $user_data = self::query('SELECT * FROM users WHERE Username=? AND HashedPassword=? AND  Membertype=?;', array($username, $password, 1));

        //echo"<script> console.log('" . json_encode($user_data) . "')</script>";// FIXME: Remove me

        if ($user_data){//Setting session
            $_SESSION['user'] = $username;
        }else{//Error incorrect input
            return ('
            <div style="padding-top:10px; color: red">
            <p>Invalid login credentials!</p>
            </div>
            ');
        }
    }

    public static function loginForm(){
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
            echo '<p>You are logged in!</p>';
            header("refresh:3;url=" . Route::getDestination());
        }else{
            echo '
            <form method="POST" class="loginForm">
                <div>
                <input type="text" placeholder="Username" name="user">
                </div>
                <div>
                <input type="password" placeholder="Password" name="passwd">
                </div>
                <button type="submit" name="login" value="OK">Login</button>
            </form>
            <div style="padding-top: 25px">
                <div>
                    <span>Not registered?</span>
                </div>
                <div class="registerRedirect">
                    <a href="' . Route::getDestination("Register", true) . '">Sign Up</a>  
                </div>
            </div>
            ';
            if ($_POST['login'] == 'OK') {
                $error =  self::camaLogin($_POST['user'], $_POST['passwd']);
                if (!$error){
                    header("Refresh:0");//120");
                }else{
                    echo $error;
                }
            }
            if ($_SESSION['user'] == 'admin')
                header("Location: HOME_PATH");
        }
    }
}      
?>