<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index() { return view('admin.blog.index', ['posts' => BlogPost::orderByDesc('created_at')->get()]); }
    public function create() { return view('admin.blog.form', ['post' => new BlogPost]); }

    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required|max:255','slug'=>'required|unique:blog_posts,slug|max:255','excerpt'=>'nullable','content'=>'nullable','category'=>'nullable|max:100','is_published'=>'boolean']);
        $data['is_active'] = true;
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['author_id'] = auth()->id();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = '/storage/' . $request->file('cover_image')->store('blog-covers','public');
        }
        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success','Post created.');
    }

    public function edit(BlogPost $blog) { return view('admin.blog.form', ['post' => $blog]); }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate(['title'=>'required|max:255','slug'=>'required|max:255','excerpt'=>'nullable','content'=>'nullable','category'=>'nullable|max:100','is_published'=>'boolean']);
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && !$blog->published_at) $data['published_at'] = now();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = '/storage/' . $request->file('cover_image')->store('blog-covers','public');
        }
        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('success','Post updated.');
    }

    public function destroy(BlogPost $blog) { $blog->delete(); return redirect()->route('admin.blog.index')->with('success','Deleted.'); }
}
