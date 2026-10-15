<?php
// ============================================
// Sunrise Public School - Academics Page
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academics | Sunrise Public School</title>

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

        .nav-menu { display: flex; align-items: center; gap: 30px; }

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
                        url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1600') center/cover;
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
           SECTION HEADER
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
           ACADEMIC INTRO
           ===================================================== */
        .academic-intro {
            padding: 100px 0;
            background: var(--white);
        }

        .intro-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .intro-image { position: relative; }

        .intro-image img {
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .intro-badge {
            position: absolute;
            bottom: -25px;
            left: -25px;
            background: var(--primary);
            color: var(--white);
            padding: 25px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(30, 58, 138, 0.4);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .intro-badge i {
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 8px;
            display: block;
        }

        .intro-badge h3 {
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .intro-badge p { font-size: 12px; font-weight: 500; letter-spacing: 1px; }

        .intro-content h2 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.2;
            margin: 15px 0 20px;
            color: var(--dark);
        }

        .intro-content h2 span { color: var(--primary); }

        .intro-content > p {
            color: var(--gray);
            margin-bottom: 18px;
            font-size: 16px;
        }

        .intro-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 25px 0;
        }

        .intro-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: var(--light);
            border-radius: 10px;
            border-left: 3px solid var(--secondary);
            transition: all 0.3s ease;
        }

        .intro-feature:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateX(5px);
        }

        .intro-feature i {
            color: var(--secondary);
            font-size: 20px;
            flex-shrink: 0;
        }

        .intro-feature:hover i { color: var(--secondary); }

        .intro-feature span { font-weight: 500; font-size: 14px; }

        /* =====================================================
           CLASSES / STAGES SECTION
           ===================================================== */
        .stages-section {
            padding: 100px 0;
            background: var(--light);
        }

        .stages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .stage-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            border-top: 5px solid transparent;
        }

        .stage-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(30, 58, 138, 0.2);
            border-top-color: var(--secondary);
        }

        .stage-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 30px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stage-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .stage-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 12px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            border: 2px solid rgba(255,255,255,0.25);
        }

        .stage-header h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stage-header p {
            font-size: 13px;
            opacity: 0.9;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .stage-body {
            padding: 25px;
        }

        .stage-body h4 {
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stage-body h4 i { color: var(--secondary); }

        .subject-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .subject-tag {
            background: var(--light);
            color: var(--dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .stage-card:hover .subject-tag {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .stage-info {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .stage-info div {
            text-align: center;
        }

        .stage-info strong {
            display: block;
            color: var(--primary);
            font-size: 18px;
            font-weight: 700;
        }

        .stage-info span {
            font-size: 11px;
            color: var(--gray);
            letter-spacing: 0.5px;
        }

        /* =====================================================
           STREAMS SECTION
           ===================================================== */
        .streams-section {
            padding: 100px 0;
            background: var(--white);
        }

        .streams-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .stream-card {
            background: var(--white);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            text-align: center;
            border: 2px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .stream-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .stream-card:hover::before { transform: scaleX(1); }

        .stream-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(30, 58, 138, 0.15);
        }

        .stream-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--white);
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.25);
        }

        .stream-card:hover .stream-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        }

        .stream-card h3 {
            font-size: 22px;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .stream-card p {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 20px;
        }

        .stream-subjects {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .stream-subjects span {
            background: var(--light);
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            color: var(--dark);
            font-weight: 500;
        }

        /* =====================================================
           CURRICULUM SECTION
           ===================================================== */
        .curriculum-section {
            padding: 100px 0;
            background: var(--light);
        }

        .curriculum-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .curriculum-card {
            background: var(--white);
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid transparent;
        }

        .curriculum-card::before {
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

        .curriculum-card:hover::before { left: 0; }

        .curriculum-card > * { position: relative; z-index: 1; transition: color 0.3s; }

        .curriculum-card:hover {
            transform: translateY(-10px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.25);
        }

        .curriculum-card:hover h3,
        .curriculum-card:hover p { color: var(--white); }

        .curriculum-icon {
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

        .curriculum-card:hover .curriculum-icon {
            background: var(--secondary);
            transform: rotate(-10deg) scale(1.1);
        }

        .curriculum-card h3 {
            font-size: 17px;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .curriculum-card p { color: var(--gray); font-size: 13px; line-height: 1.6; }

        /* =====================================================
           EXAM PATTERN / TABS SECTION
           ===================================================== */
        .exam-section {
            padding: 100px 0;
            background: var(--white);
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .tab-btn {
            padding: 12px 30px;
            border-radius: 30px;
            background: var(--light);
            color: var(--dark);
            border: 2px solid transparent;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .tab-btn:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .tab-btn.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--secondary);
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active { display: block; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .exam-card {
            background: var(--light);
            border-radius: 20px;
            padding: 50px 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .exam-info h3 {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 800;
        }

        .exam-info p {
            color: var(--gray);
            font-size: 15px;
            margin-bottom: 25px;
        }

        .exam-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .exam-item {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            padding: 15px 20px;
            background: var(--white);
            border-radius: 12px;
            border-left: 4px solid var(--secondary);
            box-shadow: 0 3px 10px rgba(0,0,0,0.04);
        }

        .exam-item-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .exam-item-text h4 {
            font-size: 15px;
            color: var(--primary);
            margin-bottom: 3px;
            font-weight: 700;
        }

        .exam-item-text p {
            font-size: 13px;
            color: var(--gray);
            margin: 0;
        }

        .exam-image img {
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        /* =====================================================
           ACADEMIC CALENDAR / HIGHLIGHTS
           ===================================================== */
        .calendar-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .calendar-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .calendar-section .section-title { color: var(--white); }
        .calendar-section .section-title span { color: var(--secondary); }
        .calendar-section .section-tag { color: var(--secondary); }
        .calendar-section .section-tag::before { background: var(--secondary); }
        .calendar-section .section-desc { color: rgba(255,255,255,0.85); }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
            z-index: 2;
        }

        .calendar-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 30px 25px;
            border-radius: 15px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .calendar-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
        }

        .calendar-month {
            display: inline-block;
            background: var(--secondary);
            color: var(--white);
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .calendar-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .calendar-card p {
            font-size: 13px;
            opacity: 0.85;
            line-height: 1.6;
        }

        /* =====================================================
           FACULTY / DEPARTMENTS
           ===================================================== */
        .departments-section {
            padding: 100px 0;
            background: var(--light);
        }

        .departments-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .dept-card {
            background: var(--white);
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            gap: 20px;
            border-left: 4px solid var(--primary);
        }

        .dept-card:hover {
            transform: translateX(10px);
            border-left-color: var(--secondary);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.15);
        }

        .dept-icon {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            transition: all 0.4s ease;
        }

        .dept-card:hover .dept-icon {
            background: var(--secondary);
            transform: rotate(360deg);
        }

        .dept-info h3 {
            font-size: 17px;
            color: var(--primary);
            margin-bottom: 4px;
            font-weight: 700;
        }

        .dept-info p { color: var(--gray); font-size: 13px; }

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

            .intro-grid { grid-template-columns: 1fr; gap: 50px; }
            .intro-badge { left: 20px; bottom: -20px; }

            .stages-grid { grid-template-columns: repeat(2, 1fr); }
            .streams-grid { grid-template-columns: 1fr; }
            .curriculum-grid { grid-template-columns: repeat(2, 1fr); }
            .calendar-grid { grid-template-columns: repeat(2, 1fr); }
            .departments-grid { grid-template-columns: repeat(2, 1fr); }

            .exam-card {
                grid-template-columns: 1fr;
                padding: 35px 25px;
            }

            .exam-image { order: -1; }
            .exam-image img { height: 300px; }

            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
            .intro-content h2 { font-size: 30px; }

            .cta-content { flex-direction: column; text-align: center; }
            .cta-text h2 { font-size: 28px; }
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

            .stages-grid,
            .curriculum-grid,
            .calendar-grid,
            .departments-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .intro-features { grid-template-columns: 1fr; }

            .section-title { font-size: 26px; }
            .intro-content h2 { font-size: 24px; }

            .intro-image img { height: 350px; }
            .intro-badge { padding: 18px 22px; }
            .intro-badge h3 { font-size: 20px; }

            .exam-info h3 { font-size: 22px; }
            .exam-card { padding: 25px 20px; gap: 25px; }

            .tabs { gap: 10px; }
            .tab-btn { padding: 10px 20px; font-size: 13px; }

            .cta-text h2 { font-size: 24px; }
            .cta-text p { font-size: 15px; }

            .academic-intro,
            .stages-section,
            .streams-section,
            .curriculum-section,
            .exam-section,
            .calendar-section,
            .departments-section { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
            .stage-info strong { font-size: 15px; }
        }
    </style>
</head>
<body>

<!-- =====================================================
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
                <li><a href="about.php">About</a></li>
                <li><a href="academics.php" class="active">Academics</a></li>
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
        <h1>Our <span>Academics</span></h1>
        <p>Explore our comprehensive curriculum designed to nurture young minds and prepare them for a bright future.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Academics</span>
        </div>
    </div>
</section>


<!-- =====================================================
     ACADEMIC INTRO
     ===================================================== -->
<section class="academic-intro">
    <div class="container">
        <div class="intro-grid">

            <div class="intro-image reveal">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800" alt="Academics">
                <div class="intro-badge">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>30+</h3>
                    <p>YEARS OF<br>ACADEMIC EXCELLENCE</p>
                </div>
            </div>

            <div class="intro-content reveal">
                <span class="section-tag">Academic Excellence</span>
                <h2>Comprehensive <span>Curriculum</span> for Holistic Growth</h2>
                <p>
                    At Sunrise Public School, we follow a balanced academic curriculum that
                    blends traditional teaching methods with modern learning practices. Our
                    focus is on developing critical thinking, creativity, and problem-solving
                    skills in every student.
                </p>
                <p>
                    From Nursery to Class 12, our academic program is structured to meet
                    the highest educational standards while nurturing each child's
                    unique potential.
                </p>

                <div class="intro-features">
                    <div class="intro-feature">
                        <i class="fas fa-book-open"></i>
                        <span>CBSE Curriculum</span>
                    </div>
                    <div class="intro-feature">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Expert Faculty</span>
                    </div>
                    <div class="intro-feature">
                        <i class="fas fa-flask"></i>
                        <span>Practical Learning</span>
                    </div>
                    <div class="intro-feature">
                        <i class="fas fa-award"></i>
                        <span>Continuous Assessment</span>
                    </div>
                </div>

                <a href="admission.php" class="btn btn-primary-dark">
                    <i class="fas fa-graduation-cap"></i> Apply for Admission
                </a>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CLASSES / STAGES SECTION
     ===================================================== -->
<section class="stages-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Academic Stages</span>
            <h2 class="section-title">Classes We <span>Offer</span></h2>
            <p class="section-desc">Structured learning stages designed for every age group.</p>
        </div>

        <div class="stages-grid">

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">🧒</div>
                    <h3>Pre-Primary</h3>
                    <p>NURSERY - UKG</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-book"></i> Subjects Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">English</span>
                        <span class="subject-tag">Hindi</span>
                        <span class="subject-tag">Maths</span>
                        <span class="subject-tag">EVS</span>
                        <span class="subject-tag">Rhymes</span>
                        <span class="subject-tag">Art</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>3-5</strong><span>AGE</span></div>
                        <div><strong>Play</strong><span>METHOD</span></div>
                        <div><strong>30</strong><span>STUDENTS</span></div>
                    </div>
                </div>
            </div>

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">📚</div>
                    <h3>Primary</h3>
                    <p>CLASS 1 - 5</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-book"></i> Subjects Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">English</span>
                        <span class="subject-tag">Hindi</span>
                        <span class="subject-tag">Maths</span>
                        <span class="subject-tag">EVS</span>
                        <span class="subject-tag">Computer</span>
                        <span class="subject-tag">GK</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>6-10</strong><span>AGE</span></div>
                        <div><strong>Activity</strong><span>METHOD</span></div>
                        <div><strong>35</strong><span>STUDENTS</span></div>
                    </div>
                </div>
            </div>

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">🔬</div>
                    <h3>Middle School</h3>
                    <p>CLASS 6 - 8</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-book"></i> Subjects Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">English</span>
                        <span class="subject-tag">Hindi</span>
                        <span class="subject-tag">Maths</span>
                        <span class="subject-tag">Science</span>
                        <span class="subject-tag">SST</span>
                        <span class="subject-tag">Computer</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>11-13</strong><span>AGE</span></div>
                        <div><strong>Concept</strong><span>METHOD</span></div>
                        <div><strong>40</strong><span>STUDENTS</span></div>
                    </div>
                </div>
            </div>

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">📐</div>
                    <h3>Secondary</h3>
                    <p>CLASS 9 - 10</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-book"></i> Subjects Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">English</span>
                        <span class="subject-tag">Hindi</span>
                        <span class="subject-tag">Maths</span>
                        <span class="subject-tag">Science</span>
                        <span class="subject-tag">SST</span>
                        <span class="subject-tag">IT</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>14-15</strong><span>AGE</span></div>
                        <div><strong>Board</strong><span>METHOD</span></div>
                        <div><strong>40</strong><span>STUDENTS</span></div>
                    </div>
                </div>
            </div>

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">🎓</div>
                    <h3>Senior Secondary</h3>
                    <p>CLASS 11 - 12</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-book"></i> Streams Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">Science</span>
                        <span class="subject-tag">Commerce</span>
                        <span class="subject-tag">Arts</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>16-18</strong><span>AGE</span></div>
                        <div><strong>Stream</strong><span>METHOD</span></div>
                        <div><strong>40</strong><span>STUDENTS</span></div>
                    </div>
                </div>
            </div>

            <div class="stage-card reveal">
                <div class="stage-header">
                    <div class="stage-icon">💡</div>
                    <h3>Co-Curricular</h3>
                    <p>ALL CLASSES</p>
                </div>
                <div class="stage-body">
                    <h4><i class="fas fa-star"></i> Activities Offered</h4>
                    <div class="subject-list">
                        <span class="subject-tag">Sports</span>
                        <span class="subject-tag">Music</span>
                        <span class="subject-tag">Dance</span>
                        <span class="subject-tag">Art</span>
                        <span class="subject-tag">Drama</span>
                        <span class="subject-tag">Debate</span>
                    </div>
                    <div class="stage-info">
                        <div><strong>All</strong><span>AGES</span></div>
                        <div><strong>Fun</strong><span>METHOD</span></div>
                        <div><strong>Open</strong><span>ENTRY</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     STREAMS SECTION
     ===================================================== -->
<section class="streams-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Class 11 & 12</span>
            <h2 class="section-title">Choose Your <span>Stream</span></h2>
            <p class="section-desc">Multiple streams to shape your career path.</p>
        </div>

        <div class="streams-grid">

            <div class="stream-card reveal">
                <div class="stream-icon">🔬</div>
                <h3>Science Stream</h3>
                <p>For aspiring doctors, engineers, and researchers with a strong foundation in science.</p>
                <div class="stream-subjects">
                    <span>Physics</span>
                    <span>Chemistry</span>
                    <span>Maths</span>
                    <span>Biology</span>
                    <span>Computer</span>
                </div>
            </div>

            <div class="stream-card reveal">
                <div class="stream-icon">💼</div>
                <h3>Commerce Stream</h3>
                <p>For future business leaders, accountants, and entrepreneurs.</p>
                <div class="stream-subjects">
                    <span>Accountancy</span>
                    <span>Business Studies</span>
                    <span>Economics</span>
                    <span>Maths</span>
                    <span>IP</span>
                </div>
            </div>

            <div class="stream-card reveal">
                <div class="stream-icon">🎨</div>
                <h3>Arts Stream</h3>
                <p>For creative minds interested in humanities, social sciences, and liberal arts.</p>
                <div class="stream-subjects">
                    <span>History</span>
                    <span>Geography</span>
                    <span>Pol. Science</span>
                    <span>Economics</span>
                    <span>Psychology</span>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CURRICULUM SECTION
     ===================================================== -->
<section class="curriculum-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Teaching Approach</span>
            <h2 class="section-title">Our <span>Curriculum</span> Highlights</h2>
            <p class="section-desc">A modern approach to learning that prepares students for the future.</p>
        </div>

        <div class="curriculum-grid">

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-laptop-code"></i></div>
                <h3>Smart Classes</h3>
                <p>Digital boards and interactive learning tools in every classroom.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-flask"></i></div>
                <h3>Practical Labs</h3>
                <p>Hands-on experiments in Physics, Chemistry, Biology, and Computer labs.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-users"></i></div>
                <h3>Small Batches</h3>
                <p>Limited students per class for personal attention to every child.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-clipboard-check"></i></div>
                <h3>Regular Tests</h3>
                <p>Weekly tests, unit tests, and term exams for continuous evaluation.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-book-reader"></i></div>
                <h3>Library Access</h3>
                <p>Rich collection of books, journals, and digital resources.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-user-tie"></i></div>
                <h3>Career Guidance</h3>
                <p>Expert counseling for career choices and higher education.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-globe"></i></div>
                <h3>Global Exposure</h3>
                <p>Workshops, competitions, and exchange programs for global learning.</p>
            </div>

            <div class="curriculum-card reveal">
                <div class="curriculum-icon"><i class="fas fa-heart"></i></div>
                <h3>Value Education</h3>
                <p>Moral science classes to build character and ethics.</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     EXAM PATTERN / TABS SECTION
     ===================================================== -->
<section class="exam-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Examination</span>
            <h2 class="section-title">Our Exam <span>Pattern</span></h2>
            <p class="section-desc">A structured assessment system for continuous student growth.</p>
        </div>

        <div class="tabs reveal">
            <button class="tab-btn active" onclick="openTab(event, 'primary')">Primary</button>
            <button class="tab-btn" onclick="openTab(event, 'middle')">Middle School</button>
            <button class="tab-btn" onclick="openTab(event, 'secondary')">Secondary</button>
            <button class="tab-btn" onclick="openTab(event, 'senior')">Senior Secondary</button>
        </div>

        <!-- Primary Tab -->
        <div class="tab-content active" id="primary">
            <div class="exam-card">
                <div class="exam-info">
                    <h3>Primary Level Assessment</h3>
                    <p>Focus on continuous and comprehensive evaluation with minimal exam pressure.</p>
                    <div class="exam-list">
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-pen"></i></div>
                            <div class="exam-item-text">
                                <h4>Unit Tests</h4>
                                <p>Monthly tests to assess understanding of each chapter.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="exam-item-text">
                                <h4>Half Yearly Exam</h4>
                                <p>Comprehensive exam covering first-term syllabus.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-trophy"></i></div>
                            <div class="exam-item-text">
                                <h4>Annual Exam</h4>
                                <p>Final exam with promotion to next class.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exam-image">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600" alt="Primary">
                </div>
            </div>
        </div>

        <!-- Middle Tab -->
        <div class="tab-content" id="middle">
            <div class="exam-card">
                <div class="exam-info">
                    <h3>Middle School Assessment</h3>
                    <p>Introduction to structured examination with regular feedback.</p>
                    <div class="exam-list">
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-pen"></i></div>
                            <div class="exam-item-text">
                                <h4>Periodic Tests</h4>
                                <p>Three periodic tests throughout the academic year.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="exam-item-text">
                                <h4>Term Exams</h4>
                                <p>Term 1 and Term 2 exams for structured evaluation.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-clipboard"></i></div>
                            <div class="exam-item-text">
                                <h4>Subject Enrichment</h4>
                                <p>Practical and project-based assessment.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exam-image">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600" alt="Middle">
                </div>
            </div>
        </div>

        <!-- Secondary Tab -->
        <div class="tab-content" id="secondary">
            <div class="exam-card">
                <div class="exam-info">
                    <h3>Secondary Level Assessment</h3>
                    <p>Preparing students for CBSE Board examinations with regular practice.</p>
                    <div class="exam-list">
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-book"></i></div>
                            <div class="exam-item-text">
                                <h4>Pre-Board Exams</h4>
                                <p>Two pre-boards to prepare for final board exams.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="exam-item-text">
                                <h4>Board Exam (Class 10)</h4>
                                <p>CBSE conducted board examination.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-flask"></i></div>
                            <div class="exam-item-text">
                                <h4>Practical Exams</h4>
                                <p>Science and computer practicals for skill assessment.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exam-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600" alt="Secondary">
                </div>
            </div>
        </div>

        <!-- Senior Tab -->
        <div class="tab-content" id="senior">
            <div class="exam-card">
                <div class="exam-info">
                    <h3>Senior Secondary Assessment</h3>
                    <p>Comprehensive preparation for Class 12 board exams and career goals.</p>
                    <div class="exam-list">
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-trophy"></i></div>
                            <div class="exam-item-text">
                                <h4>Pre-Board Exams</h4>
                                <p>Rigorous preparation for board exams with mock tests.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="exam-item-text">
                                <h4>Board Exam (Class 12)</h4>
                                <p>CBSE Class 12 board exams in chosen stream.</p>
                            </div>
                        </div>
                        <div class="exam-item">
                            <div class="exam-item-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="exam-item-text">
                                <h4>Career Counseling</h4>
                                <p>Guidance for college admissions and career paths.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="exam-image">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Senior">
                </div>
            </div>
        </div>

    </div>
</section>


<!-- =====================================================
     ACADEMIC CALENDAR / HIGHLIGHTS
     ===================================================== -->
<section class="calendar-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Session 2025-26</span>
            <h2 class="section-title">Academic <span>Calendar</span></h2>
            <p class="section-desc">Important dates and events throughout the academic year.</p>
        </div>

        <div class="calendar-grid">
            <div class="calendar-card reveal">
                <span class="calendar-month">APRIL</span>
                <h3>New Session Begins</h3>
                <p>Academic session 2025-26 starts with orientation program for all classes.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">AUGUST</span>
                <h3>Unit Test 1</h3>
                <p>First unit test to assess student's understanding of initial chapters.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">OCTOBER</span>
                <h3>Half Yearly Exams</h3>
                <p>Mid-term examinations covering the first half of the syllabus.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">DECEMBER</span>
                <h3>Annual Sports Day</h3>
                <p>Inter-house sports competition and cultural events.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">FEBRUARY</span>
                <h3>Pre-Board Exams</h3>
                <p>Mock exams for Class 10 and 12 students before board exams.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">MARCH</span>
                <h3>Board Exams</h3>
                <p>CBSE Board examinations for Class 10 and 12 students.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">MARCH</span>
                <h3>Annual Exams</h3>
                <p>Final examinations for all other classes with result declaration.</p>
            </div>
            <div class="calendar-card reveal">
                <span class="calendar-month">APRIL</span>
                <h3>Result & Prize Distribution</h3>
                <p>Annual result declaration and prize distribution ceremony.</p>
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     DEPARTMENTS SECTION
     ===================================================== -->
<section class="departments-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Departments</span>
            <h2 class="section-title">Academic <span>Departments</span></h2>
            <p class="section-desc">Expert departments dedicated to each subject area.</p>
        </div>

        <div class="departments-grid">

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-language"></i></div>
                <div class="dept-info">
                    <h3>Languages</h3>
                    <p>English, Hindi & Sanskrit</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-calculator"></i></div>
                <div class="dept-info">
                    <h3>Mathematics</h3>
                    <p>Pure & Applied Mathematics</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-atom"></i></div>
                <div class="dept-info">
                    <h3>Science</h3>
                    <p>Physics, Chemistry & Biology</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-globe-asia"></i></div>
                <div class="dept-info">
                    <h3>Social Science</h3>
                    <p>History, Geography & Civics</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-laptop"></i></div>
                <div class="dept-info">
                    <h3>Computer Science</h3>
                    <p>Programming & IT Skills</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-palette"></i></div>
                <div class="dept-info">
                    <h3>Fine Arts</h3>
                    <p>Drawing, Painting & Craft</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-music"></i></div>
                <div class="dept-info">
                    <h3>Music & Dance</h3>
                    <p>Vocal, Instrumental & Dance</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-running"></i></div>
                <div class="dept-info">
                    <h3>Physical Education</h3>
                    <p>Sports & Yoga</p>
                </div>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-briefcase"></i></div>
                <div class="dept-info">
                    <h3>Commerce</h3>
                    <p>Accountancy, Business & Eco</p>
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
            <h2>Ready to Join Our Academic Family?</h2>
            <p>Give your child the best education with our comprehensive curriculum.</p>
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
    // TABS FUNCTIONALITY
    // =====================================================
    function openTab(event, tabId) {
        // Hide all tab content
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.remove('active'));

        // Remove active from all buttons
        const tabBtns = document.querySelectorAll('.tab-btn');
        tabBtns.forEach(btn => btn.classList.remove('active'));

        // Show selected
        document.getElementById(tabId).classList.add('active');
        event.currentTarget.classList.add('active');
    }

    // =====================================================
    // SCROLL REVEAL
    // =====================================================
    const revealElements = document.querySelectorAll('.reveal');

    function handleScroll() {
        revealElements.forEach(el => {
            const top = el.getBoundingClientRect().top;
            const trigger = window.innerHeight - 100;
            if (top < trigger) el.classList.add('active');
        });

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