@extends('layouts.admin')
@section('title', isset($service->id) ? 'Edit Service' : 'New Service')
@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.services.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back to Services</a>
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">{{ isset($service->id) ? 'Edit Service' : 'New Service' }}</h2>
        <form method="POST" action="{{ isset($service->id) ? route('admin.services.update', $service) : route('admin.services.store') }}" class="space-y-4">
            @csrf
            @if(isset($service->id)) @method('PUT') @endif
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Title *</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" class="admin-input" required>
                @error('title')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Description</label>
                <textarea name="description" rows="4" class="admin-input">{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Icon (lucide name)</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="admin-input" placeholder="e.g. Code, Smartphone">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $service->display_order ?? 0) }}" class="admin-input">
                </div>
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                Active
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($service->id) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
