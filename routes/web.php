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

Route::get('', 'WelcomeController@index')->name('welcome.index');
Route::get('step1', 'WelcomeController@step1')->name('welcome.step1');
Route::get('step1b', 'WelcomeController@step1');
Route::get('step2', 'WelcomeController@step1');
Route::get('step3', 'WelcomeController@step1');
Route::get('logout', 'WelcomeController@logout')->name('welcome.logout');

Route::post('step1b', 'WelcomeController@step1b')->name('welcome.step1b');
Route::post('step2', 'WelcomeController@step2')->name('welcome.step2');
Route::post('step3', 'WelcomeController@step3')->name('welcome.step3');

Route::get('admin', 'WelcomeController@admin')->name('welcome.admin');
Route::get('step036', 'WelcomeController@admin');
Route::post('step036', 'WelcomeController@step036')->name('welcome.step036');

Route::get('about', 'AboutController@index')->name('about.index');
Route::get('about/edit', 'AboutController@edit');
Route::post('about/update', 'AboutController@update')->name('about.update');

Route::get('/test', 'SocialFaceBookController@test')->name('auth.test');
Route::get('auth/facebook', 'SocialFaceBookController@redirectToProvider')->name('auth.facebook');
Route::get('auth/facebook/callback', 'SocialFaceBookController@handleProviderCallback');

Route::get('main', 'MainController@index')->name('main.index');
Route::get('main/settings', 'MainController@settings')->name('main.settings');
Route::get('main/about', 'MainController@about')->name('main.about');
Route::get('main/update', 'MainController@index');
Route::post('main/update', 'MainController@update')->name('main.update');

Route::resource('events', 'EventsController');
Route::resource('positions', 'PositionsController');

Auth::routes();
