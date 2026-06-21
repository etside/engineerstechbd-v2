<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — engineersTech</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; height: 100%; }
        body { background: #0A0E1A; color: #F8FAFC; font-family: 'Poppins', sans-serif; }
        .login-wrap { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .admin-input { width: 100%; padding: 10px 14px; border-radius: 8px; font-size: 13px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #F8FAFC; outline: none; }
        .admin-input:focus { border-color: #2684FF; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div style="width:100%;max-width:360px">
        <div style="text-align:center;margin-bottom:2rem">
            <h1 style="font-size:1.5rem;font-weight:700;background:linear-gradient(135deg,#0052CC,#2684FF);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin:0">engineersTech</h1>
            <p style="font-size:12px;color:#94A3B8;margin:4px 0 0">Admin Panel — Sign In</p>
        </div>

        <div style="background:rgba(17,24,39,0.6);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,0.07);border-radius:1rem;padding:2rem">
            @if(session('status'))
            <div style="margin-bottom:1rem;font-size:12px;color:#34D399;padding:10px 12px;border-radius:8px;background:rgba(52,211,153,0.1)">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:1rem">
                @csrf
                <div>
                    <label style="display:block;font-size:12px;color:#94A3B8;margin-bottom:6px">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="admin-input" required autofocus>
                    @error('email')<p style="font-size:12px;color:#f87171;margin:4px 0 0">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:12px;color:#94A3B8;margin-bottom:6px">Password</label>
                    <input type="password" name="password" class="admin-input" required>
                    @error('password')<p style="font-size:12px;color:#f87171;margin:4px 0 0">{{ $message }}</p>@enderror
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between">
                    <label style="display:flex;align-items:center;gap:8px;font-size:12px;color:#94A3B8;cursor:pointer">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>
                <button type="submit" style="width:100%;padding:12px;border-radius:8px;font-size:14px;font-weight:500;color:#fff;border:none;cursor:pointer;background:linear-gradient(135deg,#0052CC,#2684FF)">
                    Sign In
                </button>
            </form>
        </div>

        <p style="text-align:center;margin-top:1.5rem;font-size:12px;color:#94A3B8">
            <a href="{{ route('home') }}" style="color:#2684FF">&larr; Back to website</a>
        </p>
    </div>
</div>
</body>
</html>
