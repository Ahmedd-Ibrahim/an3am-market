<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('register','UserAPIController@register');
    Route::post('login', 'UserAPIController@login');
    Route::post('forget-password', 'UserAPIController@forgetPassword');
    Route::post('set-password', 'UserAPIController@setPassword');
    Route::post('verify-code', 'UserAPIController@verifyCode');
    Route::post('logout', 'UserAPIController@logout')->middleware('jwt.verify');

});

/* apis without JWT */
Route::group([
    'prefix'=>'home',
    'middleware' => 'api'
],function (){

    Route::resource('home_pages', 'HomePageAPIController');
    Route::get('sliders', 'HomePageAPIController@slider');
    Route::get('feature', 'HomePageAPIController@feature');
    Route::get('best-seller', 'HomePageAPIController@bestSeller');
    Route::get('all-products', 'HomePageAPIController@allProducts');
    Route::post('search', 'HomePageAPIController@search');
    Route::get('custom-search', 'HomePageAPIController@customSearch');
    Route::post('custom-search', 'HomePageAPIController@customSearching');
});
/* End  apis without JWT */

Route::group(['middleware' => ['jwt.verify']], function() {

    // profile
    Route::group(['prefix'=>'profile'],function (){
        Route::resource('users', 'UserAPIController');
        Route::post('add-address', 'UserAPIController@addAddress');

    });
    Route::group(['prefix'=>'settings'],function (){

        Route::post('update-password','UserAPIController@updatePassword');

        Route::get('about', 'SettingsAPIController@about');

    });

    Route::resource('products', 'ProductAPIController');

    Route::resource('types', 'TypeAPIController');
//product_users [favourite]
    Route::resource('favourite', 'ProductUserAPIController')->except(['show','update']);

    Route::resource('baskets', 'BasketAPIController');

    Route::resource('addresses', 'AddressAPIController');

    Route::resource('orders', 'OrderAPIController');

    Route::resource('product_orders', 'ProductOrderAPIController');

    Route::resource('categories', 'CategoryAPIController');

    Route::resource('category_products', 'CategoryProductAPIController');

    Route::resource('sliders', 'SliderAPIController');

    Route::resource('settings', 'SettingsAPIController');

});


Route::resource('home_pages', 'HomePageAPIController');