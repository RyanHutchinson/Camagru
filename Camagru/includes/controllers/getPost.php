 <?php
class getPost extends Controller{
    
    public static function fetchOne(){   
        $posts = self::query('SELECT * FROM posts LIMIT 5 OFFSET ?', array($_GET['postId'] * 5), array(PDO::PARAM_INT));
        
        if(count($posts) == 0 ){
            http_response_code(204);
            die();
        }
        
        foreach($posts as $post)
        {
            $comments = self::query('SELECT * FROM comments WHERE Postid=?', array($post['ID']), array(PDO::PARAM_INT));
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
                        for($i = 0; $i < 2; $i++){
                            if($comments[$i]['Comment']){
                            ?>
                            <div>
                                <p style="margin-left: 15px; margin-right: 15px; margin-bottom: 0px; font-size: 10px"><?php echo substr($comments[$i]['Comment'], 0, 100);?></p>
                                <hr style="margin-top: 4px; margin-bottom: 4px">
                            </div>
                            <?php
                            }
                            if(($i == 1) && (isset($comments[2]))){
                                ?>
                                <div>
                                    <p style="margin-left: 120px; margin-right: 15px; margin-bottom: 0px; font-size: 10px">Click below to see more</p>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <div>
                    <button onclick="postRedirect(<?php echo $post['ID'];?>)" id="postView">View More</button>
                </div>
                </div>
                <?php
        }
    }
    
}
?>