<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Aplikasi Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f2027 0%, #1b3a2d 50%, #0f2027 100%);
            font-family: 'Segoe UI', sans-serif;
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: rgba(246, 246, 246, 0.04);
            border: 0.5px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            padding: 2rem 2.25rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.25rem;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(79, 255, 123, 0.15);
            border: 0.5px solid rgba(79, 255, 123, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: #4dffa0;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #e8f5e9;
            letter-spacing: -0.2px;
        }

        .brand-sub {
            font-size: 12px;
            color: rgba(200, 230, 210, 0.5);
            margin: 0.4rem 0 1.5rem;
            padding-left: 44px;
        }

        .divider {
            height: 0.5px;
            background: rgba(255, 255, 255, 0.08);
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: rgba(194, 40, 40, 0.15);
            border: 0.5px solid rgba(194, 40, 40, 0.4);
            border-radius: 8px;
            color: #ffb3b3;
            font-size: 13px;
            padding: 10px 14px;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .alert-close {
            background: none;
            border: none;
            color: #ffb3b3;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            line-height: 1;
        }

        .form-group { margin-bottom: 1rem; }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: rgba(200, 230, 210, 0.6);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: rgba(150, 200, 170, 0.5);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 9px 12px 9px 34px;
            background: rgba(255, 255, 255, 0.05);
            border: 0.5px solid rgba(255, 255, 255, 0.14);
            border-radius: 8px;
            font-size: 13px;
            color: #e8f5e9;
            outline: none;
            transition: border-color .18s, background .18s;
        }

        .form-input::placeholder { color: rgba(200, 230, 210, 0.3); }

        .form-input:focus {
            border-color: rgba(79, 255, 123, 0.5);
            background: rgba(79, 255, 123, 0.06);
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            margin-top: 0.5rem;
            background: #1b5e20;
            border: none;
            border-radius: 8px;
            color: #d0ffd8;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background .18s;
        }

        .btn-login:hover { background: #2e7d32; }

    </style>
</head>
<body>
    <div class="login-card">

        <div class="brand">
            <div class="brand-icon"><i class="bi bi-grid-1x2-fill"></i></div>
            <span class="brand-name">Aplikasi Blog</span>
        </div>
        <p class="brand-sub">Masukkan kredensial untuk melanjutkan</p>

        <div class="divider"></div>

        @if($errors->has('gagal'))
        <div class="alert-error">
            <span><i class="bi bi-exclamation-circle" style="margin-right:6px;"></i>{{ $errors->first('gagal') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-wrap">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" name="user_name" class="form-input"
                        placeholder="Masukkan username"
                        value="{{ old('user_name') }}" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="form-input"
                        placeholder="Masukkan password">
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Masuk
            </button>
        </form>

    </div>
</body>
</html>