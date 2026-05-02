<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - تفاصيل العملية #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جميع الأنماط السابقة تبقى كما هي (تم حذفها للاختصار، لكنك تحتفظ بها في ملفك الأصلي) */
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
        .back-btn { background: #fff; border: 1px solid var(--light-purple); border-radius: 30px; padding: 0.5rem 1.2rem; color: var(--dark-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .back-btn:hover { background: var(--light-purple); border-color: var(--lavender); transform: translateX(-2px); color: var(--hot-pink); }
        .page-title { font-size: 2rem; font-weight: 700; background: linear-gradient(135deg, var(--dark-blue), var(--hot-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .transaction-id { font-size: 1rem; color: var(--hot-pink); font-weight: 500; background: var(--light-purple); padding: 0.3rem 1rem; border-radius: 20px; border: 1px solid var(--lavender); }
        .info-card { background: white; border-radius: 24px; box-shadow: var(--card-shadow); padding: 1.5rem; height: 100%; border: 1px solid var(--light-purple); transition: box-shadow 0.3s; }
        .info-card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.08); border-color: var(--lavender); }
        .info-card-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1.2rem; display: flex; align-items: center; gap: 0.75rem; color: var(--dark-blue); border-bottom: 1px dashed var(--light-purple); padding-bottom: 0.75rem; }
        .info-card-title i { color: var(--hot-pink); }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem 1.5rem; }
        .info-item { display: flex; flex-direction: column; }
        .info-label { font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.3px; color: var(--text-muted); margin-bottom: 0.2rem; }
        .info-value { font-weight: 600; color: var(--dark-blue); font-size: 0.95rem; }
        .badge-status { display: inline-block; padding: 0.25rem 0.8rem; border-radius: 30px; font-size: 0.75rem; font-weight: 600; width: fit-content; }
        .badge-pending { background: var(--lavender); color: var(--dark-blue); border: 1px solid var(--lavender); }
        .badge-confirmed { background: var(--light-pink); color: var(--hot-pink); border: 1px solid var(--light-pink); }
        .badge-completed { background: var(--light-gray); color: var(--dark-blue); border: 1px solid var(--dark-blue); }
        .badge-cancelled, .badge-rejected { background: var(--light-gray); color: var(--dark-blue); border: 1px solid var(--hot-pink); }
        .table-card { background: white; border-radius: 24px; box-shadow: var(--card-shadow); padding: 1.5rem; border: 1px solid var(--light-purple); margin-top: 1.5rem; }
        .table-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem; color: var(--dark-blue); }
        .table-title i { color: var(--hot-pink); }
        .installments-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .installments-table th, .installments-table td { padding: 0.75rem 1rem; border-bottom: 1px solid var(--light-purple); text-align: right; }
        .installments-table th { background: var(--light-purple); font-weight: 600; border-bottom: 2px solid var(--lavender); }
        .installments-table tbody tr:hover { background-color: var(--light-purple); }
        .badge-paid { background: var(--light-pink); color: var(--hot-pink); padding: 0.2rem 0.8rem; border-radius: 30px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
        .badge-unpaid { background: var(--light-gray); color: var(--dark-blue); padding: 0.2rem 0.8rem; border-radius: 30px; font-size: 0.7rem; font-weight: 600; display: inline-block; border: 1px solid var(--hot-pink); }
        .badge-overdue { background: var(--hot-pink); color: white; padding: 0.2rem 0.8rem; border-radius: 30px; font-size: 0.7rem; font-weight: 600; display: inline-block; }
        .action-buttons { display: flex; gap: 1rem; justify-content: center; margin: 2rem 0 1rem; flex-wrap: wrap; }
        .btn-approve, .btn-reject, .btn-view { border: none; padding: 0.8rem 2.2rem; border-radius: 40px; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.75rem; transition: 0.3s; cursor: pointer; }
        .btn-approve { background: linear-gradient(145deg, var(--light-pink), var(--hot-pink)); color: white; }
        .btn-approve:hover { background: linear-gradient(145deg, var(--hot-pink), var(--lavender)); transform: translateY(-2px); }
        .btn-reject { background: linear-gradient(145deg, var(--lavender), var(--dark-blue)); color: white; }
        .btn-reject:hover { background: linear-gradient(145deg, var(--dark-blue), #2d3748); transform: translateY(-2px); }
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); align-items: center; justify-content: center; z-index: 2000; }
        .modal-content { background: white; border-radius: 32px; width: 90%; max-width: 480px; padding: 2rem; border: 1px solid var(--light-purple); animation: modalPop 0.3s ease; }
        @keyframes modalPop { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-title { font-size: 1.4rem; font-weight: 700; color: var(--dark-blue); display: flex; align-items: center; gap: 0.5rem; }
        .modal-title i { color: var(--hot-pink); }
        .modal-close { background: none; border: none; font-size: 1.8rem; cursor: pointer; color: var(--text-muted); }
        .modal-close:hover { color: var(--hot-pink); }
        .modal-body textarea { width: 100%; padding: 1rem; border: 2px solid var(--light-purple); border-radius: 16px; resize: vertical; margin-bottom: 1.5rem; }
        .modal-body textarea:focus { border-color: var(--lavender); outline: none; }
        .modal-actions { display: flex; gap: 1rem; justify-content: flex-end; }
        .btn-outline { background: transparent; border: 1px solid var(--light-purple); padding: 0.7rem 1.5rem; border-radius: 40px; font-weight: 500; color: var(--dark-blue); }
        .btn-outline:hover { background: var(--light-purple); color: var(--hot-pink); }
        .btn-danger { background: var(--hot-pink); border: none; padding: 0.7rem 2rem; border-radius: 40px; font-weight: 600; color: white; }
        .btn-danger:hover { background: var(--dark-blue); }
        @media (max-width: 768px) {
            #sidebar-wrapper { margin-right: -260px; position: fixed; height: 100%; }
            #wrapper.toggled #sidebar-wrapper { margin-right: 0; }
            .info-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .transaction-id { margin-right: 0; }
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
                        <span class="fw-bold" style="color: var(--dark-blue);">تفاصيل العملية</span>
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
                    <a href="{{ route('admin.orders.index') }}" class="back-btn">
                        <i class="fas fa-arrow-right"></i> العودة للعمليات
                    </a>
                    <h1 class="page-title">تفاصيل العملية</h1>
                    <span class="transaction-id">عملية رقم {{ $order->order_number }}</span>
                </div>

                <div class="row g-4">
                    {{-- عمود معلومات المستخدم --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-user-circle"></i> معلومات المستخدم</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">الاسم</span><span class="info-value">{{ optional($order->user)->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">البريد الإلكتروني</span><span class="info-value">{{ optional($order->user)->email ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">رقم الهاتف</span><span class="info-value">{{ optional($order->user)->phone ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">العنوان</span><span class="info-value">{{ $order->shipping_address ?? '—' }}</span></div>
                            </div>
                        </div>
                    </div>

                    {{-- عمود معلومات المتجر (من أول منتج) --}}
                    @php
                        $firstProduct = $order->items->first()?->product;
                        $store = $firstProduct?->store;
                    @endphp
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-store"></i> معلومات المتجر</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">اسم المتجر</span><span class="info-value">{{ $store->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">صاحب المتجر</span><span class="info-value">{{ optional($store->user)->name ?? '—' }}</span></div>
                                <div class="info-item"><span class="info-label">البريد الإلكتروني</span><span class="info-value">{{ optional($store->user)->email ?? '—' }}</span></div>
                            </div>
                        </div>
                    </div>

                    {{-- عمود معلومات المنتج (قائمة المنتجات) --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-box"></i> المنتجات</div>
                            <div class="info-grid">
                                @foreach($order->items as $item)
                                <div class="info-item">
                                    <span class="info-label">{{ $item->product->name ?? 'منتج محذوف' }}</span>
                                    <span class="info-value">{{ $item->quantity }} × {{ number_format($item->price, 2) }} د.أ</span>
                                </div>
                                @endforeach
                                <div class="info-item"><span class="info-label">السعر الكلي</span><span class="info-value">{{ number_format($order->total_amount, 2) }} د.أ</span></div>
                                @if($order->installment_plan > 0)
                                <div class="info-item"><span class="info-label">الدفعة الأولى</span><span class="info-value">{{ number_format($order->installment_amount, 2) }} د.أ</span></div>
                                <div class="info-item"><span class="info-label">المبلغ المتبقي</span><span class="info-value">{{ number_format($order->total_amount - $order->installment_amount, 2) }} د.أ</span></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- عمود ملخص التقسيط --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="info-card">
                            <div class="info-card-title"><i class="fas fa-calendar-alt"></i> تفاصيل التقسيط</div>
                            <div class="info-grid">
                                <div class="info-item"><span class="info-label">عدد الأقساط</span><span class="info-value">{{ $order->installment_plan ?: 'غير مقسط' }}</span></div>
                                @if($order->installment_plan > 0)
                                <div class="info-item"><span class="info-label">قيمة القسط</span><span class="info-value">{{ number_format($order->installment_amount, 2) }} د.أ</span></div>
                                <div class="info-item"><span class="info-label">تاريخ أول قسط</span><span class="info-value">{{ optional($order->first_installment_date)->format('d M Y') ?? '—' }}</span></div>
                                @endif
                                <div class="info-item"><span class="info-label">حالة العملية</span>
                                    @php
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
                                    <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- جدول الأقساط --}}
                <div class="table-card">
                    <div class="table-title"><i class="fas fa-list-ol"></i> جدول الأقساط</div>
                    <div class="table-responsive">
                        <table class="installments-table">
                            <thead>
                                <tr><th>رقم القسط</th><th>المبلغ</th><th>تاريخ الاستحقاق</th><th>الحالة</th></tr>
                            </thead>
                            <tbody>
                                @forelse($order->installments as $index => $inst)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ number_format($inst->amount, 2) }} د.أ</td>
                                    <td>{{ optional($inst->due_date)->format('d M Y') ?? '—' }}</td>
                                    <td>
                                        @if($inst->status == 'paid')
                                            <span class="badge-paid">مدفوع</span>
                                        @elseif($inst->status == 'overdue')
                                            <span class="badge-overdue">متأخر</span>
                                        @else
                                            <span class="badge-unpaid">غير مدفوع</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center">لا توجد أقساط مرتبطة<td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- أزرار القبول/الرفض (تظهر فقط للطلبات المعلقة) --}}
                @if($order->status == 'pending')
                <div class="action-buttons">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display:inline;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn-approve"><i class="fas fa-check-circle"></i> قبول العملية</button>
                    </form>
                    <button class="btn-reject" id="rejectBtn"><i class="fas fa-times-circle"></i> رفض العملية</button>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- مودال رفض العملية --}}
    <div class="modal-overlay" id="rejectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> رفض العملية</h5>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" id="rejectForm">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <div class="modal-body">
                    <label class="info-label mb-2">الرجاء كتابة سبب الرفض:</label>
                    <textarea name="rejection_reason" rows="4" placeholder="مثال: المستندات غير مكتملة..." required></textarea>
                    <div class="modal-actions">
                        <button type="button" class="btn-outline" id="cancelReject">إلغاء</button>
                        <button type="submit" class="btn-danger">تأكيد الرفض</button>
                    </div>
                </div>
            </form>
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

        const rejectBtn = document.getElementById('rejectBtn');
        const modal = document.getElementById('rejectModal');
        const closeModal = document.getElementById('closeModal');
        const cancelReject = document.getElementById('cancelReject');
        if (rejectBtn) {
            rejectBtn.addEventListener('click', () => modal.style.display = 'flex');
            closeModal.addEventListener('click', () => modal.style.display = 'none');
            cancelReject.addEventListener('click', () => modal.style.display = 'none');
            window.addEventListener('click', (e) => { if (e.target === modal) modal.style.display = 'none'; });
        }
    </script>
</body>
</html>