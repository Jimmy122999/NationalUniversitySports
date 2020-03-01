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
    return view('index');
});

Route::get('/sports', function () {
    return view('sports');
});
Route::get('/football', function () {
    return view('sports/football');
});
Route::get('/lacrosse', function () {
    return view('sports/lacrosse');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/myTeam', function () {
    return view('myTeam');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');

Route::get('/captain', 'CaptainController@index')->name('captain')->middleware('captain');

Route::get('/player', 'PlayerController@index')->name('player')->middleware('player');

Route::get('/home', 'HomeController@index')->name('home');

//Sports

Route::get('/admin/sports', 'SportController@adminIndex');
Route::get('/admin/sports/create', 'SportController@create');
Route::post('/admin/sports/store', 'SportController@store');
