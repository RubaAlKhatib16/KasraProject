<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'كِسرة - تسوق بالتقسيط')</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #1F2937; font-family: 'Cairo', sans-serif; color: #EDE9FE; overflow-x: hidden; }
        .navbar { background: rgba(31,41,55,0.8); backdrop-filter: blur(12px); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(233,179,251,0.3); position: sticky; top: 0; z-index: 100; }
        .logo { font-size: 1.8rem; font-weight: 800; background: linear-gradient(120deg,#FFF,#E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; text-decoration: none; }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; flex-wrap: wrap; }
        .nav-links a { color: #EDE9FE; text-decoration: none; transition: 0.2s; }
        .nav-links a:hover { color: #FFB3C7; }
        .cart-icon { position: relative; }
        .cart-count { position: absolute; top: -8px; left: -12px; background: #FF4F8B; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 0.7rem; display: flex; align-items: center; justify-content: center; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .footer { text-align: center; padding: 1.5rem; background: rgba(31,41,55,0.6); margin-top: 2rem; font-size: 0.8rem; }
        .btn-primary { background: linear-gradient(135deg, #FF4F8B, #E9B3FB); border: none; padding: 0.6rem 1.5rem; border-radius: 60px; color: white; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: 0.2s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255,79,139,0.3); }
        @media (max-width: 768px) { .navbar { flex-direction: column; gap: 0.5rem; } .nav-links { justify-content: center; } .container { padding: 1rem; } }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">كِسرة</a>
        <div class="nav-links">
            <a href="{{ route('home') }}">الرئيسية</a>
            <a href="{{ route('public.stores') }}">المتاجر</a>
            @auth
                @if(auth()->user()->role == 'seller')
                    <a href="{{ route('seller.dashboard') }}">لوحة التحكم</a>
                @elseif(auth()->user()->role == 'customer')
                    <a href="{{ route('customer.dashboard') }}">لوحة التحكم</a>
                @endif
                <a href="{{ route('cart.index') }}" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count" id="cartCount">0</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#EDE9FE; cursor:pointer;">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('login') }}">تسجيل الدخول</a>
                <a href="{{ route('register') }}">إنشاء حساب</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        © {{ date('Y') }} كِسرة - جميع الحقوق محفوظة
    </footer>

    <script>
        function updateCartCount() {
            fetch('{{ route("cart.count") }}')
                .then(res => res.json())
                .then(data => {
                    const cartCountSpan = document.getElementById('cartCount');
                    if (cartCountSpan) cartCountSpan.innerText = data.count;
                }).catch(() => {});
        }
        updateCartCount();
    </script>
    @stack('scripts')
</body>
</html>