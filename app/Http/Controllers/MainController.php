<?php

namespace App\Http\Controllers;

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
        return view('main.index', compact('posts'));
    }

    public function categories()
    {
        $pageDescription = 'Categories';
        return view('main.categories', compact('pageDescription'));
    }
}
