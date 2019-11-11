<?php
class Profile extends Controller{
    
    /******************************************************************************/
    /*****************************UPDATING OF USER DATA LOGIC**********************/
    /******************************************************************************/
    
    //------------------------------------------------------------------------------//TODO: all this
    private function profileUpdate($username, $firstname, $lastname, $email, $newpassword, $currentpassword, $notifications) {
        
        /*************************grabbing user data***************************/
        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));
        $user_data = $user_data[0];
        
  
        
        /*************************checking for empties*************************/
        if (empty($firstname) && empty($lastname) && empty($email) && empty($newpassword) && empty($currentpassword) && ($notifications == $user_data['Notifications'])) {//input?
            return ('
            <div style="padding-top:30px; color: red; padding-left: 40px; font-size: 13px"> 
            <p>* Nothing to update *</p>
            </div>
            ');
         }

        /*************************updating data********************************/
        if (!empty($firstname)){
            self::query('UPDATE users SET FirstName=\'' . $firstname . '\' WHERE Username=\'' . $username . '\'');
        }
        if (!empty($lastname)){
            self::query('UPDATE users SET LastName=\'' . $lastname . '\' WHERE Username=\'' . $username . '\'');
        }
        if (!empty($email)){
            self::query('UPDATE users SET Email=\'' . $email . '\' WHERE Username=\'' . $username . '\'');
        }
        if($notifications != $user_data['Notifications']){
            if(empty($notifications)){
                self::query('UPDATE users SET Notifications=NULL WHERE Username=\'' . $username . '\'');
            }else if (!empty($notifications)){
                self::query('UPDATE users SET Notifications=1 WHERE Username=\'' . $username . '\'');
            }
        }
        if (!empty($newpassword)){
            if(empty($newpassword) || empty($currentpassword)){
                return ('
                        <div style="padding-top:30px; color: red; padding-left: 40px; font-size: 13px"> 
                        <p>* Both password fields must be filled! *</p>
                        </div>
                        ');
            }

            if(password_verify($currentpassword, $user_data['HashedPassword'])){
                $newpassword = password_hash($newpassword, PASSWORD_BCRYPT);
                self::query('UPDATE users SET HashedPassword=\'' . $newpassword . '\' WHERE Username=\'' . $username . '\'');
            }else{
                return ('
                        <div style="padding-top:30px; color: red; padding-left: 40px; font-size: 13px"> 
                        <p>* Please check password fields *</p>
                        </div>
                        ');
            }
        }
        echo'<script>alert(\'Details Updated :)\')</script>';
        }

/******************************************************************************/
/*****************************VERIFIED USER PROFILE LOGIC**********************/
/******************************************************************************/

    private static function isVerified($username){
        
        $user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));//getting user data
        $user_data = $user_data[0];//-------------------------------------------//TODO: that weirdness

        function checked($state){
            if($state){
                return('checked');
            }
        }

        /*****************printing the user info block which is editble********/
        echo'
                <div class="profileHeader container">
                    <div class="row form">
                        <div class="pic col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="picWrapper">
                                <img src="' . Route::getDestination('img/profile.png') . '" alt="profile pic" height="200" width="200">
                            </div>
                        </div>
                        <form method="POST" class="profileForm col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div style="padding-bottom: 10px; font-size: 30px; padding-left: 10px">
                                <p>' . $user_data['Username'] . '</p>
                            </div>
                            <div class="formInput">
                                <input type="text" placeholder="' . $user_data['FirstName'] . '" name="firstname">
                            </div>
                            <div class="formInput">
                                <input type="text" placeholder="' . $user_data['LastName'] . '" name="lastname">
                            </div>
                            <div class="formInput" style="padding-top: 10px">
                                <input type="email" placeholder="' . $user_data['Email'] . '" name="email">
                            </div>
                            <div class="formInput" style="padding-top: 10px">
                                <input title="1 Uppercase, 1 Lowercase, 1 Number, 1 Special Character...i.e. (!@#$%^&*)" type="password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="New Password" name="newpassword">
                            </div>
                            <div class="formInput">
                                <input title="1 Uppercase, 1 Lowercase, 1 Number, 1 Special Character...i.e. (!@#$%^&*)" type="password" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Current Password" name="currentpassword">
                            </div>
                            <div>
                                <input type="checkbox" name="checked" value="1" ' . checked($user_data['Notifications']) . '>
                                <span style="font-size: 11px">Send me email notifications</span>
                            </div>
                                <button type="submit" name="Update" value="OK">Update</button>
                                <button type="submit" name="NewPost" value="OK">New Post</button>
                                ';
                                
                                if ($_POST['Update'] == 'OK') {//---------------------------------------Update button pressed?
                                    self::sanitizeInput();//--------------------------------------------if so sanitise and update the info.
                                    $error = self::profileUpdate($_SESSION['user'], $_POST['firstname'], $_POST['lastname'], $_POST['email'] ,$_POST['newpassword'], $_POST['currentpassword'], $_POST['checked']);
                                    if (!$error){//-----------------------------------------------------all went well so lets refresh the page with new info
                                        header("Refresh: 0");
                                    }else{//------------------------------------------------------------things went bad lets display an error
                                        echo $error;
                                    }
                                }elseif($_POST['NewPost'] == 'OK'){
                                    header("refresh:0;url=" . Route::getDestination('NewPost'));
                                }
                                //----------------------------------------------------------------------don't judge me please... this is super janky layout but I need that
echo'
                            </div>
                        </form>
                    </div>
                    <hr>
                    ';

        /*****************************Printing the profile feed****************/


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
            header("refresh:0;url=" . Route::getDestination('Profile'));
        }else if(self::verifiedUser($username)){//------------------------------if not, is the user verified?
            self::isVerified($username);//--------------------------------------ok they are... lets generate the page
        }else{
            self::notVerified($username);//-------------------------------------they are not... generate the resend page
        }
    }
}
?>