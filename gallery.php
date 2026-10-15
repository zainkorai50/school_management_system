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
// Sunrise Public School - Gallery Page
// Photo Gallery + Video Gallery + Lightbox
// ============================================

// ---------- GALLERY PHOTOS DATA ----------
$photos = [
    // Annual Day
    [
        'title' => 'Annual Day 2024',
        'category' => 'events',
        'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800',
        'date' => '15 Dec 2024'
    ],
    [
        'title' => 'Annual Day Performance',
        'category' => 'events',
        'image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800',
        'date' => '15 Dec 2024'
    ],
    [
        'title' => 'Cultural Program',
        'category' => 'events',
        'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800',
        'date' => '15 Dec 2024'
    ],

    // Sports Day
    [
        'title' => 'Sports Day Race',
        'category' => 'sports',
        'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800',
        'date' => '25 Nov 2024'
    ],
    [
        'title' => 'Football Match',
        'category' => 'sports',
        'image' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377?w=800',
        'date' => '20 Nov 2024'
    ],
    [
        'title' => 'Cricket Tournament',
        'category' => 'sports',
        'image' => 'https://images.unsplash.com/photo-1531415074968-036ba1b575da?w=800',
        'date' => '18 Nov 2024'
    ],
    [
        'title' => 'Basketball Match',
        'category' => 'sports',
        'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800',
        'date' => '22 Nov 2024'
    ],

    // Classroom
    [
        'title' => 'Smart Classroom',
        'category' => 'classroom',
        'image' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800',
        'date' => '10 Nov 2024'
    ],
    [
        'title' => 'Science Lab',
        'category' => 'classroom',
        'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800',
        'date' => '08 Nov 2024'
    ],
    [
        'title' => 'Computer Lab',
        'category' => 'classroom',
        'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800',
        'date' => '05 Nov 2024'
    ],
    [
        'title' => 'Library Session',
        'category' => 'classroom',
        'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800',
        'date' => '02 Nov 2024'
    ],

    // Cultural
    [
        'title' => 'Dance Performance',
        'category' => 'cultural',
        'image' => 'https://images.unsplash.com/photo-1547153760-18fc86324498?w=800',
        'date' => '30 Oct 2024'
    ],
    [
        'title' => 'Music Concert',
        'category' => 'cultural',
        'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800',
        'date' => '28 Oct 2024'
    ],
    [
        'title' => 'Art Exhibition',
        'category' => 'cultural',
        'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=800',
        'date' => '25 Oct 2024'
    ],
    [
        'title' => 'Drama Play',
        'category' => 'cultural',
        'image' => 'https://images.unsplash.com/photo-1503095396549-807759245b35?w=800',
        'date' => '22 Oct 2024'
    ],

    // Campus
    [
        'title' => 'School Building',
        'category' => 'campus',
        'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800',
        'date' => '15 Oct 2024'
    ],
    [
        'title' => 'Playground',
        'category' => 'campus',
        'image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=800',
        'date' => '12 Oct 2024'
    ],
    [
        'title' => 'Auditorium',
        'category' => 'campus',
        'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800',
        'date' => '10 Oct 2024'
    ],
    [
        'title' => 'Cafeteria',
        'category' => 'campus',
        'image' => 'https://images.unsplash.com/photo-1567521464027-f127ff144326?w=800',
        'date' => '08 Oct 2024'
    ],

    // Trips
    [
        'title' => 'Educational Trip',
        'category' => 'trips',
        'image' => 'https://images.unsplash.com/photo-1539635278303-d4002c07eae3?w=800',
        'date' => '05 Oct 2024'
    ],
    [
        'title' => 'Museum Visit',
        'category' => 'trips',
        'image' => 'https://images.unsplash.com/photo-1564399579883-451a5d44ec08?w=800',
        'date' => '02 Oct 2024'
    ],
    [
        'title' => 'Nature Camp',
        'category' => 'trips',
        'image' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=800',
        'date' => '28 Sep 2024'
    ],
];

// ---------- VIDEO GALLERY DATA ----------
$videos = [
    [
        'title' => 'Annual Day 2024 Highlights',
        'thumbnail' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=600',
        'duration' => '5:24'
    ],
    [
        'title' => 'Sports Day Highlights',
        'thumbnail' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600',
        'duration' => '3:45'
    ],
    [
        'title' => 'Science Exhibition Tour',
        'thumbnail' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600',
        'duration' => '7:12'
    ],
    [
        'title' => 'Campus Tour 2024',
        'thumbnail' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=600',
        'duration' => '4:30'
    ],
    [
        'title' => 'Cultural Fest Performance',
        'thumbnail' => 'https://images.unsplash.com/photo-1547153760-18fc86324498?w=600',
        'duration' => '8:15'
    ],
    [
        'title' => 'Independence Day Celebration',
        'thumbnail' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=600',
        'duration' => '6:00'
    ],
];

// ---------- CATEGORY COUNTS ----------
$category_counts = [];
foreach ($photos as $photo) {
    $cat = $photo['category'];
    $category_counts[$cat] = ($category_counts[$cat] ?? 0) + 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Sunrise Public School</title>

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
                        url('https://images.unsplash.com/photo-1511578314322-379afb476865?w=1600') center/cover;
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
           PHOTO GALLERY SECTION
           ===================================================== */
        .gallery-section {
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

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            height: 280px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.25);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .gallery-item:hover img { transform: scale(1.15); }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.95), rgba(30, 58, 138, 0.3) 60%, transparent);
            opacity: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 25px;
            color: var(--white);
            transition: opacity 0.4s ease;
        }

        .gallery-item:hover .gallery-overlay { opacity: 1; }

        .gallery-overlay h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            transform: translateY(20px);
            transition: transform 0.4s ease 0.1s;
        }

        .gallery-overlay p {
            font-size: 13px;
            opacity: 0.85;
            transform: translateY(20px);
            transition: transform 0.4s ease 0.15s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .gallery-item:hover .gallery-overlay h3,
        .gallery-item:hover .gallery-overlay p {
            transform: translateY(0);
        }

        .gallery-cat {
            position: absolute;
            top: 18px;
            left: 18px;
            background: var(--secondary);
            color: var(--white);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 2;
        }

        .gallery-zoom {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 60px;
            height: 60px;
            background: var(--secondary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: transform 0.4s ease;
            z-index: 3;
        }

        .gallery-item:hover .gallery-zoom {
            transform: translate(-50%, -50%) scale(1);
        }

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
           LIGHTBOX
           ===================================================== */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .lightbox.active { display: flex; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            animation: zoomIn 0.4s ease;
        }

        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 10px;
            box-shadow: 0 25px 70px rgba(0,0,0,0.5);
        }

        .lightbox-info {
            color: var(--white);
            text-align: center;
            margin-top: 20px;
        }

        .lightbox-info h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .lightbox-info p {
            font-size: 14px;
            opacity: 0.8;
        }

        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            width: 45px;
            height: 45px;
            background: var(--secondary);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .lightbox-close:hover {
            background: #dc2626;
            transform: rotate(90deg);
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 55px;
            height: 55px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--white);
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .lightbox-nav:hover {
            background: var(--secondary);
            border-color: var(--secondary);
        }

        .lightbox-nav.prev { left: -80px; }
        .lightbox-nav.next { right: -80px; }

        /* =====================================================
           VIDEO GALLERY SECTION
           ===================================================== */
        .video-section {
            padding: 100px 0;
            background: var(--light);
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .video-card {
            background: var(--white);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 55px rgba(30, 58, 138, 0.2);
        }

        .video-thumbnail {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .video-card:hover .video-thumbnail img { transform: scale(1.1); }

        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            background: rgba(245, 158, 11, 0.95);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.5);
            transition: all 0.4s ease;
            z-index: 2;
        }

        .video-play-btn::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid rgba(245, 158, 11, 0.5);
            animation: pulseRing 2s infinite;
        }

        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.4); opacity: 0; }
        }

        .video-card:hover .video-play-btn {
            transform: translate(-50%, -50%) scale(1.1);
            background: var(--primary);
        }

        .video-duration {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(0,0,0,0.8);
            color: var(--white);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .video-info {
            padding: 22px 25px 25px;
        }

        .video-info h3 {
            font-size: 17px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        .video-card:hover .video-info h3 { color: var(--secondary); }

        .video-info p {
            font-size: 13px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .video-info p i {
            color: var(--secondary);
        }

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
           CTA SECTION
           ===================================================== */
        .cta-section {
            padding: 80px 0;
            background: var(--white);
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

            .gallery-grid { grid-template-columns: repeat(2, 1fr); }
            .video-grid { grid-template-columns: repeat(2, 1fr); }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
            .cta-section h2 { font-size: 28px; }

            .lightbox-nav.prev { left: -60px; }
            .lightbox-nav.next { right: -60px; }
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

            .filter-buttons { gap: 8px; }
            .filter-btn { padding: 9px 18px; font-size: 13px; }

            .gallery-grid,
            .video-grid {
                grid-template-columns: 1fr;
                max-width: 420px;
                margin: 0 auto;
            }

            .stats-grid,
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-title { font-size: 26px; }
            .cta-section h2 { font-size: 24px; }
            .cta-section p { font-size: 15px; }

            /* Lightbox Mobile */
            .lightbox-content img { max-height: 60vh; }

            .lightbox-nav {
                width: 45px;
                height: 45px;
                font-size: 16px;
            }

            .lightbox-nav.prev { left: 10px; }
            .lightbox-nav.next { right: 10px; }

            .lightbox-close {
                top: -45px;
                width: 38px;
                height: 38px;
                font-size: 16px;
            }

            .gallery-section,
            .video-section { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
            .stat-card h3 { font-size: 32px; }
            .stat-icon { width: 55px; height: 55px; font-size: 24px; }

            .gallery-item { height: 220px; }
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
                <li><a href="gallery.php" class="active">Gallery</a></li>
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
        <h1>School <span>Gallery</span></h1>
        <p>Explore our memorable moments, events, and activities captured in frames.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Gallery</span>
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
                <div class="stat-icon"><i class="fas fa-images"></i></div>
                <h3 class="counter" data-target="<?php echo count($photos); ?>">0</h3>
                <p>Total Photos</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-video"></i></div>
                <h3 class="counter" data-target="<?php echo count($videos); ?>">0</h3>
                <p>Video Clips</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3 class="counter" data-target="50">0</h3>
                <p>Events Covered</p>
            </div>
            <div class="stat-card reveal">
                <div class="stat-icon"><i class="fas fa-smile"></i></div>
                <h3 class="counter" data-target="2500">0</h3>
                <p>Happy Students</p>
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     PHOTO GALLERY SECTION
     ===================================================== -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Photo Gallery</span>
            <h2 class="section-title">Memories in <span>Frames</span></h2>
            <p class="section-desc">Browse through our collection of beautiful moments from school life.</p>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-buttons reveal">
            <button class="filter-btn active" onclick="filterGallery('all', this)">
                All Photos (<?php echo count($photos); ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('events', this)">
                Events (<?php echo $category_counts['events'] ?? 0; ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('sports', this)">
                Sports (<?php echo $category_counts['sports'] ?? 0; ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('classroom', this)">
                Classroom (<?php echo $category_counts['classroom'] ?? 0; ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('cultural', this)">
                Cultural (<?php echo $category_counts['cultural'] ?? 0; ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('campus', this)">
                Campus (<?php echo $category_counts['campus'] ?? 0; ?>)
            </button>
            <button class="filter-btn" onclick="filterGallery('trips', this)">
                Trips (<?php echo $category_counts['trips'] ?? 0; ?>)
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryGrid">

            <?php foreach ($photos as $index => $photo): ?>
            <div class="gallery-item reveal" 
                 data-category="<?php echo $photo['category']; ?>"
                 onclick="openLightbox(<?php echo $index; ?>)">
                
                <span class="gallery-cat"><?php echo ucfirst($photo['category']); ?></span>
                <img src="<?php echo $photo['image']; ?>" alt="<?php echo $photo['title']; ?>">
                
                <div class="gallery-zoom">
                    <i class="fas fa-search-plus"></i>
                </div>

                <div class="gallery-overlay">
                    <h3><?php echo $photo['title']; ?></h3>
                    <p><i class="fas fa-calendar-alt"></i> <?php echo $photo['date']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- No Results Message -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="fas fa-image"></i>
                <h3>No photos found</h3>
                <p>Try selecting a different category.</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     VIDEO GALLERY SECTION
     ===================================================== -->
<section class="video-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Video Gallery</span>
            <h2 class="section-title">Watch Our <span>Videos</span></h2>
            <p class="section-desc">Relive the best moments through our video collection.</p>
        </div>

        <div class="video-grid">

            <?php foreach ($videos as $video): ?>
            <div class="video-card reveal" onclick="alert('🎬 Video: <?php echo $video['title']; ?>\n\nDemo mode — YouTube/MP4 video yahan chalega.')">
                <div class="video-thumbnail">
                    <img src="<?php echo $video['thumbnail']; ?>" alt="<?php echo $video['title']; ?>">
                    <div class="video-play-btn">
                        <i class="fas fa-play"></i>
                    </div>
                    <span class="video-duration">
                        <i class="fas fa-clock"></i> <?php echo $video['duration']; ?>
                    </span>
                </div>
                <div class="video-info">
                    <h3><?php echo $video['title']; ?></h3>
                    <p><i class="fas fa-play-circle"></i> Click to watch video</p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


<!-- =====================================================
     CTA SECTION
     ===================================================== -->
<section class="cta-section">
    <div class="container">
        <h2>Want to Be Part of Our Story?</h2>
        <p>Join Sunrise Public School and create your own memorable moments with us.</p>
        <div class="cta-buttons">
            <a href="admission.php" class="btn btn-primary">Apply for Admission</a>
            <a href="contact.php" class="btn btn-outline">Contact Us</a>
        </div>
    </div>
</section>


<!-- =====================================================
     LIGHTBOX MODAL
     ===================================================== -->
<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>

        <button class="lightbox-nav prev" onclick="navigateLightbox(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>

        <img id="lightboxImg" src="" alt="">

        <button class="lightbox-nav next" onclick="navigateLightbox(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="lightbox-info">
            <h3 id="lightboxTitle"></h3>
            <p id="lightboxDate"></p>
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
    // GALLERY FILTER
    // =====================================================
    function filterGallery(category, btn) {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const items = document.querySelectorAll('.gallery-item');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        items.forEach(item => {
            const itemCat = item.getAttribute('data-category');

            if (category === 'all' || itemCat === category) {
                item.style.display = 'block';
                item.style.animation = 'fadeUp 0.5s ease forwards';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // =====================================================
    // LIGHTBOX
    // =====================================================
    const photos = <?php echo json_encode($photos); ?>;
    let currentPhotoIndex = 0;

    function openLightbox(index) {
        currentPhotoIndex = index;
        const photo = photos[index];

        document.getElementById('lightboxImg').src = photo.image;
        document.getElementById('lightboxTitle').textContent = photo.title;
        document.getElementById('lightboxDate').innerHTML = '<i class="fas fa-calendar-alt"></i> ' + photo.date;

        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function navigateLightbox(direction) {
        currentPhotoIndex += direction;

        if (currentPhotoIndex < 0) currentPhotoIndex = photos.length - 1;
        if (currentPhotoIndex >= photos.length) currentPhotoIndex = 0;

        const photo = photos[currentPhotoIndex];
        document.getElementById('lightboxImg').src = photo.image;
        document.getElementById('lightboxTitle').textContent = photo.title;
        document.getElementById('lightboxDate').innerHTML = '<i class="fas fa-calendar-alt"></i> ' + photo.date;
    }

    // Close on background click
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!document.getElementById('lightbox').classList.contains('active')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLightbox(-1);
        if (e.key === 'ArrowRight') navigateLightbox(1);
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
                element.textContent = Math.floor(current) + (target >= 1000 ? '+' : '');
                requestAnimationFrame(update);
            } else {
                element.textContent = target + (target >= 1000 ? '+' : '');
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