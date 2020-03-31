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

Route::get('/sports', 'SportController@index');
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

View::composer(['*'], function($view){
	$user = Auth::user();
	$view->with('user',$user);

});

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');

Route::get('/captain', 'CaptainController@index')->name('captain')->middleware('captain');

Route::get('/player', 'PlayerController@index')->name('player')->middleware('player');

Route::get('/home', 'HomeController@index')->name('home');

//Admin Sports

Route::get('/admin/sports', 'SportController@adminIndex')->middleware('admin');
Route::get('/admin/sports/create', 'SportController@create')->middleware('admin');
Route::get('/admin/sports/{sport}', 'SportController@adminShow')->middleware('admin')->name('adminSportShow');
Route::post('/admin/sports', 'SportController@store')->middleware('admin');
Route::get('/admin/sports/{sport}/edit', 'SportController@edit')->middleware('admin');
Route::patch('/admin/sports/{sport}/edit', 'SportController@update')->middleware('admin');
Route::delete('/admin/sports/{sport}', 'SportController@destroy')->middleware('admin');

//Admin Divisions

Route::get('/admin/sports/{sport}/create', 'DivisionController@create')->middleware('admin');
Route::post('/admin/sports/{sport}', 'DivisionController@store')->middleware('admin');
Route::get('/admin/sports/{sport}/{division}', 'DivisionController@adminShow')->middleware('admin');
Route::get('/admin/sports/{sport}/{division}/edit', 'DivisionController@edit')->middleware('admin');
Route::patch('/admin/sports/{sport}/{division}/edit', 'DivisionController@update')->middleware('admin');
Route::delete('/admin/sports/{sport}/{division}', 'DivisionController@destroy')->middleware('admin');

//Admin Teams
Route::get('/admin/teams/index', 'TeamController@adminIndex')->middleware('admin');
Route::get('/admin/teams/create', 'TeamController@create')->middleware('admin');
Route::get('/admin/teams/{team}' , 'TeamController@adminShow')->middleware('admin')->name('adminTeamShow');
Route::post('/admin/teams/create/fetch', 'TeamController@fetch')->name("teamcontroller.fetch");
Route::post('/admin/teams', 'TeamController@store')->middleware('admin');
Route::get('/admin/teams/{team}/edit', 'TeamController@edit')->middleware('admin');
Route::patch('/admin/teams/{team}/edit', 'TeamController@update')->middleware('admin');
Route::delete('/admin/teams/{team}', 'TeamController@destroy')->middleware('admin');
Route::get('/admin/teams/{team}/{teamMember}/leave' , 'TeamMemberController@leaveTeam')->middleware('admin');
//Posts Section for Teams
Route::get('/admin/teams/{team}/{teamMember}/post' , 'TeamPostController@adminCreate')->middleware('admin');
Route::post('/admin/teams/{team}/{teamMember}/post' , 'TeamPostController@adminStore')->middleware('admin');
Route::get('/admin/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@adminEdit')->middleware('admin');
Route::patch('/admin/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@update')->middleware('admin');
Route::delete('/admin/teams/{team}/{teamMember}/post/{teamPost}' , 'TeamPostController@destroy')->middleware('admin');

//Application Admin
Route::get('/admin/teams/{team}/applications' , 'TeamApplicantController@adminIndex')->middleware('admin');
Route::get('/admin/teams/{team}/apply' , 'TeamApplicantController@adminCreate')->middleware('admin');
Route::post('/admin/teams/{team}/apply' , 'TeamApplicantController@adminStore')->middleware('admin');
Route::get('/admin/teams/{team}/applications' , 'TeamApplicantController@adminIndex')->middleware('admin');
Route::post('/admin/teams/{team}/{application}/applications/approve', 'TeamApplicantController@adminAccept')->middleware('admin');
Route::post('/admin/teams/{team}/{application}/applications/deny', 'TeamApplicantController@adminDeny')->middleware('admin');

//Admin Profile
Route::get('/admin/profile/create' , 'UserProfileController@adminCreate')->middleware('admin');
Route::post('/admin/profile/create' , 'UserProfileController@store')->middleware('admin');
Route::get('/admin/profile/{userProfile}/edit' , 'UserProfileController@adminEdit')->middleware('admin');
Route::patch('/admin/profile/{userProfile}/edit' , 'UserProfileController@adminUpdate')->middleware('admin');
Route::delete('/admin/profile/{userProfile}' , 'UserProfileController@destroy')->middleware('admin');
Route::get('/admin/profile/{userProfile}' , 'UserProfileController@adminShow')->middleware('admin')->name('adminProfileShow');
Route::post('/admin/profile/{userProfile}/image' , 'UserProfileController@adminAddImage')->middleware('admin');

//Admin Profile Posts

Route::get('/admin/profile/{userProfile}/post/create' , 'UserProfilePostController@adminCreate')->middleware('admin');
Route::post('/admin/profile/{userProfile}/post/create' , 'UserProfilePostController@adminStore')->middleware('admin');
Route::get('/admin/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@adminEdit')->middleware('admin');
Route::patch('/admin/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@adminUpdate')->middleware('admin');
Route::delete('/admin/profile/{userProfile}/post/{userProfilePost}' , 'UserProfilePostController@adminDestroy')->middleware('admin');




