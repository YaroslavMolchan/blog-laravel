<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Posts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Posts::simplePaginate(5);
        return view('articles.index', compact('posts'));
    }

    public function categories()
    {
        $pageDescription = 'Categories';

        $categories = Categories::simplePaginate(10);
        return view('main.categories', compact('categories', 'pageDescription'));
    }
}
