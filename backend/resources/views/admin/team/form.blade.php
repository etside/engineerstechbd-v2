@extends('layouts.admin')
@section('title', isset($member->id) ? 'Edit Member' : 'Add Member')
@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.team.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back</a>
    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ isset($member->id) ? route('admin.team.update', $member) : route('admin.team.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @if(isset($member->id)) @method('PUT') @endif
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation', $member->designation) }}" class="admin-input">
                </div>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Bio</label>
                <textarea name="bio" rows="3" class="admin-input">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Photo</label>
                @if(isset($member->photo_url) && $member->photo_url)
                <img src="{{ asset($member->photo_url) }}" class="w-16 h-16 rounded-full object-cover mb-2">
                @endif
                <input type="file" name="photo" accept="image/*" class="admin-input">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" class="admin-input">
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $member->whatsapp_number) }}" class="admin-input">
                </div>
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $member->display_order ?? 0) }}" class="admin-input">
            </div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>Active
            </label>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($member->id) ? 'Update' : 'Add Member' }}</button>
                <a href="{{ route('admin.team.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
