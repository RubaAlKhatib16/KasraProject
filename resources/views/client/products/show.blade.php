@extends('client.layouts.app')

@section('title', $product->name)

@section('content')
<div class="product-detail-page">
    <div class="container">
        <!-- القسم الرئيسي للمنتج -->
        <div class="product-main-grid">
            <!-- عمود معرض الصور -->
            <div class="product-gallery">
                <!-- الصورة الرئيسية الكبيرة -->
                <div class="main-image-container">
                    <img id="mainProductImage" src="{{ asset('storage/' . ($product->featured_image ?? 'default.jpg')) }}" alt="{{ $product->name }}" class="main-product-image">
                </div>

                <!-- الصور المصغرة (Thumbnails) - تظهر هنا صور متعددة -->
                <div class="thumbnail-list">
                    @php
                        // هنا يمكنك إضافة صور متعددة. مثال: استخدام حقل 'images' إذا كان موجوداً في قاعدة البيانات
                        // أو يمكنك تمرير مصفوفة من الصور من الكونترولر. هذا مجرد مثال توضيحي.
                        $additionalImages = [];
                        if(property_exists($product, 'images') && is_array($product->images)) {
                            $additionalImages = $product->images;
                        } else {
                            // صورة تجريبية إضافية - يمكنك إزالتها
                            $additionalImages = [
                                'storage/' . ($product->featured_image ?? 'default.jpg'),
                                'storage/' . ($product->featured_image ?? 'default.jpg')
                            ];
                        }
                    @endphp

                    @foreach($additionalImages as $index => $imgPath)
                    <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" data-image="{{ asset($imgPath) }}">
                        <img src="{{ asset($imgPath) }}" alt="صورة المنتج {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- عمود معلومات المنتج -->
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="product-price-section">
                    <div class="current-price">{{ number_format($product->price, 2) }} <span class="currency">د.أ</span></div>
                    @if($product->installments_count > 0)
                        <div class="installment-badge-detail">
                            <i class="fas fa-calendar-alt"></i>
                            أو ادفع على {{ $product->installments_count }} دفعات شهرية بقيمة {{ number_format($product->price / $product->installments_count, 2) }} د.أ/شهر
                        </div>
                    @endif
                </div>

                <div class="product-description">
                    <h3 class="section-subtitle">الوصف:</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="product-meta-info">
                    <div class="meta-item">
                        <i class="fas fa-tag"></i>
                        <span>التصنيف: <strong>{{ $product->category->name ?? 'بدون فئة' }}</strong></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-box"></i>
                        <span>حالة التوفر: <strong class="in-stock">متوفر في المخزون</strong></span>
                    </div>
                </div>

                @if($product->installments_count > 0)
                <div class="installment-plans">
                    <label for="installment_plan">اختر خطة الدفع المناسبة لك:</label>
                    <select id="installment_plan" class="installment-select">
                        <option value="0">دفع نقدي (مرة واحدة)</option>
                        @for($i = 3; $i <= $product->installments_count; $i+=3)
                            <option value="{{ $i }}">{{ $i }} دفعات شهرية ({{ number_format($product->price / $i, 2) }} د.أ/شهر)</option>
                        @endfor
                    </select>
                </div>
                @endif

                <!-- نموذج إضافة إلى السلة -->
                <form action="{{ route('cart.add', $product) }}" method="POST" id="addToCartForm">
                    @csrf
                    <div class="quantity-selector">
                        <label for="quantity">الكمية:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1">
                    </div>
                    <input type="hidden" name="installment_plan" id="installment_plan_input" value="0">
                    <button type="submit" class="btn-add-to-cart">
                        <i class="fas fa-shopping-cart"></i> أضف إلى السلة
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* استايلات صفحة تفاصيل المنتج - متوافقة مع علامة كِسرة */
.product-detail-page {
    padding: 2rem 0;
    min-height: calc(100vh - 200px);
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

/* شبكة التوزيع */
.product-main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    background: rgba(31, 41, 55, 0.5);
    backdrop-filter: blur(12px);
    border-radius: 32px;
    padding: 2rem;
    border: 1px solid rgba(233, 179, 251, 0.25);
}

/* معرض الصور */
.product-gallery {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.main-image-container {
    background: rgba(0, 0, 0, 0.2);
    border-radius: 24px;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.thumbnail-list {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 0.5rem;
}

.thumbnail-item {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s;
    background: rgba(0, 0, 0, 0.2);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-item.active {
    border-color: #FF4F8B;
    box-shadow: 0 0 0 2px rgba(255, 79, 139, 0.3);
}

/* معلومات المنتج */
.product-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.product-title {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
}

.product-price-section {
    background: rgba(255, 79, 139, 0.1);
    border-radius: 20px;
    padding: 1rem;
    border-right: 4px solid #FF4F8B;
}

.current-price {
    font-size: 2rem;
    font-weight: 800;
    color: #FFB3C7;
}

.currency {
    font-size: 1rem;
    font-weight: normal;
    color: #94A3B8;
}

.installment-badge-detail {
    margin-top: 0.5rem;
    font-size: 0.9rem;
    color: #A5D6A7;
    background: rgba(165, 214, 167, 0.1);
    padding: 0.3rem 0.8rem;
    border-radius: 40px;
    display: inline-block;
}

.product-description {
    color: #CBD5E1;
    line-height: 1.6;
}

.section-subtitle {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
}

.product-meta-info {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding: 1rem 0;
    border-top: 1px solid rgba(233, 179, 251, 0.2);
    border-bottom: 1px solid rgba(233, 179, 251, 0.2);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #94A3B8;
    font-size: 0.9rem;
}

.meta-item i {
    color: #FFB3C7;
    width: 20px;
}

.in-stock {
    color: #A5D6A7;
}

/* خيارات التقسيط */
.installment-plans {
    margin: 0.5rem 0;
}

.installment-plans label {
    display: block;
    margin-bottom: 0.5rem;
    color: white;
    font-weight: 500;
}

.installment-select {
    width: 100%;
    max-width: 300px;
    padding: 0.8rem 1rem;
    border-radius: 60px;
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(233, 179, 251, 0.3);
    color: white;
    font-family: inherit;
    cursor: pointer;
}

/* الكمية وزر الإضافة */
.quantity-selector {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1rem 0;
}

.quantity-selector label {
    color: white;
    font-weight: 500;
}

.quantity-selector input {
    width: 80px;
    padding: 0.6rem;
    border-radius: 60px;
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(233, 179, 251, 0.3);
    color: white;
    text-align: center;
}

.btn-add-to-cart {
    background: linear-gradient(105deg, #FF4F8B, #E6497D);
    border: none;
    padding: 1rem 2rem;
    border-radius: 60px;
    font-weight: 700;
    font-size: 1rem;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    width: 100%;
    font-family: inherit;
    box-shadow: 0 12px 25px -8px rgba(255, 79, 139, 0.4);
}

.btn-add-to-cart:hover {
    transform: translateY(-2px);
    background: linear-gradient(105deg, #ff3f79, #FF4F8B);
    box-shadow: 0 20px 30px -12px rgba(255, 79, 139, 0.6);
}

/* استجابة للشاشات الصغيرة */
@media (max-width: 900px) {
    .product-main-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .product-title {
        font-size: 1.6rem;
    }

    .current-price {
        font-size: 1.5rem;
    }
}

@media (max-width: 640px) {
    .product-detail-page {
        padding: 1rem 0;
    }

    .product-main-grid {
        padding: 1rem;
    }

    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
}
</style>
@endpush

@push('scripts')
<script>
    // معرض الصور المتعددة: تغيير الصورة الرئيسية عند النقر على الصورة المصغرة
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        const mainImage = document.getElementById('mainProductImage');

        if (thumbnails.length > 0) {
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    // إزالة التحديد النشط من جميع الصور المصغرة
                    thumbnails.forEach(t => t.classList.remove('active'));
                    // إضافة التحديد النشط للصورة الحالية
                    this.classList.add('active');

                    // تغيير الصورة الرئيسية
                    const newImageSrc = this.getAttribute('data-image');
                    if (newImageSrc) {
                        mainImage.src = newImageSrc;
                    }
                });
            });
        }

        // التعامل مع خطة التقسيط
        const select = document.getElementById('installment_plan');
        const hiddenInput = document.getElementById('installment_plan_input');
        if (select && hiddenInput) {
            select.addEventListener('change', function() {
                hiddenInput.value = this.value;
            });
        }
    });
</script>
@endpush