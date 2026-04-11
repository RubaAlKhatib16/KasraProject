<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · حسابي</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* كل الـ CSS الأصلي (تم نقله كاملاً) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
            line-height: 1.5;
            color: #EDE9FE;
            overflow-x: hidden;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: rgba(31, 41, 55, 0.6);
            backdrop-filter: blur(16px);
            border-left: 1px solid rgba(233, 179, 251, 0.25);
            padding: 2rem 1.5rem;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: right 0.3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(120deg, #FFF, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 20px;
            color: #EDE9FE;
            text-decoration: none;
            transition: 0.2s;
            font-weight: 500;
        }

        .nav-item i {
            width: 24px;
            font-size: 1.1rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #FFB3C7;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.2), rgba(233, 179, 251, 0.2));
            color: #FFB3C7;
            border-right: 3px solid #FF4F8B;
        }

        .nav-item.logout {
            margin-top: auto;
            background: none;
            border: none;
            width: 100%;
            text-align: right;
            cursor: pointer;
            color: #FFB3C7;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(120deg, #FFF, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .page-title p {
            color: #EDE9FE;
            font-size: 0.9rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
            border: 1px solid rgba(233, 179, 251, 0.3);
        }

        .user-menu:hover {
            border-color: #FFB3C7;
            background: rgba(255, 255, 255, 0.08);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .user-name {
            font-weight: 600;
            color: white;
        }

        .profile-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #EDE9FE;
        }

        input {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(233, 179, 251, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-family: inherit;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s;
        }

        input:focus {
            border-color: #FF4F8B;
            background: rgba(255, 255, 255, 0.08);
        }

        input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 79, 139, 0.3);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(233, 179, 251, 0.5);
            padding: 0.8rem 1.5rem;
            border-radius: 60px;
            font-weight: 600;
            color: #FFB3C7;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            border-color: #FF4F8B;
            background: rgba(255, 79, 139, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .alert-success {
            background: rgba(46, 125, 50, 0.2);
            color: #A5D6A7;
            border: 1px solid rgba(76, 175, 80, 0.3);
            padding: 0.8rem;
            border-radius: 60px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .orders-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            text-align: center;
        }

        .orders-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .orders-card p {
            margin-bottom: 1.5rem;
            color: #EDE9FE;
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: rgba(31, 41, 55, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(233, 179, 251, 0.3);
            padding: 0.5rem;
            border-radius: 12px;
            cursor: pointer;
            color: #FFB3C7;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                right: -280px;
                top: 0;
                z-index: 99;
                background: rgba(31, 41, 55, 0.95);
                transition: right 0.3s;
            }

            .sidebar.open {
                right: 0;
            }

            .menu-toggle {
                display: block;
            }

            .main-content {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('customer.dashboard') }}" class="nav-item"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="{{ route('customer.profile.edit') }}" class="nav-item active"><i class="fas fa-user"></i>
                    حسابي</a>
                <a href="{{ route('customer.orders.index') }}" class="nav-item"><i class="fas fa-shopping-bag"></i>
                    طلباتي</a>
                <a href="{{ route('customer.installments.index') }}" class="nav-item"><i
                        class="fas fa-calendar-alt"></i> أقساطي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit"
                        class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>حسابي</h1>
                    <p>إدارة معلوماتك الشخصية</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div class="user-name">{{ auth()->user()->name }}</div><i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <!-- Profile Edit Card -->
            <div class="profile-card">
                @if(session('success'))
                    <div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert-success" style="background:rgba(211,47,47,0.2); border-color:#f44336; color:#FFCDD2;">
                        @foreach($errors->all() as $error) {{ $error }} <br> @endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('customer.profile.update') }}" id="profileForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>الاسم الكامل</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label>رقم الهاتف</label>
                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                    </div>
                    <div class="form-group">
                        <label>كلمة المرور الجديدة (اختياري)</label>
                        <input type="password" name="password" placeholder="اتركه فارغاً إذا لم ترغب في التغيير">
                    </div>
                    <div class="form-group">
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" placeholder="أعد كتابة كلمة المرور الجديدة">
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn-primary"><i class="fas fa-save"></i> حفظ التغييرات</button>
                    </div>
                </form>
            </div>

            <!-- Orders Card -->
            <div class="orders-card">
                <h3><i class="fas fa-receipt"></i> طلباتي</h3>
                <p>عرض جميع مشترياتك وتفاصيل الدفع بالتقسيط</p>
                <button class="btn-primary" id="viewOrdersBtn"><i class="fas fa-eye"></i> عرض الطلبات</button>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('viewOrdersBtn').addEventListener('click', () => {
            window.location.href = '{{ route("customer.orders.index") }}';
        });

        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
            window.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            });
        }
    </script>
</body>

</html>