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
// Sunrise Public School - Notice Board Page
// Notices + Search + Category Filter + Download
// ============================================

// ---------- NOTICES DATA ----------
$notices = [
    [
        'id' => 1,
        'title' => 'Admission Open for Session 2025-26',
        'category' => 'admission',
        'date' => '2025-01-15',
        'priority' => 'high',
        'description' => 'Admissions are now open for the academic session 2025-26. Parents are requested to apply online through our website. Limited seats available. Last date to apply: 28th February 2025.',
        'file' => '#',
        'is_new' => true
    ],
    [
        'id' => 2,
        'title' => 'Half Yearly Exam Schedule Released',
        'category' => 'exam',
        'date' => '2025-01-10',
        'priority' => 'high',
        'description' => 'The half yearly examination for all classes will begin from 15th November 2025. Students can download the detailed date sheet from the school website. Exam timing: 9:00 AM to 12:00 PM.',
        'file' => '#',
        'is_new' => true
    ],
    [
        'id' => 3,
        'title' => 'Annual Sports Day - 25th December',
        'category' => 'event',
        'date' => '2025-01-08',
        'priority' => 'medium',
        'description' => 'Annual Sports Day will be celebrated on 25th December 2025. All students must participate in at least one event. Parents are cordially invited to attend. Sports uniform is mandatory.',
        'file' => '#',
        'is_new' => true
    ],
    [
        'id' => 4,
        'title' => 'Parent-Teacher Meeting on 10th February',
        'category' => 'general',
        'date' => '2025-01-05',
        'priority' => 'medium',
        'description' => 'A Parent-Teacher Meeting is scheduled on 10th February 2025 from 10:00 AM to 1:00 PM. Parents are requested to attend and discuss their child\'s progress with the respective teachers.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 5,
        'title' => 'Winter Vacation Notice',
        'category' => 'holiday',
        'date' => '2025-01-02',
        'priority' => 'low',
        'description' => 'The school will remain closed for winter vacation from 25th December 2025 to 5th January 2026. School will reopen on 6th January 2026. Happy holidays to all!',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 6,
        'title' => 'Inter-School Art Competition',
        'category' => 'event',
        'date' => '2024-12-28',
        'priority' => 'medium',
        'description' => 'An Inter-School Art Competition will be held on 5th December 2025 in our school auditorium. Interested students can register with their art teacher before 30th November.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 7,
        'title' => 'Class 10 & 12 Pre-Board Exam Dates',
        'category' => 'exam',
        'date' => '2024-12-22',
        'priority' => 'high',
        'description' => 'Pre-board examinations for Class 10 and 12 will commence from 5th February 2025. These exams are mandatory for all board students. Detailed schedule will be shared via email.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 8,
        'title' => 'Republic Day Celebration',
        'category' => 'event',
        'date' => '2024-12-20',
        'priority' => 'medium',
        'description' => 'Republic Day will be celebrated on 26th January 2026 with flag hoisting ceremony at 8:00 AM followed by cultural programs. All students must attend in proper uniform.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 9,
        'title' => 'Fee Payment Reminder - Last Date 31st Jan',
        'category' => 'general',
        'date' => '2024-12-15',
        'priority' => 'high',
        'description' => 'This is a gentle reminder to all parents to pay the pending school fees before 31st January 2025. Late payment will attract a fine of ₹500. Online payment is available on the website.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 10,
        'title' => 'Annual Function 2025 - Save the Date',
        'category' => 'event',
        'date' => '2024-12-10',
        'priority' => 'medium',
        'description' => 'Our Annual Function will be held on 15th February 2026 at 5:00 PM in the school auditorium. Students participating in cultural programs should contact their class teachers.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 11,
        'title' => 'New Library Books Added',
        'category' => 'general',
        'date' => '2024-12-05',
        'priority' => 'low',
        'description' => 'We are pleased to inform that 500+ new books have been added to our school library covering various subjects and fiction categories. Students can issue books during library hours.',
        'file' => '#',
        'is_new' => false
    ],
    [
        'id' => 12,
        'title' => 'Diwali Break Announcement',
        'category' => 'holiday',
        'date' => '2024-11-01',
        'priority' => 'low',
        'description' => 'The school will remain closed for Diwali break from 10th to 15th November 2024. Wishing all our students and their families a very Happy Diwali!',
        'file' => '#',
        'is_new' => false
    ],
];

// ---------- SORT BY DATE (Newest First) ----------
usort($notices, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// ---------- CATEGORY COUNTS ----------
$category_counts = [];
foreach ($notices as $n) {
    $cat = $n['category'];
    $category_counts[$cat] = ($category_counts[$cat] ?? 0) + 1;
}

// ---------- LATEST NOTICE HIGHLIGHT ----------
$latest_notice = $notices[0] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Board | Sunrise Public School</title>

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
            --red: #ef4444;
            --green: #10b981;
            --blue: #3b82f6;
            --purple: #8b5cf6;
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
                        url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1600') center/cover;
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
            margin: 0 auto 50px;
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
           FEATURED / LATEST NOTICE
           ===================================================== */
        .featured-notice-section {
            padding: 60px 0 20px;
            background: var(--white);
        }

        .featured-notice {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            border-radius: 20px;
            padding: 45px 50px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(30, 58, 138, 0.25);
        }

        .featured-notice::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .featured-notice::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 250px;
            height: 250px;
            background: rgba(245, 158, 11, 0.15);
            border-radius: 50%;
        }

        .featured-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--secondary);
            padding: 7px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .featured-badge .dot-pulse {
            width: 8px;
            height: 8px;
            background: var(--white);
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .featured-notice h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.3;
            position: relative;
            z-index: 2;
        }

        .featured-notice p {
            font-size: 16px;
            opacity: 0.95;
            margin-bottom: 25px;
            max-width: 800px;
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        .featured-meta {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .featured-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        .featured-meta span i { color: var(--secondary); }

        .featured-notice .btn {
            margin-top: 25px;
            position: relative;
            z-index: 2;
        }

        /* =====================================================
           NOTICE BOARD SECTION
           ===================================================== */
        .notice-section {
            padding: 80px 0 100px;
            background: var(--white);
        }

        /* Search + Filter Bar */
        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            background: var(--light);
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
        }

        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 15px;
        }

        .search-box input {
            width: 100%;
            padding: 13px 20px 13px 48px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--dark);
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        /* Category Filter Buttons */
        .category-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .cat-btn {
            padding: 10px 20px;
            border-radius: 25px;
            background: var(--white);
            color: var(--dark);
            border: 2px solid var(--border);
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .cat-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .cat-btn.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--secondary);
            box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3);
        }

        .cat-btn .count {
            background: rgba(255,255,255,0.25);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .cat-btn:not(.active) .count {
            background: var(--light);
            color: var(--primary);
            border: 1px solid var(--border);
        }

        /* Notices List */
        .notices-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .notice-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px 35px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            border-left: 5px solid var(--primary);
            display: grid;
            grid-template-columns: 90px 1fr auto;
            gap: 25px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .notice-card:hover {
            transform: translateX(8px);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.15);
            border-left-width: 8px;
        }

        /* Priority Colors */
        .notice-card.priority-high { border-left-color: var(--red); }
        .notice-card.priority-medium { border-left-color: var(--secondary); }
        .notice-card.priority-low { border-left-color: var(--green); }

        /* Date Box */
        .notice-date-box {
            text-align: center;
            background: var(--light);
            padding: 15px 10px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .notice-card:hover .notice-date-box {
            background: var(--primary);
            color: var(--white);
        }

        .notice-date-box .day {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            color: var(--primary);
            transition: color 0.3s;
        }

        .notice-card:hover .notice-date-box .day { color: var(--secondary); }

        .notice-date-box .month {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .notice-date-box .year {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 2px;
        }

        /* Content */
        .notice-content {
            flex: 1;
        }

        .notice-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .notice-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .notice-tag.category-admission { background: #dbeafe; color: #1e40af; }
        .notice-tag.category-exam { background: #fee2e2; color: #991b1b; }
        .notice-tag.category-event { background: #fef3c7; color: #92400e; }
        .notice-tag.category-general { background: #e0e7ff; color: #3730a3; }
        .notice-tag.category-holiday { background: #d1fae5; color: #065f46; }

        .notice-tag.new-tag {
            background: var(--red);
            color: var(--white);
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .notice-content h3 {
            font-size: 19px;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: 700;
            line-height: 1.4;
        }

        .notice-content p {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.7;
        }

        /* Action Buttons */
        .notice-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .action-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--light);
            color: var(--primary);
            position: relative;
        }

        .action-btn:hover {
            transform: scale(1.1);
            color: var(--white);
        }

        .action-btn.download:hover { background: var(--green); }
        .action-btn.view:hover { background: var(--primary); }
        .action-btn.share:hover { background: var(--secondary); }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 70px 20px;
            color: var(--gray);
        }

        .no-results i {
            font-size: 70px;
            color: var(--border);
            margin-bottom: 20px;
            display: block;
        }

        .no-results h3 {
            font-size: 22px;
            color: var(--dark);
            margin-bottom: 10px;
        }

        /* =====================================================
           NOTICE MODAL
           ===================================================== */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal.active { display: flex; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: var(--white);
            border-radius: 20px;
            max-width: 700px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            padding: 45px 40px;
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 40px;
            height: 40px;
            background: var(--light);
            color: var(--dark);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--red);
            color: var(--white);
            transform: rotate(90deg);
        }

        .modal-header {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border);
        }

        .modal-header h2 {
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .modal-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 13px;
            color: var(--gray);
        }

        .modal-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .modal-meta i { color: var(--secondary); }

        .modal-body p {
            color: var(--gray);
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .modal-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid var(--border);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* =====================================================
           CTA SECTION
           ===================================================== */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            text-align: center;
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
            width: 400px;
            height: 400px;
            top: -150px;
            left: -100px;
        }

        .cta-section::after {
            width: 500px;
            height: 500px;
            bottom: -250px;
            right: -100px;
        }

        .cta-section h2 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .cta-section p {
            font-size: 17px;
            margin-bottom: 25px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
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
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.active { opacity: 1; transform: translateY(0); }

        /* =====================================================
           RESPONSIVE - TABLET
           ===================================================== */
        @media (max-width: 992px) {
            .page-banner h1 { font-size: 38px; }
            .page-banner p { font-size: 15px; }

            .featured-notice { padding: 35px 30px; }
            .featured-notice h2 { font-size: 26px; }
            .featured-notice p { font-size: 15px; }

            .notice-card {
                grid-template-columns: 80px 1fr;
                gap: 20px;
                padding: 25px;
            }

            .notice-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: flex-end;
            }

            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
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

            .featured-notice { padding: 30px 25px; border-radius: 15px; }
            .featured-notice h2 { font-size: 22px; }
            .featured-notice p { font-size: 14px; }
            .featured-meta { gap: 15px; }

            .filter-bar {
                flex-direction: column;
                padding: 20px;
                gap: 15px;
            }

            .category-buttons {
                width: 100%;
                justify-content: center;
            }

            .cat-btn { padding: 8px 16px; font-size: 12px; }

            .notice-card {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 22px 20px;
                border-left-width: 4px;
            }

            .notice-card:hover {
                transform: translateX(0);
                border-left-width: 5px;
            }

            .notice-date-box {
                display: flex;
                gap: 15px;
                align-items: center;
                justify-content: flex-start;
                padding: 12px 18px;
            }

            .notice-date-box .day { font-size: 24px; }
            .notice-date-box .month { margin-top: 0; }
            .notice-date-box .year { margin-top: 0; }

            .notice-content h3 { font-size: 16px; }

            .notice-actions {
                flex-direction: row;
                justify-content: flex-start;
            }

            .modal-content { padding: 30px 25px; }
            .modal-header h2 { font-size: 20px; }

            .footer-grid { grid-template-columns: 1fr; }

            .section-title { font-size: 26px; }
            .cta-section h2 { font-size: 24px; }
            .cta-section p { font-size: 15px; }

            .featured-notice-section,
            .notice-section { padding: 60px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
            .featured-notice h2 { font-size: 19px; }
            .notice-content h3 { font-size: 15px; }
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
                <li><a href="faculty.php">Faculty</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="notice.php" class="active">Notice</a></li>
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
        <h1>Notice <span>Board</span></h1>
        <p>Stay updated with the latest news, announcements, and events from our school.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Notice Board</span>
        </div>
    </div>
</section>


<!-- =====================================================
     FEATURED / LATEST NOTICE
     ===================================================== -->
<?php if ($latest_notice): ?>
<section class="featured-notice-section">
    <div class="container">
        <div class="featured-notice reveal">
            <span class="featured-badge">
                <span class="dot-pulse"></span>
                Latest Notice
            </span>
            <h2><?php echo $latest_notice['title']; ?></h2>
            <p><?php echo $latest_notice['description']; ?></p>

            <div class="featured-meta">
                <span><i class="fas fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($latest_notice['date'])); ?></span>
                <span><i class="fas fa-tag"></i> <?php echo ucfirst($latest_notice['category']); ?></span>
                <span><i class="fas fa-exclamation-circle"></i> <?php echo ucfirst($latest_notice['priority']); ?> Priority</span>
            </div>

            <button class="btn btn-primary" onclick="openNoticeModal(<?php echo $latest_notice['id']; ?>)">
                <i class="fas fa-eye"></i> Read Full Notice
            </button>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- =====================================================
     NOTICE BOARD SECTION
     ===================================================== -->
<section class="notice-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">All Notices</span>
            <h2 class="section-title">Recent <span>Announcements</span></h2>
            <p class="section-desc">Browse through all notices, exam schedules, and event announcements.</p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar reveal">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search notices..." oninput="searchNotices()">
            </div>

            <div class="category-buttons">
                <button class="cat-btn active" onclick="filterNotices('all', this)">
                    All <span class="count"><?php echo count($notices); ?></span>
                </button>
                <button class="cat-btn" onclick="filterNotices('admission', this)">
                    Admission <span class="count"><?php echo $category_counts['admission'] ?? 0; ?></span>
                </button>
                <button class="cat-btn" onclick="filterNotices('exam', this)">
                    Exam <span class="count"><?php echo $category_counts['exam'] ?? 0; ?></span>
                </button>
                <button class="cat-btn" onclick="filterNotices('event', this)">
                    Event <span class="count"><?php echo $category_counts['event'] ?? 0; ?></span>
                </button>
                <button class="cat-btn" onclick="filterNotices('general', this)">
                    General <span class="count"><?php echo $category_counts['general'] ?? 0; ?></span>
                </button>
                <button class="cat-btn" onclick="filterNotices('holiday', this)">
                    Holiday <span class="count"><?php echo $category_counts['holiday'] ?? 0; ?></span>
                </button>
            </div>
        </div>

        <!-- Notices List -->
        <div class="notices-list" id="noticesList">

            <?php foreach ($notices as $notice): 
                $date = strtotime($notice['date']);
            ?>
            <div class="notice-card priority-<?php echo $notice['priority']; ?> reveal" 
                 data-category="<?php echo $notice['category']; ?>"
                 data-title="<?php echo strtolower($notice['title'] . ' ' . $notice['description']); ?>">
                
                <div class="notice-date-box">
                    <div class="day"><?php echo date('d', $date); ?></div>
                    <div class="month"><?php echo date('M', $date); ?></div>
                    <div class="year"><?php echo date('Y', $date); ?></div>
                </div>

                <div class="notice-content">
                    <div class="notice-tags">
                        <?php if ($notice['is_new']): ?>
                            <span class="notice-tag new-tag">
                                <i class="fas fa-star"></i> NEW
                            </span>
                        <?php endif; ?>
                        <span class="notice-tag category-<?php echo $notice['category']; ?>">
                            <?php echo ucfirst($notice['category']); ?>
                        </span>
                    </div>

                    <h3><?php echo $notice['title']; ?></h3>
                    <p><?php echo substr($notice['description'], 0, 140) . '...'; ?></p>
                </div>

                <div class="notice-actions">
                    <button class="action-btn view" onclick="openNoticeModal(<?php echo $notice['id']; ?>)" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn download" onclick="downloadNotice(<?php echo $notice['id']; ?>)" title="Download PDF">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="action-btn share" onclick="shareNotice('<?php echo addslashes($notice['title']); ?>')" title="Share">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- No Results -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="fas fa-search"></i>
                <h3>No Notices Found</h3>
                <p>Try changing your search or filter.</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CTA SECTION
     ===================================================== -->
<section class="cta-section">
    <div class="container">
        <h2>Subscribe to Our Newsletter</h2>
        <p>Get all the latest notices and announcements directly in your inbox.</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary">Contact Us</a>
            <a href="admission.php" class="btn btn-outline">Apply for Admission</a>
        </div>
    </div>
</section>


<!-- =====================================================
     NOTICE MODAL
     ===================================================== -->
<div class="modal" id="noticeModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeNoticeModal()">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-header">
            <h2 id="modalTitle"></h2>
            <div class="modal-meta">
                <span><i class="fas fa-calendar-alt"></i> <span id="modalDate"></span></span>
                <span><i class="fas fa-tag"></i> <span id="modalCategory"></span></span>
                <span><i class="fas fa-exclamation-circle"></i> <span id="modalPriority"></span> Priority</span>
            </div>
        </div>

        <div class="modal-body">
            <p id="modalDescription"></p>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary" onclick="downloadNotice(0)">
                <i class="fas fa-download"></i> Download PDF
            </button>
            <button class="btn btn-outline" style="color:var(--primary); border-color:var(--primary);" onclick="closeNoticeModal()">
                Close
            </button>
        </div>
    </div>
</div>


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
    // NOTICES DATA (PHP → JS)
    // =====================================================
    const notices = <?php echo json_encode($notices); ?>;

    // =====================================================
    // CATEGORY FILTER
    // =====================================================
    let activeCategory = 'all';

    function filterNotices(category, btn) {
        activeCategory = category;

        document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        applyFilters();
    }

    // =====================================================
    // SEARCH
    // =====================================================
    function searchNotices() {
        applyFilters();
    }

    function applyFilters() {
        const searchText = document.getElementById('searchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.notice-card');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            const cardTitle = card.getAttribute('data-title');

            const catMatch = (activeCategory === 'all' || cardCat === activeCategory);
            const searchMatch = (searchText === '' || cardTitle.includes(searchText));

            if (catMatch && searchMatch) {
                card.style.display = 'grid';
                card.style.animation = 'fadeUp 0.5s ease forwards';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // =====================================================
    // NOTICE MODAL
    // =====================================================
    function openNoticeModal(id) {
        // Featured notice ke liye latest notice use karo
        let notice;
        if (id === 0 && notices.length > 0) {
            notice = notices[0];
        } else {
            notice = notices.find(n => n.id === id);
        }

        if (!notice) return;

        document.getElementById('modalTitle').textContent = notice.title;
        document.getElementById('modalDate').textContent = formatDate(notice.date);
        document.getElementById('modalCategory').textContent = capitalize(notice.category);
        document.getElementById('modalPriority').textContent = capitalize(notice.priority);
        document.getElementById('modalDescription').textContent = notice.description;

        document.getElementById('noticeModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeNoticeModal() {
        document.getElementById('noticeModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Background click
    document.getElementById('noticeModal').addEventListener('click', function(e) {
        if (e.target === this) closeNoticeModal();
    });

    // ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('noticeModal').classList.contains('active')) {
            closeNoticeModal();
        }
    });

    // =====================================================
    // DOWNLOAD NOTICE
    // =====================================================
    function downloadNotice(id) {
        let notice;
        if (id === 0) {
            notice = notices[0];
        } else {
            notice = notices.find(n => n.id === id);
        }

        if (!notice) return;

        // Demo: Generate a simple text file
        const content = 
            "SUNRISE PUBLIC SCHOOL\n" +
            "=====================\n\n" +
            "NOTICE: " + notice.title + "\n\n" +
            "Date: " + formatDate(notice.date) + "\n" +
            "Category: " + capitalize(notice.category) + "\n" +
            "Priority: " + capitalize(notice.priority) + "\n\n" +
            "Description:\n" +
            notice.description + "\n\n" +
            "---\n" +
            "Sunrise Public School\n" +
            "123, Main Road, Delhi\n" +
            "Contact: +91 98765 43210\n";

        const blob = new Blob([content], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'Notice_' + notice.id + '_' + notice.title.replace(/\s+/g, '_').substring(0, 30) + '.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);

        alert('✅ Notice downloaded successfully!\n\nFile: ' + a.download);
    }

    // =====================================================
    // SHARE NOTICE
    // =====================================================
    function shareNotice(title) {
        const shareText = 'Check out this notice from Sunrise Public School: ' + title;

        if (navigator.share) {
            navigator.share({
                title: 'Sunrise Public School - Notice',
                text: shareText,
                url: window.location.href
            }).catch(err => console.log('Share cancelled'));
        } else {
            // Fallback - copy to clipboard
            navigator.clipboard.writeText(shareText + ' - ' + window.location.href)
                .then(() => alert('📋 Notice link copied to clipboard!'))
                .catch(() => alert('Unable to share. Please copy manually.'));
        }
    }

    // =====================================================
    // HELPERS
    // =====================================================
    function formatDate(dateStr) {
        const d = new Date(dateStr);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // =====================================================
    // SCROLL REVEAL
    // =====================================================
    const revealElements = document.querySelectorAll('.reveal');

    function handleScroll() {
        revealElements.forEach(el => {
            const top = el.getBoundingClientRect().top;
            const trigger = window.innerHeight - 80;
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