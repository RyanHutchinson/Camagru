<?php
class Controller extends Database{

    public static function CreateView($viewname){
        require_once('./includes/views/layout/header.php');
        require_once("./includes/views/$viewname.php");
        require_once('./includes/views/layout/footer.php');
    }
    /***************************************************************************
    **************************Login Container***********************************
    ***************************************************************************/
    public static function loginContainer($user){
        
        if($user == ''){
            echo'<a href="' . LOGIN_PATH . '">Login</a>';
        }else{
            echo'
            <a href="' . LOGOUT_PATH . '">Logout</a>
            <a href="' . PROFILE_PATH . '" style="font-size: 15px">Welcom ' . $user . '</a>
            ';
        }
    }

    /***************************************************************************
    **************************Verified User*************************************
    ***************************************************************************/

    public static function verifiedUser($username){

        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];

        if($user_data['Membertype'] == 1){
            return(1);
        }else{
            return;
        }
    }

    //---------------------input sanitization-----------------------------------

    public static function sanitizeInput(){

        foreach($_POST as $key => $value){
            if($key == 'username' || $key == 'firstname' || $key == 'lastname'){
                $_POST[$key] = htmlEntities($_POST[$key], ENT_QUOTES);
            }
        }
    }

    //---------------------tokens-----------------------------------------------

    public static function tokeniser(){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()';
        $str = str_shuffle($str);
        return(substr($str, 0, 10));
    }

    public static function tokenChecker($username, $token){

        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];

        if(strcmp($user_data['Token'], $token)){
            return;
        }else{
            return(1);
        }
    }


    //---------------------verification email sender----------------------------

    public static function emailVerify($email, $token){

        $to = $email;
        $subject = 'Camagru verification email';
        $message = '
        <html>
        <head>
        <title>Email Verification</title>
        </head>
        <body>
        <p>Please click the link below to verify your email address</p>
        <a href="http://localhost:8080/camagru/Camagru/Profile?token=' . $token . '">Click Here</a>
        </body>
        </html>
        ';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = "From: rhutchin@student.wethinkcode.co.za" . "\r\n";

        $headers = implode("\r\n", $headers);
        $error = mail($to, $subject, $message, $headers);

        if ($error){
            return;
        }else{
            return('
            <div style="padding-top:10px; color: red">
            <p>Failed to send email to</p>
            <p>*' . $email . '*</p>
            <p>with token</p>
            <p>*' . $token . '*</p>
            </div>
            ');
        }
    }
}





        //echo"<script> console.log('" . json_encode($user_data) . "')</script>";// FIXME: Remove me

?>