<?php
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/Imentet');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/imentet.php';
require __DIR__.'/gem.php';
require __DIR__.'/pyramids.php';