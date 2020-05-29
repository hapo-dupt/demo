<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * Route for General Part
 */
Route::middleware(['member'])->group(function () {
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::match(['post', 'get'], 'search', 'General\SearchController@search')->name('search');
    Route::get('resultsSearch/{$id}', 'General\SearchController@showTask')->name('redirectSearch');
});

/**
 * Route for Members
 */
Route::middleware(['member'])->group(function () {
    Route::get('/home', 'Member\HomeController@index')->name('home');
    Route::resources([
        'profiles' => 'General\ProfileController',
        'projects' => 'Member\ProjectController',
        'tasks' => 'Member\TaskController',
        'resultsSearch' => 'General\SearchController'
    ]);
});

/**
 * Route for Admin
 */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', 'Admin\HomeController@index')->name('admin');
});
