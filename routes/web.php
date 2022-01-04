



<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
Route::get('/' , 'FrontendController@index');
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){

        Route::get('/' , 'FrontendController@index');

        Auth::routes(['register' => true]);

        Route::get('/home', 'HomeController@index')->name('home');

       // Route::post('add/to-cart/{product_id}','CartController@addToCart');
       //  Route::post('add/to-cart/{product_id}' , 'CartController@addToCart');
       Route::post('add/to-cart/{product_id}' ,'CartController@addToCart');
       Route::get('cart','CartController@cartPage');
       Route::get('cart/destroy/{cart_id}','CartController@destroy');
       Route::post('cart/quantity/update/{cart_id}','CartController@quantityUpdate');
});









