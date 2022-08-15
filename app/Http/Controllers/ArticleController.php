<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ResourcesArticle;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $this->authorize('view', $article);
        return new ResourcesArticle($article);
    }


   public function store(Request $request)
    {
        $this->authorize('create', Article::class);
        $validateData = $request->validate([]);

        $path = $request->image->store('public/articles');
        $article = Article::create([
            'user_id' => Auth::user()->id,
            $request->all(),
            'image' =>  $path
        ]);

        // $article->image = $path;

        // $article->save();

        return response()->json($article, 201);
    }


    public function update(Request $request, Article $article)
    {
        $this->authorize('update',$article);
        $article->update($request->all());
        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }


    public function image(Article $article)
    {
        return response()->download(public_path(Storage::url($article->image)), $article->title);
    }
}
