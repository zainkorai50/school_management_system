<?php
// ============================================
// Sunrise Public School - Admission Page
// Public Admission Form with PHP Backend
// ============================================

// ---------- FORM SUBMIT HANDLING ----------
session_start();

// ---------- USERS ----------
$users = [
    'zain1' => ['password' => '1', 'role' => 'admin',   'name' => 'Zain Admin',   'page' => 'admin-login.php'],
    'zain2' => ['password' => '2', 'role' => 'teacher', 'name' => 'Zain Teacher', 'page' => 'teacher-login.php'],
    'zain3' => ['password' => '3', 'role' => 'student', 'name' => 'Zain Student', 'page' => 'student-login.php'],
    'zain4' => ['password' => '4', 'role' => 'parent',  'name' => 'Zain Parent',  'page' => 'parent-login.php'],
];
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Form data receive
    $student_name  = trim($_POST['student_name'] ?? '');
    $dob           = trim($_POST['dob'] ?? '');
    $gender        = trim($_POST['gender'] ?? '');
    $class_applied = trim($_POST['class_applied'] ?? '');
    $blood_group   = trim($_POST['blood_group'] ?? '');
    $religion      = trim($_POST['religion'] ?? '');

    $father_name   = trim($_POST['father_name'] ?? '');
    $mother_name   = trim($_POST['mother_name'] ?? '');
    $parent_phone  = trim($_POST['parent_phone'] ?? '');
    $parent_email  = trim($_POST['parent_email'] ?? '');
    $occupation    = trim($_POST['occupation'] ?? '');

    $address       = trim($_POST['address'] ?? '');
    $city          = trim($_POST['city'] ?? '');
    $state         = trim($_POST['state'] ?? '');
    $pincode       = trim($_POST['pincode'] ?? '');
    $prev_school   = trim($_POST['prev_school'] ?? '');

    // Basic validation
    if (
        empty($student_name) || empty($dob) || empty($gender) ||
        empty($class_applied) || empty($father_name) ||
        empty($parent_phone) || empty($parent_email) ||
        empty($address) || empty($city) || empty($pincode)
    ) {
        $message = "❌ Please fill all required fields!";
        $message_type = "error";
    } else {
        // Generate Application Number
        $application_no = "SPS" . date("Y") . rand(10000, 99999);

        // Yahan aap database me save kar sakte ho.
        // Abhi ke liye hum demo ke liye PHP session me save kar rahe hain.

        session_start();
        $_SESSION['last_application'] = [
            'application_no' => $application_no,
            'student_name'   => $student_name,
            'class_applied'  => $class_applied,
            'parent_email'   => $parent_email,
            'parent_phone'   => $parent_phone,
            'submitted_at'   => date("d-m-Y h:i A")
        ];

        $message = "✅ Application Submitted Successfully!<br>
                    Your Application Number: <strong>" . $application_no . "</strong><br>
                    Please save this number for future reference. Confirmation sent to " . htmlspecialchars($parent_email) . ".";
        $message_type = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission | Sunrise Public School</title>

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
            --green: #10b981;
            --red: #ef4444;
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
            font-family: 'Poppins', sans-serif;
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
           PROCESS STEPS SECTION
           ===================================================== */
        .process-section {
            padding: 100px 0;
            background: var(--light);
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
        }

        .process-card {
            background: var(--white);
            padding: 35px 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            border-top: 4px solid transparent;
        }

        .process-card:hover {
            transform: translateY(-10px);
            border-top-color: var(--secondary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.15);
        }

        .process-number {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 36px;
            height: 36px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            border: 3px solid var(--light);
            transition: all 0.4s ease;
        }

        .process-card:hover .process-number {
            background: var(--secondary);
            transform: translateX(-50%) scale(1.15);
        }

        .process-icon {
            width: 70px;
            height: 70px;
            margin: 15px auto 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: var(--white);
            transition: all 0.4s ease;
        }

        .process-card:hover .process-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
        }

        .process-card h3 {
            font-size: 17px;
            color: var(--primary);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .process-card p { color: var(--gray); font-size: 13px; line-height: 1.6; }

        /* =====================================================
           ELIGIBILITY SECTION
           ===================================================== */
        .eligibility-section {
            padding: 100px 0;
            background: var(--white);
        }

        .eligibility-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .eligibility-table {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border: 1px solid var(--border);
        }

        .eligibility-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .eligibility-table thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
        }

        .eligibility-table th {
            padding: 18px 20px;
            text-align: left;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .eligibility-table td {
            padding: 16px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }

        .eligibility-table tbody tr {
            transition: background 0.3s;
        }

        .eligibility-table tbody tr:hover {
            background: var(--light);
        }

        .eligibility-table tbody tr:last-child td {
            border-bottom: none;
        }

        .eligibility-table td:first-child {
            font-weight: 600;
            color: var(--primary);
        }

        .eligibility-info h2 {
            font-size: 36px;
            font-weight: 800;
            line-height: 1.2;
            margin: 15px 0 20px;
            color: var(--dark);
        }

        .eligibility-info h2 span { color: var(--primary); }

        .eligibility-info > p {
            color: var(--gray);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 25px;
        }

        .doc-item {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 12px 18px;
            background: var(--light);
            border-radius: 10px;
            border-left: 3px solid var(--secondary);
            font-size: 14px;
            font-weight: 500;
        }

        .doc-item i { color: var(--secondary); font-size: 16px; }

        /* =====================================================
           FEE STRUCTURE SECTION
           ===================================================== */
        .fee-section {
            padding: 100px 0;
            background: var(--light);
        }

        .fee-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .fee-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            position: relative;
        }

        .fee-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(30, 58, 138, 0.15);
        }

        .fee-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 35px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .fee-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .fee-header h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
        }

        .fee-price {
            font-size: 38px;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
            position: relative;
        }

        .fee-price span {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255,255,255,0.8);
            display: block;
            margin-top: 5px;
        }

        .fee-body {
            padding: 30px 25px;
        }

        .fee-body ul li {
            padding: 10px 0;
            border-bottom: 1px dashed var(--border);
            font-size: 14px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fee-body ul li:last-child { border-bottom: none; }

        .fee-body ul li i {
            color: var(--green);
            font-size: 14px;
        }

        .fee-popular {
            position: absolute;
            top: 15px;
            right: -35px;
            background: var(--secondary);
            color: var(--white);
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 700;
            transform: rotate(45deg);
            letter-spacing: 1px;
        }

        /* =====================================================
           ADMISSION FORM SECTION
           ===================================================== */
        .form-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            position: relative;
            overflow: hidden;
        }

        .form-section::before,
        .form-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .form-section::before {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -150px;
        }

        .form-section::after {
            width: 500px;
            height: 500px;
            bottom: -200px;
            right: -150px;
        }

        .form-section .section-title { color: var(--white); }
        .form-section .section-title span { color: var(--secondary); }
        .form-section .section-tag { color: var(--secondary); }
        .form-section .section-tag::before { background: var(--secondary); }
        .form-section .section-desc { color: rgba(255,255,255,0.85); }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.25);
            overflow: hidden;
            position: relative;
            z-index: 2;
        }

        .form-header {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white);
            padding: 30px 40px;
            text-align: center;
        }

        .form-header h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .form-header p {
            font-size: 14px;
            opacity: 0.95;
        }

        .form-body {
            padding: 45px 40px;
        }

        .alert {
            padding: 18px 22px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 15px;
            line-height: 1.6;
            font-weight: 500;
            animation: fadeUp 0.5s ease;
        }

        .alert.success {
            background: #d1fae5;
            color: #065f46;
            border-left: 5px solid var(--green);
        }

        .alert.error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 5px solid var(--red);
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 17px;
            font-weight: 700;
            color: var(--primary);
            margin: 30px 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
        }

        .form-section-title:first-of-type { margin-top: 0; }

        .form-section-title .num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full { grid-column: 1 / -1; }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-group label .req { color: var(--red); }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 13px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--dark);
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        .form-group textarea { resize: vertical; min-height: 90px; }

        .form-group select { cursor: pointer; }

        .radio-group {
            display: flex;
            gap: 25px;
            padding: 10px 0;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .radio-item input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .form-note {
            background: var(--light);
            padding: 18px 22px;
            border-radius: 12px;
            font-size: 13px;
            color: var(--gray);
            margin: 25px 0;
            border-left: 4px solid var(--secondary);
            line-height: 1.7;
        }

        .form-note strong { color: var(--primary); }

        .checkbox-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .form-submit {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .form-submit .btn {
            flex: 1;
            min-width: 180px;
            padding: 16px 32px;
            font-size: 16px;
        }

        /* =====================================================
           HELP / INFO SECTION
           ===================================================== */
        .help-section {
            padding: 100px 0;
            background: var(--white);
        }

        .help-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .help-card {
            background: var(--light);
            padding: 35px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            border-bottom: 4px solid transparent;
        }

        .help-card:hover {
            background: var(--white);
            transform: translateY(-10px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.12);
        }

        .help-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            color: var(--white);
            transition: all 0.4s ease;
        }

        .help-card:hover .help-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
        }

        .help-card h3 {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .help-card p {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .help-card a {
            color: var(--secondary);
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .help-card a:hover { gap: 10px; }

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

            .process-grid { grid-template-columns: repeat(2, 1fr); }
            .fee-grid { grid-template-columns: 1fr; max-width: 500px; margin: 0 auto; }

            .eligibility-grid { grid-template-columns: 1fr; gap: 40px; }

            .form-grid { grid-template-columns: 1fr; }

            .help-grid { grid-template-columns: repeat(2, 1fr); }

            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .section-title { font-size: 32px; }
            .eligibility-info h2 { font-size: 30px; }

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

            .process-grid,
            .help-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .section-title { font-size: 26px; }
            .eligibility-info h2 { font-size: 24px; }

            .eligibility-table th,
            .eligibility-table td { padding: 12px 15px; font-size: 13px; }

            .form-body { padding: 30px 22px; }
            .form-header { padding: 25px 22px; }
            .form-header h2 { font-size: 20px; }

            .radio-group { flex-direction: column; gap: 12px; }

            .form-submit .btn { min-width: 100%; }

            .cta-text h2 { font-size: 24px; }
            .cta-text p { font-size: 15px; }

            .process-section,
            .eligibility-section,
            .fee-section,
            .form-section,
            .help-section { padding: 70px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
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
                <li><a href="admission.php" class="active">Admission</a></li>
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
        <h1>Online <span>Admission</span></h1>
        <p>Join Sunrise Public School — Apply online for the 2025-26 academic session. Limited seats available!</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Admission</span>
        </div>
    </div>
</section>


<!-- =====================================================
     PROCESS STEPS
     ===================================================== -->
<section class="process-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">How to Apply</span>
            <h2 class="section-title">Admission <span>Process</span></h2>
            <p class="section-desc">Simple 4-step process to get your child admitted.</p>
        </div>

        <div class="process-grid">

            <div class="process-card reveal">
                <div class="process-number">01</div>
                <div class="process-icon"><i class="fas fa-file-alt"></i></div>
                <h3>Fill Application</h3>
                <p>Complete the online admission form with accurate details.</p>
            </div>

            <div class="process-card reveal">
                <div class="process-number">02</div>
                <div class="process-icon"><i class="fas fa-file-upload"></i></div>
                <h3>Submit Documents</h3>
                <p>Upload required documents like birth certificate and photos.</p>
            </div>

            <div class="process-card reveal">
                <div class="process-number">03</div>
                <div class="process-icon"><i class="fas fa-user-check"></i></div>
                <h3>Verification</h3>
                <p>Our team will verify your application and documents.</p>
            </div>

            <div class="process-card reveal">
                <div class="process-number">04</div>
                <div class="process-icon"><i class="fas fa-check-circle"></i></div>
                <h3>Confirmation</h3>
                <p>Receive admission confirmation and fee payment link.</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     ELIGIBILITY SECTION
     ===================================================== -->
<section class="eligibility-section">
    <div class="container">
        <div class="eligibility-grid">

            <div class="eligibility-table reveal">
                <table>
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Age Criteria</th>
                            <th>Seats</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nursery</td>
                            <td>3 - 4 Years</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td>LKG</td>
                            <td>4 - 5 Years</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td>UKG</td>
                            <td>5 - 6 Years</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td>Class 1 - 5</td>
                            <td>6 - 10 Years</td>
                            <td>40 each</td>
                        </tr>
                        <tr>
                            <td>Class 6 - 8</td>
                            <td>11 - 13 Years</td>
                            <td>40 each</td>
                        </tr>
                        <tr>
                            <td>Class 9 - 10</td>
                            <td>14 - 15 Years</td>
                            <td>40 each</td>
                        </tr>
                        <tr>
                            <td>Class 11 - 12</td>
                            <td>16 - 18 Years</td>
                            <td>40 each</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="eligibility-info reveal">
                <span class="section-tag">Requirements</span>
                <h2>Documents <span>Required</span></h2>
                <p>Please keep the following documents ready before filling the admission form:</p>

                <div class="doc-list">
                    <div class="doc-item"><i class="fas fa-birthday-cake"></i> Birth Certificate (Photocopy)</div>
                    <div class="doc-item"><i class="fas fa-id-card"></i> Aadhar Card (Student & Parents)</div>
                    <div class="doc-item"><i class="fas fa-camera"></i> Passport Size Photos (4 copies)</div>
                    <div class="doc-item"><i class="fas fa-file-medical"></i> Medical Fitness Certificate</div>
                    <div class="doc-item"><i class="fas fa-school"></i> Transfer Certificate (if applicable)</div>
                    <div class="doc-item"><i class="fas fa-file-alt"></i> Previous Class Marksheet</div>
                </div>

                <a href="#admissionForm" class="btn btn-primary-dark">
                    <i class="fas fa-arrow-down"></i> Fill Admission Form
                </a>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     FEE STRUCTURE
     ===================================================== -->
<section class="fee-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Fee Details</span>
            <h2 class="section-title">Transparent <span>Fee Structure</span></h2>
            <p class="section-desc">Affordable and transparent fees for quality education.</p>
        </div>

        <div class="fee-grid">

            <div class="fee-card reveal">
                <div class="fee-header">
                    <h3>Pre-Primary</h3>
                    <div class="fee-price">₹25,000<span>Per Year</span></div>
                </div>
                <div class="fee-body">
                    <ul>
                        <li><i class="fas fa-check"></i> Nursery to UKG</li>
                        <li><i class="fas fa-check"></i> Activity Based Learning</li>
                        <li><i class="fas fa-check"></i> Free Uniform Set</li>
                        <li><i class="fas fa-check"></i> Annual Function</li>
                        <li><i class="fas fa-check"></i> Basic Sports Kit</li>
                    </ul>
                </div>
            </div>

            <div class="fee-card reveal">
                <div class="fee-popular">POPULAR</div>
                <div class="fee-header">
                    <h3>Primary & Middle</h3>
                    <div class="fee-price">₹45,000<span>Per Year</span></div>
                </div>
                <div class="fee-body">
                    <ul>
                        <li><i class="fas fa-check"></i> Class 1 to 8</li>
                        <li><i class="fas fa-check"></i> Smart Classrooms</li>
                        <li><i class="fas fa-check"></i> Science & Computer Labs</li>
                        <li><i class="fas fa-check"></i> Library Access</li>
                        <li><i class="fas fa-check"></i> Sports & Activities</li>
                    </ul>
                </div>
            </div>

            <div class="fee-card reveal">
                <div class="fee-header">
                    <h3>Secondary & Senior</h3>
                    <div class="fee-price">₹65,000<span>Per Year</span></div>
                </div>
                <div class="fee-body">
                    <ul>
                        <li><i class="fas fa-check"></i> Class 9 to 12</li>
                        <li><i class="fas fa-check"></i> Board Exam Preparation</li>
                        <li><i class="fas fa-check"></i> Career Counseling</li>
                        <li><i class="fas fa-check"></i> Practical Labs</li>
                        <li><i class="fas fa-check"></i> Competitive Coaching</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     ADMISSION FORM SECTION
     ===================================================== -->
<section class="form-section" id="admissionForm">
    <div class="container">

        <div class="section-header reveal">
            <span class="section-tag">Application Form</span>
            <h2 class="section-title">Fill Your <span>Admission Form</span></h2>
            <p class="section-desc">Complete the form below to apply. Fields marked * are required.</p>
        </div>

        <div class="form-container reveal">

            <div class="form-header">
                <h2><i class="fas fa-graduation-cap"></i> Admission Application Form</h2>
                <p>Session 2025-26</p>
            </div>

            <div class="form-body">

                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $message_type; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="admissionFormEl">

                    <!-- SECTION 1: Student Details -->
                    <div class="form-section-title">
                        <span class="num">1</span> Student Details
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Student Full Name <span class="req">*</span></label>
                            <input type="text" name="student_name" placeholder="Enter full name" required>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth <span class="req">*</span></label>
                            <input type="date" name="dob" required>
                        </div>

                        <div class="form-group">
                            <label>Gender <span class="req">*</span></label>
                            <div class="radio-group">
                                <label class="radio-item">
                                    <input type="radio" name="gender" value="Male" required> Male
                                </label>
                                <label class="radio-item">
                                    <input type="radio" name="gender" value="Female"> Female
                                </label>
                                <label class="radio-item">
                                    <input type="radio" name="gender" value="Other"> Other
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Class Applying For <span class="req">*</span></label>
                            <select name="class_applied" required>
                                <option value="">-- Select Class --</option>
                                <option>Nursery</option>
                                <option>LKG</option>
                                <option>UKG</option>
                                <option>Class 1</option>
                                <option>Class 2</option>
                                <option>Class 3</option>
                                <option>Class 4</option>
                                <option>Class 5</option>
                                <option>Class 6</option>
                                <option>Class 7</option>
                                <option>Class 8</option>
                                <option>Class 9</option>
                                <option>Class 10</option>
                                <option>Class 11</option>
                                <option>Class 12</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Blood Group</label>
                            <select name="blood_group">
                                <option value="">-- Select --</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>O+</option><option>O-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Religion</label>
                            <input type="text" name="religion" placeholder="Enter religion">
                        </div>

                    </div>

                    <!-- SECTION 2: Parent Details -->
                    <div class="form-section-title">
                        <span class="num">2</span> Parent / Guardian Details
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Father's Name <span class="req">*</span></label>
                            <input type="text" name="father_name" placeholder="Enter father's name" required>
                        </div>

                        <div class="form-group">
                            <label>Mother's Name</label>
                            <input type="text" name="mother_name" placeholder="Enter mother's name">
                        </div>

                        <div class="form-group">
                            <label>Mobile Number <span class="req">*</span></label>
                            <input type="tel" name="parent_phone" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="parent_email" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group full">
                            <label>Parent's Occupation</label>
                            <input type="text" name="occupation" placeholder="e.g. Business, Service, etc.">
                        </div>

                    </div>

                    <!-- SECTION 3: Address Details -->
                    <div class="form-section-title">
                        <span class="num">3</span> Address & Previous School
                    </div>

                    <div class="form-grid">

                        <div class="form-group full">
                            <label>Full Address <span class="req">*</span></label>
                            <textarea name="address" placeholder="House no, Street, Area, Landmark" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>City <span class="req">*</span></label>
                            <input type="text" name="city" placeholder="Enter city" required>
                        </div>

                        <div class="form-group">
                            <label>State <span class="req">*</span></label>
                            <input type="text" name="state" placeholder="Enter state" required>
                        </div>

                        <div class="form-group">
                            <label>Pincode <span class="req">*</span></label>
                            <input type="text" name="pincode" placeholder="6-digit pincode" pattern="[0-9]{6}" required>
                        </div>

                        <div class="form-group">
                            <label>Previous School (if any)</label>
                            <input type="text" name="prev_school" placeholder="Previous school name">
                        </div>

                    </div>

                    <div class="form-note">
                        <strong>Note:</strong> Please ensure all information provided is accurate.
                        After submitting, you will receive an application number. Keep it safe for future reference.
                        Our team will contact you within 2-3 working days.
                    </div>

                    <label class="checkbox-item">
                        <input type="checkbox" required>
                        I hereby declare that the information provided above is true and correct to the best of my knowledge. I agree to the school's terms and conditions.
                    </label>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Submit Application
                        </button>
                        <button type="reset" class="btn btn-primary-dark">
                            <i class="fas fa-redo"></i> Reset Form
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</section>


<!-- =====================================================
     HELP SECTION
     ===================================================== -->
<section class="help-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Need Help?</span>
            <h2 class="section-title">We're Here to <span>Help You</span></h2>
            <p class="section-desc">Have questions about admission? Reach out to us anytime.</p>
        </div>

        <div class="help-grid">

            <div class="help-card reveal">
                <div class="help-icon"><i class="fas fa-phone-alt"></i></div>
                <h3>Call Us</h3>
                <p>Talk to our admission team directly on phone.</p>
                <a href="tel:+919876543210">+91 98765 43210 <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="help-card reveal">
                <div class="help-icon"><i class="fas fa-envelope"></i></div>
                <h3>Email Us</h3>
                <p>Send us your queries and we'll respond quickly.</p>
                <a href="mailto:admission@sunriseschool.com">admission@sunriseschool.com <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="help-card reveal">
                <div class="help-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3>Visit Campus</h3>
                <p>Meet our team in person at the school office.</p>
                <a href="contact.php">Get Directions <i class="fas fa-arrow-right"></i></a>
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
            <h2>Admissions Closing Soon!</h2>
            <p>Limited seats available for 2025-26 session. Apply today!</p>
        </div>
        <div class="cta-buttons">
            <a href="#admissionForm" class="btn btn-primary">Apply Now</a>
            <a href="contact.php" class="btn btn-outline">Contact Us</a>
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
    // FORM VALIDATION + SCROLL TO ALERT
    // =====================================================
    document.getElementById('admissionFormEl').addEventListener('submit', function(e) {
        // Simple client-side check
        const requiredFields = this.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = document.querySelectorAll(`input[name="${field.name}"]`);
                const checked = Array.from(radioGroup).some(r => r.checked);
                if (!checked) {
                    valid = false;
                    field.closest('.form-group').style.border = '2px solid #ef4444';
                } else {
                    field.closest('.form-group').style.border = 'none';
                }
            } else if (!field.value.trim()) {
                valid = false;
                field.style.borderColor = '#ef4444';
            } else {
                field.style.borderColor = '#e5e7eb';
            }
        });

        if (!valid) {
            e.preventDefault();
            alert('❌ Please fill all required fields correctly!');
        }
    });

    // =====================================================
    // AUTO SCROLL TO FORM ON SUBMIT SUCCESS
    // =====================================================
    window.addEventListener('load', () => {
        const alertBox = document.querySelector('.alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        }
        handleScroll();
    });

    // =====================================================
    // PAGE LOAD INIT
    // =====================================================
    window.addEventListener('scroll', handleScroll);
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