<?php

namespace App\Http\Controllers;

use App\Articles;
use App\ArticlesComments;
use App\Categories;
use App\Subscribers;
use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

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
        if (\Auth::guest()) {
            $articles = Articles::latest()->published()->simplePaginate(Articles::itemsPerPage);
        }
        else {
            $articles = Articles::latest()->simplePaginate(Articles::itemsPerPage);
        }
        $pageDescription = 'Some description';

        return view('articles.index', compact('articles', 'pageDescription'));
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

        $tag_ids = $this->checkTags($request->input('tags_id'));

        $article->tags()->attach($tag_ids);

        if ($article->is_published == Articles::isPublished) {
            $this->sendEmails($article);
        }

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($y, $m, $d, $alias)
    {
        if (\Auth::guest()) {
            $article = Articles::where('alias', $alias)->published()->first();
        }
        else {
            $article = Articles::where('alias', $alias)->first();
        }
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
        $article = Articles::findOrFail($id);
        $categories = Categories::lists('name', 'id');
        $tags = Tags::lists('name', 'id');
        $selected_tags = $article->tags()->lists('id')->all();

        return view('articles.update', compact('article', 'categories', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $article = Articles::findOrFail($id);

        $input = $request->all();
        $input['is_published'] = $request->input('is_published', 0);
        $article->update($input);

        $tag_ids = $this->checkTags($request->input('tags_id'));

        $article->tags()->sync($tag_ids);

        if ($article->is_published == Articles::isPublished) {
            $this->sendEmails($article);
        }

        \Flash::success('Article updated');
        return redirect()->action('ArticlesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $article = Articles::findOrFail($id);

        if ($article->delete()) {
            \Flash::success('Article deleted');
        }
        else {
            \Flash::error('Error');
        }
        return 'done';
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

    /**
     * Check tags_id input and create tags if not number in input
     *
     * @param array $tags
     * @return array tags_ids
     */
    public function checkTags(array $tags)
    {
        $tag_ids = [];
        foreach ($tags as $tag_input) {
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
        return $tag_ids;
    }

    /**
     * Emails to subscribers
     *
     * @param Articles $article
     */
    public function sendEmails(Articles $article)
    {
        $subscribers = Subscribers::all();
        foreach ($subscribers as $subscriber) {
            Mail::send('layouts.email', compact('subscriber', 'article'), function ($m) use ($subscriber, $article) {
                $m->to($subscriber->email, $subscriber->email)->subject($article->title);
            });
        }
    }
}
