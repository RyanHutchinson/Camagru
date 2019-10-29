<?php
    include("database.php");

    function executeSQL($SQLstatement, $error, $conn){
        try{
            $db = $conn->prepare($SQLstatement);
            $db->execute();
        }catch(PDOException $e){
            echo $error . " has failed: " . $e->getMessage() . "<br />\n";
        }
    }

    executeSQL($create_database, "Creation of database", $conn);
    executeSQL($create_user_table, "Creation of users table", $conn);
    executeSQL($create_post_table, "Creation of posts table", $conn);
    executeSQL($create_comment_table, "Creation of comments table", $conn);
    executeSQL($add_test_users, "Insertion of test users", $conn);
    executeSQL($add_test_posts, "Insertion of test posts", $conn);
    executeSQL($add_test_comments, "Insertion of test comments", $conn);
?>