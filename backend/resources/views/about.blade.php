@extends('layouts.app')
@section('title','About Us')
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">About <span class="gradient-text">engineersTech</span></h1>
        <p class="text-sm max-w-2xl mx-auto leading-relaxed" style="color:var(--muted)">A Bangladesh-based software engineering firm delivering enterprise-grade solutions with a lean team of skilled engineers, powered by AI.</p>
    </div>
    @if($team->count())
    <h2 class="text-2xl font-bold text-center mb-10">Our <span class="gradient-text">Team</span></h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($team as $m)
        <div class="glass-card rounded-xl p-6 text-center">
            @if($m->photo_url)
            <img src="{{ asset($m->photo_url) }}" alt="{{ $m->name }}" class="w-20 h-20 rounded-full object-cover mx-auto mb-4">
            @else
            <div class="w-20 h-20 rounded-full gradient-bg flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">{{ strtoupper(substr($m->name,0,1)) }}</div>
            @endif
            <h3 class="font-semibold">{{ $m->name }}</h3>
            <p class="text-xs mb-3" style="color:#2684FF">{{ $m->designation }}</p>
            <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">{{ $m->bio }}</p>
            <div class="flex justify-center gap-3">
                @if($m->linkedin_url)<a href="{{ $m->linkedin_url }}" target="_blank" class="text-xs" style="color:var(--muted)">LinkedIn</a>@endif
                @if($m->whatsapp_number)<a href="https://wa.me/{{ $m->whatsapp_number }}" target="_blank" class="text-xs" style="color:var(--muted)">WhatsApp</a>@endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
</div>
@endsection
