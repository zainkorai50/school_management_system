<?php
// ============================================
// Sunrise Public School - Fee Payment Page
// Online Fee Payment + Receipt + History
// ============================================
session_start();

// ---------- DEMO STUDENT LOOKUP (Optional) ----------
// Agar student logged in hai to uska data use karo
$student = [
    'name' => 'Aarav Sharma',
    'class' => 'Class 10-A',
    'roll' => '10A01',
    'student_id' => 'SPS2024001',
    'photo' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=300'
];

$is_logged_in = false;
if (isset($_SESSION['student_logged_in']) && $_SESSION['student_logged_in'] === true) {
    $student['name'] = $_SESSION['student_name'];
    $student['class'] = $_SESSION['student_class'];
    $student['roll'] = $_SESSION['student_roll'];
    $student['student_id'] = $_SESSION['student_id'];
    $student['photo'] = $_SESSION['student_photo'] ?? $student['photo'];
    $is_logged_in = true;
}

// ---------- FEE STRUCTURE ----------
$fee_data = [
    'total' => 45000,
    'paid' => 30000,
    'pending' => 15000,
    'discount' => 0,
    'late_fee' => 0,
    'due_date' => '31 Jan 2025',
    'session' => '2024-25',
];

$payable = $fee_data['pending'] + $fee_data['late_fee'] - $fee_data['discount'];
$paid_percentage = round(($fee_data['paid'] / $fee_data['total']) * 100, 1);

// ---------- FEE BREAKDOWN ----------
$fee_breakdown = [
    ['head' => 'Tuition Fee', 'amount' => 30000, 'paid' => 20000, 'pending' => 10000],
    ['head' => 'Transport Fee', 'amount' => 8000, 'paid' => 6000, 'pending' => 2000],
    ['head' => 'Library Fee', 'amount' => 2000, 'paid' => 2000, 'pending' => 0],
    ['head' => 'Sports Fee', 'amount' => 3000, 'paid' => 1500, 'pending' => 1500],
    ['head' => 'Exam Fee', 'amount' => 2000, 'paid' => 500, 'pending' => 1500],
];

// ---------- PAYMENT HISTORY ----------
$payment_history = [
    ['id' => 'TXN202401001', 'date' => '15 Aug 2024', 'amount' => 15000, 'method' => 'UPI', 'status' => 'Success'],
    ['id' => 'TXN202409002', 'date' => '10 Sep 2024', 'amount' => 10000, 'method' => 'Card', 'status' => 'Success'],
    ['id' => 'TXN202411003', 'date' => '05 Nov 2024', 'amount' => 5000, 'method' => 'Net Banking', 'status' => 'Success'],
];

// ---------- SUBMIT HANDLING ----------
$message = "";
$message_type = "";
$receipt = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_now'])) {

    $amount = (float) ($_POST['amount'] ?? 0);
    $method = trim($_POST['payment_method'] ?? '');
    $student_id = trim($_POST['student_id'] ?? $student['student_id']);
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($amount <= 0) {
        $message = "❌ Please enter a valid amount!";
        $message_type = "error";
    } elseif ($amount > $payable) {
        $message = "❌ Amount cannot exceed payable amount (₹" . number_format($payable) . ")!";
        $message_type = "error";
    } elseif (empty($method)) {
        $message = "❌ Please select a payment method!";
        $message_type = "error";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Please enter a valid email address!";
        $message_type = "error";
    } elseif (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
        $message = "❌ Please enter a valid 10-digit mobile number!";
        $message_type = "error";
    } else {
        // Success - generate receipt
        $txn_id = 'TXN' . date('Ymd') . rand(1000, 9999);

        $receipt = [
            'txn_id' => $txn_id,
            'date' => date('d M Y, h:i A'),
            'student_name' => $student['name'],
            'student_id' => $student_id,
            'class' => $student['class'],
            'amount' => $amount,
            'method' => $method,
            'email' => $email,
            'phone' => $phone,
            'remaining' => $payable - $amount,
        ];

        $message = "✅ Payment Successful!<br>
                    Transaction ID: <strong>" . $txn_id . "</strong><br>
                    Amount: <strong>₹" . number_format($amount) . "</strong><br>
                    A receipt has been sent to <strong>" . htmlspecialchars($email) . "</strong>";
        $message_type = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Payment | Sunrise Public School</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
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
            background: var(--light);
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

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        .btn-green {
            background: var(--green);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
        }

        .btn-green:hover {
            background: #059669;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5);
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

        .nav-menu ul { display: flex; align-items: center; gap: 25px; }

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

        /* PAGE BANNER */
        .page-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(30, 58, 138, 0.75)),
                        url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1600') center/cover;
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

        /* SECTION HEADER */
        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 40px;
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

        /* MAIN PAYMENT SECTION */
        .payment-section {
            padding: 80px 0 100px;
            background: var(--light);
        }

        /* Student Info Card */
        .student-info-card {
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 25px;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.25);
        }

        .student-info-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -5%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .student-info-card::after {
            content: '';
            position: absolute;
            bottom: -60%;
            right: 20%;
            width: 200px;
            height: 200px;
            background: rgba(245, 158, 11, 0.2);
            border-radius: 50%;
        }

        .student-info-card > * { position: relative; z-index: 2; }

        .student-info-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .student-info-text h2 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .student-info-text p {
            font-size: 14px;
            opacity: 0.9;
        }

        .student-info-badges {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .student-info-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .student-info-status {
            text-align: center;
        }

        .student-info-status .status-badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: rgba(245, 158, 11, 0.25);
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: #fef3c7;
        }

        .student-info-status .status-amount {
            font-size: 32px;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
            margin-top: 8px;
        }

        .student-info-status .status-label {
            font-size: 11px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        /* Fee Summary */
        .fee-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .fee-summary-card {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .fee-summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .fee-summary-card.total { border-left-color: var(--primary); }
        .fee-summary-card.paid { border-left-color: var(--green); }
        .fee-summary-card.pending { border-left-color: var(--red); }
        .fee-summary-card.due { border-left-color: var(--secondary); }

        .fee-summary-card h4 {
            font-size: 12px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .fee-summary-card .amount {
            font-size: 26px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 6px;
        }

        .fee-summary-card.total .amount { color: var(--primary); }
        .fee-summary-card.paid .amount { color: var(--green); }
        .fee-summary-card.pending .amount { color: var(--red); }
        .fee-summary-card.due .amount { color: var(--secondary); }

        .fee-summary-card p {
            font-size: 12px;
            color: var(--gray);
        }

        /* Main Payment Grid */
        .payment-main-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 30px;
            align-items: start;
        }

        /* Payment Form Container */
        .payment-form-container {
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .payment-form-container h2 {
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 800;
        }

        .payment-form-container > p {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 18px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.7;
            font-weight: 500;
            animation: fadeUp 0.5s ease;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .alert i {
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
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
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin: 25px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border);
        }

        .form-section-title:first-of-type { margin-top: 0; }

        .form-section-title .num {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }

        .form-group label {
            font-size: 13px;
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

        .form-group select { cursor: pointer; }

        /* Amount Quick Select */
        .amount-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .amount-option {
            padding: 8px 18px;
            border-radius: 20px;
            background: var(--light);
            color: var(--primary);
            border: 2px solid var(--border);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .amount-option:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .amount-option.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--secondary);
        }

        /* Payment Methods */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .method-card {
            padding: 18px 12px;
            border-radius: 12px;
            border: 2px solid var(--border);
            background: var(--white);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .method-card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
        }

        .method-card.active {
            border-color: var(--primary);
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.05), rgba(59, 130, 246, 0.05));
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.15);
        }

        .method-card.active::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 8px;
            right: 8px;
            width: 20px;
            height: 20px;
            background: var(--green);
            color: var(--white);
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .method-card i {
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 8px;
            display: block;
            transition: all 0.3s ease;
        }

        .method-card.active i { color: var(--secondary); }

        .method-card h4 {
            font-size: 12px;
            color: var(--dark);
            font-weight: 600;
        }

        .method-card p {
            font-size: 10px;
            color: var(--gray);
            margin-top: 2px;
        }

        /* Amount Display */
        .amount-display {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 20px 25px;
            border-radius: 12px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid var(--secondary);
            flex-wrap: wrap;
            gap: 15px;
        }

        .amount-display-text h4 {
            font-size: 12px;
            color: #78350f;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .amount-display-text p {
            font-size: 13px;
            color: #92400e;
        }

        .amount-display-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
        }

        /* Submit Button */
        .form-submit {
            margin-top: 25px;
        }

        .form-submit .btn {
            width: 100%;
            padding: 18px 32px;
            font-size: 16px;
            font-weight: 700;
        }

        /* Summary Side Card */
        .summary-side {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 90px;
        }

        .side-card {
            background: var(--white);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .side-card h3 {
            font-size: 17px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .side-card h3 i {
            color: var(--secondary);
        }

        /* Progress Bar */
        .progress-wrapper {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .progress-header span:first-child { color: var(--gray); }
        .progress-header span:last-child { color: var(--primary); font-weight: 800; }

        .progress-bar-outer {
            height: 12px;
            background: var(--border);
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-bar-inner {
            height: 100%;
            background: linear-gradient(90deg, var(--green), #059669);
            border-radius: 6px;
            transition: width 1.5s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 6px;
            color: var(--white);
            font-size: 9px;
            font-weight: 700;
        }

        /* Breakdown List */
        .breakdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px dashed var(--border);
            font-size: 13px;
        }

        .breakdown-item:last-child { border-bottom: none; }

        .breakdown-head {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .breakdown-head strong {
            font-size: 13px;
            color: var(--dark);
            font-weight: 600;
        }

        .breakdown-head small {
            font-size: 11px;
            color: var(--gray);
        }

        .breakdown-amount {
            text-align: right;
        }

        .breakdown-amount strong {
            display: block;
            font-size: 14px;
            font-weight: 800;
            color: var(--primary);
        }

        .breakdown-amount small {
            font-size: 10px;
            color: var(--red);
            font-weight: 600;
        }

        /* Info Box */
        .info-box {
            background: #eff6ff;
            border-left: 4px solid var(--blue);
            padding: 15px 18px;
            border-radius: 10px;
            font-size: 12px;
            color: #1e40af;
            line-height: 1.7;
            display: flex;
            gap: 10px;
        }

        .info-box i {
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Payment History */
        .history-section {
            padding: 80px 0 100px;
            background: var(--white);
        }

        .history-table-wrapper {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .history-table thead th {
            padding: 18px 20px;
            text-align: left;
            color: var(--white);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .history-table tbody td {
            padding: 18px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .history-table tbody tr:last-child td { border-bottom: none; }
        .history-table tbody tr:hover { background: var(--light); }

        .txn-id {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: var(--primary);
            font-size: 13px;
        }

        .history-amount {
            font-weight: 800;
            color: var(--green);
            font-size: 15px;
        }

        .method-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            background: var(--light);
            color: var(--primary);
        }

        .method-badge i { font-size: 11px; }

        .status-badge-success {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            background: #d1fae5;
            color: #065f46;
        }

        .download-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--light);
            color: var(--primary);
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .download-btn:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Receipt Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active { display: flex; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .receipt-modal {
            background: var(--white);
            border-radius: 20px;
            max-width: 550px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .receipt-header {
            background: linear-gradient(135deg, var(--green), #059669);
            color: var(--white);
            padding: 35px 30px;
            text-align: center;
            border-radius: 20px 20px 0 0;
            position: relative;
            overflow: hidden;
        }

        .receipt-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 250px;
            height: 250px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .receipt-header > * { position: relative; z-index: 2; }

        .receipt-success-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255,255,255,0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 15px;
            animation: scaleIn 0.5s ease 0.3s backwards;
        }

        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }

        .receipt-header h2 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .receipt-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .receipt-body {
            padding: 30px;
        }

        .receipt-school-name {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px dashed var(--border);
            margin-bottom: 25px;
        }

        .receipt-school-name h3 {
            font-size: 20px;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 5px;
        }

        .receipt-school-name p {
            font-size: 12px;
            color: var(--gray);
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 13px;
            border-bottom: 1px dashed var(--border);
        }

        .receipt-row:last-child { border-bottom: none; }

        .receipt-row span:first-child {
            color: var(--gray);
            font-weight: 500;
        }

        .receipt-row span:last-child {
            font-weight: 700;
            color: var(--dark);
            text-align: right;
        }

        .receipt-amount-box {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin: 20px 0;
            border: 2px dashed var(--green);
        }

        .receipt-amount-box p {
            font-size: 12px;
            color: #065f46;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .receipt-amount-box h2 {
            font-size: 34px;
            color: var(--green);
            font-weight: 800;
            line-height: 1;
        }

        .receipt-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 2px dashed var(--border);
            font-size: 12px;
            color: var(--gray);
            line-height: 1.7;
        }

        .receipt-footer strong {
            display: block;
            color: var(--primary);
            margin-bottom: 5px;
            font-size: 13px;
        }

        .receipt-actions {
            padding: 0 30px 30px;
            display: flex;
            gap: 12px;
        }

        .receipt-actions .btn {
            flex: 1;
            padding: 12px;
            font-size: 14px;
        }

        /* CTA Section */
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

        .cta-buttons .btn-outline {
            color: var(--white);
            border-color: var(--white);
        }

        .cta-buttons .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
        }

        /* FOOTER */
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

        #backToTop.show { opacity: 1; visibility: visible; }
        #backToTop:hover { background: var(--primary); transform: translateY(-5px); }

        /* SCROLL REVEAL */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.active { opacity: 1; transform: translateY(0); }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .fee-summary-grid { grid-template-columns: repeat(2, 1fr); }
            .payment-main-grid { grid-template-columns: 1fr; }
            .summary-side { position: static; }
        }

        @media (max-width: 992px) {
            .page-banner h1 { font-size: 38px; }
            .page-banner p { font-size: 15px; }
            .student-info-card { grid-template-columns: auto 1fr; }
            .student-info-status { grid-column: 1 / -1; text-align: left; display: flex; align-items: center; gap: 20px; }
            .payment-methods { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .section-title { font-size: 32px; }
            .cta-section h2 { font-size: 28px; }
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

            .page-banner { padding: 70px 0 50px; }
            .page-banner h1 { font-size: 26px; }
            .page-banner p { font-size: 14px; }
            .breadcrumb { font-size: 12px; padding: 8px 18px; }

            .fee-summary-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .fee-summary-card { padding: 18px; }
            .fee-summary-card .amount { font-size: 20px; }

            .student-info-card {
                padding: 22px;
                grid-template-columns: 1fr;
                text-align: center;
                gap: 15px;
            }
            .student-info-img { margin: 0 auto; width: 80px; height: 80px; }
            .student-info-text h2 { font-size: 20px; }
            .student-info-badges { justify-content: center; }
            .student-info-status { justify-content: center; }

            .payment-form-container { padding: 25px 20px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-section-title { font-size: 14px; }

            .payment-methods { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .method-card { padding: 14px 8px; }
            .method-card i { font-size: 20px; }

            .amount-display { flex-direction: column; text-align: center; gap: 10px; }
            .amount-display-value { font-size: 26px; }

            .side-card { padding: 22px 20px; }

            .history-table thead { display: none; }
            .history-table tbody tr {
                display: block;
                padding: 15px;
                border-bottom: 1px solid var(--border);
            }
            .history-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 6px 0;
                border: none;
            }
            .history-table tbody td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--gray);
                font-size: 12px;
                text-transform: uppercase;
            }

            .receipt-modal { max-width: 95%; }
            .receipt-header { padding: 25px 20px; }
            .receipt-header h2 { font-size: 20px; }
            .receipt-body { padding: 22px; }
            .receipt-amount-box h2 { font-size: 26px; }
            .receipt-actions { padding: 0 22px 22px; flex-direction: column; }

            .footer-grid { grid-template-columns: 1fr; }

            .section-title { font-size: 24px; }
            .cta-section h2 { font-size: 22px; }
            .cta-section p { font-size: 14px; }

            .payment-section,
            .history-section { padding: 60px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 22px; }
            .section-title { font-size: 20px; }
            .fee-summary-grid { grid-template-columns: 1fr; }
            .payment-methods { grid-template-columns: repeat(2, 1fr); }
            .method-card h4 { font-size: 11px; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="container topbar-wrapper">
        <div class="topbar-left">
            <span><i class="fas fa-phone"></i> +91 98765 43210</span>
            <span><i class="fas fa-envelope"></i> accounts@sunriseschool.com</span>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="academics.php">Academics</a></li>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="faculty.php">Faculty</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="notice.php">Notice</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <a href="login.php" class="btn-login">
                <i class="fas fa-user"></i> Login
            </a>
        </nav>

        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>
</header>


<!-- PAGE BANNER -->
<section class="page-banner">
    <div class="container">
        <h1>Online <span>Fee Payment</span></h1>
        <p>Pay your school fees securely online using UPI, Card, Net Banking, or Wallet.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Fee Payment</span>
        </div>
    </div>
</section>


<!-- MAIN PAYMENT SECTION -->
<section class="payment-section">
    <div class="container">

        <!-- Student Info Card -->
        <div class="student-info-card reveal">
            <img class="student-info-img" src="<?php echo $student['photo']; ?>" alt="<?php echo $student['name']; ?>">

            <div class="student-info-text">
                <h2><?php echo $student['name']; ?></h2>
                <p>Student ID: <?php echo $student['student_id']; ?> | <?php echo $student['class']; ?> | Roll: <?php echo $student['roll']; ?></p>
                <div class="student-info-badges">
                    <span class="student-info-badge"><i class="fas fa-calendar-alt"></i> Session: <?php echo $fee_data['session']; ?></span>
                    <span class="student-info-badge"><i class="fas fa-clock"></i> Due: <?php echo $fee_data['due_date']; ?></span>
                </div>
            </div>

            <div class="student-info-status">
                <div>
                    <span class="status-badge"><i class="fas fa-exclamation-circle"></i> Pending</span>
                    <div class="status-amount">₹<?php echo number_format($payable); ?></div>
                    <div class="status-label">Payable Amount</div>
                </div>
            </div>
        </div>

        <!-- Fee Summary Cards -->
        <div class="fee-summary-grid reveal">
            <div class="fee-summary-card total">
                <h4><i class="fas fa-file-invoice-dollar"></i> Total Fee</h4>
                <div class="amount">₹<?php echo number_format($fee_data['total']); ?></div>
                <p>Annual Session 2024-25</p>
            </div>
            <div class="fee-summary-card paid">
                <h4><i class="fas fa-check-circle"></i> Paid</h4>
                <div class="amount">₹<?php echo number_format($fee_data['paid']); ?></div>
                <p><?php echo $paid_percentage; ?>% completed</p>
            </div>
            <div class="fee-summary-card pending">
                <h4><i class="fas fa-clock"></i> Pending</h4>
                <div class="amount">₹<?php echo number_format($fee_data['pending']); ?></div>
                <p>Balance to pay</p>
            </div>
            <div class="fee-summary-card due">
                <h4><i class="fas fa-calendar-exclamation"></i> Due Date</h4>
                <div class="amount" style="font-size: 20px;"><?php echo $fee_data['due_date']; ?></div>
                <p>Pay before due date</p>
            </div>
        </div>

        <!-- Main Payment Grid -->
        <div class="payment-main-grid">

            <!-- Payment Form -->
            <div class="payment-form-container reveal">

                <h2><i class="fas fa-credit-card" style="color:var(--secondary);"></i> Payment Details</h2>
                <p>Fill the details below to make payment</p>

                <?php if (!empty($message)): ?>
                    <div class="alert <?php echo $message_type; ?>">
                        <i class="fas fa-<?php echo $message_type === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                        <div><?php echo $message; ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="paymentForm">

                    <!-- Section 1: Student Info -->
                    <div class="form-section-title">
                        <span class="num">1</span> Student Information
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" value="<?php echo $student['name']; ?>" readonly style="background: var(--light);">
                        </div>
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" name="student_id" value="<?php echo $student['student_id']; ?>" readonly style="background: var(--light);">
                        </div>
                    </div>

                    <!-- Section 2: Amount -->
                    <div class="form-section-title">
                        <span class="num">2</span> Payment Amount
                    </div>

                    <div class="form-group">
                        <label>Enter Amount <span class="req">*</span></label>
                        <input type="number" name="amount" id="amountInput" placeholder="Enter amount to pay" min="1" max="<?php echo $payable; ?>" step="100" required>
                        <div class="amount-options">
                            <button type="button" class="amount-option" onclick="setAmount(<?php echo $payable; ?>, this)">
                                Full Amount ₹<?php echo number_format($payable); ?>
                            </button>
                            <button type="button" class="amount-option" onclick="setAmount(10000, this)">₹10,000</button>
                            <button type="button" class="amount-option" onclick="setAmount(5000, this)">₹5,000</button>
                        </div>
                    </div>

                    <!-- Section 3: Payment Method -->
                    <div class="form-section-title">
                        <span class="num">3</span> Select Payment Method
                    </div>

                    <input type="hidden" name="payment_method" id="methodInput" required>

                    <div class="payment-methods">
                        <div class="method-card" onclick="selectMethod('UPI', this)" data-method="UPI">
                            <i class="fas fa-mobile-alt"></i>
                            <h4>UPI</h4>
                            <p>GPay, PhonePe</p>
                        </div>
                        <div class="method-card" onclick="selectMethod('Card', this)" data-method="Card">
                            <i class="fas fa-credit-card"></i>
                            <h4>Card</h4>
                            <p>Credit / Debit</p>
                        </div>
                        <div class="method-card" onclick="selectMethod('Net Banking', this)" data-method="Net Banking">
                            <i class="fas fa-university"></i>
                            <h4>Net Banking</h4>
                            <p>All banks</p>
                        </div>
                        <div class="method-card" onclick="selectMethod('Wallet', this)" data-method="Wallet">
                            <i class="fas fa-wallet"></i>
                            <h4>Wallet</h4>
                            <p>Paytm, Amazon</p>
                        </div>
                    </div>

                    <!-- Section 4: Contact -->
                    <div class="form-section-title">
                        <span class="num">4</span> Contact Details
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="email" placeholder="example@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number <span class="req">*</span></label>
                            <input type="tel" name="phone" placeholder="10-digit mobile" pattern="[0-9]{10}" required>
                        </div>
                    </div>

                    <!-- Amount Display -->
                    <div class="amount-display">
                        <div class="amount-display-text">
                            <h4>Total Payable Amount</h4>
                            <p>Including all taxes</p>
                        </div>
                        <div class="amount-display-value" id="displayAmount">₹0</div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" name="pay_now" class="btn btn-green">
                            <i class="fas fa-lock"></i> Pay Securely Now
                        </button>
                    </div>

                </form>

            </div>

            <!-- Summary Side -->
            <div class="summary-side reveal">

                <!-- Progress Card -->
                <div class="side-card">
                    <h3><i class="fas fa-chart-pie"></i> Payment Progress</h3>

                    <div class="progress-wrapper">
                        <div class="progress-header">
                            <span>Paid</span>
                            <span>₹<?php echo number_format($fee_data['paid']); ?> / ₹<?php echo number_format($fee_data['total']); ?></span>
                        </div>
                        <div class="progress-bar-outer">
                            <div class="progress-bar-inner" style="width: <?php echo $paid_percentage; ?>%;">
                                <?php echo $paid_percentage; ?>%
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <div>You have paid <strong><?php echo $paid_percentage; ?>%</strong> of your total fee. Pay the remaining amount before <strong><?php echo $fee_data['due_date']; ?></strong> to avoid late fees.</div>
                    </div>
                </div>

                <!-- Fee Breakdown -->
                <div class="side-card">
                    <h3><i class="fas fa-list-alt"></i> Fee Breakdown</h3>

                    <?php foreach ($fee_breakdown as $item): ?>
                    <div class="breakdown-item">
                        <div class="breakdown-head">
                            <strong><?php echo $item['head']; ?></strong>
                            <small>Total: ₹<?php echo number_format($item['amount']); ?></small>
                        </div>
                        <div class="breakdown-amount">
                            <strong>₹<?php echo number_format($item['paid']); ?></strong>
                            <?php if ($item['pending'] > 0): ?>
                                <small>₹<?php echo number_format($item['pending']); ?> due</small>
                            <?php else: ?>
                                <small style="color: var(--green);">Paid ✓</small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Help Card -->
                <div class="side-card">
                    <h3><i class="fas fa-headset"></i> Need Help?</h3>
                    <p style="font-size: 13px; color: var(--gray); margin-bottom: 15px;">
                        Having trouble with payment? Contact our accounts department.
                    </p>
                    <a href="tel:+919876543210" class="btn btn-outline" style="width: 100%; margin-bottom: 10px;">
                        <i class="fas fa-phone"></i> Call: +91 98765 43210
                    </a>
                    <a href="mailto:accounts@sunriseschool.com" class="btn btn-outline" style="width: 100%;">
                        <i class="fas fa-envelope"></i> Email Accounts
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>


<!-- PAYMENT HISTORY SECTION -->
<section class="history-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Payment History</span>
            <h2 class="section-title">Your Recent <span>Transactions</span></h2>
            <p class="section-desc">All your past payments and receipts in one place.</p>
        </div>

        <div class="history-table-wrapper reveal">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payment_history as $p): ?>
                    <tr>
                        <td data-label="Transaction ID">
                            <span class="txn-id"><?php echo $p['id']; ?></span>
                        </td>
                        <td data-label="Date"><?php echo $p['date']; ?></td>
                        <td data-label="Amount">
                            <span class="history-amount">₹<?php echo number_format($p['amount']); ?></span>
                        </td>
                        <td data-label="Method">
                            <span class="method-badge">
                                <i class="fas fa-<?php 
                                    echo $p['method'] === 'UPI' ? 'mobile-alt' : 
                                        ($p['method'] === 'Card' ? 'credit-card' : 
                                        ($p['method'] === 'Net Banking' ? 'university' : 'wallet')); 
                                ?>"></i>
                                <?php echo $p['method']; ?>
                            </span>
                        </td>
                        <td data-label="Status">
                            <span class="status-badge-success">
                                <i class="fas fa-check-circle"></i> <?php echo $p['status']; ?>
                            </span>
                        </td>
                        <td data-label="Receipt">
                            <button class="download-btn" onclick="downloadReceipt('<?php echo $p['id']; ?>', <?php echo $p['amount']; ?>, '<?php echo $p['date']; ?>', '<?php echo $p['method']; ?>')" title="Download Receipt">
                                <i class="fas fa-download"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>


<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <h2>Have Questions About Fees?</h2>
        <p>Our accounts team is here to help you with any queries.</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary">
                <i class="fas fa-headset"></i> Contact Us
            </a>
            <a href="notice.php" class="btn btn-outline">
                View Notices
            </a>
        </div>
    </div>
</section>


<!-- RECEIPT MODAL -->
<div class="modal-overlay" id="receiptModal">
    <div class="receipt-modal">
        <div class="receipt-header">
            <div class="receipt-success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2>Payment Successful!</h2>
            <p>Your transaction has been completed</p>
        </div>

        <div class="receipt-body">

            <div class="receipt-school-name">
                <h3>🎓 Sunrise Public School</h3>
                <p>123, Main Road, Delhi - 110001 | accounts@sunriseschool.com</p>
            </div>

            <div class="receipt-row">
                <span>Transaction ID</span>
                <span class="txn-id" id="rTxnId">-</span>
            </div>
            <div class="receipt-row">
                <span>Date & Time</span>
                <span id="rDate">-</span>
            </div>
            <div class="receipt-row">
                <span>Student Name</span>
                <span><?php echo $student['name']; ?></span>
            </div>
            <div class="receipt-row">
                <span>Student ID</span>
                <span><?php echo $student['student_id']; ?></span>
            </div>
            <div class="receipt-row">
                <span>Class</span>
                <span><?php echo $student['class']; ?></span>
            </div>
            <div class="receipt-row">
                <span>Payment Method</span>
                <span id="rMethod">-</span>
            </div>

            <div class="receipt-amount-box">
                <p>Amount Paid</p>
                <h2 id="rAmount">₹0</h2>
            </div>

            <div class="receipt-footer">
                <strong>Thank you for your payment!</strong>
                This is a computer-generated receipt. No signature required.<br>
                For any queries, contact +91 98765 43210
            </div>

        </div>

        <div class="receipt-actions">
            <button class="btn btn-green" onclick="downloadCurrentReceipt()">
                <i class="fas fa-download"></i> Download
            </button>
            <button class="btn btn-outline" onclick="closeReceipt()">
                <i class="fas fa-times"></i> Close
            </button>
        </div>

    </div>
</div>


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
                        <li><a href="fee-payment.php">→ Pay Fees</a></li>
                        <li><a href="student-login.php">→ Student Login</a></li>
                        <li><a href="parent-login.php">→ Parent Login</a></li>
                        <li><a href="contact.php">→ Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Get In Touch</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123, Main Road, Delhi, India - 110001</li>
                        <li><i class="fas fa-phone"></i> +91 98765 43210</li>
                        <li><i class="fas fa-envelope"></i> accounts@sunriseschool.com</li>
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

    // AMOUNT SET
    function setAmount(amount, btn) {
        document.getElementById('amountInput').value = amount;
        document.getElementById('displayAmount').textContent = '₹' + amount.toLocaleString('en-IN');

        document.querySelectorAll('.amount-option').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // AMOUNT INPUT LIVE UPDATE
    document.getElementById('amountInput').addEventListener('input', function() {
        const value = parseFloat(this.value) || 0;
        document.getElementById('displayAmount').textContent = '₹' + value.toLocaleString('en-IN');
    });

    // SELECT METHOD
    function selectMethod(method, card) {
        document.getElementById('methodInput').value = method;
        document.querySelectorAll('.method-card').forEach(c => c.classList.remove('active'));
        card.classList.add('active');
    }

    // FORM VALIDATION
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        const amount = parseFloat(document.getElementById('amountInput').value) || 0;
        const method = document.getElementById('methodInput').value;
        const payable = <?php echo $payable; ?>;

        if (amount <= 0) {
            e.preventDefault();
            alert('❌ Please enter a valid amount!');
            return;
        }

        if (amount > payable) {
            e.preventDefault();
            alert('❌ Amount cannot exceed ₹' + payable.toLocaleString('en-IN'));
            return;
        }

        if (!method) {
            e.preventDefault();
            alert('❌ Please select a payment method!');
            return;
        }
    });

    // SCROLL REVEAL
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

    // BACK TO TOP
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // SHOW RECEIPT MODAL AFTER PAYMENT
    <?php if ($receipt): ?>
    window.addEventListener('load', () => {
        document.getElementById('rTxnId').textContent = '<?php echo $receipt['txn_id']; ?>';
        document.getElementById('rDate').textContent = '<?php echo $receipt['date']; ?>';
        document.getElementById('rMethod').textContent = '<?php echo $receipt['method']; ?>';
        document.getElementById('rAmount').textContent = '₹<?php echo number_format($receipt['amount']); ?>';
        document.getElementById('receiptModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    });
    <?php endif; ?>

    function closeReceipt() {
        document.getElementById('receiptModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // DOWNLOAD RECEIPT
    function downloadReceipt(txnId, amount, date, method) {
        const studentName = '<?php echo $student['name']; ?>';
        const studentId = '<?php echo $student['student_id']; ?>';
        const className = '<?php echo $student['class']; ?>';

        const content = 
            "================================================\n" +
            "       SUNRISE PUBLIC SCHOOL - RECEIPT          \n" +
            "================================================\n\n" +
            "Transaction ID: " + txnId + "\n" +
            "Date: " + date + "\n" +
            "Student Name: " + studentName + "\n" +
            "Student ID: " + studentId + "\n" +
            "Class: " + className + "\n" +
            "Payment Method: " + method + "\n\n" +
            "------------------------------------------------\n" +
            "AMOUNT PAID: ₹" + amount.toLocaleString('en-IN') + "\n" +
            "------------------------------------------------\n\n" +
            "Status: SUCCESS ✓\n\n" +
            "Thank you for your payment!\n\n" +
            "Sunrise Public School\n" +
            "123, Main Road, Delhi - 110001\n" +
            "accounts@sunriseschool.com | +91 98765 43210\n" +
            "================================================\n";

        const blob = new Blob([content], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'Receipt_' + txnId + '.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);

        alert('✅ Receipt downloaded: ' + a.download);
    }

    function downloadCurrentReceipt() {
        const txnId = document.getElementById('rTxnId').textContent;
        const amount = parseInt(document.getElementById('rAmount').textContent.replace(/[^0-9]/g, ''));
        const date = document.getElementById('rDate').textContent;
        const method = document.getElementById('rMethod').textContent;
        downloadReceipt(txnId, amount, date, method);
    }

    // PAGE LOAD
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('load', handleScroll);
</script>

</body>
</html>