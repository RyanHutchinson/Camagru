<?php
class Profile extends Controller{
    
/******************************************************************************/
/*****************************UPDATING OF USER DATA LOGIC**********************/
/******************************************************************************/

//------------------------------------------------------------------------------//TODO: all this
    private function profileUpdate($username, $firstname, $lastname, $email, $newpassword, $currentpassword) {//error no input

        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];

        if (empty($firstname) && empty($lastname) && empty($email) && empty($newpassword) && empty($currentpassword)) {
            return ('
            <div style="padding-top:10px; color: red"> 
            <p>Nothing to update</p>
            </div>
            ');
        }else if($password !== $passwordValidator){
            return ('
            <div style="padding-top:10px; color: red"> 
            <p>* Both Password fields must match! *</p>
            </div>
            ');
        }

        // if (isset($firstname)){----------------------------------------------//TODO: continue from here.
        //     self::query('INSERT INTO users WHERE Username=? (`FirstName`)
		// 		VALUES(?)',
		// 		array($username, $firstname));
        // }
        // if (isset($firstname)){
            
        // }
        // if (isset($lastname)){
            
        // }
        // if (isset($email)){
            
        // }
        // if (isset($newpassword)){
            
        // }






    }

/******************************************************************************/
/*****************************VERIFIED USER PROFILE LOGIC**********************/
/******************************************************************************/

    private static function isVerified($username){
        
        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));//getting user data
        $user_data = $user_data[0];//-------------------------------------------//TODO: that weirdness

        /*****************printing the user info block which is editble********/
        echo'
                <div class="profileHeader container">
                    <div class="row">
                        <div class="pic col-lg-6 col-md-6 col-sm-12">
                            <div class="picWrapper">
                                <img src="' . Route::getDestination('img/profile.png') . '" alt="profile pic" height="200" width="200">
                            </div>
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

        /*****************************Printing the profile feed****************/
        echo '
                <div class="profileFeed container-fluid">
                </div>
        ';

        if ($_POST['Update'] == 'OK') {//---------------------------------------Update button pressed?
            self::sanitizeInput();//--------------------------------------------if so sanitise and update the info.
            $error =  self::profileUpdate($_SESSION['user'], $_POST['firstname'], $_POST['lastname'], $_POST['email'] ,$_POST['newpassword'], $_POST['currentpassword']);
            if (!$error){//-----------------------------------------------------all went well so lets refresh the page with new info
                header("Refresh:0");
            }else{//------------------------------------------------------------things went bad lets display an error
                echo $error;
            }
        }
    }

/******************************************************************************/
/*****************************VERIMAIL ENTRY POINT USER PROFILE LOGIC**********/
/******************************************************************************/

    private static function notVerified($username){
        
        $token = $_GET['token'];
        
        if(self::tokenChecker($username, $token)){//----------------------------does the token attached to the url matcht he token in user_data?
            self::query('UPDATE users SET Membertype=1 WHERE Username=?;', array($username));// it does so lets loggem in and set them as a verified user
            echo '<p style="font-size: 15px; padding-top: 30px">Your email has been verified!</p>
            <p>Your browser will redirect you in 3 seconds.</p>
            ';
            header("refresh:3;url=" . Route::getDestination('Profile'));
        }else{//----------------------------------------------------------------token is wrong or does not exist
            echo'<p style="font-size: 25px; padding-top: 30px">You are not verified. Please check your emails.</p>
            <p>Verification email not arrived? To re-send <a href="?resend=' . $_SESSION['user'] . '">Click Here</a></p>
            
            ';
            //echo $_GET['resend'];//TODO: not sure
        }
    }

    //*******************helper for the below **********************************
    private static function resendEmail($username){
        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];

        self::emailVerify($user_data['Email'], $user_data['Token']);

    }
    
/******************************************************************************/
/*****************************ENTRYPOINT AND VALIDATION CHECKING***************/
/******************************************************************************/

    public static function loadProfile($username){
        if(isset($_GET['resend'])){//-------------------------------------------Has the user requested a re-send of the verimail?
            echo '<p style="font-size: 15px; padding-top: 30px">Verification email re-sent!</p>';
            self::resendEmail($username);//-------------------------------------if so send it! and reload
            header("refresh:2;url=" . Route::getDestination('Profile'));
        }else if(self::verifiedUser($username)){//------------------------------if not, is the user verified?
            self::isVerified($username);//--------------------------------------ok they are... lets generate the page
        }else{
            self::notVerified($username);//-------------------------------------they are not... generate the resend page
        }
    }
}
?>