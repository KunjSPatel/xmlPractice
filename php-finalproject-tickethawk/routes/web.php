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
    return redirect('/dashboard');
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
    // Dashboard URL
    Route::get('/dashboard', 'HomeController@index');

    // Ticket URLs
    Route::get('/tickets', 'TicketController@index')->name('tickets');
    // Create a new ticket
    Route::get('tickets/create', 'TicketController@create');
    // Show a ticket
    Route::get('tickets/{ticket}', 'TicketController@show');
    // Update POST route
    Route::post('tickets/store', 'TicketController@store');
    // Close a ticket
    Route::post('tickets/{ticket}/close', 'TicketController@close');

    // Comments URLs - Create a new ticket
    Route::post('comments/store', 'CommentController@store');

    // My Account
    Route::get('/my-account', 'UserController@myAccount')->name('my-account');
    // Update POST route
    Route::post('/updatemyaccount', 'UserController@updateMyAccount');

    // Update Preferences
    Route::post('/preferences', 'PreferenceController@updateNotificationPreferences');

    // Admin & manager only routes
    Route::group(['middleware' => ['role:admin|manager']], function() {

        // Users URLs
        Route::get('/users', 'UserController@index')->name('users');
        // Create a new user
        Route::get('users/create', 'UserController@create');
        // Show a user
        Route::get('users/{id}', 'UserController@edit');
        // Update POST route
        Route::post('users/store', 'UserController@store');
        // Edit a user
        Route::get('users/edit/{id}', 'UserController@edit');
        // Update POST route
        Route::post('users/update/{id}', 'UserController@update');

        // Categories URLs
        Route::get('/categories', 'IssueController@index')->name('categories');
        // Create a new issue category
        Route::get('categories/create', 'IssueController@create');
        // Show an issue category
        Route::get('categories/{issue}', 'IssueController@edit');
        // Update POST route
        Route::post('categories/store', 'IssueController@store');
        // Edit an issue category
        Route::get('categories/edit/{issue}', 'IssueController@edit');
        // Update POST route
        Route::post('categories/update/{issue}', 'IssueController@update');
        // Destroy POST route
        Route::post('categories/destroy/{issue}', 'IssueController@destroy');

        // Edit a ticket
        Route::get('tickets/edit/{ticket}', 'TicketController@edit');
        // Update POST route
        Route::post('tickets/update/{ticket}', 'TicketController@update');

    });

    // Admin only routes
    Route::group(['middleware' => ['role:admin']], function() {

        // Preferences URLs
        Route::get('/preferences', 'PreferenceController@index')->name('preferences');

        // Export URLs
        Route::post('/export/tickets', 'ExportController@exportTickets');
        Route::post('/export/users', 'ExportController@exportUsers');
        Route::post('/export/categories', 'ExportController@exportCategories');

    });

});
