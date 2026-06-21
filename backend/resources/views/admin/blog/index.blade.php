@extends('layouts.admin')
@section('title','Blog Posts')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">All Blog Posts</h2>
    <a href="{{ route('admin.blog.create') }}" class="btn-primary">+ New Post</a>
</div>
<div class="glass-card rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead style="border-bottom:1px solid var(--border)">
            <tr class="text-xs" style="color:var(--muted)">
                <th class="px-4 py-3 text-left">Title</th>
                <th class="px-4 py-3 text-left hidden sm:table-cell">Category</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $p)
            <tr style="border-bottom:1px solid var(--border)">
                <td class="px-4 py-3">
                    <p class="font-medium">{{ $p->title }}</p>
                    <p class="text-xs" style="color:var(--muted)">{{ $p->slug }}</p>
                </td>
                <td class="px-4 py-3 hidden sm:table-cell text-xs" style="color:var(--muted)">{{ $p->category }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded" style="{{ $p->is_published ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(148,163,184,0.1);color:#94A3B8' }}">{{ $p->is_published ? 'Published' : 'Draft' }}</span></td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.blog.edit', $p) }}" class="text-xs mr-3" style="color:#2684FF">Edit</a>
                    <form method="POST" action="{{ route('admin.blog.destroy', $p) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$posts->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No posts yet.</p>@endif
</div>
@endsection
