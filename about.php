
<?php
// ============================================
// Sunrise Public School - About Us Page
// Single File: PHP + Internal CSS + Internal JS
// ============================================//
session_start();

// ---------- USERS ----------
$users = [
    'zain1' => ['password' => '1', 'role' => 'admin',   'name' => 'Zain Admin',   'page' => 'admin-login.php'],
    'zain2' => ['password' => '2', 'role' => 'teacher', 'name' => 'Zain Teacher', 'page' => 'teacher-login.php'],
    'zain3' => ['password' => '3', 'role' => 'student', 'name' => 'Zain Student', 'page' => 'student-login.php'],
    'zain4' => ['password' => '4', 'role' => 'parent',  'name' => 'Zain Parent',  'page' => 'parent-login.php'],
];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Sunrise Public School</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
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

        /* =====================================================
           BUTTONS
           ===================================================== */
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

        .btn-primary-dark {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.35);
        }

        .btn-primary-dark:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.5);
        }

        /* =====================================================
           TOPBAR
           ===================================================== */
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

        .topbar-left { display: flex; gap: 25px; flex-wrap: wrap; }

        .topbar-left span i { margin-right: 6px; color: var(--secondary); }

        .topbar-right { display: flex; gap: 8px; }

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

        .topbar-right a:hover { background: var(--secondary); transform: translateY(-2px); }

        /* =====================================================
           NAVBAR
           ===================================================== */
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

        .logo { display: flex; align-items: center; gap: 12px; }

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
        .nav-menu ul li a.active { color: var(--primary); }

        .nav-menu ul li a:hover::after,
        .nav-menu ul li a.active::after { width: 100%; }

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
        }

        .btn-login:hover { background: var(--secondary); transform: translateY(-2px); }

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

        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* =====================================================
           PAGE BANNER
           ===================================================== */
        .page-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 58, 138, 0.75)),
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1600') center/cover;
            color: var(--white);
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: rgba(245, 158, 11, 0.15);
            border-radius: 50%;
        }

        .page-banner::after {
            content: '';
            position: absolute;
            bottom: -60%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(59, 130, 246, 0.15);
            border-radius: 50%;
        }

        .page-banner h1 {
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.8s ease;
        }

        .page-banner h1 span { color: var(--secondary); }

        .page-banner p {
            font-size: 17px;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto 25px;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.8s ease 0.2s backwards;
        }

        .breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 10px 25px;
            border-radius: 30px;
            font-size: 14px;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.8s ease 0.4s backwards;
        }

        .breadcrumb a { color: var(--white); }
        .breadcrumb a:hover { color: var(--secondary); }
        .breadcrumb span { color: var(--secondary); font-weight: 600; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =====================================================
           SECTION HEADER (Common)
           ===================================================== */
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

        .section-desc { color: var(--gray); font-size: 16px; }

        /* =====================================================
           ABOUT INTRO SECTION
           ===================================================== */
        .about-intro {
            padding: 100px 0;
            background: var(--white);
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

        .about-image .img2 {
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 200px;
            height: 200px;
            border-radius: 15px;
            border: 6px solid var(--white);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
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
            margin-bottom: 18px;
            font-size: 16px;
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0;
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

        /* =====================================================
           VISION MISSION SECTION
           ===================================================== */
        .vm-section {
            padding: 100px 0;
            background: var(--light);
        }

        .vm-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .vm-card {
            background: var(--white);
            padding: 45px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-bottom: 5px solid transparent;
        }

        .vm-card::before {
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

        .vm-card:hover::before { left: 0; }

        .vm-card > * { position: relative; z-index: 1; transition: color 0.3s; }

        .vm-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(30, 58, 138, 0.25);
            border-bottom-color: var(--secondary);
        }

        .vm-card:hover h3,
        .vm-card:hover p { color: var(--white); }

        .vm-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.25);
        }

        .vm-card:hover .vm-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        }

        .vm-card h3 {
            font-size: 22px;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .vm-card p { color: var(--gray); font-size: 14px; line-height: 1.8; }

        /* =====================================================
           JOURNEY / TIMELINE SECTION
           ===================================================== */
        .journey-section {
            padding: 100px 0;
            background: var(--white);
        }

        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            width: 50%;
            padding: 20px 40px;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
            text-align: left;
        }

        .timeline-content {
            background: var(--white);
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            position: relative;
            border-left: 4px solid var(--secondary);
            transition: all 0.3s ease;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            border-left: none;
            border-right: 4px solid var(--secondary);
        }

        .timeline-content:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.15);
        }

        .timeline-year {
            display: inline-block;
            background: var(--secondary);
            color: var(--white);
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .timeline-content h3 {
            font-size: 18px;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .timeline-content p { color: var(--gray); font-size: 14px; }

        .timeline-dot {
            position: absolute;
            top: 40px;
            width: 20px;
            height: 20px;
            background: var(--secondary);
            border: 4px solid var(--white);
            border-radius: 50%;
            box-shadow: 0 0 0 4px var(--secondary);
        }

        .timeline-item:nth-child(odd) .timeline-dot { right: -10px; }
        .timeline-item:nth-child(even) .timeline-dot { left: -10px; }

        /* =====================================================
           ACHIEVEMENTS SECTION
           ===================================================== */
        .achievements-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .achievements-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .achievements-section .section-title { color: var(--white); }
        .achievements-section .section-title span { color: var(--secondary); }
        .achievements-section .section-tag { color: var(--secondary); }
        .achievements-section .section-tag::before { background: var(--secondary); }
        .achievements-section .section-desc { color: rgba(255,255,255,0.85); }

        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
            z-index: 2;
        }

        .achievement-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 35px 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .achievement-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
        }

        .achievement-icon { font-size: 42px; margin-bottom: 15px; }

        .achievement-card h3 {
            font-size: 36px;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
            margin-bottom: 8px;
        }

        .achievement-card p { font-size: 14px; font-weight: 500; }

        /* =====================================================
           WHY CHOOSE US
           ===================================================== */
        .why-section {
            padding: 100px 0;
            background: var(--light);
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .why-card {
            background: var(--white);
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border-top: 4px solid transparent;
        }

        .why-card:hover {
            transform: translateY(-10px);
            border-top-color: var(--secondary);
            box-shadow: 0 20px 40px rgba(30, 58, 138, 0.15);
        }

        .why-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: var(--white);
            transition: all 0.4s ease;
        }

        .why-card:hover .why-icon {
            background: var(--secondary);
            transform: rotate(-10deg) scale(1.1);
        }

        .why-card h3 {
            font-size: 17px;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .why-card p { color: var(--gray); font-size: 14px; line-height: 1.6; }

        /* =====================================================
           TEAM / MANAGEMENT SECTION
           ===================================================== */
        .team-section {
            padding: 100px 0;
            background: var(--white);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .team-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            text-align: center;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.2);
        }

        .team-image {
            position: relative;
            overflow: hidden;
            height: 280px;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-card:hover .team-image img { transform: scale(1.1); }

        .team-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 58, 138, 0.95), transparent 60%);
            opacity: 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 20px;
            transition: opacity 0.4s ease;
        }

        .team-card:hover .team-overlay { opacity: 1; }

        .team-social {
            display: flex;
            gap: 10px;
        }

        .team-social a {
            width: 38px;
            height: 38px;
            background: var(--white);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .team-card:hover .team-social a {
            transform: translateY(0);
            opacity: 1;
        }

        .team-social a:hover { background: var(--secondary); color: var(--white); }

        .team-info { padding: 20px; }

        .team-info h3 {
            font-size: 18px;
            color: var(--primary);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .team-info p {
            color: var(--secondary);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* =====================================================
           CTA SECTION
           ===================================================== */
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

        .cta-text p { font-size: 17px; opacity: 0.9; }

        .cta-buttons { display: flex; gap: 15px; flex-wrap: wrap; }

        /* =====================================================
           FOOTER
           ===================================================== */
        .footer { background: var(--dark); color: #d1d5db; }

        .footer-top { padding: 70px 0 40px; }

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

        .footer-logo .logo-icon { width: 50px; height: 50px; }

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

        .footer-col p { font-size: 14px; margin-bottom: 20px; line-height: 1.8; }

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

        .footer-col ul li { margin-bottom: 12px; }

        .footer-col ul li a {
            font-size: 14px;
            color: #d1d5db;
            display: inline-block;
        }

        .footer-col ul li a:hover { color: var(--secondary); transform: translateX(5px); }

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

        .social-links { display: flex; gap: 10px; margin-top: 20px; }

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

        .social-links a:hover { background: var(--secondary); transform: translateY(-5px); }

        .footer-bottom {
            background: #0a0f1a;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* =====================================================
           BACK TO TOP
           ===================================================== */
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

        #backToTop.show { opacity: 1; visibility: visible; }
        #backToTop:hover { background: var(--primary); transform: translateY(-5px); }

        /* =====================================================
           SCROLL REVEAL
           ===================================================== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal.active { opacity: 1; transform: translateY(0); }

        /* =====================================================
           RESPONSIVE - TABLET
           ===================================================== */
        @media (max-width: 992px) {
            .page-banner h1 { font-size: 38px; }
            .page-banner p { font-size: 15px; }

            .about-grid { grid-template-columns: 1fr; gap: 40px; }

            .about-image .img2 {
                width: 150px;
                height: 150px;
                right: 10px;
                bottom: -20px;
            }

            .vm-grid { grid-template-columns: repeat(2, 1fr); }
            .achievements-grid { grid-template-columns: repeat(2, 1fr); }
            .why-grid { grid-template-columns: repeat(2, 1fr); }
            .team-grid { grid-template-columns: repeat(2, 1fr); }

            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
            .about-content h2 { font-size: 30px; }

            .cta-content { flex-direction: column; text-align: center; }
            .cta-text h2 { font-size: 28px; }

            .timeline-item { padding: 20px 30px; }
        }

        /* =====================================================
           RESPONSIVE - MOBILE
           ===================================================== */
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

            .page-banner { padding: 70px 0 50px; }
            .page-banner h1 { font-size: 28px; }
            .page-banner p { font-size: 14px; }
            .breadcrumb { font-size: 12px; padding: 8px 18px; }

            .vm-grid,
            .achievements-grid,
            .why-grid,
            .team-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .about-features { grid-template-columns: 1fr; }

            .section-title { font-size: 26px; }
            .about-content h2 { font-size: 24px; }

            .about-image img { height: 350px; }

            .about-image .img2 {
                width: 120px;
                height: 120px;
                border-width: 4px;
            }

            /* Timeline Mobile */
            .timeline::before { left: 20px; }

            .timeline-item {
                width: 100%;
                left: 0 !important;
                text-align: left !important;
                padding: 15px 0 15px 55px;
            }

            .timeline-item .timeline-content {
                border-left: 4px solid var(--secondary);
                border-right: none;
            }

            .timeline-item .timeline-dot {
                left: 10px !important;
                right: auto !important;
            }

            .cta-text h2 { font-size: 24px; }
            .cta-text p { font-size: 15px; }

            .about-intro,
            .vm-section,
            .journey-section,
            .achievements-section,
            .why-section,
            .team-section { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
        }
    </style>
</head>
<body>
    
    

<!-- ====================================================
     TOPBAR
     ===================================================== -->
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


<!-- =====================================================
     NAVBAR
     ===================================================== -->
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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="academics.php">Academics</a></li>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="faculty.php">Faculty</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="notice.php">Notice</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <<button type="button" class="btn-login" onclick="openLoginModal()">
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


<!-- =====================================================
     PAGE BANNER
     ===================================================== -->
<section class="page-banner">
    <div class="container">
        <h1>About <span>Our School</span></h1>
        <p>Learn about our history, mission, and the legacy of excellence we've built over three decades.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>About Us</span>
        </div>
    </div>
</section>


<!-- =====================================================
     ABOUT INTRO SECTION
     ===================================================== -->
<section class="about-intro">
    <div class="container">
        <div class="about-grid">

            <div class="about-image reveal">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800" alt="About School">
                <img class="img2" src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600" alt="School">
            </div>

            <div class="about-content reveal">
                <span class="section-tag">Who We Are</span>
                <h2>A Legacy of <span>Excellence</span> in Education</h2>
                <p>
                    Founded in 1995, Sunrise Public School has been a beacon of academic excellence
                    and holistic development. What began as a small institution with just 50 students
                    has now grown into one of the most reputed schools in the region, nurturing over
                    2500 students every year.
                </p>
                <p>
                    Our school is affiliated with CBSE and follows a comprehensive curriculum that
                    blends traditional values with modern teaching methodologies. We believe that
                    every child is unique and deserves an environment that fosters their individual
                    talents and prepares them for global challenges.
                </p>

                <div class="about-features">
                    <div class="feature-item"><span class="check">✔</span> CBSE Affiliated</div>
                    <div class="feature-item"><span class="check">✔</span> Smart Classrooms</div>
                    <div class="feature-item"><span class="check">✔</span> Modern Labs</div>
                    <div class="feature-item"><span class="check">✔</span> Expert Faculty</div>
                </div>

                <a href="admission.php" class="btn btn-primary-dark">
                    <i class="fas fa-graduation-cap"></i> Apply for Admission
                </a>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     VISION MISSION SECTION
     ===================================================== -->
<section class="vm-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Foundation</span>
            <h2 class="section-title">Vision, Mission & <span>Values</span></h2>
            <p class="section-desc">The core principles that guide us in shaping future generations.</p>
        </div>

        <div class="vm-grid">

            <div class="vm-card reveal">
                <div class="vm-icon"><i class="fas fa-eye"></i></div>
                <h3>Our Vision</h3>
                <p>
                    To be a globally recognized institution that nurtures young minds into
                    confident, compassionate, and responsible citizens who contribute
                    positively to society and the world.
                </p>
            </div>

            <div class="vm-card reveal">
                <div class="vm-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Our Mission</h3>
                <p>
                    To provide quality education that empowers students with knowledge,
                    skills, and values. We strive to create a stimulating learning
                    environment that encourages curiosity and innovation.
                </p>
            </div>

            <div class="vm-card reveal">
                <div class="vm-icon"><i class="fas fa-heart"></i></div>
                <h3>Our Values</h3>
                <p>
                    Integrity, respect, responsibility, excellence, and compassion form
                    the foundation of our school culture. We believe in nurturing
                    character along with academic excellence.
                </p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     JOURNEY / TIMELINE SECTION
     ===================================================== -->
<section class="journey-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Journey</span>
            <h2 class="section-title">Milestones in Our <span>History</span></h2>
            <p class="section-desc">Three decades of continuous growth and achievements.</p>
        </div>

        <div class="timeline">

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">1995</span>
                    <h3>Foundation of School</h3>
                    <p>Sunrise Public School was established with 50 students and 5 dedicated teachers.</p>
                </div>
            </div>

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2002</span>
                    <h3>CBSE Affiliation</h3>
                    <p>Received CBSE affiliation and expanded to classes up to 10th standard.</p>
                </div>
            </div>

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2008</span>
                    <h3>New Campus</h3>
                    <p>Inaugurated a state-of-the-art campus with modern infrastructure and facilities.</p>
                </div>
            </div>

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2015</span>
                    <h3>Senior Secondary</h3>
                    <p>Upgraded to Senior Secondary with Science, Commerce, and Arts streams.</p>
                </div>
            </div>

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2020</span>
                    <h3>Digital Transformation</h3>
                    <p>Adopted smart classrooms, online learning platforms, and digital resources.</p>
                </div>
            </div>

            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="timeline-year">2025</span>
                    <h3>30 Years of Excellence</h3>
                    <p>Celebrating three decades of nurturing over 2500 students annually.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     ACHIEVEMENTS SECTION
     ===================================================== -->
<section class="achievements-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Pride</span>
            <h2 class="section-title">Achievements & <span>Numbers</span></h2>
            <p class="section-desc">A glimpse of what we've accomplished together.</p>
        </div>

        <div class="achievements-grid">
            <div class="achievement-card reveal">
                <div class="achievement-icon">🏆</div>
                <h3 class="counter" data-target="150">0</h3>
                <p>Awards Won</p>
            </div>
            <div class="achievement-card reveal">
                <div class="achievement-icon">🎓</div>
                <h3 class="counter" data-target="5000">0</h3>
                <p>Alumni Network</p>
            </div>
            <div class="achievement-card reveal">
                <div class="achievement-icon">🥇</div>
                <h3 class="counter" data-target="250">0</h3>
                <p>Sports Medals</p>
            </div>
            <div class="achievement-card reveal">
                <div class="achievement-icon">📈</div>
                <h3 class="counter" data-target="98">0</h3>
                <p>Pass Percentage</p>
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     WHY CHOOSE US
     ===================================================== -->
<section class="why-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Why Choose Us</span>
            <h2 class="section-title">What Makes Us <span>Different</span></h2>
            <p class="section-desc">We go beyond textbooks to create well-rounded individuals.</p>
        </div>

        <div class="why-grid">

            <div class="why-card reveal">
                <div class="why-icon"><i class="fas fa-user-graduate"></i></div>
                <h3>Qualified Teachers</h3>
                <p>Highly experienced and dedicated faculty members committed to student success.</p>
            </div>

            <div class="why-card reveal">
                <div class="why-icon"><i class="fas fa-laptop-code"></i></div>
                <h3>Smart Learning</h3>
                <p>Digital classrooms with interactive boards and modern learning tools.</p>
            </div>

            <div class="why-card reveal">
                <div class="why-icon"><i class="fas fa-futbol"></i></div>
                <h3>Sports & Activities</h3>
                <p>Focus on physical development through various sports and co-curricular activities.</p>
            </div>

            <div class="why-card reveal">
                <div class="why-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Safe Environment</h3>
                <p>CCTV surveillance, trained staff, and secure campus for your child's safety.</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     TEAM / MANAGEMENT SECTION
     ===================================================== -->
<section class="team-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Leadership</span>
            <h2 class="section-title">Meet Our <span>Management Team</span></h2>
            <p class="section-desc">The visionary leaders behind our school's success.</p>
        </div>

        <div class="team-grid">

            <div class="team-card reveal">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600" alt="Director">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Mr. Suresh Sharma</h3>
                    <p>Director</p>
                </div>
            </div>

            <div class="team-card reveal">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600" alt="Principal">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Mr. Rajesh Kumar</h3>
                    <p>Principal</p>
                </div>
            </div>

            <div class="team-card reveal">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600" alt="Vice Principal">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Mrs. Anita Verma</h3>
                    <p>Vice Principal</p>
                </div>
            </div>

            <div class="team-card reveal">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600" alt="Academic Head">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h3>Mr. Amit Singh</h3>
                    <p>Academic Head</p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CTA SECTION
     ===================================================== -->
<section class="cta-section">
    <div class="container cta-content">
        <div class="cta-text">
            <h2>Become a Part of Our Family</h2>
            <p>Join thousands of students who are shaping their bright future with us.</p>
        </div>
        <div class="cta-buttons">
            <a href="admission.php" class="btn btn-primary">Apply Online Now</a>
            <a href="contact.php" class="btn btn-outline">Talk to Us</a>
        </div>
    </div>
</section>


<!-- =====================================================
     FOOTER
     ===================================================== -->
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
                        <li><a href="login.php">→ Student Login</a></li>
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


<!-- =====================================================
     INTERNAL JAVASCRIPT
     ===================================================== -->
<script>
    // =====================================================
    // MOBILE MENU TOGGLE
    // =====================================================
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

    // =====================================================
    // COUNTER ANIMATION
    // =====================================================
    function animateCounter(element) {
        const target = +element.getAttribute('data-target');
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const update = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current) + (target >= 100 ? '+' : '%');
                requestAnimationFrame(update);
            } else {
                element.textContent = target + (target >= 100 ? '+' : '%');
            }
        };
        update();
    }

    // =====================================================
    // SCROLL REVEAL + COUNTER TRIGGER
    // =====================================================
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
            const section = document.querySelector('.achievements-section');
            if (section) {
                const top = section.getBoundingClientRect().top;
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

    // =====================================================
    // BACK TO TOP
    // =====================================================
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // =====================================================
    // PAGE LOAD INIT
    // =====================================================
    window.addEventListener('scroll', handleScroll);

    document.addEventListener('DOMContentLoaded', () => {
        handleScroll();
    });
</script>
<!-- ============================================ -->
<!-- LOGIN MODAL - HAR PAGE ME PASTE KARO -->
<!-- ============================================ -->

<div class="lm-overlay" id="loginModal">
    <div class="lm-box">

        <button class="lm-close" onclick="closeLoginModal()">
            <i class="fas fa-times"></i>
        </button>

        <div id="lmRoleStep">
            <div class="lm-header">
                <div class="lm-logo">🎓</div>
                <h2>Welcome to <span>Sunrise Portal</span></h2>
                <p>Choose your role to continue</p>
            </div>

            <div class="lm-body">
                <div class="lm-title">Select Your Role</div>

                <div class="lm-roles">
                    <a href="admin-login.php" class="lm-role-card admin">
                        <div class="lm-role-icon"><i class="fas fa-user-shield"></i></div>
                        <h3>Admin</h3>
                        <p>Full management</p>
                    </a>

                    <a href="teacher-login.php" class="lm-role-card teacher">
                        <div class="lm-role-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>Teacher</h3>
                        <p>Manage classes</p>
                    </a>

                    <a href="student-login.php" class="lm-role-card student">
                        <div class="lm-role-icon"><i class="fas fa-user-graduate"></i></div>
                        <h3>Student</h3>
                        <p>View marks</p>
                    </a>

                    <a href="parent-login.php" class="lm-role-card parent">
                        <div class="lm-role-icon"><i class="fas fa-users"></i></div>
                        <h3>Parent</h3>
                        <p>Track child</p>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.lm-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(8px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
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
.lm-close:hover { background: #ef4444; transform: rotate(90deg); }

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
    color: #fff;
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
    text-decoration: none;
    display: block;
    color: inherit;
    font-family: 'Poppins', sans-serif;
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
.lm-role-card p { font-size: 12px; color: #6b7280; }

@media (max-width: 768px) {
    .lm-roles { grid-template-columns: 1fr 1fr; gap: 12px; }
    .lm-role-card { padding: 20px 12px 16px; }
    .lm-role-icon { width: 55px; height: 55px; font-size: 24px; margin-bottom: 12px; }
    .lm-role-card h3 { font-size: 14px; }
    .lm-role-card p { font-size: 11px; }
    .lm-header { padding: 30px 25px 25px; }
    .lm-header h2 { font-size: 20px; }
    .lm-body { padding: 25px 22px; }
}
@media (max-width: 480px) {
    .lm-roles { grid-template-columns: 1fr; }
}
</style>

<script>
function openLoginModal() {
    document.getElementById('loginModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLoginModal() {
    document.getElementById('loginModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) closeLoginModal();
        });
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLoginModal();
});
</script>

</body>
</html>