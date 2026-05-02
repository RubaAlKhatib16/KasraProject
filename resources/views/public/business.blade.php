<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>كِسرة · حلول الدفع المرنة | نمّي مبيعاتك بذكاء</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* كل الـ CSS من الملف الأصلي (تم نسخه بالكامل) */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { background-color: #1F2937; font-family: 'Cairo', 'Tahoma', sans-serif; line-height: 1.5; min-height: 100vh; padding: 2rem; overflow-x: hidden; }
    .main-wrapper { max-width: 1280px; margin: 0 auto; display: flex; flex-direction: column; gap: 3rem; }
    /* Hero Section */
    .merchant-hero { width: 100%; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 64px; padding: 3rem; position: relative; overflow: hidden; border: 1px solid rgba(233,179,251,0.25); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
    .merchant-hero::before { content: ''; position: absolute; top: -20%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,79,139,0.15) 0%, rgba(233,179,251,0.05) 70%); border-radius: 50%; filter: blur(60px); pointer-events: none; }
    .merchant-hero::after { content: ''; position: absolute; bottom: -15%; left: -5%; width: 450px; height: 450px; background: radial-gradient(circle, rgba(233,179,251,0.1) 0%, rgba(255,79,139,0.03) 70%); border-radius: 50%; filter: blur(60px); pointer-events: none; }
    .hero-split { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 3rem; position: relative; z-index: 2; }
    .hero-content { flex: 1; min-width: 280px; }
    .badge { display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255,79,139,0.12); backdrop-filter: blur(4px); padding: 0.5rem 1.2rem; border-radius: 80px; font-size: 0.85rem; font-weight: 600; color: #FFB3C7; margin-bottom: 1.8rem; border: 0.5px solid rgba(233,179,251,0.3); }
    .hero-content h1 { font-size: clamp(2.5rem,5vw,4rem); font-weight: 800; color: white; line-height: 1.2; margin-bottom: 1.2rem; letter-spacing: -0.02em; }
    .hero-content .highlight { background: linear-gradient(120deg, #FF4F8B, #E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; display: inline-block; }
    .hero-content p { font-size: 1.15rem; color: #EDE9FE; max-width: 520px; margin-bottom: 2rem; line-height: 1.6; }
    .cta-group { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; }
    .btn-cta { background: #FF4F8B; border: none; padding: 0.9rem 2rem; border-radius: 60px; font-weight: 700; font-size: 1rem; color: white; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.8rem; font-family: inherit; box-shadow: 0 8px 20px rgba(255,79,139,0.3); }
    .btn-cta:hover { background: #ff3373; transform: translateY(-3px) scale(1.02); box-shadow: 0 15px 25px rgba(255,79,139,0.45); }
    .btn-outline { background: transparent; border: 1px solid rgba(233,179,251,0.6); padding: 0.9rem 1.8rem; border-radius: 60px; font-weight: 600; color: #FFB3C7; transition: all 0.2s; font-family: inherit; display: inline-flex; align-items: center; gap: 0.6rem; cursor: pointer; backdrop-filter: blur(4px); }
    .btn-outline:hover { border-color: #FF4F8B; background: rgba(255,79,139,0.1); color: white; }
    /* Dashboard Mockup */
    .hero-image { flex: 1; min-width: 300px; position: relative; display: flex; justify-content: center; }
    .image-wrapper { position: relative; width: 100%; max-width: 550px; animation: float 6s ease-in-out infinite; }
    @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-12px); } 100% { transform: translateY(0px); } }
    .dashboard-mockup { background: rgba(18,25,35,0.6); backdrop-filter: blur(12px); border-radius: 36px; padding: 1.6rem; border: 1px solid rgba(233,179,251,0.35); box-shadow: 0 25px 40px -12px rgba(0,0,0,0.4); }
    .mockup-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 0.6rem; border-bottom: 1px solid rgba(233,179,251,0.2); }
    .mockup-logo { display: flex; align-items: center; gap: 0.6rem; }
    .mockup-logo-icon { background: #FF4F8B; width: 34px; height: 34px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: white; }
    .mockup-logo span { font-weight: 800; font-size: 1rem; color: white; }
    .mockup-badge { background: rgba(255,79,139,0.2); border-radius: 60px; padding: 0.3rem 0.8rem; font-size: 0.7rem; font-weight: 600; color: #FFB3C7; }
    .stats-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 1rem; margin-bottom: 1.5rem; }
    .stat-card { background: rgba(255,255,255,0.05); border-radius: 24px; padding: 0.9rem; text-align: center; border: 1px solid rgba(233,179,251,0.2); }
    .stat-number { font-size: 1.6rem; font-weight: 800; color: #FFB3C7; }
    .stat-label { font-size: 0.7rem; color: #CBD5E1; }
    .chart-mockup { background: rgba(0,0,0,0.2); border-radius: 24px; padding: 1rem; margin-bottom: 1rem; }
    .chart-title { font-size: 0.75rem; font-weight: 500; color: #CBD5E1; }
    .chart-bars { display: flex; justify-content: space-between; align-items: flex-end; gap: 0.5rem; height: 100px; margin-top: 0.8rem; }
    .bar { flex: 1; background: linear-gradient(180deg, #FF4F8B, #E9B3FB); border-radius: 12px; transition: height 0.3s; }
    .bar-1 { height: 62px; } .bar-2 { height: 88px; } .bar-3 { height: 48px; } .bar-4 { height: 98px; } .bar-5 { height: 72px; } .bar-6 { height: 56px; }
    .payment-icons { display: flex; justify-content: center; gap: 1.2rem; margin-top: 0.8rem; }
    .payment-icons i { font-size: 1.3rem; color: #94A3B8; transition: all 0.2s; }
    .payment-icons i:hover { color: #FFB3C7; transform: scale(1.1); }
    /* Benefits Section */
    .benefits-section { width: 100%; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 48px; padding: 3rem 2.5rem; border: 1px solid rgba(233,179,251,0.25); box-shadow: 0 20px 35px -10px rgba(0,0,0,0.3); position: relative; }
    .benefits-section::before { content: "⚡"; position: absolute; top: 15px; left: 20px; font-size: 6rem; opacity: 0.08; pointer-events: none; }
    .section-header { text-align: center; max-width: 800px; margin: 0 auto 2.8rem; position: relative; z-index: 2; }
    .section-header h2 { font-size: clamp(1.8rem,4vw,2.6rem); font-weight: 800; color: white; line-height: 1.3; margin-bottom: 0.8rem; }
    .section-header .highlight { background: linear-gradient(120deg, #FF4F8B, #E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; }
    .section-sub { color: #EDE9FE; font-size: 1rem; }
    .benefits-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 1.8rem; position: relative; z-index: 2; }
    .benefit-card { background: rgba(255,255,255,0.04); backdrop-filter: blur(4px); border-radius: 32px; padding: 1.8rem 1.2rem; text-align: center; transition: all 0.3s ease; border: 1px solid rgba(233,179,251,0.2); }
    .benefit-card:hover { transform: translateY(-6px); background: rgba(255,255,255,0.08); border-color: rgba(255,79,139,0.6); box-shadow: 0 18px 30px -12px rgba(0,0,0,0.4); }
    .card-icon { width: 70px; height: 70px; background: linear-gradient(135deg, rgba(255,79,139,0.1), rgba(233,179,251,0.15)); border-radius: 28px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.3rem; transition: all 0.3s; }
    .benefit-card:hover .card-icon { background: linear-gradient(135deg, rgba(255,79,139,0.15), rgba(233,179,251,0.2)); }
    .card-icon i { font-size: 2rem; color: #FFB3C7; }
    .benefit-card h3 { font-size: 1.25rem; font-weight: 800; color: white; margin-bottom: 0.7rem; }
    .benefit-card p { font-size: 0.9rem; color: #CBD5E6; line-height: 1.5; }
    .accent-line { width: 40px; height: 3px; background: #FFB3C7; border-radius: 4px; margin: 1rem auto 0; opacity: 0.5; transition: all 0.2s; }
    .benefit-card:hover .accent-line { width: 70px; opacity: 1; background: #FF4F8B; }
    .trust-footer { text-align: center; padding: 1.5rem 1rem 0.5rem; border-top: 1px solid rgba(233,179,251,0.15); margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .trust-badge { display: flex; gap: 1.5rem; justify-content: center; align-items: center; color: #9CA3AF; font-size: 0.8rem; }
    .trust-badge i { color: #FFB3C7; margin-left: 0.3rem; }
    .copyright { font-size: 0.75rem; color: #6C7A91; }
    /* How It Works for Merchants */
    .how-it-works-merchants { width: 100%; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 48px; padding: 3rem 2rem; border: 1px solid rgba(233,179,251,0.25); position: relative; overflow: hidden; }
    .how-title { text-align: center; margin-bottom: 3rem; }
    .how-title h2 { font-size: clamp(2rem,4vw,2.8rem); font-weight: 800; color: white; margin-bottom: 0.5rem; }
    .how-title p { font-size: 1rem; color: #EDE9FE; max-width: 560px; margin: 0 auto; }
    .how-block { display: flex; align-items: center; gap: 3rem; margin-bottom: 4rem; opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .how-block.visible { opacity: 1; transform: translateY(0); }
    .how-block.reverse { flex-direction: row-reverse; }
    .how-block.centered { flex-direction: column; text-align: center; }
    .how-image { flex: 1; position: relative; display: flex; justify-content: center; }
    .mockup-simple { background: rgba(18,25,35,0.6); backdrop-filter: blur(8px); border-radius: 32px; padding: 1.2rem; border: 1px solid rgba(233,179,251,0.3); box-shadow: 0 20px 35px -12px rgba(0,0,0,0.3); max-width: 320px; width: 100%; transition: transform 0.3s ease; }
    .mockup-simple img { width: 100%; border-radius: 24px; display: block; }
    .how-image .abstract-shape { position: absolute; width: 120%; height: 120%; top: -10%; left: -10%; background: radial-gradient(circle, rgba(255,79,139,0.15), rgba(233,179,251,0.05)); filter: blur(40px); z-index: -1; border-radius: 50%; }
    .how-text { flex: 1; }
    .how-text h3 { font-size: 1.8rem; font-weight: 800; color: white; margin-bottom: 1rem; }
    .how-text p { font-size: 1rem; color: #CBD5E6; line-height: 1.6; }
    .deco-star { position: absolute; font-size: 2rem; color: rgba(255,79,139,0.2); pointer-events: none; }
    .deco-1 { top: 10%; left: 5%; animation: floatDeco 8s infinite; }
    .deco-2 { bottom: 15%; right: 8%; animation: floatDeco 10s infinite reverse; }
    @keyframes floatDeco { 0%,100% { transform: translateY(0px) rotate(0deg); } 50% { transform: translateY(-15px) rotate(10deg); } }
    /* Impact Stats Section */
    .impact-stats { width: 100%; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 48px; padding: 3rem 2.5rem; border: 1px solid rgba(233,179,251,0.25); box-shadow: 0 20px 35px -10px rgba(0,0,0,0.3); }
    .impact-header { text-align: center; margin-bottom: 3rem; }
    .impact-header h2 { font-size: clamp(2rem,4vw,2.8rem); font-weight: 800; color: white; letter-spacing: -0.01em; margin-bottom: 0.75rem; }
    .impact-header p { font-size: 1.1rem; color: #EDE9FE; max-width: 600px; margin: 0 auto; }
    .stats-impact-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.8rem; }
    .impact-card { background: linear-gradient(135deg, #7C3AED, #A855F7); border-radius: 24px; padding: 1.8rem 1.2rem; text-align: center; transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.2); cursor: default; }
    .impact-card:hover { transform: translateY(-6px); box-shadow: 0 20px 30px -12px rgba(124,58,237,0.4); }
    .impact-number { font-size: 3.5rem; font-weight: 800; line-height: 1.2; color: white; margin-bottom: 0.5rem; letter-spacing: -0.02em; display: flex; align-items: center; justify-content: center; gap: 0.2rem; flex-wrap: wrap; }
    .impact-desc { font-size: 0.95rem; font-weight: 500; color: rgba(255,255,255,0.9); margin-top: 0.6rem; line-height: 1.5; }
    .mini-trend { margin-top: 1rem; display: flex; justify-content: center; align-items: center; gap: 4px; }
    /* Navbar and Footer (مثل الملفات السابقة) */
    .navbar { max-width: 1280px; width: 100%; margin: 0 auto 2rem auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; background: rgba(31,41,55,0.85); backdrop-filter: blur(12px); padding: 0.8rem 2rem; border-radius: 80px; border: 1px solid rgba(233,179,251,0.25); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
    .logo { display: flex; align-items: center; gap: 0.5rem; }
    .logo-icon { background: #FF4F8B; width: 40px; height: 40px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; }
    .logo-text { font-size: 1.6rem; font-weight: 800; color: white; }
    .nav-links { display: flex; gap: 2rem; flex-wrap: wrap; }
    .nav-links a { text-decoration: none; color: #EDE9FE; font-weight: 600; transition: 0.2s; }
    .nav-links a:hover { color: #FFB3C7; }
    .nav-buttons { display: flex; gap: 0.8rem; }
    .btn-login, .btn-register { padding: 0.5rem 1.5rem; border-radius: 40px; font-weight: 600; cursor: pointer; transition: 0.2s; font-family: inherit; border: none; }
    .btn-login { background: transparent; border: 1px solid #FFB3C7; color: #FFB3C7; }
    .btn-login:hover { background: rgba(255,179,199,0.1); transform: scale(1.02); }
    .btn-register { background: #FF4F8B; color: white; box-shadow: 0 4px 12px rgba(255,79,139,0.3); }
    .btn-register:hover { background: #ff3373; transform: scale(1.02); }
    /* Footer */
    .footer { max-width: 1280px; width: 100%; margin: 5rem auto 0; background: #1F2937; border-radius: 32px 32px 0 0; padding: 3rem 2rem 1.5rem; border-top: 1px solid rgba(233,179,251,0.2); }
    .footer-grid { display: grid; grid-template-columns: 1.2fr repeat(4,1fr); gap: 2rem; margin-bottom: 2.5rem; }
    .footer-brand p { color: #CBD5E6; font-size: 0.9rem; line-height: 1.6; margin: 1rem 0 1.2rem; max-width: 250px; }
    .trust-message { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,79,139,0.08); padding: 0.4rem 1rem; border-radius: 40px; font-size: 0.75rem; color: #FFB3C7; }
    .footer-col h4 { color: white; font-size: 1.1rem; font-weight: 700; margin-bottom: 1.2rem; display: inline-block; }
    .footer-col ul { list-style: none; padding: 0; }
    .footer-col li { margin-bottom: 0.7rem; }
    .footer-col a { text-decoration: none; color: #CBD5E6; font-size: 0.9rem; transition: color 0.2s ease; }
    .footer-col a:hover { color: #FF4F8B; }
    .newsletter { margin-top: 1rem; }
    .newsletter p { color: #CBD5E6; font-size: 0.85rem; margin-bottom: 0.8rem; }
    .newsletter-form { display: flex; gap: 0.5rem; background: rgba(255,255,255,0.05); border-radius: 60px; padding: 0.2rem; border: 1px solid rgba(233,179,251,0.2); }
    .newsletter-form input { flex: 1; background: transparent; border: none; padding: 0.6rem 1rem; color: white; font-family: inherit; font-size: 0.85rem; outline: none; }
    .newsletter-form input::placeholder { color: #9CA3AF; }
    .newsletter-form button { background: #FF4F8B; border: none; border-radius: 40px; padding: 0.6rem 1.2rem; color: white; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: inherit; font-size: 0.8rem; }
    .newsletter-form button:hover { background: #ff3373; transform: scale(1.02); }
    .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid rgba(233,179,251,0.15); font-size: 0.8rem; color: #9CA3AF; }
    .social-icons { display: flex; gap: 1.2rem; }
    .social-icons a { color: #CBD5E6; font-size: 1.2rem; transition: all 0.2s; }
    .social-icons a:hover { color: #FF4F8B; transform: translateY(-2px); }
    @media (max-width: 1024px) { .footer-grid { grid-template-columns: repeat(2,1fr); gap: 2rem; } .footer-brand { grid-column: span 2; } .stats-impact-grid { grid-template-columns: repeat(2,1fr); } .benefits-grid { grid-template-columns: repeat(2,1fr); } .how-block, .how-block.reverse { flex-direction: column; text-align: center; gap: 1.5rem; } .how-text { text-align: center; } .impact-stats, .benefits-section, .merchant-hero, .how-it-works-merchants { padding: 2rem 1.5rem; } }
    @media (max-width: 768px) { body { padding: 1rem; } .hero-split { flex-direction: column; text-align: center; } .hero-content { text-align: center; } .hero-content p { margin-left: auto; margin-right: auto; } .cta-group { justify-content: center; } .badge { margin-right: auto; margin-left: auto; } .footer-grid { grid-template-columns: 1fr; gap: 1.5rem; } .footer-brand { grid-column: span 1; } .footer-bottom { flex-direction: column; text-align: center; } .navbar { flex-direction: column; text-align: center; padding: 1rem; } .nav-links { justify-content: center; } }
    @media (max-width: 640px) { .stats-impact-grid { grid-template-columns: 1fr; } .benefits-grid { grid-template-columns: 1fr; } .impact-stats, .benefits-section, .merchant-hero, .how-it-works-merchants { padding: 1.5rem; } .chart-bars { height: 80px; } .bar-1 { height: 48px; } .bar-2 { height: 68px; } .bar-3 { height: 36px; } .bar-4 { height: 78px; } .bar-5 { height: 56px; } .bar-6 { height: 44px; } .impact-number { font-size: 2.6rem; } .how-text h3 { font-size: 1.5rem; } .nav-links { gap: 1rem; } .btn-login, .btn-register { padding: 0.4rem 1.2rem; } }
    /* تأثيرات الحركة */
    .impact-card { animation: fadeUp 0.6s ease backwards; }
    .impact-card:nth-child(1) { animation-delay: 0.05s; }
    .impact-card:nth-child(2) { animation-delay: 0.1s; }
    .impact-card:nth-child(3) { animation-delay: 0.15s; }
    .impact-card:nth-child(4) { animation-delay: 0.2s; }
    .impact-card:nth-child(5) { animation-delay: 0.25s; }
    .impact-card:nth-child(6) { animation-delay: 0.3s; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
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
      <a href="{{ route('public.business') }}" class="active">للأعمال</a>
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

  <div class="main-wrapper">
    <!-- Hero Section -->
    <div class="merchant-hero">
      <div class="hero-split">
        <div class="hero-content">
          <div class="badge"><i class="fas fa-rocket"></i><span>حلول دفع مبتكرة للشركات</span></div>
          <h1>نمّي مبيعاتك مع<br><span class="highlight">كِسرة</span></h1>
          <p>قدّم لعملائك تجربة دفع مرنة بالتقسيط أو الدفع الآجل، وزد تحويلات متجرك بكل ثقة وسهولة.</p>
          <div class="cta-group">
            <button class="btn-cta" onclick="window.location.href='{{ route('register') }}'">ابدأ الآن <i class="fas fa-arrow-left"></i></button>
            <button class="btn-outline" onclick="alert('📞 تواصل مع فريق المبيعات: sales@kasra.com')"><i class="fas fa-headset"></i> تواصل مع المبيعات</button>
          </div>
        </div>
        <div class="hero-image">
          <div class="image-wrapper">
            <div class="dashboard-mockup">
              <div class="mockup-header">
                <div class="mockup-logo"><div class="mockup-logo-icon"><i class="fas fa-bolt"></i></div><span>كِسرة للأعمال</span></div>
                <div class="mockup-badge"><i class="fas fa-chart-simple"></i> +٢٣٪ نمو</div>
              </div>
              <div class="stats-grid">
                <div class="stat-card"><div class="stat-number">+47%</div><div class="stat-label">متوسط زيادة المبيعات</div></div>
                <div class="stat-card"><div class="stat-number">+32%</div><div class="stat-label">عملاء جدد شهرياً</div></div>
              </div>
              <div class="chart-mockup">
                <div class="chart-title"><i class="fas fa-chart-line"></i> أداء المبيعات بعد تفعيل كِسرة</div>
                <div class="chart-bars">
                  <div class="bar bar-1"></div><div class="bar bar-2"></div><div class="bar bar-3"></div>
                  <div class="bar bar-4"></div><div class="bar bar-5"></div><div class="bar bar-6"></div>
                </div>
              </div>
              <div class="payment-icons">
                <i class="fab fa-apple-pay"></i><i class="fab fa-google-pay"></i><i class="fas fa-credit-card"></i><i class="fas fa-mobile-alt"></i><i class="fas fa-wallet"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Benefits Section -->
    <div class="benefits-section">
      <div class="section-header">
        <h2>كِسرة منصة مدفوعات ذكية<br>مبنية على <span class="highlight">البساطة والثقة</span> لدعم نمو أعمالك</h2>
        <div class="section-sub">حلول دفع مرنة لتجار التجزئة والمتاجر الإلكترونية</div>
      </div>
      <div class="benefits-grid">
        <div class="benefit-card"><div class="card-icon"><i class="fas fa-chart-line"></i></div><h3>زيادة المبيعات</h3><p>ساعد عملاءك على الشراء بسهولة من خلال خيارات دفع مرنة تزيد معدلات التحويل حتى 40%</p><div class="accent-line"></div></div>
        <div class="benefit-card"><div class="card-icon"><i class="fas fa-bag-shopping"></i></div><h3>تجربة دفع سلسة</h3><p>تجربة شراء فورية بدون تعقيد، مع دعم طرق دفع متعددة تناسب جميع العملاء</p><div class="accent-line"></div></div>
        <div class="benefit-card"><div class="card-icon"><i class="fas fa-plug"></i></div><h3>تكامل فوري</h3><p>اربط كِسرة بمتجرك (أونلاين أو أرضي) خلال دقائق وابدأ في استقبال المدفوعات</p><div class="accent-line"></div></div>
        <div class="benefit-card"><div class="card-icon"><i class="fas fa-coins"></i></div><h3>استلام المبلغ فوراً</h3><p>تحصيل كامل المبلغ لحسابك بينما يدفع العميل على دفعات مرنة بدون مخاطر</p><div class="accent-line"></div></div>
      </div>
      <div class="trust-footer">
        <div class="trust-badge"><span><i class="fas fa-shield-alt"></i> تقنية آمنة ومعتمدة</span><span><i class="fas fa-tachometer-alt"></i> دعم فني 24/7</span></div>
        <div class="copyright">© 2026 كِسرة | حلول دفع متطورة للتجار</div>
      </div>
    </div>

    <!-- How Kasra Works for Merchants -->
    <div class="how-it-works-merchants">
      <div class="how-title"><h2>نموك يبدأ من هنا</h2><p>اكتشف كيف تساعدك كِسرة على تقديم تجربة دفع أفضل وزيادة مبيعاتك</p></div>
      <div class="how-block" id="block1">
        <div class="how-image"><div class="abstract-shape"></div><div class="mockup-simple"><img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 500'%3E%3Crect width='400' height='500' fill='%231E293B' rx='24'/%3E%3Crect x='20' y='30' width='360' height='60' fill='%23334155' rx='12'/%3E%3Crect x='20' y='110' width='360' height='40' fill='%23334155' rx='8'/%3E%3Crect x='20' y='170' width='160' height='40' fill='%234B5568' rx='8'/%3E%3Crect x='200' y='170' width='180' height='40' fill='%234B5568' rx='8'/%3E%3Crect x='20' y='240' width='360' height='80' fill='%23334155' rx='12'/%3E%3Crect x='20' y='340' width='360' height='80' fill='%23334155' rx='12'/%3E%3Ccircle cx='340' cy='440' r='30' fill='%23FF4F8B'/%3E%3C/svg%3E" alt="Mobile UI mockup"></div></div>
        <div class="how-text"><h3>خيارات دفع مرنة تناسب كل عميل</h3><p>قدّم لعملائك خيارات تقسيط سهلة ومرنة تساعدهم على الشراء بثقة</p></div>
      </div>
      <div class="how-block reverse" id="block2">
        <div class="how-image"><div class="abstract-shape"></div><div class="mockup-simple"><img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 500'%3E%3Crect width='400' height='500' fill='%231E293B' rx='24'/%3E%3Crect x='20' y='30' width='360' height='60' fill='%23334155' rx='12'/%3E%3Ccircle cx='340' cy='60' r='20' fill='%23FF4F8B'/%3E%3Crect x='20' y='120' width='360' height='100' fill='%23334155' rx='16'/%3E%3Crect x='20' y='240' width='360' height='100' fill='%23334155' rx='16'/%3E%3Crect x='20' y='360' width='360' height='60' fill='%23FF4F8B' rx='30'/%3E%3C/svg%3E" alt="Campaign dashboard"></div></div>
        <div class="how-text"><h3>حملات تسويقية مدعومة من كِسرة</h3><p>استفد من أدوات التسويق لزيادة ظهور متجرك وجذب عملاء جدد</p></div>
      </div>
      <div class="how-block centered" id="block3">
        <div class="how-image" style="max-width: 400px; margin: 0 auto;"><div class="abstract-shape"></div><div class="mockup-simple"><img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 300'%3E%3Crect width='500' height='300' fill='%231E293B' rx='24'/%3E%3Crect x='20' y='20' width='460' height='50' fill='%23334155' rx='12'/%3E%3Crect x='20' y='90' width='220' height='180' fill='%23334155' rx='16'/%3E%3Crect x='260' y='90' width='220' height='180' fill='%23334155' rx='16'/%3E%3Crect x='20' y='250' width='460' height='30' fill='%234B5568' rx='8'/%3E%3C/svg%3E" alt="Dashboard analytics"></div></div>
        <div class="how-text"><h3>إدارة متجرك في مكان واحد</h3><p>تابع أداء متجرك ومبيعاتك بسهولة من خلال لوحة تحكم متكاملة</p></div>
      </div>
      <div class="deco-star deco-1"><i class="fas fa-star"></i></div>
      <div class="deco-star deco-2"><i class="fas fa-star"></i></div>
    </div>

    <!-- Impact Stats Section -->
    <div class="impact-stats">
      <div class="impact-header"><h2>أثر كِسرة في نمو تجارتك</h2><p>مدفوعات أسهل، تحويلات أعلى، ونمو أسرع لأعمالك</p></div>
      <div class="stats-impact-grid">
        <div class="impact-card" data-target="15" data-suffix="%" data-prefix="+"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">%</span></div><div class="impact-desc">زيادة في معدل إتمام الطلبات</div><div class="mini-trend"><svg width="60" height="20" viewBox="0 0 60 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 15 L12 8 L22 12 L32 5 L42 9 L52 3 L58 6" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg></div></div>
        <div class="impact-card" data-target="12" data-suffix="%" data-prefix="+"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">%</span></div><div class="impact-desc">زيادة في معدل التحويل</div></div>
        <div class="impact-card" data-target="50" data-suffix="%" data-prefix="+"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">%</span></div><div class="impact-desc">زيادة في متوسط قيمة الطلب</div></div>
        <div class="impact-card" data-target="-50" data-suffix="%"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">%</span></div><div class="impact-desc">انخفاض في التخلي عن سلة الشراء</div></div>
        <div class="impact-card" data-target="10" data-suffix="x"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">x</span></div><div class="impact-desc">زيادة في تفاعل العملاء</div></div>
        <div class="impact-card" data-target="25" data-suffix="%" data-prefix="+"><div class="impact-number"><span class="stat-value">0</span><span class="stat-suffix">%</span></div><div class="impact-desc">تحسين في ولاء العملاء</div></div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="logo" style="justify-content: flex-start;"><div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span></div>
        <p>قسّم مشترياتك بدون فوائد وبخطوات بسيطة — تجربة دفع مرنة وسريعة تناسب أسلوب حياتك.</p>
        <div class="trust-message"><i class="fas fa-check-circle"></i> موثوق من قبل أكثر من ١٠٠ ألف عميل</div>
      </div>
      <div class="footer-col"><h4>العملاء</h4><ul><li><a href="#">حسابي</a></li><li><a href="#">طلباتي</a></li><li><a href="#">كيف تعمل</a></li><li><a href="#">العروض</a></li></ul></div>
      <div class="footer-col"><h4>للتجار</h4><ul><li><a href="#">انضم كتاجر</a></li><li><a href="#">لوحة التحكم</a></li><li><a href="#">الشروط التجارية</a></li><li><a href="#">مركز المطورين</a></li></ul></div>
      <div class="footer-col"><h4>الدعم</h4><ul><li><a href="#">اتصل بنا</a></li><li><a href="#">الأسئلة الشائعة</a></li><li><a href="#">مركز المساعدة</a></li><li><a href="#">الأمان والخصوصية</a></li></ul></div>
      <div class="footer-col">
        <h4>قانوني</h4>
        <ul><li><a href="#">سياسة الخصوصية</a></li><li><a href="#">الشروط والأحكام</a></li><li><a href="#">الإفصاحات المالية</a></li></ul>
        <div class="newsletter"><p><i class="fas fa-envelope"></i> اشترك للحصول على العروض</p><div class="newsletter-form"><input type="email" placeholder="بريدك الإلكتروني"><button>اشترك</button></div></div>
      </div>
    </div>
    <div class="footer-bottom">
      <div>© {{ date('Y') }} كِسرة. جميع الحقوق محفوظة</div>
      <div class="social-icons"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a></div>
    </div>
  </footer>

  <script>
    (function() {
      // Impact stats counting animation
      const statCards = document.querySelectorAll('.impact-card');
      let observerStats = null;
      function animateNumber(element, start, end, duration, isNegative, isMultiplier) {
        let startTimestamp = null;
        const step = (timestamp) => {
          if (!startTimestamp) startTimestamp = timestamp;
          const progress = Math.min(1, (timestamp - startTimestamp) / duration);
          let current = Math.floor(progress * (end - start) + start);
          if (isMultiplier) { element.innerText = current; }
          else if (isNegative) { let val = start + (end - start) * progress; val = end < 0 ? Math.max(end, Math.floor(val)) : Math.min(end, Math.floor(val)); element.innerText = val; }
          else { element.innerText = current; }
          if (progress < 1) requestAnimationFrame(step);
          else element.innerText = end;
        };
        requestAnimationFrame(step);
      }
      function startCounting(card) {
        const numberSpan = card.querySelector('.stat-value');
        if (!numberSpan || numberSpan.getAttribute('data-counted') === 'true') return;
        numberSpan.setAttribute('data-counted', 'true');
        const targetRaw = card.getAttribute('data-target');
        let targetVal = parseFloat(targetRaw);
        const suffix = card.getAttribute('data-suffix');
        const isMultiplier = suffix === 'x';
        const isNegative = targetVal < 0;
        const finalNumber = Math.abs(targetVal);
        if (isNegative) animateNumber(numberSpan, 0, -finalNumber, 1500, true, false);
        else if (isMultiplier) animateNumber(numberSpan, 0, finalNumber, 1500, false, true);
        else animateNumber(numberSpan, 0, finalNumber, 1500, false, false);
      }
      function initStatsObserver() {
        observerStats = new IntersectionObserver((entries) => {
          entries.forEach(entry => { if (entry.isIntersecting) startCounting(entry.target); });
        }, { threshold: 0.3 });
        statCards.forEach(card => observerStats.observe(card));
      }
      if (statCards.length) {
        initStatsObserver();
        window.addEventListener('load', () => {
          statCards.forEach(card => {
            const rect = card.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) startCounting(card);
          });
        });
      }
      // Scroll animations for How It Works blocks
      const blocks = document.querySelectorAll('.how-block');
      const observerBlocks = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
      }, { threshold: 0.3 });
      blocks.forEach(block => observerBlocks.observe(block));
      window.addEventListener('load', () => {
        blocks.forEach(block => {
          const rect = block.getBoundingClientRect();
          if (rect.top < window.innerHeight - 100) block.classList.add('visible');
        });
      });
    })();
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