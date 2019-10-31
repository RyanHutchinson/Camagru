<?php
class Register extends Controller{
    
 //TODO: Fix the css in the below forms. Get it into the .css file
 private function camaRegister($username, $firstname, $lastname, $email, $password, $passwordValidator) {//error no input
    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordValidator)) {
        return ('
        <div style="padding-top:10px; color: red"> 
        <p>* All fields must be filled in!! *</p>
        </div>
        ');
    }else if($password !== $passwordValidator){
        return ('
        <div style="padding-top:10px; color: red"> 
        <p>* Both Password fields must match! *</p>
        </div>
        ');
    }

    // FIXME: implement $hashp = hash('whirlpool', $password);
    $user_data = self::query('SELECT * FROM users WHERE Username=? OR Email=?;', array($username, $email));
    $user_data = $user_data[0];
    
    if (!strcmp($user_data['Email'], $email)){//Checking email conflict
        return ('
        <div style="padding-top:10px; color: red">
        <p>email address already in use!</p>
        </div>
        ');
    }else if(!strcmp($user_data['Username'], $username)){//checking user conflict
        return ('
        <div style="padding-top:10px; color: red">
        <p>* email address already in use! *</p>
        </div>
        ');
    }else{//no conflict - inserting new user
        
        self::query('INSERT INTO `users` (`Username`, `FirstName`, `LastName`, `Email`, `HashedPassword`, `Membertype`)
        VALUES(?, ?, ?, ?, ?, ?)',
        array($username, $firstname, $lastname, $email, $password, 1));
        $_SESSION['user'] = $username;//TODO: not sure if this must remain.
    }
}

public static function registerForm(){
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
        echo '<p>You have been registered!</p>
              <p>A verification email has been sent.</p>
              <p>This page will redirect in 10 seconds.</p>
              ';
        header("refresh:10;url=" . Route::getDestination('Profile'));
    }else{
        echo '
        <form method="POST" class="registerForm">
            <div style="padding-bottom: 10px">
                <input type="text" placeholder="Username" name="username">
            </div>
            <div>
                <input type="text" placeholder="First Name" name="firstname">
            </div>
            <div>
                <input type="text" placeholder="Last Name" name="lastname">
            </div>
            <div style="padding-top: 10px">
                <input type="email" placeholder="email" name="email">
            </div>
            <div style="padding-top: 10px">
                <input type="password" placeholder="Password" name="password">
            </div>
            <div>
                <input type="password" placeholder="Re-enter Password" name="passwordValidator">
            </div>
            <button type="submit" name="register" value="OK">Register</button>
        </form>
        <div style="padding-top: 25px">
            <div>
                <span>Already have an account?</span>
            </div>
            <div class="registerRedirect">
                <a href="' . Route::getDestination("Login", true) . '">Login</a>  
            </div>
        </div>
        ';
        if ($_POST['register'] == 'OK') {
            $error =  self::camaRegister($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'] ,$_POST['password'], $_POST['passwordValidator']);
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



    //TODO: Everything down here

    // function ft_register($username, $password, $path) {
    //     session_start();
    //     if ($username == '' || $password == '') { //error no input
    //         return '<p align="center">Please enter a Username & Password!</p><p class="redirect" align="center">If you are not redirected please click <a href="./index.php">HERE</a></p>';
    //     }
    //     if (!file_exists("$path/Resources/database"))
    //         mkdir("$path/Resources/database");
    //     if (file_exists("$path/Resources/database/users"))
    //     {
    //         $user_data = unserialize(file_get_contents("$path/Resources/database/users"));
    //         foreach ($user_data as $user)
    //         {
    //             if ($user['user'] === $username) { //error Username taken
    //                 return '<p align="center">Username taken!!</p><p class="redirect" align="center">If you are not redirected please click <a href="./index.php">HERE</a></p>';
    //             }
    //         }
    //     }
    //     $new['user'] = $username;
    //     $new['passwd'] = hash('whirlpool', $password);
    //     $user_data[] = $new;
    //     file_put_contents("$path/Resources/database/users", serialize($user_data));
    //     $_SESSION['user'] = $username;
    // }



}
?>