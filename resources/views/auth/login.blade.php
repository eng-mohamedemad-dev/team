@extends('layouts.app', ['title' => 'تسجيل الدخول'])

@section('content')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 450px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-title {
        font-size: 32px;
        font-weight: 700;
        color: #2b2b2b;
        margin: 0 0 10px 0;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .login-subtitle {
        color: #6c757d;
        font-size: 16px;
        margin: 0;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2b2b2b;
        font-size: 14px;
    }
    
    .form-control {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e6e6ef;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }
    
    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: white;
    }
    
    .form-check {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }
    
    .form-check input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #667eea;
    }
    
    .form-check label {
        color: #6c757d;
        font-size: 14px;
        cursor: pointer;
    }
    
    .btn-login {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }
    
    .back-link:hover {
        color: #667eea;
    }
    
    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .error-message::before {
        content: "⚠️";
        font-size: 12px;
    }
    
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        top: 80%;
        left: 20%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .login-card {
        position: relative;
        z-index: 1;
    }
</style>

<div class="login-container">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">تسجيل الدخول</h1>
            <p class="login-subtitle">مرحباً بك في موقع كرة القدم الاحترافي</p>
        </div>
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="form-control" 
                       value="{{ old('email') }}" required 
                       placeholder="أدخل بريدك الإلكتروني">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control" 
                       required placeholder="أدخل كلمة المرور">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">تذكرني</label>
            </div>
            
            <button type="submit" class="btn-login">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                    <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                دخول
            </button>
            
            <a href="/" class="back-link">العودة للرئيسية</a>
        </form>
    </div>
</div>

<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endsection


