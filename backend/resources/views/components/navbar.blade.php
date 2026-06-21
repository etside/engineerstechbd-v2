<nav class="fixed top-0 left-0 right-0 z-50" style="background:rgba(10,14,26,0.85);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.06)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="text-xl font-bold gradient-text">engineers<span class="text-white">Tech</span></span>
        </a>
        <div class="hidden md:flex items-center gap-8">
            @foreach([['home','Home'],['services','Services'],['products','Products'],['about','About Us'],['blog','Blog'],['contact','Contact']] as [$r,$l])
            <a href="{{ route($r) }}" class="nav-link text-sm font-medium {{ request()->routeIs($r) ? 'active' : '' }}">{{ $l }}</a>
            @endforeach
        </div>
        <a href="{{ route('contact') }}" class="hidden md:inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Get Started</a>
        <button id="mobile-menu-btn" class="md:hidden text-white p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2" style="background:rgba(10,14,26,0.95)">
        @foreach([['home','Home'],['services','Services'],['products','Products'],['about','About Us'],['blog','Blog'],['contact','Contact']] as [$r,$l])
        <a href="{{ route($r) }}" class="block py-2 text-sm nav-link {{ request()->routeIs($r) ? 'active' : '' }}">{{ $l }}</a>
        @endforeach
    </div>
</nav>
<script>document.getElementById('mobile-menu-btn').addEventListener('click',()=>document.getElementById('mobile-menu').classList.toggle('hidden'));</script>
