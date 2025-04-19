<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sheets\Facades\Sheets;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Sheets::collection('posts')->all();

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Sheets::collection('posts')->get($slug);

        return view('blog.show', compact('post'));
    }
}
