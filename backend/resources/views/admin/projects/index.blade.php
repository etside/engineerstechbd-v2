@extends('layouts.admin')
@section('title','Projects')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">All Projects</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ Add Project</a>
</div>
<div class="glass-card rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead style="border-bottom:1px solid var(--border)">
            <tr class="text-xs" style="color:var(--muted)">
                <th class="px-4 py-3 text-left">Project</th>
                <th class="px-4 py-3 text-left hidden sm:table-cell">URL</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Login</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $p)
            <tr style="border-bottom:1px solid var(--border)">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @if($p->logo_url)
                        <img src="{{ asset($p->logo_url) }}" alt="" class="w-8 h-8 rounded object-contain bg-white/5">
                        @else
                        <div class="w-8 h-8 rounded flex items-center justify-center text-xs font-bold" style="background:rgba(38,132,255,0.15);color:#2684FF">{{ strtoupper(substr($p->name,0,1)) }}</div>
                        @endif
                        <div>
                            <p class="font-medium">{{ $p->name }}</p>
                            @if($p->description)<p class="text-xs mt-0.5" style="color:var(--muted)">{{ Str::limit($p->description, 50) }}</p>@endif
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 hidden sm:table-cell text-xs" style="color:var(--muted)">
                    @if($p->url)<a href="{{ $p->url }}" target="_blank" style="color:#2684FF">{{ Str::limit($p->url, 35) }}</a>@else—@endif
                </td>
                <td class="px-4 py-3 hidden md:table-cell">
                    @if($p->login_username)
                    <div class="text-xs font-mono" style="color:var(--muted)">
                        <span style="color:var(--fg)">{{ $p->login_username }}</span> / <span>{{ str_repeat('•', strlen($p->login_password)) }}</span>
                    </div>
                    @else
                    <span class="text-xs" style="color:var(--muted)">—</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-0.5 rounded" style="{{ $p->is_active ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(248,113,113,0.1);color:#F87171' }}">
                        {{ $p->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.projects.edit', $p) }}" class="text-xs mr-3" style="color:#2684FF">Edit</a>
                    <form method="POST" action="{{ route('admin.projects.destroy', $p) }}" class="inline" onsubmit="return confirm('Delete this project?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$projects->count())
    <p class="text-center py-10 text-sm" style="color:var(--muted)">No projects yet.</p>
    @endif
</div>
@endsection
