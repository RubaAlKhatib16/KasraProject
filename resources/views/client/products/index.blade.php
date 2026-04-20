@extends('client.layouts.app')

@section('title', 'جميع المنتجات')

@section('content')
<div class="products-page">
    <div class="container">
        <!-- Header القسم -->
        <div class="page-header">
            <h1 class="page-title">
                تسوق أحدث <span class="gradient-text">التشكيلات</span>
            </h1>
            <p class="page-subtitle">
                اكتشف مجموعتنا المختارة بعناية من المنتجات العصرية.
            </p>
        </div>

        <!-- شريط الفلاتر والبحث -->
        <div class="filter-bar">
            <div class="filter-group">
                <span class="filter-label">التصنيف:</span>
                <div class="categories-wrapper">
                    <form method="GET" action="{{ route('client.products.index') }}" id="filterForm">
                        <select name="category" class="category-select" onchange="this.form.submit()">
                            <option value="">جميع الأقسام</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if(request('category'))
                            <a href="{{ route('client.products.index') }}" class="clear-filter-btn">
                                <i class="fas fa-times"></i> إلغاء الفلتر
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="sort-group">
                <span class="sort-label">ترتيب حسب:</span>
                <select class="sort-select">
                    <option>الأحدث</option>
                    <option>الأعلى سعراً</option>
                    <option>الأقل سعراً</option>
                </select>
            </div>
        </div>

        <!-- شبكة المنتجات (Grid Layout) -->
        <div class="products-grid">
            @forelse($products as $product)
            <div class="product-card">
                <a href="{{ route('client.products.show', $product->slug) }}" class="product-link">
                    <div class="product-image-wrapper">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="image-placeholder">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif

                        <!-- بطاقة القسط الشهري -->
                        @if($product->installments_count > 0)
                        <div class="installment-badge">
                            <i class="fas fa-calendar-alt"></i>
                            {{ number_format($product->price / $product->installments_count, 2) }} د.أ/شهر
                        </div>
                        @endif
                    </div>

                    <div class="product-info">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-price">{{ number_format($product->price, 2) }} <span class="currency">د.أ</span></p>

                        <div class="product-meta">
                            <span class="category-tag">
                                <i class="fas fa-tag"></i> {{ $product->category->name ?? 'بدون فئة' }}
                            </span>
                            <span class="explore-link">
                                تصفح المنتج <i class="fas fa-arrow-left"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-box-open fa-4x"></i>
                <p>لا توجد منتجات في هذا القسم حالياً</p>
                <a href="{{ route('client.products.index') }}" class="btn-reset">عرض جميع المنتجات</a>
            </div>
            @endforelse
        </div>

        <!-- روابط التصفح (Pagination) -->
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* --- استايلات صفحة المنتجات --- */
.products-page {
    padding: 3rem 0;
    background: #0B1120; /* لون الخلفية الأساسي */
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* Header */
.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: clamp(2rem, 5vw, 2.8rem);
    font-weight: 800;
    color: #FFFFFF;
    margin-bottom: 1rem;
}

.gradient-text {
    background: linear-gradient(135deg, #FF8CB0, #F0B5FF);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
}

.page-subtitle {
    color: #94A3B8;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

/* شريط الفلاتر */
.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 3rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(233, 179, 251, 0.2);
}

.filter-group, .sort-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.filter-label, .sort-label {
    color: #CBD5E1;
    font-weight: 500;
}

.category-select, .sort-select {
    background: rgba(31, 41, 55, 0.6);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(233, 179, 251, 0.3);
    border-radius: 60px;
    padding: 0.5rem 1.5rem;
    color: white;
    font-family: inherit;
    cursor: pointer;
    outline: none;
}

.clear-filter-btn {
    color: #FFB3C7;
    text-decoration: none;
    font-size: 0.85rem;
    transition: 0.2s;
}

.clear-filter-btn:hover {
    color: #FF4F8B;
}

/* شبكة المنتجات */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

/* البطاقة */
.product-card {
    background: rgba(31, 41, 55, 0.5);
    backdrop-filter: blur(12px);
    border-radius: 28px;
    border: 1px solid rgba(233, 179, 251, 0.25);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
}

.product-card:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 79, 139, 0.5);
    box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
}

.product-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

/* صورة المنتج */
.product-image-wrapper {
    position: relative;
    height: 240px;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.3);
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFB3C7;
}

/* badge التقسيط */
.installment-badge {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(4px);
    padding: 0.3rem 1rem;
    border-radius: 40px;
    font-size: 0.75rem;
    color: #A5D6A7;
    font-weight: 500;
    border: 1px solid rgba(165, 214, 167, 0.3);
}

.installment-badge i {
    margin-left: 0.4rem;
    font-size: 0.7rem;
}

/* معلومات المنتج */
.product-info {
    padding: 1.5rem;
}

.product-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #FFFFFF;
    margin-bottom: 0.5rem;
    line-height: 1.4;
    /* حد أقصى لعدد الأسطر */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-price {
    font-size: 1.4rem;
    font-weight: 800;
    color: #FFB3C7;
    margin-bottom: 1rem;
}

.currency {
    font-size: 0.9rem;
    font-weight: normal;
    color: #94A3B8;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0.5rem;
}

.category-tag {
    background: rgba(255, 79, 139, 0.15);
    padding: 0.2rem 0.8rem;
    border-radius: 40px;
    font-size: 0.7rem;
    color: #FFB3C7;
}

.category-tag i {
    margin-left: 0.3rem;
    font-size: 0.6rem;
}

.explore-link {
    font-size: 0.8rem;
    color: #94A3B8;
    transition: 0.2s;
}

.product-card:hover .explore-link {
    color: #FFB3C7;
}

.explore-link i {
    font-size: 0.7rem;
    transition: transform 0.2s;
}

.product-card:hover .explore-link i {
    transform: translateX(-4px);
}

/* حالة عدم وجود منتجات */
.empty-state {
    grid-column: 1/-1;
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(31, 41, 55, 0.3);
    border-radius: 32px;
    color: #94A3B8;
}

.empty-state i {
    color: #FFB3C7;
    margin-bottom: 1rem;
}

.btn-reset {
    display: inline-block;
    margin-top: 1rem;
    background: #FF4F8B;
    padding: 0.6rem 1.5rem;
    border-radius: 40px;
    color: white;
    text-decoration: none;
    font-weight: 600;
}

/* التصفح بين الصفحات */
.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* استايلات مخصصة لـ Laravel Pagination */
.pagination-wrapper .pagination {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    flex-wrap: wrap;
}

.pagination-wrapper .page-item .page-link {
    background: rgba(31, 41, 55, 0.6);
    border: 1px solid rgba(233, 179, 251, 0.3);
    padding: 0.5rem 1rem;
    border-radius: 12px;
    color: #CBD5E1;
    text-decoration: none;
    transition: 0.2s;
}

.pagination-wrapper .page-item.active .page-link {
    background: #FF4F8B;
    border-color: #FF4F8B;
    color: white;
}

.pagination-wrapper .page-item .page-link:hover {
    background: rgba(255, 79, 139, 0.2);
    color: white;
}

/* استجابة للشاشات الصغيرة */
@media (max-width: 768px) {
    .products-page {
        padding: 2rem 0;
    }

    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-group, .sort-group {
        justify-content: space-between;
    }

    .category-select, .sort-select {
        flex: 1;
    }

    .products-grid {
        gap: 1rem;
    }
}
</style>
@endpush