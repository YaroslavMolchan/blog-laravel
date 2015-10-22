<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pageDescription = 'Categories';
        $categories = Categories::all();
        return view('categories.index', compact('categories', 'pageDescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|max:100|unique:categories',
        ]);

        Categories::create($request->all());
        Flash::success('Category created');

        return redirect()->action('CategoriesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return Response
     */
    public function show($name)
    {
        $category = Categories::where('name', $name)->first();
        if (!$category) {
            return redirect()->action('CategoriesController@index');
        }

        $pageDescription = $name;
        $articles = $category->articles()->simplePaginate(2);
//        return view('categories.index', compact('articles', 'pageDescription'));
        
        return $articles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);

        return view('categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $category = Categories::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $category->update($request->all());
        Flash::success('Category updated');

        return redirect()->action('CategoriesController@index');
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
}
