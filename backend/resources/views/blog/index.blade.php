@extends('layouts.app')
@section('title','Blog')
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Our <span class="gradient-text">Blog</span></h1>
        <p class="text-sm" style="color:var(--muted)">Insights, updates and engineering stories from our team.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $p)
        <a href="{{ route('blog.show', $p->slug) }}" class="glass-card rounded-xl overflow-hidden hover:border-blue-500/30 transition-colors block">
            @if($p->cover_image)
            <img src="{{ asset($p->cover_image) }}" alt="{{ $p->title }}" class="w-full h-44 object-cover">
            @endif
            <div class="p-5">
                @if($p->category)<span class="text-xs font-medium px-2 py-1 rounded" style="background:rgba(38,132,255,0.1);color:#2684FF">{{ $p->category }}</span>@endif
                <h3 class="font-semibold mt-3 mb-2">{{ $p->title }}</h3>
                <p class="text-xs leading-relaxed" style="color:var(--muted)">{{ Str::limit($p->excerpt, 120) }}</p>
                <p class="text-xs mt-3" style="color:var(--muted)">{{ $p->published_at?->format('M d, Y') }}</p>
            </div>
        </a>
        @endforeach
    </div>
    @if(!$posts->count())
    <p class="text-center py-16" style="color:var(--muted)">No blog posts yet.</p>
    @endif
    <div class="mt-8">{{ $posts->links() }}</div>
</div>
</div>
@endsection
