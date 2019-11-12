<?php
    include("database.php");

    function executeSQL($SQLstatement, $error, $conn){
        try{
            $db = $conn->prepare($SQLstatement);
            $db->execute();
        }catch(PDOException $e){
            echo "\033[01;31m " . $error . " has failed: \"" . $e->getMessage() . "\" \033[0m \n";
            usleep(300000);
        }finally{
            if(!$e){
                echo "\033[01;32m " . $error . " successful!\033[0m \n";
                usleep(300000);
            }
        }
    }

    
    executeSQL($create_database, "Creation of database", $conn);
    executeSQL($create_user_table, "Creation of users table", $conn);
    executeSQL($create_post_table, "Creation of posts table", $conn);
    executeSQL($create_comment_table, "Creation of comments table", $conn);
    executeSQL($create_image_table, "Creation of image table", $conn);//
    executeSQL($add_test_users, "Insertion of test users", $conn);
    executeSQL($add_test_posts, "Insertion of test posts", $conn);
    executeSQL($add_test_comments, "Insertion of test comments", $conn);
    executeSQL($add_test_images, "Insertion of test images", $conn);
?>