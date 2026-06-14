@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    /* Hilangkan semua padding/margin dari container layout */
    .container {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
    }
    body {
        overflow-x: hidden;
    }
    .login-wrapper {
        position: relative;
        min-height: 100vh;
        width: 100%;
    }
    .login-bg {
        background-image: url('https://plus.unsplash.com/premium_photo-1668472273029-ba03dfaf5c45?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 100%;
        z-index: 0;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
    .content {
        position: relative;
        z-index: 2;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }
    .login-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border-radius: 2rem;
        padding: 2rem;
        width: 100%;
        max-width: 450px;
        border: none;          /* hilangkan border */
        box-shadow: none;      /* hilangkan bayangan */
    }
    .login-card h1 {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        color: white;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    .login-card p {
        text-align: center;
        color: #ffedd5;
        margin-bottom: 1.5rem;
        font-style: italic;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 1rem;
        outline: none;
        transition: all 0.2s;
    }
    .form-control:focus {
        background: white;
        box-shadow: 0 0 0 2px #f59e0b;
    }
    .btn-login {
        background: #d97706;
        color: white;
        font-weight: bold;
        padding: 0.75rem;
        border-radius: 1rem;
        width: 100%;
        transition: background 0.2s;
        border: none;
        cursor: pointer;
    }
    .btn-login:hover {
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
</style>

<div class="login-wrapper">
    <div class="login-bg"></div>
    <div class="overlay"></div>
    <div class="content">
        <div class="login-card">
            <div class="text-center mb-4">
                <div class="text-5xl mb-2">☕</div>
                <h1>MOODCOFFEE</h1>
                <p>we already met</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-login">Log In</button>
            </form>
            <div class="text-center mt-6">
                <a href="#" class="link">✨ Get In Now ✨</a>
            </div>
            <div class="text-center mt-4 text-white text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="link font-semibold">Sign Up</a>
            </div>
        </div>
    </div>
</div>
@endsection