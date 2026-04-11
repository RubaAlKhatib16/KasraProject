@extends('client.layouts.app')

@section('title', 'جميع المنتجات')

@section('content')
<div class="container">
    <h1 style="font-size: 2rem; font-weight: 800; background: linear-gradient(120deg,#FFF,#E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; margin-bottom: 1.5rem;">جميع المنتجات</h1>

    <!-- فلتر الفئات -->
    <form method="GET" action="{{ route('client.products.index') }}" style="margin-bottom: 2rem; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <label style="color:#FFB3C7;">الفئة:</label>
        <select name="category" onchange="this.form.submit()" style="padding: 0.5rem 1rem; border-radius: 60px; background: rgba(0,0,0,0.5); color: white; border: 1px solid rgba(233,179,251,0.3);">
            <option value="">الكل</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @if(request('category'))
            <a href="{{ route('client.products.index') }}" style="color:#FFB3C7;">إلغاء الفلتر</a>
        @endif
    </form>

    <!-- شبكة المنتجات -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
        @forelse($products as $product)
            <div style="background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 28px; border: 1px solid rgba(233,179,251,0.25); overflow: hidden; transition: 0.3s;">
                <a href="{{ route('client.products.show', $product->slug) }}" style="text-decoration: none; color: inherit;">
                    <div style="height: 200px; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-image fa-3x" style="color:#FFB3C7;"></i>
                        @endif
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="margin-bottom: 0.5rem;">{{ $product->name }}</h3>
                        <p style="color: #FFB3C7; font-weight: bold; margin-bottom: 0.5rem;">{{ number_format($product->price, 2) }} د.أ</p>
                        @if($product->installments_count > 0)
                            <p style="font-size: 0.8rem; color: #A5D6A7;">قسط يبدأ من {{ number_format($product->price / $product->installments_count, 2) }} د.أ/شهر</p>
                        @endif
                        <div style="margin-top: 1rem;">
                            <span style="background: rgba(255,79,139,0.2); padding: 0.2rem 0.8rem; border-radius: 40px; font-size: 0.7rem;">{{ $product->category->name ?? 'بدون فئة' }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">لا توجد منتجات حالياً</div>
        @endforelse
    </div>

    <!-- روابط التصفح بين الصفحات -->
    <div style="margin-top: 2rem;">
        {{ $products->links() }}
    </div>
</div>
@endsection