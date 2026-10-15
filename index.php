<?php
// ============================================
// Sunrise Public School - Home Page
// Single File: PHP + Internal CSS + Internal JS
// ============================================
session_start();

// ---------- USERS ----------
$users = [
    'zain1' => ['password' => '1', 'role' => 'admin',   'name' => 'Zain Admin',   'page' => 'admin-login.php'],
    'zain2' => ['password' => '2', 'role' => 'teacher', 'name' => 'Zain Teacher', 'page' => 'teacher-login.php'],
    'zain3' => ['password' => '3', 'role' => 'student', 'name' => 'Zain Student', 'page' => 'student-login.php'],
    'zain4' => ['password' => '4', 'role' => 'parent',  'name' => 'Zain Parent',  'page' => 'parent-login.php'],
];

// ---------- LOGIN HANDLE ----------
$login_error = "";
if (isset($_POST['do_login'])) {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $login_error = "Please enter both Username and Password!";
    } elseif (!isset($users[$email]) || $users[$email]['password'] !== $password) {
        $login_error = "❌ Invalid username or password!";
    } else {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $users[$email]['name'];
        $_SESSION['user_role'] = $users[$email]['role'];
        header("Location: " . $users[$email]['page']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunrise Public School | Home</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* =====================================================
           GLOBAL RESET & VARIABLES
           ===================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary: #f59e0b;
            --secondary-dark: #d97706;
            --dark: #111827;
            --gray: #6b7280;
            --light: #f9fafb;
            --white: #ffffff;
            --border: #e5e7eb;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--white);
            color: var(--dark);
            line-height: 1.7;
            overflow-x: hidden;
            font-size: 15px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        img { max-width: 100%; display: block; }
        a { text-decoration: none; color: inherit; transition: all 0.3s ease; }
        ul { list-style: none; }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--secondary);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
        }

        .btn-primary:hover {
            background: var(--secondary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.5);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border-color: var(--white);
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
            transform: translateY(-3px);
        }

        /* TOPBAR */
        .topbar {
            background: var(--primary);
            color: var(--white);
            padding: 10px 0;
            font-size: 13px;
        }

        .topbar-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .topbar-left {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .topbar-left span i {
            margin-right: 6px;
            color: var(--secondary);
        }

        .topbar-right {
            display: flex;
            gap: 8px;
        }

        .topbar-right a {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            font-size: 13px;
        }

        .topbar-right a:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        /* NAVBAR */
        .navbar {
            background: var(--white);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: var(--white);
            box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3);
        }

        .logo-text h2 {
            font-size: 20px;
            color: var(--primary);
            font-weight: 700;
            line-height: 1;
        }

        .logo-text span {
            font-size: 12px;
            color: var(--gray);
            font-weight: 500;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-menu ul {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-menu ul li a {
            font-size: 15px;
            font-weight: 500;
            color: var(--dark);
            position: relative;
            padding: 8px 0;
        }

        .nav-menu ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: width 0.3s;
        }

        .nav-menu ul li a:hover,
        .nav-menu ul li a.active {
            color: var(--primary);
        }

        .nav-menu ul li a:hover::after,
        .nav-menu ul li a.active::after {
            width: 100%;
        }

        .btn-login {
            background: var(--primary);
            color: var(--white) !important;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-login:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger span {
            width: 28px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* HERO SLIDER */
        .hero-slider {
            position: relative;
            height: 90vh;
            min-height: 600px;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1.2s ease-in-out, visibility 1.2s;
            display: flex;
            align-items: center;
        }

        .slide.active {
            opacity: 1;
            visibility: visible;
        }

        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85), rgba(30, 58, 138, 0.6));
        }

        .slide-content {
            position: relative;
            z-index: 2;
            max-width: 750px;
            padding: 0 60px;
            color: var(--white);
        }

        .slide.active .slide-content > * {
            animation: slideUp 0.9s ease forwards;
            opacity: 0;
        }

        .slide.active .slide-content > *:nth-child(1) { animation-delay: 0.2s; }
        .slide.active .slide-content > *:nth-child(2) { animation-delay: 0.4s; }
        .slide.active .slide-content > *:nth-child(3) { animation-delay: 0.6s; }
        .slide.active .slide-content > *:nth-child(4) { animation-delay: 0.8s; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-tag {
            display: inline-block;
            background: var(--secondary);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .slide-content h1 {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .slide-content h1 span { color: var(--secondary); }

        .slide-content p {
            font-size: 18px;
            margin-bottom: 35px;
            opacity: 0.95;
            max-width: 600px;
        }

        .slide-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            color: var(--white);
            font-size: 20px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .slider-arrow:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            transform: translateY(-50%) scale(1.1);
        }

        .slider-arrow.prev { left: 30px; }
        .slider-arrow.next { right: 30px; }

        .slider-dots {
            position: absolute;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--secondary);
            width: 40px;
            border-radius: 10px;
        }

        /* NOTICE TICKER */
        .notice-ticker {
            background: var(--secondary);
            color: var(--white);
            padding: 14px 0;
            overflow: hidden;
        }

        .ticker-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .ticker-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 1px;
            white-space: nowrap;
            padding-right: 20px;
            border-right: 2px solid rgba(255,255,255,0.3);
        }

        .pulse-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--white);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .ticker-content {
            flex: 1;
            overflow: hidden;
        }

        .ticker-track {
            display: inline-flex;
            gap: 60px;
            white-space: nowrap;
            animation: scrollTicker 30s linear infinite;
        }

        .ticker-track span { font-size: 14px; font-weight: 500; }

        @keyframes scrollTicker {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        /* STATS */
        .stats-section {
            padding: 70px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .stat-card {
            text-align: center;
            color: var(--white);
            padding: 30px 20px;
            border-radius: 15px;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            background: rgba(255,255,255,0.15);
        }

        .stat-icon { font-size: 42px; margin-bottom: 15px; }

        .stat-card h3 {
            font-size: 42px;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-card p {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* SECTION HEADER */
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
        }

        .section-tag {
            display: inline-block;
            color: var(--secondary);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
            position: relative;
            padding-left: 30px;
        }

        .section-tag::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 20px;
            height: 2px;
            background: var(--secondary);
            transform: translateY(-50%);
        }

        .section-title {
            font-size: 40px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .section-title span { color: var(--primary); }

        .section-desc {
            color: var(--gray);
            font-size: 16px;
        }

        /* ABOUT */
        .about-section {
            padding: 100px 0;
            background: var(--light);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-image { position: relative; }

        .about-image img {
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .experience-badge {
            position: absolute;
            bottom: -25px;
            right: -25px;
            background: var(--secondary);
            color: var(--white);
            padding: 25px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.4);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .experience-badge h2 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .experience-badge p {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.3;
        }

        .about-content h2 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.2;
            margin: 15px 0 20px;
            color: var(--dark);
        }

        .about-content h2 span { color: var(--primary); }

        .about-content > p {
            color: var(--gray);
            margin-bottom: 25px;
            font-size: 16px;
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 15px;
        }

        .feature-item .check {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--secondary);
            color: var(--white);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* PRINCIPAL */
        .principal-section {
            padding: 100px 0;
            background: var(--white);
        }

        .principal-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 60px;
            align-items: center;
        }

        .principal-photo img {
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            border: 6px solid var(--secondary);
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .principal-msg h2 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.2;
            margin: 15px 0 20px;
            color: var(--dark);
        }

        .principal-msg h2 span { color: var(--primary); }

        .quote-icon {
            font-size: 80px;
            color: var(--secondary);
            line-height: 0.5;
            opacity: 0.4;
            margin-bottom: 20px;
        }

        .principal-msg p {
            font-style: italic;
            color: var(--gray);
            font-size: 17px;
            margin-bottom: 25px;
            border-left: 4px solid var(--secondary);
            padding-left: 25px;
            line-height: 1.8;
        }

        .principal-msg h4 {
            color: var(--primary);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .principal-msg .designation {
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
        }

        /* FACILITIES */
        .facilities-section {
            padding: 100px 0;
            background: var(--light);
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .facility-card {
            background: var(--white);
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            border-top: 5px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .facility-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            transition: 0.5s;
            z-index: 0;
        }

        .facility-card:hover::before { left: 0; }

        .facility-card > * {
            position: relative;
            z-index: 1;
            transition: color 0.3s;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            border-top-color: var(--secondary);
            box-shadow: 0 20px 40px rgba(30, 58, 138, 0.25);
        }

        .facility-card:hover h3,
        .facility-card:hover p { color: var(--white); }

        .facility-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .facility-card:hover .facility-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
        }

        .facility-card h3 {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .facility-card p {
            color: var(--gray);
            font-size: 14px;
        }

        /* QUICK LINKS */
        .quick-links {
            padding: 100px 0;
            background: var(--white);
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .link-card {
            background: var(--light);
            padding: 30px 15px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.4s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .link-card:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-10px);
            border-color: var(--secondary);
            box-shadow: 0 15px 35px rgba(30, 58, 138, 0.3);
        }

        .link-icon {
            font-size: 42px;
            margin-bottom: 12px;
            transition: transform 0.4s;
        }

        .link-card:hover .link-icon { transform: scale(1.2) rotate(-5deg); }

        .link-card h3 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .link-card p {
            font-size: 12px;
            opacity: 0.7;
        }

        /* CTA */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .cta-section::before,
        .cta-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .cta-section::before {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
        }

        .cta-section::after {
            width: 400px;
            height: 400px;
            bottom: -200px;
            right: -100px;
        }

        .cta-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .cta-text h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .cta-text p {
            font-size: 17px;
            opacity: 0.9;
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* FOOTER */
        .footer {
            background: var(--dark);
            color: #d1d5db;
        }

        .footer-top {
            padding: 70px 0 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .footer-logo .logo-icon {
            width: 50px;
            height: 50px;
        }

        .footer-logo h3 {
            color: var(--white);
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        .footer-logo span {
            font-size: 12px;
            color: var(--secondary);
            font-weight: 500;
            letter-spacing: 1px;
        }

        .footer-col p {
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .footer-col h3 {
            color: var(--white);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 22px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--secondary);
        }

        .footer-col ul li {
            margin-bottom: 12px;
        }

        .footer-col ul li a {
            font-size: 14px;
            color: #d1d5db;
            display: inline-block;
        }

        .footer-col ul li a:hover {
            color: var(--secondary);
            transform: translateX(5px);
        }

        .contact-info li {
            display: flex;
            gap: 12px;
            font-size: 14px;
            margin-bottom: 15px !important;
            line-height: 1.6;
        }

        .contact-info li i {
            color: var(--secondary);
            margin-top: 5px;
            flex-shrink: 0;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--white);
        }

        .social-links a:hover {
            background: var(--secondary);
            transform: translateY(-5px);
        }

        .footer-bottom {
            background: #0a0f1a;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* BACK TO TOP */
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--secondary);
            color: var(--white);
            border: none;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        #backToTop.show {
            opacity: 1;
            visibility: visible;
        }

        #backToTop:hover {
            background: var(--primary);
            transform: translateY(-5px);
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .slide-content h1 { font-size: 40px; }
            .slide-content p { font-size: 16px; }
            .slide-content { padding: 0 40px; }
            .about-grid,
            .principal-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .experience-badge { right: 20px; bottom: -20px; }
            .facilities-grid { grid-template-columns: repeat(2, 1fr); }
            .links-grid { grid-template-columns: repeat(3, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .section-title { font-size: 32px; }
            .about-content h2,
            .principal-msg h2 { font-size: 30px; }
            .cta-content { flex-direction: column; text-align: center; }
            .cta-text h2 { font-size: 28px; }
        }

        @media (max-width: 768px) {
            .topbar-left span:last-child { display: none; }
            .hamburger { display: flex; }
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                max-width: 350px;
                height: 100vh;
                background: var(--white);
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                padding: 90px 30px 30px;
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                transition: right 0.4s ease;
                overflow-y: auto;
                z-index: 999;
            }
            .nav-menu.active { right: 0; }
            .nav-menu ul {
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                width: 100%;
                margin-bottom: 20px;
            }
            .nav-menu ul li {
                width: 100%;
                border-bottom: 1px solid var(--border);
            }
            .nav-menu ul li a {
                display: block;
                padding: 15px 0;
                font-size: 16px;
            }
            .btn-login { width: 100%; justify-content: center; }
            .hero-slider { height: 85vh; min-height: 500px; }
            .slide-content { padding: 0 25px; }
            .slide-content h1 { font-size: 30px; }
            .slide-content p { font-size: 15px; }
            .slide-tag { font-size: 11px; padding: 6px 15px; }
            .slider-arrow { width: 42px; height: 42px; font-size: 16px; }
            .slider-arrow.prev { left: 15px; }
            .slider-arrow.next { right: 15px; }
            .stats-grid,
            .facilities-grid,
            .links-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .about-features { grid-template-columns: 1fr; }
            .section-title { font-size: 26px; }
            .about-content h2,
            .principal-msg h2 { font-size: 25px; }
            .about-image img,
            .principal-photo img { height: 350px; }
            .experience-badge { padding: 18px 22px; }
            .experience-badge h2 { font-size: 28px; }
            .ticker-wrapper { flex-direction: column; align-items: flex-start; gap: 10px; }
            .ticker-label { border-right: none; border-bottom: 2px solid rgba(255,255,255,0.3); padding: 0 0 8px; }
            .cta-text h2 { font-size: 24px; }
            .cta-text p { font-size: 15px; }
            .about-section,
            .principal-section,
            .facilities-section,
            .quick-links { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .slide-content h1 { font-size: 24px; }
            .slide-buttons { flex-direction: column; }
            .slide-buttons .btn { width: 100%; justify-content: center; }
            .section-title { font-size: 22px; }
        }

        /* SCROLL REVEAL */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* =====================================================
           LOGIN MODAL CSS
           ===================================================== */
        .lm-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            overflow-y: auto;
        }
        .lm-overlay.active { display: flex; }

        .lm-box {
            background: #fff;
            border-radius: 25px;
            max-width: 950px;
            width: 100%;
            max-height: 92vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            animation: lmSlideUp 0.4s ease;
        }
        @keyframes lmSlideUp {
            from { transform: translateY(60px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .lm-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.25);
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }
        .lm-close:hover {
            background: #ef4444;
            transform: rotate(90deg);
        }

        /* STEP 1 */
        .lm-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #fff;
            padding: 40px 40px 35px;
            text-align: center;
            border-radius: 25px 25px 0 0;
        }
        .lm-header .lm-logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            background: rgba(255,255,255,0.15);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }
        .lm-header h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .lm-header h2 span { color: #f59e0b; }
        .lm-header p { font-size: 14px; opacity: 0.9; }

        .lm-body { padding: 40px; }
        .lm-title {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        .lm-roles {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .lm-role-card {
            background: #fff;
            border: 2px solid #e5e7eb;
            border-radius: 18px;
            padding: 28px 18px 22px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .lm-role-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            transform: scaleX(0);
            transition: transform 0.3s;
        }
        .lm-role-card:hover::before { transform: scaleX(1); }
        .lm-role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.15);
        }

        .lm-role-card.admin::before { background: #dc2626; }
        .lm-role-card.admin:hover { border-color: #dc2626; }
        .lm-role-card.teacher::before { background: #7c3aed; }
        .lm-role-card.teacher:hover { border-color: #7c3aed; }
        .lm-role-card.student::before { background: #3b82f6; }
        .lm-role-card.student:hover { border-color: #3b82f6; }
        .lm-role-card.parent::before { background: #10b981; }
        .lm-role-card.parent:hover { border-color: #10b981; }

        .lm-role-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #fff;
            transition: transform 0.4s ease;
        }
        .lm-role-card:hover .lm-role-icon { transform: rotate(360deg) scale(1.08); }

        .lm-role-card.admin .lm-role-icon { background: linear-gradient(135deg, #dc2626, #b91c1c); box-shadow: 0 10px 25px rgba(220, 38, 38, 0.35); }
        .lm-role-card.teacher .lm-role-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); box-shadow: 0 10px 25px rgba(139, 92, 246, 0.35); }
        .lm-role-card.student .lm-role-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 10px 25px rgba(59, 130, 246, 0.35); }
        .lm-role-card.parent .lm-role-icon { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 10px 25px rgba(16, 185, 129, 0.35); }

        .lm-role-card h3 {
            font-size: 17px;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 5px;
        }
        .lm-role-card p {
            font-size: 12px;
            color: #6b7280;
        }

        /* STEP 2 */
        #lmFormStep { display: none; padding: 40px; }

        .lm-back {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            padding: 8px 14px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .lm-back:hover { background: #f9fafb; color: #1e3a8a; }

        .lm-form-header {
            padding: 25px;
            border-radius: 18px;
            color: #fff;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .lm-form-header .lfh-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }
        .lm-form-header h3 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 3px;
        }
        .lm-form-header p { font-size: 13px; opacity: 0.9; }

        .lm-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 10px;
            border-left: 4px solid #ef4444;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .lm-group { margin-bottom: 20px; }
        .lm-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }
        .lm-input-wrap {
            position: relative;
        }
        .lm-input-wrap > i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 15px;
            pointer-events: none;
        }
        .lm-input-wrap input {
            width: 100%;
            padding: 14px 18px 14px 46px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            transition: all 0.3s ease;
        }
        .lm-input-wrap input:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }
        .lm-toggle-pw {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
            font-size: 15px;
            background: none;
            border: none;
            padding: 5px;
        }
        .lm-toggle-pw:hover { color: #1e3a8a; }

        .lm-submit {
            width: 100%;
            padding: 15px 32px;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Poppins', sans-serif;
            margin-top: 10px;
        }
        .lm-submit.admin { background: linear-gradient(135deg, #dc2626, #b91c1c); }
        .lm-submit.teacher { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .lm-submit.student { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .lm-submit.parent { background: linear-gradient(135deg, #10b981, #059669); }
        .lm-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .lm-demo {
            margin-top: 22px;
            padding: 15px 18px;
            background: #fef3c7;
            border-radius: 10px;
            border-left: 4px solid #f59e0b;
            font-size: 13px;
            color: #78350f;
        }
        .lm-demo strong {
            display: block;
            margin-bottom: 6px;
            color: #1e3a8a;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .lm-demo code {
            background: #fff;
            padding: 3px 10px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: #1e3a8a;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .lm-roles { grid-template-columns: 1fr 1fr; gap: 12px; }
            .lm-role-card { padding: 20px 12px 16px; }
            .lm-role-icon { width: 55px; height: 55px; font-size: 24px; margin-bottom: 12px; }
            .lm-role-card h3 { font-size: 14px; }
            .lm-role-card p { font-size: 11px; }
            .lm-header { padding: 30px 25px 25px; }
            .lm-header h2 { font-size: 20px; }
            .lm-body, #lmFormStep { padding: 25px 22px; }
            .lm-form-header { padding: 20px; flex-direction: column; text-align: center; }
            .lm-form-header .lfh-icon { width: 55px; height: 55px; font-size: 24px; }
        }
        @media (max-width: 480px) {
            .lm-roles { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="container topbar-wrapper">
        <div class="topbar-left">
            <span><i class="fas fa-phone"></i> +91 98765 43210</span>
            <span><i class="fas fa-envelope"></i> info@sunriseschool.com</span>
        </div>
        <div class="topbar-right">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<header class="navbar" id="navbar">
    <div class="container nav-wrapper">
        <a href="index.php" class="logo">
            <div class="logo-icon">🎓</div>
            <div class="logo-text">
                <h2>Sunrise</h2>
                <span>PUBLIC SCHOOL</span>
            </div>
        </a>

        <nav class="nav-menu" id="navMenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="academics.php">Academics</a></li>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="faculty.php">Faculty</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="notice.php">Notice</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <button type="button" class="btn-login" onclick="openLoginModal()">
                <i class="fas fa-user"></i> Login
            </button>
        </nav>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>

<!-- HERO SLIDER -->
<section class="hero-slider" id="heroSlider">
    <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1600');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <span class="slide-tag">🎓 Welcome to Excellence</span>
            <h1>Shape Your Child's <span>Bright Future</span> With Us</h1>
            <p>Sunrise Public School — Where knowledge meets innovation and every child becomes a leader.</p>
            <div class="slide-buttons">
                <a href="admission.php" class="btn btn-primary">Apply for Admission</a>
                <a href="about.php" class="btn btn-outline">Learn More →</a>
            </div>
        </div>
    </div>

    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1600');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <span class="slide-tag">📢 Admissions Open 2025-26</span>
            <h1>Admission Open <span>Nursery to 12th</span></h1>
            <p>Limited seats available. Secure your child's admission today with our easy online process.</p>
            <div class="slide-buttons">
                <a href="admission.php" class="btn btn-primary">Apply Now</a>
                <a href="contact.php" class="btn btn-outline">Contact Us →</a>
            </div>
        </div>
    </div>

    <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600');">
        <div class="slide-overlay"></div>
        <div class="slide-content">
            <span class="slide-tag">🏆 30+ Years of Excellence</span>
            <h1>Quality Education <span>Since 1995</span></h1>
            <p>Modern infrastructure, expert faculty, and a nurturing environment for holistic development.</p>
            <div class="slide-buttons">
                <a href="academics.php" class="btn btn-primary">Explore Academics</a>
                <a href="gallery.php" class="btn btn-outline">View Gallery →</a>
            </div>
        </div>
    </div>

    <button class="slider-arrow prev" onclick="changeSlide(-1)" aria-label="Previous">&#10094;</button>
    <button class="slider-arrow next" onclick="changeSlide(1)" aria-label="Next">&#10095;</button>

    <div class="slider-dots">
        <span class="dot active" onclick="goToSlide(0)"></span>
        <span class="dot" onclick="goToSlide(1)"></span>
        <span class="dot" onclick="goToSlide(2)"></span>
    </div>
</section>

<!-- NOTICE TICKER -->
<section class="notice-ticker">
    <div class="container ticker-wrapper">
        <div class="ticker-label">
            <span class="pulse-dot"></span>
            LATEST NEWS
        </div>
        <div class="ticker-content">
            <div class="ticker-track">
                <span>🎯 Admission Open for 2025-26 session — Apply Now!</span>
                <span>📅 Half Yearly Exams start from 15th November</span>
                <span>🏆 Annual Sports Day on 25th December</span>
                <span>👨‍👩‍👧 Parent-Teacher Meeting on 10th November</span>
                <span>🎨 Inter-School Art Competition on 5th December</span>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card reveal">
                <div class="stat-icon">👨‍🎓</div>
                <h3 class="counter" data-target="2500">0</h3>
                <p>Happy Students</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon">👨‍🏫</div>
                <h3 class="counter" data-target="120">0</h3>
                <p>Expert Teachers</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon">🏆</div>
                <h3 class="counter" data-target="150">0</h3>
                <p>Awards Won</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon">📚</div>
                <h3 class="counter" data-target="30">0</h3>
                <p>Years of Excellence</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image reveal">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800" alt="About School">
                <div class="experience-badge">
                    <h2>30+</h2>
                    <p>Years of<br>Experience</p>
                </div>
            </div>

            <div class="about-content reveal">
                <span class="section-tag">About Our School</span>
                <h2>We Provide Best <span>Education</span> For Your Child</h2>
                <p>
                    Sunrise Public School is one of the leading educational institutions
                    committed to providing quality education since 1995. We focus on
                    holistic development of every child through academics, sports, and
                    co-curricular activities.
                </p>

                <div class="about-features">
                    <div class="feature-item"><span class="check">✔</span> CBSE Affiliated</div>
                    <div class="feature-item"><span class="check">✔</span> Smart Classrooms</div>
                    <div class="feature-item"><span class="check">✔</span> Modern Labs</div>
                    <div class="feature-item"><span class="check">✔</span> Expert Faculty</div>
                    <div class="feature-item"><span class="check">✔</span> Safe Transport</div>
                    <div class="feature-item"><span class="check">✔</span> Sports Activities</div>
                </div>

                <a href="about.php" class="btn btn-primary">Read More About Us</a>
            </div>
        </div>
    </div>
</section>

<!-- PRINCIPAL -->
<section class="principal-section">
    <div class="container">
        <div class="principal-grid">
            <div class="principal-photo reveal">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600" alt="Principal">
            </div>

            <div class="principal-msg reveal">
                <span class="section-tag">Principal's Message</span>
                <h2>A Word From Our <span>Principal</span></h2>
                <div class="quote-icon">❝</div>
                <p>
                    Dear Parents and Students, welcome to Sunrise Public School.
                    Our mission is to nurture young minds and prepare them to face
                    global challenges with confidence and integrity. We believe in
                    providing an environment where every child can discover their
                    true potential and become a responsible global citizen.
                </p>
                <h4>Mr. Rajesh Kumar</h4>
                <span class="designation">Principal, Sunrise Public School</span>
            </div>
        </div>
    </div>
</section>

<!-- FACILITIES -->
<section class="facilities-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What We Offer</span>
            <h2 class="section-title">Our World-Class <span>Facilities</span></h2>
            <p class="section-desc">We provide modern facilities to ensure the best learning environment for every student.</p>
        </div>

        <div class="facilities-grid">
            <div class="facility-card reveal">
                <div class="facility-icon">📚</div>
                <h3>Rich Library</h3>
                <p>Well-stocked library with thousands of books, journals, and digital resources.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🔬</div>
                <h3>Science Labs</h3>
                <p>Modern Physics, Chemistry and Biology labs with latest equipment.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">💻</div>
                <h3>Computer Lab</h3>
                <p>Latest computers with high-speed internet and coding facilities.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">⚽</div>
                <h3>Sports Ground</h3>
                <p>Large playground for cricket, football, basketball and athletics.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🚌</div>
                <h3>Transport</h3>
                <p>Safe and reliable school bus service across the entire city.</p>
            </div>
            <div class="facility-card reveal">
                <div class="facility-icon">🎨</div>
                <h3>Art & Music</h3>
                <p>Dedicated rooms for art, craft, music, and dance activities.</p>
            </div>
        </div>
    </div>
</section>

<!-- QUICK LINKS -->
<section class="quick-links">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Quick Access</span>
            <h2 class="section-title">Important <span>Quick Links</span></h2>
        </div>

        <div class="links-grid">
            <a href="admission.php" class="link-card reveal">
                <div class="link-icon">📝</div>
                <h3>Online Admission</h3>
                <p>Apply now</p>
            </a>
            <a href="results.php" class="link-card reveal">
                <div class="link-icon">📊</div>
                <h3>Check Result</h3>
                <p>View marks</p>
            </a>
            <a href="fee-payment.php" class="link-card reveal">
                <div class="link-icon">💳</div>
                <h3>Pay Fees</h3>
                <p>Online payment</p>
            </a>
            <a href="notice.php" class="link-card reveal">
                <div class="link-icon">📢</div>
                <h3>Notice Board</h3>
                <p>Latest updates</p>
            </a>
            <a href="gallery.php" class="link-card reveal">
                <div class="link-icon">📸</div>
                <h3>Photo Gallery</h3>
                <p>School events</p>
            </a>
            <a href="contact.php" class="link-card reveal">
                <div class="link-icon">📞</div>
                <h3>Contact Us</h3>
                <p>Get in touch</p>
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container cta-content">
        <div class="cta-text">
            <h2>Admission Open for 2025-26</h2>
            <p>Don't miss the opportunity. Apply now and secure your child's bright future!</p>
        </div>
        <div class="cta-buttons">
            <a href="admission.php" class="btn btn-primary">Apply Online Now</a>
            <a href="contact.php" class="btn btn-outline">Talk to Us</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-logo">
                        <div class="logo-icon">🎓</div>
                        <div>
                            <h3>Sunrise</h3>
                            <span>PUBLIC SCHOOL</span>
                        </div>
                    </div>
                    <p>Providing quality education since 1995. We nurture young minds to become future leaders with strong values and skills.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="about.php">→ About Us</a></li>
                        <li><a href="admission.php">→ Admission</a></li>
                        <li><a href="academics.php">→ Academics</a></li>
                        <li><a href="faculty.php">→ Faculty</a></li>
                        <li><a href="gallery.php">→ Gallery</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Important</h3>
                    <ul>
                        <li><a href="notice.php">→ Notice Board</a></li>
                        <li><a href="results.php">→ Check Result</a></li>
                        <li><a href="fee-payment.php">→ Pay Fees</a></li>
                        <li><a href="#" onclick="openLoginModal(); return false;">→ Student Login</a></li>
                        <li><a href="contact.php">→ Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Get In Touch</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123, Main Road, Delhi, India - 110001</li>
                        <li><i class="fas fa-phone"></i> +91 98765 43210</li>
                        <li><i class="fas fa-envelope"></i> info@sunriseschool.com</li>
                        <li><i class="fas fa-clock"></i> Mon - Sat: 8:00 AM - 4:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>© 2025 Sunrise Public School. All Rights Reserved. | Designed with ❤️</p>
        </div>
    </div>
</footer>

<button id="backToTop" onclick="scrollToTop()">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- LOGIN MODAL -->
<div class="lm-overlay" id="loginModal">
    <div class="lm-box">

        <button class="lm-close" onclick="closeLoginModal()">
            <i class="fas fa-times"></i>
        </button>

        <!-- STEP 1: ROLE SELECTION -->
        <div id="lmRoleStep">
            <div class="lm-header">
                <div class="lm-logo">🎓</div>
                <h2>Welcome to <span>Sunrise Portal</span></h2>
                <p>Choose your role to continue</p>
            </div>

            <div class="lm-body">
                <div class="lm-title">Select Your Role</div>

                <div class="lm-roles">
                    <div class="lm-role-card admin" onclick="showLoginForm('admin')">
                        <div class="lm-role-icon"><i class="fas fa-user-shield"></i></div>
                        <h3>Admin</h3>
                        <p>Full management</p>
                    </div>

                    <div class="lm-role-card teacher" onclick="showLoginForm('teacher')">
                        <div class="lm-role-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>Teacher</h3>
                        <p>Manage classes</p>
                    </div>

                    <div class="lm-role-card student" onclick="showLoginForm('student')">
                        <div class="lm-role-icon"><i class="fas fa-user-graduate"></i></div>
                        <h3>Student</h3>
                        <p>View marks</p>
                    </div>

                    <div class="lm-role-card parent" onclick="showLoginForm('parent')">
                        <div class="lm-role-icon"><i class="fas fa-users"></i></div>
                        <h3>Parent</h3>
                        <p>Track child</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 2: LOGIN FORM -->
        <div id="lmFormStep">
            <button class="lm-back" onclick="backToRoles()">
                <i class="fas fa-arrow-left"></i> Back to Role Selection
            </button>

            <div class="lm-form-header" id="lmFormHeader">
                <div class="lfh-icon" id="lmFormIcon"><i class="fas fa-user-shield"></i></div>
                <div>
                    <h3 id="lmFormTitle">Login</h3>
                    <p id="lmFormSubtitle">Enter your credentials</p>
                </div>
            </div>

            <?php if (!empty($login_error)): ?>
                <div class="lm-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($login_error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php">
                <div class="lm-group">
                    <label>Username</label>
                    <div class="lm-input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="Enter username" required>
                    </div>
                </div>

                <div class="lm-group">
                    <label>Password</label>
                    <div class="lm-input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="lmPassword" placeholder="Enter password" required>
                        <button type="button" class="lm-toggle-pw" onclick="toggleLmPassword()">
                            <i class="fas fa-eye" id="lmEyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="do_login" class="lm-submit" id="lmSubmitBtn">
                    <i class="fas fa-sign-in-alt"></i> <span id="lmSubmitText">Login</span>
                </button>
            </form>

            <div class="lm-demo">
                <strong><i class="fas fa-info-circle"></i> Demo Credentials:</strong>
                <div id="lmDemoText">Admin: <code>zain1</code> / <code>1</code></div>
            </div>
        </div>

    </div>
</div>

<!-- JAVASCRIPT -->
<script>
    // MOBILE MENU
    function toggleMenu() {
        const navMenu = document.getElementById('navMenu');
        const hamburger = document.getElementById('hamburger');
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    }

    document.querySelectorAll('.nav-menu ul li a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('navMenu').classList.remove('active');
            document.getElementById('hamburger').classList.remove('active');
        });
    });

    // HERO SLIDER
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let slideInterval;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function changeSlide(direction) {
        currentSlide += direction;
        showSlide(currentSlide);
        resetInterval();
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
        resetInterval();
    }

    function startInterval() {
        slideInterval = setInterval(() => {
            currentSlide++;
            showSlide(currentSlide);
        }, 5000);
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    // COUNTER
    function animateCounter(element) {
        const target = +element.getAttribute('data-target');
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const update = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current) + '+';
                requestAnimationFrame(update);
            } else {
                element.textContent = target + '+';
            }
        };
        update();
    }

    // SCROLL REVEAL + COUNTER
    const revealElements = document.querySelectorAll('.reveal');
    const counters = document.querySelectorAll('.counter');
    let countersDone = false;

    function handleScroll() {
        revealElements.forEach(el => {
            const top = el.getBoundingClientRect().top;
            const trigger = window.innerHeight - 100;
            if (top < trigger) el.classList.add('active');
        });

        if (!countersDone) {
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                const top = statsSection.getBoundingClientRect().top;
                if (top < window.innerHeight - 100) {
                    counters.forEach(c => animateCounter(c));
                    countersDone = true;
                }
            }
        }

        const backBtn = document.getElementById('backToTop');
        if (window.scrollY > 400) {
            backBtn.classList.add('show');
        } else {
            backBtn.classList.remove('show');
        }
    }

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // =====================================================
    // LOGIN MODAL
    // =====================================================
    const roleConfig = {
        admin:   { color: 'linear-gradient(135deg,#dc2626,#b91c1c)', icon: 'fa-user-shield',       title: 'Admin Login',   sub: 'Enter your admin credentials',   demo: 'Admin: <code>zain1</code> / <code>1</code>' },
        teacher: { color: 'linear-gradient(135deg,#8b5cf6,#7c3aed)', icon: 'fa-chalkboard-teacher', title: 'Teacher Login', sub: 'Enter your teacher credentials', demo: 'Teacher: <code>zain2</code> / <code>2</code>' },
        student: { color: 'linear-gradient(135deg,#3b82f6,#2563eb)', icon: 'fa-user-graduate',    title: 'Student Login', sub: 'Enter your student credentials', demo: 'Student: <code>zain3</code> / <code>3</code>' },
        parent:  { color: 'linear-gradient(135deg,#10b981,#059669)', icon: 'fa-users',            title: 'Parent Login',  sub: 'Enter your parent credentials',  demo: 'Parent: <code>zain4</code> / <code>4</code>' }
    };

    function openLoginModal() {
        document.getElementById('loginModal').classList.add('active');
        document.body.style.overflow = 'hidden';
        backToRoles();
    }

    function closeLoginModal() {
        document.getElementById('loginModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function showLoginForm(role) {
        const cfg = roleConfig[role];
        if (!cfg) return;

        document.getElementById('lmRoleStep').style.display = 'none';
        document.getElementById('lmFormStep').style.display = 'block';

        document.getElementById('lmFormHeader').style.background = cfg.color;
        document.getElementById('lmFormIcon').innerHTML = '<i class="fas ' + cfg.icon + '"></i>';
        document.getElementById('lmFormTitle').textContent = cfg.title;
        document.getElementById('lmFormSubtitle').textContent = cfg.sub;
        document.getElementById('lmSubmitBtn').className = 'lm-submit ' + role;
        document.getElementById('lmSubmitText').textContent = 'Login as ' + role.charAt(0).toUpperCase() + role.slice(1);
        document.getElementById('lmDemoText').innerHTML = cfg.demo;
    }

    function backToRoles() {
        document.getElementById('lmRoleStep').style.display = 'block';
        document.getElementById('lmFormStep').style.display = 'none';
    }

    function toggleLmPassword() {
        const input = document.getElementById('lmPassword');
        const icon = document.getElementById('lmEyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.getElementById('loginModal').addEventListener('click', function(e) {
        if (e.target === this) closeLoginModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('loginModal').classList.contains('active')) {
            closeLoginModal();
        }
    });

    <?php if (!empty($login_error)): ?>
    window.addEventListener('load', () => {
        openLoginModal();
        showLoginForm('student');
    });
    <?php endif; ?>

    // INIT
    window.addEventListener('scroll', handleScroll);
    document.addEventListener('DOMContentLoaded', () => {
        showSlide(0);
        startInterval();
        handleScroll();
    });
</script>

</body>
</html>