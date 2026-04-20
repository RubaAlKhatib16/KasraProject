<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · {{ $store->name }} | تقسيط بدون فوائد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* كل الـ CSS من ملف store-page.html الأصلي (تم نسخه كاملاً) */
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
            max-width: 1280px;
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

        .nav-links a:hover {
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

        /* Breadcrumb */
        .breadcrumb {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto 1rem;
            font-size: 0.85rem;
            color: #EDE9FE;
        }

        .breadcrumb a {
            color: #FFB3C7;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Main container */
        .store-detail-container {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
        }

        .store-content {
            background: #F8FAFC;
            border-radius: 48px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* Store Hero */
        .store-hero {
            background: white;
            padding: 2.5rem;
            border-bottom: 1px solid #E5E7EB;
        }

        .hero-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }

        .store-logo {
            width: 110px;
            height: 110px;
            background: #F3F4F6;
            border-radius: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #FF4F8B;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 79, 139, 0.2);
        }

        .store-info {
            flex: 1;
        }

        .store-info h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .store-category {
            font-size: 0.85rem;
            font-weight: 600;
            color: #FF4F8B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        .store-description {
            font-size: 1rem;
            color: #4B5563;
            margin-bottom: 1rem;
        }

        .rating {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #F3F4F6;
            padding: 0.3rem 0.8rem;
            border-radius: 40px;
            font-size: 0.8rem;
            color: #FF4F8B;
        }

        .rating i {
            color: #FFB3C7;
        }

        /* Offer Section */
        .offer-section {
            padding: 2rem 2.5rem;
            background: #F8FAFC;
        }

        .offer-card {
            background: linear-gradient(135deg, #FFE9F0, #F5E9FE);
            border-radius: 28px;
            padding: 1.8rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02);
        }

        .offer-text h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #FF4F8B;
            margin-bottom: 0.25rem;
        }

        .offer-text p {
            font-size: 0.9rem;
            color: #4B5563;
        }

        .payment-icons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .payment-icon {
            background: white;
            border-radius: 40px;
            padding: 0.4rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1F2937;
        }

        .payment-icon i {
            color: #FF4F8B;
        }

        .btn-offer {
            background: #FF4F8B;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 0.9rem;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-offer:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        /* About Store */
        .about-section {
            padding: 1.5rem 2.5rem;
            border-top: 1px solid #E5E7EB;
            border-bottom: 1px solid #E5E7EB;
        }

        .about-section h2 {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.75rem;
        }

        .about-section p {
            font-size: 0.95rem;
            color: #4B5563;
            line-height: 1.6;
        }

        /* Products Grid */
        .products-section {
            padding: 2rem 2.5rem;
        }

        .products-section h2 {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 1.5rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            border: 1px solid #E5E7EB;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
            border-color: #FFB3C7;
        }

        .product-image {
            width: 100%;
            height: 170px;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .product-card:hover .product-image {
            transform: scale(1.03);
        }

        .product-info {
            padding: 1rem;
        }

        .product-tag {
            display: inline-block;
            background: #FFE9F0;
            color: #FF4F8B;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            margin-bottom: 0.5rem;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.4rem;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 800;
            color: #FF4F8B;
            margin-bottom: 0.3rem;
        }

        .product-installment {
            font-size: 0.7rem;
            color: #6B7280;
        }

        /* Payment Info */
        .payment-info-section {
            padding: 2rem 2.5rem;
            background: white;
            border-top: 1px solid #E5E7EB;
        }

        .payment-info-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
        }

        .info-card {
            flex: 1;
            min-width: 200px;
            text-align: center;
            padding: 1rem;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: #FFE9F0;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: #FF4F8B;
        }

        .info-card h4 {
            font-size: 1rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            font-size: 0.85rem;
            color: #4B5563;
        }

        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .trust-badge {
            background: #F3F4F6;
            border-radius: 40px;
            padding: 0.3rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: #FF4F8B;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .cta-section {
            padding: 2rem 2.5rem 2.5rem;
            text-align: center;
            border-top: 1px solid #E5E7EB;
        }

        .btn-cta {
            background: #FF4F8B;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-family: inherit;
            box-shadow: 0 8px 18px rgba(255, 79, 139, 0.25);
        }

        .btn-cta:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        /* Footer (نفس الأكواد السابقة) */
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
            transition: color 0.2s;
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

            body {
                padding: 1rem;
            }

            .navbar {
                flex-direction: column;
                text-align: center;
                padding: 1rem;
            }

            .nav-links {
                justify-content: center;
            }

            .store-hero {
                padding: 1.5rem;
            }

            .hero-flex {
                flex-direction: column;
                text-align: center;
            }

            .store-logo {
                margin: 0 auto;
            }

            .offer-section,
            .about-section,
            .products-section,
            .payment-info-section,
            .cta-section {
                padding: 1.5rem;
            }

            .offer-card {
                flex-direction: column;
                text-align: center;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .payment-info-grid {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 640px) {
            .nav-links {
                gap: 1rem;
            }

            .btn-login,
            .btn-register {
                padding: 0.4rem 1.2rem;
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
            <a href="{{ route('public.stores') }}">المتاجر</a>
            <a href="{{ route('public.business') }}">للأعمال</a>
            <a href="{{ route('public.help') }}">المساعدة</a>
        </div>
        <div class="nav-buttons">
            @guest
            <a href="{{ route('login') }}" class="btn-login" style="text-decoration: none;">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="btn-register" style="text-decoration: none;">حساب جديد</a>
            @else
            @if(auth()->user()->role == 'seller')
            <a href="{{ route('seller.dashboard') }}" class="btn-login" style="text-decoration: none;">لوحة التحكم</a>
            @else
            <a href="{{ route('customer.dashboard') }}" class="btn-login" style="text-decoration: none;">لوحة التحكم</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-register" style="background:#ff3373; border:none; cursor:pointer;">تسجيل الخروج</button>
            </form>
            @endguest
        </div>
    </nav>

    <div class="breadcrumb">
        <a href="{{ route('home') }}">الرئيسية</a> / <a href="{{ route('public.stores') }}">المتاجر</a> / <span style="color:#FFB3C7">{{ $store->name }}</span>
    </div>

    <div class="store-detail-container">
        <div class="store-content">
            <!-- Store Hero -->
            <section class="store-hero">
                <div class="hero-flex">
                    <div class="store-logo">
                        @if($store->logo)
                        <img src="{{ asset('storage/'.$store->logo) }}" style="width:80px; height:80px; object-fit:cover; border-radius:28px;">
                        @else
                        <i class="fas fa-store"></i>
                        @endif
                    </div>
                    <div class="store-info">
                        <div class="store-category">
                            {{ $store->category_name ?? 'متجر معتمد' }}
                        </div>
                        <h1>{{ $store->name }}</h1>
                        <div class="store-description">
                            {{ $store->description ?? 'تسوق مع كسرة واستمتع بالتقسيط بدون فوائد' }}
                        </div>
                        <div class="rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            <span>٤.٨ (١٢٠٠+ تقييم)</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Offer Section -->
            <section class="offer-section">
                <div class="offer-card">
                    <div class="offer-text">
                        <h3>💰 استرداد نقدي يصل إلى ١٠٪</h3>
                        <p>قسّم مشترياتك إلى ٤ دفعات بدون فوائد — الدفع أولاً بأول</p>
                    </div>
                    <div class="payment-icons">
                        <span class="payment-icon"><i class="fab fa-apple-pay"></i> Apple Pay</span>
                        <span class="payment-icon"><i class="fab fa-google-pay"></i> Google Pay</span>
                        <span class="payment-icon"><i class="fas fa-credit-card"></i> بطاقات</span>
                    </div>
                    <button class="btn-offer" onclick="window.location.href='{{ route('client.products.index') }}'">تسوق الآن مع كِسرة <i class="fas fa-arrow-left"></i></button>
                </div>
            </section>

            <!-- About Store -->
            <section class="about-section">
                <h2>عن المتجر</h2>
                <p>{{ $store->description ?? $store->name.' هو متجر موثوق يقدم منتجات أصلية مع خدمة عملاء ممتازة. يمكنك التسوق بالتقسيط عبر كسرة بدون فوائد.' }}</p>
            </section>

            <!-- Products Section -->
            <section class="products-section">
                <h2>أشهر العروض</h2>
                <div class="products-grid">
                    @forelse($products as $product)
                    <div class="product-card" onclick="window.location.href='{{ route('client.products.show', $product->slug) }}'">
                        <img class="product-image" src="{{ $product->featured_image ? asset('storage/'.$product->featured_image) : 'https://via.placeholder.com/600x400?text='.urlencode($product->name) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <span class="product-tag">عرض خاص</span>
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">{{ number_format($product->price, 2) }} د.أ</div>
                            <div class="product-installment">
                                أو {{ $product->installments_count ?? 4 }} دفعات بدون فوائد بقيمة {{ number_format($product->price / ($product->installments_count ?? 4), 2) }} د.أ
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="text-align:center;">لا توجد منتجات في هذا المتجر حالياً</p>
                    @endforelse
                </div>
            </section>

            <!-- Payment Info -->
            <section class="payment-info-section">
                <h2 style="text-align:center; margin-bottom:1.5rem;">كيف يعمل التقسيط مع كِسرة؟</h2>
                <div class="payment-info-grid">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-shopping-cart"></i></div>
                        <h4>١. اختر منتجك</h4>
                        <p>تصفح المتجر وأضف المنتجات إلى سلة التسوق</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-credit-card"></i></div>
                        <h4>٢. اختر كِسرة عند الدفع</h4>
                        <p>حدد خيار الدفع بالتقسيط مع كِسرة</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                        <h4>٣. ادفع على دفعات</h4>
                        <p>قسّم المبلغ إلى ٢, ٣, ٤ أو ٦ دفعات بدون فوائد</p>
                    </div>
                </div>
                <div class="trust-badges">
                    <span class="trust-badge"><i class="fas fa-check-circle"></i> بدون فوائد</span>
                    <span class="trust-badge"><i class="fas fa-lock"></i> دفع آمن</span>
                    <span class="trust-badge"><i class="fas fa-clock"></i> موافقة فورية</span>
                </div>
            </section>

            <!-- CTA -->
            <section class="cta-section">
                <button class="btn-cta" onclick="window.location.href='{{ route('client.products.index') }}'">ابدأ التسوق مع كِسرة <i class="fas fa-arrow-left"></i></button>
            </section>
        </div>
    </div>

    <!-- Footer (نفس الأصلي) -->
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
                    <div class="newsletter-form"><input type="email" placeholder="بريدك الإلكتروني"><button>اشترك</button></div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© {{ date('Y') }} كِسرة. جميع الحقوق محفوظة</div>
            <div class="social-icons"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a></div>
        </div>
    </footer>

    <script>
        // Product card click: simulate adding to cart
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('click', () => {
                const productName = card.querySelector('.product-title')?.innerText || 'المنتج';
                alert(`تم إضافة ${productName} إلى سلة المشتريات\nيمكنك إكمال الدفع باستخدام كِسرة`);
            });
        });

        // CTA buttons
        const offerBtn = document.getElementById('offerBtn');
        const mainCta = document.getElementById('mainCtaBtn');
        const checkoutMessage = () => {
            window.location.href = "products.html";
        };

        if (offerBtn) offerBtn.addEventListener('click', checkoutMessage);
        if (mainCta) mainCta.addEventListener('click', checkoutMessage);
    </script>
</body>

</html>