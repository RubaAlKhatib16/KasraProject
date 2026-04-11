<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · تفاصيل الطلب #{{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* نفس التصميم السابق مع بعض الإضافات */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
            color: #EDE9FE;
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
        }

        .nav-item i {
            width: 24px;
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
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .page-title h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(120deg, #FFF, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.05);
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-info,
        .order-items,
        .status-update {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            margin-bottom: 1.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.75rem;
            text-align: right;
            border-bottom: 1px solid rgba(233, 179, 251, 0.15);
        }

        th {
            color: #FFB3C7;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 40px;
            font-size: 0.75rem;
        }

        .status-pending {
            background: rgba(237, 108, 2, 0.2);
            color: #FFB74D;
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.2);
            color: #90CAF9;
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.2);
            color: #A5D6A7;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.2);
            color: #EF9A9A;
        }

        select,
        button {
            padding: 0.5rem 1rem;
            border-radius: 60px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(233, 179, 251, 0.4);
            color: white;
            font-family: inherit;
        }

        button {
            background: #FF4F8B;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #ff3373;
            transform: translateY(-1px);
        }

        .btn-back {
            background: transparent;
            border: 1px solid rgba(233, 179, 251, 0.6);
            color: #FFB3C7;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            display: inline-block;
        }

        .btn-back:hover {
            background: rgba(255, 179, 199, 0.1);
        }

        @media (max-width:768px) {
            .sidebar {
                position: fixed;
                right: -280px;
            }

            .main-content {
                padding: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('seller.dashboard') }}" class="nav-item"><i class="fas fa-chart-line"></i> لوحة
                    التحكم</a>
                <a href="{{ route('seller.products.index') }}" class="nav-item"><i class="fas fa-box"></i> المنتجات</a>
                <a href="{{ route('seller.orders.index') }}" class="nav-item active"><i
                        class="fas fa-shopping-cart"></i> الطلبات</a>
                <a href="{{ route('seller.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">@csrf<button type="submit"
                        class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button></form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>تفاصيل الطلب #{{ $order->order_number }}</h1>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->first_name, 0, 1) }}</div>
                    <div>{{ auth()->user()->first_name }}</div>
                </div>
            </div>

            @if(session('success'))
                <script>Swal.fire({ icon: 'success', title: 'تم', text: '{{ session('success') }}', background: '#1F2937', color: '#EDE9FE', confirmButtonColor: '#FF4F8B' });</script>
            @endif

            <!-- معلومات العميل والطلب -->
            <div class="order-info">
                <h3><i class="fas fa-info-circle"></i> معلومات الطلب</h3>
                <div class="info-grid">
                    <div><strong>رقم الطلب:</strong> #{{ $order->order_number }}</div>
                    <div><strong>التاريخ:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</div>
                    <div><strong>العميل:</strong> {{ $order->user->name }}</div>
                    <div><strong>الهاتف:</strong> {{ $order->phone ?? '—' }}</div>
                    <div><strong>العنوان:</strong> {{ $order->shipping_address }}</div>

                    <div><strong>الإجمالي:</strong> {{ number_format($order->total_amount, 2) }} د.أ</div>
                    @if($order->installment_plan > 0)
                        <div><strong>خطة التقسيط:</strong> {{ $order->installment_plan }} قسط</div>
                        <div><strong>قيمة القسط الشهري:</strong> {{ number_format($order->installment_amount, 2) }} د.أ
                        </div>
                        <div><strong>تاريخ أول قسط:</strong>
                            {{ $order->first_installment_date ? \Carbon\Carbon::parse($order->first_installment_date)->format('Y-m-d') : '—' }}
                        </div>
                    @else
                        <div><strong>طريقة الدفع:</strong> نقدي</div>
                    @endif
                    @if($order->notes)

                    <div><strong>ملاحظات:</strong> {{ $order->notes }}</div>@endif
                </div>
            </div>

            <!-- المنتجات في الطلب -->
            <div class="order-items">
                <h3><i class="fas fa-boxes"></i> المنتجات</h3>
                <table>
                    <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }} د.أ</td>
                                <td>{{ number_format($item->quantity * $item->price, 2) }} د.أ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- تحديث حالة الطلب -->
            <div class="status-update">
                <h3><i class="fas fa-tasks"></i> تحديث حالة الطلب</h3>
                <form method="POST" action="{{ route('seller.orders.update-status', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div style="display:flex; gap:1rem; align-items:center; flex-wrap:wrap;">
                        <select name="status">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار
                            </option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>قيد المعالجة
                            </option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>
                        <button type="submit"><i class="fas fa-save"></i> تحديث الحالة</button>
                        <a href="{{ route('seller.orders.index') }}" class="btn-back"><i class="fas fa-arrow-right"></i>
                            العودة</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        if (menuToggle) menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    </script>
</body>

</html>