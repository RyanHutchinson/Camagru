 <?php
class getPost extends Controller{
    
    public static function fetchOne(){

        if(isset($_POST['method'])){//------------------for some reason this needs to be here or everything breaks.
            self::query('DELETE FROM posts WHERE ID=?', array($_POST['postID']), array(PDO::PARAM_INT));
            echo 'Deleted';
            die();
        }

        if($_GET['Location'] == '/camagru/Camagru/Profile'){
            $userid = self::query('SELECT * From users WHERE Username=?', array($_SESSION['user']));
            $posts = self::query('SELECT * FROM posts WHERE UserID=? LIMIT 5', array($userid[0]['ID']),  array(PDO::PARAM_INT));    
        }else{
            $posts = self::query('SELECT * FROM posts LIMIT 5 OFFSET ?', array($_GET['postId'] * 5), array(PDO::PARAM_INT));
        }
        
        if(count($posts) == 0 ){
            http_response_code(204);
            die();
        }
        
        foreach($posts as $post)
        {
            $comments = self::query('SELECT * FROM comments WHERE Postid=?', array($post['ID']), array(PDO::PARAM_INT));
            ?> 
                <div class="postCard col-lg-4 col-lg-offset-1">
                    <div style="text-align: center; padding-top: 10px">
                        <img src="<?php echo $post['Imagesrc'];?>" alt="a photo" style="margin-bottom: 10px">
                    </div>
                    <div>
                        <p style="margin-left: 15px"><b><?php echo $post['Caption'];?></b></p>
                    </div>
                    <div>
                        <?php
                            for($i = 0; $i < 4; $i++){
                                if($comments[$i]['Comment']){
                                ?>
                                <div>
                                    <p style="margin-left: 15px; margin-right: 15px; margin-bottom: 0px; font-size: 10px"><?php $str = substr($comments[$i]['Comment'], 0, 50); if(strlen($str) == 50){echo $str . '...';}else{echo $str;}?></p>
                                    <hr style="margin-top: 4px; margin-bottom: 4px">
                                </div>
                                <?php
                                }
                                
                            }
                        ?>
                    </div>
                    <?php if($_GET['Location'] != '/camagru/Camagru/Profile') :?>
                    <div style="text-align: center">
                        <button onclick="postRedirect(<?php echo $post['ID'];?>)" id="postView">View More</button>
                    </div>
                    <?php else :?>
                    <div style="text-align: center">
                                <button onclick="makethedeletefornowremovemelater(<?php echo $post['ID'];?>)" name="deletePost" id="deletePost" value="OK">Delete post</button>
                    </div>
                    <?php endif?>
                </div>
            <?php
        }
    }
}
?>