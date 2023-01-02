<?php

use App\Http\Controllers\GithubController;
use App\Http\Controllers\ProjectsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/updateProjectStatus', [ProjectsController::class, 'updateProjectStatus']);
Route::get('/refreshProjectData', [ProjectsController::class, 'refreshProjectData']);
Route::get('/loadGithubRepositories', [GithubController::class, 'loadGithubRepositories']);

Route::get('{repository}/getRepositoryFiles', [GithubController::class, 'getRepositoryFiles']);
