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

Route::get('/', function () { return redirect('/reserve');});

Route::get("/reserve","ReservationController@create")->name("reserve");
Route::post("/reserve", "ReservationController@store")->name("reserve.form");
Route::post("/reserve-price", "ReservationController@updatePrice");

Route::get("/thanks","ReservationController@thanks")->name("thanks");


Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::put('/admin/room/{room}', 'AdminController@update')->name('rooms.update');
    Route::get('/admin/room/{room}/edit', 'AdminController@edit')->name('rooms.edit');
});