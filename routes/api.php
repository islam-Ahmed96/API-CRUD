<?php

use App\Http\Controllers\Apis\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'posts'], function(){

    Route::get('/', [PostController::class, 'index']);
    Route::get('/create', [PostController::class, 'create']);
    Route::Post('/store', [PostController::class,'store']);
    Route::get('/show/{post}', [PostController::class,'show']);
    Route::get('/edit/{post}', [PostController::class,'edit']);
    Route::Post('/update/{post}', [PostController::class, 'update']);
    Route::Post('/delete/{post}', [PostController::class, 'destroy']);

}); 