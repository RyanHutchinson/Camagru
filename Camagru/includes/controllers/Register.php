<?php
class Register extends Controller{
    
    //TODO: Everything down here

    function ft_register($username, $password, $path) {
        session_start();
        if ($username == '' || $password == '') { //error no input
            return '<p align="center">Please enter a Username & Password!</p><p class="redirect" align="center">If you are not redirected please click <a href="./index.php">HERE</a></p>';
        }
        if (!file_exists("$path/Resources/database"))
            mkdir("$path/Resources/database");
        if (file_exists("$path/Resources/database/users"))
        {
            $user_data = unserialize(file_get_contents("$path/Resources/database/users"));
            foreach ($user_data as $user)
            {
                if ($user['user'] === $username) { //error Username taken
                    return '<p align="center">Username taken!!</p><p class="redirect" align="center">If you are not redirected please click <a href="./index.php">HERE</a></p>';
                }
            }
        }
        $new['user'] = $username;
        $new['passwd'] = hash('whirlpool', $password);
        $user_data[] = $new;
        file_put_contents("$path/Resources/database/users", serialize($user_data));
        $_SESSION['user'] = $username;
    }



}
?>