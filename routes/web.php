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

Route::get('/', 'HomeController@index')->name('Home');

Route::get('/place', function (){
    return view('layouts.places');
});


Auth::routes();

//
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@getIndex')->name('adminHome');

    Route::group(['as' => 'countries.', 'prefix' => 'countries', 'namespace' => 'Countries'], function () {
        Route::get('/', 'CountriesController@getIndex')->name('countries');
        Route::get('/add', 'CountriesController@getAdd')->name('countriesAdd');
        Route::get('/edit/{id}', 'CountriesController@getEdit')->name('countriesEdit');
        Route::get('/delete/{id}', 'CountriesController@getDelete')->name('countriesDelete');
        Route::post('/add/save', 'CountriesController@create')->name('countriesAddSave');
        Route::post('/edit/{id}/save', 'CountriesController@update')->name('countriesEditSave');
    });

    Route::group(['as' => 'places.', 'prefix' => 'places', 'namespace' => 'Places'], function () {
        Route::get('/', 'PlacesController@getIndex')->name('places');
        Route::get('/add', 'PlacesController@getAdd')->name('placesAdd');
        Route::get('/edit/{id}', 'PlacesController@getEdit')->name('placesEdit');
        Route::get('/delete/{id}', 'PlacesController@getDelete')->name('placesDelete');
        Route::post('/add/save', 'PlacesController@create')->name('placesAddSave');
        Route::post('/edit/{id}/save', 'PlacesController@update')->name('placesEditSave');
    });

});


Route::group(['as' => 'places.', 'prefix' => 'places', 'namespace' => 'Frontend'], function () {
    Route::get('/', 'PlacesController@getIndex')->name('places');
    Route::get('/{id}', 'PlacesController@getPlace')->name('place');
});
