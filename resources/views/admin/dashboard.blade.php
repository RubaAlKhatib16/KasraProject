<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - لوحة تحكم منصة التقسيط</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --lavender: #E9B3FB;
            --light-pink: #FFB3C7;
            --hot-pink: #FF4F8B;
            --light-purple: #EDE9FE;
            --light-gray: #F8FAFC;
            --dark-blue: #1F2937;
            --sidebar-bg: var(--dark-blue);
            --main-bg: var(--light-gray);
            --accent-brown: var(--hot-pink);
            --accent-brown-light: var(--light-pink);
            --text-muted: #6c757d;
            --icon-brown: var(--lavender);
            --icon-gray: #9CA3AF;
            --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --modal-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            --chart-blue: var(--lavender);
            --chart-grid: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        #wrapper {
            width: 100%;
        }

        #sidebar-wrapper {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            background-color: var(--dark-blue);
            background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%);
            transition: all 0.25s ease-out;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
        }

        .bg-dark-sidebar {
            background-color: var(--dark-blue);
            background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%);
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

        .extra-small {
            font-size: 0.7rem;
        }

        #page-content-wrapper {
            width: calc(100% - 260px);
            margin-right: 260px;
            background-color: var(--light-gray);
            transition: all 0.3s;
        }

        .navbar {
            height: 70px;
            background-color: white !important;
        }

        .search-box {
            position: relative;
            width: 220px;
        }

        .search-box input {
            padding-right: 35px;
            border-radius: 10px;
            background-color: var(--light-gray);
            border: 1px solid var(--light-purple);
        }

        .search-box input:focus {
            border-color: var(--lavender);
            box-shadow: 0 0 0 0.2rem rgba(233, 179, 251, 0.25);
        }

        .search-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--hot-pink);
        }

        .admin-profile-img {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border: 2px solid var(--light-pink);
            border-radius: 50%;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 8px;
            height: 8px;
            background-color: var(--hot-pink);
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .stats-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .stat-card-col {
            padding: 0 10px;
            margin-bottom: 15px;
        }

        @media (min-width: 1200px) {
            .stat-card-col {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .stat-card-col {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .stat-card-col {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }
        }

        @media (max-width: 767px) {
            .stat-card-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 480px) {
            .stat-card-col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s;
            height: 100%;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-bottom: 3px solid var(--lavender);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-bottom-color: var(--hot-pink);
        }

        .stat-card .card-body {
            padding: 1rem;
        }

        .stat-card h2 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            line-height: 1;
            color: var(--dark-blue);
        }

        .stat-icon {
            color: var(--hot-pink);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-icon i {
            margin-left: 5px;
            color: var(--lavender);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            height: 100%;
            border: 1px solid var(--light-purple);
        }

        .card-header {
            border-bottom: 1px solid var(--light-purple);
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 0.75rem 1.25rem;
            background-color: white !important;
        }

        .card-header h6 {
            color: var(--dark-blue);
        }

        .card-body {
            padding: 1.25rem;
        }

        .chart-container {
            min-height: 200px;
            height: 200px;
            position: relative;
        }

        .alert-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--light-purple);
            transition: background 0.2s;
            cursor: pointer;
        }

        .alert-item:hover {
            background-color: var(--light-purple);
        }

        .alert-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 12px;
        }

        .alert-danger-bg {
            background-color: var(--light-pink);
            color: var(--hot-pink);
        }

        .alert-warning-bg {
            background-color: var(--lavender);
            color: var(--dark-blue);
        }

        .alert-info-bg {
            background-color: var(--light-purple);
            color: var(--dark-blue);
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--hot-pink);
            border-bottom: 2px solid var(--lavender);
            padding: 0.75rem 1.25rem;
        }

        .table tbody td {
            font-size: 0.85rem;
            padding: 0.75rem 1.25rem;
            vertical-align: middle;
        }

        .table-user-img {
            width: 28px;
            height: 28px;
            object-fit: cover;
            margin-left: 8px;
            border: 2px solid var(--light-pink);
            border-radius: 50%;
        }

        .btn-xs {
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
            min-width: 50px;
        }

        .btn-success {
            background-color: var(--light-pink);
            border-color: var(--light-pink);
            color: var(--hot-pink);
        }

        .btn-success:hover {
            background-color: var(--hot-pink);
            border-color: var(--hot-pink);
            color: white;
        }

        .btn-danger {
            background-color: var(--hot-pink);
            border-color: var(--hot-pink);
            color: white;
        }

        .btn-danger:hover {
            background-color: var(--lavender);
            border-color: var(--lavender);
            color: var(--dark-blue);
        }

        .btn-warning {
            background-color: var(--lavender);
            border-color: var(--lavender);
            color: var(--dark-blue);
        }

        .btn-warning:hover {
            background-color: var(--hot-pink);
            border-color: var(--hot-pink);
            color: white;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-right: -260px;
                position: fixed;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-right: 0;
            }

            #page-content-wrapper {
                width: 100%;
                margin-right: 0;
            }

            .search-box {
                width: 150px;
            }
        }

        @media (max-width: 576px) {
            .search-box {
                width: 120px;
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
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active-nav mb-2">
                    <i class="fas fa-home ms-3"></i> الرئيسية
                </a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-users ms-3"></i> المستخدمون
                </a>
                <a href="{{ route('admin.stores.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-store ms-3"></i> المتاجر
                </a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-credit-card ms-3"></i> الطلبات
                </a>
                <a href="{{ route('admin.installments.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-calendar-alt ms-3"></i> الأقساط
                </a>
                <a href="#" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-cog ms-3"></i> الإعدادات
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-home" style="color: var(--hot-pink);"></i>
                        <span class="fw-bold" style="color: var(--dark-blue);">الرئيسية</span>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="بحث...">
                        </div>
                        <div class="position-relative">
                            <i class="fas fa-bell fs-5" style="color: var(--hot-pink);"></i>
                            <span class="notification-badge"></span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-medium d-none d-sm-inline" style="color: var(--dark-blue);">{{ Auth::user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?background=FF4F8B&color=fff&name={{ urlencode(Auth::user()->name) }}" class="rounded-circle admin-profile-img" alt="Admin">
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4 main-content">
                <h4 class="mb-4" style="color: var(--dark-blue);">مرحباً بك في لوحة تحكم كِسرة</h4>

                <!-- KPIs Cards -->
                <div class="stats-row mb-4">
                    <div class="stat-card-col">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon"><i class="fas fa-store"></i> إجمالي المتاجر</div>
                                <h2 class="mb-1">{{ $totalStores ?? 0 }}</h2>
                                <div class="small text-muted">جميع المتاجر المسجلة</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card-col">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon"><i class="fas fa-clock"></i> متاجر بانتظار الموافقة</div>
                                <h2 class="mb-1">{{ $pendingStores ?? 0 }}</h2>
                                <div class="small" style="color: var(--hot-pink);">تحتاج مراجعة</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card-col">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon"><i class="fas fa-users"></i> عدد المستخدمين</div>
                                <h2 class="mb-1">{{ $totalUsers ?? 0 }}</h2>
                                <div class="small text-muted">عملاء وتجار ومشرفون</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card-col">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon"><i class="fas fa-credit-card"></i> عمليات هذا الشهر</div>
                                <h2 class="mb-1">{{ $totalTransactionsThisMonth ?? 0 }}</h2>
                                <div class="small" style="color: var(--lavender);">أحدث الطلبات</div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card-col">
                        <div class="card stat-card">
                            <div class="card-body">
                                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i> أقساط متأخرة</div>
                                <h2 class="mb-1">{{ $overdueInstallments ?? 0 }}</h2>
                                <div class="small" style="color: var(--hot-pink);">دفعات متأخرة</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts + Chart -->
                <div class="row mb-4">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h6 class="m-0 fw-bold"><i class="fas fa-bell me-1" style="color: var(--hot-pink);"></i> تنبيهات مهمة</h6>
                                <a href="#" class="text-decoration-none small">عرض الكل</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="alert-item" data-url="{{ route('admin.stores.index') }}" onclick="window.location.href=this.dataset.url;">
                                    <div class="alert-icon alert-warning-bg"><i class="fas fa-store"></i></div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">{{ $pendingStores ?? 0 }} متاجر بانتظار المراجعة</div>
                                        <div class="extra-small text-muted">تحتاج تدقيق سريع</div>
                                    </div>
                                    <i class="fas fa-chevron-left" style="color: var(--lavender);"></i>
                                </div>
                                <div class="alert-item" data-url="{{ route('admin.installments.index') }}" onclick="window.location.href=this.dataset.url;">
                                    <div class="alert-icon alert-danger-bg"><i class="fas fa-exclamation"></i></div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">{{ $overdueInstallments ?? 0 }} دفعات متأخرة</div>
                                        <div class="extra-small text-muted">مستحقة منذ أيام</div>
                                    </div>
                                    <i class="fas fa-chevron-left" style="color: var(--lavender);"></i>
                                </div>
                                <div class="alert-item" data-url="{{ route('admin.users.index') }}" onclick="window.location.href=this.dataset.url;">
                                    <div class="alert-icon alert-info-bg"><i class="fas fa-flag"></i></div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">مستخدم تم الإبلاغ عنه</div>
                                        <div class="extra-small text-muted">بلاغ واحد جديد</div>
                                    </div>
                                    <i class="fas fa-chevron-left" style="color: var(--lavender);"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                                <h6 class="m-0 fw-bold">عدد العمليات خلال آخر 6 أشهر</h6>
                                <div class="d-flex gap-2">
                                    <select class="form-select form-select-sm bg-light border-0">
                                        <option>{{ now()->year }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="transactionsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Stores and Users Tables -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h6 class="m-0 fw-bold">آخر طلبات تسجيل المتاجر</h6>
                                <a href="{{ route('admin.stores.index') }}" class="text-decoration-none small">عرض الكل</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>اسم المتجر</th>
                                                <th>تاريخ الطلب</th>
                                                <th>الحالة</th>
                                                <th>الإجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentStoreRequests ?? [] as $store)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://ui-avatars.com/api/?background=E9B3FB&color=1F2937&name={{ urlencode($store->name) }}" class="rounded-circle table-user-img" alt="">
                                                        <span class="small fw-bold">{{ $store->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="small">{{ $store->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <span class="badge {{ $store->status == 'pending' ? 'bg-warning text-dark' : ($store->status == 'active' ? 'bg-success' : 'bg-secondary') }}">
                                                        {{ $store->status == 'pending' ? 'قيد المراجعة' : ($store->status == 'active' ? 'مقبول' : 'غير نشط') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-xs btn-success"><i class="fas fa-check"></i></button>
                                                        <button class="btn btn-xs btn-danger"><i class="fas fa-times"></i></button>
                                                        <button class="btn btn-xs btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center">لا توجد متاجر جديدة</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h6 class="m-0 fw-bold">آخر المستخدمين المسجلين</h6>
                                <a href="{{ route('admin.users.index') }}" class="text-decoration-none small">عرض الكل</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>البريد</th>
                                                <th>تاريخ التسجيل</th>
                                                <th>الحالة</th>
                                                <th>إجراء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentUsers ?? [] as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://ui-avatars.com/api/?background=FF4F8B&color=fff&name={{ urlencode($user->name) }}" class="rounded-circle table-user-img" alt="">
                                                        <span class="small fw-bold">{{ $user->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="small">{{ $user->email }}</td>
                                                <td class="small">{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <span class="badge bg-success">{{ $user->role == 'customer' ? 'عميل' : ($user->role == 'seller' ? 'تاجر' : 'مشرف') }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-xs btn-warning"><i class="fas fa-ban"></i></button>
                                                        <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">لا يوجد مستخدمون جدد</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartLabels = {!! json_encode($months ?? ['أكتوبر', 'نوفمبر', 'ديسمبر', 'يناير', 'فبراير', 'مارس']) !!};
    const chartData = {!! json_encode($transactionsData ?? [0, 0, 0, 0, 0, 0]) !!};

    const ctx = document.getElementById('transactionsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'عدد العمليات',
                data: chartData,
                borderColor: '#FF4F8B',
                backgroundColor: 'rgba(233, 179, 251, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#E9B3FB',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { backgroundColor: 'rgba(0,0,0,0.7)' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e5e7eb' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
</body>

</html>