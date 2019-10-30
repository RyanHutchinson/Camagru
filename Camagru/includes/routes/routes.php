<?php
// FIXME: make a function do do the pathing as per the index's setdestination function.
define('CSS_PATH', 'http://localhost:8080/camagru/Camagru/css/style.css');
define('HOME_PATH', 'http://localhost:8080/camagru/Camagru/');
define('ABOUT_PATH', 'http://localhost:8080/camagru/Camagru/About-us');
define('CONTACT_PATH', 'http://localhost:8080/camagru/Camagru/Contact-us');
define('LOGIN_PATH', 'http://localhost:8080/camagru/Camagru/Login');
define('REGISTER_PATH', 'http://localhost:8080/camagru/Camagru/Register');
define('BOOTSTRAP_PATH', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css');

Route::set('', function(){
    Home::CreateView('Home');
});

Route::set('About-us', function(){
    AboutUs::CreateView('AboutUs');
});

Route::set('Contact-us', function(){
    ContactUs::CreateView('ContactUs');
});

Route::set('404', function(){
    four0four::CreateView('four0four');
});

Route::set('Login', function(){
    Login::CreateView('Login');
});

Route::set('Register', function(){
    Register::CreateView('Register');
});

?>