@extends('layouts.app')
@section('title','Services')
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Our <span class="gradient-text">Services</span></h1>
        <p class="text-sm max-w-xl mx-auto" style="color:var(--muted)">Enterprise-grade software engineering solutions tailored to your business needs.</p>
    </div>
    <div class="grid sm:grid-cols-2 gap-6">
        @foreach($services as $s)
        <div class="glass-card rounded-xl p-8">
            <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center mb-5 text-white text-xl">&#9670;</div>
            <h3 class="text-lg font-semibold mb-3">{{ $s->title }}</h3>
            <p class="text-sm leading-relaxed" style="color:var(--muted)">{{ $s->description }}</p>
        </div>
        @endforeach
    </div>
    @if(!$services->count())
    <p class="text-center py-16" style="color:var(--muted)">No services available yet.</p>
    @endif
</div>
</div>
@endsection
