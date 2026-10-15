<?php
session_start();

// ---------- USERS ----------
$users = [
    'zain1' => ['password' => '1', 'role' => 'admin',   'name' => 'Zain Admin',   'page' => 'admin-login.php'],
    'zain2' => ['password' => '2', 'role' => 'teacher', 'name' => 'Zain Teacher', 'page' => 'teacher-login.php'],
    'zain3' => ['password' => '3', 'role' => 'student', 'name' => 'Zain Student', 'page' => 'student-login.php'],
    'zain4' => ['password' => '4', 'role' => 'parent',  'name' => 'Zain Parent',  'page' => 'parent-login.php'],
];
// ============================================
// Sunrise Public School - Faculty Page
// Teachers Profiles with Filter System
// ============================================

// ---------- TEACHERS DATA (Array me) ----------
// Baad me aap isko database se laa sakte ho
$teachers = [
    [
        'name' => 'Mr. Rajesh Kumar',
        'designation' => 'Principal',
        'subject' => 'Administration',
        'department' => 'admin',
        'qualification' => 'M.A., B.Ed., Ph.D.',
        'experience' => '25+ Years',
        'email' => 'principal@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mrs. Anita Verma',
        'designation' => 'Vice Principal',
        'subject' => 'English',
        'department' => 'english',
        'qualification' => 'M.A. English, B.Ed.',
        'experience' => '20+ Years',
        'email' => 'anita@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Amit Singh',
        'designation' => 'HOD Mathematics',
        'subject' => 'Mathematics',
        'department' => 'maths',
        'qualification' => 'M.Sc. Maths, B.Ed.',
        'experience' => '18+ Years',
        'email' => 'amit@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mrs. Priya Sharma',
        'designation' => 'HOD Science',
        'subject' => 'Physics',
        'department' => 'science',
        'qualification' => 'M.Sc. Physics, B.Ed.',
        'experience' => '15+ Years',
        'email' => 'priya@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Suresh Patel',
        'designation' => 'Senior Teacher',
        'subject' => 'Chemistry',
        'department' => 'science',
        'qualification' => 'M.Sc. Chemistry, B.Ed.',
        'experience' => '12+ Years',
        'email' => 'suresh@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Ms. Neha Gupta',
        'designation' => 'Senior Teacher',
        'subject' => 'Biology',
        'department' => 'science',
        'qualification' => 'M.Sc. Biology, B.Ed.',
        'experience' => '10+ Years',
        'email' => 'neha@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Vikram Yadav',
        'designation' => 'Senior Teacher',
        'subject' => 'Computer Science',
        'department' => 'computer',
        'qualification' => 'MCA, B.Ed.',
        'experience' => '14+ Years',
        'email' => 'vikram@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mrs. Kavita Joshi',
        'designation' => 'Senior Teacher',
        'subject' => 'Hindi',
        'department' => 'hindi',
        'qualification' => 'M.A. Hindi, B.Ed.',
        'experience' => '16+ Years',
        'email' => 'kavita@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Rohan Mehta',
        'designation' => 'Teacher',
        'subject' => 'Social Science',
        'department' => 'social',
        'qualification' => 'M.A. History, B.Ed.',
        'experience' => '8+ Years',
        'email' => 'rohan@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Ms. Simran Kaur',
        'designation' => 'Teacher',
        'subject' => 'Commerce',
        'department' => 'commerce',
        'qualification' => 'M.Com, B.Ed.',
        'experience' => '9+ Years',
        'email' => 'simran@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Arjun Rao',
        'designation' => 'Sports Teacher',
        'subject' => 'Physical Education',
        'department' => 'sports',
        'qualification' => 'M.P.Ed.',
        'experience' => '11+ Years',
        'email' => 'arjun@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1566492031773-4f4e44671857?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mrs. Meera Iyer',
        'designation' => 'Art Teacher',
        'subject' => 'Fine Arts',
        'department' => 'arts',
        'qualification' => 'M.F.A.',
        'experience' => '7+ Years',
        'email' => 'meera@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mr. Karan Malhotra',
        'designation' => 'Music Teacher',
        'subject' => 'Music',
        'department' => 'arts',
        'qualification' => 'M.A. Music',
        'experience' => '6+ Years',
        'email' => 'karan@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Ms. Pooja Reddy',
        'designation' => 'Primary Teacher',
        'subject' => 'All Subjects',
        'department' => 'primary',
        'qualification' => 'B.El.Ed.',
        'experience' => '5+ Years',
        'email' => 'pooja@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
    [
        'name' => 'Mrs. Sunita Desai',
        'designation' => 'Pre-Primary Teacher',
        'subject' => 'Pre-Primary',
        'department' => 'primary',
        'qualification' => 'NTT, B.A.',
        'experience' => '12+ Years',
        'email' => 'sunita@sunriseschool.com',
        'photo' => 'https://images.unsplash.com/photo-1554151228-14d9def656e4?w=500',
        'social' => ['facebook' => '#', 'twitter' => '#', 'linkedin' => '#']
    ],
];

// ---------- DEPARTMENT COUNTS ----------
$dept_counts = [];
foreach ($teachers as $t) {
    $dept = $t['department'];
    $dept_counts[$dept] = ($dept_counts[$dept] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty | Sunrise Public School</title>

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

        /* =====================================================
           BUTTONS
           ===================================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
                        url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1600') center/cover;
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
           STATS SECTION
           ===================================================== */
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

        .stat-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: var(--secondary);
        }

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

        /* =====================================================
           FACULTY SECTION
           ===================================================== */
        .faculty-section {
            padding: 100px 0;
            background: var(--white);
        }

        /* Filter Buttons */
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }

        .filter-btn {
            padding: 11px 26px;
            border-radius: 30px;
            background: var(--light);
            color: var(--dark);
            border: 2px solid var(--border);
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .filter-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-3px);
        }

        .filter-btn.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--secondary);
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.3);
        }

        /* Faculty Grid */
        .faculty-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .faculty-card {
            background: var(--white);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            transition: all 0.4s ease;
            text-align: center;
            position: relative;
        }

        .faculty-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 55px rgba(30, 58, 138, 0.2);
        }

        .faculty-image {
            position: relative;
            overflow: hidden;
            height: 280px;
            background: var(--light);
        }

        .faculty-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .faculty-card:hover .faculty-image img { transform: scale(1.1); }

        .faculty-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 58, 138, 0.95), transparent 55%);
            opacity: 0;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 25px;
            transition: opacity 0.4s ease;
        }

        .faculty-card:hover .faculty-overlay { opacity: 1; }

        .faculty-social {
            display: flex;
            gap: 10px;
        }

        .faculty-social a {
            width: 40px;
            height: 40px;
            background: var(--white);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .faculty-card:hover .faculty-social a {
            transform: translateY(0);
            opacity: 1;
        }

        .faculty-social a:nth-child(1) { transition-delay: 0.05s; }
        .faculty-social a:nth-child(2) { transition-delay: 0.1s; }
        .faculty-social a:nth-child(3) { transition-delay: 0.15s; }

        .faculty-social a:hover {
            background: var(--secondary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .faculty-info {
            padding: 22px 20px 25px;
        }

        .faculty-info h3 {
            font-size: 18px;
            color: var(--primary);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .faculty-info .designation {
            color: var(--secondary);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            display: block;
        }

        .faculty-meta {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .faculty-meta span {
            background: var(--light);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            color: var(--dark);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .faculty-meta span i {
            color: var(--primary);
            font-size: 10px;
        }

        .faculty-qual {
            padding-top: 15px;
            border-top: 1px solid var(--border);
            font-size: 13px;
            color: var(--gray);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .faculty-qual i { color: var(--secondary); font-size: 14px; }

        /* No Results */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .no-results i {
            font-size: 60px;
            color: var(--border);
            margin-bottom: 15px;
            display: block;
        }

        .no-results h3 {
            font-size: 20px;
            color: var(--dark);
            margin-bottom: 8px;
        }

        /* =====================================================
           DEPARTMENTS SECTION
           ===================================================== */
        .departments-section {
            padding: 100px 0;
            background: var(--light);
        }

        .departments-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .dept-card {
            background: var(--white);
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            border-bottom: 4px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .dept-card::before {
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

        .dept-card:hover::before { left: 0; }

        .dept-card > * { position: relative; z-index: 1; transition: color 0.3s; }

        .dept-card:hover {
            transform: translateY(-10px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 25px 50px rgba(30, 58, 138, 0.25);
        }

        .dept-card:hover h3,
        .dept-card:hover p { color: var(--white); }

        .dept-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--white);
            transition: all 0.4s ease;
        }

        .dept-card:hover .dept-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
        }

        .dept-card h3 {
            font-size: 17px;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .dept-card .count {
            font-size: 13px;
            color: var(--gray);
            font-weight: 500;
        }

        /* =====================================================
           JOIN TEAM / CTA SECTION
           ===================================================== */
        .join-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .join-section::before,
        .join-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .join-section::before {
            width: 400px;
            height: 400px;
            top: -150px;
            left: -100px;
        }

        .join-section::after {
            width: 500px;
            height: 500px;
            bottom: -250px;
            right: -100px;
        }

        .join-content {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .join-text .section-tag { color: var(--secondary); }
        .join-text .section-tag::before { background: var(--secondary); }

        .join-text h2 {
            font-size: 38px;
            font-weight: 800;
            line-height: 1.2;
            margin: 15px 0 20px;
        }

        .join-text h2 span { color: var(--secondary); }

        .join-text p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 25px;
            line-height: 1.8;
        }

        .join-features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 30px;
        }

        .join-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 500;
        }

        .join-feature i {
            color: var(--secondary);
            font-size: 18px;
        }

        .join-image {
            text-align: center;
        }

        .join-image img {
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.3);
            border: 6px solid rgba(255,255,255,0.15);
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        /* =====================================================
           CTA SECTION
           ===================================================== */
        .cta-section {
            padding: 80px 0;
            background: var(--light);
            color: var(--dark);
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .cta-section p {
            font-size: 17px;
            color: var(--gray);
            margin-bottom: 25px;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .cta-buttons .btn-outline {
            color: var(--primary);
            border-color: var(--primary);
        }

        .cta-buttons .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
        }

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

            .stats-grid { grid-template-columns: repeat(2, 1fr); }

            .faculty-grid { grid-template-columns: repeat(3, 1fr); }
            .departments-grid { grid-template-columns: repeat(3, 1fr); }

            .join-content { grid-template-columns: 1fr; gap: 40px; }

            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
            .join-text h2 { font-size: 30px; }

            .cta-section h2 { font-size: 28px; }
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

            .stats-grid,
            .departments-grid,
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .faculty-grid {
                grid-template-columns: 1fr;
                max-width: 380px;
                margin: 0 auto;
            }

            .filter-buttons { gap: 8px; }
            .filter-btn { padding: 9px 18px; font-size: 13px; }

            .section-title { font-size: 26px; }
            .join-text h2 { font-size: 24px; }

            .join-image img { height: 320px; }

            .cta-section h2 { font-size: 24px; }
            .cta-section p { font-size: 15px; }

            .faculty-section,
            .departments-section,
            .join-section { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
            .stat-card h3 { font-size: 32px; }
            .stat-icon { width: 55px; height: 55px; font-size: 24px; }
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
                <li><a href="academics.php">Academics</a></li>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="faculty.php" class="active">Faculty</a></li>
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


<!-- =====================================================
     PAGE BANNER
     ===================================================== -->
<section class="page-banner">
    <div class="container">
        <h1>Our <span>Faculty</span></h1>
        <p>Meet our team of dedicated educators who inspire, guide, and shape the future generation.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Faculty</span>
        </div>
    </div>
</section>


<!-- =====================================================
     STATS SECTION
     ===================================================== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <h3 class="counter" data-target="<?php echo count($teachers); ?>">0</h3>
                <p>Expert Teachers</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-book-reader"></i></div>
                <h3 class="counter" data-target="<?php echo count($dept_counts); ?>">0</h3>
                <p>Departments</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-award"></i></div>
                <h3 class="counter" data-target="15">0</h3>
                <p>Avg. Experience</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                <h3 class="counter" data-target="98">0</h3>
                <p>Success Rate %</p>
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     FACULTY SECTION
     ===================================================== -->
<section class="faculty-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Meet Our Team</span>
            <h2 class="section-title">Our Expert <span>Faculty Members</span></h2>
            <p class="section-desc">Highly qualified and experienced teachers dedicated to nurturing every student.</p>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons reveal">
            <button class="filter-btn active" onclick="filterFaculty('all', this)">All Teachers</button>
            <button class="filter-btn" onclick="filterFaculty('admin', this)">Administration</button>
            <button class="filter-btn" onclick="filterFaculty('science', this)">Science</button>
            <button class="filter-btn" onclick="filterFaculty('maths', this)">Mathematics</button>
            <button class="filter-btn" onclick="filterFaculty('english', this)">English</button>
            <button class="filter-btn" onclick="filterFaculty('hindi', this)">Hindi</button>
            <button class="filter-btn" onclick="filterFaculty('computer', this)">Computer</button>
            <button class="filter-btn" onclick="filterFaculty('social', this)">Social Science</button>
            <button class="filter-btn" onclick="filterFaculty('commerce', this)">Commerce</button>
            <button class="filter-btn" onclick="filterFaculty('primary', this)">Primary</button>
            <button class="filter-btn" onclick="filterFaculty('arts', this)">Arts</button>
            <button class="filter-btn" onclick="filterFaculty('sports', this)">Sports</button>
        </div>

        <!-- Faculty Grid -->
        <div class="faculty-grid" id="facultyGrid">

            <?php foreach ($teachers as $teacher): ?>
            <div class="faculty-card reveal" data-department="<?php echo $teacher['department']; ?>">
                <div class="faculty-image">
                    <img src="<?php echo $teacher['photo']; ?>" alt="<?php echo $teacher['name']; ?>">
                    <div class="faculty-overlay">
                        <div class="faculty-social">
                            <a href="<?php echo $teacher['social']['facebook']; ?>" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?php echo $teacher['social']['twitter']; ?>" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="<?php echo $teacher['social']['linkedin']; ?>" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="faculty-info">
                    <h3><?php echo $teacher['name']; ?></h3>
                    <span class="designation"><?php echo $teacher['designation']; ?></span>
                    <div class="faculty-meta">
                        <span><i class="fas fa-book"></i> <?php echo $teacher['subject']; ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo $teacher['experience']; ?></span>
                    </div>
                    <div class="faculty-qual">
                        <i class="fas fa-graduation-cap"></i>
                        <span><?php echo $teacher['qualification']; ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="fas fa-user-slash"></i>
                <h3>No teachers found</h3>
                <p>Try selecting a different department.</p>
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
            <p class="section-desc">Each department is led by experienced faculty members.</p>
        </div>

        <div class="departments-grid">

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-atom"></i></div>
                <h3>Science</h3>
                <p class="count"><?php echo $dept_counts['science'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-calculator"></i></div>
                <h3>Mathematics</h3>
                <p class="count"><?php echo $dept_counts['maths'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-language"></i></div>
                <h3>English</h3>
                <p class="count"><?php echo $dept_counts['english'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-feather-alt"></i></div>
                <h3>Hindi</h3>
                <p class="count"><?php echo $dept_counts['hindi'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-laptop-code"></i></div>
                <h3>Computer Science</h3>
                <p class="count"><?php echo $dept_counts['computer'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-globe-asia"></i></div>
                <h3>Social Science</h3>
                <p class="count"><?php echo $dept_counts['social'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-briefcase"></i></div>
                <h3>Commerce</h3>
                <p class="count"><?php echo $dept_counts['commerce'] ?? 0; ?> Teachers</p>
            </div>

            <div class="dept-card reveal">
                <div class="dept-icon"><i class="fas fa-palette"></i></div>
                <h3>Arts & Music</h3>
                <p class="count"><?php echo $dept_counts['arts'] ?? 0; ?> Teachers</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     JOIN TEAM SECTION
     ===================================================== -->
<section class="join-section">
    <div class="container">
        <div class="join-content">

            <div class="join-text reveal">
                <span class="section-tag">Join Our Team</span>
                <h2>Become a Part of Our <span>Teaching Family</span></h2>
                <p>
                    We are always looking for passionate and talented educators who want to
                    make a difference in the lives of young learners. If you share our vision
                    of excellence in education, we'd love to hear from you.
                </p>

                <div class="join-features">
                    <div class="join-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Competitive Salary Package</span>
                    </div>
                    <div class="join-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Professional Development Programs</span>
                    </div>
                    <div class="join-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Supportive Work Environment</span>
                    </div>
                    <div class="join-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Career Growth Opportunities</span>
                    </div>
                </div>

                <a href="contact.php" class="btn btn-primary">
                    <i class="fas fa-briefcase"></i> Apply for Teaching Job
                </a>
            </div>

            <div class="join-image reveal">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800" alt="Join Our Team">
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CTA SECTION
     ===================================================== -->
<section class="cta-section">
    <div class="container">
        <h2>Have Questions About Our Faculty?</h2>
        <p>Reach out to us for any queries about our teaching staff or departments.</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary">Contact Us</a>
            <a href="admission.php" class="btn btn-outline">Apply for Admission</a>
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
    // FACULTY FILTER
    // =====================================================
    function filterFaculty(department, btn) {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const cards = document.querySelectorAll('.faculty-card');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardDept = card.getAttribute('data-department');

            if (department === 'all' || cardDept === department) {
                card.style.display = 'block';
                card.style.animation = 'fadeUp 0.5s ease forwards';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

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
                element.textContent = Math.floor(current) + (target >= 100 ? '+' : '');
                requestAnimationFrame(update);
            } else {
                element.textContent = target + (target >= 100 ? '+' : '');
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