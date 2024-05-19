<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);

    Route::resource('events', 'Backend\EventController', ['names' => 'admin.events']);
    Route::resource('tickets', 'Backend\TicketController', ['names' => 'admin.tickets']);
    Route::resource('transactions', 'Backend\TransactionController', ['names' => 'admin.transactions']);

    // Routes for AJAX requests to get tickets by event and ticket price
    Route::get('tickets/get-by-event/{event_id}', 'Backend\TicketController@getByEvent');
    Route::get('tickets/get-price/{ticket_id}', 'Backend\TicketController@getPrice');

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgotPasswordController@reset')->name('admin.password.update');
});
