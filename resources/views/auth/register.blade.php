{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · إنشاء حساب جديد</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* كل الـ CSS الأصلي الذي أرسلته - أضعه هنا مع بعض التعديلات البسيطة لضمان عدم التعارض */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #1F2937;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }
        body::before, body::after { content: ''; position: fixed; width: 500px; height: 500px; border-radius: 50%; filter: blur(60px); pointer-events: none; z-index: 0; }
        body::before { top: -20%; right: -10%; background: radial-gradient(circle, rgba(255, 79, 139, 0.15) 0%, rgba(233, 179, 251, 0.05) 70%); }
        body::after { bottom: -15%; left: -5%; background: radial-gradient(circle, rgba(233, 179, 251, 0.1) 0%, rgba(255, 79, 139, 0.03) 70%); }
        .register-container {
            max-width: 580px; width: 100%; background: rgba(31, 41, 55, 0.5); backdrop-filter: blur(12px);
            border-radius: 48px; padding: 2.5rem; border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); position: relative; z-index: 1;
            transition: transform 0.3s ease;
        }
        .register-container:hover { transform: translateY(-5px); }
        .logo { display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 2rem; }
        .logo-icon { background: #FF4F8B; width: 50px; height: 50px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: white; }
        .logo-text { font-size: 2rem; font-weight: 800; color: white; }
        .register-header { text-align: center; margin-bottom: 2rem; }
        .register-header h1 { font-size: 1.8rem; font-weight: 800; color: white; margin-bottom: 0.5rem; }
        .register-header p { color: #EDE9FE; font-size: 0.95rem; }
        .progress-steps { display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative; }
        .progress-steps::before { content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: rgba(233, 179, 251, 0.3); transform: translateY(-50%); z-index: 1; }
        .step { position: relative; z-index: 2; background: rgba(31, 41, 55, 0.8); backdrop-filter: blur(4px); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; border: 2px solid rgba(233, 179, 251, 0.4); transition: all 0.3s; }
        .step.active { background: #FF4F8B; border-color: #FF4F8B; color: white; }
        .step.completed { background: rgba(255, 79, 139, 0.6); border-color: #FFB3C7; color: white; }
        .step-label { position: absolute; top: 100%; margin-top: 0.5rem; font-size: 0.7rem; font-weight: 600; color: #EDE9FE; white-space: nowrap; }
        .form-step { display: block; }
        .form-step.hidden { display: none !important; } /* important لتجاوز أي تعارض */
        .form-group { margin-bottom: 1.5rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-label { display: block; font-weight: 600; color: #EDE9FE; margin-bottom: 0.5rem; font-size: 0.9rem; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-icon { position: absolute; right: 1rem; color: #FFB3C7; font-size: 1rem; }
        .form-control { width: 100%; padding: 0.9rem 3rem 0.9rem 2.5rem; border: 1px solid rgba(233, 179, 251, 0.3); border-radius: 60px; font-size: 1rem; transition: all 0.3s; background: rgba(255, 255, 255, 0.1); color: white; font-family: inherit; }
        .form-control:focus { outline: none; border-color: #FF4F8B; background: rgba(255, 255, 255, 0.15); box-shadow: 0 0 0 4px rgba(255, 79, 139, 0.1); }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23FFB3C7' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: left 1rem center; background-size: 16px; }
        .toggle-password { position: absolute; left: 1rem; background: none; border: none; color: rgba(255, 255, 255, 0.6); cursor: pointer; font-size: 1rem; }
        .toggle-password:hover { color: #FFB3C7; }
        .password-strength { margin-top: 0.5rem; }
        .strength-bars { display: flex; gap: 0.3rem; margin-bottom: 0.3rem; }
        .strength-bar { height: 4px; flex: 1; background: rgba(233, 179, 251, 0.3); border-radius: 2px; transition: all 0.3s; }
        .strength-bar.active:nth-child(1) { background: #ef4444; }
        .strength-bar.active:nth-child(2) { background: #f59e0b; }
        .strength-bar.active:nth-child(3) { background: #10b981; }
        .strength-bar.active:nth-child(4) { background: #059669; }
        .strength-text { font-size: 0.7rem; color: #CBD5E6; }
        .terms-checkbox { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem; cursor: pointer; }
        .terms-checkbox input { width: 18px; height: 18px; cursor: pointer; accent-color: #FF4F8B; }
        .terms-checkbox span { color: #EDE9FE; font-size: 0.9rem; }
        .terms-checkbox a { color: #FFB3C7; text-decoration: none; font-weight: 600; }
        .terms-checkbox a:hover { color: #FF4F8B; }
        .btn-primary { width: 100%; background: #FF4F8B; color: white; border: none; padding: 0.9rem; border-radius: 60px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 8px 20px rgba(255, 79, 139, 0.3); display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1rem; }
        .btn-primary:hover { background: #ff3373; transform: scale(1.02); }
        .btn-secondary { width: 100%; background: transparent; border: 1px solid rgba(233, 179, 251, 0.6); padding: 0.9rem; border-radius: 60px; font-size: 1rem; font-weight: 600; color: #FFB3C7; cursor: pointer; transition: all 0.3s; }
        .btn-secondary:hover { border-color: #FF4F8B; background: rgba(255, 79, 139, 0.1); color: white; }
        .navigation-buttons { display: flex; gap: 1rem; margin-top: 1rem; }
        .navigation-buttons .btn-primary, .navigation-buttons .btn-secondary { margin-bottom: 0; width: auto; flex: 1; }
        .alert { padding: 0.8rem 1rem; border-radius: 60px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; font-size: 0.85rem; }
        .alert-success { background: rgba(46, 125, 50, 0.2); color: #A5D6A7; border: 1px solid rgba(76, 175, 80, 0.3); }
        .alert-error { background: rgba(211, 47, 47, 0.2); color: #FFCDD2; border: 1px solid rgba(244, 67, 54, 0.3); }
        .summary-box { background: rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 1rem; margin-bottom: 1rem; }
        .summary-box h4 { color: white; margin-bottom: 0.8rem; }
        .summary-box p { color: #EDE9FE; margin-bottom: 0.5rem; }
        .summary-box strong { color: #FFB3C7; }
        .login-link, .back-home { text-align: center; margin-top: 1.5rem; }
        .login-link a, .back-home a { color: #EDE9FE; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.3rem; }
        .login-link a:hover, .back-home a:hover { color: #FFB3C7; }
        .btn-primary.loading { position: relative; color: transparent; }
        .btn-primary.loading::after { content: ""; position: absolute; width: 20px; height: 20px; border: 2px solid white; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
        @media (max-width: 580px) { .register-container { padding: 1.5rem; } .logo-text { font-size: 1.6rem; } .step-label { font-size: 0.6rem; } .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="register-container">
    <div class="logo"><div class="logo-icon"><i class="fas fa-bolt"></i></div><span class="logo-text">كِسرة</span></div>
    <div class="register-header"><h1>إنشاء حساب جديد</h1><p>انضم إلى كِسرة واستمتع بمرونة الدفع</p></div>
    
    <div class="progress-steps">
        <div class="step active" id="step1">1<span class="step-label">المعلومات الأساسية</span></div>
        <div class="step" id="step2">2<span class="step-label">معلومات إضافية</span></div>
        <div class="step" id="step3">3<span class="step-label">تأكيد الحساب</span></div>
    </div>

    <div class="alert alert-success" id="successAlert" style="display: none;"><i class="fas fa-check-circle"></i><span></span></div>
    <div class="alert alert-error" id="errorAlert" style="display: none;"><i class="fas fa-exclamation-circle"></i><span id="errorMessage"></span></div>

    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        
        <!-- Step 1 -->
        <div class="form-step" id="step1-form">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">الاسم الأول</label>
                    <div class="input-wrapper"><i class="fas fa-user input-icon"></i><input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name') }}" required></div>
                </div>
                <div class="form-group">
                    <label class="form-label">الاسم الثاني</label>
                    <div class="input-wrapper"><i class="fas fa-user input-icon"></i><input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name') }}" required></div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">البريد الإلكتروني</label>
                <div class="input-wrapper"><i class="fas fa-envelope input-icon"></i><input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required></div>
            </div>
            <div class="form-group">
                <label class="form-label">رقم الهاتف</label>
                <div class="input-wrapper"><i class="fas fa-phone input-icon"></i><input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required></div>
            </div>
            <button type="button" class="btn-primary" id="nextStep1">التالي <i class="fas fa-arrow-left"></i></button>
        </div>

        <!-- Step 2 -->
        <div class="form-step hidden" id="step2-form">
            <div class="form-group">
                <label class="form-label">كلمة المرور</label>
                <div class="input-wrapper"><i class="fas fa-lock input-icon"></i><input type="password" class="form-control" id="password" name="password" oninput="checkPasswordStrength()" required><button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')"><i class="fas fa-eye" id="toggleIcon1"></i></button></div>
                <div class="password-strength" id="passwordStrength" style="display: none;"><div class="strength-bars"><div class="strength-bar" id="bar1"></div><div class="strength-bar" id="bar2"></div><div class="strength-bar" id="bar3"></div><div class="strength-bar" id="bar4"></div></div><span class="strength-text" id="strengthText">ضعيفة</span></div>
            </div>
            <div class="form-group">
                <label class="form-label">تأكيد كلمة المرور</label>
                <div class="input-wrapper"><i class="fas fa-lock input-icon"></i><input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required><button type="button" class="toggle-password" onclick="togglePassword('confirmPassword', 'toggleIcon2')"><i class="fas fa-eye" id="toggleIcon2"></i></button></div>
            </div>
            <div class="form-group">
                <label class="form-label">تاريخ الميلاد</label>
                <div class="input-wrapper"><i class="fas fa-calendar input-icon"></i><input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label">الجنس</label>
                <div class="input-wrapper"><i class="fas fa-venus-mars input-icon"></i><select class="form-control" id="gender" name="gender"><option value="">اختر...</option><option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>ذكر</option><option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>أنثى</option></select></div>
            </div>
            <div class="navigation-buttons">
                <button type="button" class="btn-secondary" id="prevStep2">السابق <i class="fas fa-arrow-right"></i></button>
                <button type="button" class="btn-primary" id="nextStep2">التالي <i class="fas fa-arrow-left"></i></button>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="form-step hidden" id="step3-form">
            <div class="form-group">
                <label class="form-label">الموافقة على الشروط</label>
                <label class="terms-checkbox"><input type="checkbox" id="terms" name="terms" value="1" required><span>أوافق على <a href="#">شروط الخدمة</a> و <a href="#">سياسة الخصوصية</a></span></label>
            </div>
            <div class="form-group">
                <label class="terms-checkbox"><input type="checkbox" id="marketing" name="marketing" value="1" {{ old('marketing') ? 'checked' : '' }}><span>أرغب في استلام العروض والتحديثات عبر البريد الإلكتروني</span></label>
            </div>
            <div class="summary-box"><h4>ملخص المعلومات</h4><p><strong>الاسم:</strong> <span id="summaryName"></span></p><p><strong>البريد:</strong> <span id="summaryEmail"></span></p><p><strong>الهاتف:</strong> <span id="summaryPhone"></span></p></div>
            <div class="navigation-buttons">
                <button type="button" class="btn-secondary" id="prevStep3">السابق <i class="fas fa-arrow-right"></i></button>
                <button type="submit" class="btn-primary" id="registerBtn">إنشاء الحساب <i class="fas fa-check"></i></button>
            </div>
        </div>
    </form>

    <div class="login-link">لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></div>
    <div class="back-home"><a href="{{ url('/') }}"><i class="fas fa-arrow-right"></i> العودة إلى الصفحة الرئيسية</a></div>
</div>

<script>
    // Helper functions
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') { input.type = 'text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
        else { input.type = 'password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
    }
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthDiv = document.getElementById('passwordStrength');
        const bars = ['bar1','bar2','bar3','bar4'].map(id=>document.getElementById(id));
        const strengthText = document.getElementById('strengthText');
        if(password.length===0){ strengthDiv.style.display='none'; return; }
        strengthDiv.style.display='block';
        bars.forEach(bar=>bar.classList.remove('active'));
        let strength=0;
        if(password.length>=8) strength++;
        if(password.length>=12) strength++;
        if(/[A-Z]/.test(password)) strength++;
        if(/[0-9]/.test(password)) strength++;
        if(/[^A-Za-z0-9]/.test(password)) strength++;
        for(let i=0;i<Math.min(strength,4);i++) bars[i].classList.add('active');
        if(strength<=2) strengthText.textContent='ضعيفة';
        else if(strength<=3) strengthText.textContent='متوسطة';
        else strengthText.textContent='قوية';
    }
    function showError(msg) {
        const alert = document.getElementById('errorAlert');
        document.getElementById('errorMessage').innerText = msg;
        alert.style.display='flex';
        setTimeout(()=>alert.style.display='none',4000);
    }
    function hideError() { document.getElementById('errorAlert').style.display='none'; }

    // State
    let currentStep = 1;
    const stepForms = {
        1: document.getElementById('step1-form'),
        2: document.getElementById('step2-form'),
        3: document.getElementById('step3-form')
    };
    const stepIndicators = {
        1: document.getElementById('step1'),
        2: document.getElementById('step2'),
        3: document.getElementById('step3')
    };

    function updateStepUI(step) {
        // Hide all forms
        for(let i=1;i<=3;i++) stepForms[i].classList.add('hidden');
        stepForms[step].classList.remove('hidden');
        // Update step circles
        for(let i=1;i<=3;i++) {
            if(i<step) stepIndicators[i].className = 'step completed';
            else if(i===step) stepIndicators[i].className = 'step active';
            else stepIndicators[i].className = 'step';
        }
        currentStep = step;
    }

    function validateStep1() {
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        if(!firstName || !lastName || !email || !phone) { showError('جميع الحقول مطلوبة'); return false; }
        if(!email.includes('@') || !email.includes('.')) { showError('البريد الإلكتروني غير صحيح'); return false; }
        if(phone.length < 10) { showError('رقم الهاتف يجب أن يكون 10 أرقام على الأقل'); return false; }
        hideError();
        return true;
    }
    function validateStep2() {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirmPassword').value;
        if(!password || !confirm) { showError('كلمة المرور وتأكيدها مطلوبة'); return false; }
        if(password.length < 8) { showError('كلمة المرور يجب أن تكون 8 أحرف على الأقل'); return false; }
        if(password !== confirm) { showError('كلمة المرور غير متطابقة'); return false; }
        hideError();
        return true;
    }
    function updateSummary() {
        document.getElementById('summaryName').innerText = 
            document.getElementById('firstName').value + ' ' + document.getElementById('lastName').value;
        document.getElementById('summaryEmail').innerText = document.getElementById('email').value;
        document.getElementById('summaryPhone').innerText = document.getElementById('phone').value;
    }

    // Event listeners
    document.getElementById('nextStep1').addEventListener('click', function() {
        if(validateStep1()) {
            updateStepUI(2);
        }
    });
    document.getElementById('nextStep2').addEventListener('click', function() {
        if(validateStep2()) {
            updateStepUI(3);
            updateSummary();
        }
    });
    document.getElementById('prevStep2').addEventListener('click', function() { updateStepUI(1); });
    document.getElementById('prevStep3').addEventListener('click', function() { updateStepUI(2); });

    // Handle form submission with AJAX (to avoid page reload and show success)
    const form = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const terms = document.getElementById('terms').checked;
        if(!terms) { showError('يجب الموافقة على الشروط والأحكام'); return; }
        
        registerBtn.classList.add('loading');
        registerBtn.disabled = true;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        try {
            const response = await fetch('{{ route("register") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if(result.success) {
                document.getElementById('successAlert').style.display = 'flex';
                setTimeout(()=>{ window.location.href = result.redirect || '/login'; }, 1500);
            } else {
                let errMsg = '';
                if(result.errors) for(let field in result.errors) errMsg += result.errors[field][0] + '\n';
                else errMsg = result.message || 'حدث خطأ';
                showError(errMsg);
                registerBtn.classList.remove('loading');
                registerBtn.disabled = false;
            }
        } catch(err) {
            showError('خطأ في الاتصال بالخادم');
            registerBtn.classList.remove('loading');
            registerBtn.disabled = false;
        }
    });

    // Optional: pre-fill for testing (comment out in production)
    // window.addEventListener('load', function() {
    //     document.getElementById('firstName').value = 'ربى';
    //     document.getElementById('lastName').value = 'الخطيب';
    //     document.getElementById('email').value = 'ruba@example.com';
    //     document.getElementById('phone').value = '0798706042';
    //     document.getElementById('password').value = 'Password123!';
    //     document.getElementById('confirmPassword').value = 'Password123!';
    //     document.getElementById('dob').value = '2002-10-16';
    //     document.getElementById('gender').value = 'female';
    //     checkPasswordStrength();
    // });
</script>
</body>
</html>