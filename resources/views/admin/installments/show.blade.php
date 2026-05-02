<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - تفاصيل القسط #{{ $installment->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جميع الأنماط التي أرسلتها تبقى كما هي - تم حذفها للاختصار هنا ولكن يجب تضمينها في الملف النهائي */
        :root {
            --lavender: #E9B3FB;
            --light-pink: #FFB3C7;
            --hot-pink: #FF4F8B;
            --light-purple: #EDE9FE;
            --light-gray: #F8FAFC;
            --dark-blue: #1F2937;
            --text-muted: #64748b;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.03);
            --border-light: var(--light-purple);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--light-gray); overflow-x: hidden; }
        #wrapper { display: flex; width: 100%; }
        #sidebar-wrapper { min-height: 100vh; width: 260px; background-color: var(--dark-blue); background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%); transition: margin 0.25s ease-out; z-index: 1000; }
        #sidebar-wrapper .sidebar-heading { font-size: 1.2rem; font-weight: 700; color: white; }
        #sidebar-wrapper .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 0.75rem 1.25rem; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; }
        #sidebar-wrapper .list-group-item:hover { background-color: var(--lavender); color: var(--dark-blue); }
        #sidebar-wrapper .active-nav { background: linear-gradient(90deg, var(--hot-pink) 0%, var(--lavender) 100%) !important; color: white !important; font-weight: 500; }
        #page-content-wrapper { width: 100%; background-color: var(--light-gray); }
        .navbar { height: 70px; background-color: #fff; border-bottom: 1px solid var(--border-light); }
        .search-box { position: relative; width: 240px; }
        .search-box input { padding-right: 40px; border-radius: 30px; background-color: var(--light-gray); border: 1px solid var(--light-purple); height: 40px; }
        .search-box i { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--hot-pink); }
        .admin-profile-img { width: 38px; height: 38px; object-fit: cover; border: 2px solid var(--light-pink); border-radius: 50%; }
        .page-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .back-btn { background: #fff; border: 1px solid var(--light-purple); border-radius: 30px; padding: 0.5rem 1.2rem; color: var(--dark-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 500; transition: 0.2s; }
        .back-btn:hover { background: var(--light-purple); border-color: var(--lavender); transform: translateX(-2px); color: var(--hot-pink); }
        .page-title { font-size: 2rem; font-weight: 700; background: linear-gradient(135deg, var(--dark-blue), var(--hot-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .page-description { color: var(--text-muted); font-size: 0.95rem; margin-right: auto; }
        .info-card { background: white; border-radius: 24px; box-shadow: var(--card-shadow); padding: 1.5rem; height: 100%; border: 1px solid var(--light-purple); transition: box-shadow 0.3s; }
        .info-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-color: var(--lavender); }
        .info-card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1.2rem; display: flex; align-items: center; gap: 0.75rem; color: var(--dark-blue); border-bottom: 1px dashed var(--light-purple); padding-bottom: 0.75rem; }
        .info-card-title i { color: var(--hot-pink); }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem 1.5rem; }
        .info-item { display: flex; flex-direction: column; }
        .info-label { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.3px; color: var(--text-muted); margin-bottom: 0.2rem; }
        .info-value { font-weight: 600; color: var(--dark-blue); font-size: 0.95rem; display: flex; align-items: center; gap: 0.25rem; }
        .badge-status { display: inline-block; padding: 0.25rem 0.8rem; border-radius: 30px; font-size: 0.75rem; font-weight: 600; width: fit-content; }
        .badge-paid { background: var(--light-pink); color: var(--hot-pink); border: 1px solid var(--light-pink); }
        .badge-unpaid { background: var(--lavender); color: var(--dark-blue); border: 1px solid var(--lavender); }
        .badge-late { background: var(--light-gray); color: var(--dark-blue); border: 1px solid var(--hot-pink); }
        .badge-active { background: var(--light-pink); color: var(--hot-pink); border: 1px solid var(--light-pink); }
        .action-buttons { display: flex; gap: 1rem; justify-content: flex-start; margin: 2rem 0 1rem; flex-wrap: wrap; }
        .btn-update { background: linear-gradient(145deg, var(--light-pink), var(--hot-pink)); border: none; padding: 0.8rem 2.2rem; border-radius: 40px; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.75rem; transition: all 0.3s; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.05); color: white; text-decoration: none; }
        .btn-update:hover { background: linear-gradient(145deg, var(--hot-pink), var(--lavender)); transform: translateY(-2px); box-shadow: 0 12px 20px -10px rgba(255,79,139,0.4); }
        .btn-update.secondary { background: var(--text-muted); }
        .btn-update.secondary:hover { background: var(--dark-blue); }
        @media (max-width: 768px) {
            #sidebar-wrapper { margin-right: -260px; position: fixed; height: 100%; }
            #wrapper.toggled #sidebar-wrapper { margin-right: 0; }
            .info-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-description { margin-right: 0; }
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
                        <span class="fw-bold" style="color: var(--dark-blue);">تفاصيل القسط</span>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="بحث...">
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
                    <a href="{{ route('admin.installments.index') }}" class="back-btn">
                        <i class="fas fa-arrow-right"></i> العودة إلى الأقساط
                    </a>
                    <h1 class="page-title">تفاصيل القسط</h1>
                    <span class="page-description">عرض معلومات القسط المرتبط بعملية الشراء</span>
                </div>

                @php
                    $order = $installment->order;
                    $user = $order?->user;
                    $product = $order?->items->first()?->product;
                    $store = $product?->store;
                    $installmentNumber = $order?->installments->search(function ($item) use ($installment) {
                        return $item->id === $installment->id;
                    }) + 1 ?? '—';
                @endphp

                <div class="row g-4">
                    {{-- معلومات القسط --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-money-bill-wave"></i> معلومات القسط</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">رقم القسط</span><span class="info-value">{{ $installmentNumber }}</span></div>
                                <div class="info-item"><span class="info-label">رقم العملية</span><span class="info-value">{{ $order?->order_number ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">المبلغ</span><span class="info-value">{{ number_format($installment->amount, 2) }} د.أ</span></div>
                                <div class="info-item"><span class="info-label">تاريخ الاستحقاق</span><span class="info-value">{{ optional($installment->due_date)->format('d M Y') ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">الحالة</span>
                                    @php
                                        $statusClass = match($installment->status) {
                                            'paid' => 'badge-paid',
                                            'overdue' => 'badge-late',
                                            default => 'badge-unpaid'
                                        };
                                        $statusText = match($installment->status) {
                                            'paid' => 'مدفوع',
                                            'overdue' => 'متأخر',
                                            default => 'غير مدفوع'
                                        };
                                    @endphp
                                    <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- معلومات المستخدم --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-user-circle"></i> معلومات المستخدم</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">اسم المستخدم</span><span class="info-value">{{ $user?->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">البريد الإلكتروني</span><span class="info-value">{{ $user?->email ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">رقم الهاتف</span><span class="info-value">{{ $user?->phone ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">تاريخ إنشاء الحساب</span><span class="info-value">{{ optional($user?->created_at)->format('Y') ?? '—' }}</span></div>
                            </div>
                        </div>
                    </div>

                    {{-- معلومات المتجر --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-store"></i> معلومات المتجر</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">اسم المتجر</span><span class="info-value">{{ $store?->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">صاحب المتجر</span><span class="info-value">{{ optional($store?->user)->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">البريد الإلكتروني</span><span class="info-value">{{ optional($store?->user)->email ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">حالة المتجر</span><span class="badge-status badge-active">{{ $store?->status == 'active' ? 'مفعل' : 'غير مفعل' }}</span></div>
                            </div>
                        </div>
                    </div>

                    {{-- معلومات العملية --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-credit-card"></i> معلومات العملية</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">رقم العملية</span><span class="info-value">{{ $order?->order_number ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">المبلغ الكلي</span><span class="info-value">{{ number_format($order?->total_amount ?? 0, 2) }} د.أ</span></div>
                                <div class="info-item"><span class="info-label">عدد الأقساط</span><span class="info-value">{{ $order?->installment_plan ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">تاريخ العملية</span><span class="info-value">{{ optional($order?->created_at)->format('d M Y') ?? '—' }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- أزرار الإجراءات --}}
                <div class="action-buttons">
                    <a href="{{ route('admin.installments.index') }}" class="btn-update secondary">
                        <i class="fas fa-arrow-right"></i> العودة إلى الأقساط
                    </a>
                    @if($installment->status !== 'paid')
                    <form action="{{ route('admin.installments.update-status', $installment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-check-circle"></i> تحديث كـ مدفوع
                        </button>
                    </form>
                    @endif
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