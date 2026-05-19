<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>كِسرة · لوحة التحكم الفاخرة للتجار</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      background-color: #1F2937;
      font-family: 'Cairo', sans-serif;
      line-height: 1.5;
      color: #EDE9FE;
      overflow-x: hidden;
    }

    .glass-card {
      background: rgba(31, 41, 55, 0.45);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(233, 179, 251, 0.25);
      border-radius: 32px;
      transition: all 0.3s ease;
    }

    .dashboard { display: flex; min-height: 100vh; }

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

    .sidebar-logo { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2.5rem; }

    .logo-icon {
      background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
      width: 40px; height: 40px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem; color: white;
      box-shadow: 0 4px 12px rgba(255, 79, 139, 0.3);
    }

    .logo-text {
      font-size: 1.5rem; font-weight: 800;
      background: linear-gradient(120deg, #FFFFFF, #E9B3FB);
      background-clip: text; -webkit-background-clip: text; color: transparent;
    }

    .sidebar-nav { display: flex; flex-direction: column; gap: 0.5rem; }

    .nav-item {
      display: flex; align-items: center; gap: 0.75rem;
      padding: 0.75rem 1rem; border-radius: 20px;
      color: #EDE9FE; text-decoration: none;
      transition: all 0.2s; font-weight: 500;
    }

    .nav-item i { width: 24px; font-size: 1.1rem; transition: transform 0.2s; }
    .nav-item:hover { background: rgba(255, 255, 255, 0.08); color: #FFB3C7; }
    .nav-item:hover i { transform: translateX(-3px); }

    .nav-item.active {
      background: linear-gradient(135deg, rgba(255, 79, 139, 0.2), rgba(233, 179, 251, 0.2));
      color: #FFB3C7; border-right: 3px solid #FF4F8B;
    }

    .nav-item.logout {
      margin-top: auto; background: none; border: none;
      width: 100%; text-align: right; cursor: pointer; color: #FFB3C7;
    }

    .main-content { flex: 1; padding: 2rem; overflow-x: auto; }

    .top-bar {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }

    .page-title h1 {
      font-size: 2rem; font-weight: 800;
      background: linear-gradient(120deg, #FFFFFF, #E9B3FB);
      background-clip: text; -webkit-background-clip: text; color: transparent;
      margin-bottom: 0.25rem;
    }

    .page-title p { color: #EDE9FE; font-size: 0.9rem; }

    .top-bar-left { display: flex; align-items: center; gap: 1rem; }

    .user-menu {
      display: flex; align-items: center; gap: 1rem;
      background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px);
      padding: 0.5rem 1.2rem; border-radius: 60px;
      border: 1px solid rgba(233, 179, 251, 0.3); transition: all 0.2s;
    }

    .user-menu:hover { border-color: #FFB3C7; background: rgba(255, 255, 255, 0.08); }

    .user-avatar {
      width: 40px; height: 40px;
      background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
      border-radius: 50%; display: flex; align-items: center;
      justify-content: center; color: white; font-weight: 700;
    }

    .user-name { font-weight: 600; color: white; }

    /* ============================================================
       BELL ICON — زر الإشعارات في الـ top bar
       ============================================================ */
    .bell-btn {
      position: relative;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(233, 179, 251, 0.3);
      border-radius: 50%;
      width: 44px; height: 44px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      color: #FFB3C7;
      font-size: 1.1rem;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .bell-btn:hover {
      background: rgba(255, 79, 139, 0.15);
      border-color: #FF4F8B;
    }

    .bell-badge {
      position: absolute;
      top: -4px; left: -4px;
      background: #FF4F8B;
      color: white;
      font-size: 0.6rem;
      font-weight: 800;
      min-width: 18px; height: 18px;
      border-radius: 99px;
      display: flex; align-items: center; justify-content: center;
      padding: 0 4px;
      border: 2px solid #1F2937;
      display: none; /* مخفي حتى يجي إشعار */
    }

    .bell-btn.ringing {
      animation: bellRing 0.5s ease;
    }

    @keyframes bellRing {
      0%,100% { transform: rotate(0); }
      20%      { transform: rotate(-15deg); }
      40%      { transform: rotate(15deg); }
      60%      { transform: rotate(-10deg); }
      80%      { transform: rotate(10deg); }
    }

    /* ============================================================
       STOCK ALERTS DROPDOWN
       ============================================================ */
    .alerts-dropdown {
      position: absolute;
      top: calc(100% + 10px);
      left: 0;
      width: 340px;
      background: rgba(20, 25, 40, 0.97);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(233, 179, 251, 0.25);
      border-radius: 24px;
      overflow: hidden;
      z-index: 999;
      display: none;
      box-shadow: 0 20px 50px rgba(0,0,0,0.5);
      animation: dropIn 0.25s ease;
    }

    .alerts-dropdown.open { display: block; }

    @keyframes dropIn {
      from { opacity: 0; transform: translateY(-8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .alerts-header {
      padding: 1rem 1.2rem 0.8rem;
      border-bottom: 1px solid rgba(233,179,251,0.15);
      display: flex; align-items: center; gap: 0.5rem;
    }

    .alerts-header span {
      font-weight: 700; font-size: 0.9rem; color: #fff; flex: 1;
    }

    .alerts-header i { color: #FFB3C7; }

    .alerts-list {
      max-height: 320px;
      overflow-y: auto;
    }

    .alerts-list::-webkit-scrollbar { width: 4px; }
    .alerts-list::-webkit-scrollbar-track { background: transparent; }
    .alerts-list::-webkit-scrollbar-thumb { background: rgba(233,179,251,0.3); border-radius: 99px; }

    .alert-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.9rem 1.2rem;
      border-bottom: 1px solid rgba(233,179,251,0.08);
      transition: background 0.2s;
      text-decoration: none;
    }

    .alert-item:hover { background: rgba(255,79,139,0.08); }

    .alert-icon {
      width: 36px; height: 36px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.9rem; flex-shrink: 0;
    }

    .alert-icon.out    { background: rgba(239,68,68,0.15);  color: #FCA5A5; }
    .alert-icon.low    { background: rgba(251,191,36,0.15); color: #FCD34D; }

    .alert-text { flex: 1; min-width: 0; }

    .alert-name {
      font-size: 0.82rem; font-weight: 700; color: #fff;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .alert-sub {
      font-size: 0.72rem; margin-top: 2px;
    }

    .alert-sub.out { color: #FCA5A5; }
    .alert-sub.low { color: #FCD34D; }

    .alert-arrow { color: rgba(255,255,255,0.2); font-size: 0.75rem; }

    .alerts-empty {
      padding: 2rem 1.2rem;
      text-align: center;
      color: #475569;
      font-size: 0.85rem;
    }

    .alerts-empty i { font-size: 1.8rem; display: block; margin-bottom: 0.5rem; color: rgba(255,255,255,0.1); }

    /* ============================================================
       STOCK ALERT BANNER — بانر في أعلى الصفحة لما يكون في إشعارات
       ============================================================ */
    .stock-alert-banner {
      background: linear-gradient(135deg, rgba(239,68,68,0.12), rgba(251,191,36,0.08));
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 20px;
      padding: 1rem 1.4rem;
      margin-bottom: 1.5rem;
      display: none;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .stock-alert-banner.visible { display: flex; }

    .banner-icon {
      width: 40px; height: 40px; border-radius: 14px;
      background: rgba(239,68,68,0.2);
      display: flex; align-items: center; justify-content: center;
      color: #FCA5A5; font-size: 1rem; flex-shrink: 0;
    }

    .banner-text { flex: 1; }
    .banner-text strong { color: #FCA5A5; font-size: 0.9rem; display: block; }
    .banner-text span   { color: #94A3B8; font-size: 0.78rem; }

    .banner-close {
      background: none; border: none; color: #64748B;
      cursor: pointer; font-size: 1rem; padding: 0.2rem;
      transition: color 0.2s;
    }

    .banner-close:hover { color: #FCA5A5; }
    /* ============================================================ */

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem; margin-bottom: 2rem;
    }

    .stat-card {
      background: rgba(31, 41, 55, 0.5);
      backdrop-filter: blur(12px);
      border-radius: 28px; padding: 1.5rem;
      border: 1px solid rgba(233, 179, 251, 0.25);
      transition: all 0.3s; position: relative; overflow: hidden;
    }

    .stat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 3px; background: linear-gradient(90deg, #FF4F8B, #E9B3FB);
      opacity: 0; transition: opacity 0.3s;
    }

    .stat-card:hover { transform: translateY(-4px); border-color: #FFB3C7; box-shadow: 0 20px 30px -12px rgba(0,0,0,0.3); }
    .stat-card:hover::before { opacity: 1; }

    .stat-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }

    .stat-header i {
      font-size: 2rem;
      background: linear-gradient(135deg, #FFB3C7, #E9B3FB);
      background-clip: text; -webkit-background-clip: text; color: transparent;
    }

    .stat-value { font-size: 2.2rem; font-weight: 800; color: white; margin-bottom: 0.25rem; letter-spacing: -0.01em; }
    .stat-label { color: #EDE9FE; font-size: 0.85rem; }

    .chart-card {
      background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(12px);
      border-radius: 28px; padding: 1.5rem;
      border: 1px solid rgba(233, 179, 251, 0.25); margin-bottom: 2rem;
    }

    .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .chart-header h3 { font-size: 1.2rem; font-weight: 700; color: white; }
    canvas { max-height: 280px; width: 100%; }

    .orders-wrapper {
      background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(12px);
      border-radius: 28px; padding: 1.5rem;
      border: 1px solid rgba(233, 179, 251, 0.25);
      margin-bottom: 2rem; overflow-x: auto;
    }

    .section-title {
      font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem;
      display: flex; align-items: center; gap: 0.5rem; color: white;
    }

    .section-title i { color: #FFB3C7; }

    table { width: 100%; border-collapse: collapse; text-align: right; }
    th, td { padding: 1rem 0.5rem; border-bottom: 1px solid rgba(233, 179, 251, 0.2); }
    th { font-weight: 700; color: #FFB3C7; font-size: 0.85rem; }
    td { color: #EDE9FE; }

    .status-badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 40px; font-size: 0.75rem; font-weight: 600; }
    .status-completed  { background: rgba(46, 125, 50, 0.2);  color: #A5D6A7; }
    .status-pending    { background: rgba(237, 108, 2, 0.2);  color: #FFB74D; }
    .status-processing { background: rgba(33, 150, 243, 0.2); color: #90CAF9; }

    .products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-top: 1rem; }

    .product-card {
      background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(12px);
      border-radius: 24px; padding: 1rem;
      display: flex; align-items: center; gap: 1rem;
      border: 1px solid rgba(233, 179, 251, 0.25); transition: all 0.3s;
    }

    .product-card:hover { transform: translateY(-3px); border-color: #FF4F8B; box-shadow: 0 12px 20px rgba(0,0,0,0.2); }

    .product-img {
      width: 50px; height: 50px; background: rgba(255, 255, 255, 0.05);
      border-radius: 18px; display: flex; align-items: center;
      justify-content: center; font-size: 1.2rem; color: #FFB3C7;
    }

    .product-info h4 { font-size: 0.9rem; font-weight: 700; color: white; margin-bottom: 0.25rem; }
    .product-info p  { font-size: 0.75rem; color: #EDE9FE; }

    .quick-actions { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }

    .action-btn {
      background: rgba(255, 79, 139, 0.1);
      border: 1px solid rgba(255, 79, 139, 0.3);
      border-radius: 60px; padding: 0.6rem 1.2rem;
      color: #FFB3C7; font-weight: 600; cursor: pointer;
      transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem;
      text-decoration: none;
    }

    .action-btn:hover { background: rgba(255,79,139,0.2); border-color: #FF4F8B; transform: translateY(-2px); color: #FFB3C7; }

    .menu-toggle {
      display: none; position: fixed; top: 1rem; left: 1rem; z-index: 100;
      background: rgba(31,41,55,0.8); backdrop-filter: blur(8px);
      border: 1px solid rgba(233,179,251,0.3); padding: 0.5rem;
      border-radius: 12px; cursor: pointer; color: #FFB3C7; font-size: 1.2rem;
    }

    @media (max-width: 768px) {
      .sidebar { position: fixed; right: -280px; top: 0; z-index: 99; background: rgba(31,41,55,0.95); transition: right 0.3s; }
      .sidebar.open { right: 0; }
      .menu-toggle { display: block; }
      .main-content { padding: 1rem; }
      .stats-grid { grid-template-columns: 1fr; }
      .quick-actions { flex-direction: column; }
      .products-grid { grid-template-columns: 1fr; }
      .alerts-dropdown { width: 290px; left: auto; right: 0; }
    }

    @media (max-width: 1024px) and (min-width: 769px) {
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
  </style>
</head>

<body>
  <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
  <div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-logo">
        <div class="logo-icon"><i class="fas fa-bolt"></i></div>
        <span class="logo-text">كِسرة</span>
      </div>
      <nav class="sidebar-nav">
        <a href="{{ route('seller.dashboard') }}" class="nav-item active"><i class="fas fa-chart-line"></i> لوحة التحكم</a>
        <a href="{{ route('seller.products.index') }}" class="nav-item"><i class="fas fa-box"></i> المنتجات</a>
        <a href="{{ route('seller.orders.index') }}" class="nav-item"><i class="fas fa-shopping-cart"></i> الطلبات</a>
        <a href="{{ route('seller.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
          @csrf
          <button type="submit" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button>
        </form>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

      <!-- Top Bar -->
      <div class="top-bar">
        <div class="page-title">
          <h1>مرحبًا، {{ $user->first_name }}</h1>
          <p>مرحباً بك في متجر <strong>{{ $store->name }}</strong> – إليك ملخص الأداء</p>
        </div>

        <!-- Bell + User Menu -->
        <div class="top-bar-left">

          <!-- ===== زر الجرس ===== -->
          <div style="position: relative;">
            <button class="bell-btn" id="bellBtn" title="تنبيهات المخزون">
              <i class="fas fa-bell"></i>
              <span class="bell-badge" id="bellBadge">0</span>
            </button>

            <!-- Dropdown -->
            <div class="alerts-dropdown" id="alertsDropdown">
              <div class="alerts-header">
                <i class="fas fa-boxes"></i>
                <span>تنبيهات المخزون</span>
                <span id="alertsCount" style="color:#FF4F8B; font-size:0.75rem;"></span>
              </div>
              <div class="alerts-list" id="alertsList">
                <div class="alerts-empty">
                  <i class="fas fa-check-circle"></i>
                  جاري التحقق من المخزون...
                </div>
              </div>
            </div>
          </div>
          <!-- ==================== -->

          <div class="user-menu">
            @if($store->logo)
              <img src="{{ asset('storage/' . $store->logo) }}" width="40" height="40"
                style="border-radius: 50%; object-fit: cover;">
            @else
              <div class="user-avatar">{{ substr($user->first_name, 0, 1) }}</div>
            @endif
            <div class="user-name">{{ $user->first_name }}</div>
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
      </div>

      <!-- ===== STOCK ALERT BANNER ===== -->
      <div class="stock-alert-banner" id="stockBanner">
        <div class="banner-icon"><i class="fas fa-exclamation-triangle"></i></div>
        <div class="banner-text">
          <strong id="bannerTitle">تنبيه: منتجات تحتاج مراجعة المخزون</strong>
          <span id="bannerSub">يرجى مراجعة المنتجات التالية</span>
        </div>
        <button class="banner-close" id="bannerClose" title="إغلاق">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <!-- ================================ -->

      <!-- Quick Actions -->
      <div class="quick-actions">
        <a href="{{ route('seller.products.create') }}" class="action-btn"><i class="fas fa-plus"></i> إضافة منتج</a>
        <a href="{{ route('seller.orders.index') }}" class="action-btn"><i class="fas fa-eye"></i> مراجعة الطلبات</a>
        <button class="action-btn" onclick="alert('تقرير المبيعات قريباً')"><i class="fas fa-file-alt"></i> تقرير المبيعات</button>
      </div>

      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-header"><i class="fas fa-box"></i></div>
          <div class="stat-value">{{ $productsCount }}</div>
          <div class="stat-label">عدد المنتجات</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><i class="fas fa-shopping-cart"></i></div>
          <div class="stat-value">{{ $ordersCount }}</div>
          <div class="stat-label">عدد الطلبات</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><i class="fas fa-chart-line"></i></div>
          <div class="stat-value">{{ number_format($totalSales, 2) }} د.أ</div>
          <div class="stat-label">إجمالي المبيعات</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><i class="fas fa-clock"></i></div>
          <div class="stat-value">{{ $newOrdersCount }}</div>
          <div class="stat-label">الطلبات الجديدة</div>
        </div>
      </div>

      <!-- Chart -->
      <div class="chart-card">
        <div class="chart-header">
          <h3><i class="fas fa-chart-line"></i> اتجاه المبيعات (آخر ٧ أيام)</h3>
        </div>
        <canvas id="salesChart" width="400" height="200"></canvas>
      </div>

      <!-- Recent Orders -->
      <div class="orders-wrapper">
        <div class="section-title"><i class="fas fa-receipt"></i> <span>آخر الطلبات</span></div>
        <table>
          <thead>
            <tr>
              <th>رقم الطلب</th>
              <th>اسم العميل</th>
              <th>المبلغ</th>
              <th>الحالة</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentOrders as $order)
              <tr>
                <td>#{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ number_format($order->total_amount, 2) }} د.أ</td>
                <td>
                  <span class="status-badge
                    @if($order->status == 'completed') status-completed
                    @elseif($order->status == 'processing') status-processing
                    @else status-pending @endif">
                    {{ $order->status == 'completed' ? 'مكتمل' : ($order->status == 'processing' ? 'قيد المعالجة' : 'قيد الانتظار') }}
                  </span>
                </td>
              </tr>
            @empty
              <tr><td colspan="4">لا توجد طلبات حتى الآن</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Top Products -->
      <div class="section-title"><i class="fas fa-fire"></i> <span>المنتجات الأكثر مبيعًا</span></div>
      <div class="products-grid">
        @forelse($topProducts as $product)
          <div class="product-card">
            <div class="product-img">
              @if($product->featured_image)
                <img src="{{ asset('storage/' . $product->featured_image) }}" width="40" height="40"
                  style="border-radius: 12px; object-fit: cover;">
              @else
                <i class="fas fa-tag"></i>
              @endif
            </div>
            <div class="product-info">
              <h4>{{ $product->name }}</h4>
              <p>تم بيع {{ $product->sold_count ?? 0 }} مرة</p>
            </div>
          </div>
        @empty
          <div class="product-card">لا توجد منتجات مباعة بعد</div>
        @endforelse
      </div>

    </main>
  </div>

  <script>
    // ─── Mobile sidebar ───────────────────────────────────────
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    if (menuToggle) menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));

    // ─── Sales Chart ──────────────────────────────────────────
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($chartLabels),
        datasets: [{
          label: 'المبيعات (د.أ)',
          data: @json($chartData),
          borderColor: '#FF4F8B',
          backgroundColor: 'rgba(255, 79, 139, 0.1)',
          borderWidth: 3,
          pointBackgroundColor: '#FFB3C7',
          pointBorderColor: '#FF4F8B',
          pointRadius: 5,
          pointHoverRadius: 7,
          tension: 0.3,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: { labels: { color: '#EDE9FE', font: { family: 'Cairo' } } },
          tooltip: { backgroundColor: '#1F2937', titleColor: '#FFB3C7', bodyColor: '#EDE9FE' }
        },
        scales: {
          y: { grid: { color: 'rgba(233,179,251,0.1)' }, ticks: { color: '#EDE9FE' } },
          x: { grid: { display: false }, ticks: { color: '#EDE9FE' } }
        }
      }
    });

    // ─────────────────────────────────────────────────────────────
    //  STOCK ALERTS — Real-time polling كل 30 ثانية
    // ─────────────────────────────────────────────────────────────
    const bellBtn        = document.getElementById('bellBtn');
    const bellBadge      = document.getElementById('bellBadge');
    const alertsDropdown = document.getElementById('alertsDropdown');
    const alertsList     = document.getElementById('alertsList');
    const alertsCount    = document.getElementById('alertsCount');
    const stockBanner    = document.getElementById('stockBanner');
    const bannerTitle    = document.getElementById('bannerTitle');
    const bannerSub      = document.getElementById('bannerSub');
    const bannerClose    = document.getElementById('bannerClose');

    let prevCount        = 0;
    let bannerDismissed  = false;

    // ── فتح/إغلاق الـ dropdown ──
    bellBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      alertsDropdown.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
      if (!bellBtn.contains(e.target) && !alertsDropdown.contains(e.target)) {
        alertsDropdown.classList.remove('open');
      }
    });

    // ── إغلاق البانر ──
    bannerClose.addEventListener('click', () => {
      stockBanner.classList.remove('visible');
      bannerDismissed = true;
    });

    // ── جلب التنبيهات من الـ API ──
    async function fetchStockAlerts() {
      try {
        const res  = await fetch('{{ route("seller.stock.alerts") }}', {
          headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        const data = await res.json();
        renderAlerts(data.alerts, data.count);
      } catch (err) {
        console.error('Stock alerts error:', err);
      }
    }

    // ── رسم التنبيهات في الـ dropdown ──
    function renderAlerts(alerts, count) {
      // Badge
      if (count > 0) {
        bellBadge.textContent = count > 9 ? '9+' : count;
        bellBadge.style.display = 'flex';
        alertsCount.textContent  = `(${count})`;

        // اهتزاز الجرس لو في إشعارات جديدة
        if (count > prevCount) {
          bellBtn.classList.remove('ringing');
          void bellBtn.offsetWidth; // reflow
          bellBtn.classList.add('ringing');
          setTimeout(() => bellBtn.classList.remove('ringing'), 500);
        }

        // البانر
        if (!bannerDismissed) {
          const outCount = alerts.filter(a => a.is_out).length;
          const lowCount = alerts.filter(a => !a.is_out).length;
          let titleText  = '';
          if (outCount > 0 && lowCount > 0)      titleText = `${outCount} منتج نفد + ${lowCount} منتج مخزونه منخفض`;
          else if (outCount > 0)                  titleText = `${outCount} منتج نفد من المخزون`;
          else                                    titleText = `${lowCount} منتج مخزونه وصل للحد الأدنى`;

          bannerTitle.textContent = '⚠️ ' + titleText;
          bannerSub.textContent   = 'اضغط على الجرس لمراجعة التفاصيل';
          stockBanner.classList.add('visible');
        }
      } else {
        bellBadge.style.display = 'none';
        alertsCount.textContent  = '';
        stockBanner.classList.remove('visible');
      }

      prevCount = count;

      // قائمة الـ dropdown
      if (alerts.length === 0) {
        alertsList.innerHTML = `
          <div class="alerts-empty">
            <i class="fas fa-check-circle"></i>
            جميع المنتجات مخزونها كافٍ
          </div>`;
        return;
      }

      alertsList.innerHTML = alerts.map(a => `
        <a href="${a.edit_url}" class="alert-item" target="_blank">
          <div class="alert-icon ${a.is_out ? 'out' : 'low'}">
            <i class="fas ${a.is_out ? 'fa-times-circle' : 'fa-exclamation-triangle'}"></i>
          </div>
          <div class="alert-text">
            <div class="alert-name">${a.name}</div>
            <div class="alert-sub ${a.is_out ? 'out' : 'low'}">
              ${a.is_out
                ? 'نفد من المخزون (0 قطعة)'
                : `متبقي ${a.stock} قطعة — الحد: ${a.threshold}`}
            </div>
          </div>
          <i class="fas fa-external-link-alt alert-arrow"></i>
        </a>
      `).join('');
    }

    // ── تشغيل أول مرة فور تحميل الصفحة ──
    fetchStockAlerts();

    // ── polling كل 30 ثانية ──
    setInterval(fetchStockAlerts, 30_000);
  </script>
</body>

</html>