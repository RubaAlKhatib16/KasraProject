<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · الطلبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* نفس التصميم الزجاجي السابق (يمكنك نسخه من products/index.blade.php) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #1F2937; font-family: 'Cairo', sans-serif; color: #EDE9FE; overflow-x: hidden; }
        .dashboard { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: rgba(31,41,55,0.6); backdrop-filter: blur(16px); border-left: 1px solid rgba(233,179,251,0.25); padding: 2rem 1.5rem; position: sticky; top: 0; height: 100vh; overflow-y: auto; transition: right 0.3s ease; }
        .sidebar-logo { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2.5rem; }
        .logo-icon { background: linear-gradient(135deg, #FF4F8B, #E9B3FB); width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: white; }
        .logo-text { font-size: 1.5rem; font-weight: 800; background: linear-gradient(120deg, #FFF, #E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; }
        .sidebar-nav { display: flex; flex-direction: column; gap: 0.5rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: 20px; color: #EDE9FE; text-decoration: none; transition: 0.2s; font-weight: 500; }
        .nav-item i { width: 24px; font-size: 1.1rem; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: #FFB3C7; }
        .nav-item.active { background: linear-gradient(135deg, rgba(255,79,139,0.2), rgba(233,179,251,0.2)); color: #FFB3C7; border-right: 3px solid #FF4F8B; }
        .nav-item.logout { margin-top: auto; background: none; border: none; width: 100%; text-align: right; cursor: pointer; color: #FFB3C7; }
        .main-content { flex: 1; padding: 2rem; overflow-x: auto; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-title h1 { font-size: 2rem; font-weight: 800; background: linear-gradient(120deg, #FFF, #E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; }
        .user-menu { display: flex; align-items: center; gap: 1rem; background: rgba(255,255,255,0.05); backdrop-filter: blur(8px); padding: 0.5rem 1.2rem; border-radius: 60px; }
        .user-avatar { width: 40px; height: 40px; background: linear-gradient(135deg, #FF4F8B, #E9B3FB); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; }
        .orders-wrapper { background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 28px; padding: 1.5rem; border: 1px solid rgba(233,179,251,0.25); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 700px; }
        th, td { padding: 1rem 0.75rem; text-align: right; border-bottom: 1px solid rgba(233,179,251,0.15); }
        th { color: #FFB3C7; font-size: 0.85rem; background: rgba(0,0,0,0.2); }
        .status-badge { display: inline-block; padding: 0.25rem 0.8rem; border-radius: 40px; font-size: 0.75rem; font-weight: 600; }
        .status-pending { background: rgba(237,108,2,0.2); color: #FFB74D; }
        .status-processing { background: rgba(33,150,243,0.2); color: #90CAF9; }
        .status-completed { background: rgba(76,175,80,0.2); color: #A5D6A7; }
        .status-cancelled { background: rgba(244,67,54,0.2); color: #EF9A9A; }
        .btn-view { background: rgba(255,255,255,0.05); border: 1px solid rgba(233,179,251,0.3); padding: 0.3rem 0.8rem; border-radius: 40px; color: #FFB3C7; text-decoration: none; font-size: 0.75rem; }
        .btn-view:hover { background: rgba(255,179,199,0.2); }
        .menu-toggle { display: none; }
        @media (max-width: 768px) {
            .sidebar { position: fixed; right: -280px; top: 0; z-index: 99; background: rgba(31,41,55,0.95); transition: right 0.3s; }
            .sidebar.open { right: 0; }
            .menu-toggle { display: block; position: fixed; top: 1rem; left: 1rem; z-index: 100; background: rgba(31,41,55,0.8); padding: 0.5rem; border-radius: 12px; cursor: pointer; color: #FFB3C7; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>
<button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
<div class="dashboard">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo"><div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span></div>
        <nav class="sidebar-nav">
            <a href="{{ route('seller.dashboard') }}" class="nav-item"><i class="fas fa-chart-line"></i> لوحة التحكم</a>
            <a href="{{ route('seller.products.index') }}" class="nav-item"><i class="fas fa-box"></i> المنتجات</a>
            <a href="{{ route('seller.orders.index') }}" class="nav-item active"><i class="fas fa-shopping-cart"></i> الطلبات</a>
            <a href="{{ route('seller.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
        </nav>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title"><h1>الطلبات</h1><p>عرض وإدارة طلبات متجرك</p></div>
            <div class="user-menu"><div class="user-avatar">{{ substr(auth()->user()->first_name,0,1) }}</div><div>{{ auth()->user()->first_name }}</div><i class="fas fa-chevron-down"></i></div>
        </div>

        @if(session('success'))
            <script>Swal.fire({icon:'success',title:'تم',text:'{{ session('success') }}',background:'#1F2937',color:'#EDE9FE',confirmButtonColor:'#FF4F8B'});</script>
        @endif

        <div class="orders-wrapper">
            <div class="section-title"><i class="fas fa-truck"></i> قائمة الطلبات</div>
            <table>
                <thead><tr><th>رقم الطلب</th><th>العميل</th><th>المبلغ</th><th>الحالة</th><th>تاريخ الطلب</th><th></th></tr></thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->total_amount,2) }} د.أ</td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                @switch($order->status)
                                    @case('pending') قيد الانتظار @break
                                    @case('processing') قيد المعالجة @break
                                    @case('completed') مكتمل @break
                                    @case('cancelled') ملغي @break
                                @endswitch
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('seller.orders.show', $order) }}" class="btn-view"><i class="fas fa-eye"></i> تفاصيل</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center;">لا توجد طلبات حتى الآن</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top:1rem;">{{ $orders->links() }}</div>
        </div>
    </main>
</div>
<script>
    const toggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if(toggle) toggle.addEventListener('click',()=>sidebar.classList.toggle('open'));
</script>
</body>
</html>