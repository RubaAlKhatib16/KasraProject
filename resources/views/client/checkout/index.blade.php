@extends('client.layouts.app')

@section('title', 'إتمام الطلب')

@section('content')
<div class="checkout-page">
    <div class="container">
        <div class="checkout-header">
            <h1 class="page-title">إتمام الطلب</h1>
            <p class="page-subtitle">أدخل بياناتك لإتمام عملية الشراء</p>
        </div>

        <div class="checkout-grid">
            <!-- نموذج معلومات العميل -->
            <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data" class="checkout-form">
                @csrf
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-user"></i> معلومات الشحن</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-user-circle"></i> الاسم الكامل *</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> البريد الإلكتروني *</label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt"></i> عنوان التوصيل *</label>
                            <input type="text" name="shipping_address" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-phone-alt"></i> رقم الهاتف *</label>
                            <input type="tel" name="phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-id-card"></i> رقم الهوية الوطنية *</label>
                            <input type="text" name="national_id" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-credit-card"></i> طريقة الدفع *</label>
                            <select name="payment_method" required>
                                <option value="cash">الدفع عند الاستلام</option>
                                <option value="card">بطاقة ائتمان / مدى</option>
                                <option value="installment">تقسيط عبر كِسرة</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-id-card"></i> صورة البطاقة الشخصية (جهة الأمام)</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="id_card_image" id="id_card_image" accept="image/*" class="file-input">
                            <label for="id_card_image" class="file-label"><i class="fas fa-cloud-upload-alt"></i> اختر الصورة</label>
                            <span class="file-name" id="fileName">لم يتم اختيار ملف</span>
                        </div>
                        <small class="form-hint">يُفضل رفع صورة واضحة لبطاقة الهوية (اختياري، ولكن يوصى به لتسريع الطلب).</small>
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                    <div class="form-group full-width">
                        <label><i class="fas fa-pen-alt"></i> ملاحظات إضافية</label>
                        <textarea name="notes" rows="3" placeholder="ملاحظات حول التوصيل أو المنتج..."></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit"><i class="fas fa-check-circle"></i> تأكيد الطلب</button>
                    <a href="{{ route('cart.index') }}" class="btn-back"><i class="fas fa-arrow-right"></i> العودة للسلة</a>
                </div>
            </form>

            <!-- ملخص الطلب (جانبي) -->
            <div class="order-summary">
                <h2 class="section-title"><i class="fas fa-shopping-bag"></i> ملخص الطلب</h2>
                <div class="summary-items">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                    <div class="summary-item">
                        <div class="item-info">
                            <span class="item-name">{{ $item['name'] }}</span>
                            <span class="item-quantity">x {{ $item['quantity'] }}</span>
                        </div>
                        <span class="item-price">{{ number_format($item['price'] * $item['quantity'], 2) }} د.أ</span>
                    </div>
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                </div>
                <div class="summary-total">
                    <span>المجموع الكلي</span>
                    <span class="total-price">{{ number_format($total, 2) }} د.أ</span>
                </div>
                <div class="summary-note">
                    <i class="fas fa-shield-alt"></i> بياناتك آمنة ومشفرة
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* جميع الاستايلات السابقة كما هي - أضفها هنا أو في ملف CSS منفصل */
.checkout-page {
    padding: 2rem 0;
    min-height: calc(100vh - 200px);
}
.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
}
.checkout-header {
    text-align: center;
    margin-bottom: 2.5rem;
}
.page-title {
    font-size: clamp(1.8rem, 5vw, 2.5rem);
    font-weight: 800;
    background: linear-gradient(135deg, #FFF, #E9B3FB);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    margin-bottom: 0.5rem;
}
.page-subtitle {
    color: #94A3B8;
    font-size: 1rem;
}
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2rem;
}
.checkout-form {
    background: rgba(31, 41, 55, 0.5);
    backdrop-filter: blur(12px);
    border-radius: 32px;
    padding: 2rem;
    border: 1px solid rgba(233, 179, 251, 0.25);
}
.form-section {
    margin-bottom: 2rem;
}
.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-right: 3px solid #FF4F8B;
    padding-right: 1rem;
}
.section-title i {
    color: #FFB3C7;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}
.form-group {
    margin-bottom: 1rem;
}
.form-group label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    font-weight: 600;
    color: #E9B3FB;
    margin-bottom: 0.4rem;
}
.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 60px;
    border: 1px solid rgba(233, 179, 251, 0.4);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    font-family: inherit;
    font-size: 0.9rem;
}
.form-group textarea {
    border-radius: 24px;
    resize: vertical;
}
.file-upload-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}
.file-input {
    display: none;
}
.file-label {
    background: rgba(255, 79, 139, 0.2);
    border: 1px solid rgba(233, 179, 251, 0.5);
    border-radius: 60px;
    padding: 0.6rem 1.2rem;
    cursor: pointer;
    color: #FFB3C7;
}
.file-label:hover {
    background: rgba(255, 79, 139, 0.4);
}
.file-name {
    color: #94A3B8;
    font-size: 0.8rem;
}
.image-preview {
    margin-top: 1rem;
    max-width: 200px;
    border-radius: 16px;
    overflow: hidden;
    display: none;
}
.image-preview img {
    width: 100%;
}
.form-hint {
    color: #A5D6A7;
    font-size: 0.7rem;
}
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}
.btn-submit {
    background: linear-gradient(105deg, #FF4F8B, #E6497D);
    border: none;
    padding: 0.9rem 2rem;
    border-radius: 60px;
    color: white;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
}
.btn-back {
    background: transparent;
    border: 1px solid rgba(233, 179, 251, 0.6);
    padding: 0.9rem 2rem;
    border-radius: 60px;
    color: #FFB3C7;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
}
.order-summary {
    background: rgba(20, 25, 40, 0.7);
    backdrop-filter: blur(12px);
    border-radius: 32px;
    padding: 1.8rem;
    border: 1px solid rgba(233, 179, 251, 0.25);
    height: fit-content;
    position: sticky;
    top: 2rem;
}
.summary-items {
    margin: 1.5rem 0;
    padding: 1rem 0;
    border-top: 1px solid rgba(233,179,251,0.2);
    border-bottom: 1px solid rgba(233,179,251,0.2);
}
.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 0.6rem 0;
    color: #CBD5E1;
}
.item-info {
    display: flex;
    gap: 0.8rem;
}
.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 1.2rem;
    font-weight: 800;
    margin-top: 1rem;
    color: white;
}
.total-price {
    color: #FF4F8B;
}
@media (max-width: 900px) {
    .checkout-grid { grid-template-columns: 1fr; }
    .order-summary { position: static; }
}
@media (max-width: 640px) {
    .form-row { grid-template-columns: 1fr; }
    .form-actions { flex-direction: column; }
}
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('id_card_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileNameSpan = document.getElementById('fileName');
        const previewContainer = document.getElementById('imagePreview');
        if (file) {
            fileNameSpan.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(event) {
                previewContainer.innerHTML = `<img src="${event.target.result}" alt="معاينة">`;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            fileNameSpan.textContent = 'لم يتم اختيار ملف';
            previewContainer.innerHTML = '';
            previewContainer.style.display = 'none';
        }
    });
</script>
@endpush