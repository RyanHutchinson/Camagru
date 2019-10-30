<?php
$create_database = "CREATE DATABASE IF NOT EXISTS camagru;";

$create_user_table = "CREATE TABLE IF NOT EXISTS camagru.users (
    ID int NOT NULL AUTO_INCREMENT,
    LastName varchar(255),
    FirstName varchar(255),
    Username varchar(255) UNIQUE,
    HashedPassword varchar(255),
    Email varchar(255) UNIQUE ,
    Age int,
    CellPhoneNumber int(10),
    Membertype int,
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

$add_test_users = "INSERT INTO camagru.users (`ID`, `LastName`, `FirstName`, `Username`, `HashedPassword`, `Email`, `Age`, `Membertype`) VALUES
					('1', 'Admin', 'Admin', 'Admin', 'password', ' ', '0', '2'),
					('2', 'Test1', 'Lastname', 'TEST1', 'password', 'test1@test.com', '42', '1')
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