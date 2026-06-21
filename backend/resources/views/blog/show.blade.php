@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    @if($post->cover_image)
    <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-64 sm:h-80 object-cover rounded-2xl mb-8">
    @endif
    @if($post->category)
    <span class="text-xs font-medium px-2 py-1 rounded" style="background:rgba(38,132,255,0.1);color:#2684FF">{{ $post->category }}</span>
    @endif
    <h1 class="text-2xl sm:text-3xl font-bold mt-4 mb-3">{{ $post->title }}</h1>
    <p class="text-xs mb-8" style="color:var(--muted)">{{ $post->published_at?->format('F d, Y') }}</p>
    @if($post->excerpt)
    <p class="text-base leading-relaxed mb-6 font-medium" style="color:var(--muted)">{{ $post->excerpt }}</p>
    @endif
    <div class="prose prose-invert prose-sm max-w-none" style="color:var(--fg)">
        {!! nl2br(e($post->content)) !!}
    </div>
    <div class="mt-10 pt-6" style="border-top:1px solid rgba(255,255,255,0.08)">
        <a href="{{ route('blog') }}" class="text-sm" style="color:#2684FF">&larr; Back to Blog</a>
    </div>
</div>
</div>
@endsection
