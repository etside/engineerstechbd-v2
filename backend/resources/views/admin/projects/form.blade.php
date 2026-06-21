@extends('layouts.admin')
@section('title', isset($project->id) ? 'Edit Project' : 'New Project')
@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.projects.index') }}" class="text-xs mb-6 block" style="color:var(--muted)">&larr; Back to Projects</a>
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">{{ isset($project->id) ? 'Edit Project' : 'New Project' }}</h2>
        <form method="POST"
              action="{{ isset($project->id) ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf @if(isset($project->id)) @method('PUT') @endif

            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Project Name *</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}" class="admin-input" required>
                @error('name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Description</label>
                <textarea name="description" rows="3" class="admin-input">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Project URL</label>
                    <input type="url" name="url" value="{{ old('url', $project->url) }}" class="admin-input" placeholder="https://...">
                    @error('url')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs mb-1.5" style="color:var(--muted)">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $project->display_order ?? 0) }}" class="admin-input">
                </div>
            </div>

            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Logo</label>
                @if(isset($project->logo_url) && $project->logo_url)
                <img src="{{ asset($project->logo_url) }}" class="h-12 mb-2 rounded object-contain bg-white/5 px-2">
                @endif
                <input type="file" name="logo" accept="image/*" class="admin-input">
            </div>

            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Features <span style="color:var(--muted);font-weight:400">(one per line or comma-separated)</span></label>
                <textarea name="features" rows="4" class="admin-input" placeholder="User authentication&#10;Dashboard analytics&#10;API integrations">{{ old('features', $project->features) }}</textarea>
            </div>

            {{-- Login credentials — admin-only, not exposed publicly --}}
            <div class="rounded-lg p-4 space-y-3" style="background:rgba(38,132,255,0.06);border:1px solid rgba(38,132,255,0.15)">
                <p class="text-xs font-semibold" style="color:#2684FF">&#128274; Project Login Credentials <span class="font-normal" style="color:var(--muted)">(admin-only — never shown publicly)</span></p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs mb-1.5" style="color:var(--muted)">Username / Email</label>
                        <input type="text" name="login_username" value="{{ old('login_username', $project->login_username) }}" class="admin-input" autocomplete="off">
                    </div>
                    <div>
                        <label class="block text-xs mb-1.5" style="color:var(--muted)">Password</label>
                        <div class="relative">
                            <input type="password" name="login_password" id="login_password"
                                   value="{{ old('login_password', $project->login_password) }}"
                                   class="admin-input pr-10" autocomplete="new-password">
                            <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs" style="color:var(--muted)">Show</button>
                        </div>
                    </div>
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}>
                Active
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">{{ isset($project->id) ? 'Update Project' : 'Create Project' }}</button>
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2 rounded-lg text-sm" style="border:1px solid var(--border);color:var(--muted)">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
function togglePwd() {
    const f = document.getElementById('login_password');
    f.type = f.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
