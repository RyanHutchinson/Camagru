<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type='text/css' href="<?=CSS_PATH?>">
<link rel="stylesheet" type='text/css' href="<?=BOOTSTRAP_PATH?>">
<?php
if(!$_GET['url']){
    echo '<title>Home</title>';
}else{
    echo '<title>' . $_GET['url'] . '</title>';
}

?>

</head>	
	<body>

		<!--TODO:Fix this <div class="top-container">
			<h1>Camagru</h1>
			<p>the above is to become a logo</p>
		</div> -->

		<div class="header" id="myHeader">
			
				<div class="menuButtons">
					<a href="<?=HOME_PATH?>">Home</a>
					<!--TODO: this? <a href="<?=ABOUT_PATH?>">About Us</a>
					<a href="<?=CONTACT_PATH?>">Contact-us</a> -->
				</div>
				<div class="loginContainer">
                    <!-- <a href="<?=REGISTER_PATH?>">Register</a> -->
                    <?php self::loginContainer($_SESSION['user']);?>
				</div>
		</div>