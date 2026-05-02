<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - إدارة المتاجر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* جميع الأنماط من `stores.html` تبقى كما هي - اختصاراً للعرض، سيتم تضمينها في الملف النهائي */
        :root {
            --lavender: #E9B3FB;
            --light-pink: #FFB3C7;
            --hot-pink: #FF4F8B;
            --light-purple: #EDE9FE;
            --light-gray: #F8FAFC;
            --dark-blue: #1F2937;
            --text-muted: #6c757d;
            --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-gray); }
        #wrapper { display: flex; width: 100%; }
        #sidebar-wrapper { min-height: 100vh; width: 260px; background-color: var(--dark-blue); background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%); transition: margin 0.25s ease-out; z-index: 1000; }
        .bg-dark-sidebar { background-color: var(--dark-blue); background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%); }
        #sidebar-wrapper .sidebar-heading { font-size: 1.2rem; font-weight: 700; color: white; }
        #sidebar-wrapper .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 0.75rem 1.25rem; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; }
        #sidebar-wrapper .list-group-item:hover { background-color: var(--lavender); color: var(--dark-blue); }
        #sidebar-wrapper .active-nav { background: linear-gradient(90deg, var(--hot-pink) 0%, var(--lavender) 100%) !important; color: white !important; font-weight: 500; }
        #page-content-wrapper { width: 100%; background-color: var(--light-gray); }
        .navbar { height: 70px; background-color: #fff; }
        .search-box { position: relative; width: 220px; }
        .search-box input { padding-right: 35px; border-radius: 10px; background-color: var(--light-gray); border: 1px solid var(--light-purple); }
        .search-box i { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--hot-pink); }
        .admin-profile-img { width: 35px; height: 35px; object-fit: cover; border: 2px solid var(--light-pink); border-radius: 50%; }
        .notification-badge { position: absolute; top: -4px; right: -4px; width: 8px; height: 8px; background-color: var(--hot-pink); border-radius: 50%; border: 2px solid #fff; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .page-title { font-size: 1.8rem; font-weight: 700; color: var(--dark-blue); }
        .filters-section { display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }
        .filter-select { min-width: 150px; padding: 0.5rem 1rem; border: 1px solid var(--light-purple); border-radius: 8px; background: white; }
        .main-card { background: white; border-radius: 16px; box-shadow: var(--card-shadow); overflow: hidden; border: 1px solid var(--light-purple); }
        .table-container { overflow-x: auto; }
        .stores-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .stores-table th { text-align: right; padding: 1rem 1.5rem; background: var(--light-purple); font-weight: 600; }
        .stores-table td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--light-purple); vertical-align: middle; }
        .stores-table tbody tr:hover { background-color: var(--light-purple); }
        .store-info { display: flex; align-items: center; gap: 12px; }
        .store-avatar { width: 40px; height: 40px; background: var(--lavender); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .status-badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; }
        .status-pending { background: var(--lavender); color: var(--dark-blue); }
        .status-approved { background: var(--light-pink); color: var(--hot-pink); }
        .status-rejected { background: var(--light-gray); color: var(--dark-blue); border: 1px solid var(--hot-pink); }
        .btn-view { background: none; border: 1px solid var(--lavender); padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.8rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem; color: var(--dark-blue); }
        .btn-view:hover { background: var(--hot-pink); color: white; }
        .pagination { gap: 4px; }
        .page-link { color: var(--dark-blue); border: 1px solid var(--light-purple); background: white; }
        .page-link:hover { background: var(--lavender); }
        .page-item.active .page-link { background: var(--hot-pink); border-color: var(--hot-pink); color: white; }
        @media (max-width: 768px) {
            #sidebar-wrapper { margin-right: -260px; position: fixed; height: 100%; }
            #wrapper.toggled #sidebar-wrapper { margin-right: 0; }
            .page-header { flex-direction: column; align-items: flex-start; }
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
                <a href="{{ route('admin.stores.index') }}" class="list-group-item list-group-item-action active-nav mb-2">
                    <i class="fas fa-store ms-3"></i> المتاجر
                </a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-credit-card ms-3"></i> الطلبات
                </a>
                <a href="{{ route('admin.installments.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-calendar-alt ms-3"></i> الأقساط
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-bars" id="sidebarToggle" style="cursor: pointer; font-size: 1.2rem; color: var(--hot-pink);"></i>
                        <i class="fas fa-home" style="color: var(--hot-pink);"></i>
                        <span class="fw-bold" style="color: var(--dark-blue);">المتاجر</span>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="بحث عن متجر..." id="searchInput">
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
                <div class="page-header">
                    <h1 class="page-title">المتاجر</h1>
                    <div class="filters-section">
                        <select class="filter-select" id="statusFilter">
                            <option value="all">كل الحالات</option>
                            <option value="pending">قيد المراجعة</option>
                            <option value="active">مقبول</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                    </div>
                </div>

                <div class="main-card">
                    <div class="table-container">
                        <table class="stores-table" id="storesTable">
                            <thead>
                                <tr>
                                    <th>اسم المتجر</th>
                                    <th>صاحب المتجر</th>
                                    <th>الإيميل</th>
                                    <th>تاريخ التسجيل</th>
                                    <th>الحالة</th>
                                    <th>الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stores as $store)
                                <tr data-status="{{ $store->status ?? 'pending' }}">
                                    <td>
                                        <div class="store-info">
                                            <div class="store-avatar"><i class="fas fa-store"></i></div>
                                            <span>{{ $store->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $store->user->name ?? 'غير معروف' }}</td>
                                    <td>{{ $store->user->email ?? 'N/A' }}</td>
                                    <td>{{ $store->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = 'status-pending';
                                            $statusText = 'قيد المراجعة';
                                            if ($store->status == 'active') {
                                                $statusClass = 'status-approved';
                                                $statusText = 'مقبول';
                                            } elseif ($store->status == 'rejected') {
                                                $statusClass = 'status-rejected';
                                                $statusText = 'مرفوض';
                                            }
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.stores.show', $store->id) }}" class="btn-view">
                                            <i class="fas fa-eye"></i> عرض
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-4">لا توجد متاجر مسجلة</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 border-top">
                        <div class="small text-muted">
                            عرض {{ $stores->firstItem() }} إلى {{ $stores->lastItem() }} من {{ $stores->total() }} متجر
                        </div>
                        {{ $stores->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('wrapper').classList.toggle('toggled');
            });
        }

        // Status filter
        const statusFilter = document.getElementById('statusFilter');
        const rows = document.querySelectorAll('#storesTable tbody tr:not([data-status])?');
        // Filter by data-status
        statusFilter.addEventListener('change', function() {
            const selected = this.value;
            document.querySelectorAll('#storesTable tbody tr').forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (selected === 'all' || rowStatus === selected) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase();
            document.querySelectorAll('#storesTable tbody tr').forEach(row => {
                const storeName = row.querySelector('td:first-child .store-info span')?.textContent.toLowerCase() || '';
                const owner = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const email = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                if (storeName.includes(term) || owner.includes(term) || email.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Close sidebar on outside click for mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar-wrapper');
            if (window.innerWidth <= 768 && sidebar && !sidebar.contains(event.target) && toggle && !toggle.contains(event.target)) {
                document.getElementById('wrapper').classList.remove('toggled');
            }
        });
    </script>
</body>
</html>