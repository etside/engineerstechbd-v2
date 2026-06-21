<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Dashboard') — engineersTech Admin</title>
    <meta name="robots" content="noindex,nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{
            --bg:#050d1a;--bg2:#071526;--surface:rgba(255,255,255,.04);--surface-h:rgba(255,255,255,.08);
            --border:rgba(255,255,255,.09);--blue-start:#0058cc;--blue-end:#2483ff;
            --gradient:linear-gradient(135deg,var(--blue-start),var(--blue-end));
            --text:#e8f0ff;--muted:#7a93b8;--card:#0c1628;--sidebar:#071020;
            --success:#10b981;--danger:#ef4444;--warning:#f59e0b;--radius:12px;
        }
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%;overflow:hidden}
        body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);font-size:14px;line-height:1.6;-webkit-font-smoothing:antialiased}
        a{color:inherit;text-decoration:none}
        button{font-family:inherit;cursor:pointer}
        img{max-width:100%;display:block}

        /* ── LAYOUT ── */
        .layout{display:flex;height:100vh;overflow:hidden}

        /* ── SIDEBAR ── */
        .sidebar{width:248px;min-width:248px;background:var(--sidebar);border-right:1px solid var(--border);display:flex;flex-direction:column;overflow-y:auto;transition:transform .3s}
        .sidebar-logo{padding:20px 18px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px}
        .sidebar-logo-icon{width:36px;height:36px;background:var(--gradient);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .sidebar-logo-icon svg{width:20px;height:20px;fill:white}
        .sidebar-brand{line-height:1.2}
        .sidebar-brand-name{font-size:15px;font-weight:700;color:var(--text)}
        .sidebar-brand-name span{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .sidebar-brand-sub{font-size:11px;color:var(--muted)}
        .sidebar-nav{flex:1;padding:12px 10px}
        .nav-section-label{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);padding:10px 10px 6px}
        .nav-link{display:flex;align-items:center;gap:9px;padding:9px 10px;border-radius:8px;font-size:13px;font-weight:500;color:var(--muted);transition:all .2s;margin-bottom:2px}
        .nav-link svg{width:16px;height:16px;flex-shrink:0;opacity:.7}
        .nav-link:hover{background:var(--surface-h);color:var(--text)}
        .nav-link:hover svg{opacity:1}
        .nav-link.active{background:rgba(36,131,255,.12);color:#2483ff}
        .nav-link.active svg{opacity:1;color:#2483ff}
        .nav-badge{margin-left:auto;background:rgba(36,131,255,.25);color:#2483ff;font-size:11px;font-weight:600;padding:1px 7px;border-radius:9999px}
        .sidebar-footer{padding:10px;border-top:1px solid var(--border)}
        .sidebar-footer .nav-link.danger{color:#f87171}
        .sidebar-footer .nav-link.danger:hover{background:rgba(248,113,113,.1)}

        /* ── MAIN ── */
        .main{flex:1;display:flex;flex-direction:column;overflow:hidden}
        .topbar{height:58px;min-height:58px;background:rgba(7,16,32,.85);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 24px;gap:16px}
        .topbar-title{font-size:15px;font-weight:600}
        .topbar-right{display:flex;align-items:center;gap:12px}
        .topbar-user{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--muted)}
        .topbar-avatar{width:32px;height:32px;border-radius:9px;background:var(--gradient);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;color:#fff}
        .page-body{flex:1;overflow-y:auto;padding:24px}

        /* ── GLASS CARD ── */
        .glass-card{background:rgba(12,22,40,.6);backdrop-filter:blur(16px);border:1px solid var(--border);border-radius:var(--radius)}

        /* ── INPUTS ── */
        .admin-input,.admin-select,.admin-textarea{width:100%;padding:10px 14px;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;background:rgba(255,255,255,.04);border:1px solid var(--border);color:var(--text);outline:none;transition:border-color .2s}
        .admin-input:focus,.admin-select:focus,.admin-textarea:focus{border-color:#2483ff;background:rgba(255,255,255,.06)}
        .admin-input::placeholder,.admin-textarea::placeholder{color:var(--muted)}
        .admin-textarea{resize:vertical;min-height:90px}
        .admin-select option{background:#0c1628;color:var(--text)}
        .form-label{display:block;font-size:12px;font-weight:500;color:var(--muted);margin-bottom:5px}
        .form-group{margin-bottom:16px}

        /* ── BUTTONS ── */
        .btn-primary{display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:8px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;background:var(--gradient);color:#fff;border:none;transition:opacity .2s,transform .15s}
        .btn-primary:hover{opacity:.88;transform:translateY(-1px)}
        .btn-secondary{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:8px;font-size:13px;font-weight:500;font-family:'Poppins',sans-serif;background:var(--surface-h);color:var(--text);border:1px solid var(--border);transition:background .2s}
        .btn-secondary:hover{background:rgba(255,255,255,.12)}
        .btn-danger{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:7px;font-size:12px;font-weight:500;font-family:'Poppins',sans-serif;background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);transition:all .2s}
        .btn-danger:hover{background:rgba(239,68,68,.2)}
        .btn-sm{padding:6px 12px;font-size:12px}

        /* ── TABLE ── */
        .admin-table{width:100%;border-collapse:collapse}
        .admin-table th{text-align:left;padding:11px 14px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);background:rgba(255,255,255,.03);border-bottom:1px solid var(--border)}
        .admin-table td{padding:12px 14px;font-size:13px;border-bottom:1px solid rgba(255,255,255,.05)}
        .admin-table tr:hover td{background:rgba(255,255,255,.02)}
        .admin-table tr:last-child td{border-bottom:none}

        /* ── BADGE ── */
        .badge{display:inline-block;padding:2px 10px;border-radius:9999px;font-size:11px;font-weight:600}
        .badge-green{background:rgba(16,185,129,.15);color:#34d399}
        .badge-blue{background:rgba(36,131,255,.15);color:#60a5fa}
        .badge-yellow{background:rgba(245,158,11,.15);color:#fbbf24}
        .badge-red{background:rgba(239,68,68,.15);color:#f87171}
        .badge-gray{background:rgba(148,163,184,.12);color:var(--muted)}

        /* ── ALERTS ── */
        .alert-success{padding:12px 16px;border-radius:8px;font-size:13px;color:#34d399;background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.2);margin-bottom:20px}
        .alert-error{padding:12px 16px;border-radius:8px;font-size:13px;color:#f87171;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);margin-bottom:20px}

        /* ── MOBILE TOGGLE ── */
        .mobile-toggle{display:none;background:none;border:none;color:var(--text);padding:6px}
        .mobile-toggle svg{width:20px;height:20px}
        .sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:49}
        @media(max-width:768px){
            .mobile-toggle{display:flex;align-items:center;justify-content:center}
            .sidebar{position:fixed;top:0;left:0;bottom:0;z-index:50;transform:translateX(-100%)}
            .sidebar.open{transform:translateX(0)}
            .sidebar-overlay.open{display:block}
        }
    </style>
</head>
<body>
<div class="layout">
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <div class="sidebar-brand">
                <div class="sidebar-brand-name"><span>engineers</span>Tech</div>
                <div class="sidebar-brand-sub">Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <div class="nav-section-label">Content</div>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                Services
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                Products
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                Portfolio / Projects
            </a>
            <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Blog Posts
            </a>
            <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                Team
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                Testimonials
            </a>
            <a href="{{ route('admin.logos.index') }}" class="nav-link {{ request()->routeIs('admin.logos.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Client Logos
            </a>

            <div class="nav-section-label">Inbox</div>
            <a href="{{ route('admin.submissions.index') }}" class="nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Messages
            </a>

            <div class="nav-section-label">System</div>
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                Settings
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                View Live Site
            </a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="nav-link danger w-full" style="background:none;border:none;width:100%;text-align:left">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:12px">
                <button class="mobile-toggle" onclick="openSidebar()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <div class="topbar-title">@yield('title','Dashboard')</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <div class="page-body">
            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<script>
function openSidebar(){
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('open');
}
function closeSidebar(){
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
}
</script>
</body>
</html>
