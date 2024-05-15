<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\RegisterController@register');
  
Route::middleware('auth:api')->group( function () {
	Route::resource('league', 'API\LeagueController');
    Route::get('leagues/{league}/teams', 'API\LeagueController@teams')->name('leagues.teams');

    Route::get('teams/{team}/leagues', 'API\TeamController@leagues')->name('teams.leagues');
    Route::get('teams/{team}/players', 'API\TeamController@players')->name('teams.players');
    Route::post('teams/{team}/players', 'API\TeamController@addPlayer');

    Route::post('players', 'API\PlayerController@store');
});
