<?php

use App\Models\Article;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [App\Http\Controllers\UserController::class, 'register']);
Route::post('login', [App\Http\Controllers\UserController::class, 'authenticate']);
Route::get('articles', [App\Http\Controllers\ArticleController::class, 'index']);


Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', [App\Http\Controllers\UserController::class, 'getAuthenticatedUser']);

    //Articles
    Route::get('articles/{article}', [App\Http\Controllers\ArticleController::class, 'show']);
    Route::get('articles/{article}/image', [App\Http\Controllers\ArticleController::class, 'image']);
    Route::post('articles', [App\Http\Controllers\ArticleController::class, 'store']);
    Route::put('articles/{article}', [App\Http\Controllers\ArticleController::class, 'update']);
    Route::delete('articles/{article}', [App\Http\Controllers\ArticleController::class, 'delete']);


    //Comments
    Route::get('articles/{article}/comments', [App\Http\Controllers\CommentController::class, 'show']);
    Route::get('articles{article}/comments/{comment}', [App\Http\Controllers\CommentController::class, 'show']);
    Route::post('articles/{article}/comments', [App\Http\Controllers\CommentController::class, 'store']);
    Route::put('articles/{article}/comments/{comment}', [App\Http\Controllers\CommentController::class, 'update']);
    Route::delete('articles/{article}', [App\Http\Controllers\CommentController::class, 'delete']);
});
