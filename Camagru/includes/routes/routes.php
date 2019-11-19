<?php

define('CSS_PATH', Route::getDestination('css/style.css'));
define('IMG_ROUTE', Route::getDestination('img/'));
define('HOME_PATH', Route::getDestination(''));
define('ABOUT_PATH', Route::getDestination('About-us'));
define('CONTACT_PATH', Route::getDestination('Contact-us'));
define('LOGIN_PATH', Route::getDestination('Login'));
define('LOGOUT_PATH', Route::getDestination('Logout'));
define('REGISTER_PATH', Route::getDestination('Register'));
define('PROFILE_PATH', Route::getDestination('Profile'));
define('POST_PATH', Route::getDestination('Post'));
define('BOOTSTRAP_PATH', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css');

//Javascript paths
define('HOME_JAVASCRIPT_PATH', Route::getDestination('JS/home.js'));
define('POST_JAVASCRIPT_PATH', Route::getDestination('JS/post.js'));
define('PROFILE_JAVASCRIPT_PATH', Route::getDestination('JS/profile.js'));

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

Route::set('Logout', function(){
    session_destroy();
    Route::setDestination();
});

Route::set('Register', function(){
    Register::CreateView('Register');
});

Route::set('Profile', function(){
    Profile::CreateView('Profile');
});

Route::set('ForgotPassword', function(){
    ForgotPassword::CreateView('ForgotPassword');
});

Route::set('NewPost', function(){
    NewPost::CreateView('NewPost');
});

Route::set('getPost', function(){
    getPost::fetchOne();
});

Route::set('addLike', function(){
    Post::addLike();
});

Route::set('Post', function(){
    Post::CreateView('Post');
});
?>