<?php
class Profile extends Controller{
    
//-----------------------Verified user logic------------------------------------

//TODO: all this commented shit
// private function profileUpdate($username, $firstname, $lastname, $email, $newpassword, $currentpassword) {//error no input

//     $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
//     $user_data = $user_data[0];

//     if (empty($firstname) && empty($lastname) && empty($email) && empty($newpassword) && empty($currentpassword)) {
//         return ('
//         <div style="padding-top:10px; color: red"> 
//         <p>Nothing to update</p>
//         </div>
//         ');
//     }else if($password !== $passwordValidator){
//         return ('
//         <div style="padding-top:10px; color: red"> 
//         <p>* Both Password fields must match! *</p>
//         </div>
//         ');
//     }


// }

private static function isVerified($username){
    $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
    $user_data = $user_data[0];
    //TODO: Profile picture
    echo'
            <div class="profileHeader container">
                <div class="row">
                    <div class="pic col-lg-6 col-md-6 col-sm-12">
                        <div class="pic-standin">This will become a picture</div>
                    </div>
                    <div class="infowrapper col-lg-6 col-md-6 col-sm-12">
                        <div class="form">
                                <form method="POST" class="profileForm">
                                <div style="padding-bottom: 10px; font-size: 30px; text-align: center">
                                    <p>' . $user_data['Username'] . '</p>
                                </div>
                                <div>
                                    <input type="text" placeholder="' . $user_data['FirstName'] . '" name="firstname ">
                                </div>
                                <div>
                                    <input type="text" placeholder="' . $user_data['LastName'] . '" name="lastname">
                                </div>
                                <div style="padding-top: 10px">
                                    <input type="email" placeholder="' . $user_data['Email'] . '" name="email">
                                </div>
                                <div style="padding-top: 10px">
                                    <input type="password" placeholder="New Password" name="newpassword">
                                </div>
                                <div>
                                    <input type="password" placeholder="Current Password" name="currentpassword">
                                </div>
                                <button type="submit" name="Update" value="OK">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    ';
    echo '
            <div class="profileFeed container-fluid">
            </div>
    ';
    if ($_POST['Update'] == 'OK') {
        $error =  self::profileUpdate($_SESSION['user'], $_POST['firstname'], $_POST['lastname'], $_POST['email'] ,$_POST['newpassword'], $_POST['currentpassword']);
        if (!$error){
            header("Refresh:0");
        }else{
            echo $error;
        }
    }
}

//------------------------non-verified user logic-------------------------------
    private static function notVerified($username){
        
        $token = $_GET['token'];
        
        if(self::tokenChecker($username, $token)){
            self::query('UPDATE users SET Membertype=1 WHERE Username=?;', array($username));
            echo '<p style="font-size: 15px; padding-top: 30px">Your email has been verified!</p>
            <p>Your browser will redirect you in 3 seconds.</p>
            ';
            header("refresh:3;url=" . Route::getDestination('Profile'));
        }else{
            echo'<p style="font-size: 25px; padding-top: 30px">You are not verified. Please check your emails.</p>
            <p>Verification email not arrived? To re-send <a href="?resend=' . $_SESSION['user'] . '">Click Here</a></p>
            
            ';
            echo $_GET['resend'];
        }
    }

//---------------------------------helpers--------------------------------------
    private static function resendEmail($username){
        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];

        self::emailVerify($user_data['Email'], $user_data['Token']);

    }
    
//---------------------------ENTRY POINT----------------------------------------
    public static function loadProfile($username){
        if(isset($_GET['resend'])){
            echo '<p style="font-size: 15px; padding-top: 30px">Verification email re-sent!</p>';
            self::resendEmail($username);
            header("refresh:2;url=" . Route::getDestination('Profile'));
        }else if(self::verifiedUser($username)){
            self::isVerified($username);
        }else{
            self::notVerified($username);
        }
    }
}
?>