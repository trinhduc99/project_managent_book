<?php
use Illuminate\Support\Facades\Route;

//product
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'ProductController@index',
        'middleware' => 'can:product-list'
    ]);
    Route::get('/create', [
        'as' => 'products.create',
        'uses' => 'ProductController@create',
        'middleware' => 'can:product-create'
    ]);
    Route::post('/store', [
        'as' => 'products.store',
        'uses' => 'ProductController@store',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'products.edit',
        'uses' => 'ProductController@edit',
        'middleware' => 'can:product-edit,id'
    ]);
    Route::post('/update/{id}', [
        'as' => 'products.update',
        'uses' => 'ProductController@update',
    ]);
    Route::get('/delete/{id}', [
        'as' => 'products.delete',
        'uses' => 'ProductController@delete',
        'middleware' => 'can:product-delete,id'
    ]);
    Route::post('/search', [
        'as' => 'products.search',
        'uses' => 'ProductController@search',
    ]);

});
