@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['Services', $counts['services'], route('admin.services.index'), '#0052CC'],
        ['Products', $counts['products'], route('admin.products.index'), '#2684FF'],
        ['Projects', $counts['projects'], route('admin.projects.index'), '#7C3AED'],
        ['Blog Posts', $counts['blog_posts'], route('admin.blog.index'), '#9333EA'],
        ['Team Members', $counts['team'], route('admin.team.index'), '#059669'],
        ['Testimonials', $counts['testimonials'], route('admin.testimonials.index'), '#D97706'],
        ['Client Logos', $counts['logos'], route('admin.logos.index'), '#DC2626'],
        ['Unread Messages', $counts['submissions'], route('admin.submissions.index'), '#0891B2'],
    ] as [$label, $count, $url, $color])
    <a href="{{ $url }}" class="glass-card rounded-xl p-5 hover:border-blue-500/30 transition-colors">
        <p class="text-2xl font-bold" style="color:{{ $color }}">{{ $count }}</p>
        <p class="text-xs mt-1" style="color:var(--muted)">{{ $label }}</p>
    </a>
    @endforeach
</div>
<div class="glass-card rounded-xl p-6">
    <h2 class="font-semibold mb-4 text-sm">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.blog.create') }}" class="btn-primary">+ New Post</a>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary">+ Add Project</a>
        <a href="{{ route('admin.team.create') }}" class="btn-primary">+ Add Team Member</a>
        <a href="{{ route('admin.services.create') }}" class="btn-primary">+ Add Service</a>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">+ Add Product</a>
    </div>
</div>
@endsection
