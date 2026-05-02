<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>كِسرة · منصة مالية تفهمك | تسوّق الآن وادفع لاحقاً</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* كل الـ CSS من الملف الأصلي (تم نسخه بالكامل) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2937;
            font-family: 'Cairo', 'Tahoma', sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            overflow-x: hidden;
        }

        .main-wrapper {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 3rem;
        }

        .glass-card {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 79, 139, 0.15) 0%, rgba(233, 179, 251, 0.05) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }

        .glass-card::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -5%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(233, 179, 251, 0.1) 0%, rgba(255, 79, 139, 0.03) 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }

        .user-hero {
            width: 100%;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .star-deco {
            position: absolute;
            font-size: 1.5rem;
            color: rgba(255, 179, 199, 0.2);
            pointer-events: none;
            z-index: 0;
        }

        .star-1 {
            top: 15%;
            left: 5%;
            animation: floatStar 8s infinite;
        }

        .star-2 {
            bottom: 20%;
            right: 8%;
            animation: floatStar 10s infinite reverse;
        }

        .star-3 {
            top: 40%;
            right: 15%;
            animation: floatStar 12s infinite;
        }

        .star-4 {
            bottom: 10%;
            left: 12%;
            animation: floatStar 9s infinite alternate;
        }

        @keyframes floatStar {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(8deg);
            }
        }

        .hero-split {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 3rem;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            flex: 1;
            min-width: 300px;
        }

        .hero-content h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.2rem;
            letter-spacing: -0.02em;
        }

        .hero-content .highlight {
            background: linear-gradient(120deg, #FF4F8B, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .hero-content p {
            font-size: 1.15rem;
            color: #EDE9FE;
            max-width: 520px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .cta-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: #FF4F8B;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            font-family: inherit;
            box-shadow: 0 8px 20px rgba(255, 79, 139, 0.3);
        }

        .btn-primary:hover {
            background: #ff3373;
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(255, 79, 139, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid rgba(233, 179, 251, 0.6);
            padding: 0.9rem 1.8rem;
            border-radius: 60px;
            font-weight: 600;
            color: #FFB3C7;
            transition: all 0.2s;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
        }

        .btn-secondary:hover {
            border-color: #FF4F8B;
            background: rgba(255, 79, 139, 0.1);
            color: white;
        }

        .trust-indicators {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #CBD5E6;
        }

        .trust-item i {
            color: #FFB3C7;
            font-size: 1rem;
        }

        .hero-visual {
            flex: 1;
            min-width: 300px;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .laptop-mockup {
            position: relative;
            width: 100%;
            max-width: 550px;
            animation: floatLaptop 6s ease-in-out infinite;
        }

        @keyframes floatLaptop {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .laptop {
            background: #111827;
            border-radius: 24px 24px 12px 12px;
            overflow: hidden;
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(233, 179, 251, 0.3);
            transition: transform 0.3s;
        }

        .laptop:hover {
            transform: translateY(-5px);
        }

        .screen {
            background: #F8FAFC;
            padding: 1rem;
            border-bottom: 2px solid #E5E7EB;
        }

        .browser-bar {
            display: flex;
            gap: 0.5rem;
            padding-bottom: 0.8rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #E5E7EB;
        }

        .browser-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #FF5F57;
        }

        .browser-dot:nth-child(2) {
            background: #FFBD2E;
        }

        .browser-dot:nth-child(3) {
            background: #28C840;
        }

        .website-preview {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .product-row {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: white;
            border-radius: 20px;
            padding: 0.8rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            border: 1px solid #F1F5F9;
        }

        .product-img {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.1), rgba(233, 179, 251, 0.12));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #FF4F8B;
        }

        .product-details {
            flex: 1;
        }

        .product-details h4 {
            font-size: 0.9rem;
            font-weight: 800;
            color: #1F2937;
        }

        .product-price {
            font-weight: 700;
            color: #FF4F8B;
            font-size: 0.9rem;
        }

        .installment-badge {
            background: #FFE9F0;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #FF4F8B;
        }

        .payment-option {
            background: #F3F4F6;
            border-radius: 20px;
            padding: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #E5E7EB;
        }

        .payment-left {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .payment-left i {
            font-size: 1.2rem;
            color: #FF4F8B;
        }

        .payment-text {
            font-weight: 600;
            font-size: 0.85rem;
            color: #1F2937;
        }

        .payment-amount {
            font-weight: 700;
            color: #FF4F8B;
            font-size: 0.85rem;
        }

        .laptop-base {
            width: 90%;
            height: 8px;
            background: #0F172A;
            margin: 0 auto;
            border-radius: 0 0 12px 12px;
        }

        .bg-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle at 30% 40%, rgba(255, 79, 139, 0.2), rgba(233, 179, 251, 0.1));
            filter: blur(60px);
            z-index: -1;
            border-radius: 50%;
        }

        /* Benefits Section */
        .benefits-section {
            width: 100%;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 2.8rem;
            position: relative;
            z-index: 2;
        }

        .section-header h2 {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 800;
            color: white;
            margin-bottom: 0.8rem;
        }

        .section-header .highlight {
            background: linear-gradient(120deg, #FF4F8B, #E9B3FB);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .section-header p {
            font-size: 1rem;
            color: #EDE9FE;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            position: relative;
            z-index: 2;
        }

        .benefit-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(4px);
            border-radius: 32px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .benefit-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 79, 139, 0.6);
            box-shadow: 0 18px 30px -12px rgba(0, 0, 0, 0.4);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.1), rgba(233, 179, 251, 0.15));
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            transition: all 0.3s;
        }

        .benefit-card:hover .card-icon {
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.15), rgba(233, 179, 251, 0.2));
        }

        .card-icon i {
            font-size: 2.2rem;
            color: #FFB3C7;
        }

        .benefit-card h3 {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
        }

        .benefit-card p {
            font-size: 0.95rem;
            color: #CBD5E6;
            line-height: 1.5;
        }

        .accent-line {
            width: 40px;
            height: 3px;
            background: #FFB3C7;
            border-radius: 4px;
            margin: 1.2rem auto 0;
            opacity: 0.5;
            transition: all 0.3s;
        }

        .benefit-card:hover .accent-line {
            width: 60px;
            opacity: 0.9;
            background: #FF4F8B;
        }

        /* How to Pay Section */
        .how-to-pay {
            width: 100%;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .split-layout {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3rem;
            position: relative;
            z-index: 2;
        }

        .title-area {
            flex: 1;
            min-width: 250px;
        }

        .title-area h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }

        .title-area .subtitle {
            font-size: 1rem;
            color: #EDE9FE;
            margin-top: 0.5rem;
        }

        .steps-card {
            flex: 1;
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(4px);
            border-radius: 32px;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .steps-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 79, 139, 0.4);
        }

        .step {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .step:last-child {
            margin-bottom: 0;
        }

        .step-number {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, rgba(255, 79, 139, 0.15), rgba(233, 179, 251, 0.2));
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 800;
            color: #FFB3C7;
        }

        .step-content {
            flex: 1;
        }

        .step-content h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.25rem;
        }

        .step-content p {
            font-size: 0.9rem;
            color: #CBD5E6;
            line-height: 1.5;
        }

        /* Features Section */
        .features-section {
            width: 100%;
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(12px);
            border-radius: 64px;
            padding: 3rem 2rem;
            border: 1px solid rgba(233, 179, 251, 0.25);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .feature-block {
            display: flex;
            align-items: center;
            gap: 4rem;
            margin-bottom: 5rem;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .feature-block.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-block.reverse {
            flex-direction: row-reverse;
        }

        .feature-block:last-child {
            margin-bottom: 0;
        }

        .feature-image {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .mockup {
            background: rgba(18, 25, 35, 0.6);
            backdrop-filter: blur(8px);
            border-radius: 28px;
            padding: 1rem;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(233, 179, 251, 0.3);
            transition: transform 0.3s ease;
            animation: floatImage 5s ease-in-out infinite;
            width: 100%;
            max-width: 500px;
        }

        .mockup:hover {
            transform: translateY(-5px);
        }

        @keyframes floatImage {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .mockup-content,
        .dashboard-mockup {
            background: rgba(18, 25, 35, 0.4);
            border-radius: 20px;
            padding: 1rem;
        }

        .product-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 0.6rem;
            text-align: center;
            border: 1px solid rgba(233, 179, 251, 0.2);
        }

        .product-title,
        .product-price {
            color: white;
        }

        .checkout-row,
        .payment-options>div {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(233, 179, 251, 0.2);
            color: #EDE9FE;
        }

        .payment-card {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(233, 179, 251, 0.2);
            color: white;
        }

        .feature-text h3 {
            color: white;
        }

        .feature-text p {
            color: #EDE9FE;
        }

        .feature-btn {
            border-color: #FFB3C7;
            color: #FFB3C7;
        }

        .feature-btn:hover {
            background: #FF4F8B;
            color: white;
            border-color: #FF4F8B;
        }

        /* Responsive */
        @media (max-width: 900px) {
            body {
                padding: 1rem;
            }

            .user-hero,
            .benefits-section,
            .how-to-pay,
            .features-section {
                padding: 2rem 1.5rem;
            }

            .hero-split,
            .split-layout {
                flex-direction: column;
                text-align: center;
            }

            .hero-content,
            .title-area {
                text-align: center;
            }

            .cta-group,
            .trust-indicators {
                justify-content: center;
            }

            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .feature-block,
            .feature-block.reverse {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .step {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .step-number {
                margin-bottom: 0.5rem;
            }

            .laptop-mockup,
            .mockup {
                max-width: 450px;
            }
        }

        @media (max-width: 640px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .product-row,
            .payment-option {
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
            }

            .feature-text h3 {
                font-size: 1.5rem;
            }

            .hero-content h1 {
                font-size: 2rem;
            }
        }

        /* Navbar */
        .navbar {
            max-width: 1280px;
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

        /* Footer */
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
    <!-- Navigation -->
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
                <a href="{{ route('login') }}" class="btn-login" style="text-decoration: none;">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="btn-register" style="text-decoration: none;">حساب جديد</a>
            @else
                @if(auth()->user()->role == 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="btn-login" style="text-decoration: none;">لوحة التحكم</a>
                @else
                    <a href="{{ route('customer.dashboard') }}" class="btn-login" style="text-decoration: none;">لوحة التحكم</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-register" style="background:#ff3373; border:none; cursor:pointer;">تسجيل الخروج</button>
                </form>
            @endguest
        </div>
    </nav>

    <div class="main-wrapper">
        <!-- Hero Section -->
        <div class="user-hero">
            <div class="star-deco star-1"><i class="fas fa-star"></i></div>
            <div class="star-deco star-2"><i class="fas fa-star"></i></div>
            <div class="star-deco star-3"><i class="fas fa-star"></i></div>
            <div class="star-deco star-4"><i class="fas fa-star"></i></div>

            <div class="hero-split">
                <div class="hero-content">
                    <h1>
                        منصة مالية<br>
                        <span class="highlight">تفهمك</span>
                    </h1>
                    <p>
                        تسوّق الآن وادفع لاحقًا بسهولة، وقسّط مشترياتك بطريقة تناسبك — كل ذلك من خلال موقع كِسرة
                    </p>
                    <div class="cta-group">
                        <button class="btn-primary" onclick="window.location.href='{{ route('register') }}'">
                            ابدأ الآن <i class="fas fa-arrow-left"></i>
                        </button>
                        <button class="btn-secondary" onclick="window.location.href='{{ route('public.stores') }}'">
                            تصفح المتاجر <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="trust-indicators">
                        <div class="trust-item"><i class="fas fa-check-circle"></i> بدون فوائد</div>
                        <div class="trust-item"><i class="fas fa-shield-alt"></i> دفع آمن</div>
                        <div class="trust-item"><i class="fas fa-clock"></i> موافقة فورية</div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bg-shape"></div>
                    <div class="laptop-mockup">
                        <div class="laptop">
                            <div class="screen">
                                <div class="browser-bar">
                                    <div class="browser-dot"></div>
                                    <div class="browser-dot"></div>
                                    <div class="browser-dot"></div>
                                </div>
                                <div class="website-preview">
                                    <div class="product-row">
                                        <div class="product-img"><i class="fas fa-mobile-alt"></i></div>
                                        <div class="product-details">
                                            <h4>آيفون ١٥ برو</h4>
                                            <div class="product-price">٤,٩٩٩ د.أردني</div>
                                        </div>
                                        <div class="installment-badge">٤ دفعات</div>
                                    </div>
                                    <div class="product-row">
                                        <div class="product-img"><i class="fas fa-laptop"></i></div>
                                        <div class="product-details">
                                            <h4>ماك بوك برو M3</h4>
                                            <div class="product-price">٧,٩٩٩ د.أردني</div>
                                        </div>
                                        <div class="installment-badge">٦ دفعات</div>
                                    </div>
                                    <div class="payment-option">
                                        <div class="payment-left">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span class="payment-text">ادفع مع كِسرة</span>
                                        </div>
                                        <div class="payment-amount">٤ دفعات بدون فوائد</div>
                                    </div>
                                </div>
                            </div>
                            <div class="laptop-base"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="benefits-section">
            <div class="section-header">
                <h2>لماذا <span class="highlight">كِسرة</span>؟</h2>
                <p>قسّم مشترياتك واستمتع بتجربة تسوق مرنة وآمنة</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>تحكم بمدفوعاتك بسهولة</h3>
                    <p>قسّم مشترياتك، تابع دفعاتك، وخطط مصاريفك بكل راحة</p>
                    <div class="accent-line"></div>
                </div>
                <div class="benefit-card">
                    <div class="card-icon"><i class="fas fa-store"></i></div>
                    <h3>آلاف المتاجر بين يديك</h3>
                    <p>تسوّق من مجموعة واسعة من المتاجر واكتشف أفضل العروض</p>
                    <div class="accent-line"></div>
                </div>
                <div class="benefit-card">
                    <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>دفع مرن وآمن</h3>
                    <p>ادفع على دفعات بدون تعقيد وبطريقة آمنة وسهلة</p>
                    <div class="accent-line"></div>
                </div>
            </div>
        </div>

        <!-- How to Pay Section -->
        <div class="how-to-pay">
            <div class="split-layout">
                <div class="title-area">
                    <h2>كيف تدفع مع كِسرة؟</h2>
                    <div class="subtitle">عملية بسيطة وسريعة للدفع أونلاين</div>
                </div>
                <div class="steps-card">
                    <div class="step">
                        <div class="step-number">01</div>
                        <div class="step-content">
                            <h4>اختر كِسرة كوسيلة دفع عند إتمام الطلب</h4>
                            <p>في صفحة الدفع، اختر "كِسرة" من قائمة طرق الدفع المتاحة.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">02</div>
                        <div class="step-content">
                            <h4>سجّل دخولك أو أنشئ حساب باستخدام رقم هاتفك</h4>
                            <p>أدخل رقم هاتفك لتسجيل الدخول أو إنشاء حساب جديد بسهولة.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">03</div>
                        <div class="step-content">
                            <h4>اختر خطة الدفع المناسبة لك (تقسيط)</h4>
                            <p>اختر عدد الدفعات التي تناسب ميزانيتك – بدون فوائد أو رسوم خفية.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">04</div>
                        <div class="step-content">
                            <h4>أكمل عملية الشراء وابدأ الدفع على دفعات</h4>
                            <p>أكمل طلبك واستلم منتجك، ثم ادفع المبلغ على دفعات محددة.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section">
            <div class="star-deco star-1" style="top: 5%; left: 3%;"><i class="fas fa-star"></i></div>
            <div class="star-deco star-2" style="bottom: 5%; right: 3%;"><i class="fas fa-star"></i></div>

            <div class="feature-block" id="feature1">
                <div class="feature-image">
                    <div class="mockup">
                        <div class="browser-bar">
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                        </div>
                        <div class="mockup-content">
                            <div class="product-grid"
                                style="display: grid; grid-template-columns: repeat(2,1fr); gap:0.8rem;">
                                <div class="product-item">
                                    <div class="product-icon"><i class="fas fa-mobile-alt"></i></div>
                                    <div class="product-title">آيفون ١٥</div>
                                    <div class="product-price">٤,٩٩٩</div>
                                </div>
                                <div class="product-item">
                                    <div class="product-icon"><i class="fas fa-tshirt"></i></div>
                                    <div class="product-title">تيشرت</div>
                                    <div class="product-price">١٥٠</div>
                                </div>
                                <div class="product-item">
                                    <div class="product-icon"><i class="fas fa-laptop"></i></div>
                                    <div class="product-title">ماك بوك</div>
                                    <div class="product-price">٧,٩٩٩</div>
                                </div>
                                <div class="product-item">
                                    <div class="product-icon"><i class="fas fa-watch"></i></div>
                                    <div class="product-title">ساعة ذكية</div>
                                    <div class="product-price">١,٢٩٩</div>
                                </div>
                            </div>
                            <div class="checkout-row" style="margin-top: 1rem;">
                                <span>إجمالي السلة</span>
                                <span>١٤,٩٤٧ د.أردني</span>
                            </div>
                            <div class="checkout-row" style="margin-top: 0.5rem;">
                                <span>ادفع مع كِسرة</span>
                                <span class="kasra-badge" style="background: rgba(255,79,139,0.2);">٤ دفعات</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature-text">
                    <h3>اكتشف متاجرك المفضلة</h3>
                    <p>تسوّق من مجموعة واسعة من المتاجر بسهولة، واكتشف أفضل المنتجات والعروض</p>
                    <button class="feature-btn" onclick="window.location.href='{{ route('public.stores') }}'">تصفح المتاجر <i class="fas fa-arrow-left"></i></button>
                </div>
            </div>

            <div class="feature-block reverse" id="feature2">
                <div class="feature-image">
                    <div class="mockup">
                        <div class="browser-bar">
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                        </div>
                        <div class="mockup-content">
                            <div class="payment-options"
                                style="background: rgb(0, 0, 0); border-radius: 16px; padding: 0.8rem;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                    <span style="color: white;">طريقة الدفع</span>
                                    <span class="kasra-badge" style="background: rgb(255, 79, 138);">مُوصى به</span>
                                </div>
                                <div
                                    style="background: rgb(255, 255, 255); border-radius: 16px; padding: 0.8rem; margin-bottom: 0.8rem;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-calendar-alt" style="color: #FF4F8B;"></i>
                                        <span style="font-weight: 600; color: white;">قسّم مع كِسرة</span>
                                    </div>
                                    <div style="font-size: 0.8rem; color: #CBD5E6; margin-top: 0.3rem;">٤ دفعات بدون
                                        فوائد</div>
                                </div>
                                <div
                                    style="background: rgba(0,0,0,0.2); border: 1px solid rgb(233, 179, 251); border-radius: 16px; padding: 0.8rem;">
                                    <div style="color: white;"><i class="fas fa-credit-card"></i> بطاقة ائتمان</div>
                                    <div style="font-size: 0.7rem; color: #9CA3AF;">دفعة واحدة</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature-text">
                    <h3>ادفع بطريقتك</h3>
                    <p>اختر طريقة الدفع التي تناسبك، وقسّط مشترياتك بكل مرونة</p>
                    <button class="feature-btn" onclick="window.location.href='{{ route('register') }}'">ابدأ الآن <i class="fas fa-arrow-left"></i></button>
                </div>
            </div>

            <div class="feature-block" id="feature3">
                <div class="feature-image">
                    <div class="mockup">
                        <div class="browser-bar">
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                            <div class="browser-dot"></div>
                        </div>
                        <div class="dashboard-mockup">
                            <div class="payment-card">
                                <div>قسط iPhone 15 Pro</div>
                                <div class="payment-status">مدفوع</div>
                            </div>
                            <div class="payment-card">
                                <div>قسط MacBook Pro</div>
                                <div class="payment-status due">مستحق خلال ٣ أيام</div>
                            </div>
                            <div class="payment-card">
                                <div>قسط ساعة ذكية</div>
                                <div class="payment-status">مدفوع</div>
                            </div>
                            <div class="progress-indicator">
                                <i class="fas fa-chart-line"></i> باقي ١,٤٩٩ د.أردني من إجمالي ٣,٩٩٩ د.أردني
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feature-text">
                    <h3>تحكم بمدفوعاتك</h3>
                    <p>تابع دفعاتك، واعرف مواعيد السداد، وخطط مصاريفك بسهولة</p>
                    <button class="feature-btn" onclick="window.location.href='{{ route('customer.dashboard') }}'">عرض التفاصيل <i class="fas fa-arrow-left"></i></button>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
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
                            <input type="email" placeholder="بريدك الإلكتروني">
                            <button>اشترك</button>
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
    </div>

    <script>
        // Scroll animation for feature blocks
        const blocks = document.querySelectorAll('.feature-block');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.2 });
        blocks.forEach(block => observer.observe(block));
        window.addEventListener('load', () => {
            blocks.forEach(block => {
                const rect = block.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    block.classList.add('visible');
                }
            });
        });
    </script>

    <!-- Chatbot Button and Widget -->
<style>
    .chatbot-btn {
        position: fixed;
        bottom: 24px;
        left: 24px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #FF4F8B, #E9B3FB);
        border: none;
        box-shadow: 0 8px 25px rgba(255, 79, 139, 0.4);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    .chatbot-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 30px rgba(255, 79, 139, 0.6);
    }
    .chatbot-btn i {
        font-size: 28px;
        color: white;
    }

    .chatbot-widget {
        position: fixed;
        bottom: 96px;
        left: 24px;
        width: 360px;
        max-width: calc(100vw - 48px);
        background: rgba(31, 41, 55, 0.9);
        backdrop-filter: blur(16px);
        border-radius: 28px;
        border: 1px solid rgba(233, 179, 251, 0.4);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1001;
        font-family: 'Cairo', 'Inter', sans-serif;
    }

    .chatbot-header {
        background: linear-gradient(135deg, rgba(255, 79, 139, 0.2), rgba(233, 179, 251, 0.1));
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(233, 179, 251, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chatbot-header h3 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chatbot-header h3 i {
        color: #FFB3C7;
    }
    .chatbot-close {
        background: none;
        border: none;
        color: #FFB3C7;
        font-size: 1.3rem;
        cursor: pointer;
        transition: 0.2s;
    }
    .chatbot-close:hover {
        color: #FF4F8B;
    }

    .chatbot-messages {
        padding: 1rem;
        height: 350px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .message {
        max-width: 85%;
        padding: 0.6rem 1rem;
        border-radius: 18px;
        font-size: 0.85rem;
        line-height: 1.4;
        animation: fadeInUp 0.2s ease;
    }
    .message.bot {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(233, 179, 251, 0.3);
        align-self: flex-start;
        border-bottom-left-radius: 4px;
        color: #EDE9FE;
    }
    .message.user {
        background: linear-gradient(135deg, #FF4F8B, #E6497D);
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .quick-replies {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }
    .quick-reply-btn {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(233, 179, 251, 0.4);
        border-radius: 40px;
        padding: 0.3rem 0.8rem;
        font-size: 0.7rem;
        color: #FFB3C7;
        cursor: pointer;
        transition: 0.2s;
    }
    .quick-reply-btn:hover {
        background: rgba(255, 79, 139, 0.3);
        border-color: #FF4F8B;
        color: white;
    }

    .chatbot-input-area {
        display: flex;
        padding: 0.8rem;
        border-top: 1px solid rgba(233, 179, 251, 0.2);
        background: rgba(0, 0, 0, 0.2);
    }
    .chatbot-input-area input {
        flex: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(233, 179, 251, 0.4);
        border-radius: 40px;
        padding: 0.6rem 1rem;
        color: white;
        font-family: inherit;
        outline: none;
    }
    .chatbot-input-area input::placeholder {
        color: #94A3B8;
    }
    .chatbot-input-area button {
        background: #FF4F8B;
        border: none;
        border-radius: 40px;
        padding: 0.6rem 1.2rem;
        margin-left: 8px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .chatbot-input-area button:hover {
        background: #ff3373;
        transform: scale(0.98);
    }

    @media (max-width: 500px) {
        .chatbot-widget {
            width: calc(100vw - 40px);
            left: 20px;
            bottom: 80px;
        }
    }
</style>

<div class="chatbot-btn" id="chatbotToggle">
    <i class="fas fa-comment-dots"></i>
</div>

<div class="chatbot-widget" id="chatbotWidget">
    <div class="chatbot-header">
        <h3><i class="fas fa-robot"></i> مساعد كِسرة الذكي</h3>
        <button class="chatbot-close" id="chatbotClose"><i class="fas fa-times"></i></button>
    </div>
    <div class="chatbot-messages" id="chatMessages">
        <div class="message bot">
            👋 مرحباً بك في كِسرة!<br>
            أنا مساعدك الذكي، يمكنني الإجابة عن أسئلتك حول:<br>
            • المنتجات والتقسيط<br>
            • طلباتي وأقساطي<br>
            • التسجيل كتاجر<br>
            • الدفع والاستلام<br>
            كيف يمكنني مساعدتك اليوم؟
        </div>
        <div class="quick-replies" id="quickReplies">
            <button class="quick-reply-btn" data-msg="كيف أشتري بالتقسيط؟">🛒 كيف أشتري بالتقسيط؟</button>
            <button class="quick-reply-btn" data-msg="ما هي طريقة الدفع؟">💳 طريقة الدفع</button>
            <button class="quick-reply-btn" data-msg="كيف أصبح تاجراً على كِسرة؟">🏢 كيف أصبح تاجراً؟</button>
            <button class="quick-reply-btn" data-msg="متى تصل أقساطي؟">📅 متى تصل أقساطي؟</button>
        </div>
    </div>
    <div class="chatbot-input-area">
        <input type="text" id="chatInput" placeholder="اكتب سؤالك هنا...">
        <button id="chatSend"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
    (function() {
        const toggleBtn = document.getElementById('chatbotToggle');
        const widget = document.getElementById('chatbotWidget');
        const closeBtn = document.getElementById('chatbotClose');
        const messagesContainer = document.getElementById('chatMessages');
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('chatSend');
        const quickBtns = document.querySelectorAll('.quick-reply-btn');

        // فتح/إغلاق الشات بوت
        function openChat() {
            widget.style.display = 'flex';
        }
        function closeChat() {
            widget.style.display = 'none';
        }
        toggleBtn.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);

        // إضافة رسالة المستخدم
        function addUserMessage(text) {
            const msgDiv = document.createElement('div');
            msgDiv.className = 'message user';
            msgDiv.textContent = text;
            messagesContainer.appendChild(msgDiv);
            scrollToBottom();
        }

        // إضافة رسالة البوت مع ردود سريعة اختيارية
        function addBotMessage(text, showQuick = false, quickOptions = []) {
            const msgDiv = document.createElement('div');
            msgDiv.className = 'message bot';
            msgDiv.innerHTML = text;
            messagesContainer.appendChild(msgDiv);

            if (showQuick && quickOptions.length) {
                const quickDiv = document.createElement('div');
                quickDiv.className = 'quick-replies';
                quickOptions.forEach(opt => {
                    const btn = document.createElement('button');
                    btn.className = 'quick-reply-btn';
                    btn.textContent = opt.text;
                    btn.dataset.msg = opt.value;
                    btn.addEventListener('click', () => {
                        addUserMessage(opt.text);
                        processBotReply(opt.value);
                        btn.remove();
                    });
                    quickDiv.appendChild(btn);
                });
                messagesContainer.appendChild(quickDiv);
            }
            scrollToBottom();
        }

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // المعالجة الأساسية للردود (ذكاء اصطناعي بسيط)
        function processBotReply(userMsg) {
            const msg = userMsg.toLowerCase().trim();

            // الأسئلة الشائعة
            if (msg.includes('تقسيط') || msg.includes('كيف أشتري بالتقسيط') || msg.includes('طريقة التقسيط')) {
                addBotMessage(`🟣 **الشراء بالتقسيط عبر كِسرة سهل جداً:**<br><br>
                1️⃣ اختر المنتج الذي يعجبك.<br>
                2️⃣ عند الدفع، اختر "تقسيط عبر كِسرة".<br>
                3️⃣ اختر عدد الدفعات (3، 6، 12 شهراً).<br>
                4️⃣ سيتم خصم القسط الأول مباشرة (محاكاة حالياً)، وسيتم إشعارك بالأقساط التالية.<br><br>
                ✅ لا حاجة لضمانات معقدة، فقط هوية سارية.`);
                return;
            }
            if (msg.includes('دفع') || msg.includes('طريقة الدفع') || msg.includes('الدفع')) {
                addBotMessage(`💳 **طرق الدفع المقبولة في كِسرة:**<br><br>
                • الدفع عند الاستلام (نقدي)<br>
                • بطاقات ائتمان / مدى (قريباً)<br>
                • تقسيط عبر كِسرة (دفعة أولى + أقساط شهرية)<br><br>
                جميع المدفوعات آمنة وبياناتك مشفرة.`);
                return;
            }
            if (msg.includes('تاجر') || msg.includes('أصبح تاجر') || msg.includes('إنشاء متجر')) {
                addBotMessage(`🏢 **كيف تصبح تاجراً على كِسرة؟**<br><br>
                1️⃣ سجل الدخول إلى حسابك.<br>
                2️⃣ اذهب إلى لوحة التحكم ← اضغط "كن تاجراً" أو "إنشاء متجر".<br>
                3️⃣ أدخل اسم المتجر ووصفه.<br>
                4️⃣ بعد إنشاء المتجر، سيتم ترقيتك إلى تاجر تلقائياً.<br><br>
                🔹 يمكنك بعدها إضافة المنتجات، وسيتمكن العملاء من شرائها بالتقسيط.`);
                return;
            }
            if (msg.includes('قسط') || msg.includes('أقساطي') || msg.includes('متى استحقاق')) {
                addBotMessage(`📅 **متابعة أقساطك:**<br><br>
                يمكنك الاطلاع على جدول الأقساط من خلال:<br>
                "حسابي ← أقساطي" أو "طلباتي ← تفاصيل الطلب".<br>
                تواريخ الاستحقاق محددة بوضوح مع إمكانية دفع القسط مبكراً (محاكاة).<br>
                إذا تأخر القسط، ستتلقى إشعاراً لتجنب الرسوم.`);
                return;
            }
            if (msg.includes('شحن') || msg.includes('توصيل') || msg.includes('استلام')) {
                addBotMessage(`🚚 **التوصيل والاستلام:**<br><br>
                • بعد تأكيد الطلب، سيتم التواصل معك لتحديد عنوان التوصيل.<br>
                • المدة تختلف حسب المتجر (عادة 2-5 أيام عمل).<br>
                • يمكنك متابعة حالة الطلب من "طلباتي".<br><br>
                لأي استفسار تواصل مع البائع مباشرة عبر المتجر.`);
                return;
            }
            if (msg.includes('ضمان') || msg.includes('استرجاع') || msg.includes('مرتجع')) {
                addBotMessage(`🛡️ **سياسة الإرجاع والضمان:**<br><br>
                • يحق لك إرجاع المنتج خلال 14 يوماً من تاريخ الاستلام.<br>
                • يجب أن يكون المنتج بحالته الأصلية.<br>
                • بعد الإرجاع، يتم إلغاء الأقساط المتبقية واسترداد المدفوع.<br><br>
                لمزيد من المعلومات، راجع سياسة المتجر.`);
                return;
            }
            if (msg.includes('الرئيسية') || msg.includes('مرحباً') || msg.includes('اهلاً') || msg.includes('السلام')) {
                addBotMessage(`👋 أهلاً بك مجدداً!<br>
                يمكنك سؤالي عن:<br>
                - المنتجات والتقسيط<br>
                - طلباتي وأقساطي<br>
                - كيف تصبح تاجراً<br>
                - الدفع والتوصيل<br>
                فقط اكتب سؤالك 🙂`);
                return;
            }

            // الرد الافتراضي
            addBotMessage(`🤖 شكراً لتواصلك مع كِسرة!<br>
            سؤال رائع. إذا كنت بحاجة إلى مساعدة في:<br>
            • الشراء بالتقسيط<br>
            • طريقة الدفع<br>
            • التسجيل كتاجر<br>
            • أقساطي ومواعيدها<br>
            فقط اختر من الأسئلة السريعة أو اكتب طلبك بوضوح وسأساعدك.<br><br>
            يمكنك أيضاً تصفح الأسئلة الشائعة في صفحة "المساعدة".`);
        }

        // إرسال رسالة المستخدم
        function sendUserMessage() {
            let text = chatInput.value.trim();
            if (text === '') return;
            addUserMessage(text);
            chatInput.value = '';

            // إظهار مؤشر كتابة بوت (اختياري)
            setTimeout(() => {
                processBotReply(text);
            }, 400);
        }

        sendBtn.addEventListener('click', sendUserMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendUserMessage();
        });

        // أحداث الأزرار السريعة
        quickBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const msg = btn.getAttribute('data-msg');
                addUserMessage(msg);
                processBotReply(msg);
            });
        });
    })();
</script>
</body>

</html>