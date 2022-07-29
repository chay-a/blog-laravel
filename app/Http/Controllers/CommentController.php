<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [];
        $validationRules['content'] = 'required|max:2000';
        $validationRules['articleId'] = 'required|exists:App\Models\Article,id';

        $validationRules['pseudo'] = [
            Rule::excludeIf(Auth::check()),
            'required', 'max:200',
        ];
        $validationRules['email'] = [
            Rule::excludeIf(Auth::check()),
            'required', 'email',
        ];

        $validated = $request->validate($validationRules);

        $comment = new Comment();
        $comment->article_id = $validated['articleId'];
        $comment->content = $validated['content'];
        if (Auth::check()) {
            $comment->user_id = Auth::user()->id;
        } else {
            $comment->pseudo = $validated['pseudo'];
            $comment->email = $validated['email'];
        }

        $comment->save();

        return redirect()->back()->with('success', 'Votre commentaire a bien été enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
