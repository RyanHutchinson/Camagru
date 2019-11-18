<?php
class getPost extends Controller{
    
    public static function fetchOne(){   
        $posts = self::query('SELECT * FROM posts LIMIT 5 OFFSET ?', array($_GET['postId'] * 5), array(PDO::PARAM_INT));
        //print_r($posts);
        //TODO: All the below.
        
        if(count($posts) == 0 ){
            http_response_code(204);
            die();
        }
        
        foreach($posts as $post)
        {
            $comments = self::query('SELECT * FROM comments WHERE Postid=?', array($post['ID']), array(PDO::PARAM_INT));
          //  print_r($comments);
            ?> 
            <div class="postCard col-lg-4 col-lg-offset-4">
                <div style="text-align: center; padding-top: 10px">
                    <img src="<?php echo $post['Imagesrc'];?>" alt="a photo" style="margin-bottom: 10px">
                </div>
                <div>
                    <p style="margin-left: 15px"><b><?php echo $post['Caption'];?></b></p>
                </div>
                <div>
                    <?php
                        for($i = 0; $i < 3; $i++){
                            if($comments[$i]['Comment']){
                            ?>
                            <div>
                                <p style="margin-left: 15px"><?php echo substr($comments[0]['Comment'], 0, 100);?></p>
                                <hr>
                            </div>
                            <?php
                            }
                            if(1 == 2){//($i = 1) && ($comments[2])){
                                ?>
                                <div>
                                    <a href="www.google.com">things</a>
                                    <hr>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <div>
                    <button style="margin-bottom: 5px; margin-left: 15px" type="submit" name="postComment" id="postComment" value="OK">Comment</button>
                </div>
            </div>
            <?php
        }
    }
        
}
?>