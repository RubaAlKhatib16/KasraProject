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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* نفس التصميم الزجاجي السابق (يمكنك نسخه من products/index.blade.php) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
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

        .profile-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: 600;
            color: #FFB3C7;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        input,
        textarea {
            padding: 0.7rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(233, 179, 251, 0.3);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-family: inherit;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #FF4F8B;
        }

        .btn-save {
            background: #FF4F8B;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #ff3373;
            transform: translateY(-2px);
        }

        hr {
            margin: 1.5rem 0;
            border-color: rgba(233, 179, 251, 0.2);
        }

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }

            .main-content {
                padding: 1rem;
            }
        }

        .menu-toggle {
            display: none;
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
                position: fixed;
                top: 1rem;
                left: 1rem;
                background: rgba(31, 41, 55, 0.8);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(233, 179, 251, 0.3);
                padding: 0.5rem;
                border-radius: 12px;
                cursor: pointer;
                color: #FFB3C7;
                z-index: 100;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('seller.dashboard') }}" class="nav-item"><i class="fas fa-chart-line"></i> لوحة
                    التحكم</a>
                <a href="{{ route('seller.products.index') }}" class="nav-item"><i class="fas fa-box"></i> المنتجات</a>
                <a href="{{ route('seller.orders.index') }}" class="nav-item"><i class="fas fa-shopping-cart"></i>
                    الطلبات</a>
                <a href="{{ route('seller.profile.edit') }}" class="nav-item active"><i class="fas fa-user"></i>
                    حسابي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit"
                        class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>حسابي</h1>
                    <p>تعديل بيانات المتجر والحساب الشخصي</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}</div>
                    <div>{{ auth()->user()->first_name }}</div><i class="fas fa-chevron-down"></i>
                </div>
            </div>

            @if(session('success'))
                <script>Swal.fire({ icon: 'success', title: 'تم', text: '{{ session('success') }}', background: '#1F2937', color: '#EDE9FE', confirmButtonColor: '#FF4F8B' });</script>
            @endif

            <div class="profile-card">
                <form method="POST" action="{{ route('seller.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="form-group"><label><i class="fas fa-user"></i> الاسم الأول</label><input type="text"
                                name="first_name" value="{{ old('first_name', $user->first_name) }}" required></div>
                        <div class="form-group"><label><i class="fas fa-user"></i> الاسم الأخير</label><input
                                type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                        <div class="form-group"><label><i class="fas fa-envelope"></i> البريد الإلكتروني</label><input
                                type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
                        <div class="form-group"><label><i class="fas fa-phone"></i> رقم الهاتف</label><input type="text"
                                name="phone" value="{{ old('phone', $user->phone) }}"></div>
                        <div class="form-group full-width"><label><i class="fas fa-store"></i> اسم المتجر</label><input
                                type="text" name="store_name" value="{{ old('store_name', $store->name) }}" required>
                        </div>
                        <div class="form-group full-width"><label><i class="fas fa-align-right"></i> وصف
                                المتجر</label><textarea name="store_description"
                                rows="4">{{ old('store_description', $store->description) }}</textarea></div>
                        <div class="form-group full-width"><label><i class="fas fa-image"></i> شعار المتجر</label><input
                                type="file" name="logo" accept="image/*"><small>اتركه فارغاً إذا لم ترغب في
                                تغييره</small></div>
                        <div class="form-group"><label><i class="fas fa-lock"></i> كلمة المرور الجديدة</label><input
                                type="password" name="password" placeholder="اتركه فارغاً إذا لم ترد التغيير"></div>
                        <div class="form-group"><label><i class="fas fa-lock"></i> تأكيد كلمة المرور</label><input
                                type="password" name="password_confirmation"></div>
                    </div>
                    <hr>
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> حفظ التغييرات</button>
                </form>
            </div>
        </main>
    </div>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        if (menuToggle) menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    </script>
</body>

</html>