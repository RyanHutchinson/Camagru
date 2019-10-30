<?php
class Login extends Controller{

    private function cama_login($username, $password) {
        if (empty($username) || empty($password)) {//error no input
            return ('
            <div style="padding-top:10px; color: red">
            <p>Please enter a Username & Password!</p>
            </div>
            ');
        }

        // FIXME: implement $hashp = hash('whirlpool', $password);
        $user_data = self::query('SELECT * FROM users WHERE Username=? AND HashedPassword=? AND  Membertype=?;', array($username, $password, 1));

        echo"<script> console.log('" . json_encode($user_data) . "')</script>";// FIXME: Remove me

        if ($user_data){
            $_SESSION['user'] = $username;
        }else{
            return ('
            <div style="padding-top:10px; color: red">
            <p>Invalid Username & Password!</p>
            </div>
            ');
        }
    }

    public static function loginForm(){
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
            echo '<p>You are logged in!</p>';
            header("refresh:3;url=http://localhost:8080/camagru/Camagru/");//FIXME pathing
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
                <div>
                    <a href="http://localhost:8080/camagru/Camagru/Register">Register here</a>  
                </div>
            </div>
            ';
            if ($_POST['login'] == 'OK') {
                $error =  self::cama_login($_POST['user'], $_POST['passwd']);
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