<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · تعديل المنتج</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
            color: #EDE9FE;
            padding: 2rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(31, 41, 55, 0.9);
            backdrop-filter: blur(16px);
            border-radius: 48px;
            border: 1px solid rgba(233, 179, 251, 0.4);
            padding: 2rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(120deg, #FFF, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }

        .full-width { grid-column: span 2; }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        label {
            font-weight: 700;
            color: #E9B3FB;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            letter-spacing: 0.3px;
        }

        label i { color: #FFB3C7; width: 20px; }

        input, textarea, select {
            padding: 0.75rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(233, 179, 251, 0.4);
            background: rgba(0, 0, 0, 0.5);
            color: #FFFFFF;
            font-family: inherit;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        input::placeholder, textarea::placeholder { color: rgba(255, 255, 255, 0.6); }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #FF4F8B;
            background: rgba(0, 0, 0, 0.7);
            box-shadow: 0 0 0 3px rgba(255, 79, 139, 0.2);
        }

        textarea { border-radius: 24px; resize: vertical; background: rgba(0, 0, 0, 0.5); color: #FFFFFF; }
        select option { background: #1F2937; color: #FFFFFF; }

        .checkbox-group { flex-direction: row; align-items: center; gap: 0.6rem; }
        .checkbox-group input { width: 18px; height: 18px; margin: 0; accent-color: #FF4F8B; }

        .btn-update {
            background: #FF4F8B;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-update:hover {
            background: #ff3373;
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
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: rgba(255, 179, 199, 0.15);
            border-color: #FFB3C7;
            color: #FFFFFF;
        }

        .actions { display: flex; gap: 1rem; margin-top: 1.5rem; justify-content: flex-start; }

        .error-msg {
            background: rgba(211, 47, 47, 0.25);
            border: 1px solid #f44336;
            padding: 0.8rem;
            border-radius: 60px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: #FFCDD2;
        }

        .current-image {
            margin-top: 0.5rem;
            background: rgba(0, 0, 0, 0.5);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.8rem;
            color: #E9B3FB;
        }

        .current-image a { color: #FFB3C7; text-decoration: none; }
        .current-image a:hover { text-decoration: underline; }

        hr { border-color: rgba(233, 179, 251, 0.2); margin: 1rem 0; }

        small { color: #A5D6A7; font-size: 0.7rem; display: block; margin-top: 0.3rem; }

        /* =====================================================
           حقل حد التنبيه — تمييز بصري خفيف
           ===================================================== */
        .threshold-group input {
            border-color: rgba(251, 191, 36, 0.4);
        }
        .threshold-group input:focus {
            border-color: #FCD34D;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.15);
        }
        .threshold-group label { color: #FCD34D; }
        .threshold-group label i { color: #FCD34D; }
        .threshold-group small { color: #FCD34D; opacity: 0.75; }
        /* ===================================================== */

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            body { padding: 1rem; }
            .container { padding: 1.5rem; }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-edit"></i> تعديل المنتج: {{ $product->name }}</h1>

        @if($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-triangle"></i>
            @foreach($errors->all() as $error) {{ $error }} <br> @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('seller.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">

                <div class="form-group">
                    <label><i class="fas fa-tag"></i> اسم المنتج *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-dollar-sign"></i> السعر (د.أ) *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-boxes"></i> المخزون</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
                </div>

                {{-- ===== حد التنبيه للمخزون — مضاف هنا ===== --}}
                <div class="form-group threshold-group">
                    <label><i class="fas fa-exclamation-triangle"></i> حد تنبيه المخزون</label>
                    <input
                        type="number"
                        name="low_stock_threshold"
                        value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}"
                        min="0"
                        placeholder="0"
                    >
                    <small>سيصلك تنبيه عندما يصل المخزون لهذا الرقم أو أقل. 0 = تنبيه عند النفاد فقط</small>
                </div>
                {{-- ============================================= --}}

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="is_active" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
                    <label for="is_active" style="margin:0;"><i class="fas fa-check-circle"></i> متاح</label>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tags"></i> الفئة</label>
                    <select name="category_id">
                        <option value="">-- اختر الفئة --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-calendar-alt"></i> عدد الأقساط المتاحة</label>
                    <input type="number" name="installments_count"
                        value="{{ old('installments_count', $product->installments_count) }}"
                        min="0" max="24">
                    <small>0 = غير متاح للتقسيط | 3 = 3 أقساط | 6 = 6 أقساط</small>
                </div>

                <div class="form-group full-width">
                    <label><i class="fas fa-align-right"></i> الوصف</label>
                    <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label><i class="fas fa-image"></i> الصورة الرئيسية</label>
                    @if($product->featured_image)
                    <div class="current-image">
                        <i class="fas fa-check-circle" style="color:#4caf50;"></i>
                        <span>الصورة الحالية موجودة</span>
                        <a href="{{ asset('storage/' . $product->featured_image) }}" target="_blank">(معاينة)</a>
                    </div>
                    <div id="deleted-images-container">
                        <input type="hidden" name="deleted_images" id="deleted_images" value="">
                    </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*">
                    <small>اتركه فارغاً إذا لم ترغب في تغيير الصورة</small>
                </div>

            </div>

            <hr>

            <div class="actions">
                <button type="submit" class="btn-update"><i class="fas fa-save"></i> تحديث المنتج</button>
                <a href="{{ route('seller.products.index') }}" class="btn-back"><i class="fas fa-arrow-right"></i> إلغاء</a>
            </div>
        </form>
    </div>
</body>

</html>