<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · مركز المساعدة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ===== نفس التصميم الزجاجي للمشروع ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #1F2937; font-family: 'Cairo', sans-serif; line-height: 1.5; min-height: 100vh; display: flex; flex-direction: column; align-items: center; padding: 2rem; overflow-x: hidden; }
        .main-wrapper { max-width: 1280px; width: 100%; margin: 0 auto; display: flex; flex-direction: column; gap: 3rem; }
        /* أنماط الـ navbar والـ footer كما في الملفات السابقة (تم نسخها من public.user) */
        .navbar { max-width: 1280px; width: 100%; margin: 0 auto 2rem auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; background: rgba(31,41,55,0.85); backdrop-filter: blur(12px); padding: 0.8rem 2rem; border-radius: 80px; border: 1px solid rgba(233,179,251,0.25); }
        .logo { display: flex; align-items: center; gap: 0.5rem; }
        .logo-icon { background: #FF4F8B; width: 40px; height: 40px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; }
        .logo-text { font-size: 1.6rem; font-weight: 800; color: white; }
        .nav-links { display: flex; gap: 2rem; flex-wrap: wrap; }
        .nav-links a { text-decoration: none; color: #EDE9FE; font-weight: 600; transition: 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: #FFB3C7; }
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
        .footer-col a { text-decoration: none; color: #CBD5E6; font-size: 0.9rem; transition: color 0.2s; }
        .footer-col a:hover { color: #FF4F8B; }
        .newsletter { margin-top: 1rem; }
        .newsletter p { color: #CBD5E6; font-size: 0.85rem; margin-bottom: 0.8rem; }
        .newsletter-form { display: flex; gap: 0.5rem; background: rgba(255,255,255,0.05); border-radius: 60px; padding: 0.2rem; border: 1px solid rgba(233,179,251,0.2); }
        .newsletter-form input { flex: 1; background: transparent; border: none; padding: 0.6rem 1rem; color: white; font-family: inherit; font-size: 0.85rem; outline: none; }
        .newsletter-form button { background: #FF4F8B; border: none; border-radius: 40px; padding: 0.6rem 1.2rem; color: white; font-weight: 600; cursor: pointer; }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid rgba(233,179,251,0.15); font-size: 0.8rem; color: #9CA3AF; }
        .social-icons { display: flex; gap: 1.2rem; }
        .social-icons a { color: #CBD5E6; font-size: 1.2rem; transition: 0.2s; }
        .social-icons a:hover { color: #FF4F8B; transform: translateY(-2px); }
        @media (max-width: 1024px) { .footer-grid { grid-template-columns: repeat(2,1fr); gap:2rem; } .footer-brand { grid-column: span 2; } }
        @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr; gap:1.5rem; } .footer-brand { grid-column: span 1; } .navbar { flex-direction: column; text-align: center; } .nav-links { justify-content: center; } body { padding: 1rem; } }

        /* ===== أنماط خاصة بصفحة المساعدة ===== */
        .help-hero {
            background: rgba(31,41,55,0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem;
            text-align: center;
            border: 1px solid rgba(233,179,251,0.25);
        }
        .help-hero h1 {
            font-size: clamp(2rem,5vw,3rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
        }
        .help-hero .highlight {
            background: linear-gradient(120deg, #FF4F8B, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
        .help-hero p {
            color: #EDE9FE;
            max-width: 600px;
            margin: 0 auto 2rem;
        }
        .search-box {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 60px;
            padding: 0.3rem;
            display: flex;
            border: 1px solid rgba(233,179,251,0.3);
        }
        .search-box input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            outline: none;
            font-family: inherit;
        }
        .search-box button {
            background: #FF4F8B;
            border: none;
            border-radius: 60px;
            padding: 0.8rem 1.5rem;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }
        .faq-section {
            background: rgba(31,41,55,0.5);
            backdrop-filter: blur(12px);
            border-radius: 48px;
            padding: 2.5rem;
            border: 1px solid rgba(233,179,251,0.25);
        }
        .faq-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            margin-bottom: 2rem;
        }
        .faq-item {
            background: rgba(255,255,255,0.03);
            border-radius: 28px;
            margin-bottom: 1rem;
            border: 1px solid rgba(233,179,251,0.2);
            transition: 0.2s;
        }
        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            cursor: pointer;
            font-weight: 700;
            color: white;
            font-size: 1rem;
        }
        .faq-question i {
            color: #FFB3C7;
            transition: transform 0.3s;
        }
        .faq-answer {
            padding: 0 1.5rem 1.2rem 1.5rem;
            color: #CBD5E6;
            line-height: 1.6;
            display: none;
            border-top: 1px solid rgba(233,179,251,0.15);
            margin-top: 0.5rem;
        }
        .faq-item.active .faq-answer {
            display: block;
        }
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        .contact-section {
            background: rgba(31,41,55,0.5);
            backdrop-filter: blur(12px);
            border-radius: 48px;
            padding: 2.5rem;
            text-align: center;
            border: 1px solid rgba(233,179,251,0.25);
        }
        .contact-icons {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }
        .contact-card {
            background: rgba(255,255,255,0.05);
            border-radius: 32px;
            padding: 1.5rem;
            min-width: 200px;
            text-align: center;
            transition: 0.3s;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.08);
        }
        .contact-card i {
            font-size: 2rem;
            color: #FFB3C7;
            margin-bottom: 0.8rem;
        }
        .contact-card h4 {
            color: white;
            margin-bottom: 0.5rem;
        }
        .contact-card p, .contact-card a {
            color: #CBD5E6;
            text-decoration: none;
        }
        .contact-card a:hover {
            color: #FFB3C7;
        }
        @media (max-width: 640px) {
            .faq-section, .contact-section, .help-hero { padding: 1.5rem; }
            .faq-question { padding: 1rem; font-size: 0.9rem; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
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
            <a href="{{ route('public.help') }}" class="active">المساعدة</a>
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
        <div class="help-hero">
            <h1>مركز <span class="highlight">المساعدة</span></h1>
            <p>إجابات على أسئلتك الشائعة، طرق التواصل، ودعم فوري على مدار الساعة</p>
            <div class="search-box">
                <input type="text" id="faqSearch" placeholder="ابحث في الأسئلة الشائعة...">
                <button onclick="searchFaq()"><i class="fas fa-search"></i> بحث</button>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <div class="faq-title">الأسئلة الشائعة</div>
            <div id="faqContainer">
                <div class="faq-item" data-question="كيف يمكنني التسجيل في كسرة">
                    <div class="faq-question">
                        <span>كيف يمكنني التسجيل في كسرة؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        يمكنك التسجيل بسهولة عبر الضغط على "حساب جديد" في أعلى الصفحة، ثم إدخال بياناتك (الاسم، البريد الإلكتروني، رقم الهاتف، وكلمة المرور). بعد التسجيل، يمكنك البدء في التسوق على الفور.
                    </div>
                </div>
                <div class="faq-item" data-question="ما هي طريقة الدفع بالتقسيط">
                    <div class="faq-question">
                        <span>ما هي طريقة الدفع بالتقسيط؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        عند إتمام الطلب، اختر "كِسرة" كوسيلة دفع. ستظهر لك خيارات التقسيط (مثل 3، 4، 6 دفعات بدون فوائد). اختر الخطة المناسبة، ثم أكمل الطلب. سيتم خصم قيمة الدفعة الأولى فوراً، والدفعات التالية في تواريخ محددة.
                    </div>
                </div>
                <div class="faq-item" data-question="هل هناك رسوم إضافية أو فوائد">
                    <div class="faq-question">
                        <span>هل هناك رسوم إضافية أو فوائد؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        لا، كِسرة تقدم خدمة التقسيط بدون أي فوائد أو رسوم خفية. ما تراه هو ما تدفعه، فقط قيمة المنتج مقسمة على عدد الدفعات.
                    </div>
                </div>
                <div class="faq-item" data-question="كيف يمكنني تتبع أقساطي">
                    <div class="faq-question">
                        <span>كيف يمكنني تتبع أقساطي؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        بعد تسجيل الدخول إلى حسابك، انتقل إلى "أقساطي" في لوحة التحكم. ستظهر لك قائمة بجميع الأقساط المستحقة والمدفوعة، مع تواريخ الاستحقاق.
                    </div>
                </div>
                <div class="faq-item" data-question="ماذا لو تأخرت عن سداد قسط">
                    <div class="faq-question">
                        <span>ماذا لو تأخرت عن سداد قسط؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        ننصحك بالالتزام بمواعيد السداد لتجنب أي إجراءات. في حالة التأخير، يرجى التواصل مع فريق الدعم لترتيب وضعك. قد يتم تطبيق رسوم تأخير رمزية حسب سياسة المتجر.
                    </div>
                </div>
                <div class="faq-item" data-question="كيف يمكنني التواصل مع الدعم الفني">
                    <div class="faq-question">
                        <span>كيف يمكنني التواصل مع الدعم الفني؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        يمكنك التواصل عبر البريد الإلكتروني support@kasra.com أو عبر الهاتف على الرقم 0791234567 (من الأحد إلى الخميس 9 صباحاً – 6 مساءً). كما يمكنك استخدام نموذج الاتصال في الأسفل.
                    </div>
                </div>
                <div class="faq-item" data-question="كيف أصبح تاجرًا في كسرة">
                    <div class="faq-question">
                        <span>كيف أصبح تاجرًا في كسرة؟</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        سجل حساباً جديداً ثم اختر "إنشاء متجر" من لوحة التحكم. املأ بيانات متجرك وانتظر موافقة فريق كسرة. بعد الموافقة، يمكنك البدء في إضافة منتجاتك وبيعها بالتقسيط.
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h2 style="font-size: 1.8rem; margin-bottom: 1rem;">تواصل معنا</h2>
            <p>فريق الدعم جاهز للإجابة عن استفساراتك على مدار الساعة</p>
            <div class="contact-icons">
                <div class="contact-card">
                    <i class="fas fa-envelope"></i>
                    <h4>البريد الإلكتروني</h4>
                    <p>support@kasra.com</p>
                </div>
                <div class="contact-card">
                    <i class="fas fa-phone-alt"></i>
                    <h4>رقم الهاتف</h4>
                    <p>+962 79 123 4567</p>
                </div>
                <div class="contact-card">
                    <i class="fab fa-whatsapp"></i>
                    <h4>واتساب</h4>
                    <p>+962 79 123 4567</p>
                </div>
                <div class="contact-card">
                    <i class="fas fa-clock"></i>
                    <h4>ساعات العمل</h4>
                    <p>الأحد – الخميس: 9 صباحاً – 6 مساءً</p>
                </div>
            </div>
            <p style="margin-top: 1rem;">أو استخدم نموذج الاتصال السريع:</p>
            <form id="contactForm" style="max-width: 500px; margin: 1.5rem auto 0; text-align: right;">
                <input type="text" name="name" placeholder="الاسم" required style="width:100%; margin-bottom: 1rem; padding: 0.8rem; border-radius: 60px; border: 1px solid rgba(233,179,251,0.3); background: rgba(0,0,0,0.5); color: white;">
                <input type="email" name="email" placeholder="البريد الإلكتروني" required style="width:100%; margin-bottom: 1rem; padding: 0.8rem; border-radius: 60px; border: 1px solid rgba(233,179,251,0.3); background: rgba(0,0,0,0.5); color: white;">
                <textarea name="message" rows="4" placeholder="رسالتك" required style="width:100%; margin-bottom: 1rem; padding: 0.8rem; border-radius: 24px; border: 1px solid rgba(233,179,251,0.3); background: rgba(0,0,0,0.5); color: white;"></textarea>
                <button type="submit" style="background: #FF4F8B; border: none; padding: 0.8rem 2rem; border-radius: 60px; color: white; font-weight: bold; cursor: pointer;">إرسال</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo" style="justify-content: flex-start;">
                    <div class="logo-icon"><i class="fas fa-bolt"></i></div>
                    <span class="logo-text">كِسرة</span>
                </div>
                <p>قسّم مشترياتك بدون فوائد وبخطوات بسيطة — تجربة دفع مرنة وسريعة.</p>
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
        // Toggle FAQ answers
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const parent = question.parentElement;
                parent.classList.toggle('active');
            });
        });

        // Search functionality
        function searchFaq() {
            const searchTerm = document.getElementById('faqSearch').value.trim().toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            let hasResults = false;
            faqItems.forEach(item => {
                const questionText = item.querySelector('.faq-question span').innerText.toLowerCase();
                if (searchTerm === '' || questionText.includes(searchTerm)) {
                    item.style.display = 'block';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });
            if (!hasResults && searchTerm !== '') {
                alert('لا توجد نتائج مطابقة للبحث. حاول بكلمات مختلفة.');
            }
        }

        // Contact form submission (demo)
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('تم إرسال رسالتك. سيقوم فريق الدعم بالرد عليك قريباً.');
            this.reset();
        });
    </script>
</body>
</html>