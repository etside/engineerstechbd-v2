@extends('layouts.app')
@section('title','Products')
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Our <span class="gradient-text">Products</span></h1>
        <p class="text-sm max-w-xl mx-auto" style="color:var(--muted)">Powerful SaaS products built to solve real business problems.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $p)
        <div class="glass-card rounded-xl p-6">
            <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center mb-4 text-white">&#9670;</div>
            <h3 class="font-semibold mb-2">{{ $p->name }}</h3>
            <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">{{ $p->description }}</p>
            @if($p->external_url)
            <a href="{{ $p->external_url }}" target="_blank" class="text-xs font-medium" style="color:#2684FF">Learn more &rarr;</a>
            @endif
        </div>
        @endforeach
    </div>
    @if(!$products->count())
    <p class="text-center py-16" style="color:var(--muted)">No products available yet.</p>
    @endif
</div>
</div>
@endsection
