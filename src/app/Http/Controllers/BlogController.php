<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sheets\Facades\Sheets;
use Inertia\Inertia;
use Spatie\Sheets\Sheet;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Sheets::collection('posts')->all();
        $posts = collect($posts)->sortByDesc(function ($post) {
            return $post->date;
        })->values()->all();

        return Inertia::render('blog/Index', [
            'posts' => $posts
        ]);
    }

    public function show(Sheet $post)
    {
        // Have to cast the contents to string because
        // Vue doesnt handle HtmlString like Blade would
        $content = (string) $post->contents;

        return Inertia::render('blog/Show', [
            'post' => $post,
            'content' => $content,
        ]);
    }
}
