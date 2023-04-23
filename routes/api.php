<?php

use App\Http\Controllers\ApiLogin;
use App\Http\Controllers\Statistics;
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

Route::get('/login', ApiLogin::class);
Route::get('/statistics', Statistics::class)
    ->middleware(['auth:sanctum']);
