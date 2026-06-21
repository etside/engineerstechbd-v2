@extends('layouts.admin')
@section('title','Team Members')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">Team Members</h2>
    <a href="{{ route('admin.team.create') }}" class="btn-primary">+ Add Member</a>
</div>
<div class="space-y-2">
    @foreach($members as $m)
    <div class="glass-card rounded-xl p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            @if($m->photo_url)
            <img src="{{ asset($m->photo_url) }}" alt="{{ $m->name }}" class="w-10 h-10 rounded-full object-cover">
            @else
            <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold text-sm">{{ strtoupper(substr($m->name,0,1)) }}</div>
            @endif
            <div>
                <p class="font-medium text-sm">{{ $m->name }}</p>
                <p class="text-xs" style="color:var(--muted)">{{ $m->designation }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs px-2 py-0.5 rounded" style="{{ $m->is_active ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(248,113,113,0.1);color:#F87171' }}">{{ $m->is_active ? 'Active' : 'Inactive' }}</span>
            <a href="{{ route('admin.team.edit', $m) }}" class="text-xs" style="color:#2684FF">Edit</a>
            <form method="POST" action="{{ route('admin.team.destroy', $m) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button></form>
        </div>
    </div>
    @endforeach
    @if(!$members->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No team members yet.</p>@endif
</div>
@endsection
