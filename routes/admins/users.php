<?php
use Illuminate\Support\Facades\Route;

//Category
Route::prefix('users')->group(function () {
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'AdminUserController@index',
        'middleware' => 'can:user-list'
    ]);

});
