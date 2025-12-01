<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <style>
        /* Minimal, dependency-free styles to make the form usable */
        body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f7fafc; margin:0; padding:0; }
        .center { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
        .card { width:100%; max-width:420px; background:#fff; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.08); padding:28px; }
        h1 { margin:0 0 16px; font-size:20px; }
        .muted { color:#6b7280; font-size:14px; margin-bottom:18px; }
        label { display:block; font-size:13px; margin-bottom:6px; color:#374151; }
        input[type="email"], input[type="password"] {
            width:100%; padding:10px 12px; border:1px solid #e5e7eb; border-radius:6px; font-size:15px; box-sizing:border-box;
        }
        .input-error { border-color:#ef4444; }
        .error-text { color:#ef4444; font-size:13px; margin-top:6px; }
        .row { margin-bottom:14px; }
        .actions { display:flex; align-items:center; justify-content:space-between; margin-top:6px; }
        .btn {
            background:#2563eb; color:#fff; border:none; padding:10px 14px; border-radius:6px; cursor:pointer; font-weight:600;
        }
        .link { font-size:14px; color:#2563eb; text-decoration:none; }
        .small { font-size:13px; color:#6b7280; }
        .status { background:#e6fffa; color:#065f46; padding:10px 12px; border-radius:6px; margin-bottom:12px; font-size:14px; }
        .remember { display:inline-flex; align-items:center; gap:8px; font-size:14px; color:#374151; }
    </style>
</head>
<body>
<div class="center">
    <main class="card" role="main" aria-labelledby="login-heading">
        <h1 id="login-heading">Sign in to your account</h1>
        <p class="muted">Enter your credentials to access your dashboard.</p>

        @if(session('status'))
            <div class="status" role="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="row">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    @error('email') class="input-error" aria-invalid="true" aria-describedby="email-error" @endif
                >
                @error('email')
                    <div id="email-error" class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    @error('password') class="input-error" aria-invalid="true" aria-describedby="password-error" @endif
                >
                @error('password')
                    <div id="password-error" class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="row actions" style="align-items:center;">
                <label class="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>

                <div style="text-align:right;">
                    @if (Route::has('password.request'))
                        <a class="link" href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif
                </div>
            </div>

            <div class="row" style="margin-top:18px;">
                <button type="submit" class="btn">Log in</button>
            </div>

            <div class="row" style="margin-top:10px; display:flex; justify-content:space-between; align-items:center;">
                <span class="small">Don't have an account?</span>
                @if (Route::has('register'))
                    <a class="link" href="{{ route('register') }}">Create account</a>
                @endif
            </div>
        </form>
    </main>
</div>
</body>
</html>