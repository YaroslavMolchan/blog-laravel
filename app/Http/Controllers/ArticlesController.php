<?php

namespace App\Http\Controllers;

use App\Articles;
use App\ArticlesComments;
use App\Categories;
use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'createComment']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Articles::latest()->simplePaginate(Articles::itemsPerPage);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categories::lists('name', 'id');
        $tags = Tags::lists('name', 'id');
        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'tags_id' => 'required',
            'title' => 'required|max:250',
            'alias' => 'required|max:250',
            'description' => 'required',
            'short_description' => 'required|max:1000',
            'meta_description' => 'required|max:1000'
        ]);

        $article = new Articles();
        $article->fill($request->all());
        $article->user_id = Auth::user()->id;
        $article->save();

//        $article = Auth::user()->articles()->create($request->all());
        /**
         * Check tags_id input and create tags if not number in input
         */
        $tag_ids = [];
        foreach ($request->input('tags_id') as $tag_input) {
            if (ctype_digit($tag_input)) {
                //it`s number, save to ids array
                array_push($tag_ids, $tag_input);
            }
            else {
                //create new tag with this input name if not exist
                $tag = Tags::where('name', $tag_input)->first();
                if (!$tag) {
                    $tag = Tags::create(['name' => $tag_input]);
                }
                array_push($tag_ids, $tag->id);
            }
        }

        $article->tags()->attach($tag_ids);

        \Flash::success('Article created');

        return redirect()->action('ArticlesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param $y
     * @param $m
     * @param $d
     * @param $alias
     */
    public function show($y, $m, $d, $alias)
    {
        $article = Articles::where('alias', $alias)->first();
        if (!$article) {
            return redirect('/');
        }
        $pageTitle = $article->title;
        $pageDescription = $article->short_description;
        $pageInfo = 'Posted by ' . $article->user->username . ' on ' . $article->created_at->format('F j, Y');
        return view('articles.show', compact('article', 'pageTitle', 'pageDescription', 'pageInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function createComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:1000',
            'username' => 'required|min:2|max:50',
            'email' => 'required|email',
            'url' => 'url'
        ]);

        $article = Articles::findOrFail($id);
        $comment = new ArticlesComments($request->all());
        $article->comments()->save($comment);

        /**
         * I think need to save username, email and url to cookies
         */
        Cookie::queue(Cookie::forever('username', $request->input('username')));
        Cookie::queue(Cookie::forever('email', $request->input('email')));
        Cookie::queue(Cookie::forever('url', $request->input('url')));

        return view('articles.comments', compact('article'));
    }

    public function deleteComment()
    {
        $id = (int) $_GET['id'];
        $comment = ArticlesComments::findOrFail($id);
        $article = $comment->article;
        $comment->delete();
        return view('articles.comments', compact('article'));
    }

    public function urlComment()
    {
        $id = (int) $_GET['id'];
        $comment = ArticlesComments::findOrFail($id);
        $status = ($comment->status == 1) ? 0 : 1;
        $comment->update(['status' => $status]);
        return view('articles.comments', ['article' => $comment->article]);
    }
}
