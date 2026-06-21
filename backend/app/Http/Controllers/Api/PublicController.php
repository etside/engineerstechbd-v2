<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Service, Product, BlogPost, TeamMember, Testimonial, ClientLogo, ContactSubmission, Project};
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function services(Request $request)
    {
        return Service::where('is_active', true)->orderBy('display_order')->when($request->category, fn($q,$v) => $q->where('category', $v))->limit($request->limit ?? 50)->get();
    }

    public function products(Request $request)
    {
        return Product::where('is_active', true)->orderBy('display_order')->when($request->category, fn($q,$v) => $q->where('category', $v))->limit($request->limit ?? 50)->get();
    }

    public function blog()
    {
        return BlogPost::where('is_published', true)
            ->orderByDesc('published_at')
            ->get(['id','slug','title','excerpt','category','cover_image','published_at','is_published']);
    }

    public function blogPost($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return $post;
    }

    public function team()
    {
        return TeamMember::where('is_active', true)->orderBy('display_order')->get();
    }

    public function testimonials()
    {
        return Testimonial::where('is_active', true)->orderBy('display_order')->get();
    }

    public function logos()
    {
        return ClientLogo::where('is_active', true)->orderBy('display_order')->get();
    }

    public function serviceDetail($id)
    {
        return Service::where('is_active', true)->where(fn($q) => $q->where('id', $id)->orWhere('slug', $id))->firstOrFail();
    }

    public function productDetail($id)
    {
        return Product::where('is_active', true)->where(fn($q) => $q->where('id', $id)->orWhere('slug', $id))->firstOrFail();
    }

    public function projects(Request $request)
    {
        return Project::when($request->category, fn($q,$v) => $q->where('industry', $v))->limit($request->limit ?? 50)->get();
    }

    public function projectDetail($id)
    {
        return Project::where(fn($q) => $q->where('id', $id)->orWhere('slug', $id))->firstOrFail();
    }

    public function faq()
    {
        return \App\Models\Faq::orderBy('display_order')->get();
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|max:255',
            'message' => 'required',
            'phone'   => 'nullable|max:30',
        ]);

        ContactSubmission::create($data);

        return response()->json(['message' => 'Message sent successfully']);
    }
}
