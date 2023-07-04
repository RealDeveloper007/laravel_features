<?php

use Illuminate\Support\Facades\Route;

Route::group(
    // Prefix use in url
    // As use for route defining.
    ['prefix' => 'admin', 'as' => ''],
    function () {

        Route::resource('users', 'App\Http\Controllers\UserController');
    }
);
