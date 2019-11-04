<?php
$create_database = "CREATE DATABASE IF NOT EXISTS camagru;";

$create_user_table = "CREATE TABLE IF NOT EXISTS camagru.users (
    ID int NOT NULL AUTO_INCREMENT,
    Username varchar(255) UNIQUE,
    FirstName varchar(255),
    LastName varchar(255),
    Email varchar(255) UNIQUE ,
    HashedPassword varchar(255),
    Membertype int DEFAULT 2,
    Token varchar(255) ,
    PRIMARY KEY (ID)
    );";
    
$create_post_table = "CREATE TABLE IF NOT EXISTS camagru.posts (
    ID int NOT NULL,
    Userid int NOT NULL,
    Imagesrc varchar(255),
    Likes int,
    PRIMARY KEY (ID)
    );";

$create_comment_table = "CREATE TABLE IF NOT EXISTS camagru.comments (
    ID int NOT NULL,
    Postid int NOT NULL,
    Userid int,
    Comment TEXT NOT NULL,
    PRIMARY KEY (ID)
    );";

$add_test_users = "INSERT INTO camagru.users (`ID`, `Username`, `FirstName`, `LastName`, `Email`, `HashedPassword`, `Membertype`) VALUES
					('1', 'Admin', 'Admin', 'Admin', 'admin@camagru.com', 'password', '42'),
					('2', 'notverified', 'Firstname', 'Lastname', 'email@email.com', 'password', '1'),
                    ('3', 'verified', 'Firstname', 'Lastname', 'email1@email.com', 'password', '2')
					;";

$add_test_posts = "INSERT INTO camagru.posts (`ID`, `Userid`, `Imagesrc`, `Likes`) VALUES 
                    ('1', '1', '../somewhere/img1.png', '42'), 
                    ('2', '2', '../somewhere/img2.png', '42'), 
                    ('3', '4', '../somewhere/img3.png', '42'),
                    ('4', '1', '../somewhere/img4.png', '42')
                    ;";

$add_test_comments = "INSERT INTO camagru.comments (`ID`, `Postid`, `Userid`, `Comment`) VALUES 
                    ('1', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
                    ('2', '1', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
                    ('3', '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'),
                    ('4', '4', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.')
                    ;";

?>