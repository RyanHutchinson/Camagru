<?php

class NewPost extends Controller{
    
    public static function savePost(){

        ?><script>alert('Your post has been submitted.\nPress OK to submit another!');</script><?php

		self::sanitizeInput('cleanPost');

        $img = $_POST['hidden'];
        $img = str_replace(' ', '+', $img);
        $img = str_replace('data:image/png;base64,', '', $img);
        $data = base64_decode($img);
        $img = imagecreatefromstring($img);
        file_put_contents('temp.png', $data);

        if (isset($_POST['stick-1'])){       
            
            $image_1 = imagecreatefrompng('temp.png');
            $image_2 = imagecreatefrompng('img/ufo.png');
            imagealphablending($image_1, true);
            imagesavealpha($image_1, true);
            $image_2 = imagescale($image_2, 50, 50);
            imagecopy($image_1, $image_2, 10, 10, 0, 0, 50, 50);
            imagepng($image_1, 'temp.png');
         }
         if (isset($_POST['stick-1'])){       
            
            $image_1 = imagecreatefrompng('temp.png');
            $image_2 = imagecreatefrompng('img/falling-star.png');
            imagealphablending($image_1, true);
            imagesavealpha($image_1, true);
            $image_2 = imagescale($image_2, 50, 50);
            imagecopy($image_1, $image_2, 145, 10, 0, 0, 50, 50);
            imagepng($image_1, 'temp.png');
         }
         if (isset($_POST['stick-1'])){       
            
            $image_1 = imagecreatefrompng('temp.png');
            $image_2 = imagecreatefrompng('img/mars.png');
            imagealphablending($image_1, true);
            imagesavealpha($image_1, true);
            $image_2 = imagescale($image_2, 50, 50);
            imagecopy($image_1, $image_2, 280, 10, 0, 0, 50, 50);
            imagepng($image_1, 'temp.png');
         }
        
		$file = 'img/' . uniqid($_SESSION['user']) . '.png';
		
		if(imagepng(imagecreatefrompng('temp.png'), $file)){
		             
            $user_data = self::query('SELECT * FROM `users` WHERE Username=?', array($_SESSION['user']));                
            try {
                self::query('INSERT INTO images (Userid, Imagesrc) VALUES(?,?);', array($user_data[0]['ID'], $file));
                self::query('INSERT INTO posts (Userid, Caption, Imagesrc) VALUES(?, ?, ?)', array($user_data[0]['ID'], $_POST['Caption'], $file)); //TODO:-------Caption not inserting
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }else{
            echo'something went wrong...';
        }
        unlink('temp.png');
    }
}
?>