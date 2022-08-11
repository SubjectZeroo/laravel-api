<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ResourcesArticle;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        // return Article::all();

        return new ArticleCollection(Article::paginate());

    }

    public function show(Article $article)
    {
        return new ResourcesArticle($article);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required'
        ]);

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|string|unique:articles|max:255',
        //     'body' => 'required'
        // ]);

        // if($validator->fails()) {
        //     return response()->json(['error' => 'data_validation_failed', "error_list" => $validator->errors()], 400);
        // }

        $article = Article::create(['user_id' => Auth::user()->id, $request->all() ]);
        return response()->json($article, 201);
    }


    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
