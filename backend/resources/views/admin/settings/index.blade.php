@extends('layouts.admin')
@section('title','Settings')
@section('content')
<div class="max-w-2xl">
    <div class="glass-card rounded-xl p-6">
        <h2 class="font-semibold mb-6 text-sm">Site Settings</h2>
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Site Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'engineersTech') }}" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? 'AI-Driven Software Engineering') }}" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'info@engineerstechbd.com') }}" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '+880-18737-22228') }}" class="admin-input">
            </div>
            <div>
                <label class="block text-xs mb-1.5" style="color:var(--muted)">Address</label>
                <input type="text" name="address" value="{{ old('address', $settings['address'] ?? 'Dhaka, Bangladesh') }}" class="admin-input">
            </div>
            <div class="pt-2">
                <button type="submit" class="btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
