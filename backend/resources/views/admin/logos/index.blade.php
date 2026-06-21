@extends('layouts.admin')
@section('title','Client Logos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">Client Logos</h2>
    <a href="{{ route('admin.logos.create') }}" class="btn-primary">+ Add Logo</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($logos as $logo)
    <div class="glass-card rounded-xl p-4 text-center">
        @if($logo->logo_url)
        <img src="{{ $logo->logo_url }}" alt="{{ $logo->name }}" class="h-10 mx-auto mb-2 object-contain">
        @endif
        <p class="text-xs font-medium">{{ $logo->name }}</p>
        <div class="flex justify-center gap-2 mt-3">
            <a href="{{ route('admin.logos.edit', $logo) }}" class="text-xs" style="color:#2684FF">Edit</a>
            <form method="POST" action="{{ route('admin.logos.destroy', $logo) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
            <button type="submit" class="btn-danger">Del</button></form>
        </div>
    </div>
    @endforeach
    @if(!$logos->count())<p class="col-span-full text-center py-10 text-sm" style="color:var(--muted)">No logos yet.</p>@endif
</div>
@endsection
