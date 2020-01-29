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

Route::get('/', 'WelcomeController@index')->name('welcome.index');
Route::get('step1', 'WelcomeController@step1')->name('welcome.step1');
Route::get('step2', 'WelcomeController@step1');
Route::get('step3', 'WelcomeController@step1');
Route::get('about', 'WelcomeController@about')->name('welcome.about');
Route::get('logout', 'WelcomeController@logout')->name('welcome.logout');

Route::post('step2', 'WelcomeController@step2')->name('welcome.step2');
Route::post('step3', 'WelcomeController@step3')->name('welcome.step3');

Route::get('/test', 'SocialFaceBookController@test')->name('auth.test');
Route::get('auth/facebook', 'SocialFaceBookController@redirectToProvider')->name('auth.facebook');
Route::get('auth/facebook/callback', 'SocialFaceBookController@handleProviderCallback');

Route::get('main', 'MainController@index')->name('main.index');
Route::get('main/settings', 'MainController@settings')->name('main.settings');
Route::get('main/about', 'MainController@about')->name('main.about');
Route::get('main/updatesearch', 'MainController@index');
Route::post('main/updatesearch', 'MainController@updatesearch')->name('main.updatesearch');
Route::get('main/updaterefs', 'MainController@index');
Route::post('main/updaterefs', 'MainController@updaterefs')->name('main.updaterefs');

Route::resource('events', 'EventsController');
Route::resource('positions', 'PositionsController');

Auth::routes();
