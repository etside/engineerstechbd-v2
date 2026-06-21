@extends('layouts.admin')
@section('title', isset($testimonial->id) ? 'Edit Testimonial' : 'Add Testimonial')
@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.testimonials.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ isset($testimonial->id) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($testimonial->id)) @method('PUT') @endif
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Role</label>
                    <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Company</label>
                    <input type="text" name="company" value="{{ old('company', $testimonial->company) }}" class="admin-input">
                </div>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Quote *</label>
                <textarea name="quote" rows="3" class="admin-input" required>{{ old('quote', $testimonial->quote) }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Photo</label>
                    @if(isset($testimonial->photo_url) && $testimonial->photo_url)
                    <img src="{{ asset($testimonial->photo_url) }}" class="w-12 h-12 rounded-full object-cover mb-2">
                    @endif
                    <input type="file" name="photo" accept="image/*" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $testimonial->display_order ?? 0) }}" class="admin-input">
                </div>
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>Active
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($testimonial->id) ? 'Update' : 'Add' }}</button>
                <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
