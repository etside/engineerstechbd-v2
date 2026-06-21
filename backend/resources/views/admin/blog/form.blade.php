@extends('layouts.admin')
@section('title', isset($post->id) ? 'Edit Post' : 'New Post')
@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.blog.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ isset($post->id) ? route('admin.blog.update', $post) : route('admin.blog.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($post->id)) @method('PUT') @endif
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Slug *</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" class="admin-input" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Category</label>
                    <input type="text" name="category" value="{{ old('category', $post->category) }}" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Cover Image</label>
                    @if(isset($post->cover_image) && $post->cover_image)
                    <img src="{{ $post->cover_image }}" class="h-16 mb-2 rounded object-cover">
                    @endif
                    <input type="file" name="cover_image" accept="image/*" class="admin-input">
                </div>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Excerpt</label>
                <textarea name="excerpt" rows="2" class="admin-input">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Content</label>
                <textarea name="content" rows="12" class="admin-input">{{ old('content', $post->content) }}</textarea>
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>Published
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($post->id) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.blog.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('title').addEventListener('input', function() {
    if (!{{ isset($post->id) ? 'true' : 'false' }}) {
        document.getElementById('slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    }
});
</script>
@endsection
