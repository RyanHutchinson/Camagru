<?php

class NewPost extends Controller{
    
    public static function savePost(){

        ?>
        <script>alert('Your post has been submitted.\nPress OK to submit another!');</script>
        <?php

        self::sanitizeInput('cleanPost');

        $img = $_POST['hidden'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = 'img/' . uniqid($_SESSION['user']) . '.png';

        if(file_put_contents(ROOT . '/' . $file, $data)){

            $user_data = self::query('SELECT * FROM `users` WHERE Username=?', array($_SESSION['user']));
            $user_data = $user_data[0];

            try {
                self::query('INSERT INTO images (Userid, Imagesrc) VALUES(?,?);', array($user_data['ID'], $file));
                self::query('INSERT INTO posts (Userid, Caption, Imagesrc) VALUES(?, ?, ?)', array($user_data['ID'], $_POST['Caption'], $file));
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }else{
            echo'something went wrong...';
        }
    }
}
?>