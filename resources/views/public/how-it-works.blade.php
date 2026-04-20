<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>كِسرة · تسوّق الآن وادفع لاحقاً | حلول دفع مرنة</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* كل الـ CSS من الملف الأصلي - تم نسخه بالكامل */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { background-color: #1F2937; font-family: 'Cairo', 'Tahoma', sans-serif; line-height: 1.5; color: white; overflow-x: hidden; }
    .container { max-width: 1280px; margin: 0 auto; padding: 0 2rem; }
    section { padding: 5rem 0; }
    .glass-card { background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(12px); border-radius: 48px; border: 1px solid rgba(233, 179, 251, 0.25); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); position: relative; overflow: hidden; }
    .glass-card::before, .glass-card::after { content: ''; position: absolute; width: 500px; height: 500px; border-radius: 50%; filter: blur(60px); pointer-events: none; }
    .glass-card::before { top: -20%; right: -10%; background: radial-gradient(circle, rgba(255,79,139,0.15) 0%, rgba(233,179,251,0.05) 70%); }
    .glass-card::after { bottom: -15%; left: -5%; background: radial-gradient(circle, rgba(233,179,251,0.1) 0%, rgba(255,79,139,0.03) 70%); }
    .btn-primary { background: #FF4F8B; border: none; padding: 0.9rem 1.8rem; border-radius: 60px; font-weight: 700; font-size: 1rem; color: white; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 0.6rem; font-family: inherit; box-shadow: 0 8px 20px rgba(255,79,139,0.3); }
    .btn-primary:hover { background: #ff3373; transform: scale(1.02); box-shadow: 0 12px 24px rgba(255,79,139,0.4); }
    .btn-outline { background: transparent; border: 1px solid rgba(233,179,251,0.6); padding: 0.9rem 1.8rem; border-radius: 60px; font-weight: 700; font-size: 1rem; color: #FFB3C7; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.6rem; font-family: inherit; }
    .btn-outline:hover { border-color: #FF4F8B; background: rgba(255,79,139,0.1); color: white; }
    .btn-card { background: transparent; border: 1px solid #FFB3C7; padding: 0.7rem 1.5rem; border-radius: 60px; font-weight: 700; font-size: 0.9rem; color: #FFB3C7; transition: all 0.2s; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; font-family: inherit; }
    .btn-card:hover { background: #FF4F8B; color: white; border-color: #FF4F8B; transform: scale(1.02); }
    .hero { text-align: center; padding: 4rem 0 3rem; }
    .hero h1 { font-size: clamp(2.2rem, 5vw, 3.5rem); font-weight: 800; color: white; margin-bottom: 1rem; line-height: 1.2; }
    .hero .highlight { background: linear-gradient(120deg, #FF4F8B, #E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; }
    .hero p { font-size: 1.2rem; color: #EDE9FE; max-width: 600px; margin: 0 auto 2rem; }
    .hero-buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .steps { margin: 2rem 0; padding: 3rem 2rem; }
    .section-title { text-align: center; font-size: 2rem; font-weight: 800; margin-bottom: 2.5rem; color: white; }
    .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
    .step-card { text-align: center; }
    .step-icon { width: 80px; height: 80px; background: linear-gradient(135deg, rgba(255,79,139,0.1), rgba(233,179,251,0.15)); border-radius: 28px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .step-icon i { font-size: 2rem; color: #FFB3C7; }
    .step-card h3 { font-size: 1.2rem; font-weight: 800; margin-bottom: 0.5rem; color: white; }
    .step-card p { color: #CBD5E6; }
    .benefits { margin: 2rem 0; padding: 3rem 2rem; }
    .benefits-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; text-align: center; }
    .benefit-card { padding: 1rem; }
    .benefit-icon { width: 70px; height: 70px; background: rgba(255,79,139,0.1); border-radius: 28px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
    .benefit-icon i { font-size: 2rem; color: #FFB3C7; }
    .benefit-card h4 { font-size: 1.1rem; font-weight: 800; margin-bottom: 0.5rem; color: white; }
    .benefit-card p { font-size: 0.9rem; color: #CBD5E6; }
    .split-section { display: flex; flex-wrap: wrap; gap: 2rem; margin: 3rem 0; }
    .split-card { flex: 1; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 32px; padding: 2.5rem; transition: all 0.3s ease; border: 1px solid rgba(233,179,251,0.2); cursor: pointer; }
    .split-card:hover { transform: translateY(-6px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.3); border-color: #FFB3C7; background: rgba(31,41,55,0.6); }
    .split-icon { width: 70px; height: 70px; background: linear-gradient(135deg, rgba(255,79,139,0.1), rgba(233,179,251,0.15)); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; }
    .split-icon i { font-size: 2rem; color: #FFB3C7; }
    .split-card h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 0.75rem; color: white; }
    .split-card p { color: #EDE9FE; margin-bottom: 1.5rem; }
    .final-cta { text-align: center; margin: 2rem 0 4rem; padding: 3rem 2rem; }
    .final-cta h2 { font-size: 2rem; font-weight: 800; margin-bottom: 1rem; color: white; }
    .final-cta .btn-primary { font-size: 1.1rem; padding: 1rem 2rem; }
    /* Navbar */
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
    .footer-grid { display: grid; grid-template-columns: 1.2fr repeat(4, 1fr); gap: 2rem; margin-bottom: 2.5rem; }
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
    @media (max-width: 1024px) { .footer-grid { grid-template-columns: repeat(2,1fr); gap: 2rem; } .footer-brand { grid-column: span 2; } }
    @media (max-width: 768px) { .container { padding: 0 1rem; } section { padding: 3rem 0; } .split-card h2 { font-size: 1.5rem; } .steps, .benefits, .final-cta { padding: 2rem 1rem; } .footer-grid { grid-template-columns: 1fr; gap: 1.5rem; } .footer-brand { grid-column: span 1; } .footer-bottom { flex-direction: column; text-align: center; } .navbar { flex-direction: column; text-align: center; padding: 1rem; } .nav-links { justify-content: center; } }
    @media (max-width: 640px) { .nav-links { gap: 1rem; } .btn-login, .btn-register { padding: 0.4rem 1.2rem; } .hero h1 { font-size: 1.8rem; } }
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
      <a href="{{ route('public.how-it-works') }}" class="active">كيف تعمل</a>
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

  <div class="container">
    <section class="hero">
      <h1>ادفع الآن بالطريقة التي تناسبك مع <span class="highlight">كِسرة</span></h1>
      <p>تسوّق الآن وادفع لاحقًا بسهولة وبدون تعقيد</p>
      <div class="hero-buttons">
        <button class="btn-primary" onclick="window.location.href='{{ route('client.products.index') }}'">ابدأ التسوق <i class="fas fa-arrow-left"></i></button>
        <button class="btn-outline" onclick="window.location.href='{{ route('public.business') }}'">انضم كتاجر <i class="fas fa-arrow-left"></i></button>
      </div>
    </section>

    <div class="glass-card steps">
      <h2 class="section-title">كيف تعمل كِسرة؟</h2>
      <div class="steps-grid">
        <div class="step-card">
          <div class="step-icon"><i class="fas fa-shopping-cart"></i></div>
          <h3>اختر المنتج</h3>
          <p>تصفح المتاجر وأضف ما تريد إلى سلة التسوق</p>
        </div>
        <div class="step-card">
          <div class="step-icon"><i class="fas fa-credit-card"></i></div>
          <h3>اختر كِسرة عند الدفع</h3>
          <p>اختر "كِسرة" كوسيلة دفع عند إتمام الطلب</p>
        </div>
        <div class="step-card">
          <div class="step-icon"><i class="fas fa-calendar-alt"></i></div>
          <h3>ادفع على دفعات</h3>
          <p>قسّم المبلغ على دفعات شهرية بدون فوائد</p>
        </div>
      </div>
    </div>

    <div class="glass-card benefits">
      <h2 class="section-title">مميزات كِسرة</h2>
      <div class="benefits-grid">
        <div class="benefit-card">
          <div class="benefit-icon"><i class="fas fa-percent"></i></div>
          <h4>بدون فوائد</h4>
          <p>قسّم مشترياتك بدون أي رسوم إضافية</p>
        </div>
        <div class="benefit-card">
          <div class="benefit-icon"><i class="fas fa-hand-holding-usd"></i></div>
          <h4>دفع مرن</h4>
          <p>اختر الخطة التي تناسب ميزانيتك</p>
        </div>
        <div class="benefit-card">
          <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
          <h4>آمن وسهل</h4>
          <p>تكنولوجيا دفع متطورة تحمي بياناتك</p>
        </div>
      </div>
    </div>

    <div class="split-section">
      <div class="split-card" onclick="window.location.href='{{ route('client.products.index') }}'">
        <div class="split-icon"><i class="fas fa-user"></i></div>
        <h2>تسوق الآن وادفع لاحقًا</h2>
        <p>تحكم بمصاريفك وقسّط مشترياتك بسهولة</p>
        <button class="btn-card" onclick="event.stopPropagation();window.location.href='{{ route('public.user') }}'">اكتشف تجربة المستخدم <i class="fas fa-arrow-left"></i></button>
      </div>
      <div class="split-card" onclick="window.location.href='{{ route('public.business') }}'">
        <div class="split-icon"><i class="fas fa-store"></i></div>
        <h2>نمّي أعمالك مع كِسرة</h2>
        <p>زِد مبيعاتك ووفّر خيارات دفع لعملائك</p>
        <button class="btn-card" onclick="event.stopPropagation();window.location.href='{{ route('public.business') }}'">اكتشف حلول التجار <i class="fas fa-arrow-left"></i></button>
      </div>
    </div>

    <div class="glass-card final-cta">
      <h2>ابدأ الآن مع كِسرة</h2>
      <button class="btn-primary" onclick="window.location.href='{{ route('register') }}'">ابدأ الآن <i class="fas fa-arrow-left"></i></button>
    </div>
  </div>

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
      <div class="footer-col"><h4>العملاء</h4><ul><li><a href="#">حسابي</a></li><li><a href="#">طلباتي</a></li><li><a href="#">كيف تعمل</a></li><li><a href="#">العروض</a></li></ul></div>
      <div class="footer-col"><h4>للتجار</h4><ul><li><a href="#">انضم كتاجر</a></li><li><a href="#">لوحة التحكم</a></li><li><a href="#">الشروط التجارية</a></li><li><a href="#">مركز المطورين</a></li></ul></div>
      <div class="footer-col"><h4>الدعم</h4><ul><li><a href="#">اتصل بنا</a></li><li><a href="#">الأسئلة الشائعة</a></li><li><a href="#">مركز المساعدة</a></li><li><a href="#">الأمان والخصوصية</a></li></ul></div>
      <div class="footer-col">
        <h4>قانوني</h4>
        <ul><li><a href="#">سياسة الخصوصية</a></li><li><a href="#">الشروط والأحكام</a></li><li><a href="#">الإفصاحات المالية</a></li></ul>
        <div class="newsletter"><p><i class="fas fa-envelope"></i> اشترك للحصول على العروض</p><div class="newsletter-form"><input type="email" placeholder="بريدك الإلكتروني"><button>اشترك</button></div></div>
      </div>
    </div>
    <div class="footer-bottom"><div>© {{ date('Y') }} كِسرة. جميع الحقوق محفوظة</div><div class="social-icons"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a></div></div>
  </footer>

  <script>
    console.log('مرحباً بك في كِسرة — منصة الدفع المرنة');
  </script>
</body>
</html>