@extends('layouts.admin')
@section('title','Products')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="font-semibold">All Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">+ Add Product</a>
</div>
<div class="glass-card rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead style="border-bottom:1px solid var(--border)">
            <tr class="text-xs" style="color:var(--muted)">
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left hidden sm:table-cell">External URL</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr style="border-bottom:1px solid var(--border)">
                <td class="px-4 py-3 font-medium">{{ $p->name }}</td>
                <td class="px-4 py-3 hidden sm:table-cell text-xs" style="color:var(--muted)">{{ Str::limit($p->external_url, 40) }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded" style="{{ $p->is_active ? 'background:rgba(52,211,153,0.1);color:#34D399' : 'background:rgba(248,113,113,0.1);color:#F87171' }}">{{ $p->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.products.edit', $p) }}" class="text-xs mr-3" style="color:#2684FF">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $p) }}" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$products->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No products yet.</p>@endif
</div>
@endsection
