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
                <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data"
                    class="checkout-form" id="checkoutForm">
                    @csrf

                    <!-- ===== معلومات الشحن ===== -->
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
                            <div class="form-group" id="nationalIdGroup">
                                <label><i class="fas fa-id-card"></i> رقم الهوية الوطنية *</label>
                                <input type="text" name="national_id" id="nationalIdInput" maxlength="10"
                                    inputmode="numeric" pattern="\d{10}" placeholder="أدخل 10 أرقام" required>
                                <small class="id-feedback" id="idFeedback"></small>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-credit-card"></i> طريقة الدفع *</label>
                                <select name="payment_method" id="paymentMethodSelect" required>
                                    <option value="cash">الدفع عند الاستلام</option>
                                    <option value="card">بطاقة فيزا / ماستركارد</option>
                                    <option value="installment">تقسيط كِسرة (فيزا)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-id-card"></i> صورة البطاقة الشخصية (جهة الأمام)</label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="id_card_image" id="id_card_image" accept="image/*"
                                    class="file-input">
                                <label for="id_card_image" class="file-label"><i class="fas fa-cloud-upload-alt"></i> اختر
                                    الصورة</label>
                                <span class="file-name" id="fileName">لم يتم اختيار ملف</span>
                            </div>
                            <small class="form-hint">يُفضل رفع صورة واضحة لبطاقة الهوية (اختياري).</small>
                            <div id="imagePreview" class="image-preview"></div>
                        </div>

                        <div class="form-group full-width">
                            <label><i class="fas fa-pen-alt"></i> ملاحظات إضافية</label>
                            <textarea name="notes" rows="3" placeholder="ملاحظات حول التوصيل أو المنتج..."></textarea>
                        </div>
                    </div>

                    <!-- ===== قسم بطاقة الفيزا (يظهر عند اختيار card أو installment) ===== -->
                    <div class="form-section visa-section" id="visaSection" style="display:none;">
                        <h2 class="section-title"><i class="fas fa-credit-card"></i> بيانات البطاقة البنكية</h2>

                        <!-- معاينة البطاقة البصرية -->
                        <div class="card-preview-wrapper">
                            <div class="credit-card" id="creditCardPreview">
                                <div class="card-top">
                                    <div class="card-chip">
                                        <div class="chip-lines"></div>
                                    </div>
                                    <div class="card-network" id="cardNetworkLogo">
                                        <i class="fab fa-cc-visa"></i>
                                    </div>
                                </div>
                                <div class="card-number-display" id="cardNumberDisplay">
                                    •••• &nbsp; •••• &nbsp; •••• &nbsp; ••••
                                </div>
                                <div class="card-bottom">
                                    <div>
                                        <div class="card-label">اسم حامل البطاقة</div>
                                        <div class="card-holder-display" id="cardHolderDisplay">الاسم الكامل</div>
                                    </div>
                                    <div>
                                        <div class="card-label">تاريخ الانتهاء</div>
                                        <div class="card-expiry-display" id="cardExpiryDisplay">MM / YY</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- حقول البطاقة -->
                        <div class="form-group">
                            <label><i class="fas fa-hashtag"></i> رقم البطاقة *</label>
                            <div class="card-input-wrapper">
                                <input type="text" id="cardNumber" name="card_number" placeholder="0000  0000  0000  0000"
                                    maxlength="19" inputmode="numeric" autocomplete="cc-number">
                                <span class="card-type-icon" id="cardTypeIcon">
                                    <i class="fab fa-cc-visa"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-user"></i> اسم حامل البطاقة *</label>
                            <input type="text" id="cardHolder" name="card_holder" placeholder="الاسم كما هو على البطاقة"
                                autocomplete="cc-name" style="text-transform:uppercase">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt"></i> تاريخ الانتهاء *</label>
                                <input type="text" id="cardExpiry" name="card_expiry" placeholder="MM / YY" maxlength="7"
                                    inputmode="numeric" autocomplete="cc-exp">
                            </div>
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-lock"></i> CVV *
                                    <span class="cvv-hint" title="3 أرقام خلف البطاقة">
                                        <i class="fas fa-question-circle"></i>
                                    </span>
                                </label>
                                <div class="card-input-wrapper">
                                    <input type="password" id="cardCvv" name="card_cvv" placeholder="•••" maxlength="4"
                                        inputmode="numeric" autocomplete="cc-csc">
                                    <span class="cvv-toggle" id="cvvToggle" title="إظهار / إخفاء">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- شريط الأمان -->
                        <div class="security-bar">
                            <i class="fas fa-shield-alt"></i>
                            <span>بياناتك محمية بتشفير SSL — هذه بيئة محاكاة تجريبية</span>
                            <div class="security-logos">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                            </div>
                        </div>
                    </div>

                    <!-- ===== أزرار الإرسال ===== -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit" id="submitBtn">
                            <i class="fas fa-check-circle"></i>
                            <span id="submitBtnText">تأكيد الطلب</span>
                        </button>
                        <a href="{{ route('cart.index') }}" class="btn-back">
                            <i class="fas fa-arrow-right"></i> العودة للسلة
                        </a>
                    </div>
                </form>

                <!-- ملخص الطلب -->
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(233, 179, 251, 0.4);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-family: inherit;
            font-size: 0.9rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: rgba(233, 179, 251, 0.8);
            box-shadow: 0 0 0 3px rgba(233, 179, 251, 0.1);
        }

        .form-group textarea {
            border-radius: 24px;
            resize: vertical;
        }

        /* رقم الهوية */
        #nationalIdInput {
            letter-spacing: 0.15em;
            font-size: 1rem;
            font-weight: 600;
        }

        #nationalIdInput.is-valid {
            border-color: #4ADE80 !important;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.15) !important;
        }

        #nationalIdInput.is-invalid {
            border-color: #FF6B6B !important;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.15) !important;
        }

        .id-feedback {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.35rem;
            min-height: 1rem;
            padding-right: 0.25rem;
        }

        .id-feedback.success {
            color: #4ADE80;
        }

        .id-feedback.error {
            color: #FF6B6B;
        }

        /* ===== VISA SECTION ===== */
        .visa-section {
            background: rgba(15, 20, 35, 0.6);
            border-radius: 28px;
            padding: 1.5rem;
            border: 1px solid rgba(233, 179, 251, 0.2);
            animation: fadeIn 0.35s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* معاينة البطاقة */
        .card-preview-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.8rem;
        }

        .credit-card {
            width: 340px;
            height: 200px;
            background: linear-gradient(135deg, #1a1a3e 0%, #2d1b69 50%, #1a1a3e 100%);
            border-radius: 20px;
            padding: 1.4rem 1.6rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .credit-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(233, 179, 251, 0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .credit-card:hover {
            transform: translateY(-4px) rotateX(3deg);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-chip {
            width: 44px;
            height: 34px;
            background: linear-gradient(135deg, #d4a843, #f0c860, #b8893a);
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .chip-lines::before,
        .chip-lines::after {
            content: '';
            position: absolute;
            background: rgba(0, 0, 0, 0.25);
        }

        .chip-lines::before {
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            transform: translateY(-50%);
        }

        .chip-lines::after {
            left: 50%;
            top: 0;
            bottom: 0;
            width: 1px;
            transform: translateX(-50%);
        }

        .card-network {
            font-size: 2.2rem;
            color: white;
            opacity: 0.9;
        }

        .card-number-display {
            font-size: 1.2rem;
            letter-spacing: 0.18em;
            color: white;
            font-weight: 600;
            text-align: center;
            font-family: 'Courier New', monospace;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .card-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .card-label {
            font-size: 0.55rem;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 2px;
        }

        .card-holder-display {
            font-size: 0.85rem;
            color: white;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-expiry-display {
            font-size: 0.85rem;
            color: white;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        /* حقول البطاقة */
        .card-input-wrapper {
            position: relative;
        }

        .card-input-wrapper input {
            padding-left: 3rem !important;
        }

        .card-type-icon,
        .cvv-toggle {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #FFB3C7;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .cvv-toggle {
            pointer-events: all;
            cursor: pointer;
            font-size: 1rem;
        }

        #cardNumber {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.12em;
            font-size: 1rem;
        }

        #cardExpiry {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.1em;
        }

        #cardCvv {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.15em;
        }

        /* شريط الأمان */
        .security-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
            border-radius: 12px;
            padding: 0.7rem 1rem;
            color: #86EFAC;
            font-size: 0.8rem;
            margin-top: 1rem;
        }

        .security-bar i:first-child {
            color: #4ADE80;
            font-size: 1rem;
        }

        .security-bar span {
            flex: 1;
        }

        .security-logos {
            display: flex;
            gap: 0.5rem;
            font-size: 1.5rem;
            color: white;
            opacity: 0.6;
        }

        .cvv-hint {
            cursor: help;
            color: #94A3B8;
            font-size: 0.8rem;
            margin-right: 4px;
        }

        /* ملف البطاقة */
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
            transition: background 0.2s;
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

        /* أزرار */
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
            transition: opacity 0.2s, transform 0.2s;
            font-family: inherit;
        }

        .btn-submit:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        /* ملخص الطلب */
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
            border-top: 1px solid rgba(233, 179, 251, 0.2);
            border-bottom: 1px solid rgba(233, 179, 251, 0.2);
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

        .summary-note {
            margin-top: 1rem;
            color: #64748B;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        @media (max-width: 900px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: static;
            }

            .credit-card {
                width: 100%;
                max-width: 340px;
            }
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // ============================================================
        //  خوارزمية التحقق من رقم الهوية الوطنية الأردنية
        // ============================================================
        function validateJordanianNationalId(id) {
            id = id.trim();
            if (!/^\d{10}$/.test(id)) return { valid: false, message: 'رقم الهوية يجب أن يكون 10 أرقام' };
            const firstDigit = parseInt(id[0]);


            if (![1, 2, 9].includes(firstDigit)) return { valid: false, message: 'رقم الهوية غير صحيح' };


            return { valid: true, message: '✓ رقم الهوية صحيح' };
        }

        const nationalIdInput = document.getElementById('nationalIdInput');
        const idFeedback = document.getElementById('idFeedback');

        nationalIdInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
            const val = this.value;
            if (!val.length) { clearFeedback(); return; }
            if (val.length < 10) { setFeedback('error', `أدخل ${10 - val.length} أرقام إضافية`); setInputState('neutral'); return; }
            const result = validateJordanianNationalId(val);
            result.valid ? (setFeedback('success', result.message), setInputState('valid'))
                : (setFeedback('error', result.message), setInputState('invalid'));
        });

        nationalIdInput.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text');
            this.value = pasted.replace(/\D/g, '').slice(0, 10);
            this.dispatchEvent(new Event('input'));
        });

        function setFeedback(type, msg) { idFeedback.textContent = msg; idFeedback.className = 'id-feedback ' + type; }
        function clearFeedback() { idFeedback.textContent = ''; idFeedback.className = 'id-feedback'; nationalIdInput.classList.remove('is-valid', 'is-invalid'); }
        function setInputState(state) {
            nationalIdInput.classList.remove('is-valid', 'is-invalid');
            if (state === 'valid') nationalIdInput.classList.add('is-valid');
            if (state === 'invalid') nationalIdInput.classList.add('is-invalid');
        }

        // ============================================================
        //  إظهار / إخفاء قسم الفيزا حسب طريقة الدفع
        // ============================================================
        const paymentSelect = document.getElementById('paymentMethodSelect');
        const visaSection = document.getElementById('visaSection');
        const submitBtnText = document.getElementById('submitBtnText');
        const cardNumber = document.getElementById('cardNumber');
        const cardHolder = document.getElementById('cardHolder');
        const cardExpiry = document.getElementById('cardExpiry');
        const cardCvv = document.getElementById('cardCvv');

        function toggleVisaSection() {
            const method = paymentSelect.value;
            const needsVisa = method === 'card' || method === 'installment';

            visaSection.style.display = needsVisa ? 'block' : 'none';

            // تغيير نص الزر
            if (method === 'cash') submitBtnText.textContent = 'تأكيد الطلب (دفع عند الاستلام)';
            if (method === 'card') submitBtnText.textContent = 'الدفع الآن بالبطاقة';
            if (method === 'installment') submitBtnText.textContent = 'تأكيد التقسيط والدفع';

            // required فقط لما القسم ظاهر
            [cardNumber, cardHolder, cardExpiry, cardCvv].forEach(el => {
                el.required = needsVisa;
            });
        }

        paymentSelect.addEventListener('change', toggleVisaSection);
        toggleVisaSection(); // تشغيل مرة عند التحميل

        // ============================================================
        //  معاينة البطاقة البصرية (live preview)
        // ============================================================
        const cardNumberDisplay = document.getElementById('cardNumberDisplay');
        const cardHolderDisplay = document.getElementById('cardHolderDisplay');
        const cardExpiryDisplay = document.getElementById('cardExpiryDisplay');
        const cardNetworkLogo = document.getElementById('cardNetworkLogo');
        const cardTypeIcon = document.getElementById('cardTypeIcon');

        // رقم البطاقة — تنسيق تلقائي بمسافات كل 4 أرقام
        cardNumber.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, '').slice(0, 16);
            // مسافة واحدة بس بين كل 4 أرقام (مش مسافتين)
            this.value = val.replace(/(.{4})(?=.)/g, '$1 ').trim();

            // تحديد نوع البطاقة
            const raw = val;
            let networkHtml = '<i class="fab fa-cc-visa"></i>';
            if (/^5[1-5]/.test(raw)) networkHtml = '<i class="fab fa-cc-mastercard"></i>';
            else if (/^4/.test(raw)) networkHtml = '<i class="fab fa-cc-visa"></i>';
            else if (/^3[47]/.test(raw)) networkHtml = '<i class="fab fa-cc-amex"></i>';

            cardNetworkLogo.innerHTML = networkHtml;
            cardTypeIcon.innerHTML = networkHtml;

            // عرض الأرقام على البطاقة
            const display = val.padEnd(16, '•');
            cardNumberDisplay.innerHTML =
                display.slice(0, 4) + ' &nbsp; ' +
                display.slice(4, 8) + ' &nbsp; ' +
                display.slice(8, 12) + ' &nbsp; ' +
                display.slice(12, 16);
        });

        // اسم حامل البطاقة
        cardHolder.addEventListener('input', function () {
            cardHolderDisplay.textContent = this.value.toUpperCase() || 'الاسم الكامل';
        });

        // تاريخ الانتهاء — إضافة / تلقائياً
        cardExpiry.addEventListener('input', function () {
            let val = this.value.replace(/\D/g, '').slice(0, 4);
            if (val.length >= 3) val = val.slice(0, 2) + ' / ' + val.slice(2);
            this.value = val;
            cardExpiryDisplay.textContent = val || 'MM / YY';
        });

        // CVV toggle إظهار/إخفاء
        document.getElementById('cvvToggle').addEventListener('click', function () {
            const input = document.getElementById('cardCvv');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        });

        // ============================================================
        //  منع إرسال الفورم لو الفيزا مطلوبة وفيها مشاكل
        // ============================================================
        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            // تحقق من الهوية
            const idResult = validateJordanianNationalId(nationalIdInput.value);
            if (!idResult.valid) {
                e.preventDefault();
                nationalIdInput.focus();
                setFeedback('error', idResult.message);
                setInputState('invalid');
                nationalIdInput.style.animation = 'shake 0.4s ease';
                setTimeout(() => nationalIdInput.style.animation = '', 400);
                return;
            }

            const method = paymentSelect.value;
            if (method === 'card' || method === 'installment') {
                // تحقق بسيط من رقم البطاقة (16 رقم)
                const raw = cardNumber.value.replace(/\D/g, '');
                if (raw.length !== 16) {
                    e.preventDefault();
                    cardNumber.focus();
                    cardNumber.style.borderColor = '#FF6B6B';
                    return;
                }
                // تحقق من تاريخ الانتهاء
                const expVal = cardExpiry.value.replace(/\D/g, '');
                if (expVal.length !== 4) {
                    e.preventDefault();
                    cardExpiry.focus();
                    cardExpiry.style.borderColor = '#FF6B6B';
                    return;
                }
                // تحقق من CVV
                const cvvVal = cardCvv.value.replace(/\D/g, '');
                if (cvvVal.length < 3) {
                    e.preventDefault();
                    cardCvv.focus();
                    cardCvv.style.borderColor = '#FF6B6B';
                    return;
                }
            }
        });

        // ============================================================
        //  معاينة صورة البطاقة الشخصية
        // ============================================================
        document.getElementById('id_card_image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const fileNameSpan = document.getElementById('fileName');
            const previewContainer = document.getElementById('imagePreview');
            if (file) {
                fileNameSpan.textContent = file.name;
                const reader = new FileReader();
                reader.onload = ev => {
                    previewContainer.innerHTML = `<img src="${ev.target.result}" alt="معاينة">`;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileNameSpan.textContent = 'لم يتم اختيار ملف';
                previewContainer.innerHTML = '';
                previewContainer.style.display = 'none';
            }
        });

        // Animation shake
        const style = document.createElement('style');
        style.textContent = `@keyframes shake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-8px)} 40%{transform:translateX(8px)} 60%{transform:translateX(-5px)} 80%{transform:translateX(5px)} }`;
        document.head.appendChild(style);
    </script>
@endpush