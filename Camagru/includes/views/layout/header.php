<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type='text/css' href="<?=CSS_PATH?>">
</head>
    <body>

        <div class="top-container">
            <h1>Camagru</h1>
            <p>the above is to become a logo</p>
        </div>

        <div class="header" id="myHeader">
            <a href="<?=HOME_PATH?>">Home</a>
            <a href="<?=ABOUT_PATH?>">About Us</a>
            <a href="<?=CONTACT_PATH?>">Contact-us</a>
            <?php logincontainer()?>
        </div>