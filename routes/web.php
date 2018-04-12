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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//get 登陆
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('article/{id}', 'ArticleController@show');
Route::get('article/{id}/ajaxpage', 'ArticleController@ajaxpage');
Route::get('article/{id}/ajaxmore', 'ArticleController@ajaxmore');

Route::post('comment', 'CommentController@store');

