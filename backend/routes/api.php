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

// process routes
Route::post('process', 'App\Http\Controllers\ProcessController@postProcess');
Route::get('process', 'App\Http\Controllers\ProcessController@getProcessList');

Route::post('process/{id}/start', 'App\Http\Controllers\ProcessController@startProcess');
Route::post('process/{id}/finished', 'App\Http\Controllers\ProcessController@finishedProcess');

//process type routes
Route::get('process_type', 'App\Http\Controllers\ProcessTypeController@getProcessTypeList');
