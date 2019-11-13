<?php
class Home extends Controller{
    
    public static function allPosts(){
        $posts = self::query('SELECT * FROM posts');
        $comments = self::query('SELECT * FROM comments');

        //TODO: turn the abovew into a single join query.... Julian

        //TODO: Manipulate that array into some html goodness.

        //TODO: Return that jank.

    }
}
?>