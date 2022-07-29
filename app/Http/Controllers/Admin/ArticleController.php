<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::withCount('comments')->latest('published_at')->paginate();

        return view('admin.dashboard', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.createArticle', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|max:5000',
            'published_at' => 'nullable|date|after:yesterday|before:1 year',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->user_id = Auth::user()->id;
        if (isset($validated['published_at'])) {
            $article->published_at = $validated['published_at'];
        } else {
            $article->published_at = date_create()->format('Y-m-d H:i:s');
        }
        $article->save();

        return redirect(route('dashboard'))->with('success', 'Votre article a bien été enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->loadCount('comments');

        return view('admin.article', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.editArticle', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|max:5000',
            'id' => 'required|exists:App\Models\Article,id',
        ]);

        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->save();

        return redirect(route('articles.show.admin', ['article' => $article]))->with('success', 'Votre article a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->comments()->delete();
        $article->delete();

        return redirect(route('dashboard'))->with('success', 'Votre article a bien été supprimé');
    }
}
