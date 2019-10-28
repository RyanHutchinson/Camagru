<?php

Route::set('index.php', function(){
    Home::CreateView('Home');
});

Route::set('About-us', function(){  //--------------testing will happen in here.
    AboutUs::CreateView('AboutUs');
});

Route::set('Contact-us', function(){
    ContactUs::CreateView('ContactUs');
});

Route::set('404', function(){
    four0four::CreateView('four0four');
});

?>