#!/usr/bin/php
<?php
	include_once("./inc/config.php");
	
	//
	// CREATING THE DATABASE----------------------------------------------------
	//

	$sql = "CREATE DATABASE Camagru";
	if (mysqli_query($conn, $sql)){
		echo "Database created successfully\n";
	}else{
		echo "Error creating Database " . mysqli_error($conn) . "\n";
	}

	//
	// CREATING THE TABLES------------------------------------------------------
	//

	$conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "Camagru");

	$user_table = "CREATE TABLE users (
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
	if (mysqli_query($conn, $user_table)){
		echo "User Table created successfully\n";
	}else{
		echo "Error creating User Table " . mysqli_error($conn) . "\n";
	}

	$post_table = "CREATE TABLE posts (
		ID int NOT NULL,
		Userid int NOT NULL,
		Imagesrc varchar(255),
		Likes int,
		PRIMARY KEY (ID)
		);";
	if (mysqli_query($conn, $post_table)){
		echo "Post Table created successfully\n";
	}else{
		echo "Error creating post Table " . mysqli_error($conn) . "\n";
	}

	$comments_table = "CREATE TABLE comments (
		ID int NOT NULL,
		Postid int NOT NULL,
		Userid int,
		Comment TEXT NOT NULL,
		PRIMARY KEY (ID)
		);";
	if (mysqli_query($conn, $comments_table)){
		echo "Comments Table created successfully\n";
	}else{
		echo "Error creating Comment Table " . mysqli_error($conn) . "\n";
	}

	//
	// CREATING DEFAULT TABLE DATA----------------------------------------------
	//

	$test_users = "INSERT INTO users('ID', 'LastName', 'FirstName', 'Username', 'HashedPassword', 'Email', 'Age', 'Membertype') VALUES
					('0', 'Admin', 'Admin', 'Admin', '$2y$12$shJw/4kcyTqxDdkJSApib.7Gkwh4lDL8CKB9SZIM55HaOWOWql4sS', ' ', ' ', '2'),
					('1', 'Test1', 'Lastname', 'TEST1', '$2y$12$VyYxWKYzY7qqS1RVvAaEgOSs73wEseiA7c1uTSuCYhXZRWvf69GqO', 'test1@test.com', '42', '1')
					('2', 'Test2', 'Lastname', 'TEST2', '$2y$12$VyYxWKYzY7qqS1RVvAaEgOSs73wEseiA7c1uTSuCYhXZRWvf69GqO', 'test2@test.com', '42', '1')
					('3', 'Test3', 'Lastname', 'TEST3', '$2y$12$VyYxWKYzY7qqS1RVvAaEgOSs73wEseiA7c1uTSuCYhXZRWvf69GqO', 'test3@test.com', '42', '1')
					('4', 'Test4', 'Lastname', 'TEST4', '$2y$12$VyYxWKYzY7qqS1RVvAaEgOSs73wEseiA7c1uTSuCYhXZRWvf69GqO', 'test4@test.com', '42', '0')
					;";
	if (mysqli_query($conn, $users_users)){
		echo "Default_user created successfully\n";
	}else{
		echo "Error creating Default user " . mysqli_error($conn) . "\n";
	}


	$test_posts = "INSERT INTO `posts` (`ID`, `Userid`, `Imagesrc`, `Likes`) VALUES 
						('1', '1', '../somewhere/img1.png', '42'), 
						('2', '2', '../somewhere/img2.png', '42'), 
						('3', '4', '../somewhere/img3.png', '42'),
						('4', '1', '../somewhere/img4.png', '42')
						;";
	if (mysqli_query($conn, $test_posts)){
		echo "Test posts created successfully\n";
	}else{
		echo "Error creating test posts" . mysqli_error($conn) . "\n";
	}

	$test_comments = "INSERT INTO `comments` (`ID`, `Postid`, `Userid`, `Comment`) VALUES 
						('1', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
						('2', '1', '2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'), 
						('3', '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.'),
						('4', '4', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste mollitia expedita laudantium facere dignissimos enim alias deserunt asperiores commodi recusandae repellat, in esse at ab beatae ducimus quas aperiam velit.')
						;";
	if (mysqli_query($conn, $test_comments)){
		echo "Test comments created successfully\n";
	}else{
		echo "Error creating test comments" . mysqli_error($conn) . "\n";
	}
	?>