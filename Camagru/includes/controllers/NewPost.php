<?php
class NewPost extends Controller{
    
    public static function savePost(){

        $img = $_POST['hidden'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = '/img/' . uniqid($_SESSION['user']) . '.png';
        
        if(file_put_contents(ROOT . $file, $data)){

            $user_data = self::query('SELECT * FROM `users` WHERE Username=?', array($_SESSION['user']));
            $user_data = $user_data[0];

            /* TODO: LEARN THIS
            SELECT posts.Imagesrc as location, comments.Comment as title, users.Username as Name from posts
            join users on posts.Userid = users.ID
            JOIN comments on comments.Userid = users.ID and comments.Postid = posts.ID
            WHERE users.ID = 4
            */

            try {
                self::query('INSERT INTO `images` (`Userid`, `Imagesrc`) VALUES(?,?);', array($user_data['ID'], $file));
                self::query('INSERT INTO `posts` (`Userid`, `Imagesrc`) VALUES(?, ?)', array($user_data['ID'], $file));
                self::query('INSERT INTO comments (Userid, Postid, Comment) VALUES (?, (SELECT p.ID from posts as p where p.Userid = ? ORDER BY p.ID DESC limit 1), ?)', array($user_data['ID'], $user_data['ID'], $_POST['comment']));
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
                        
        
        }else{
            echo'something went wrong...';
        }
    }

    public static function loadJavaScript(){
        ?>
            <script>
            // Grab elements, create settings, etc.
            var video = document.getElementById('video');

            // Get access to the camera!
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    //video.src = window.URL.createObjectURL(stream);
                    video.srcObject = stream;
                    video.play();
                });
            }
            // Elements for taking the snapshot
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            // Trigger photo take
            document.getElementById("snap").addEventListener("click", function() {
                context.drawImage(video, 0, 0, 340, 260);
            });

            // Element for Uploading to canvas
            var imageLoader = document.getElementById('imageLoader');

            // Function to diplay the image on canvas
            imageLoader.addEventListener('change', handleImage, false);
            
            function handleImage(e){
                var reader = new FileReader();
                reader.onload = function(event){
                    var img = new Image();
                    img.onload = function(){
                        context.drawImage(img,0,0, 340, 260);
                    }
                    img.src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);     
            }

            document.getElementById('post').addEventListener('click', function(e){
                document.getElementById('hidden').value = canvas.toDataURL('image/png');
            });
            
            </script>
        <?php
    }

}
?>