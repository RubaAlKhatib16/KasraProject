<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · تفاصيل الطلب #{{ $order->order_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
            line-height: 1.5;
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

        .user-name {
            font-weight: 600;
            color: white;
        }

        .back-button {
            margin-bottom: 1.5rem;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(233, 179, 251, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            color: #FFB3C7;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-back:hover {
            background: rgba(255, 179, 199, 0.1);
            border-color: #FFB3C7;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
        }

        .detail-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        .detail-card h3 i {
            color: #FFB3C7;
        }

        .detail-card p {
            margin: 0.5rem 0;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .detail-card strong {
            color: #FFB3C7;
        }

        .products-table {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            margin-bottom: 1.5rem;
            overflow-x: auto;
        }

        .products-table h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th, td {
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid rgba(233, 179, 251, 0.2);
        }

        th {
            font-weight: 700;
            color: #FFB3C7;
            font-size: 0.85rem;
        }

        td {
            color: #EDE9FE;
        }

        .installment-schedule {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
        }

        .installment-schedule h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-completed  { background: rgba(46, 125, 50, 0.2);  color: #A5D6A7; }
        .status-pending    { background: rgba(237, 108, 2, 0.2);  color: #FFB74D; }
        .status-processing { background: rgba(33, 150, 243, 0.2); color: #90CAF9; }
        .status-cancelled  { background: rgba(244, 67, 54, 0.2);  color: #FFCDD2; }
        .status-paid       { background: #2ecc71; color: white; }
        .status-overdue    { background: #e74c3c; color: white; }
        .status-unpaid     { background: rgba(158, 158, 158, 0.2); color: #E0E0E0; }

        .installment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(233, 179, 251, 0.2);
        }

        .installment-item:last-child {
            border-bottom: none;
        }

        .installment-info {
            display: flex;
            gap: 1rem;
        }

        .btn-pay-installment {
            background: linear-gradient(105deg, #2ecc71, #27ae60);
            border: none;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.75rem;
            transition: 0.2s;
        }

        .btn-pay-installment:hover {
            transform: scale(1.02);
            background: #27ae60;
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: rgba(31, 41, 55, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(233, 179, 251, 0.3);
            padding: 0.5rem;
            border-radius: 12px;
            cursor: pointer;
            color: #FFB3C7;
            font-size: 1.2rem;
        }

        /* =====================================================
           FULL ORDER TIMELINE — المضاف الوحيد
           ===================================================== */
        .order-timeline-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 1.8rem 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .order-timeline-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at top right, rgba(255,79,139,0.05), transparent 60%);
            pointer-events: none;
        }

        .order-timeline-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.6rem;
        }

        .order-timeline-card h3 i { color: #FFB3C7; }

        /* cancelled banner */
        .cancelled-banner {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 60px;
            padding: 0.4rem 1rem;
            color: #FCA5A5;
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* track */
        .tl-track {
            position: relative;
        }

        .tl-line {
            position: absolute;
            top: 28px;
            right: 28px;
            left: 28px;
            height: 3px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 99px;
            z-index: 0;
        }

        .tl-fill {
            height: 100%;
            background: linear-gradient(90deg, #FF4F8B, #E9B3FB);
            border-radius: 99px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tl-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 1;
            gap: 0.5rem;
        }

        .tl-step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
            animation: tlFadeIn 0.5s ease both;
        }

        @keyframes tlFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .tl-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            position: relative;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .tl-step.done .tl-icon {
            background: linear-gradient(135deg, #FF4F8B, #E6497D);
            box-shadow: 0 0 20px rgba(255, 79, 139, 0.4);
            color: #fff;
        }

        .tl-step.active .tl-icon {
            background: linear-gradient(135deg, #E9B3FB, #C084FC);
            box-shadow: 0 0 24px rgba(233, 179, 251, 0.5);
            color: #1e0a2e;
        }

        .tl-step.waiting .tl-icon {
            background: rgba(255, 255, 255, 0.04);
            border: 2px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.2);
        }

        .tl-pulse {
            position: absolute;
            inset: -7px;
            border-radius: 50%;
            border: 2px solid rgba(233, 179, 251, 0.45);
            animation: tlPulse 1.8s ease-out infinite;
        }

        @keyframes tlPulse {
            0%   { transform: scale(1);   opacity: 0.8; }
            100% { transform: scale(1.55); opacity: 0; }
        }

        .tl-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.2rem;
            text-align: center;
        }

        .tl-label {
            font-size: 0.8rem;
            font-weight: 700;
        }

        .tl-step.done .tl-label   { color: #FFB3C7; }
        .tl-step.active .tl-label { color: #E9B3FB; }
        .tl-step.waiting .tl-label { color: rgba(255,255,255,0.25); }

        .tl-desc {
            font-size: 0.68rem;
            color: #64748B;
            max-width: 100px;
            line-height: 1.4;
        }

        @media (max-width: 600px) {
            .tl-icon { width: 40px; height: 40px; font-size: 0.85rem; }
            .tl-line  { top: 20px; }
            .tl-desc  { display: none; }
            .order-timeline-card { padding: 1.2rem 1rem; }
        }
        /* ===================================================== */

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                right: -280px;
                top: 0;
                z-index: 99;
                background: rgba(31, 41, 55, 0.95);
                transition: right 0.3s;
            }
            .sidebar.open { right: 0; }
            .menu-toggle  { display: block; }
            .main-content { padding: 1rem; }
            .details-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon"><i class="fas fa-bolt"></i></div>
                <span class="logo-text">كِسرة</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('customer.dashboard') }}" class="nav-item"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="{{ route('customer.profile.edit') }}" class="nav-item"><i class="fas fa-user"></i> حسابي</a>
                <a href="{{ route('customer.orders.index') }}" class="nav-item"><i class="fas fa-shopping-bag"></i> طلباتي</a>
                <a href="{{ route('customer.installments.index') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> أقساطي</a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
                    @csrf
                    <button type="submit" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</button>
                </form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div class="page-title">
                    <h1>تفاصيل الطلب</h1>
                    <p>معلومات المنتج، الأقساط، وحالة الطلب</p>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>

            <div class="back-button">
                <a href="{{ route('customer.orders.index') }}" class="btn-back">
                    <i class="fas fa-arrow-right"></i> العودة إلى الطلبات
                </a>
            </div>

            {{-- ============================================================
                 ORDER STATUS TIMELINE — مضاف هنا فقط، فوق الـ details-grid
                 ============================================================ --}}
            @php
                $tlSteps = [
                    ['key' => 'pending',    'icon' => 'fas fa-clock',         'label' => 'قيد الانتظار', 'desc' => 'تم استلام طلبك'],
                    ['key' => 'processing', 'icon' => 'fas fa-box-open',      'label' => 'جارٍ التجهيز', 'desc' => 'يُجهَّز طلبك الآن'],
                    ['key' => 'shipped',    'icon' => 'fas fa-shipping-fast', 'label' => 'في الطريق',     'desc' => 'الطلب مع المندوب'],
                    ['key' => 'delivered',  'icon' => 'fas fa-check-circle',  'label' => 'تم التسليم',    'desc' => 'استلمت طلبك!'],
                ];
                $tlMap       = ['pending' => 0, 'processing' => 1, 'shipped' => 2, 'delivered' => 3, 'completed' => 3];
                $tlCurrent   = $tlMap[$order->status] ?? 0;
                $tlCancelled = $order->status === 'cancelled';
                $tlFillPct   = $tlCancelled ? 0 : ($tlCurrent / (count($tlSteps) - 1)) * 100;
            @endphp

            <div class="order-timeline-card">
                <h3><i class="fas fa-map-marker-alt"></i> تتبع حالة الطلب</h3>

                @if($tlCancelled)
                    <div class="cancelled-banner">
                        <i class="fas fa-times-circle"></i> تم إلغاء هذا الطلب
                    </div>
                @else
                    <div class="tl-track">
                        <div class="tl-line">
                            <div class="tl-fill" style="width: {{ $tlFillPct }}%"></div>
                        </div>
                        <div class="tl-steps">
                            @foreach($tlSteps as $i => $step)
                            @php
                                $cls = $i < $tlCurrent ? 'done' : ($i === $tlCurrent ? 'active' : 'waiting');
                            @endphp
                            <div class="tl-step {{ $cls }}" style="animation-delay: {{ $i * 0.1 }}s">
                                <div class="tl-icon">
                                    @if($i < $tlCurrent)
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="{{ $step['icon'] }}"></i>
                                    @endif
                                    @if($i === $tlCurrent)
                                        <span class="tl-pulse"></span>
                                    @endif
                                </div>
                                <div class="tl-text">
                                    <span class="tl-label">{{ $step['label'] }}</span>
                                    @if($i === $tlCurrent)
                                        <span class="tl-desc">{{ $step['desc'] }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            {{-- ============================================================ --}}

            <div class="details-grid">
                <div class="detail-card">
                    <h3><i class="fas fa-receipt"></i> معلومات الطلب</h3>
                    <p><strong>رقم الطلب:</strong> #{{ $order->order_number }}</p>
                    <p><strong>المتجر:</strong> {{ $order->items->first()->product->store->name ?? '—' }}</p>
                    <p><strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                    <p><strong>حالة الطلب:</strong>
                        <span class="status-badge
                            @if($order->status == 'completed' || $order->status == 'delivered') status-completed
                            @elseif($order->status == 'processing') status-processing
                            @elseif($order->status == 'cancelled') status-cancelled
                            @else status-pending @endif">
                            @switch($order->status)
                                @case('completed')  مكتمل        @break
                                @case('delivered')  تم التسليم   @break
                                @case('processing') قيد التجهيز @break
                                @case('shipped')    في الطريق   @break
                                @case('cancelled')  ملغي         @break
                                @default            قيد الانتظار
                            @endswitch
                        </span>
                    </p>
                    <p><strong>حالة الدفع:</strong>
                        <span class="status-badge status-paid">
                            {{ $order->installment_plan > 0 ? 'تقسيط' : 'مدفوع بالكامل' }}
                        </span>
                    </p>
                    <p><strong>الإجمالي:</strong> {{ number_format($order->total_amount, 2) }} د.أ</p>
                    <p><strong>طريقة الدفع:</strong> كِسرة (تقسيط)</p>
                    <p><strong>عدد الأقساط:</strong>
                        {{ $order->installment_plan > 0 ? $order->installment_plan . ' دفعات' : 'نقدي' }}
                    </p>
                </div>
                <div class="detail-card">
                    <h3><i class="fas fa-credit-card"></i> معلومات الدفع</h3>
                    <p><strong>قيمة القسط:</strong>
                        {{ $order->installment_amount ? number_format($order->installment_amount, 2) : '—' }} د.أ
                    </p>
                    <p><strong>تاريخ أول قسط:</strong>
                        {{ $order->first_installment_date ? $order->first_installment_date->format('Y-m-d') : '—' }}
                    </p>
                    <p><strong>العنوان:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>الهاتف:</strong> {{ $order->phone ?? '—' }}</p>
                    @if($order->notes)
                    <p><strong>ملاحظات:</strong> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <div class="products-table">
                <h3><i class="fas fa-box"></i> المنتجات</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>سعر الوحدة</th>
                                <th>الكمية</th>
                                <th>الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ number_format($item->price, 2) }} د.أ</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }} د.أ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($order->installment_plan > 0)
            @php
            $installments = \App\Models\Installment::where('order_id', $order->id)->orderBy('due_date')->get();
            @endphp
            @if($installments->count())
            <div class="installment-schedule">
                <h3><i class="fas fa-calendar-alt"></i> جدول الأقساط</h3>
                @foreach($installments as $inst)
                <div class="installment-item">
                    <div class="installment-info">
                        <span>القسط {{ $loop->iteration }} - {{ \Carbon\Carbon::parse($inst->due_date)->format('Y-m-d') }}</span>
                        <span>{{ number_format($inst->amount, 2) }} د.أ</span>
                    </div>
                    <div class="installment-status">
                        @if($inst->status == 'paid')
                            <span class="status-badge status-paid">مدفوع</span>
                            @if($inst->paid_at)
                            <small>({{ \Carbon\Carbon::parse($inst->paid_at)->format('Y-m-d') }})</small>
                            @endif
                        @elseif($inst->status == 'overdue')
                            <span class="status-badge status-overdue">متأخر</span>
                        @else
                            <span class="status-badge status-pending">معلق</span>
                            <form action="{{ route('installment.pay', $inst) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                                @csrf
                                <button type="submit" class="btn-pay-installment">دفع القسط</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endif

        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar    = document.getElementById('sidebar');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
            window.addEventListener('click', (e) => {
                if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            });
        }
    </script>
</body>

</html>