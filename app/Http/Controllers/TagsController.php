<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Tags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pageDescription = 'Tags';
        $tags = Tags::all();
        return view('tags.index', compact('tags', 'pageDescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Tags::create($request->all());

        \Flash::success('Tag created');

        return redirect('/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $name
     * @return Response
     */
    public function show($name)
    {
        $tag = Tags::where('name', $name)->first();
        if (!$tag) {
            return redirect()->action('CategoriesController@index');
        }

        $pageDescription = 'Tag: '.$name;
        $articles = $tag->articles()->simplePaginate(Articles::itemsPerPage);

        return view('articles.index', compact('articles', 'pageDescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = Tags::findOrFail($id);

        return view('tags.update', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $tag = Tags::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $tag->update($request->all());
        \Flash::success('Tag updated');

        return redirect()->action('TagsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);

        if ($tag->delete()) {
            \Flash::success('Tag deleted');
        }
        else {
            \Flash::error('Error');
        }
        return 'done';
    }
}
