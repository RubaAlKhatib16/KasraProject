<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - إدارة العمليات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جميع الأنماط السابقة تبقى كما هي - اختصاراً سأكتفي بالأنماط الأساسية، 
           يمكنك نقلها من الملف الثابت الذي أرسلته. */
        :root {
            --lavender: #E9B3FB;
            --light-pink: #FFB3C7;
            --hot-pink: #FF4F8B;
            --light-purple: #EDE9FE;
            --light-gray: #F8FAFC;
            --dark-blue: #1F2937;
            --text-muted: #64748b;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            --border-light: var(--light-purple);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 260px;
            background-color: var(--dark-blue);
            background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%);
            transition: margin 0.25s ease-out;
            z-index: 1000;
        }

        #sidebar-wrapper .sidebar-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
        }

        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: #adb5bd;
            border: none;
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: var(--lavender);
            color: var(--dark-blue);
        }

        #sidebar-wrapper .active-nav {
            background: linear-gradient(90deg, var(--hot-pink) 0%, var(--lavender) 100%) !important;
            color: white !important;
            font-weight: 500;
        }

        #page-content-wrapper {
            width: 100%;
            background-color: var(--light-gray);
        }

        .navbar {
            height: 70px;
            background-color: #fff;
            border-bottom: 1px solid var(--border-light);
        }

        .search-box {
            position: relative;
            width: 240px;
        }

        .search-box input {
            padding-right: 40px;
            border-radius: 30px;
            background-color: var(--light-gray);
            border: 1px solid var(--light-purple);
            height: 40px;
        }

        .search-box i {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--hot-pink);
        }

        .admin-profile-img {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border: 2px solid var(--light-pink);
            border-radius: 50%;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark-blue), var(--hot-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-description {
            color: var(--text-muted);
        }

        .filters-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-btn {
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            font-size: 0.85rem;
            border: 1px solid var(--light-purple);
            background: white;
            cursor: pointer;
            transition: 0.2s;
        }

        .filter-btn:hover {
            background: var(--light-purple);
        }

        .filter-btn.active {
            background: var(--hot-pink);
            color: white;
            border-color: var(--hot-pink);
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid var(--light-purple);
            border-radius: 30px;
            padding: 0.3rem 1rem;
            min-width: 280px;
        }

        .search-wrapper i {
            color: var(--hot-pink);
            margin-left: 0.5rem;
        }

        .search-wrapper input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
        }

        .table-card {
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            border: 1px solid var(--light-purple);
            overflow-x: auto;
        }

        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .transactions-table th {
            text-align: right;
            padding: 1rem 0.75rem;
            background: var(--light-purple);
            font-weight: 600;
            border-bottom: 2px solid var(--lavender);
            white-space: nowrap;
        }

        .transactions-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--light-purple);
            vertical-align: middle;
        }

        .transactions-table tbody tr:hover {
            background-color: var(--light-purple);
        }

        .badge-status {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background: var(--lavender);
            color: var(--dark-blue);
        }

        .badge-confirmed {
            background: var(--light-pink);
            color: var(--hot-pink);
        }

        .badge-completed {
            background: var(--light-gray);
            color: var(--dark-blue);
            border: 1px solid var(--dark-blue);
        }

        .badge-cancelled {
            background: var(--light-gray);
            color: var(--dark-blue);
            border: 1px solid var(--hot-pink);
        }

        .badge-rejected {
            background: var(--light-gray);
            color: var(--dark-blue);
            border: 1px solid var(--hot-pink);
        }

        .btn-details {
            background: none;
            border: 1px solid var(--light-purple);
            border-radius: 20px;
            padding: 0.3rem 1.2rem;
            font-size: 0.8rem;
            text-decoration: none;
            color: var(--dark-blue);
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-details:hover {
            background: var(--hot-pink);
            color: white;
            border-color: var(--hot-pink);
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .pagination {
            display: flex;
            gap: 0.4rem;
        }

        .page-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: white;
            border: 1px solid var(--light-purple);
            color: var(--dark-blue);
            text-decoration: none;
        }

        .page-link.active {
            background: var(--hot-pink);
            color: white;
            border-color: var(--hot-pink);
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-right: -260px;
                position: fixed;
                height: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-right: 0;
            }

            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark-sidebar border-end" id="sidebar-wrapper">
            <div class="sidebar-heading text-white py-4 px-3">
                <h4 class="m-0"><i class="fas fa-layer-group ms-2" style="color: var(--light-pink);"></i> كِسرة</h4>
            </div>
            <div class="list-group list-group-flush px-3">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-home ms-3"></i> الرئيسية
                </a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-users ms-3"></i> المستخدمون
                </a>
                <a href="{{ route('admin.stores.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-store ms-3"></i> المتاجر
                </a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action active-nav mb-2">
                    <i class="fas fa-credit-card ms-3"></i> العمليات
                </a>
                <a href="{{ route('admin.installments.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-calendar-alt ms-3"></i> الأقساط
                </a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-bars" id="sidebarToggle" style="cursor: pointer; font-size: 1.2rem; color: var(--hot-pink);"></i>
                        <i class="fas fa-home" style="color: var(--hot-pink);"></i>
                        <span class="fw-bold" style="color: var(--dark-blue);">العمليات</span>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="بحث..." id="globalSearch">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-medium d-none d-sm-inline" style="color: var(--dark-blue);">{{ Auth::user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?background=FF4F8B&color=fff&name={{ urlencode(Auth::user()->name) }}" class="rounded-circle admin-profile-img" alt="Admin">
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4 main-content">
                <div class="page-header">
                    <h1 class="page-title">إدارة العمليات</h1>
                    <p class="page-description">عرض وإدارة جميع عمليات الشراء بالتقسيط داخل المنصة</p>
                </div>

                <div class="filters-section">
                    <div class="filter-buttons">
                        <a href="{{ route('admin.orders.index') }}" class="filter-btn {{ !request('status') ? 'active' : '' }}">الكل</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">قيد المراجعة</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="filter-btn {{ request('status') == 'confirmed' ? 'active' : '' }}">مقبولة</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="filter-btn {{ request('status') == 'completed' ? 'active' : '' }}">مكتملة</a>
                        <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="filter-btn {{ request('status') == 'cancelled' ? 'active' : '' }}">ملغية</a>
                    </div>
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="ابحث باسم المستخدم أو رقم العملية" value="{{ request('search') }}">
                        @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                    </form>
                </div>

                <div class="table-card">
                    <table class="transactions-table">
                        <thead>
                            <tr>
                                <th>رقم العملية</th>
                                <th>المستخدم</th>
                                <th>المتجر</th>
                                <th>المنتجات</th>
                                <th>السعر الكلي</th>
                                <th>عدد الأقساط</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>التفاصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            @php
                            $firstItem = $order->items->first();
                            $storeName = $firstItem?->product?->store?->name ?? '—';
                            $productsList = $order->items->map(function($item) {
                            $productName = $item->product?->name ?? 'منتج محذوف';
                            return $productName . ' (x' . $item->quantity . ')';
                            })->implode('، ');

                            $statusClass = match($order->status) {
                            'pending' => 'badge-pending',
                            'confirmed' => 'badge-confirmed',
                            'completed' => 'badge-completed',
                            'cancelled', 'rejected' => 'badge-cancelled',
                            default => 'badge-pending'
                            };
                            $statusText = match($order->status) {
                            'pending' => 'قيد المراجعة',
                            'confirmed' => 'مقبولة',
                            'completed' => 'مكتملة',
                            'cancelled' => 'ملغية',
                            'rejected' => 'مرفوضة',
                            default => $order->status
                            };
                            @endphp
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ optional($order->user)->name ?? 'غير معروف' }}</td>
                                <td>{{ $storeName }}</td>
                                <td>{{ Str::limit($productsList, 50) }}</td>
                                <td>{{ number_format($order->total_amount, 2) }} د.أ</td>
                                <td>{{ $order->installment_plan ?: 'نقدي' }}</td>
                                <td><span class="badge-status {{ $statusClass }}">{{ $statusText }}</span></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-details">
                                        <i class="fas fa-eye"></i> عرض
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">لا توجد عمليات حتى الآن</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <div class="pagination-info">
                        عرض {{ $orders->firstItem() }} إلى {{ $orders->lastItem() }} من {{ $orders->total() }} نتيجة
                    </div>
                    {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('wrapper').classList.toggle('toggled');
        });
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar-wrapper');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 768 && sidebar && !sidebar.contains(event.target) && toggle && !toggle.contains(event.target)) {
                document.getElementById('wrapper').classList.remove('toggled');
            }
        });
    </script>
</body>

</html>