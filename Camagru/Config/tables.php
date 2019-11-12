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
    Notifications int DEFAULT NULL,
    Token varchar(255) ,
    PRIMARY KEY (ID)
    );";
    
$create_post_table = "CREATE TABLE IF NOT EXISTS camagru.posts (
    ID int NOT NULL,
    Userid int NOT NULL,
    Imagesrc varchar(255),
    Likes int DEFAULT 0,
    PRIMARY KEY (ID)
    );";

$create_image_table = "CREATE TABLE IF NOT EXISTS camagru.images (
    ID int NOT NULL,
    Userid int NOT NULL,
    Imagesrc varchar(255),
    PRIMARY KEY (ID)
    );";

$create_comment_table = "CREATE TABLE IF NOT EXISTS camagru.comments (
    ID int NOT NULL,
    Postid int NOT NULL,
    Userid int,
    Comment TEXT NOT NULL,
    PRIMARY KEY (ID)
    );";

$hashedpw = '\'' . password_hash('12#$qwER', PASSWORD_BCRYPT) . '\'';

$add_test_users = "INSERT INTO camagru.users (`ID`, `Username`, `FirstName`, `LastName`, `Email`, `HashedPassword`, `Membertype`) VALUES
					('1', 'Admin', 'Admin', 'Admin', 'admin@camagru.com', $hashedpw, 42),
					('2', 'notverified', 'Bob', 'Smith', 'bsmith@mailcatch.com', $hashedpw, 0),
                    ('3', 'verified', 'Bobette', 'Doe', 'bdoe@mailcatch.com', $hashedpw, 1),
                    ('4', 'RyanBigHead', 'Ryan', 'Hutchinson', 'rhutchinson@mailcatch.com', $hashedpw, 1)
                    ;";
                    
$add_test_images = "INSERT INTO camagru.images (`ID`, `Userid`, `Imagesrc`) VALUES
					('1', '1', 'img/Default.png'),
                    ('2', '1', 'img/Profile.png'),
                    ('3', '1', 'img/test.png')
					;";

$add_test_posts = "INSERT INTO camagru.posts (`ID`, `Userid`, `Imagesrc`) VALUES 
                    ('1', '4', 'img/Default.png'), 
                    ('2', '4', 'img/Default.png'), 
                    ('3', '4', 'img/Default.png'),
                    ('4', '4', 'img/Default.png')
                    ;";

$add_test_comments = "INSERT INTO camagru.comments (`ID`, `Postid`, `Userid`, `Comment`) VALUES 
                    ('1', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
                    ('2', '1', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
                    ('3', '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'),
                    ('4', '3', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.')
                    ;";

?>