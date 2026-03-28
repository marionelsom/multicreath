<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login — MULTICREATH</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #0f1117; color: #f0f4ff; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .form-input { background: #1e2535; border: 1px solid #2d3748; border-radius: 8px; color: #f0f4ff; padding: 11px 14px; font-size: 14px; width: 100%; outline: none; transition: border-color 0.15s; font-family: 'DM Sans', sans-serif; }
        .form-input:focus { border-color: #135bec; box-shadow: 0 0 0 3px rgba(19,91,236,0.15); }
        .form-input::placeholder { color: #4a5568; }
        .material-symbols-outlined { font-size: 20px; vertical-align: middle; }
        .bg-grid { background-image: linear-gradient(rgba(19,91,236,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(19,91,236,0.05) 1px, transparent 1px); background-size: 40px 40px; }
    </style>
</head>
<body class="bg-grid">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 bg-blue-600 rounded-full opacity-5 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-sm mx-4 relative z-10">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center mx-auto mb-4">
                <svg width="24" height="24" fill="none" viewBox="0 0 48 48">
                    <path clip-rule="evenodd" d="M24 0.757L47.24 24 24 47.24 0.757 24 24 0.757zM21 35.76V12.24L9.24 24 21 35.76z" fill="white" fill-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-white">MULTICREATH</h1>
            <p class="text-sm text-slate-400 mt-1">Panel Administrativo</p>
        </div>

        {{-- Card --}}
        <div style="background:#161b27; border:1px solid #1e2535; border-radius:16px; padding:32px;">

            {{-- Session expired — shown in amber so user knows WHY they were redirected --}}
            @if(session('error'))
                <div style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.35); border-radius:8px; padding:12px 14px; margin-bottom:20px; display:flex; align-items:flex-start; gap:10px;">
                    <span class="material-symbols-outlined" style="color:#f59e0b; font-size:18px; flex-shrink:0; margin-top:1px;">schedule</span>
                    <p style="color:#fcd34d; font-size:13px; line-height:1.5; margin:0;">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Wrong credentials — shown in red --}}
            @if($errors->any())
                <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.35); border-radius:8px; padding:12px 14px; margin-bottom:20px; display:flex; align-items:flex-start; gap:10px;">
                    <span class="material-symbols-outlined" style="color:#f87171; font-size:18px; flex-shrink:0; margin-top:1px;">error</span>
                    <p style="color:#fca5a5; font-size:13px; line-height:1.5; margin:0;">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label style="font-size:12px; font-weight:600; letter-spacing:0.06em; text-transform:uppercase; color:#8896b3; margin-bottom:6px; display:block;">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input"
                            placeholder="admin@multicreath.com"
                            required
                            autofocus
                        />
                    </div>
                    <div>
                        <label style="font-size:12px; font-weight:600; letter-spacing:0.06em; text-transform:uppercase; color:#8896b3; margin-bottom:6px; display:block;">
                            Contraseña
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                        />
                    </div>
                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="remember" id="remember" style="accent-color:#135bec; width:14px; height:14px;"/>
                        <label for="remember" style="font-size:13px; color:#8896b3; cursor:pointer;">
                            Recordar sesión
                        </label>
                    </div>
                </div>

                <button
                    type="submit"
                    style="width:100%; margin-top:24px; background:#135bec; color:white; padding:11px; border-radius:8px; font-size:14px; font-weight:600; border:none; cursor:pointer; transition:background 0.15s; display:flex; align-items:center; justify-content:center; gap:8px;"
                    onmouseover="this.style.background='#1a44cc'"
                    onmouseout="this.style.background='#135bec'"
                >
                    <span class="material-symbols-outlined" style="font-size:18px;">login</span>
                    Iniciar sesión
                </button>
            </form>
        </div>

        <p style="text-align:center; font-size:12px; color:#4a5568; margin-top:20px;">
            Acceso restringido solo a administradores
        </p>
    </div>
</body>
</html>