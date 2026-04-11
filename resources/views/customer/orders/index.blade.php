<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · طلباتي</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* كل الـ CSS الأصلي موجود هنا (نفس ما كان لديكِ) - اختصاراً سأكتب الجزء المعدل فقط، لكن استخدمي الـ CSS الموجود لديكِ */
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

        .search-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(233, 179, 251, 0.3);
            border-radius: 60px;
            padding: 0.7rem 1rem;
            color: white;
            font-family: inherit;
            outline: none;
        }

        .search-input:focus {
            border-color: #FF4F8B;
        }

        .filter-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(233, 179, 251, 0.3);
            border-radius: 60px;
            padding: 0.7rem 1rem;
            color: white;
            font-family: inherit;
            cursor: pointer;
        }

        .orders-wrapper {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            overflow-x: auto;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th,
        td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid rgba(233, 179, 251, 0.2);
        }

        th {
            font-weight: 700;
            color: #FFB3C7;
            font-size: 0.85rem;
        }

        td {
            color: #EDE9FE;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-completed {
            background: rgba(46, 125, 50, 0.2);
            color: #A5D6A7;
        }

        .status-pending {
            background: rgba(237, 108, 2, 0.2);
            color: #FFB74D;
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.2);
            color: #90CAF9;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.2);
            color: #FFCDD2;
        }

        .btn-view {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(233, 179, 251, 0.3);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            color: #FFB3C7;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-view:hover {
            background: rgba(255, 179, 199, 0.2);
            border-color: #FFB3C7;
            transform: translateY(-1px);
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

            .search-bar {
                flex-direction: column;
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
                <a href="{{ route('customer.dashboard') }}" class="nav-item"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="{{ route('customer.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
                <a href="{{ route('customer.orders.index') }}" class="nav-item active"><i
                        class="fas fa-shopping-bag"></i> طلباتي</a>
                <a href="{{ route('customer.installments.index') }}" class="nav-item"><i
                        class="fas fa-calendar-alt"></i> أقساطي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit"
                        class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>طلباتي</h1>
                    <p>عرض وتتبع جميع طلباتك</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div class="user-name">{{ auth()->user()->name }}</div><i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <div class="search-bar">
                <input type="text" id="searchInput" class="search-input"
                    placeholder="بحث برقم الطلب أو اسم المنتج أو المتجر...">
                <select id="statusFilter" class="filter-select">
                    <option value="all">جميع الحالات</option>
                    <option value="completed">مكتمل</option>
                    <option value="pending">قيد المعالجة</option>
                    <option value="processing">قيد المعالجة</option>
                    <option value="cancelled">ملغي</option>
                </select>
            </div>

            <div class="orders-wrapper">
                <div class="section-title"><i class="fas fa-list-ul"></i> قائمة الطلبات</div>
                <div style="overflow-x: auto;">
                    <table id="ordersTable">
                        <thead>
                            <tr>
                                <th>رقم الطلب</th>
                                <th>المنتج</th>
                                <th>المتجر</th>
                                <th>الحالة</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->order_number }}</td>
                                    <td>{{ $order->items->first()->product->name ?? '—' }}</td>
                                    <td>{{ $order->items->first()->product->store->name ?? '—' }}</td>
                                    <td>
                                        <span class="status-badge 
                                        @if($order->status == 'completed') status-completed
                                        @elseif($order->status == 'processing') status-processing
                                        @elseif($order->status == 'cancelled') status-cancelled
                                        @else status-pending @endif">
                                            {{ $order->status == 'completed' ? 'مكتمل' : ($order->status == 'processing' ? 'قيد المعالجة' : ($order->status == 'cancelled' ? 'ملغي' : 'قيد الانتظار')) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.orders.show', $order) }}" class="btn-view">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;">لا توجد طلبات حتى الآن</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 1rem;">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>

    <script>
        // Mobile menu toggle
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

        // Search and filter functionality (client-side for simplicity)
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('#ordersTableBody tr');

        function filterOrders() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;
            tableRows.forEach(row => {
                const orderNumber = row.cells[0]?.textContent.toLowerCase() || '';
                const productName = row.cells[1]?.textContent.toLowerCase() || '';
                const storeName = row.cells[2]?.textContent.toLowerCase() || '';
                const status = row.cells[3]?.textContent.trim().toLowerCase() || '';
                let statusMatch = false;
                if (statusValue === 'all') statusMatch = true;
                else if (statusValue === 'completed' && status === 'مكتمل') statusMatch = true;
                else if (statusValue === 'pending' && (status === 'قيد المعالجة' || status === 'قيد الانتظار')) statusMatch = true;
                else if (statusValue === 'processing' && status === 'قيد المعالجة') statusMatch = true;
                else if (statusValue === 'cancelled' && status === 'ملغي') statusMatch = true;
                const searchMatch = orderNumber.includes(searchTerm) || productName.includes(searchTerm) || storeName.includes(searchTerm);
                row.style.display = (searchMatch && statusMatch) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterOrders);
        statusFilter.addEventListener('change', filterOrders);
    </script>
</body>

</html>