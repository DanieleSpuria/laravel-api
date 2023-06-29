<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ProjectController;
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

Route::namespace('Api')
        ->prefix('projects')
        ->group(function() {
          Route::get('/', [ProjectController::class, 'index']);
          Route::get('/types/{id}', [ProjectController::class, 'getTypes']);
          Route::get('/technologies/{id}', [ProjectController::class, 'getTechnologies']);
          Route::get('/{slug}', [ProjectController::class, 'getProject']);
        });

Route::post('/contacts', [LeadController::class, 'store']);
