@extends('client.layouts.app')

@section('title', 'إنشاء متجر جديد - كِسرة')

@section('content')
<div class="create-store-page">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">أنشئ <span class="gradient-text">متجرك الآن</span></h1>
            <p class="page-subtitle">أطلق متجرك على منصة كِسرة وابدأ البيع بسهولة</p>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('store.store') }}" class="store-form">
                @csrf

                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-store"></i> اسم المتجر <span class="required">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="مثال: متجر الإلكترونيات الحديثة">
                    @error('name')
                        <span class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        <i class="fas fa-align-left"></i> وصف المتجر
                    </label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="وصف مختصر عن متجرك ونشاطك التجاري...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-text"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check-circle"></i> إنشاء المتجر
                    </button>
                    <a href="{{ route('seller.dashboard') }}" class="btn-back">
                        <i class="fas fa-arrow-right"></i> إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* === نفس استايلات become-seller === */
.create-store-page {
    padding: 3rem 0;
    min-height: calc(100vh - 200px);
}
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1.5rem;
}
.page-header {
    text-align: center;
    margin-bottom: 2rem;
}
.page-title {
    font-size: clamp(1.8rem, 5vw, 2.5rem);
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
}
.gradient-text {
    background: linear-gradient(135deg, #FF8CB0, #F0B5FF);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
}
.page-subtitle {
    color: #94A3B8;
    font-size: 1rem;
}
.form-container {
    background: rgba(31, 41, 55, 0.6);
    backdrop-filter: blur(12px);
    border-radius: 32px;
    padding: 2rem;
    border: 1px solid rgba(233, 179, 251, 0.3);
}
.form-group {
    margin-bottom: 1.5rem;
}
.form-group label {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #E9B3FB;
    margin-bottom: 0.5rem;
}
.required {
    color: #FF4F8B;
    margin-right: 0.2rem;
}
.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    border-radius: 60px;
    border: 1px solid rgba(233, 179, 251, 0.4);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    font-family: inherit;
    font-size: 0.95rem;
    transition: 0.2s;
}
textarea.form-control {
    border-radius: 24px;
    resize: vertical;
}
.form-control:focus {
    outline: none;
    border-color: #FF4F8B;
    background: rgba(0, 0, 0, 0.7);
    box-shadow: 0 0 0 3px rgba(255, 79, 139, 0.2);
}
.error-text {
    display: block;
    margin-top: 0.4rem;
    font-size: 0.75rem;
    color: #FFB3C7;
}
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}
.btn-submit {
    background: linear-gradient(105deg, #FF4F8B, #E6497D);
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 60px;
    color: white;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    transition: 0.2s;
    font-family: inherit;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 79, 139, 0.4);
}
.btn-back {
    background: transparent;
    border: 1px solid rgba(233, 179, 251, 0.6);
    padding: 0.8rem 2rem;
    border-radius: 60px;
    color: #FFB3C7;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    transition: 0.2s;
}
.btn-back:hover {
    background: rgba(255, 179, 199, 0.15);
    border-color: #FFB3C7;
    color: white;
}
@media (max-width: 640px) {
    .form-actions {
        flex-direction: column;
    }
    .btn-submit, .btn-back {
        justify-content: center;
    }
    .form-container {
        padding: 1.5rem;
    }
}
</style>
@endpush