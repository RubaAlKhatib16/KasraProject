<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - إدارة المستخدمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* جميع الأنماط التي أرسلتها تبقى كما هي - تم حذفها للاختصار ولكن سأحتفظ بها في الملف النهائي */
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
            --text-muted: #6c757d;
            --icon-brown: var(--lavender);
            --icon-gray: #9CA3AF;
            --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
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
            display: flex;
            flex-direction: column;
            z-index: 1000;
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
            width: 100%;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stats-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1 1 200px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 3px solid var(--lavender);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-bottom-color: var(--hot-pink);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.total-users {
            background-color: rgba(233, 179, 251, 0.2);
            color: var(--lavender);
        }

        .stat-icon.active-users {
            background-color: rgba(255, 179, 199, 0.2);
            color: var(--light-pink);
        }

        .stat-icon.pending-users {
            background-color: rgba(255, 79, 139, 0.1);
            color: var(--hot-pink);
        }

        .stat-icon.blocked-users {
            background-color: rgba(31, 41, 55, 0.1);
            color: var(--dark-blue);
        }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0;
            color: var(--dark-blue);
        }

        .stat-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .main-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--light-purple);
        }

        .card-header {
            padding: 1.5rem 1.8rem;
            border-bottom: 1px solid var(--light-purple);
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-input,
        .filter-select {
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--light-purple);
            padding: 0.375rem 0.75rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .users-table th {
            background: var(--light-purple);
            font-weight: 600;
            padding: 1rem 1.5rem;
            color: var(--dark-blue);
        }

        .users-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--light-purple);
            vertical-align: middle;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--lavender);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-blue);
        }

        .user-details h6 {
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--dark-blue);
        }

        .user-details p {
            font-size: 0.8rem;
            color: var(--hot-pink);
            margin: 0;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background: var(--light-pink);
            color: var(--hot-pink);
        }

        .status-pending {
            background: var(--lavender);
            color: var(--dark-blue);
        }

        .status-blocked {
            background: var(--light-gray);
            color: var(--dark-blue);
            border: 1px solid var(--lavender);
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-action {
            background: none;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-action.delete:hover {
            background: var(--hot-pink);
            color: white;
        }

        .btn-action.view:hover {
            background: var(--lavender);
            color: var(--dark-blue);
        }

        .btn-action.edit:hover {
            background: var(--light-pink);
            color: var(--hot-pink);
        }

        .pagination-container {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--light-purple);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .pagination {
            display: flex;
            gap: 4px;
        }

        .page-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
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
            #page-content-wrapper {
                width: 100%;
                margin-right: 0;
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
                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action active-nav mb-2">
                    <i class="fas fa-users ms-3"></i> المستخدمين
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
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-home" style="color: var(--hot-pink);"></i>
                        <span class="fw-bold" style="color: var(--dark-blue);">إدارة المستخدمين</span>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="بحث..." id="searchInput">
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

            <div class="container-fluid main-content p-4">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">إدارة المستخدمين</h1>
                        <p class="text-muted mb-0">عرض وإدارة جميع المستخدمين في المنصة</p>
                    </div>
                </div>

                <!-- Stats Cards - ديناميكية من قاعدة البيانات -->
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon total-users"><i class="fas fa-users"></i></div>
                        <div class="stat-info"><h3>{{ $totalUsers }}</h3><p>إجمالي المستخدمين</p></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon active-users"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info"><h3>{{ $activeUsers }}</h3><p>مصادق عليهم (نشط)</p></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending-users"><i class="fas fa-clock"></i></div>
                        <div class="stat-info"><h3>{{ $pendingUsers }}</h3><p>بإنتظار الموافقة</p></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blocked-users"><i class="fas fa-ban"></i></div>
                        <div class="stat-info"><h3>{{ $blockedUsers }}</h3><p>محظورين</p></div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="main-card">
                    <div class="card-header">
                        <h3 class="card-title">جميع المستخدمين</h3>
                        <div class="filters">
                            <select class="filter-select" id="roleFilter">
                                <option value="">كل الأدوار</option>
                                <option value="customer">عميل</option>
                                <option value="seller">تاجر</option>
                                <option value="admin">مشرف</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="users-table" id="usersTable">
                            <thead>
                                <tr>
                                    <th>المستخدم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الدور</th>
                                    <th>الحالة</th>
                                    <th>تاريخ التسجيل</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr data-role="{{ $user->role }}">
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar"><i class="fas fa-{{ $user->role == 'seller' ? 'store' : 'user' }}"></i></div>
                                            <div class="user-details">
                                                <h6>{{ $user->first_name }} {{ $user->last_name }}</h6>
                                                <p>{{ $user->role == 'seller' ? 'تاجر' : ($user->role == 'admin' ? 'مشرف' : 'عميل') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role == 'seller' ? 'تاجر' : ($user->role == 'admin' ? 'مشرف' : 'عميل') }}</td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="status-badge status-active">نشط</span>
                                        @else
                                            <span class="status-badge status-pending">غير مفعل</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" style="background:none; border:none;"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center">لا يوجد مستخدمون حتى الآن</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            عرض {{ $users->firstItem() }} إلى {{ $users->lastItem() }} من {{ $users->total() }} نتيجة
                        </div>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // فلترة بسيطة من خلال الدور
        const roleFilter = document.getElementById('roleFilter');
        const rows = document.querySelectorAll('#usersTable tbody tr');

        roleFilter.addEventListener('change', function() {
            const selectedRole = this.value;
            rows.forEach(row => {
                if (selectedRole === '' || row.getAttribute('data-role') === selectedRole) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // البحث حسب الاسم أو البريد (اختياري)
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase();
            rows.forEach(row => {
                const name = row.querySelector('.user-details h6')?.innerText.toLowerCase() || '';
                const email = row.cells[1]?.innerText.toLowerCase() || '';
                if (name.includes(term) || email.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>