@extends('layouts.admin')
@section('title', isset($logo->id) ? 'Edit Logo' : 'Add Logo')
@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.logos.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ isset($logo->id) ? route('admin.logos.update', $logo) : route('admin.logos.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($logo->id)) @method('PUT') @endif
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Client Name *</label>
                <input type="text" name="name" value="{{ old('name', $logo->name) }}" class="admin-input" required>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Logo Image</label>
                @if(isset($logo->logo_url) && $logo->logo_url)
                <img src="{{ $logo->logo_url }}" class="h-12 mb-2 object-contain">
                @endif
                <input type="file" name="logo" accept="image/*" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Website URL</label>
                <input type="text" name="website_url" value="{{ old('website_url', $logo->website_url) }}" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $logo->display_order ?? 0) }}" class="admin-input">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $logo->is_active ?? true) ? 'checked' : '' }}>Active
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($logo->id) ? 'Update' : 'Add Logo' }}</button>
                <a href="{{ route('admin.logos.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
