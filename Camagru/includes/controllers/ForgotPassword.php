<?php
class ForgotPassword extends Controller{
    
    public static function sendemail($email){
    
        $user_data = self::query('SELECT * FROM users WHERE Email=?;', array($email));
        $user_data = $user_data[0];
        self::emailReset($email, $user_data['Token']);
        echo'<p>An email has been sent</p>';
    }

    public static function updatePassword($newPassword, $confirmPassword, $token){
        
        if($newPassword !== $confirmPassword){
            echo'<p>Both field must match!</p>';
        }else{

            $pwhash = password_hash($newPassword, PASSWORD_BCRYPT);

            $user_data = self::query('SELECT * FROM users WHERE Token=?;', array($token));
            $user_data = $user_data[0];
            self::query('UPDATE users SET HashedPassword=? WHERE Token=?', array($pwhash, $token));
            echo'Password Updated!';
            header("refresh:2;url=" . Route::getDestination('Login'));
        }
    }
}
?>