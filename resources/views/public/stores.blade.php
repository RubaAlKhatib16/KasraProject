<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · متاجرنا | تقسيط بدون فوائد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ===== كل الـ CSS من ملف store.html الأصلي ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', 'Tahoma', sans-serif;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            overflow-x: hidden;
        }

        /* شريط التنقل */
        .navbar {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto 2rem auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            background: rgba(31, 41, 55, 0.85);
            backdrop-filter: blur(12px);
            padding: 0.8rem 2rem;
            border-radius: 80px;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            background: #FF4F8B;
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .logo-text {
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #EDE9FE;
            font-weight: 600;
            transition: 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #FFB3C7;
        }

        .nav-buttons {
            display: flex;
            gap: 0.8rem;
        }

        .btn-login,
        .btn-register {
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-family: inherit;
            border: none;
        }

        .btn-login {
            background: transparent;
            border: 1px solid #FFB3C7;
            color: #FFB3C7;
        }

        .btn-login:hover {
            background: rgba(255, 179, 199, 0.1);
            transform: scale(1.02);
        }

        .btn-register {
            background: #FF4F8B;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 79, 139, 0.3);
        }

        .btn-register:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        /* قسم المتاجر الرئيسي (Hero) */
        .store-hero {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto 3rem;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 4rem 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .hero-content {
            max-width: 780px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 5;
        }

        .store-hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .highlight {
            background: linear-gradient(120deg, #FF4F8B, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .store-hero .subtitle {
            font-size: 1.1rem;
            color: #EDE9FE;
            max-width: 560px;
            margin: 0 auto 2rem;
        }

        .store-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 79, 139, 0.12);
            padding: 0.4rem 1rem;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #FFB3C7;
            margin-bottom: 1.5rem;
            border: 0.5px solid rgba(233, 179, 251, 0.3);
        }

        .search-container {
            background: white;
            border-radius: 80px;
            padding: 0.3rem 0.3rem 0.3rem 1rem;
            display: flex;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(233, 179, 251, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .search-container:focus-within {
            border-color: #FFB3C7;
            box-shadow: 0 12px 28px rgba(255, 79, 139, 0.2);
        }

        .search-container i {
            color: #FFB3C7;
            font-size: 1.2rem;
            padding: 0 0.8rem;
        }

        .search-container input {
            flex: 1;
            border: none;
            padding: 1rem 0;
            font-size: 1rem;
            font-family: inherit;
            background: transparent;
            outline: none;
            color: #1F2937;
        }

        .search-container input::placeholder {
            color: #9CA3AF;
        }

        .search-container button {
            background: #FF4F8B;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-container button:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        .hero-filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.8rem;
            margin-bottom: 0;
        }

        .hero-filter-pill {
            background: transparent;
            border: 1px solid rgba(233, 179, 251, 0.4);
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #EDE9FE;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .hero-filter-pill:hover {
            border-color: #FFB3C7;
            background: rgba(255, 79, 139, 0.1);
            color: #FFB3C7;
        }

        .hero-filter-pill.active {
            background: #FF4F8B;
            border-color: #FF4F8B;
            color: white;
        }

        .floating-brand {
            position: absolute;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #FFB3C7;
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(233, 179, 251, 0.3);
            transition: all 0.3s ease;
            animation: float 5s ease-in-out infinite;
            z-index: 2;
            opacity: 0.8;
        }

        .brand-1 {
            top: 15%;
            left: 5%;
            animation-delay: 0s;
        }

        .brand-2 {
            top: 20%;
            right: 8%;
            animation-delay: 0.8s;
        }

        .brand-3 {
            bottom: 25%;
            left: 8%;
            animation-delay: 1.2s;
        }

        .brand-4 {
            bottom: 30%;
            right: 10%;
            animation-delay: 0.4s;
        }

        .brand-5 {
            top: 35%;
            left: 12%;
            animation-delay: 1.8s;
            display: none;
        }

        .brand-6 {
            bottom: 18%;
            right: 5%;
            animation-delay: 0.2s;
        }

        .brand-7 {
            top: 50%;
            right: 15%;
            animation-delay: 2s;
            display: none;
        }

        .brand-8 {
            top: 8%;
            right: 20%;
            animation-delay: 1s;
            width: 60px;
            height: 60px;
            font-size: 1.4rem;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @media (max-width: 1024px) {
            .floating-brand {
                width: 55px;
                height: 55px;
                font-size: 1.3rem;
            }

            .brand-1,
            .brand-2,
            .brand-3,
            .brand-4,
            .brand-6,
            .brand-8 {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .store-hero {
                padding: 2rem 1rem;
            }

            .search-container {
                flex-direction: column;
                background: transparent;
                box-shadow: none;
                border: none;
                gap: 1rem;
            }

            .search-container input {
                background: white;
                border-radius: 60px;
                padding: 1rem;
                width: 100%;
                text-align: center;
                border: 1px solid rgba(233, 179, 251, 0.3);
            }

            .search-container button {
                width: 100%;
            }

            .search-container i {
                display: none;
            }

            .floating-brand {
                display: none;
            }

            .hero-filters {
                gap: 0.5rem;
            }

            .hero-filter-pill {
                padding: 0.4rem 0.9rem;
                font-size: 0.75rem;
            }
        }

        /* ===== قسم الفلاتر المتقدمة والمتاجر ===== */
        .stores-section {
            max-width: 1280px;
            width: 100%;
            margin: 2rem auto 5rem;
            background: #1F2937;
            border-radius: 48px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
        }

        .stores-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #E5E7EB;
        }

        .filter-pills-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            overflow-x: auto;
            padding-bottom: 0.25rem;
            scrollbar-width: thin;
        }

        .filter-pills-wrapper::-webkit-scrollbar {
            height: 4px;
        }

        .filter-pill {
            background: transparent;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-pill i {
            font-size: 0.9rem;
        }

        .filter-pill:hover {
            border-color: #FFB3C7;
            background: rgba(255, 79, 139, 0.05);
            color: #FF4F8B;
        }

        .filter-pill.active {
            background: #FF4F8B;
            border-color: #FF4F8B;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 79, 139, 0.25);
        }

        .stores-count {
            font-size: 0.85rem;
            color: #6B7280;
            background: #F3F4F6;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            white-space: nowrap;
        }

        .stores-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.8rem;
        }

        .store-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            cursor: pointer;
        }

        .store-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
        }

        .card-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .store-card:hover .card-image {
            transform: scale(1.03);
        }

        .card-content {
            padding: 1.2rem;
        }

        .store-header {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 0.75rem;
        }

        .store-logo {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            object-fit: cover;
            background: #F3F4F6;
            padding: 0.25rem;
        }

        .store-info h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.2rem;
        }

        .store-category {
            font-size: 0.75rem;
            color: #FF4F8B;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .store-description {
            font-size: 0.85rem;
            color: #6B7280;
            margin: 0.5rem 0 0.8rem;
            line-height: 1.4;
        }

        .payment-methods {
            display: flex;
            gap: 0.6rem;
            margin-top: 0.5rem;
        }

        .payment-badge {
            background: #F3F4F6;
            border-radius: 20px;
            padding: 0.2rem 0.6rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: #4B5563;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .payment-badge i {
            font-size: 0.7rem;
            color: #FF4F8B;
        }

        .no-stores {
            text-align: center;
            padding: 3rem;
            font-size: 1rem;
            color: #6B7280;
            background: #F9FAFB;
            border-radius: 24px;
        }

        @media (max-width: 768px) {
            .stores-section {
                padding: 1.5rem;
                margin-top: 1.5rem;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-pills-wrapper {
                justify-content: flex-start;
            }

            .stores-count {
                text-align: center;
            }

            .stores-grid {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 1.2rem;
            }

            .card-image {
                height: 140px;
            }
        }

        /* ===== FOOTER ===== */
        .footer {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            background: #1F2937;
            border-radius: 32px 32px 0 0;
            padding: 3rem 2rem 1.5rem;
            border-top: 1px solid rgba(233, 179, 251, 0.2);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .footer-brand p {
            color: #CBD5E6;
            font-size: 0.9rem;
            line-height: 1.6;
            margin: 1rem 0 1.2rem;
            max-width: 250px;
        }

        .trust-message {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 79, 139, 0.08);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            color: #FFB3C7;
        }

        .footer-col h4 {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            display: inline-block;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col li {
            margin-bottom: 0.7rem;
        }

        .footer-col a {
            text-decoration: none;
            color: #CBD5E6;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .footer-col a:hover {
            color: #FF4F8B;
        }

        .newsletter {
            margin-top: 1rem;
        }

        .newsletter p {
            color: #CBD5E6;
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 60px;
            padding: 0.2rem;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .newsletter-form input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 0.6rem 1rem;
            color: white;
            font-family: inherit;
            font-size: 0.85rem;
            outline: none;
        }

        .newsletter-form input::placeholder {
            color: #9CA3AF;
        }

        .newsletter-form button {
            background: #FF4F8B;
            border: none;
            border-radius: 40px;
            padding: 0.6rem 1.2rem;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            font-size: 0.8rem;
        }

        .newsletter-form button:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(233, 179, 251, 0.15);
            font-size: 0.8rem;
            color: #9CA3AF;
        }

        .social-icons {
            display: flex;
            gap: 1.2rem;
        }

        .social-icons a {
            color: #CBD5E6;
            font-size: 1.2rem;
            transition: all 0.2s;
        }

        .social-icons a:hover {
            color: #FF4F8B;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }

            .footer-brand {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-brand {
                grid-column: span 1;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 640px) {

            .merchants-grid,
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .brand-logo {
                width: 80px;
                height: 80px;
                font-size: 1rem;
            }

            .merchants-section,
            .how-it-works,
            .cta-section,
            .footer {
                padding: 2rem 1rem;
            }

            .feature-card,
            .step-card,
            .cta-card {
                padding: 1.5rem;
            }

            .icon-wrapper,
            .step-icon,
            .card-icon {
                width: 70px;
                height: 70px;
            }

            .step-icon i,
            .icon-wrapper i,
            .card-icon i {
                font-size: 2rem;
            }

            .step-card h3,
            .cta-card h3 {
                font-size: 1.3rem;
            }

            .phone-mockup {
                max-width: 300px;
            }

            .product-row {
                padding: 10px;
            }

            .app-ui {
                padding: 14px;
            }

            .nav-links {
                gap: 1rem;
            }

            .btn-login,
            .btn-register {
                padding: 0.4rem 1.2rem;
            }

            .search-content h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-bolt"></i></div>
            <span class="logo-text">كِسرة</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">الرئيسية</a>
            <a href="{{ route('public.how-it-works') }}">كيف تعمل</a>
            <a href="{{ route('public.stores') }}" class="active">المتاجر</a>
            <a href="{{ route('public.business') }}">للأعمال</a>
            <a href="{{ route('public.help') }}">المساعدة</a>
        </div>
       <div class="nav-buttons">
    @guest
        <!-- استخدام روابط a بدلاً من button يجعل التنقل أسلس -->
        <a href="{{ route('login') }}" class="btn-login" style="text-decoration: none; display: inline-block; text-align: center;">تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="btn-register" style="text-decoration: none; display: inline-block; text-align: center;">حساب جديد</a>
    @else
        {{-- عرض لوحة التحكم بناءً على الدور --}}
        @if(auth()->user()->role == 'seller')
            <a href="{{ route('seller.dashboard') }}" class="btn-login" style="text-decoration: none; display: inline-block; text-align: center;">لوحة التحكم</a>
        @elseif(auth()->user()->role == 'customer')
            <a href="{{ route('customer.dashboard') }}" class="btn-login" style="text-decoration: none; display: inline-block; text-align: center;">لوحة التحكم</a>
        @endif

        {{-- نموذج تسجيل الخروج --}}
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn-register" style="background:#ff3373; border: none; cursor: pointer;">
                <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
            </button>
        </form>
    @endguest
</div>
    </nav>

    <section class="store-hero">
        <div class="hero-content">
            <div class="store-badge"><i class="fas fa-store"></i><span>أكثر من {{ count($storesData) }} متجر متعاون</span></div>
            <h1>تسوق من <span class="highlight">علاماتك المفضلة</span><br>مع كِسرة</h1>
            <p class="subtitle">قسّم مشترياتك بدون فوائد وبخطوات بسيطة — اختر منتجك وادفع بالتقسيط من آلاف المتاجر</p>
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" id="storeSearchInput" placeholder="ابحث عن متجر أو علامة تجارية...">
                <button id="searchButton">ابحث الآن <i class="fas fa-arrow-left"></i></button>
            </div>
            <div class="hero-filters" id="heroFilters">
                <button class="hero-filter-pill active" data-filter="all">جميع الفئات</button>
                <button class="hero-filter-pill" data-filter="electronics">إلكترونيات</button>
                <button class="hero-filter-pill" data-filter="fashion">أزياء</button>
                <button class="hero-filter-pill" data-filter="beauty">جمال وعناية</button>
                <button class="hero-filter-pill" data-filter="cashback">استرداد نقدي</button>
            </div>
        </div>
        <div class="floating-brand brand-1"><i class="fab fa-apple"></i></div>
        <div class="floating-brand brand-2"><i class="fab fa-nike"></i></div>
        <div class="floating-brand brand-3"><i class="fab fa-adidas"></i></div>
        <div class="floating-brand brand-4"><i class="fas fa-mobile-alt"></i></div>
        <div class="floating-brand brand-6"><i class="fas fa-perfume"></i></div>
        <div class="floating-brand brand-8"><i class="fas fa-shopping-bag"></i></div>
    </section>

    <section class="stores-section">
        <div class="stores-container">
            <div class="filter-bar">
                <div class="filter-pills-wrapper" id="advancedFilterWrapper">
                    <button class="filter-pill active" data-category="all"><i class="fas fa-th-large"></i> جميع الفئات</button>
                    <button class="filter-pill" data-category="fashion"><i class="fas fa-tshirt"></i> أزياء</button>
                    <button class="filter-pill" data-category="electronics"><i class="fas fa-mobile-alt"></i> إلكترونيات</button>
                    <button class="filter-pill" data-category="beauty"><i class="fas fa-spa"></i> جمال</button>
                    <button class="filter-pill" data-category="cashback"><i class="fas fa-coins"></i> استرداد نقدي</button>
                    <button class="filter-pill" data-category="applepay"><i class="fab fa-apple-pay"></i> Apple Pay</button>
                </div>
                <div class="stores-count">عرض <span id="storeCount">0</span> متجر</div>
            </div>
            <div class="stores-grid" id="storesGrid"></div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo" style="justify-content: flex-start;">
                    <div class="logo-icon"><i class="fas fa-bolt"></i></div>
                    <span class="logo-text">كِسرة</span>
                </div>
                <p>قسّم مشترياتك بدون فوائد وبخطوات بسيطة — تجربة دفع مرنة وسريعة تناسب أسلوب حياتك.</p>
                <div class="trust-message"><i class="fas fa-check-circle"></i> موثوق من قبل أكثر من ١٠٠ ألف عميل</div>
            </div>
            <div class="footer-col">
                <h4>العملاء</h4>
                <ul>
                    <li><a href="#">حسابي</a></li>
                    <li><a href="#">طلباتي</a></li>
                    <li><a href="#">كيف تعمل</a></li>
                    <li><a href="#">العروض</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>للتجار</h4>
                <ul>
                    <li><a href="#">انضم كتاجر</a></li>
                    <li><a href="#">لوحة التحكم</a></li>
                    <li><a href="#">الشروط التجارية</a></li>
                    <li><a href="#">مركز المطورين</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>الدعم</h4>
                <ul>
                    <li><a href="#">اتصل بنا</a></li>
                    <li><a href="#">الأسئلة الشائعة</a></li>
                    <li><a href="#">مركز المساعدة</a></li>
                    <li><a href="#">الأمان والخصوصية</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>قانوني</h4>
                <ul>
                    <li><a href="#">سياسة الخصوصية</a></li>
                    <li><a href="#">الشروط والأحكام</a></li>
                    <li><a href="#">الإفصاحات المالية</a></li>
                </ul>
                <div class="newsletter">
                    <p><i class="fas fa-envelope"></i> اشترك للحصول على العروض</p>
                    <div class="newsletter-form">
                        <input type="email" placeholder="بريدك الإلكتروني">
                        <button>اشترك</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© {{ date('Y') }} كِسرة. جميع الحقوق محفوظة</div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script>
    // استقبال البيانات من Laravel
    const storesData = @json($storesData);

    let currentCategory = "all";
    let currentSearchQuery = "";

    function renderStores() {
        const grid = document.getElementById("storesGrid");
        if (!grid) return;

        let filtered = storesData.filter(store => {
            if (currentCategory !== "all" && store.category !== currentCategory) return false;
            if (currentSearchQuery && !store.name.toLowerCase().includes(currentSearchQuery.toLowerCase())) return false;
            return true;
        });

        document.getElementById("storeCount").innerText = filtered.length;

        if (filtered.length === 0) {
            grid.innerHTML = `<div class="no-stores">لا توجد متاجر مطابقة للبحث</div>`;
            return;
        }

        grid.innerHTML = filtered.map(store => `
            <div class="store-card" onclick="window.location.href='{{ url('/store') }}/${store.id}'">
                <img class="card-image" src="${store.image}" alt="${store.name}">
                <div class="card-content">
                    <div class="store-header">
                        <img class="store-logo" src="${store.logo}" alt="${store.name}">
                        <div class="store-info">
                            <h3>${store.name}</h3>
                            <div class="store-category">${store.categoryAr}</div>
                        </div>
                    </div>
                    <div class="store-description">${store.description}</div>
                    <div class="payment-methods">
                        ${store.paymentMethods.includes("applepay") ? '<span class="payment-badge"><i class="fab fa-apple-pay"></i> Apple Pay</span>' : ''}
                        ${store.paymentMethods.includes("googlepay") ? '<span class="payment-badge"><i class="fab fa-google-pay"></i> Google Pay</span>' : ''}
                    </div>
                </div>
            </div>
        `).join('');
    }


    function initAdvancedFilters() {
        const pills = document.querySelectorAll('.filter-pill');
        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                const category = pill.getAttribute('data-category');
                currentCategory = category;
                
                // تحديث الشكل النشط
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');

                // مزامنة الفلاتر العلوية (Hero Filters)
                const heroPills = document.querySelectorAll('.hero-filter-pill');
                heroPills.forEach(hp => {
                    if (hp.getAttribute('data-filter') === category) hp.classList.add('active');
                    else hp.classList.remove('active');
                });

                renderStores();
            });
        });
    }

    function initHeroFilters() {
        const heroPills = document.querySelectorAll('.hero-filter-pill');
        heroPills.forEach(pill => {
            pill.addEventListener('click', () => {
                const category = pill.getAttribute('data-filter');
                currentCategory = category;

                // تحديث الشكل النشط
                heroPills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');

                // مزامنة الفلاتر المتقدمة
                const advancedPills = document.querySelectorAll('.filter-pill');
                advancedPills.forEach(ap => {
                    if (ap.getAttribute('data-category') === category) ap.classList.add('active');
                    else ap.classList.remove('active');
                });

                renderStores();
                
                // التمرير لقسم المتاجر عند الضغط من الهيرو
                document.querySelector('.stores-section').scrollIntoView({ behavior: 'smooth' });
            });
        });
    }

    function initSearch() {
        const searchInput = document.getElementById('storeSearchInput');
        const searchBtn = document.getElementById('searchButton');
        
        const performSearch = () => {
            currentSearchQuery = searchInput.value.trim();
            renderStores();
        };

        if (searchBtn) searchBtn.addEventListener('click', performSearch);
        if (searchInput) {
            searchInput.addEventListener('keyup', (e) => {
                currentSearchQuery = e.target.value.trim();
                renderStores();
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderStores();
        initAdvancedFilters();
        initHeroFilters();
        initSearch();
    });
</script>

<!-- Chatbot Button and Widget -->
<style>
    .chatbot-btn {
        position: fixed;
        bottom: 24px;
        left: 24px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
        border: none;
        box-shadow: 0 8px 25px rgba(255, 79, 139, 0.4);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .chatbot-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(255, 79, 139, 0.6);
    }
    .chatbot-btn i {
        font-size: 28px;
        color: white;
    }

    .chatbot-widget {
        position: fixed;
        bottom: 96px;
        left: 24px;
        width: 360px;
        max-width: calc(100vw - 48px);
        background: rgba(31, 41, 55, 0.9);
        backdrop-filter: blur(16px);
        border-radius: 28px;
        border: 1px solid rgba(233, 179, 251, 0.4);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1001;
        font-family: 'Cairo', 'Inter', sans-serif;
    }

    .chatbot-header {
        background: linear-gradient(135deg, rgba(255, 79, 139, 0.2), rgba(233, 179, 251, 0.1));
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(233, 179, 251, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chatbot-header h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chatbot-header h3 i {
        color: #FFB3C7;
    }
    .chatbot-close {
        background: none;
        border: none;
        color: #FFB3C7;
        font-size: 1.3rem;
        cursor: pointer;
        transition: 0.2s;
    }
    .chatbot-close:hover {
        color: #FF4F8B;
    }

    .chatbot-messages {
        padding: 1rem;
        height: 350px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .message {
        max-width: 85%;
        padding: 0.6rem 1rem;
        border-radius: 18px;
        font-size: 0.85rem;
        line-height: 1.4;
        animation: fadeInUp 0.2s ease;
    }
    .message.bot {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(233, 179, 251, 0.3);
        align-self: flex-start;
        border-bottom-left-radius: 4px;
        color: #EDE9FE;
    }
    .message.user {
        background: linear-gradient(135deg, #FF4F8B, #E6497D);
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .quick-replies {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }
    .quick-reply-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(233, 179, 251, 0.4);
        border-radius: 40px;
        padding: 0.3rem 0.8rem;
        font-size: 0.7rem;
        color: #FFB3C7;
        cursor: pointer;
        transition: 0.2s;
    }
    .quick-reply-btn:hover {
        background: rgba(255, 79, 139, 0.3);
        border-color: #FF4F8B;
        color: white;
    }

    .chatbot-input-area {
        display: flex;
        padding: 0.8rem;
        border-top: 1px solid rgba(233, 179, 251, 0.2);
        background: rgba(0, 0, 0, 0.2);
    }
    .chatbot-input-area input {
        flex: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(233, 179, 251, 0.4);
        border-radius: 40px;
        padding: 0.6rem 1rem;
        color: white;
        font-family: inherit;
        outline: none;
    }
    .chatbot-input-area input::placeholder {
        color: #94A3B8;
    }
    .chatbot-input-area button {
        background: #FF4F8B;
        border: none;
        border-radius: 40px;
        padding: 0.6rem 1.2rem;
        margin-left: 8px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .chatbot-input-area button:hover {
        background: #ff3373;
        transform: scale(0.98);
    }

    @media (max-width: 500px) {
        .chatbot-widget {
            width: calc(100vw - 40px);
            left: 20px;
            bottom: 80px;
        }
    }
</style>

<div class="chatbot-btn" id="chatbotToggle">
    <i class="fas fa-comment-dots"></i>
</div>

<div class="chatbot-widget" id="chatbotWidget">
    <div class="chatbot-header">
        <h3><i class="fas fa-robot"></i> مساعد كِسرة الذكي</h3>
        <button class="chatbot-close" id="chatbotClose"><i class="fas fa-times"></i></button>
    </div>
    <div class="chatbot-messages" id="chatMessages">
        <div class="message bot">
            👋 مرحباً بك في كِسرة!<br>
            أنا مساعدك الذكي، يمكنني الإجابة عن أسئلتك حول:<br>
            • المنتجات والتقسيط<br>
            • طلباتي وأقساطي<br>
            • التسجيل كتاجر<br>
            • الدفع والاستلام<br>
            كيف يمكنني مساعدتك اليوم؟
        </div>
        <div class="quick-replies" id="quickReplies">
            <button class="quick-reply-btn" data-msg="كيف أشتري بالتقسيط؟">🛒 كيف أشتري بالتقسيط؟</button>
            <button class="quick-reply-btn" data-msg="ما هي طريقة الدفع؟">💳 طريقة الدفع</button>
            <button class="quick-reply-btn" data-msg="كيف أصبح تاجراً على كِسرة؟">🏢 كيف أصبح تاجراً؟</button>
            <button class="quick-reply-btn" data-msg="متى تصل أقساطي؟">📅 متى تصل أقساطي؟</button>
        </div>
    </div>
    <div class="chatbot-input-area">
        <input type="text" id="chatInput" placeholder="اكتب سؤالك هنا...">
        <button id="chatSend"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
    (function() {
        const toggleBtn = document.getElementById('chatbotToggle');
        const widget = document.getElementById('chatbotWidget');
        const closeBtn = document.getElementById('chatbotClose');
        const messagesContainer = document.getElementById('chatMessages');
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('chatSend');
        const quickBtns = document.querySelectorAll('.quick-reply-btn');

        // فتح/إغلاق الشات بوت
        function openChat() {
            widget.style.display = 'flex';
        }
        function closeChat() {
            widget.style.display = 'none';
        }
        toggleBtn.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);

        // إضافة رسالة المستخدم
        function addUserMessage(text) {
            const msgDiv = document.createElement('div');
            msgDiv.className = 'message user';
            msgDiv.textContent = text;
            messagesContainer.appendChild(msgDiv);
            scrollToBottom();
        }

        // إضافة رسالة البوت مع ردود سريعة اختيارية
        function addBotMessage(text, showQuick = false, quickOptions = []) {
            const msgDiv = document.createElement('div');
            msgDiv.className = 'message bot';
            msgDiv.innerHTML = text;
            messagesContainer.appendChild(msgDiv);

            if (showQuick && quickOptions.length) {
                const quickDiv = document.createElement('div');
                quickDiv.className = 'quick-replies';
                quickOptions.forEach(opt => {
                    const btn = document.createElement('button');
                    btn.className = 'quick-reply-btn';
                    btn.textContent = opt.text;
                    btn.dataset.msg = opt.value;
                    btn.addEventListener('click', () => {
                        addUserMessage(opt.text);
                        processBotReply(opt.value);
                        btn.remove();
                    });
                    quickDiv.appendChild(btn);
                });
                messagesContainer.appendChild(quickDiv);
            }
            scrollToBottom();
        }

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // المعالجة الأساسية للردود (ذكاء اصطناعي بسيط)
        function processBotReply(userMsg) {
            const msg = userMsg.toLowerCase().trim();

            // الأسئلة الشائعة
            if (msg.includes('تقسيط') || msg.includes('كيف أشتري بالتقسيط') || msg.includes('طريقة التقسيط')) {
                addBotMessage(`🟣 **الشراء بالتقسيط عبر كِسرة سهل جداً:**<br><br>
                1️⃣ اختر المنتج الذي يعجبك.<br>
                2️⃣ عند الدفع، اختر "تقسيط عبر كِسرة".<br>
                3️⃣ اختر عدد الدفعات (3، 6، 12 شهراً).<br>
                4️⃣ سيتم خصم القسط الأول مباشرة (محاكاة حالياً)، وسيتم إشعارك بالأقساط التالية.<br><br>
                ✅ لا حاجة لضمانات معقدة، فقط هوية سارية.`);
                return;
            }
            if (msg.includes('دفع') || msg.includes('طريقة الدفع') || msg.includes('الدفع')) {
                addBotMessage(`💳 **طرق الدفع المقبولة في كِسرة:**<br><br>
                • الدفع عند الاستلام (نقدي)<br>
                • بطاقات ائتمان / مدى (قريباً)<br>
                • تقسيط عبر كِسرة (دفعة أولى + أقساط شهرية)<br><br>
                جميع المدفوعات آمنة وبياناتك مشفرة.`);
                return;
            }
            if (msg.includes('تاجر') || msg.includes('أصبح تاجر') || msg.includes('إنشاء متجر')) {
                addBotMessage(`🏢 **كيف تصبح تاجراً على كِسرة؟**<br><br>
                1️⃣ سجل الدخول إلى حسابك.<br>
                2️⃣ اذهب إلى لوحة التحكم ← اضغط "كن تاجراً" أو "إنشاء متجر".<br>
                3️⃣ أدخل اسم المتجر ووصفه.<br>
                4️⃣ بعد إنشاء المتجر، سيتم ترقيتك إلى تاجر تلقائياً.<br><br>
                🔹 يمكنك بعدها إضافة المنتجات، وسيتمكن العملاء من شرائها بالتقسيط.`);
                return;
            }
            if (msg.includes('قسط') || msg.includes('أقساطي') || msg.includes('متى استحقاق')) {
                addBotMessage(`📅 **متابعة أقساطك:**<br><br>
                يمكنك الاطلاع على جدول الأقساط من خلال:<br>
                "حسابي ← أقساطي" أو "طلباتي ← تفاصيل الطلب".<br>
                تواريخ الاستحقاق محددة بوضوح مع إمكانية دفع القسط مبكراً (محاكاة).<br>
                إذا تأخر القسط، ستتلقى إشعاراً لتجنب الرسوم.`);
                return;
            }
            if (msg.includes('شحن') || msg.includes('توصيل') || msg.includes('استلام')) {
                addBotMessage(`🚚 **التوصيل والاستلام:**<br><br>
                • بعد تأكيد الطلب، سيتم التواصل معك لتحديد عنوان التوصيل.<br>
                • المدة تختلف حسب المتجر (عادة 2-5 أيام عمل).<br>
                • يمكنك متابعة حالة الطلب من "طلباتي".<br><br>
                لأي استفسار تواصل مع البائع مباشرة عبر المتجر.`);
                return;
            }
            if (msg.includes('ضمان') || msg.includes('استرجاع') || msg.includes('مرتجع')) {
                addBotMessage(`🛡️ **سياسة الإرجاع والضمان:**<br><br>
                • يحق لك إرجاع المنتج خلال 14 يوماً من تاريخ الاستلام.<br>
                • يجب أن يكون المنتج بحالته الأصلية.<br>
                • بعد الإرجاع، يتم إلغاء الأقساط المتبقية واسترداد المدفوع.<br><br>
                لمزيد من المعلومات، راجع سياسة المتجر.`);
                return;
            }
            if (msg.includes('الرئيسية') || msg.includes('مرحباً') || msg.includes('اهلاً') || msg.includes('السلام')) {
                addBotMessage(`👋 أهلاً بك مجدداً!<br>
                يمكنك سؤالي عن:<br>
                - المنتجات والتقسيط<br>
                - طلباتي وأقساطي<br>
                - كيف تصبح تاجراً<br>
                - الدفع والتوصيل<br>
                فقط اكتب سؤالك 🙂`);
                return;
            }

            // الرد الافتراضي
            addBotMessage(`🤖 شكراً لتواصلك مع كِسرة!<br>
            سؤال رائع. إذا كنت بحاجة إلى مساعدة في:<br>
            • الشراء بالتقسيط<br>
            • طريقة الدفع<br>
            • التسجيل كتاجر<br>
            • أقساطي ومواعيدها<br>
            فقط اختر من الأسئلة السريعة أو اكتب طلبك بوضوح وسأساعدك.<br><br>
            يمكنك أيضاً تصفح الأسئلة الشائعة في صفحة "المساعدة".`);
        }

        // إرسال رسالة المستخدم
        function sendUserMessage() {
            let text = chatInput.value.trim();
            if (text === '') return;
            addUserMessage(text);
            chatInput.value = '';

            // إظهار مؤشر كتابة بوت (اختياري)
            setTimeout(() => {
                processBotReply(text);
            }, 400);
        }

        sendBtn.addEventListener('click', sendUserMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendUserMessage();
        });

        // أحداث الأزرار السريعة
        quickBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const msg = btn.getAttribute('data-msg');
                addUserMessage(msg);
                processBotReply(msg);
            });
        });
    })();
</script>
</body>

</html>