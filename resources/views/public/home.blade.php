<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · ادفع بطريقتك | تقسيط بدون فوائد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', 'Tahoma', sans-serif;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
            overflow-x: hidden;
        }

        /* شريط التنقل */
        .navbar {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto 2rem auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            background: rgba(31, 41, 55, 0.85);
            backdrop-filter: blur(12px);
            padding: 0.8rem 2rem;
            border-radius: 80px;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            background: #FF4F8B;
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .logo-text {
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #EDE9FE;
            font-weight: 600;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #FFB3C7;
        }

        .nav-buttons {
            display: flex;
            gap: 0.8rem;
        }

        .btn-login,
        .btn-register {
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-family: inherit;
            border: none;
        }

        .btn-login {
            background: transparent;
            border: 1px solid #FFB3C7;
            color: #FFB3C7;
        }

        .btn-login:hover {
            background: rgba(255, 179, 199, 0.1);
            transform: scale(1.02);
        }

        .btn-register {
            background: #FF4F8B;
            color: white;
            box-shadow: 0 4px 12px rgba(255, 79, 139, 0.3);
        }

        .btn-register:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        /* الهيرو */
        .hero {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 3rem;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            flex: 1.2;
            min-width: 300px;
        }

        .badge-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .trust-badge {
            background: rgba(233, 179, 251, 0.12);
            backdrop-filter: blur(2px);
            padding: 0.4rem 1rem;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #E9B3FB;
            border: 0.5px solid rgba(233, 179, 251, 0.3);
        }

        .trust-badge i {
            font-size: 0.8rem;
            color: #FFB3C7;
        }

        .rating {
            background: rgba(255, 179, 199, 0.1);
            padding: 0.4rem 1rem;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #FFB3C7;
        }

        .rating i {
            color: #FFB3C7;
            letter-spacing: 1px;
        }

        h1 {
            font-size: clamp(3rem, 8vw, 4.8rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: #FFFFFF;
            margin-bottom: 1.5rem;
        }

        .highlight {
            background: linear-gradient(120deg, #E9B3FB, #FFB3C7);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .subtitle {
            font-size: 1.2rem;
            line-height: 1.5;
            color: #EDE9FE;
            max-width: 90%;
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .cta-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background: #FF4F8B;
            border: none;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 10px 20px rgba(255, 79, 139, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
        }

        .btn-primary i {
            transition: transform 0.2s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background: #ff3373;
            box-shadow: 0 15px 25px rgba(255, 79, 139, 0.45);
        }

        .btn-primary:hover i {
            transform: translateX(-4px);
        }

        .link-secondary {
            color: #FFB3C7;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
            border-bottom: 1px dashed rgba(255, 179, 199, 0.4);
            padding-bottom: 2px;
        }

        .link-secondary:hover {
            color: #E9B3FB;
            gap: 10px;
        }

        .trust-footer {
            display: flex;
            align-items: center;
            gap: 1.8rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .trust-footer span {
            font-size: 0.85rem;
            color: #cbd5e6;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .trust-footer i {
            color: #FFB3C7;
            font-size: 0.9rem;
        }

        /* موكاب الجوال */
        .hero-visual {
            flex: 1;
            min-width: 320px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone-mockup {
            width: 100%;
            max-width: 360px;
            background: rgba(18, 25, 35, 0.6);
            backdrop-filter: blur(2px);
            border-radius: 48px;
            padding: 14px 12px 20px 12px;
            box-shadow: 0 35px 65px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(233, 179, 251, 0.2);
            transition: transform 0.3s ease;
            transform: translateY(-30px);
        }

        .phone-mockup:hover {
            transform: translateY(-40px);
        }

        .phone-screen {
            background: #ffffff;
            border-radius: 38px;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.05), 0 20px 35px -10px rgba(0, 0, 0, 0.2);
        }

        .app-ui {
            padding: 20px 18px 24px;
            background: linear-gradient(145deg, #FFFBFE 0%, #FEF6FB 100%);
        }

        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .app-logo {
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .app-badge {
            background: #FFB3C7;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #1F2937;
        }

        .product-row {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #FFFFFF;
            padding: 14px 16px;
            border-radius: 28px;
            margin-bottom: 24px;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #FFE7EF;
        }

        .product-icon {
            background: #EDE9FE;
            width: 56px;
            height: 56px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #FF4F8B;
        }

        .product-details h4 {
            font-weight: 800;
            font-size: 1rem;
            color: #1F2937;
        }

        .product-price {
            font-weight: 700;
            color: #FF4F8B;
            font-size: 1.1rem;
        }

        .installment-plan {
            background: #F8FAFE;
            border-radius: 28px;
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid #FFE4EF;
        }

        .installment-title {
            font-weight: 700;
            font-size: 0.85rem;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .pay-details {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1F2937;
        }

        .installment-badge {
            background: #FFB3C7;
            padding: 6px 14px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.8rem;
            color: #1F2937;
        }

        .schedule {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #5a6879;
            margin-top: 10px;
            flex-wrap: wrap;
            gap: 6px;
        }

        .progress-indicator {
            margin-top: 12px;
            height: 4px;
            background: #EDE9FE;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            width: 25%;
            height: 100%;
            background: #FF4F8B;
            border-radius: 4px;
        }

        .cta-micro {
            background: #FF4F8B;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 40px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
            cursor: default;
            margin-top: 8px;
        }

        /* خلفية ناعمة */
        .hero::before {
            content: '';
            position: fixed;
            top: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(233, 179, 251, 0.1) 0%, rgba(255, 179, 199, 0.05) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: fixed;
            bottom: -15%;
            left: -5%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(255, 79, 139, 0.08) 0%, rgba(233, 179, 251, 0.03) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        /* ===== قسم المميزات ===== */
        .features-section {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            text-align: center;
            background: transparent;
            padding: 0 1rem;
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.02em;
            margin-bottom: 0.75rem;
        }

        .section-header .subhead {
            font-size: 1.1rem;
            color: #EDE9FE;
            max-width: 560px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 2rem 1.8rem 2.2rem;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(233, 179, 251, 0.3);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 35px -12px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 79, 139, 0.2);
            border-color: rgba(255, 179, 199, 0.6);
        }

        .icon-wrapper {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.1), rgba(233, 179, 251, 0.15));
            width: 80px;
            height: 80px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: background 0.2s;
        }

        .feature-card:hover .icon-wrapper {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.15), rgba(233, 179, 251, 0.2));
        }

        .feature-card i {
            font-size: 2.4rem;
            color: #FF4F8B;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            font-size: 1rem;
            line-height: 1.5;
            color: #4b5563;
            max-width: 90%;
            margin: 0 auto;
        }

        .accent-line {
            width: 40px;
            height: 3px;
            background: #FFB3C7;
            border-radius: 4px;
            margin: 1.2rem auto 0;
            opacity: 0.4;
            transition: width 0.2s ease, opacity 0.2s;
        }

        .feature-card:hover .accent-line {
            width: 60px;
            opacity: 0.9;
            background: #FF4F8B;
        }

        /* ===== قسم "كيف تعمل كسرة" ===== */
        .how-it-works {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            text-align: center;

            border-radius: 48px;
            padding: 4rem 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .how-it-works .section-header h2 {
            color: #fafafa;
        }

        .how-it-works .section-header .subhead {
            color: #e9e9e9;
        }

        .steps-grid {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
        }

        .step-card {
            flex: 1;
            min-width: 240px;
            background: white;
            border-radius: 28px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(233, 179, 251, 0.3);
            position: relative;
            z-index: 2;
        }

        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 35px -12px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 79, 139, 0.15);
            border-color: rgba(255, 179, 199, 0.6);
        }

        .step-number {
            display: inline-block;
            font-size: 1rem;
            font-weight: 800;
            color: #FF4F8B;
            background: rgba(255, 79, 139, 0.08);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
        }

        .step-icon {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.08), rgba(233, 179, 251, 0.12));
            width: 80px;
            height: 80px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: background 0.2s;
        }

        .step-card:hover .step-icon {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.12), rgba(233, 179, 251, 0.18));
        }

        .step-icon i {
            font-size: 2.4rem;
            color: #FF4F8B;
        }

        .step-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 0.75rem;
        }

        .step-card p {
            font-size: 1rem;
            line-height: 1.5;
            color: #4b5563;
            max-width: 90%;
            margin: 0 auto;
        }

        /* ===== قسم المتاجر الشريكة ===== */
        .merchants-section {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            text-align: center;

            border-radius: 48px;
            padding: 4rem 2rem;
        }

        .merchants-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.02em;
            margin-bottom: 0.75rem;
        }

        .merchants-section .subhead {
            font-size: 1.1rem;
            color: #e0e0e0;
            max-width: 560px;
            margin: 0 auto 3rem;
        }

        .merchants-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.8rem;
        }

        .merchant-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            transform: translateY(40px);
            opacity: 0;
            cursor: pointer;
            aspect-ratio: 4 / 3;
        }

        .merchant-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .brand-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            color: #1F2937;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 79, 139, 0.3);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(2px);
        }

        .merchant-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 35px -12px rgba(0, 0, 0, 0.2);
        }

        .merchant-card:hover img {
            transform: scale(1.05);
        }

        .merchant-card:hover .brand-logo {
            background: #FF4F8B;
            color: white;
            border-color: white;
            transform: translate(-50%, -50%) scale(1.05);
        }

        /* ===== قسم البحث ===== */
        .search-section {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            position: relative;
            border-radius: 48px;
            padding: 5rem 2rem;
            text-align: center;
            overflow: hidden;
            background: transparent;
        }

        .search-content {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .search-content h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1.2rem;
        }

        .search-content p {
            font-size: 1.1rem;
            color: #e8e8e8;
            margin-bottom: 2rem;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 60px;
            padding: 0.3rem 0.3rem 0.3rem 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(233, 179, 251, 0.3);
            transition: all 0.3s ease;
        }

        .search-wrapper:focus-within {
            box-shadow: 0 12px 28px rgba(255, 79, 139, 0.15);
            border-color: #FFB3C7;
        }

        .search-wrapper i {
            color: #FFB3C7;
            font-size: 1.2rem;
            padding: 0 0.8rem;
        }

        .search-wrapper input {
            flex: 1;
            border: none;
            padding: 1rem 0;
            font-size: 1rem;
            font-family: inherit;
            background: transparent;
            outline: none;
            color: #1F2937;
        }

        .search-wrapper input::placeholder {
            color: #9ca3af;
        }

        .search-wrapper button {
            background: #FF4F8B;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .search-wrapper button:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        .floating-item {
            position: absolute;
            width: 90px;
            height: 90px;
            background: rgb(255, 255, 255);
            backdrop-filter: blur(8px);
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #FF4F8B;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: float 4s ease-in-out infinite;
            z-index: 1;
            opacity: 0.7;
            border: 1px solid rgba(255, 179, 199, 0.4);
        }

        .floating-item:hover {
            opacity: 1;
            transform: scale(1.08);
            backdrop-filter: blur(2px);
            background: white;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .item-1 {
            top: 12%;
            left: 5%;
            animation-duration: 5s;
        }

        .item-2 {
            top: 25%;
            right: 3%;
            animation-duration: 4.5s;
            animation-delay: 0.5s;
        }

        .item-3 {
            bottom: 18%;
            left: 8%;
            animation-duration: 5.5s;
            animation-delay: 1s;
        }

        .item-4 {
            bottom: 30%;
            right: 6%;
            animation-duration: 4s;
            animation-delay: 0.2s;
        }

        .item-5 {
            top: 40%;
            left: 12%;
            animation-duration: 6s;
            animation-delay: 0.8s;
        }

        .item-6 {
            bottom: 10%;
            right: 12%;
            animation-duration: 4.8s;
            animation-delay: 1.2s;
        }

        /* ===== قسم CTA ===== */
        .cta-section {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            text-align: center;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 4rem 2rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            background: radial-gradient(circle at center, rgba(255, 79, 139, 0.08) 0%, rgba(233, 179, 251, 0.02) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .cta-header {
            position: relative;
            z-index: 2;
            margin-bottom: 3rem;
        }

        .cta-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
        }

        .cta-header p {
            font-size: 1.1rem;
            color: #EDE9FE;
            max-width: 560px;
            margin: 0 auto;
        }

        .cards-grid {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .cta-card {
            flex: 1;
            min-width: 280px;
            max-width: 380px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(4px);
            border-radius: 32px;
            padding: 2rem 1.8rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 79, 139, 0.2);
        }

        .cta-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 45px -12px rgba(0, 0, 0, 0.3);
            border-color: #FF4F8B;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.12), rgba(233, 179, 251, 0.18));
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.3s;
        }

        .cta-card:hover .card-icon {
            background: linear-gradient(135deg, #FF4F8B, #FFB3C7);
            box-shadow: 0 8px 18px rgba(255, 79, 139, 0.3);
        }

        .cta-card:hover .card-icon i {
            color: white;
        }

        .card-icon i {
            font-size: 2.4rem;
            color: #FF4F8B;
            transition: color 0.3s;
        }

        .cta-card h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.75rem;
        }

        .cta-card p {
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .benefits-list {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.8rem;
        }

        .benefit {
            background: #F3F4F6;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #FF4F8B;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-cta {
            background: #FF4F8B;
            border: none;
            padding: 0.9rem 1.8rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            width: 100%;
            justify-content: center;
        }

        .btn-cta:hover {
            background: #ff3373;
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(255, 79, 139, 0.4);
        }

        /* ===== FOOTER ===== */
        .footer {
            max-width: 1280px;
            width: 100%;
            margin: 5rem auto 0;
            background: #1F2937;
            border-radius: 32px 32px 0 0;
            padding: 3rem 2rem 1.5rem;
            border-top: 1px solid rgba(233, 179, 251, 0.2);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .footer-brand p {
            color: #CBD5E6;
            font-size: 0.9rem;
            line-height: 1.6;
            margin: 1rem 0 1.2rem;
            max-width: 250px;
        }

        .trust-message {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 79, 139, 0.08);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.75rem;
            color: #FFB3C7;
        }

        .footer-col h4 {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col li {
            margin-bottom: 0.7rem;
        }

        .footer-col a {
            text-decoration: none;
            color: #CBD5E6;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .footer-col a:hover {
            color: #FF4F8B;
        }

        .newsletter {
            margin-top: 1rem;
        }

        .newsletter p {
            color: #CBD5E6;
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 60px;
            padding: 0.2rem;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .newsletter-form input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 0.6rem 1rem;
            color: white;
            font-family: inherit;
            font-size: 0.85rem;
            outline: none;
        }

        .newsletter-form input::placeholder {
            color: #9CA3AF;
        }

        .newsletter-form button {
            background: #FF4F8B;
            border: none;
            border-radius: 40px;
            padding: 0.6rem 1.2rem;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            font-size: 0.8rem;
        }

        .newsletter-form button:hover {
            background: #ff3373;
            transform: scale(1.02);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(233, 179, 251, 0.15);
            font-size: 0.8rem;
            color: #9CA3AF;
        }

        .social-icons {
            display: flex;
            gap: 1.2rem;
        }

        .social-icons a {
            color: #CBD5E6;
            font-size: 1.2rem;
            transition: all 0.2s;
        }

        .social-icons a:hover {
            color: #FF4F8B;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }

            .footer-brand {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-brand {
                grid-column: span 1;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 640px) {

            .merchants-grid,
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .brand-logo {
                width: 80px;
                height: 80px;
                font-size: 1rem;
            }

            .merchants-section,
            .how-it-works,
            .cta-section,
            .footer {
                padding: 2rem 1rem;
            }

            .feature-card,
            .step-card,
            .cta-card {
                padding: 1.5rem;
            }

            .icon-wrapper,
            .step-icon,
            .card-icon {
                width: 70px;
                height: 70px;
            }

            .step-icon i,
            .icon-wrapper i,
            .card-icon i {
                font-size: 2rem;
            }

            .step-card h3,
            .cta-card h3 {
                font-size: 1.3rem;
            }

            .phone-mockup {
                max-width: 300px;
            }

            .product-row {
                padding: 10px;
            }

            .app-ui {
                padding: 14px;
            }

            .nav-links {
                gap: 1rem;
            }

            .btn-login,
            .btn-register {
                padding: 0.4rem 1.2rem;
            }

            .search-content h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- شريط التنقل -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-bolt"></i></div>
            <span class="logo-text">كِسرة</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">الرئيسية</a>
            <a href="{{ route('public.how-it-works') }}">كيف تعمل</a>
            <a href="{{ route('public.stores') }}">المتاجر</a>
            <a href="{{ route('public.business') }}">للأعمال</a>
            <a href="{{ route('public.help') }}">المساعدة</a>
        </div>
        <div class="nav-buttons">
            @guest
            <button class="btn-login" onclick="window.location.href='{{ route('login') }}'">تسجيل الدخول</button>
            <button class="btn-register" onclick="window.location.href='{{ route('register') }}'">حساب جديد</button>
            @else
            @if(auth()->user()->role == 'seller')
            <button class="btn-login" onclick="window.location.href='{{ route('seller.dashboard') }}'">لوحة التحكم</button>
            @elseif(auth()->user()->role == 'customer')
            <button class="btn-login" onclick="window.location.href='{{ route('customer.dashboard') }}'">لوحة
                التحكم</button>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-register" style="background:#ff3373;">تسجيل الخروج</button>
            </form>
            @endguest
        </div>
    </nav>

    <!-- القسم الرئيسي (هيرو) -->
    <div class="hero">
        <div class="hero-content">
            <div class="badge-row">
                <div class="trust-badge">
                    <i class="fas fa-shield-alt"></i> <span>بدون رسوم خفية</span>
                </div>
                <div class="rating">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                    <span>٤.٨/٥ • أكثر من ١٠٠ ألف عميل</span>
                </div>
            </div>

            <h1>
                ادفع بطريقتك<br>
                مع <span class="highlight">كِسرة</span>
            </h1>

            <p class="subtitle">
                قسّطي مشترياتك بدون فوائد وبخطوات بسيطة — تجربة دفع سهلة وسريعة
            </p>

            <div class="cta-group">
                <button class="btn-primary" aria-label="ابدأ الآن"
                    onclick="window.location.href='{{ route('client.products.index') }}'">
                    ابدأ الآن <i class="fas fa-arrow-left"></i>
                </button>
                <a href="{{ route('public.how-it-works') }}" class="link-secondary">
                    اعرف المزيد <i class="fas fa-chevron-left"></i>
                </a>
            </div>

            <div class="trust-footer">
                <span><i class="fas fa-calendar-check"></i> بدون فوائد</span>
                <span><i class="fas fa-users"></i> أكثر من ١٠,٠٠٠ مستخدم</span>
                <span><i class="fas fa-lock"></i> دفع آمن</span>
            </div>
        </div>

        <div class="hero-visual">
            <div class="phone-mockup">
                <div class="phone-screen">
                    <div class="app-ui">
                        <div class="app-header">
                            <span class="app-logo">كِسرة</span>
                            <span class="app-badge">دفع مرن</span>
                        </div>

                        @if(isset($featuredProduct) && $featuredProduct)
                        <div class="product-row">
                            <div class="product-icon"><i class="fas fa-mobile-alt"></i></div>
                            <div class="product-details">
                                <h4>{{ $featuredProduct->name }}</h4>
                                <div class="product-price">{{ number_format($featuredProduct->price, 2) }} د.أردني</div>
                            </div>
                            <div
                                style="margin-right: auto; font-size: 0.75rem; background:#EDE9FE; padding:4px 10px; border-radius:30px;">
                                ✨ جديد</div>
                        </div>
                        <div class="installment-plan">
                            <div class="installment-title"><i class="far fa-credit-card" style="margin-left: 6px;"></i>
                                خطة السداد</div>
                            <div class="pay-details">
                                <span class="total-price">{{ number_format($featuredProduct->price, 2) }} د.أردني</span>
                                <span class="installment-badge">{{ $featuredProduct->installments_count ?? 4 }} دفعات
                                    بدون فوائد</span>
                            </div>
                            <div class="schedule">
                                @php
                                $installmentsCount = $featuredProduct->installments_count ?? 4;
                                $installmentAmount = $featuredProduct->price / $installmentsCount;
                                $weeks = [0, 2, 4, 6];
                                @endphp
                                @for($i = 0; $i < min($installmentsCount, 4); $i++)
                                    <span>{{ $i == 0 ? 'اليوم' : 'بعد ' . $weeks[$i] . ' أسابيع' }}:
                                    {{ number_format($installmentAmount, 2) }} د.أردني</span>
                                    @endfor
                            </div>
                            <div class="progress-indicator">
                                <div class="progress-fill" style="width: {{ (100 / $installmentsCount) }}%;"></div>
                            </div>
                            <div style="font-size: 0.7rem; color: #FF4F8B; margin-top: 12px;"><i
                                    class="fas fa-check-circle"></i> لا رسوم عند السداد في الموعد</div>
                        </div>
                        @else
                        <div style="padding: 1rem; text-align: center;">منتجات قريباً</div>
                        @endif

                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 0.7rem; font-weight: 600; color:#6C6F78;">قد يعجبك أيضاً</span>
                            <span style="font-size: 0.7rem; color:#FF4F8B;">+٢ خيارات</span>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <div style="background:#F2F0FE; padding: 6px 12px; border-radius: 28px; font-size: 0.7rem;">
                                <i class="fas fa-headphones"></i> ايربودز
                            </div>
                            <div style="background:#F2F0FE; padding: 6px 12px; border-radius: 28px; font-size: 0.7rem;">
                                <i class="fas fa-laptop"></i> ماك بوك
                            </div>
                        </div>
                        <div class="cta-micro">أكمل مع كسرة <i class="fas fa-arrow-left"></i></div>
                    </div>
                </div>
                <div
                    style="width: 130px; height: 24px; background: #1F2937; margin: -8px auto 0; border-radius: 0 0 20px 20px;">
                </div>
            </div>
        </div>
    </div>

    <!-- المميزات (ثابت) -->
    <section class="features-section">
        <div class="section-header">
            <h2>لماذا كسرة؟</h2>
            <div class="subhead">طريقة دفع شفافة ومرنة مصممة لتناسب احتياجاتك</div>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-wrapper"><i class="fas fa-percent"></i></div>
                <h3>بدون فوائد</h3>
                <p>قسّم مشترياتك بدون أي رسوم إضافية — ما تراه هو ما تدفعه.</p>
                <div class="accent-line"></div>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper"><i class="fas fa-bolt"></i></div>
                <h3>موافقة فورية</h3>
                <p>احصل على الموافقة في ثوانٍ، بدون أوراق أو انتظار.</p>
                <div class="accent-line"></div>
            </div>
            <div class="feature-card">
                <div class="icon-wrapper"><i class="fas fa-calendar-alt"></i></div>
                <h3>خطط مرنة</h3>
                <p>اختر الخطة التي تناسب أسلوب حياتك — ٣، ٦، أو ١٢ شهراً.</p>
                <div class="accent-line"></div>
            </div>
        </div>
    </section>

    <!-- كيف تعمل كسرة (ثابت) -->
    <section class="how-it-works">
        <div class="section-header">
            <h2>كيف تعمل كسرة؟</h2>
            <div class="subhead">ثلاث خطوات بسيطة لتجربة دفع مرنة وسلسة</div>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-mobile-alt"></i></div>
                <h3>اختر منتجك</h3>
                <p>تصفح المتاجر الشريكة واختر ما يناسب ذوقك</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h3>قسّم المبلغ</h3>
                <p>اختر عدد الدفعات المناسب لك بدون فوائد</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-calendar-check"></i></div>
                <h3>ادفع بمرور الوقت</h3>
                <p>أكمل دفعاتك بسلاسة مع تذكيرات ذكية</p>
            </div>
        </div>
    </section>

    <!-- المتاجر الشريكة (ديناميكية) -->
    <section class="merchants-section">
        <h2>تسوّق من متاجرك المفضلة</h2>
        <div class="subhead">آلاف العلامات التجارية تنتظرك — اختر منتجك وادفع بالتقسيط مع كسرة</div>
        <div class="merchants-grid">
            @forelse($featuredStores ?? [] as $store)
            <div class="merchant-card" onclick="window.location.href='{{ route('public.store-page', $store->id) }}'">
                <img src="{{ $store->logo ? asset('storage/' . $store->logo) : 'https://via.placeholder.com/600x450?text=' . urlencode($store->name) }}"
                    alt="{{ $store->name }}">
                <div class="brand-logo">{{ strtoupper(substr($store->name, 0, 3)) }}</div>
            </div>
            @empty
            <div class="merchant-card">
                <div class="brand-logo">قريباً</div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- قسم البحث (ثابت) -->
    <section class="search-section">
        <div class="search-content">
            <h1>اكتشف العروض الرائعة<br>وقسّم مشترياتك بسهولة</h1>
            <p>ابحث عن منتجك المفضل أو متجرك المفضل — وادفع بالتقسيط مع كسرة</p>
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="globalSearch" placeholder="ابحث عن منتج أو متجر...">
                <button
                    onclick="window.location.href='{{ route('client.products.index') }}?search='+document.getElementById('globalSearch').value">ابحث
                    الآن <i class="fas fa-arrow-left"></i></button>
            </div>
        </div>
        <div class="floating-item item-1"><i class="fas fa-shoe-prints"></i></div>
        <div class="floating-item item-2"><i class="fas fa-perfume"></i></div>
        <div class="floating-item item-3"><i class="fas fa-glasses"></i></div>
        <div class="floating-item item-4"><i class="fas fa-bag-shopping"></i></div>
        <div class="floating-item item-5"><i class="fas fa-watch"></i></div>
        <div class="floating-item item-6"><i class="fas fa-mobile-alt"></i></div>
    </section>

    <!-- قسم CTA (ثابت) -->
    <section class="cta-section">
        <div class="cta-header">
            <h2>ابدأ رحلتك مع كسرة اليوم</h2>
            <p>اختر كيف تريد استخدام كسرة — سواء للتسوق المريح أو لتنمية أعمالك</p>
        </div>
        <div class="cards-grid">
            <div class="cta-card">
                <div class="card-icon"><i class="fas fa-user-astronaut"></i></div>
                <h3>تسوق الآن</h3>
                <p>قسّم مشترياتك بسهولة بدون فوائد أو رسوم خفية</p>
                <div class="benefits-list">
                    <span class="benefit"><i class="fas fa-check-circle"></i> بدون فوائد</span>
                    <span class="benefit"><i class="fas fa-bolt"></i> موافقة فورية</span>
                    <span class="benefit"><i class="fas fa-mobile-alt"></i> تطبيق سهل</span>
                </div>
                <button class="btn-cta" onclick="window.location.href='{{ route('public.user') }}'">سجل كعميل
                    <i class="fas fa-arrow-left"></i></button>
            </div>
            <div class="cta-card">
                <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                <h3>انضم كتاجر</h3>
                <p>زد مبيعاتك وقدم خيارات دفع مرنة لعملائك</p>
                <div class="benefits-list">
                    <span class="benefit"><i class="fas fa-chart-line"></i> زيادة المبيعات</span>
                    <span class="benefit"><i class="fas fa-clock"></i> إعداد سريع</span>
                    <span class="benefit"><i class="fas fa-headset"></i> دعم متواصل</span>
                </div>
                <button class="btn-cta" onclick="window.location.href='{{ route('public.business') }}'">سجل كتاجر <i
                        class="fas fa-arrow-left"></i></button>
            </div>
        </div>
    </section>

    <!-- FOOTER (ثابت) -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo" style="justify-content: flex-start;">
                    <div class="logo-icon"><i class="fas fa-bolt"></i></div>
                    <span class="logo-text">كِسرة</span>
                </div>
                <p>قسّم مشترياتك بدون فوائد وبخطوات بسيطة — تجربة دفع مرنة وسريعة تناسب أسلوب حياتك.</p>
                <div class="trust-message">
                    <i class="fas fa-check-circle"></i> موثوق من قبل أكثر من ١٠٠ ألف عميل
                </div>
            </div>

            <div class="footer-col">
                <h4>العملاء</h4>
                <ul>
                    <li><a href="#">حسابي</a></li>
                    <li><a href="#">طلباتي</a></li>
                    <li><a href="#">كيف تعمل</a></li>
                    <li><a href="#">العروض</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>للتجار</h4>
                <ul>
                    <li><a href="#">انضم كتاجر</a></li>
                    <li><a href="#">لوحة التحكم</a></li>
                    <li><a href="#">الشروط التجارية</a></li>
                    <li><a href="#">مركز المطورين</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>الدعم</h4>
                <ul>
                    <li><a href="#">اتصل بنا</a></li>
                    <li><a href="#">الأسئلة الشائعة</a></li>
                    <li><a href="#">مركز المساعدة</a></li>
                    <li><a href="#">الأمان والخصوصية</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>قانوني</h4>
                <ul>
                    <li><a href="#">سياسة الخصوصية</a></li>
                    <li><a href="#">الشروط والأحكام</a></li>
                    <li><a href="#">الإفصاحات المالية</a></li>
                </ul>
                <div class="newsletter">
                    <p><i class="fas fa-envelope"></i> اشترك للحصول على العروض</p>
                    <div class="newsletter-form">
                        <input type="email" id="newsletterEmail" placeholder="بريدك الإلكتروني">
                        <button onclick="alert('شكراً للاشتراك!')">اشترك</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© {{ date('Y') }} كِسرة. جميع الحقوق محفوظة</div>
            <div class="social-icons">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // تأثير الظهور المتدرج لبطاقات المتاجر (نفس السكربت الأصلي)
        const merchantCards = document.querySelectorAll('.merchant-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, idx) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.transform = 'translateY(0)';
                        entry.target.style.opacity = '1';
                    }, idx * 120);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2,
            rootMargin: '0px 0px -20px 0px'
        });
        merchantCards.forEach(card => observer.observe(card));
        window.addEventListener('load', () => {
            merchantCards.forEach(card => {
                if (card.getBoundingClientRect().top < window.innerHeight - 100) {
                    card.style.transform = 'translateY(0)';
                    card.style.opacity = '1';
                }
            });
        });
    </script>
</body>

</html>