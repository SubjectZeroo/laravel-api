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

Route::get('articles', function () {
    return Article::all();
});

Route::get('articles/{article}', function ($article) {
    return Article::find($article);
});

Route::post('articles', function (Request $request) {
    return Article::create($request->all());
});


Route::put('articles/{id}', function (Request $request, $id) {
    $article = Article::findOrFail($id);
    $article->update($request->all());
    return $article;
});

Route::delete('articles/{article}', function ($article) {
    Article::find($article)->delete();
    return 204;
});
