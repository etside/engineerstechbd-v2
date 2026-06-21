@extends('layouts.admin')
@section('title','Contact Submissions')
@section('content')
<div class="mb-6">
    <h2 class="font-semibold">Contact Submissions</h2>
</div>
<div class="space-y-3">
    @foreach($submissions as $s)
    <div class="glass-card rounded-xl p-5 {{ !$s->is_read ? 'border-blue-500/30' : '' }}">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="font-medium text-sm">{{ $s->name }}</p>
                <p class="text-xs" style="color:var(--muted)">{{ $s->email }} @if($s->phone)· {{ $s->phone }}@endif</p>
                @if($s->subject)<p class="text-xs font-medium mt-1" style="color:#2684FF">{{ $s->subject }}</p>@endif
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs" style="color:var(--muted)">{{ $s->created_at->diffForHumans() }}</span>
                @if(!$s->is_read)
                <form method="POST" action="{{ route('admin.submissions.markRead', $s) }}">@csrf @method('PATCH')
                <button type="submit" class="text-xs px-3 py-1 rounded-lg" style="background:rgba(38,132,255,0.1);color:#2684FF">Mark Read</button></form>
                @else
                <span class="text-xs" style="color:var(--muted)">Read</span>
                @endif
            </div>
        </div>
        <p class="text-sm leading-relaxed" style="color:var(--muted)">{{ $s->message }}</p>
    </div>
    @endforeach
    @if(!$submissions->count())<p class="text-center py-10 text-sm" style="color:var(--muted)">No submissions yet.</p>@endif
</div>
<div class="mt-6">{{ $submissions->links() }}</div>
@endsection
