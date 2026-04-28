<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · لوحة تحكم العميل</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
            height: calc(100% - 80px);
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

        .welcome-banner {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .welcome-text h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .welcome-text p {
            color: #EDE9FE;
        }

        .welcome-stats {
            display: flex;
            gap: 2rem;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 800;
            color: #FFB3C7;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #CBD5E6;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(233, 179, 251, 0.2);
            transition: all 0.2s;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-3px);
            border-color: #FFB3C7;
        }

        .action-card i {
            font-size: 1.8rem;
            color: #FFB3C7;
            margin-bottom: 0.5rem;
        }

        .action-card h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
        }

        .stores-section {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
        }

        .stores-section h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stores-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .store-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .store-card:hover {
            transform: translateY(-3px);
            border-color: #FFB3C7;
            background: rgba(255, 255, 255, 0.08);
        }

        .store-image {
            height: 100px;
            background-size: cover;
            background-position: center;
        }

        .store-info {
            padding: 0.8rem;
            text-align: center;
        }

        .store-info h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
        }

        .store-info p {
            font-size: 0.7rem;
            color: #CBD5E6;
        }

        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
        }

        .info-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-item,
        .installment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(233, 179, 251, 0.15);
        }

        .order-item:last-child,
        .installment-item:last-child {
            border-bottom: none;
        }

        .order-info h4,
        .installment-info h4 {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
        }

        .order-info p,
        .installment-info p {
            font-size: 0.7rem;
            color: #CBD5E6;
        }

        .status-badge {
            background: rgba(46, 125, 50, 0.2);
            color: #A5D6A7;
            padding: 0.2rem 0.6rem;
            border-radius: 40px;
            font-size: 0.7rem;
        }

        .status-pending {
            background: rgba(237, 108, 2, 0.2);
            color: #FFB74D;
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

        @media (max-width: 1024px) {
            .stores-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .two-columns {
                grid-template-columns: 1fr;
            }
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

            .btn-pink {
                background: linear-gradient(105deg, #FF4F8B, #E6497D);
                border: none;
                color: white;
                padding: 0.5rem 1.2rem;
                border-radius: 60px;
                transition: 0.2s;
            }

            .btn-pink:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 79, 139, 0.4);
                color: white;
            }

            .border-purple {
                border: 1px solid rgba(233, 179, 251, 0.3);
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

            .stores-grid {
                grid-template-columns: 1fr;
            }

            .welcome-banner {
                flex-direction: column;
                text-align: center;
            }

            .welcome-stats {
                justify-content: center;
            }
        }
        /* بطاقة دعوة التاجر - محسنة */
        .seller-promo-card {
            background: linear-gradient(135deg, #1e2a3a, #16222e);
            border-radius: 28px;
            border: 1px solid rgba(233, 179, 251, 0.4);
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .seller-promo-card:hover {
            border-color: #FF4F8B;
            transform: translateY(-2px);
        }
        .promo-text h3 {
            font-size: 1.3rem;
            margin-bottom: 0.3rem;
            color: white;
        }
        .promo-text p {
            color: #CBD5E1;
            font-size: 0.9rem;
        }
        .btn-gradient {
            background: linear-gradient(105deg, #FF4F8B, #E6497D);
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 60px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s;
        }
        .btn-gradient:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(255,79,139,0.4);
            color: white;
        }

        /* تحسين بطاقات الطلبات والأقساط */
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(233, 179, 251, 0.1);
        }
        .list-item:last-child { border-bottom: none; }
        .item-title {
            font-weight: 600;
            color: white;
        }
        .item-sub {
            font-size: 0.75rem;
            color: #94A3B8;
        }
        .item-amount {
            font-weight: 700;
            color: #FFB3C7;
        }
        .badge {
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            font-size: 0.7rem;
            background: rgba(255,79,139,0.15);
            color: #FFB3C7;
        }
        .badge-warning {
            background: rgba(245,158,11,0.15);
            color: #FBBF24;
        }

        @media (max-width: 768px) {
            .sidebar { position: fixed; right: -280px; z-index: 99; background: rgba(31,41,55,0.95); }
            .sidebar.open { right: 0; }
            .menu-toggle { display: block; }
            .main-content { padding: 1rem; }
            .seller-promo-card { flex-direction: column; text-align: center; }
        }
        /* إضافة باقي الأنماط الأساسية من الكود الأصلي (ضرورية) */
        /* ... هنا يجب أن تكون جميع الأنماط القديمة (مثل top-bar, welcome-banner, quick-actions, stores-section,two-columns...)
           لكن لتجنب التكرار، سأدرجها مختصرة ثم أكملها في الخلفية */
    </style>
    @stack('styles')
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
                <a href="{{ route('customer.dashboard') }}" class="nav-item active"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="{{ route('customer.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
                <a href="{{ route('customer.orders.index') }}" class="nav-item"><i class="fas fa-shopping-bag"></i> طلباتي</a>
                <a href="{{ route('customer.installments.index') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> أقساطي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <!-- welcome banner -->
            <div class="welcome-banner">
                <div class="welcome-text">
                    <h2>مرحبًا، {{ $user->name }} 👋</h2>
                    <p>استمر في التسوق واستمتع بالدفع بالتقسيط</p>
                </div>
                <div class="welcome-stats">
                    <div class="stat"><div class="stat-number">{{ number_format($totalSpent,2) }} د.أ</div><div class="stat-label">إجمالي المشتريات</div></div>
                    <div class="stat"><div class="stat-number">{{ $activeInstallments }}</div><div class="stat-label">أقساط نشطة</div></div>
                </div>
            </div>

            <!-- quick actions -->
            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='{{ route('client.products.index') }}'"><i class="fas fa-store"></i><h4>استكشف المتاجر</h4></div>
                <div class="action-card" onclick="window.location.href='{{ route('customer.orders.index') }}'"><i class="fas fa-shopping-bag"></i><h4>طلباتي</h4></div>
                <div class="action-card" onclick="window.location.href='{{ route('customer.installments.index') }}'"><i class="fas fa-calendar-alt"></i><h4>أقساطي</h4></div>
                <div class="action-card" onclick="window.location.href='{{ route('customer.profile.edit') }}'"><i class="fas fa-user"></i><h4>تعديل الملف الشخصي</h4></div>
            </div>

            <!-- المتاجر المفضلة -->
            <div class="stores-section">
                <h3><i class="fas fa-store"></i> تسوّق من متاجرك المفضلة</h3>
                <div class="stores-grid">
                    @forelse($stores as $store)
                    <div class="store-card" onclick="window.location.href='{{ route('client.stores.show', $store) }}'">
                        <div class="store-image" style="background-image: url('{{ $store->logo ? asset('storage/'.$store->logo) : 'https://via.placeholder.com/400x300?text=Store' }}');"></div>
                        <div class="store-info"><h4>{{ $store->name }}</h4><p>{{ $store->user->name ?? '' }}</p></div>
                    </div>
                    @empty
                    <p>لا توجد متاجر بعد</p>
                    @endforelse
                </div>
            </div>

            <!-- قسم دعوة التاجر (محسن) -->
            @if(auth()->user()->role === 'customer')
            <div class="seller-promo-card">
                <div class="promo-text">
                    <h3><i class="fas fa-store"></i> هل تريد بيع منتجاتك؟</h3>
                    <p>انضم إلى منصة "كِسرة" كتاجر واستفد من نظام التقسيط والدفع المرن.</p>
                </div>
                <a href="{{ route('store.create') }}" class="btn-gradient"><i class="fas fa-paper-plane"></i> أنشئ متجرك الآن</a>
            </div>
            @endif

            <!-- الطلبات والأقساط -->
            <div class="two-columns">
                <div class="info-card">
                    <h3><i class="fas fa-receipt"></i> آخر الطلبات</h3>
                    @forelse($recentOrders as $order)
                    <div class="list-item">
                        <div><div class="item-title">{{ $order->order_number }}</div><div class="item-sub">{{ $order->created_at->format('Y-m-d') }}</div></div>
                        <div><span class="item-amount">{{ number_format($order->total_amount,2) }} د.أ</span> <span class="badge">{{ $order->status == 'completed' ? 'مكتمل' : 'قيد المعالجة' }}</span></div>
                    </div>
                    @empty
                    <p>لا توجد طلبات حديثة</p>
                    @endforelse
                </div>
                <div class="info-card">
                    <h3><i class="fas fa-calendar-check"></i> الأقساط القادمة</h3>
                    @forelse($upcomingInstallments as $inst)
                    <div class="list-item">
                        <div><div class="item-title">{{ $inst->order_number }}</div><div class="item-sub">{{ \Carbon\Carbon::parse($inst->due_date)->format('Y-m-d') }}</div></div>
                        <div><span class="item-amount">{{ number_format($inst->amount,2) }} د.أ</span> <span class="badge badge-warning">معلق</span></div>
                    </div>
                    @empty
                    <p>لا توجد أقساط قادمة</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <script>
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