@extends('layouts.app')
@section('title','Contact')
@section('content')
<div class="pt-24 pb-20">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Get In <span class="gradient-text">Touch</span></h1>
        <p class="text-sm" style="color:var(--muted)">Let us know about your project. We will respond within 24 hours.</p>
    </div>
    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl text-sm text-green-400" style="background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.2)">{{ session('success') }}</div>
    @endif
    <div class="glass-card rounded-2xl p-8">
        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
            @csrf
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-medium mb-1.5" style="color:var(--muted)">Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg text-sm outline-none focus:ring-1 ring-blue-500" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:var(--fg)" required>
                    @error('name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-medium mb-1.5" style="color:var(--muted)">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg text-sm outline-none focus:ring-1 ring-blue-500" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:var(--fg)" required>
                    @error('email')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-medium mb-1.5" style="color:var(--muted)">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-lg text-sm outline-none" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:var(--fg)">
                </div>
                <div>
                    <label class="block text-xs font-medium mb-1.5" style="color:var(--muted)">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-4 py-3 rounded-lg text-sm outline-none" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:var(--fg)">
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium mb-1.5" style="color:var(--muted)">Message *</label>
                <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-lg text-sm outline-none" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);color:var(--fg)" required>{{ old('message') }}</textarea>
                @error('message')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="px-8 py-3 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Send Message &rarr;</button>
        </form>
    </div>
</div>
</div>
@endsection
