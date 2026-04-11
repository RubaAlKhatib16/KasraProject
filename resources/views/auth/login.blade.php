{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · تسجيل الدخول</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts (Cairo) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* كل الـ CSS الذي أرسلته يبقى كما هو - انسخه هنا بالكامل */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', 'Tahoma', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 79, 139, 0.15) 0%, rgba(233, 179, 251, 0.05) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -5%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(233, 179, 251, 0.1) 0%, rgba(255, 79, 139, 0.03) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        .login-container {
            max-width: 480px;
            width: 100%;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 48px;
            padding: 2.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .logo-icon {
            background: #FF4F8B;
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: 800;
            color: white;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #EDE9FE;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #EDE9FE;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            color: #FFB3C7;
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.9rem 3rem 0.9rem 2.5rem;
            border: 1px solid rgba(233, 179, 251, 0.3);
            border-radius: 60px;
            font-size: 1rem;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #FF4F8B;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 4px rgba(255, 79, 139, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .toggle-password {
            position: absolute;
            left: 1rem;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #FFB3C7;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: #EDE9FE;
            font-size: 0.85rem;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #FF4F8B;
        }

        .forgot-link {
            color: #FFB3C7;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #FF4F8B;
        }

        .btn-login {
            width: 100%;
            background: #FF4F8B;
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 60px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 20px rgba(255, 79, 139, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            background: #ff3373;
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(255, 79, 139, 0.4);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            height: 1px;
            background: rgba(233, 179, 251, 0.3);
            z-index: 1;
        }

        .divider span {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(4px);
            padding: 0 1rem;
            color: #EDE9FE;
            font-size: 0.85rem;
            position: relative;
            z-index: 2;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.7rem;
            border: 1px solid rgba(233, 179, 251, 0.4);
            border-radius: 60px;
            background: rgba(255, 255, 255, 0.05);
            color: #EDE9FE;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .social-btn i {
            font-size: 1rem;
        }

        .social-btn:hover {
            border-color: #FFB3C7;
            background: rgba(255, 79, 139, 0.1);
            color: white;
            transform: translateY(-2px);
        }

        .signup-link {
            text-align: center;
            color: #EDE9FE;
            font-size: 0.9rem;
        }

        .signup-link a {
            color: #FFB3C7;
            text-decoration: none;
            font-weight: 700;
            margin-right: 0.3rem;
            transition: color 0.3s;
        }

        .signup-link a:hover {
            color: #FF4F8B;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: #EDE9FE;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.85rem;
        }

        .back-home a:hover {
            color: #FFB3C7;
        }

        .alert {
            padding: 0.8rem 1rem;
            border-radius: 60px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .alert-success {
            background: rgba(46, 125, 50, 0.2);
            color: #A5D6A7;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .alert-error {
            background: rgba(211, 47, 47, 0.2);
            color: #FFCDD2;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .alert i {
            font-size: 1rem;
        }

        .btn-login.loading {
            position: relative;
            color: transparent;
        }

        .btn-login.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.8rem;
            }
            .logo-text {
                font-size: 1.6rem;
            }
            .logo-icon {
                width: 40px;
                height: 40px;
                font-size: 1.4rem;
            }
            .login-header h1 {
                font-size: 1.5rem;
            }
            .social-login {
                flex-direction: column;
                gap: 0.8rem;
            }
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-bolt"></i></div>
            <span class="logo-text">كِسرة</span>
        </div>

        <!-- Header -->
        <div class="login-header">
            <h1>تسجيل الدخول</h1>
            <p>أدخل بياناتك للوصول إلى حسابك</p>
        </div>

        <!-- عرض أخطاء الجلسة (مثل خطأ المصادقة) -->
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form - استخدام route('login') مع CSRF -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" 
                           placeholder="أدخل بريدك الإلكتروني" required autofocus>
                </div>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="أدخل كلمة المرور" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Options -->
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>تذكرني</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">نسيت كلمة المرور؟</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
            </button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>أو الدخول باستخدام</span>
        </div>

        <!-- Social Login (تبقى تجريبية بدون ربط خلفي) -->
        <div class="social-login">
            <button type="button" class="social-btn google" onclick="socialLogin('google')">
                <i class="fab fa-google"></i> جوجل
            </button>
            <button type="button" class="social-btn facebook" onclick="socialLogin('facebook')">
                <i class="fab fa-facebook-f"></i> فيسبوك
            </button>
            <button type="button" class="social-btn apple" onclick="socialLogin('apple')">
                <i class="fab fa-apple"></i> آبل
            </button>
        </div>

        <!-- Signup Link -->
        <div class="signup-link">
            ليس لديك حساب؟
            <a href="{{ route('register') }}">إنشاء حساب جديد</a>
        </div>

        <!-- Back to Home -->
        <div class="back-home">
            <a href="{{ url('/') }}">
                <i class="fas fa-arrow-right"></i>
                العودة إلى الصفحة الرئيسية
            </a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.querySelector('input[name="password"]');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // إضافة تأثير loading عند إرسال النموذج (اختياري)
        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');

        form.addEventListener('submit', function() {
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
            // النموذج سيُرسل بشكل طبيعي، ويمكنك إزالة الـ loading إذا أردت بعد الرد، لكنه ليس ضرورياً
        });

        // دالة توضيحية للدخول عبر وسائل التواصل (يمكن ربطها لاحقاً)
        function socialLogin(provider) {
            alert(`تسجيل الدخول عبر ${provider} سيتم تفعيله قريباً.`);
        }

        // (اختياري) تعبئة بيانات تجريبية للتطوير - يمكن إزالتها في الإنتاج
        // window.addEventListener('load', function() {
        //     document.querySelector('input[name="email"]').value = 'layan@gmail.com';
        //     document.querySelector('input[name="password"]').value = 'LayanNa@mafg';
        // });
    </script>
</body>
</html>