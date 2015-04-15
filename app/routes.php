<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Static Pages
Route::get('/aboutus', function()
	{
		return View::make('statics.about');
	});
    
Route::get('/terms-conditions', function()
	{
		return View::make('statics.terms');
	});

Route::get('/contact', function()
	{
		return View::make('statics.contact');
	});


Route::any('/', [
        "as" => '/',
        'uses' => 'HomeController@index']);
Route::get("/register","UserController@getRegister");
Route::any("/site-explorer","HomepageController@siteExplorer");
Route::get("/terms-privacy","HomepageController@terms");


Route::group(array('prefix' => 'clients'), function()
{
    
      Route::any("/login", [
      "as"   => "user/login",
      "uses" => "UserController@login"
    ]);
    Route::any("/create", [
      "as"   => "users/create",
      "uses" => "UserController@postCreate"
    ]);
    
    Route::group(["before" => "auth"], function() {

      Route::any("/", [
        "as"   => "user/home",
        "uses" => "IndexController@index"
      ]);
    Route::any("profile", [
      "as"   => "user/profile",
      "uses" => "UserController@profile"
    ]);

    });
    
    
    Route::any("logout", [
      "as"   => "user/logout",
      "uses" => "UserController@logout"
    ]);
    
    Route::resource('research', 'ResearchController@index');
    Route::resource('trends', 'ResearchController@trends');
    Route::resource('historical-queries', 'ResearchController@historicalQueries');

});
Route::group(array('before' => 'auth','prefix' => 'admin'), function() {
    if (Session::get('role') == '1') {
                        Route::any("/", [
                        "as"   => "admin",
                        "uses" => "AdminUsersController@getIndex"
                      ]);
			Route::get('users', 'AdminUsersController@getIndex');
			Route::post('users/new', 'AdminUsersController@postNew');
		

			Route::get('roles', 'AdminRolesController@getIndex');
			Route::put('roles/update', 'AdminRolesController@putUpdate');


			Route::get('departments', 'AdminDepartmentsController@getIndex');
			Route::post('departments/add', 'AdminDepartmentsController@postAdd');
			Route::put('departments/update/users', 'AdminDepartmentsController@putUpdateUsers');
                        
                        Route::get('users/edit/{num}', 'AdminUsersController@getEdit')->where('num', '[0-9]+');
                        Route::post('users/edit/{num}', 'AdminUsersController@postEdit')->where('num', '[0-9]+');
                        
                        Route::get('users/delete/{num}', 'AdminUsersController@getDelete')->where('num', '[0-9]+');
                        
                        Route::get('users/password/{num}', 'AdminUsersController@getPassword')->where('num', '[0-9]+');
                        Route::post('users/password/{num}', 'AdminUsersController@postPassword')->where('num', '[0-9]+');

		} else {
			Route::any('admin/{any}', 'UserController@logout')->where('any', '[0-9]+');;
		}
});
// locked areas
Route::group(array('before' => 'auth','prefix' => 'support'), function() {
        Route::any('/',			'DashboardController@index');
	Route::post('hide/alerts', 'DashboardController@postHideAlerts');
	
	// tickets
	Route::get('ticket/{num}', 'TicketController@getView')->where('num', '[0-9]+');
	Route::get('ticket/add', 'TicketController@getAdd');
	Route::get('ticket/all', 'TicketController@getAll');
        if (Session::get('role')  > 3) {
            Route::get('tickets',	array('as' => 'tickets', 'uses' => 'TicketController@getAll'));
        } else {
            Route::get('tickets',	array('as' => 'tickets', 'uses' => 'TicketController@getMine'));
        }
	// normal users can't see assigned tickets
		if (Session::get('role') != 3) {
			Route::get('tickets/assigned',	'TicketController@getAssigned');
			Route::get('tickets/assigned/{any}', 'TicketController@getAssigned');	
		}
        if (Session::get('role')  > 3) {
            Route::get('tickets/mine', array('as' => 'tickets/mine', 'uses' => 'TicketController@getMine'));
            Route::get('tickets/mine/{any}', 'TicketController@getMine');
            Route::get('tickets/{any}', 'TicketController@getAll');
        } else {
            Route::get('tickets/{any}', 'TicketController@getAll');
            Route::get('tickets/mine', array('as' => 'tickets/mine', 'uses' => 'TicketController@getMine'));
            Route::get('tickets/mine/{any}', 'TicketController@getMine');
        }

        
	// requests
	Route::post('ticket/add',				'TicketController@postAdd');
	Route::post('ticket/update/{num}',		'TicketController@postUpdate')->where('num', '[0-9]+');
	Route::put('ticket/search',				array('as' => 'ticket/search', 'uses' => 'TicketController@putSearch'));
	Route::put('ticket/status/{num}',		'TicketController@putStatus')->where('num', '[0-9]+');

	// alias
	Route::get('ticket', function() {
		return Redirect::to('support/tickets');
	});

	// settings
	Route::get('settings', 'SettingsController@getIndex');
	Route::put('settings', 'SettingsController@putIndex');
                
});
