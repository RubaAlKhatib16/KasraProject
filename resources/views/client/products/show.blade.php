@extends('client.layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; background: rgba(31,41,55,0.5); backdrop-filter: blur(12px); border-radius: 28px; padding: 2rem; border: 1px solid rgba(233,179,251,0.25);">
        <!-- صورة المنتج -->
        <div style="display: flex; justify-content: center; align-items: center;">
            @if($product->featured_image)
                <img src="{{ asset('storage/' . $product->featured_image) }}" style="width: 100%; max-width: 400px; border-radius: 24px;">
            @else
                <i class="fas fa-image fa-5x" style="color:#FFB3C7;"></i>
            @endif
        </div>

        <!-- معلومات المنتج -->
        <div>
            <h1 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">{{ $product->name }}</h1>
            <p style="color: #EDE9FE; line-height: 1.6; margin-bottom: 1rem;">{{ $product->description }}</p>
            <div style="margin-bottom: 1rem;">
                <span style="background: rgba(255,79,139,0.2); padding: 0.3rem 1rem; border-radius: 40px;">{{ $product->category->name ?? 'بدون فئة' }}</span>
            </div>
            <div style="font-size: 1.5rem; font-weight: bold; color: #FFB3C7; margin-bottom: 1rem;">{{ number_format($product->price, 2) }} د.أ</div>

            @if($product->installments_count > 0)
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">اختر خطة التقسيط:</label>
                    <select id="installment_plan" style="padding: 0.5rem 1rem; border-radius: 60px; background: rgba(0,0,0,0.5); color: white; border: 1px solid rgba(233,179,251,0.3); width: 100%; max-width: 250px;">
                        <option value="0">دفع نقدي (بدون تقسيط)</option>
                        @for($i = 3; $i <= $product->installments_count; $i+=3)
                            <option value="{{ $i }}">{{ $i }} أقساط شهرية ({{ number_format($product->price / $i, 2) }} د.أ/شهر)</option>
                        @endfor
                    </select>
                </div>
            @endif

            <form action="{{ route('cart.add', $product) }}" method="POST" id="addToCartForm">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem;">الكمية:</label>
                    <input type="number" name="quantity" value="1" min="1" style="width: 100px; padding: 0.5rem; border-radius: 60px; background: rgba(0,0,0,0.5); border: 1px solid rgba(233,179,251,0.3); color: white;">
                </div>
                <input type="hidden" name="installment_plan" id="installment_plan_input" value="0">
                <button type="submit" style="background: #FF4F8B; border: none; padding: 0.8rem 2rem; border-radius: 60px; color: white; font-weight: bold; cursor: pointer; transition: 0.2s;">أضف إلى السلة</button>
            </form>
        </div>
    </div>
</div>

<script>
    const select = document.getElementById('installment_plan');
    const hiddenInput = document.getElementById('installment_plan_input');
    if (select) {
        select.addEventListener('change', function() {
            hiddenInput.value = this.value;
        });
    }
</script>
@endsection