@extends('layouts.admin')
@section('title','Testimonials')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ Add Testimonial</a>
</div>
<div class="space-y-2">
    @foreach($testimonials as $t)
    <div class="glass-card rounded-xl p-4 flex items-start justify-between">
        <div class="flex items-center gap-3">
            @if($t->photo_url)
            <img src="{{ asset($t->photo_url) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover shrink-0">
            @else
            <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold text-sm shrink-0">{{ strtoupper(substr($t->name,0,1)) }}</div>
            @endif
            <div>
                <p class="font-medium text-sm">{{ $t->name }}</p>
                <p class="text-xs" style="color:var(--muted)">{{ $t->role }}@if($t->company), {{ $t->company }}@endif</p>
                <p class="text-xs mt-1 italic" style="color:var(--muted)">"{{ Str::limit($t->quote, 80) }}"</p>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-xs" style="color:#2684FF">Edit</a>
            <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button></form>
        </div>
    </div>
    @endforeach
    @if(!$testimonials->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No testimonials yet.</p>@endif
</div>
@endsection
