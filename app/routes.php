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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showIndex'));

Route::controller('auth', 'AuthController');

Route::controller('quiz', 'QuizController');

Route::controller('map', 'MapController');

Route::controller('profile', 'ProfileController');

Route::controller('scoreboard', 'ScoreboardController');

Route::get('control', 'ControlPanelController@getChange');

Route::post('control', 'ControlPanelController@postChange');

Route::controller('admin', 'AdminController');

Route::controller('api', 'ApiController');

Route::controller('history', 'HistoryController');

//Route::get('history', array('as' => 'history', 'uses' => 'HistoryController@showIndex'));