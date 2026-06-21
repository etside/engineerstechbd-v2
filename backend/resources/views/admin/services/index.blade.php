@extends('layouts.admin')
@section('title','Services')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">All Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn-primary">+ Add Service</a>
</div>
<div class="glass-card rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead style="border-bottom:1px solid var(--border)">
            <tr class="text-xs" style="color:var(--muted)">
                <th class="px-4 py-3 text-left">Title</th>
                <th class="px-4 py-3 text-left hidden sm:table-cell">Order</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $s)
            <tr style="border-bottom:1px solid var(--border)">
                <td class="px-4 py-3 font-medium">{{ $s->title }}</td>
                <td class="px-4 py-3 hidden sm:table-cell" style="color:var(--muted)">{{ $s->display_order }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded" style="{{ $s->is_active ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(248,113,113,0.1);color:#F87171' }}">{{ $s->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.services.edit', $s) }}" class="text-xs mr-3" style="color:#2684FF">Edit</a>
                    <form method="POST" action="{{ route('admin.services.destroy', $s) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$services->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No services yet.</p>@endif
</div>
@endsection
