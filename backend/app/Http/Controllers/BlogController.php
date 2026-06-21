<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()->paginate(9);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug',$slug)->where('is_published',true)->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
