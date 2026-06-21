@extends('layouts.app')
@section('title','Home')
@section('content')
{{-- HERO --}}
<section class="relative flex items-start min-h-screen pt-20 pb-16 overflow-hidden">
    <div class="absolute top-1/4 -left-32 w-96 h-96 rounded-full blur-[120px]" style="background:rgba(0,82,204,0.12)"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 rounded-full blur-[120px]" style="background:rgba(38,132,255,0.08)"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-medium mb-5" style="border:1px solid rgba(38,132,255,0.3);background:rgba(38,132,255,0.05);color:#2684FF">
                ✦ AI-Driven Software Engineering
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight mb-5">
                We Build Software <span class="gradient-text">That Drives</span> Your Business Forward
            </h1>
            <p class="text-sm lg:text-base mb-8 max-w-xl leading-relaxed" style="color:var(--muted)">
                Enterprise-grade software solutions from a lean team of skilled engineers. More value, affordable cost, powered by AI. <span style="color:var(--fg);font-weight:500">#drivenByEngineers</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 h-12 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Get Started →</a>
                <a href="{{ route('services') }}" class="inline-flex items-center gap-2 px-8 h-12 rounded-lg text-sm font-medium" style="border:1px solid rgba(255,255,255,0.15);color:var(--fg)">Our Services</a>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
@if($services->count())
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">What We <span class="gradient-text">Build</span></h2>
            <p class="text-sm" style="color:var(--muted)">Tailored solutions across the full stack</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($services as $s)
            <div class="glass-card rounded-xl p-6 hover:border-blue-500/30 transition-colors">
                <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center mb-4 text-white text-lg">◈</div>
                <h3 class="font-semibold mb-2">{{ $s->title }}</h3>
                <p class="text-xs leading-relaxed" style="color:var(--muted)">{{ $s->description }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8"><a href="{{ route('services') }}" class="text-sm font-medium" style="color:#2684FF">View all services →</a></div>
    </div>
</section>
@endif

{{-- CLIENT LOGOS --}}
@if($logos->count())
<section class="py-16" style="border-top:1px solid rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.05)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs font-medium uppercase tracking-widest mb-8" style="color:var(--muted)">Trusted by companies worldwide</p>
        <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-12">
            @foreach($logos as $logo)
            @if($logo->logo_url)
            <img src="{{ asset($logo->logo_url) }}" alt="{{ $logo->name }}" class="h-8 object-contain opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
            @else
            <span class="text-sm font-semibold" style="color:var(--muted)">{{ $logo->name }}</span>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">What Clients <span class="gradient-text">Say</span></h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($testimonials as $t)
            <div class="glass-card rounded-xl p-6">
                <div class="flex mb-3">@for($i=0;$i<$t->rating;$i++)<span style="color:#FBBF24">★</span>@endfor</div>
                <p class="text-sm leading-relaxed mb-4" style="color:var(--muted)">"{{ $t->quote }}"</p>
                <div class="flex items-center gap-3">
                    @if($t->photo_url)
                    <img src="{{ asset($t->photo_url) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                    <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white text-sm font-bold">{{ strtoupper(substr($t->name,0,1)) }}</div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold">{{ $t->name }}</p>
                        <p class="text-xs" style="color:var(--muted)">{{ $t->role }}@if($t->company), {{ $t->company }}@endif</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-2xl p-10 text-center" style="background:linear-gradient(135deg,rgba(0,82,204,0.15),rgba(38,132,255,0.1))">
            <h2 class="text-2xl sm:text-3xl font-bold mb-4">Ready to build something <span class="gradient-text">great?</span></h2>
            <p class="text-sm mb-8 max-w-md mx-auto" style="color:var(--muted)">Let us turn your idea into a production-ready product. Fast, affordable, powered by AI.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 h-12 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Start a Project →</a>
        </div>
    </div>
</section>
@endsection
