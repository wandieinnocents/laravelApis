<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// POSTS API
// get posts api route  .
Route::get('/posts',[PostApiController::class ,'index']);

// create posts api route
Route::post('/posts',[PostApiController::class ,'store']);

// return single post
Route::get('/posts/{id}',[PostApiController::class ,'show']);

// update post api //{post} = {id}
Route::put('/posts/{id}',[PostApiController::class, 'update']);

// delete route for posts api
Route::delete('/posts/{id}',[PostApiController::class , 'destroy']);
