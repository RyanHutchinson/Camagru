<?php
class Post extends Controller{
    
    public static function addLike(){
        try
        {
            $likes = self::query('SELECT * FROM Posts where ID=?', array($_POST['postID']), array(PDO::PARAM_INT));
            $like = $likes[0]['Likes'] + 1;
            $arr = array($like, $_POST['postID']);
            self::query('UPDATE posts SET Likes=? WHERE ID=?;', $arr);//, array(PDO::PARAM_INT, PDO::PARAM_INT));
            echo "Likes " . $like;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public static function saveComment($newComment, $postID){
        $userdata = self::query('SELECT * FROM users WHERE Username=?', array($_SESSION['user']));
        $userID = $userdata[0]['ID'];
        self::query('INSERT INTO Comments (Postid, Userid, Comment) VALUES(?, ?, ?)', array($postID, $userID, $newComment));
        header('refresh:0');
    }

    public static function getPost($postID){
        
        $post = self::query('SELECT * FROM posts WHERE ID=?',(array($postID)));
        $post = $post[0];

        $comments = self::query('SELECT * FROM comments WHERE Postid=?', array($postID));

//       echo'<script>console.log(' . print_r($comments) . ');</script>';

        ?>
        <div class="postCard col-lg-4 col-lg-offset-4" style="margin-top: 10px">
                <div style="text-align: center; padding-top: 10px">
                    <img src="<?php echo $post['Imagesrc'];?>" alt="a photo" style="margin-bottom: 10px">
                </div>
                <div style="text-align: center">
                    <button id="likeButton" onclick="addLike(<?php echo $post['ID'];?>)">Likes <?php echo $post['Likes'];?></button>
                    <p style="margin-left: 15px"><b><?php echo $post['Caption'];?></b></p>
                </div>
                <div>
                    <?php
                        for($i = 0; $i < 500; $i++){
                            if($comments[$i]['Comment']){
                            ?>
                            <div>
                                <p style="margin-left: 15px; margin-right: 15px; margin-bottom: 0px; font-size: 10px"><?php echo $comments[$i]['Comment'];?></p>
                                <hr style="margin-top: 4px; margin-bottom: 4px">
                            </div>
                            <?php
                            }
                        }
                        ?>
                        <div style="text-align: center">
                            <form method="post">
                                <textarea name="Caption" rows="2" cols="45" maxlength="250" placeholder="Comment of 100 characters..."></textarea>
                                <button type="submit" name="newComment" id="post" value="OK">Post</button>
                                <?php if(isset($_POST['newComment'])){self::saveComment($_POST['Caption'], $postID);}?>
                            </form>
                        </div>
                </div>
            </div>
        <?php
    }   
}
?>