<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\ArticleCategory;
use DB;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','desc')->paginate(10);;
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('articles.index',compact('articles','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        return view('articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            $string = "";
            foreach ($validator->errors()->getMessages() as $item) {
                $string .= "{$item[0]}<br>";
            }
            return back()->withErrors($validator)->withInput();
        } else {
            $article = new Article;
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->description = $request->description;
            $article->body = $request->body;
            $article->user_id = auth()->user()->id;
            if ($article->save()) {
                $article_category = new ArticleCategory;
                $article_category->article_id = $article->id;
                $article_category->category_id = $request->category_id;
                $article_category->save();
            }
            return redirect()->route('articles.index')->with('success', 'Article added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = DB::table('categories')->pluck('name','id')->prepend('-- select --','')->toArray();
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article','categories'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            $string = "";
            foreach ($validator->errors()->getMessages() as $item) {
                $string .= "{$item[0]}<br>";
            }
            return back()->withErrors($validator)->withInput();
        } else {
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->description = $request->description;
            $article->body = $request->body;
            $article->user_id = auth()->user()->id;
            $article->update();

            $article_category = new ArticleCategory;
            $article_category->article_id = $id;
            $article_category->category_id = $request->category_id;
            $article_category->save();
            return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'article has been deleted');
    }
}
