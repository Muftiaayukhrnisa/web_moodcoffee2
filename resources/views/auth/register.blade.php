<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - MoodCoffee</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: system-ui, -apple-system, 'Inter', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        /* Background image full screen */
        .register-bg {
            background-image: url('https://plus.unsplash.com/premium_photo-1668472273029-ba03dfaf5c45?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 1;
        }
        .content {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 2rem;
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .register-card h1 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: white;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
        }
        .register-card p {
            text-align: center;
            color: #ffedd5;
            margin-bottom: 1.5rem;
            font-style: italic;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 1rem;
            outline: none;
            transition: all 0.2s;
        }
        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 2px #f59e0b;
        }
        .btn-register {
            background: #d97706;
            color: white;
            font-weight: bold;
            padding: 0.75rem;
            border-radius: 1rem;
            width: 100%;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .btn-register:hover {
            background: #b45309;
        }
        .link {
            color: #fde68a;
            text-decoration: underline;
            font-size: 0.875rem;
        }
        .link:hover {
            color: #fffbeb;
        }
        label {
            display: block;
            color: #fff3e0;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="register-bg"></div>
    <div class="overlay"></div>
    <div class="content">
        <div class="register-card">
            <div class="text-center mb-4">
                <div class="text-5xl mb-2">☕</div>
                <h1>MOODCOFFEE</h1>
                <p>we already met</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                </div>
                <div class="mb-4">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn-register">Register</button>
            </form>
            <div class="text-center mt-4 text-white text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="link font-semibold">Login</a>
            </div>
        </div>
    </div>
</body>
</html>