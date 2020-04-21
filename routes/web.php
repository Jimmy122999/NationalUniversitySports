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


Route::get('/', 'FixtureResultController@homePage');
    


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

Route::get('/mail-config',  function() {
    return config('mail');
});

//Admin Sports

Route::get('/sports', 'SportController@index');
Route::get('/sports/create', 'SportController@create')->middleware('admin');
Route::get('/sports/{sport}', 'SportController@show')->name('SportShow');
Route::post('/sports', 'SportController@store')->middleware('admin');
Route::get('/sports/{sport}/edit', 'SportController@edit')->middleware('admin');
Route::patch('/sports/{sport}/edit', 'SportController@update')->middleware('admin');
Route::delete('/sports/{sport}', 'SportController@destroy')->middleware('admin');

// Divisions

Route::get('/sports/{sport}/create', 'DivisionController@create')->middleware('admin');
Route::post('/sports/{sport}', 'DivisionController@store')->middleware('admin');
Route::get('/sports/{sport}/{division}', 'DivisionController@show')->name('divisionShow');
Route::get('/sports/{sport}/{division}/edit', 'DivisionController@edit')->middleware('admin');
Route::patch('/sports/{sport}/{division}/edit', 'DivisionController@update')->middleware('admin');
Route::delete('/sports/{sport}/{division}', 'DivisionController@destroy')->middleware('admin');
Route::get('/sports/{sport}/{division}/season', 'FixtureController@generateSeason');
Route::get('/sports/{sport}/{division}/new', 'FixtureController@makeSeason');

//Captains
Route::get('/captains/create', 'CaptainController@create')->middleware('admin');
Route::patch('/captains/{player}', 'CaptainController@store')->middleware('admin');
Route::get('/captains/index', 'CaptainController@index')->middleware('admin');
Route::patch('/captains/edit/{captain}', 'CaptainController@update')->middleware('admin');



// Teams
Route::get('/teams/index', 'TeamController@index');
Route::get('/teams/create', 'TeamController@create')->middleware('admin');
Route::get('/teams/{team}' , 'TeamController@show')->name('teamShow');
Route::post('/teams/create/fetch', 'TeamController@fetch')->name("teamcontroller.fetch");
Route::post('/teams', 'TeamController@store')->middleware('admin');
Route::post('/teams/{team}/image' , 'TeamController@addImage');
Route::get('/teams/{team}/edit', 'TeamController@edit')->middleware('admin');
Route::patch('/teams/{team}/edit', 'TeamController@update')->middleware('admin');
Route::delete('/teams/{team}', 'TeamController@destroy')->middleware('admin');
Route::get('/teams/{team}/{teamMember}/leave' , 'TeamMemberController@leaveTeam');
//Posts Section for Teams
Route::get('/teams/{team}/{teamMember}/post' , 'TeamPostController@create');
Route::post('/teams/{team}/{teamMember}/post' , 'TeamPostController@store');
Route::get('/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@edit');
Route::patch('/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@update');
Route::delete('/teams/{team}/{teamMember}/post/{teamPost}' , 'TeamPostController@destroy');

//Application 
Route::get('/teams/{team}/applications' , 'TeamApplicantController@index');
Route::get('/teams/{team}/apply' , 'TeamApplicantController@create');
Route::post('/teams/{team}/apply' , 'TeamApplicantController@store');
Route::post('/teams/{team}/{application}/applications/approve', 'TeamApplicantController@accept');
Route::post('/teams/{team}/{application}/applications/deny', 'TeamApplicantController@deny');

// Profile
Route::get('/profile/create' , 'UserProfileController@create');
Route::post('/profile/create' , 'UserProfileController@store');
Route::get('/profile/{userProfile}/edit' , 'UserProfileController@edit');
Route::patch('/profile/{userProfile}/edit' , 'UserProfileController@update');
Route::delete('/profile/{userProfile}' , 'UserProfileController@destroy');
Route::get('/profile/{userProfile}' , 'UserProfileController@show')->name('profileShow');
Route::post('/profile/{userProfile}/image' , 'UserProfileController@addImage');

// Profile Posts

Route::get('/profile/{userProfile}/post/create' , 'UserProfilePostController@create');
Route::post('/profile/{userProfile}/post/create' , 'UserProfilePostController@store');
Route::get('/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@edit');
Route::patch('/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@update');
Route::delete('/profile/{userProfile}/post/{userProfilePost}' , 'UserProfilePostController@destroy');

// Fixtures

Route::get('/fixtures' , 'FixtureController@index');
Route::get('/fixtures/create' , 'FixtureController@create')->middleware('admin');
Route::post('/fixtures/create' , 'FixtureController@store')->middleware('admin');
Route::post('/fixtures/create/fetch' , 'TeamController@teamFetch')->name('teamcontroller.teamfetch');
Route::get('/fixtures/{fixture}/edit' , 'FixtureController@edit')->middleware('admin');
Route::get('/fixtures/{fixture}/edit{slug}' , 'FixtureController@captainEdit');
Route::patch('/fixtures/{fixture}/edit' , 'FixtureController@update')->middleware('admin');
Route::patch('/fixtures/{fixture}/captainEdit' , 'FixtureController@captainUpdate');
Route::delete('/fixtures/{fixture}' , 'FixtureController@destroy')->middleware('admin');

//Fixture Results
Route::get('/results', 'FixtureResultController@index');
Route::get('/fixtures/{fixture}/result' , 'FixtureResultController@create')->middleware('admin');
Route::post('/fixtures/{fixture}/result' , 'FixtureResultController@store')->middleware('admin');
Route::get('/fixtures/{fixture}/result/{fixtureResult}/edit' , 'FixtureResultController@edit')->middleware('admin');
Route::patch('/fixtures/{fixture}/result/{fixtureResult}' , 'FixtureResultController@update')->middleware('admin');
Route::delete('/fixtures/{fixture}/result/{fixtureResult}' , 'FixtureResultController@destroy')->middleware('admin');




// Route::get('/admin', 'AdminController@index')->name('admin');

// Route::get('/captain', 'CaptainController@index')->name('captain')->middleware('captain');

// Route::get('/player', 'PlayerController@index')->name('player')->middleware('player');

// Route::get('/home', 'HomeController@index')->name('home');



// //Admin Sports

// Route::get('/admin/sports', 'SportController@adminIndex');
// Route::get('/admin/sports/create', 'SportController@create');
// Route::get('/admin/sports/{sport}', 'SportController@adminShow')->name('adminSportShow');
// Route::post('/admin/sports', 'SportController@store');
// Route::get('/admin/sports/{sport}/edit', 'SportController@edit')->middleware('admin');
// Route::patch('/admin/sports/{sport}/edit', 'SportController@update')->middleware('admin');
// Route::delete('/admin/sports/{sport}', 'SportController@destroy')->middleware('admin');

// //Admin Divisions

// Route::get('/admin/sports/{sport}/create', 'DivisionController@create')->middleware('admin');
// Route::post('/admin/sports/{sport}', 'DivisionController@store')->middleware('admin');
// Route::get('/admin/sports/{sport}/{division}', 'DivisionController@adminShow')->middleware('admin');
// Route::get('/admin/sports/{sport}/{division}/edit', 'DivisionController@edit')->middleware('admin');
// Route::patch('/admin/sports/{sport}/{division}/edit', 'DivisionController@update')->middleware('admin');
// Route::delete('/admin/sports/{sport}/{division}', 'DivisionController@destroy')->middleware('admin');

// //Admin Teams
// Route::get('/admin/teams/index', 'TeamController@adminIndex')->middleware('admin');
// Route::get('/admin/teams/create', 'TeamController@create')->middleware('admin');
// Route::get('/admin/teams/{team}' , 'TeamController@adminShow')->middleware('admin')->name('adminTeamShow');
// Route::post('/admin/teams/create/fetch', 'TeamController@fetch')->name("teamcontroller.fetch");
// Route::post('/admin/teams', 'TeamController@store')->middleware('admin');
// Route::get('/admin/teams/{team}/edit', 'TeamController@edit')->middleware('admin');
// Route::patch('/admin/teams/{team}/edit', 'TeamController@update')->middleware('admin');
// Route::delete('/admin/teams/{team}', 'TeamController@destroy')->middleware('admin');
// Route::get('/admin/teams/{team}/{teamMember}/leave' , 'TeamMemberController@leaveTeam')->middleware('admin');
// //Posts Section for Teams
// Route::get('/admin/teams/{team}/{teamMember}/post' , 'TeamPostController@adminCreate')->middleware('admin');
// Route::post('/admin/teams/{team}/{teamMember}/post' , 'TeamPostController@adminStore')->middleware('admin');
// Route::get('/admin/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@adminEdit')->middleware('admin');
// Route::patch('/admin/teams/{team}/{teamMember}/post/{teamPost}/edit' , 'TeamPostController@update')->middleware('admin');
// Route::delete('/admin/teams/{team}/{teamMember}/post/{teamPost}' , 'TeamPostController@adminDestroy')->middleware('admin');

// //Application Admin
// Route::get('/admin/teams/{team}/applications' , 'TeamApplicantController@adminIndex')->middleware('admin');
// Route::get('/admin/teams/{team}/apply' , 'TeamApplicantController@adminCreate')->middleware('admin');
// Route::post('/admin/teams/{team}/apply' , 'TeamApplicantController@adminStore')->middleware('admin');
// Route::get('/admin/teams/{team}/applications' , 'TeamApplicantController@adminIndex')->middleware('admin');
// Route::post('/admin/teams/{team}/{application}/applications/approve', 'TeamApplicantController@adminAccept')->middleware('admin');
// Route::post('/admin/teams/{team}/{application}/applications/deny', 'TeamApplicantController@adminDeny')->middleware('admin');

// //Admin Profile
// Route::get('/admin/profile/create' , 'UserProfileController@adminCreate')->middleware('admin');
// Route::post('/admin/profile/create' , 'UserProfileController@store')->middleware('admin');
// Route::get('/admin/profile/{userProfile}/edit' , 'UserProfileController@adminEdit')->middleware('admin');
// Route::patch('/admin/profile/{userProfile}/edit' , 'UserProfileController@adminUpdate')->middleware('admin');
// Route::delete('/admin/profile/{userProfile}' , 'UserProfileController@destroy')->middleware('admin');
// Route::get('/admin/profile/{userProfile}' , 'UserProfileController@adminShow')->middleware('admin')->name('adminProfileShow');
// Route::post('/admin/profile/{userProfile}/image' , 'UserProfileController@adminAddImage')->middleware('admin');

// //Admin Profile Posts

// Route::get('/admin/profile/{userProfile}/post/create' , 'UserProfilePostController@adminCreate')->middleware('admin');
// Route::post('/admin/profile/{userProfile}/post/create' , 'UserProfilePostController@adminStore')->middleware('admin');
// Route::get('/admin/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@adminEdit')->middleware('admin');
// Route::patch('/admin/profile/{userProfile}/post/{userProfilePost}/edit' , 'UserProfilePostController@adminUpdate')->middleware('admin');
// Route::delete('/admin/profile/{userProfile}/post/{userProfilePost}' , 'UserProfilePostController@adminDestroy')->middleware('admin');

// //Admin Fixtures

// Route::get('/admin/fixtures' , 'FixtureController@index')->middleware('admin');
// Route::get('/admin/fixtures/create' , 'FixtureController@create')->middleware('admin');
// Route::post('/admin/fixtures/create' , 'FixtureController@store')->middleware('admin');
// Route::post('/admin/fixtures/create/fetch' , 'TeamController@teamFetch')->middleware('admin')->name('teamcontroller.teamfetch');

// //Fixture Results

// Route::get('/admin/fixtures/{fixture}/result' , 'FixtureResultController@create')->middleware('admin');
// Route::post('/admin/fixtures/{fixture}/result' , 'FixtureResultController@store')->middleware('admin');




