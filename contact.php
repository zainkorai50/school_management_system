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
// Sunrise Public School - Contact Us Page
// Contact Form with PHP Backend + Google Map
// ============================================

// ---------- FORM SUBMIT HANDLING ----------
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Form data receive
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message_text = trim($_POST['message'] ?? '');

    // Validation
    if (
        empty($name) || empty($email) || empty($phone) ||
        empty($subject) || empty($message_text)
    ) {
        $message = "❌ Please fill all required fields!";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Please enter a valid email address!";
        $message_type = "error";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $message = "❌ Please enter a valid 10-digit mobile number!";
        $message_type = "error";
    } else {
        // Generate reference number
        $reference_no = "MSG" . date("Ymd") . rand(100, 999);

        // Yahan aap database me save kar sakte ho.
        // Abhi ke liye session me save kar rahe hain.

        session_start();
        $_SESSION['last_message'] = [
            'reference_no' => $reference_no,
            'name'         => $name,
            'email'        => $email,
            'phone'        => $phone,
            'subject'      => $subject,
            'message'      => $message_text,
            'submitted_at' => date("d-m-Y h:i A")
        ];

        // Demo: Mail bhejne ka try karo (optional)
        // $to = "info@sunriseschool.com";
        // $mail_subject = "New Contact: " . $subject;
        // $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message_text";
        // @mail($to, $mail_subject, $body);

        $message = "✅ Thank you <strong>" . htmlspecialchars($name) . "</strong>!<br>
                    Your message has been sent successfully.<br>
                    Reference No: <strong>" . $reference_no . "</strong><br>
                    Our team will contact you within 24 hours.";
        $message_type = "success";
    }
}

// ---------- FAQ DATA ----------
$faqs = [
    [
        'q' => 'What is the admission procedure?',
        'a' => 'You can apply online through our website by filling the admission form. After submission, our team will contact you for document verification and further process.'
    ],
    [
        'q' => 'What are the school timings?',
        'a' => 'School timings are from 8:00 AM to 2:00 PM (Monday to Friday) and 8:00 AM to 12:00 PM on Saturdays. Office remains open till 4:00 PM on all working days.'
    ],
    [
        'q' => 'Is transport facility available?',
        'a' => 'Yes, we provide safe and reliable school bus service across the entire city. Please contact the transport department for route details and fees.'
    ],
    [
        'q' => 'How can I pay the school fees?',
        'a' => 'Fees can be paid online through our website using credit card, debit card, net banking, or UPI. You can also pay at the school accounts office.'
    ],
    [
        'q' => 'What documents are required for admission?',
        'a' => 'Birth certificate, Aadhar card of student and parents, passport size photos, medical fitness certificate, transfer certificate (if applicable), and previous class marksheet.'
    ],
    [
        'q' => 'Do you offer scholarships?',
        'a' => 'Yes, we offer merit-based scholarships to deserving students. Please contact the admission office for eligibility criteria and application process.'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sunrise Public School</title>

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
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600') center/cover;
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
           CONTACT INFO CARDS
           ===================================================== */
        .contact-info-section {
            padding: 100px 0 60px;
            background: var(--light);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .info-card {
            background: var(--white);
            padding: 40px 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid transparent;
        }

        .info-card::before {
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

        .info-card:hover::before { left: 0; }

        .info-card > * { position: relative; z-index: 1; transition: color 0.3s; }

        .info-card:hover {
            transform: translateY(-12px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 25px 55px rgba(30, 58, 138, 0.25);
        }

        .info-card:hover h3,
        .info-card:hover p,
        .info-card:hover a { color: var(--white); }

        .info-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--white);
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.25);
        }

        .info-card:hover .info-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.5);
        }

        .info-card h3 {
            font-size: 18px;
            color: var(--primary);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .info-card p {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.7;
        }

        .info-card a {
            color: var(--primary);
            font-weight: 600;
            display: block;
            margin-top: 8px;
            font-size: 14px;
        }

        .info-card a:hover { color: var(--secondary); }

        /* =====================================================
           CONTACT FORM + INFO SECTION
           ===================================================== */
        .contact-main-section {
            padding: 60px 0 100px;
            background: var(--light);
        }

        .contact-main-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 40px;
            align-items: stretch;
        }

        /* Form Container */
        .form-container {
            background: var(--white);
            border-radius: 20px;
            padding: 45px 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .form-container h2 {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 800;
        }

        .form-container > p {
            color: var(--gray);
            font-size: 15px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 18px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
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

        .form-group textarea {
            resize: vertical;
            min-height: 130px;
        }

        .form-group select { cursor: pointer; }

        .form-submit {
            margin-top: 25px;
        }

        .form-submit .btn {
            width: 100%;
            padding: 16px 32px;
            font-size: 16px;
        }

        /* Info Side */
        .contact-side {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .side-card {
            background: var(--white);
            border-radius: 18px;
            padding: 30px 28px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .side-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.12);
        }

        .side-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border);
        }

        .side-card-header .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 20px;
            flex-shrink: 0;
        }

        .side-card-header h3 {
            font-size: 18px;
            color: var(--primary);
            font-weight: 700;
        }

        /* Office Hours */
        .hours-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .hours-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: var(--light);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .hours-item:hover {
            background: var(--primary);
            color: var(--white);
        }

        .hours-item .day {
            font-weight: 600;
        }

        .hours-item .time {
            font-size: 13px;
            opacity: 0.85;
        }

        .hours-item.closed .time { color: var(--red); font-weight: 600; }

        /* Social Connect */
        .social-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .social-btn.facebook { background: #1877f2; }
        .social-btn.instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-btn.twitter { background: #1da1f2; }
        .social-btn.youtube { background: #ff0000; }

        /* Emergency Contact */
        .emergency-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .emergency-item {
            display: flex;
            gap: 15px;
            align-items: center;
            padding: 15px 18px;
            background: #fef3c7;
            border-radius: 10px;
            border-left: 4px solid var(--secondary);
        }

        .emergency-item i {
            color: var(--secondary);
            font-size: 22px;
            flex-shrink: 0;
        }

        .emergency-item .info h4 {
            font-size: 14px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 3px;
        }

        .emergency-item .info a {
            font-size: 14px;
            color: var(--dark);
            font-weight: 600;
        }

        .emergency-item .info a:hover { color: var(--secondary); }

        /* =====================================================
           MAP SECTION
           ===================================================== */
        .map-section {
            padding: 0 0 100px;
            background: var(--light);
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,0.12);
            height: 480px;
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        .map-overlay {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: var(--white);
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            max-width: 320px;
            z-index: 2;
        }

        .map-overlay h3 {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .map-overlay p {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .map-overlay .btn {
            padding: 10px 22px;
            font-size: 13px;
        }

        /* =====================================================
           FAQ SECTION
           ===================================================== */
        .faq-section {
            padding: 100px 0;
            background: var(--white);
        }

        .faq-container {
            max-width: 850px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-item {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 2px solid var(--border);
        }

        .faq-item.active {
            border-color: var(--secondary);
            box-shadow: 0 15px 40px rgba(245, 158, 11, 0.15);
        }

        .faq-question {
            padding: 22px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            color: var(--primary);
            transition: all 0.3s ease;
            user-select: none;
        }

        .faq-question:hover { background: var(--light); }

        .faq-item.active .faq-question {
            background: var(--light);
            color: var(--primary);
        }

        .faq-question .q-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .faq-item.active .q-icon {
            background: var(--secondary);
            color: var(--white);
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.3s ease;
            padding: 0 30px;
            color: var(--gray);
            font-size: 14px;
            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            max-height: 300px;
            padding: 0 30px 25px;
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

            .info-grid { grid-template-columns: repeat(2, 1fr); }

            .contact-main-grid { grid-template-columns: 1fr; gap: 30px; }

            .map-container { height: 380px; }

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

            .info-grid,
            .social-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .form-container { padding: 30px 22px; }
            .form-grid { grid-template-columns: 1fr; }

            .side-card { padding: 25px 22px; }

            .map-container { height: 320px; }

            .map-overlay {
                position: static;
                margin: 20px;
                max-width: 100%;
            }

            .faq-question {
                padding: 18px 22px;
                font-size: 14px;
                gap: 12px;
            }

            .faq-answer {
                padding: 0 22px;
                font-size: 13px;
            }

            .faq-item.active .faq-answer {
                padding: 0 22px 20px;
            }

            .section-title { font-size: 26px; }
            .form-container h2 { font-size: 22px; }

            .cta-section h2 { font-size: 24px; }
            .cta-section p { font-size: 15px; }

            .contact-info-section,
            .contact-main-section,
            .map-section,
            .faq-section { padding: 60px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 24px; }
            .section-title { font-size: 22px; }
            .info-card { padding: 30px 20px; }
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
                <li><a href="notice.php">Notice</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
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
        <h1>Contact <span>Us</span></h1>
        <p>Have questions? We'd love to hear from you. Reach out to us anytime!</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Contact Us</span>
        </div>
    </div>
</section>


<!-- =====================================================
     CONTACT INFO CARDS
     ===================================================== -->
<section class="contact-info-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Get In Touch</span>
            <h2 class="section-title">Contact <span>Information</span></h2>
            <p class="section-desc">Multiple ways to connect with us. Choose what's convenient for you.</p>
        </div>

        <div class="info-grid">

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3>Our Location</h3>
                <p>123, Main Road, Near Metro Station,<br>Delhi, India - 110001</p>
            </div>

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                <h3>Call Us</h3>
                <p>Mon - Sat: 8:00 AM - 4:00 PM</p>
                <a href="tel:+919876543210">+91 98765 43210</a>
                <a href="tel:+919876543211">+91 98765 43211</a>
            </div>

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <h3>Email Us</h3>
                <p>We reply within 24 hours</p>
                <a href="mailto:info@sunriseschool.com">info@sunriseschool.com</a>
                <a href="mailto:admission@sunriseschool.com">admission@sunriseschool.com</a>
            </div>

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-clock"></i></div>
                <h3>Office Hours</h3>
                <p>Monday - Friday: 8:00 - 4:00<br>Saturday: 8:00 - 12:00</p>
            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     CONTACT FORM + SIDE INFO
     ===================================================== -->
<section class="contact-main-section">
    <div class="container">
        <div class="contact-main-grid">

            <!-- Form -->
            <div class="form-container reveal">
                <h2>Send Us a Message</h2>
                <p>Fill the form below and we'll get back to you as soon as possible.</p>

                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $message_type; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="contactFormEl">

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text" name="name" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="email" placeholder="example@email.com" required>
                        </div>

                        <div class="form-group">
                            <label>Mobile Number <span class="req">*</span></label>
                            <input type="tel" name="phone" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
                        </div>

                        <div class="form-group">
                            <label>Subject <span class="req">*</span></label>
                            <select name="subject" required>
                                <option value="">-- Select Subject --</option>
                                <option>Admission Enquiry</option>
                                <option>Fee Related</option>
                                <option>Academic Query</option>
                                <option>Transport Facility</option>
                                <option>Teaching Job</option>
                                <option>General Enquiry</option>
                                <option>Complaint / Feedback</option>
                            </select>
                        </div>

                        <div class="form-group full">
                            <label>Your Message <span class="req">*</span></label>
                            <textarea name="message" placeholder="Write your message here..." required></textarea>
                        </div>

                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </div>

                </form>
            </div>

            <!-- Side Info -->
            <div class="contact-side">

                <!-- Office Hours -->
                <div class="side-card reveal">
                    <div class="side-card-header">
                        <div class="icon-circle"><i class="fas fa-clock"></i></div>
                        <h3>Office Hours</h3>
                    </div>
                    <div class="hours-list">
                        <div class="hours-item">
                            <span class="day">Monday</span>
                            <span class="time">8:00 AM - 4:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Tuesday</span>
                            <span class="time">8:00 AM - 4:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Wednesday</span>
                            <span class="time">8:00 AM - 4:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Thursday</span>
                            <span class="time">8:00 AM - 4:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Friday</span>
                            <span class="time">8:00 AM - 4:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Saturday</span>
                            <span class="time">8:00 AM - 12:00 PM</span>
                        </div>
                        <div class="hours-item closed">
                            <span class="day">Sunday</span>
                            <span class="time">Closed</span>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="side-card reveal">
                    <div class="side-card-header">
                        <div class="icon-circle"><i class="fas fa-ambulance"></i></div>
                        <h3>Emergency Contact</h3>
                    </div>
                    <div class="emergency-list">
                        <div class="emergency-item">
                            <i class="fas fa-phone-volume"></i>
                            <div class="info">
                                <h4>Principal Office</h4>
                                <a href="tel:+919876543210">+91 98765 43210</a>
                            </div>
                        </div>
                        <div class="emergency-item">
                            <i class="fas fa-bus"></i>
                            <div class="info">
                                <h4>Transport Department</h4>
                                <a href="tel:+919876543212">+91 98765 43212</a>
                            </div>
                        </div>
                        <div class="emergency-item">
                            <i class="fas fa-user-nurse"></i>
                            <div class="info">
                                <h4>Medical Room</h4>
                                <a href="tel:+919876543213">+91 98765 43213</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Connect -->
                <div class="side-card reveal">
                    <div class="side-card-header">
                        <div class="icon-circle"><i class="fas fa-share-alt"></i></div>
                        <h3>Connect With Us</h3>
                    </div>
                    <div class="social-grid">
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="#" class="social-btn instagram">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                        <a href="#" class="social-btn twitter">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="social-btn youtube">
                            <i class="fab fa-youtube"></i> YouTube
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- =====================================================
     GOOGLE MAP SECTION
     ===================================================== -->
<section class="map-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Find Us</span>
            <h2 class="section-title">Visit Our <span>Campus</span></h2>
            <p class="section-desc">Come and see our beautiful campus in person.</p>
        </div>

        <div class="map-container reveal">
            <!-- Google Map Embed -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0582735951447!2d77.20902131492479!3d28.61393999242188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew%20Delhi%2C%20Delhi!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <div class="map-overlay">
                <h3><i class="fas fa-map-marker-alt" style="color:var(--secondary);"></i> Sunrise Public School</h3>
                <p>123, Main Road, Near Metro Station,<br>Delhi, India - 110001</p>
                <a href="https://maps.google.com" target="_blank" class="btn btn-primary-dark">
                    <i class="fas fa-directions"></i> Get Directions
                </a>
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     FAQ SECTION
     ===================================================== -->
<section class="faq-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
            <p class="section-desc">Find quick answers to common questions about our school.</p>
        </div>

        <div class="faq-container">

            <?php foreach ($faqs as $index => $faq): ?>
            <div class="faq-item reveal">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span><?php echo $faq['q']; ?></span>
                    <span class="q-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <?php echo $faq['a']; ?>
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
        <h2>Still Have Questions?</h2>
        <p>Our team is here to help. Reach out to us and we'll get back to you soon.</p>
        <div class="cta-buttons">
            <a href="tel:+919876543210" class="btn btn-primary">
                <i class="fas fa-phone-alt"></i> Call Now
            </a>
            <a href="admission.php" class="btn btn-outline">
                Apply for Admission
            </a>
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
    // FAQ ACCORDION
    // =====================================================
    function toggleFaq(element) {
        const faqItem = element.parentElement;
        const isActive = faqItem.classList.contains('active');

        // Close all other FAQs
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });

        // Toggle current
        if (!isActive) {
            faqItem.classList.add('active');
        }
    }

    // =====================================================
    // FORM VALIDATION
    // =====================================================
    document.getElementById('contactFormEl').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                valid = false;
                field.style.borderColor = '#ef4444';
            } else {
                field.style.borderColor = '#e5e7eb';
            }
        });

        // Email validation
        const emailField = this.querySelector('input[name="email"]');
        if (emailField && emailField.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailField.value.trim())) {
                valid = false;
                emailField.style.borderColor = '#ef4444';
            }
        }

        // Phone validation
        const phoneField = this.querySelector('input[name="phone"]');
        if (phoneField && phoneField.value.trim()) {
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phoneField.value.trim())) {
                valid = false;
                phoneField.style.borderColor = '#ef4444';
            }
        }

        if (!valid) {
            e.preventDefault();
            alert('❌ Please fill all required fields correctly!');
        }
    });

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
    // AUTO SCROLL TO ALERT ON SUBMIT
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