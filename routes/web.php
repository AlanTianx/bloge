<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/view', 'ViewController@index');

//Route::get('/index','IndexController@index');
//
//Route::get('/user','UserController@index');

//Route::get('/Admin/index','Admin\IndexController@index')->name('Aindex');
//
//Route::get('/Admin/login','Admin\IndexController@login')->name('Alogin');

//Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['web' , 'admin_auth']], function () {
//    Route::get('index','IndexController@index')->name('Aindex');
//    //Route::get('login','IndexController@login')->name('Alogin');
//    Route::get('logout','IndexController@logout')->name('Alogout');
//    Route::get('upd_pass','IndexController@upd_pwd')->name('Aupd_pass');
//    Route::resource('article', 'ArticleController');
//});

//Route::group(['prefix' => 'admin', 'namespace' => 'admin' , 'middleware' => 'web'], function () {
//    Route::group(['middleware' => 'admin_auth' ], function () {
//        Route::get('index','IndexController@index')->name('Aindex');
//        Route::get('logout','IndexController@logout')->name('Alogout');
//        Route::get('upd_pass','IndexController@upd_pwd')->name('Aupd_pass');
//        Route::resource('article', 'ArticleController');
//    });
//});
Route::get('www/id/{id}',function($id){
    return 'id'.$id;
});

Route::group(['prefix' => 'admin' , 'namespace' => 'admin' , 'middleware' => 'web'], function (){
    Route::middleware('admin_auth')->group(function(){
        Route::get('index','IndexController@index')->name('A_index');
    });
    Route::group(['middleware' => 'admin_auth' ], function () {

        Route::get('info','IndexController@info');
        Route::get('logout','IndexController@logout')->name('A_logout');
        Route::any('upd_pass','IndexController@upd_pwd')->name('A_upd_pass');
        Route::resource('category', 'CategoryController');
        Route::post('cate/change_order','CategoryController@change_order');
        Route::resource('article', 'ArticleController');
        Route::resource('links', 'LinksController');
        Route::post('links/change_order','LinksController@change_order');
        Route::resource('navs', 'NavsController');
        Route::post('navs/change_order','NavsController@change_order');

        Route::resource('config', 'ConfigController');
        Route::post('config/change_order','ConfigController@change_order');
        Route::post('config/change_content','ConfigController@change_content');
        Route::get('change_cccc','ConfigController@change_cccc');
    });
    Route::any('login' , 'LoginController@login')->name('A_login');
    Route::get('vf_code' , 'LoginController@vf_code')->name('vf_code');
    Route::get('get_code' , 'LoginController@get_code');
});
Route::any('upload' , 'CommonController@upload');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
