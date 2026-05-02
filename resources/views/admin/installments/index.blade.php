<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - إدارة الأقساط</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جميع الأنماط السابقة تبقى كما هي (تم تضمينها في الكود الأصلي، هنا للاختصار نضع الأساسي) */
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
            font-size: 0.95rem;
        }

        .filters-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .filter-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-select {
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-size: 0.85rem;
            border: 1px solid var(--light-purple);
            background: white;
            min-width: 130px;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: var(--lavender);
            outline: none;
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
            padding: 1.5rem;
            border: 1px solid var(--light-purple);
            overflow-x: auto;
        }

        .installments-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .installments-table th {
            text-align: right;
            padding: 1rem 0.75rem;
            background: var(--light-purple);
            font-weight: 600;
            border-bottom: 2px solid var(--lavender);
        }

        .installments-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid var(--light-purple);
            vertical-align: middle;
        }

        .installments-table tbody tr:hover {
            background-color: var(--light-purple);
        }

        .badge-status {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-paid {
            background: var(--light-pink);
            color: var(--hot-pink);
            border: 1px solid var(--light-pink);
        }

        .badge-unpaid {
            background: var(--lavender);
            color: var(--dark-blue);
            border: 1px solid var(--lavender);
        }

        .badge-late {
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
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

            .filter-group {
                justify-content: space-between;
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
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action mb-2">
                    <i class="fas fa-credit-card ms-3"></i> العمليات
                </a>
                <a href="{{ route('admin.installments.index') }}" class="list-group-item list-group-item-action active-nav mb-2">
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
                        <span class="fw-bold" style="color: var(--dark-blue);">الأقساط</span>
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
                    <h1 class="page-title">إدارة الأقساط</h1>
                    <p class="page-description">إدارة ومتابعة جميع الأقساط الخاصة بعمليات التقسيط</p>
                </div>

                <div class="filters-section">
                    <div class="filter-group">
                        <select class="filter-select" id="statusFilter">
                            <option value="all">كل الحالات</option>
                            <option value="paid">مدفوع</option>
                            <option value="unpaid">غير مدفوع</option>
                            <option value="overdue">متأخر</option>
                        </select>
                        <input type="date" class="filter-select" id="dateFilter" style="min-width: 140px;">
                    </div>
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="ابحث باسم المستخدم أو رقم العملية">
                    </div>
                </div>

                <div class="table-card">
                    <table class="installments-table" id="installmentsTable">
                        <thead>
                            <tr>
                                <th>رقم القسط</th>
                                <th>رقم العملية</th>
                                <th>المستخدم</th>
                                <th>المتجر</th>
                                <th>المبلغ</th>
                                <th>تاريخ الاستحقاق</th>
                                <th>الحالة</th>
                                <th>عرض</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($installments as $index => $inst)
                            <tr>
                                <td>{{ ($installments->currentPage() - 1) * $installments->perPage() + $loop->iteration }}</td>
                                <td>{{ $inst->order->order_number ?? '—' }}</td>
                                <td>{{ $inst->order->user->name ?? '—' }}</td>
                                <td>{{ $inst->order->items->first()->product->store->name ?? '—' }}</td>
                                <td>{{ number_format($inst->amount, 2) }} د.أ</td>
                                <td>{{ $inst->due_date ? \Carbon\Carbon::parse($inst->due_date)->format('d M Y') : '—' }}</td>
                                <td>
                                    @php
                                    $statusClass = match($inst->status) {
                                    'paid' => 'badge-paid',
                                    'overdue' => 'badge-late',
                                    default => 'badge-unpaid'
                                    };
                                    $statusText = match($inst->status) {
                                    'paid' => 'مدفوع',
                                    'overdue' => 'متأخر',
                                    default => 'غير مدفوع'
                                    };
                                    @endphp
                                    <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                                </td>
                                <td><a href="{{ route('admin.installments.show', $inst->id) }}" class="btn-details"><i class="fas fa-eye"></i> عرض</a></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" class="text-center py-4">لا توجد أقساط حتى الآن</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <div class="pagination-info">
                        عرض {{ $installments->firstItem() }} إلى {{ $installments->lastItem() }} من {{ $installments->total() }} نتيجة
                    </div>
                    {{ $installments->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
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

        // Search (filter table rows client-side, but it's better to persist via query string; we'll implement client-side anyway)
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const dateFilter = document.getElementById('dateFilter');
        const rows = document.querySelectorAll('#installmentsTable tbody tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const status = statusFilter.value;
            const date = dateFilter.value;
            rows.forEach(row => {
                const cols = row.querySelectorAll('td');
                if (!cols.length) return;
                const orderNumber = cols[1]?.textContent.toLowerCase() || '';
                const userName = cols[2]?.textContent.toLowerCase() || '';
                const store = cols[3]?.textContent.toLowerCase() || '';
                const dueDateStr = cols[5]?.textContent || '';
                const statusSpan = cols[6]?.querySelector('.badge-status');
                const statusText = statusSpan ? statusSpan.textContent.trim() : '';
                let statusMatch = (status === 'all') ||
                    (status === 'paid' && statusText === 'مدفوع') ||
                    (status === 'unpaid' && statusText === 'غير مدفوع') ||
                    (status === 'overdue' && statusText === 'متأخر');
                let dateMatch = true;
                if (date) {
                    const dueDateParts = dueDateStr.split(' ');
                    const monthMap = {
                        'Jan': '01',
                        'Feb': '02',
                        'Mar': '03',
                        'Apr': '04',
                        'May': '05',
                        'Jun': '06',
                        'Jul': '07',
                        'Aug': '08',
                        'Sep': '09',
                        'Oct': '10',
                        'Nov': '11',
                        'Dec': '12'
                    };
                    let day = dueDateParts[0]?.replace(/\D/g, '');
                    let month = monthMap[dueDateParts[1]];
                    let year = dueDateParts[2];
                    let dueDateRaw = year && month && day ? `${year}-${month.padStart(2,'0')}-${day.padStart(2,'0')}` : '';
                    dateMatch = dueDateRaw === date;
                }
                const searchMatch = searchTerm === '' || orderNumber.includes(searchTerm) || userName.includes(searchTerm) || store.includes(searchTerm);
                row.style.display = (searchMatch && statusMatch && dateMatch) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
        dateFilter.addEventListener('change', filterTable);

        // Trigger initial filter
        filterTable();
    </script>
</body>

</html>