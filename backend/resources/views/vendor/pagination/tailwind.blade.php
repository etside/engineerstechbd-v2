@if ($paginator->hasPages())
<nav class="flex items-center justify-between mt-6">
    <p class="text-xs" style="color:#94A3B8">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </p>
    <div class="flex items-center gap-1">
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1.5 rounded text-xs" style="color:#475569">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 rounded text-xs" style="color:#94A3B8;border:1px solid rgba(255,255,255,0.1)">&laquo;</a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-xs" style="color:#94A3B8">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 rounded text-xs text-white" style="background:linear-gradient(135deg,#0052CC,#2684FF)">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 rounded text-xs" style="color:#94A3B8;border:1px solid rgba(255,255,255,0.1)">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 rounded text-xs" style="color:#94A3B8;border:1px solid rgba(255,255,255,0.1)">&raquo;</a>
        @else
            <span class="px-3 py-1.5 rounded text-xs" style="color:#475569">&raquo;</span>
        @endif
    </div>
</nav>
@endif
