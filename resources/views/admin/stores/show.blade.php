<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كِسرة - {{ $store->name }} | تفاصيل المتجر</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* جميع الأنماط السابقة تبقى كما هي (لا تغيير) - تم حذفها للاختصار.
           يمكنك الاحتفاظ بها كما وردت في نموذجك. */
        :root {
            --lavender: #E9B3FB;
            --light-pink: #FFB3C7;
            --hot-pink: #FF4F8B;
            --light-purple: #EDE9FE;
            --light-gray: #F8FAFC;
            --dark-blue: #1F2937;
            --text-muted: #64748b;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            --hover-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --border-light: var(--light-purple);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--main-bg); overflow-x: hidden; }
        #wrapper { display: flex; width: 100%; }
        #sidebar-wrapper { min-height: 100vh; width: 260px; background-color: var(--dark-blue); background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%); transition: margin 0.25s ease-out; z-index: 1000; }
        .bg-dark-sidebar { background-color: var(--dark-blue); background-image: linear-gradient(135deg, var(--dark-blue) 0%, #2d3748 100%); }
        #sidebar-wrapper .sidebar-heading { font-size: 1.2rem; font-weight: 700; color: white; }
        #sidebar-wrapper .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 0.75rem 1.25rem; font-size: 0.9rem; border-radius: 8px; transition: all 0.3s; }
        #sidebar-wrapper .list-group-item:hover { background-color: var(--lavender); color: var(--dark-blue); }
        #sidebar-wrapper .active-nav { background: linear-gradient(90deg, var(--hot-pink) 0%, var(--lavender) 100%) !important; color: white !important; font-weight: 500; }
        #page-content-wrapper { width: 100%; background-color: var(--light-gray); }
        .navbar { height: 70px; background-color: #fff; border-bottom: 1px solid var(--border-light); }
        .search-box { position: relative; width: 240px; }
        .search-box input { padding-right: 40px; border-radius: 30px; background-color: var(--light-gray); border: 1px solid var(--light-purple); transition: all 0.2s; height: 40px; font-size: 0.9rem; }
        .search-box input:focus { background-color: #fff; border-color: var(--lavender); box-shadow: 0 0 0 3px rgba(233, 179, 251, 0.1); outline: none; }
        .search-box i { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--hot-pink); font-size: 0.9rem; }
        .admin-profile-img { width: 38px; height: 38px; object-fit: cover; border: 2px solid var(--light-pink); border-radius: 50%; }
        .notification-badge { position: absolute; top: -2px; right: -2px; width: 8px; height: 8px; background-color: var(--hot-pink); border-radius: 50%; border: 2px solid #fff; }
        .page-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .back-btn { background: #fff; border: 1px solid var(--light-purple); border-radius: 30px; padding: 0.5rem 1.2rem; color: var(--dark-blue); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .back-btn:hover { background: var(--light-purple); border-color: var(--lavender); transform: translateX(-2px); color: var(--hot-pink); }
        .page-title { font-size: 2rem; font-weight: 700; margin-bottom: 0; background: linear-gradient(135deg, var(--dark-blue), var(--hot-pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .info-card { background: white; border-radius: 24px; box-shadow: var(--card-shadow); padding: 1.75rem; height: 100%; border: 1px solid var(--light-purple); transition: box-shadow 0.3s; }
        .info-card:hover { box-shadow: var(--hover-shadow); border-color: var(--lavender); }
        .info-card-title { font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; color: var(--dark-blue); border-bottom: 1px dashed var(--light-purple); padding-bottom: 0.75rem; }
        .info-card-title i { color: var(--hot-pink); font-size: 1.1rem; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem 2rem; }
        .info-item { display: flex; flex-direction: column; }
        .info-label { font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.3px; color: var(--text-muted); margin-bottom: 0.3rem; }
        .info-value { font-weight: 600; color: var(--dark-blue); font-size: 1rem; display: flex; align-items: center; gap: 0.25rem; flex-wrap: wrap; }
        .status-badge { display: inline-block; padding: 0.3rem 1rem; border-radius: 30px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.3px; width: fit-content; }
        .status-pending { background: var(--lavender); color: var(--dark-blue); border: 1px solid var(--lavender); }
        .status-approved { background: var(--light-pink); color: var(--hot-pink); border: 1px solid var(--light-pink); }
        .status-rejected { background: var(--light-gray); color: var(--dark-blue); border: 1px solid var(--hot-pink); }
        .store-logo { width: 90px; height: 90px; background: linear-gradient(135deg, var(--light-purple), var(--lavender)); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: var(--dark-blue); border: 2px dashed var(--light-pink); margin-bottom: 1rem; transition: all 0.3s; }
        .store-logo:hover { border-color: var(--hot-pink); color: var(--hot-pink); }
        .description-box { background: var(--light-gray); border-radius: 16px; padding: 1rem 1.25rem; border: 1px solid var(--light-purple); margin-top: 1.25rem; }
        .description-box p { color: var(--dark-blue); line-height: 1.7; font-size: 0.95rem; }
        .action-buttons { display: flex; gap: 1.25rem; justify-content: center; margin-top: 2.5rem; flex-wrap: wrap; }
        .btn-approve, .btn-reject { border: none; padding: 0.9rem 2.5rem; border-radius: 40px; font-weight: 600; font-size: 1rem; display: inline-flex; align-items: center; gap: 0.75rem; transition: all 0.3s; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-approve { background: linear-gradient(145deg, var(--light-pink), var(--hot-pink)); color: white; }
        .btn-approve:hover { background: linear-gradient(145deg, var(--hot-pink), var(--lavender)); transform: translateY(-2px); box-shadow: 0 12px 20px -10px rgba(255, 79, 139, 0.4); }
        .btn-reject { background: linear-gradient(145deg, var(--lavender), var(--dark-blue)); color: white; }
        .btn-reject:hover { background: linear-gradient(145deg, var(--dark-blue), #2d3748); transform: translateY(-2px); box-shadow: 0 12px 20px -10px rgba(31, 41, 55, 0.4); }
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center; }
        .modal-content { background: white; border-radius: 32px; width: 90%; max-width: 480px; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); animation: modalPop 0.3s ease; border: 1px solid var(--light-purple); }
        @keyframes modalPop { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-title { font-size: 1.4rem; font-weight: 700; color: var(--dark-blue); display: flex; align-items: center; gap: 0.5rem; }
        .modal-title i { color: var(--hot-pink); }
        .modal-close { background: none; border: none; font-size: 1.8rem; cursor: pointer; color: var(--text-muted); transition: color 0.2s; line-height: 1; }
        .modal-close:hover { color: var(--hot-pink); }
        .modal-body textarea { width: 100%; padding: 1rem; border: 2px solid var(--light-purple); border-radius: 16px; resize: vertical; margin-bottom: 1.5rem; font-family: 'Inter', sans-serif; }
        .modal-body textarea:focus { border-color: var(--lavender); outline: none; box-shadow: 0 0 0 4px rgba(233, 179, 251, 0.1); }
        .modal-actions { display: flex; gap: 1rem; justify-content: flex-end; }
        .btn-outline { background: transparent; border: 1px solid var(--light-purple); padding: 0.7rem 1.5rem; border-radius: 40px; font-weight: 500; color: var(--dark-blue); }
        .btn-outline:hover { background: var(--light-purple); color: var(--hot-pink); }
        .btn-danger { background: var(--hot-pink); border: none; padding: 0.7rem 2rem; border-radius: 40px; font-weight: 600; color: white; }
        .btn-danger:hover { background: var(--dark-blue); }
        @media (max-width: 768px) {
            #sidebar-wrapper { margin-right: -260px; position: fixed; height: 100%; }
            #wrapper.toggled #sidebar-wrapper { margin-right: 0; }
            #sidebarToggle { display: block; }
            .info-grid { grid-template-columns: 1fr; gap: 1rem; }
            .page-title { font-size: 1.6rem; }
            .action-buttons { flex-direction: column; align-items: stretch; }
            .btn-approve, .btn-reject { justify-content: center; }
        }
        a { color: var(--hot-pink); text-decoration: none; }
        a:hover { color: var(--lavender); }
        .text-muted { color: var(--text-muted) !important; }
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
                        <i class="fas fa-bars" id="sidebarToggle" style="cursor: pointer; font-size: 1.2rem; color: var(--hot-pink);"></i>
                        <i class="fas fa-home" style="color: var(--hot-pink);"></i>
                        <span class="fw-bold" style="color: var(--dark-blue);">تفاصيل المتجر</span>
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
                <div class="page-header">
                    <a href="{{ route('admin.stores.index') }}" class="back-btn">
                        <i class="fas fa-arrow-right"></i> العودة للمتاجر
                    </a>
                    <h1 class="page-title">{{ $store->name }}</h1>
                </div>

                <div class="row g-4">
                    <!-- بطاقة معلومات المتجر الأساسية -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="info-card-title">
                                <i class="fas fa-store"></i> معلومات المتجر
                            </div>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">اسم المتجر</span>
                                    <span class="info-value">{{ $store->name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">صاحب المتجر</span>
                                    <span class="info-value">{{ $store->user->name ?? 'غير معروف' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">الإيميل</span>
                                    <span class="info-value">{{ $store->user->email ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">رقم الهاتف</span>
                                    <span class="info-value">{{ $store->user->phone ?? '—' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">تاريخ التسجيل</span>
                                    <span class="info-value">{{ $store->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">حالة المتجر</span>
                                    @php
                                        $statusText = 'قيد المراجعة';
                                        $statusClass = 'status-pending';
                                        if ($store->status == 'active') {
                                            $statusText = 'مقبول';
                                            $statusClass = 'status-approved';
                                        } elseif ($store->status == 'rejected') {
                                            $statusText = 'مرفوض';
                                            $statusClass = 'status-rejected';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}" id="statusBadge">{{ $statusText }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- بطاقة معلومات إضافية -->
                    <div class="col-lg-6">
                        <div class="info-card">
                            <div class="info-card-title">
                                <i class="fas fa-info-circle"></i> معلومات إضافية
                            </div>
                            <div class="d-flex align-items-start gap-4 mb-4">
                                <div class="store-logo">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="color: var(--dark-blue);">شعار المتجر</div>
                                    <div class="small text-muted">(يمكن تغييره من قبل التاجر)</div>
                                    @if($store->logo)
                                        <div><img src="{{ asset('storage/' . $store->logo) }}" width="50" class="mt-2 rounded"></div>
                                    @endif
                                </div>
                            </div>
                            <div class="description-box">
                                <span class="info-label d-block mb-2">وصف المتجر</span>
                                <p id="description">{{ $store->description ?? 'لا يوجد وصف' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- أزرار الإجراءات (قبول/رفض) - تعمل مع قاعدة البيانات -->
                    <div class="col-12">
                        <div class="action-buttons">
                            <form action="{{ route('admin.stores.update-status', $store->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="btn-approve" {{ $store->status == 'active' ? 'disabled' : '' }}>
                                    <i class="fas fa-check-circle"></i> قبول المتجر
                                </button>
                            </form>
                            <button class="btn-reject" id="rejectBtn" {{ $store->status == 'rejected' ? 'disabled' : '' }}>
                                <i class="fas fa-times-circle"></i> رفض المتجر
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal سبب الرفض -->
    <div class="modal-overlay" id="rejectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> رفض المتجر</h5>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <label class="info-label mb-2">الرجاء كتابة سبب الرفض:</label>
                <form action="{{ route('admin.stores.update-status', $store->id) }}" method="POST" id="rejectForm">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <textarea name="rejection_reason" rows="4" placeholder="مثال: المستندات غير مكتملة، معلومات خاطئة..." required></textarea>
                    <div class="modal-actions">
                        <button type="button" class="btn-outline" id="cancelReject">إلغاء</button>
                        <button type="submit" class="btn-danger">تأكيد الرفض</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('wrapper').classList.toggle('toggled');
        });

        // Close sidebar on outside click for mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('sidebar-wrapper');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 768 && sidebar && !sidebar.contains(event.target) && toggle && !toggle.contains(event.target)) {
                document.getElementById('wrapper').classList.remove('toggled');
            }
        });

        // Reject modal logic
        const rejectBtn = document.getElementById('rejectBtn');
        const rejectModal = document.getElementById('rejectModal');
        const closeModal = document.getElementById('closeModal');
        const cancelReject = document.getElementById('cancelReject');
        const rejectForm = document.getElementById('rejectForm');

        if (rejectBtn && !rejectBtn.disabled) {
            rejectBtn.addEventListener('click', function () {
                rejectModal.style.display = 'flex';
            });
        }

        function closeModalFn() {
            rejectModal.style.display = 'none';
        }

        if (closeModal) closeModal.addEventListener('click', closeModalFn);
        if (cancelReject) cancelReject.addEventListener('click', closeModalFn);

        window.addEventListener('click', function (e) {
            if (e.target === rejectModal) closeModalFn();
        });
    </script>
</body>
</html>