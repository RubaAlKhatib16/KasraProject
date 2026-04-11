<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · إدارة المنتجات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* كل الـ CSS السابق كما هو (لا تغيير) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
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

        .btn-add {
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 60px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 79, 139, 0.3);
        }

        .products-wrapper {
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

        .products-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .products-table th,
        .products-table td {
            padding: 1rem 0.75rem;
            text-align: right;
            border-bottom: 1px solid rgba(233, 179, 251, 0.15);
            vertical-align: middle;
        }

        .products-table th {
            color: #FFB3C7;
            font-weight: 700;
            font-size: 0.85rem;
            background: rgba(0, 0, 0, 0.2);
        }

        .products-table tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .product-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
            min-width: 70px;
        }

        .status-active {
            background: rgba(46, 125, 50, 0.2);
            color: #A5D6A7;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-inactive {
            background: rgba(158, 158, 158, 0.2);
            color: #E0E0E0;
            border: 1px solid rgba(158, 158, 158, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .btn-edit,
        .btn-delete {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(233, 179, 251, 0.3);
            padding: 0.4rem 0.9rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-edit {
            color: #FFB3C7;
        }

        .btn-edit:hover {
            background: rgba(255, 179, 199, 0.2);
            border-color: #FFB3C7;
            transform: translateY(-1px);
        }

        .btn-delete {
            color: #FF8A8A;
            background: none;
            border: 1px solid rgba(255, 138, 138, 0.3);
        }

        .btn-delete:hover {
            background: rgba(255, 138, 138, 0.2);
            border-color: #FF8A8A;
            transform: translateY(-1px);
        }

        .description-cell {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #CBD5E6;
            font-size: 0.85rem;
        }

        .price-cell {
            font-weight: 600;
            color: #FFB3C7;
        }

        .menu-toggle {
            display: none;
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
                position: fixed;
                top: 1rem;
                left: 1rem;
                background: rgba(31, 41, 55, 0.8);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(233, 179, 251, 0.3);
                padding: 0.5rem;
                border-radius: 12px;
                cursor: pointer;
                color: #FFB3C7;
                z-index: 100;
            }

            .main-content {
                padding: 1rem;
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
                <a href="{{ route('seller.dashboard') }}" class="nav-item"><i class="fas fa-chart-line"></i> لوحة
                    التحكم</a>
                <a href="{{ route('seller.products.index') }}" class="nav-item active"><i class="fas fa-box"></i>
                    المنتجات</a>
                <a href="{{ route('seller.orders.index') }}" class="nav-item"><i class="fas fa-shopping-cart"></i>
                    الطلبات</a>
                <a href="{{ route('seller.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit"
                        class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>إدارة المنتجات</h1>
                    <p>عرض وتعديل وإضافة منتجات متجرك</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}</div>
                    <div class="user-name">{{ auth()->user()->first_name }}</div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <a href="{{ route('seller.products.create') }}" class="btn-add"><i class="fas fa-plus"></i> إضافة منتج
                    جديد</a>
            </div>

            <!-- سيتم عرض رسائل الجلسة باستخدام SweetAlert عبر JavaScript -->
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'تم!',
                        text: "{{ session('success') }}",
                        background: '#1F2937',
                        color: '#EDE9FE',
                        confirmButtonColor: '#FF4F8B'
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ!',
                        text: "{{ session('error') }}",
                        background: '#1F2937',
                        color: '#EDE9FE',
                        confirmButtonColor: '#FF4F8B'
                    });
                </script>
            @endif

            <div class="products-wrapper">
                <div class="section-title"><i class="fas fa-boxes"></i> قائمة المنتجات</div>
                <div style="overflow-x: auto;">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th style="width:80px">الصورة</th>
                                <th>المنتج</th>
                                <th style="width:100px">السعر</th>
                                <th style="width:80px">المخزون</th>
                                <th style="width:100px">الفئة</th>
                                <th style="width:100px">الأقساط</th>
                                <th>الوصف</th>
                                <th style="width:100px">الحالة</th>
                                <th style="width:140px">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="text-center">
                                        @if($product->featured_image)
                                            <img src="{{ asset('storage/' . $product->featured_image) }}" class="product-thumb"
                                                alt="{{ $product->name }}">
                                        @else
                                            <i class="fas fa-image fa-2x" style="color:#FFB3C7;"></i>
                                        @endif
                                    </td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td class="price-cell">{{ number_format($product->price, 2) }} د.أ</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->category ? $product->category->name : '—' }}</td>
                                    <td>{{ $product->installments_count ? $product->installments_count . ' قسط' : '—' }}
                                    </td>
                                    <td class="description-cell" title="{{ $product->description }}">
                                        {{ Str::limit($product->description, 60) ?: '—' }}</td>
                                    <td>
                                        <span
                                            class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $product->is_active ? 'متاح' : 'غير متاح' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('seller.products.edit', $product) }}" class="btn-edit"><i
                                                    class="fas fa-edit"></i> تعديل</a>
                                            <button type="button" class="btn-delete" data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}">
                                                <i class="fas fa-trash"></i> حذف
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align:center; padding:3rem;">لا توجد منتجات. <a
                                            href="{{ route('seller.products.create') }}" style="color:#FFB3C7;">أضف منتجك
                                            الأول</a></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar on mobile
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

        // SweetAlert for delete confirmation
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const productId = this.getAttribute('data-id');
                const productName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    html: `سيتم حذف المنتج <strong>${productName}</strong> بشكل نهائي.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF4F8B',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'نعم، احذف',
                    cancelButtonText: 'إلغاء',
                    background: '#1F2937',
                    color: '#EDE9FE'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // إنشاء نموذج وإرسال طلب الحذف
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/seller/products/${productId}`;
                        form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>