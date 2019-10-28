<?php

Route::set('index.php', function(){
    Home::CreateView('Home');
});

Route::set('About-us', function(){  //--------------testing will happen in here.
    AboutUs::CreateView('AboutUs');
    AboutUs::test();
});

Route::set('Contact-us', function(){
    ContactUs::CreateView('ContactUs');
});

?>