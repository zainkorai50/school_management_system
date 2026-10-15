<?php
// ============================================
// Sunrise Public School - Admin Panel
// Single File - All Pages Inside
// ============================================
session_start();

// ---------- SESSION CHECK ----------
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: admin-login.php");
    exit;
}

// ---------- LOGOUT ----------
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$admin_name = $_SESSION['user_name'] ?? 'Zain Admin';
$admin_email = $_SESSION['user_email'] ?? 'zain1';
$admin_role = $_SESSION['user_role'] ?? 'admin';

// ---------- CURRENT PAGE ----------
$page = $_GET['page'] ?? 'overview';

// ---------- ACTION HANDLER (POST) ----------
$action_msg = "";
$action_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // ADD STUDENT
    if ($action === 'add_student') {
        $sname = trim($_POST['student_name'] ?? '');
        $class = trim($_POST['class'] ?? '');
        $parent = trim($_POST['parent_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($sname && $class && $parent && $phone) {
            $action_msg = "✅ Student '<strong>" . htmlspecialchars($sname) . "</strong>' added successfully in " . htmlspecialchars($class) . "!";
            $action_type = "success";
        } else {
            $action_msg = "❌ All fields are required!";
            $action_type = "error";
        }
    }

    // ADD TEACHER
    if ($action === 'add_teacher') {
        $tname = trim($_POST['teacher_name'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($tname && $subject && $email && $phone) {
            $action_msg = "✅ Teacher '<strong>" . htmlspecialchars($tname) . "</strong>' added successfully!";
            $action_type = "success";
        } else {
            $action_msg = "❌ All fields are required!";
            $action_type = "error";
        }
    }

    // PUBLISH NOTICE
    if ($action === 'publish_notice') {
        $title = trim($_POST['notice_title'] ?? '');
        $content = trim($_POST['notice_content'] ?? '');

        if ($title && $content) {
            $action_msg = "✅ Notice '<strong>" . htmlspecialchars($title) . "</strong>' published successfully!";
            $action_type = "success";
        } else {
            $action_msg = "❌ Title and content required!";
            $action_type = "error";
        }
    }

    // COLLECT FEE
    if ($action === 'collect_fee') {
        $student = trim($_POST['student'] ?? '');
        $amount = (float)($_POST['amount'] ?? 0);
        $method = trim($_POST['method'] ?? '');

        if ($student && $amount > 0 && $method) {
            $txn = 'TXN' . date('Ymd') . rand(1000, 9999);
            $action_msg = "✅ Fee collected! ₹" . number_format($amount) . " from <strong>" . htmlspecialchars($student) . "</strong> via " . $method . ". Txn: <strong>" . $txn . "</strong>";
            $action_type = "success";
        } else {
            $action_msg = "❌ All fields required!";
            $action_type = "error";
        }
    }

    // UPDATE SETTINGS
    if ($action === 'update_settings') {
        $action_msg = "✅ Settings updated successfully!";
        $action_type = "success";
    }
}

// ---------- DEMO DATA ----------
$stats = [
    'total_students' => 2543,
    'total_teachers' => 120,
    'total_classes' => 45,
    'monthly_revenue' => 1250000,
    'pending_admissions' => 12,
    'pending_fees' => 85,
];

$students_list = [
    ['id' => 'SPS2024001', 'name' => 'Aarav Sharma', 'class' => '10-A', 'roll' => '10A01', 'phone' => '+91 98765 43211'],
    ['id' => 'SPS2024002', 'name' => 'Priya Verma', 'class' => '9-B', 'roll' => '09B15', 'phone' => '+91 98765 43212'],
    ['id' => 'SPS2024003', 'name' => 'Rohan Kumar', 'class' => '12-A', 'roll' => '12A07', 'phone' => '+91 98765 43213'],
    ['id' => 'SPS2024004', 'name' => 'Ananya Singh', 'class' => '9-A', 'roll' => '09A22', 'phone' => '+91 98765 43214'],
    ['id' => 'SPS2024005', 'name' => 'Vivek Reddy', 'class' => '8-A', 'roll' => '08A05', 'phone' => '+91 98765 43215'],
];

$teachers_list = [
    ['id' => 'TCH1001', 'name' => 'Mrs. Anita Verma', 'subject' => 'English', 'email' => 'anita@school.com', 'phone' => '+91 98765 43221'],
    ['id' => 'TCH1002', 'name' => 'Mr. Amit Singh', 'subject' => 'Mathematics', 'email' => 'amit@school.com', 'phone' => '+91 98765 43222'],
    ['id' => 'TCH1003', 'name' => 'Mrs. Priya Sharma', 'subject' => 'Physics', 'email' => 'priya@school.com', 'phone' => '+91 98765 43223'],
    ['id' => 'TCH1004', 'name' => 'Mr. Vikram Yadav', 'subject' => 'Computer Science', 'email' => 'vikram@school.com', 'phone' => '+91 98765 43224'],
];

$classes_list = [
    ['name' => 'Class 1-A', 'students' => 42, 'teacher' => 'Mrs. Sunita Desai', 'room' => 'R-101'],
    ['name' => 'Class 5-B', 'students' => 38, 'teacher' => 'Mr. Rohan Mehta', 'room' => 'R-205'],
    ['name' => 'Class 9-A', 'students' => 40, 'teacher' => 'Mrs. Anita Verma', 'room' => 'R-301'],
    ['name' => 'Class 10-A', 'students' => 42, 'teacher' => 'Mr. Amit Singh', 'room' => 'R-302'],
    ['name' => 'Class 12-A', 'students' => 40, 'teacher' => 'Mrs. Priya Sharma', 'room' => 'R-401'],
];

$subjects_list = [
    ['name' => 'English', 'classes' => '1-12', 'teacher' => 'Mrs. Anita Verma'],
    ['name' => 'Mathematics', 'classes' => '1-12', 'teacher' => 'Mr. Amit Singh'],
    ['name' => 'Science', 'classes' => '6-10', 'teacher' => 'Mrs. Priya Sharma'],
    ['name' => 'Computer Science', 'classes' => '6-12', 'teacher' => 'Mr. Vikram Yadav'],
    ['name' => 'Hindi', 'classes' => '1-10', 'teacher' => 'Mrs. Kavita Joshi'],
];

$admission_requests = [
    ['id' => 'SPS20251000', 'name' => 'Ananya Sharma', 'class' => 'Class 1', 'parent' => 'Mr. Vikas Sharma', 'phone' => '+91 98765 43211', 'date' => '15 Jan'],
    ['id' => 'SPS20251001', 'name' => 'Rohan Mehta', 'class' => 'Class 6', 'parent' => 'Mrs. Reena Mehta', 'phone' => '+91 98765 43212', 'date' => '15 Jan'],
    ['id' => 'SPS20251002', 'name' => 'Kavya Patel', 'class' => 'Class 9', 'parent' => 'Mr. Ajay Patel', 'phone' => '+91 98765 43213', 'date' => '14 Jan'],
    ['id' => 'SPS20251003', 'name' => 'Aryan Singh', 'class' => 'Class 11', 'parent' => 'Dr. Rajiv Singh', 'phone' => '+91 98765 43214', 'date' => '14 Jan'],
];

$approved_list = [
    ['id' => 'SPS20249980', 'name' => 'Diya Kapoor', 'class' => 'Class 3', 'date' => '12 Jan'],
    ['id' => 'SPS20249981', 'name' => 'Arnav Joshi', 'class' => 'Class 7', 'date' => '11 Jan'],
    ['id' => 'SPS20249982', 'name' => 'Riya Chawla', 'class' => 'Class 10', 'date' => '10 Jan'],
];

$pending_fees = [
    ['student' => 'Vivek Reddy', 'class' => '8-A', 'amount' => 22000, 'days' => 45],
    ['student' => 'Shreya Nair', 'class' => '11-B', 'amount' => 18000, 'days' => 30],
    ['student' => 'Karan Malhotra', 'class' => '6-C', 'amount' => 12000, 'days' => 25],
    ['student' => 'Ishita Bose', 'class' => '7-A', 'amount' => 15000, 'days' => 15],
];

$payments_history = [
    ['txn' => 'TXN2025011501', 'student' => 'Aarav Sharma', 'amount' => 15000, 'method' => 'UPI', 'date' => '15 Jan'],
    ['txn' => 'TXN2025011502', 'student' => 'Priya Verma', 'amount' => 12000, 'method' => 'Card', 'date' => '15 Jan'],
    ['txn' => 'TXN2025011401', 'student' => 'Rohan Kumar', 'amount' => 18000, 'method' => 'Net Banking', 'date' => '14 Jan'],
    ['txn' => 'TXN2025011402', 'student' => 'Ananya Singh', 'amount' => 15000, 'method' => 'Cash', 'date' => '14 Jan'],
];

$notices_list = [
    ['title' => 'Half Yearly Exam Schedule Released', 'date' => '10 Jan', 'views' => 245, 'type' => 'exam'],
    ['title' => 'Annual Sports Day - 25th Dec', 'date' => '08 Jan', 'views' => 189, 'type' => 'event'],
    ['title' => 'PTM on 10th February', 'date' => '05 Jan', 'views' => 156, 'type' => 'general'],
];

$gallery_list = [
    ['name' => 'Annual Day 2024', 'photos' => 45, 'date' => '15 Dec'],
    ['name' => 'Sports Day', 'photos' => 32, 'date' => '25 Nov'],
    ['name' => 'Science Exhibition', 'photos' => 28, 'date' => '10 Nov'],
    ['name' => 'Cultural Fest', 'photos' => 56, 'date' => '22 Oct'],
];

$activities = [
    ['text' => 'New admission request from Ananya Sharma', 'time' => '5 min ago', 'icon' => '📝', 'color' => 'blue'],
    ['text' => 'Fee payment received: ₹15,000 from Aarav Sharma', 'time' => '20 min ago', 'icon' => '💰', 'color' => 'green'],
    ['text' => 'New notice published: Exam Schedule', 'time' => '1 hour ago', 'icon' => '📢', 'color' => 'orange'],
    ['text' => 'Teacher Mrs. Priya Sharma uploaded homework', 'time' => '2 hours ago', 'icon' => '📚', 'color' => 'purple'],
    ['text' => 'Admission approved: Diya Kapoor', 'time' => '3 hours ago', 'icon' => '✅', 'color' => 'green'],
];

$fee_chart = [
    ['month' => 'Aug', 'amount' => 950000],
    ['month' => 'Sep', 'amount' => 1100000],
    ['month' => 'Oct', 'amount' => 1050000],
    ['month' => 'Nov', 'amount' => 1200000],
    ['month' => 'Dec', 'amount' => 1150000],
    ['month' => 'Jan', 'amount' => 1250000],
];
$max_amount = max(array_column($fee_chart, 'amount'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace('-', ' ', $page)); ?> | Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

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
            --pink: #ec4899;
        }

        body {
            background: #f1f5f9;
            color: var(--dark);
            line-height: 1.6;
            font-size: 14px;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; transition: all 0.3s ease; }
        ul { list-style: none; }

        /* TOPBAR */
        .topbar {
            background: var(--white);
            padding: 12px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            gap: 15px;
        }
        .topbar-left { display: flex; align-items: center; gap: 15px; }
        .menu-toggle {
            display: none;
            background: none; border: none;
            font-size: 22px; color: var(--primary);
            cursor: pointer; padding: 5px;
        }
        .topbar-logo { display: flex; align-items: center; gap: 10px; }
        .topbar-logo .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: var(--white);
        }
        .topbar-logo h2 { font-size: 17px; color: var(--primary); font-weight: 700; line-height: 1; }
        .topbar-logo span { font-size: 10px; color: var(--gray); letter-spacing: 1px; }

        .topbar-search { position: relative; width: 280px; }
        .topbar-search input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            transition: all 0.3s ease;
        }
        .topbar-search input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
        }
        .topbar-search i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray); font-size: 13px;
        }

        .topbar-right { display: flex; align-items: center; gap: 15px; }
        .notification-btn {
            position: relative;
            width: 42px; height: 42px;
            border-radius: 50%;
            background: var(--light);
            border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--primary);
            transition: all 0.3s ease;
        }
        .notification-btn:hover { background: var(--primary); color: var(--white); }
        .notification-btn .badge {
            position: absolute; top: 5px; right: 5px;
            width: 18px; height: 18px;
            background: var(--red); color: var(--white);
            border-radius: 50%; font-size: 10px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid var(--white);
        }

        .user-menu {
            display: flex; align-items: center; gap: 10px;
            padding: 5px 12px 5px 5px;
            background: var(--light);
            border-radius: 50px;
            cursor: pointer;
        }
        .user-menu:hover { background: #e2e8f0; }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px;
            border: 2px solid var(--secondary);
        }
        .user-menu-info h4 { font-size: 13px; font-weight: 700; color: var(--primary); line-height: 1; }
        .user-menu-info span { font-size: 11px; color: var(--gray); }

        /* LAYOUT */
        .dashboard-layout { display: flex; min-height: calc(100vh - 66px); }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1f2937, #111827);
            color: var(--white);
            padding: 25px 0;
            position: sticky;
            top: 66px;
            height: calc(100vh - 66px);
            overflow-y: auto;
            flex-shrink: 0;
            transition: transform 0.4s ease;
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 5px; }

        .sidebar-profile {
            padding: 0 25px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 30px; font-weight: 800;
            margin: 0 auto 12px;
            border: 4px solid var(--secondary);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .sidebar-profile h3 { font-size: 15px; font-weight: 700; margin-bottom: 3px; }
        .sidebar-profile p { font-size: 11px; color: var(--secondary); font-weight: 600; }

        .sidebar-menu { padding: 0 15px; }
        .menu-label {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 15px 8px;
            font-weight: 600;
        }

        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 15px;
            border-radius: 10px;
            color: rgba(255,255,255,0.75);
            font-size: 14px; font-weight: 500;
            margin-bottom: 4px;
            transition: all 0.3s ease;
        }
        .sidebar-menu a i { width: 22px; text-align: center; font-size: 15px; }
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.08);
            color: var(--white);
            transform: translateX(5px);
        }
        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.4);
        }
        .sidebar-menu a .nav-badge {
            margin-left: auto;
            background: var(--red); color: var(--white);
            padding: 2px 8px; border-radius: 10px;
            font-size: 10px; font-weight: 700;
        }
        .sidebar-menu a.logout {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            margin-top: 15px;
        }
        .sidebar-menu a.logout:hover { background: var(--red); color: var(--white); }

        /* MAIN CONTENT */
        .main-content { flex: 1; padding: 25px 30px; overflow-x: hidden; min-width: 0; }

        .page-header {
            display: flex; justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap; gap: 15px;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; color: var(--dark); }
        .page-header h1 span { color: var(--primary); }
        .page-header p { font-size: 13px; color: var(--gray); margin-top: 3px; }

        .page-actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .page-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 20px;
            background: var(--white);
            color: var(--primary);
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .page-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        .page-btn.primary {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }
        .page-btn.primary:hover {
            background: var(--secondary);
            border-color: var(--secondary);
        }

        /* ALERT */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert.success {
            background: #d1fae5; color: #065f46;
            border-left: 5px solid var(--green);
        }
        .alert.error {
            background: #fee2e2; color: #991b1b;
            border-left: 5px solid var(--red);
        }

        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: var(--white);
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
        }
        .stat-card.blue::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
        .stat-card.green::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card.orange::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
        .stat-card.red::before { background: linear-gradient(90deg, #ef4444, #dc2626); }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .stat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: var(--white);
        }
        .stat-card.blue .stat-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .stat-card.green .stat-icon { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-card.orange .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-card.purple .stat-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .stat-card.red .stat-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .stat-trend {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .stat-trend.up { background: #d1fae5; color: #065f46; }
        .stat-card h3 { font-size: 28px; font-weight: 800; color: var(--dark); line-height: 1.1; margin-bottom: 5px; }
        .stat-card > p { font-size: 13px; color: var(--gray); font-weight: 500; }

        /* CONTENT GRIDS */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 22px; margin-bottom: 22px; }
        .content-grid-full { display: grid; grid-template-columns: 1fr; gap: 22px; margin-bottom: 22px; }

        .content-card {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.04);
        }
        .card-header {
            display: flex; justify-content: space-between;
            align-items: center;
            margin-bottom: 20px; padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
            gap: 15px; flex-wrap: wrap;
        }
        .card-header h3 {
            font-size: 16px; color: var(--dark); font-weight: 700;
            display: flex; align-items: center; gap: 10px;
        }
        .card-header h3 i {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .card-header a {
            font-size: 13px; color: var(--secondary);
            font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
        }

        /* CHART */
        .chart-container {
            display: flex; align-items: flex-end; justify-content: space-between;
            gap: 12px; height: 220px; padding: 20px 0;
            border-bottom: 2px solid var(--border);
        }
        .chart-bar-wrapper { flex: 1; display: flex; flex-direction: column; align-items: center; height: 100%; justify-content: flex-end; }
        .chart-bar {
            width: 100%; max-width: 45px;
            background: linear-gradient(180deg, var(--primary), var(--primary-light));
            border-radius: 8px 8px 0 0;
            transition: all 0.5s ease;
            position: relative; min-height: 10px;
        }
        .chart-bar:hover { background: linear-gradient(180deg, var(--secondary), var(--secondary-dark)); }
        .chart-bar::after {
            content: attr(data-value);
            position: absolute; top: -28px; left: 50%;
            transform: translateX(-50%);
            background: var(--dark); color: var(--white);
            padding: 3px 8px; border-radius: 5px;
            font-size: 10px; font-weight: 700;
            white-space: nowrap;
            opacity: 0; transition: opacity 0.3s;
        }
        .chart-bar:hover::after { opacity: 1; }
        .chart-label { margin-top: 10px; font-size: 12px; color: var(--gray); font-weight: 600; }

        /* QUICK ACTIONS */
        .quick-actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .quick-action-card {
            padding: 20px 15px;
            background: var(--light);
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .quick-action-card:hover {
            background: var(--white);
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.15);
        }
        .quick-action-card i { font-size: 26px; color: var(--primary); margin-bottom: 10px; display: block; }
        .quick-action-card h4 { font-size: 13px; color: var(--dark); font-weight: 600; }

        /* TABLE */
        .table-wrapper { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .data-table thead th {
            background: var(--light);
            padding: 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table thead th:first-child { border-radius: 8px 0 0 8px; }
        .data-table thead th:last-child { border-radius: 0 8px 8px 0; }
        .data-table tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: var(--light); }

        .student-cell { display: flex; flex-direction: column; gap: 3px; }
        .student-cell strong { font-weight: 700; color: var(--dark); font-size: 13px; }
        .student-cell small { font-size: 11px; color: var(--gray); }

        .action-buttons { display: flex; gap: 6px; flex-wrap: wrap; }
        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 4px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .action-btn.approve { background: #d1fae5; color: #065f46; }
        .action-btn.approve:hover { background: var(--green); color: var(--white); transform: translateY(-2px); }
        .action-btn.reject { background: #fee2e2; color: #991b1b; }
        .action-btn.reject:hover { background: var(--red); color: var(--white); transform: translateY(-2px); }
        .action-btn.view { background: #dbeafe; color: #1e40af; }
        .action-btn.view:hover { background: var(--blue); color: var(--white); transform: translateY(-2px); }

        /* FORM */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-group label .req { color: var(--red); }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 13px 16px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--dark);
            transition: all 0.3s ease;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-submit { margin-top: 25px; grid-column: 1 / -1; }
        .form-submit button {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 10px;
        }
        .form-submit button:hover {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.4);
        }

        /* PENDING FEE ITEM */
        .pending-fee-item {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 15px;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            border-left: 3px solid var(--red);
        }
        .pending-fee-item:hover { background: #fef2f2; transform: translateX(5px); }
        .pending-fee-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red), #dc2626);
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }
        .pending-fee-info { flex: 1; min-width: 0; }
        .pending-fee-info h4 { font-size: 13px; color: var(--dark); font-weight: 700; margin-bottom: 2px; }
        .pending-fee-info p { font-size: 11px; color: var(--gray); }
        .pending-fee-amount { text-align: right; }
        .pending-fee-amount h4 { font-size: 14px; font-weight: 800; color: var(--red); }
        .pending-fee-amount p { font-size: 10px; color: var(--gray); font-weight: 600; }

        /* ACTIVITY */
        .activity-item {
            display: flex; gap: 12px;
            padding: 12px 14px;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 10px;
            align-items: center;
            transition: all 0.3s ease;
        }
        .activity-item:hover { background: #f1f5f9; transform: translateX(4px); }
        .activity-icon {
            width: 42px; height: 42px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
            background: var(--white);
        }
        .activity-icon.green { background: #d1fae5; }
        .activity-icon.blue { background: #dbeafe; }
        .activity-icon.purple { background: #e9d5ff; }
        .activity-icon.orange { background: #fed7aa; }
        .activity-content { flex: 1; min-width: 0; }
        .activity-content h4 { font-size: 13px; color: var(--dark); font-weight: 600; margin-bottom: 3px; line-height: 1.4; }
        .activity-content span { font-size: 11px; color: var(--gray); }

        /* SIDEBAR OVERLAY */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 99;
        }
        .sidebar-overlay.active { display: block; }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1100px) {
            .content-grid { grid-template-columns: 1fr; }
            .topbar-search { display: none; }
        }
        @media (max-width: 992px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .sidebar {
                position: fixed; top: 66px; left: 0;
                transform: translateX(-100%);
                z-index: 100; width: 280px;
            }
            .sidebar.active { transform: translateX(0); }
            .main-content { padding: 20px 18px; }
            .topbar { padding: 12px 18px; }
            .topbar-logo h2 { font-size: 15px; }
            .topbar-logo span { font-size: 9px; }
            .user-menu-info { display: none; }
            .user-menu { padding: 5px; }
            .page-header h1 { font-size: 20px; }
            .page-actions { width: 100%; }
            .page-btn { flex: 1; justify-content: center; padding: 10px 15px; font-size: 12px; }
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .stat-card { padding: 16px 14px; }
            .stat-icon { width: 40px; height: 40px; font-size: 16px; }
            .stat-card h3 { font-size: 20px; }
            .content-card { padding: 20px 18px; }
            .card-header h3 { font-size: 14px; }
            .card-header h3 i { width: 32px; height: 32px; font-size: 12px; }
            .data-table { font-size: 12px; }
            .data-table thead th, .data-table tbody td { padding: 10px 8px; }
            .action-buttons { flex-direction: column; }
            .action-btn { padding: 5px 8px; font-size: 10px; }
            .chart-container { height: 180px; }
            .quick-actions-grid { grid-template-columns: 1fr 1fr; }
            .form-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-header h1 { font-size: 18px; }
            .chart-container { gap: 6px; height: 160px; }
            .chart-label { font-size: 10px; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="topbar-logo">
            <div class="logo-icon">🎓</div>
            <div>
                <h2>Sunrise</h2>
                <span>ADMIN PANEL</span>
            </div>
        </div>
    </div>

    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search students, teachers...">
    </div>

    <div class="topbar-right">
        <button class="notification-btn" onclick="alert('5 new notifications')">
            <i class="fas fa-bell"></i>
            <span class="badge">5</span>
        </button>

        <div class="user-menu">
            <div class="user-avatar"><?php echo strtoupper(substr($admin_name, 0, 1)); ?></div>
            <div class="user-menu-info">
                <h4><?php echo htmlspecialchars($admin_name); ?></h4>
                <span>Administrator</span>
            </div>
        </div>
    </div>
</div>


<!-- LAYOUT -->
<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-profile">
            <div class="sidebar-avatar"><?php echo strtoupper(substr($admin_name, 0, 1)); ?></div>
            <h3><?php echo htmlspecialchars($admin_name); ?></h3>
            <p>ADMINISTRATOR</p>
        </div>

        <nav class="sidebar-menu">

            <div class="menu-label">Dashboard</div>
            <a href="admin.php?page=overview" class="<?php echo $page === 'overview' ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Overview
            </a>
            <a href="admin.php?page=analytics" class="<?php echo $page === 'analytics' ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i> Analytics
            </a>

            <div class="menu-label">Management</div>
            <a href="admin.php?page=students" class="<?php echo $page === 'students' ? 'active' : ''; ?>">
                <i class="fas fa-user-graduate"></i> Students
                <span class="nav-badge"><?php echo count($students_list); ?></span>
            </a>
            <a href="admin.php?page=teachers" class="<?php echo $page === 'teachers' ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard-teacher"></i> Teachers
                <span class="nav-badge"><?php echo count($teachers_list); ?></span>
            </a>
            <a href="admin.php?page=classes" class="<?php echo $page === 'classes' ? 'active' : ''; ?>">
                <i class="fas fa-school"></i> Classes
            </a>
            <a href="admin.php?page=subjects" class="<?php echo $page === 'subjects' ? 'active' : ''; ?>">
                <i class="fas fa-book"></i> Subjects
            </a>

            <div class="menu-label">Admissions</div>
            <a href="admin.php?page=admissions" class="<?php echo $page === 'admissions' ? 'active' : ''; ?>">
                <i class="fas fa-file-alt"></i> Applications
                <span class="nav-badge"><?php echo count($admission_requests); ?></span>
            </a>
            <a href="admin.php?page=approved" class="<?php echo $page === 'approved' ? 'active' : ''; ?>">
                <i class="fas fa-check-circle"></i> Approved
            </a>

            <div class="menu-label">Finance</div>
            <a href="admin.php?page=fees" class="<?php echo $page === 'fees' ? 'active' : ''; ?>">
                <i class="fas fa-rupee-sign"></i> Fee Management
            </a>
            <a href="admin.php?page=payments" class="<?php echo $page === 'payments' ? 'active' : ''; ?>">
                <i class="fas fa-credit-card"></i> Payments
            </a>

            <div class="menu-label">Content</div>
            <a href="admin.php?page=notices" class="<?php echo $page === 'notices' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i> Notices
            </a>
            <a href="admin.php?page=gallery" class="<?php echo $page === 'gallery' ? 'active' : ''; ?>">
                <i class="fas fa-images"></i> Gallery
            </a>

            <div class="menu-label">System</div>
            <a href="admin.php?page=reports" class="<?php echo $page === 'reports' ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
            <a href="admin.php?page=settings" class="<?php echo $page === 'settings' ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i> Settings
            </a>

            <a href="?logout=1" class="logout" onclick="return confirm('Are you sure you want to logout?');">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <?php if (!empty($action_msg)): ?>
            <div class="alert <?php echo $action_type; ?>">
                <i class="fas fa-<?php echo $action_type === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <div><?php echo $action_msg; ?></div>
            </div>
        <?php endif; ?>

        <?php if ($page === 'overview'): ?>
        <!-- ================================================
             OVERVIEW PAGE
             ================================================ -->
        <div class="page-header">
            <div>
                <h1>Welcome, <span><?php echo explode(' ', $admin_name)[0]; ?></span>! 👋</h1>
                <p>Here's your complete school overview for today</p>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=add-student" class="page-btn">
                    <i class="fas fa-user-plus"></i> Add Student
                </a>
                <a href="admin.php?page=publish-notice" class="page-btn primary">
                    <i class="fas fa-plus"></i> Publish Notice
                </a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 12%</span>
                </div>
                <h3><?php echo number_format($stats['total_students']); ?></h3>
                <p>Total Students</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 5%</span>
                </div>
                <h3><?php echo number_format($stats['total_teachers']); ?></h3>
                <p>Total Teachers</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 8.5%</span>
                </div>
                <h3>₹<?php echo number_format($stats['monthly_revenue'] / 100000, 1); ?>L</h3>
                <p>Monthly Revenue</p>
            </div>
            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-school"></i></div>
                </div>
                <h3><?php echo $stats['total_classes']; ?></h3>
                <p>Total Classes</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card red">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                </div>
                <h3><?php echo $stats['pending_admissions']; ?></h3>
                <p>Pending Admissions</p>
            </div>
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                </div>
                <h3><?php echo $stats['pending_fees']; ?></h3>
                <p>Pending Fees</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                    <span class="stat-trend up">New</span>
                </div>
                <h3>42</h3>
                <p>New This Month</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-percentage"></i></div>
                    <span class="stat-trend up"><i class="fas fa-arrow-up"></i> 2.3%</span>
                </div>
                <h3>92.5%</h3>
                <p>Attendance Today</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-bar"></i> Monthly Fee Collection</h3>
                    <a href="admin.php?page=reports">
                        View Report <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="chart-container">
                    <?php foreach ($fee_chart as $bar): 
                        $h = ($bar['amount'] / $max_amount) * 100;
                    ?>
                    <div class="chart-bar-wrapper">
                        <div class="chart-bar" style="height: <?php echo $h; ?>%;" data-value="₹<?php echo number_format($bar['amount'] / 100000, 1); ?>L"></div>
                        <div class="chart-label"><?php echo $bar['month']; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="admin.php?page=add-student" class="quick-action-card">
                        <i class="fas fa-user-plus"></i>
                        <h4>Add Student</h4>
                    </a>
                    <a href="admin.php?page=add-teacher" class="quick-action-card">
                        <i class="fas fa-user-tie"></i>
                        <h4>Add Teacher</h4>
                    </a>
                    <a href="admin.php?page=publish-notice" class="quick-action-card">
                        <i class="fas fa-bullhorn"></i>
                        <h4>Publish Notice</h4>
                    </a>
                    <a href="admin.php?page=collect-fee" class="quick-action-card">
                        <i class="fas fa-rupee-sign"></i>
                        <h4>Collect Fee</h4>
                    </a>
                    <a href="admin.php?page=reports" class="quick-action-card">
                        <i class="fas fa-file-alt"></i>
                        <h4>Reports</h4>
                    </a>
                    <a href="admin.php?page=settings" class="quick-action-card">
                        <i class="fas fa-cog"></i>
                        <h4>Settings</h4>
                    </a>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-file-alt"></i> Pending Admission Requests</h3>
                    <a href="admin.php?page=admissions">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr><th>Student</th><th>Class</th><th>Parent</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admission_requests as $req): ?>
                            <tr>
                                <td><div class="student-cell"><strong><?php echo $req['name']; ?></strong><small>ID: <?php echo $req['id']; ?></small></div></td>
                                <td><strong><?php echo $req['class']; ?></strong></td>
                                <td><div class="student-cell"><strong><?php echo $req['parent']; ?></strong><small><?php echo $req['phone']; ?></small></div></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn approve" onclick="approveAdmission(this, '<?php echo $req['name']; ?>')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button class="action-btn reject" onclick="rejectAdmission(this, '<?php echo $req['name']; ?>')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-exclamation-triangle"></i> Pending Fees</h3>
                    <a href="admin.php?page=fees">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <?php foreach ($pending_fees as $fee): ?>
                <div class="pending-fee-item">
                    <div class="pending-fee-icon"><i class="fas fa-rupee-sign"></i></div>
                    <div class="pending-fee-info">
                        <h4><?php echo $fee['student']; ?></h4>
                        <p><?php echo $fee['class']; ?> • Overdue <?php echo $fee['days']; ?> days</p>
                    </div>
                    <div class="pending-fee-amount">
                        <h4>₹<?php echo number_format($fee['amount']); ?></h4>
                        <p>Pending</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-grid-full">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> Recent Activity</h3>
                </div>
                <?php foreach ($activities as $a): ?>
                <div class="activity-item">
                    <div class="activity-icon <?php echo $a['color']; ?>"><?php echo $a['icon']; ?></div>
                    <div class="activity-content">
                        <h4><?php echo $a['text']; ?></h4>
                        <span><i class="fas fa-clock"></i> <?php echo $a['time']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ($page === 'students'): ?>
        <!-- STUDENTS PAGE -->
        <div class="page-header">
            <div>
                <h1>All <span>Students</span></h1>
                <p>Total <?php echo count($students_list); ?> students registered</p>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=add-student" class="page-btn primary">
                    <i class="fas fa-user-plus"></i> Add Student
                </a>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Student ID</th><th>Name</th><th>Class</th><th>Roll No</th><th>Phone</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students_list as $s): ?>
                        <tr>
                            <td><strong><?php echo $s['id']; ?></strong></td>
                            <td><?php echo $s['name']; ?></td>
                            <td><?php echo $s['class']; ?></td>
                            <td><?php echo $s['roll']; ?></td>
                            <td><?php echo $s['phone']; ?></td>
                            <td>
                                <button class="action-btn view" onclick="alert('View <?php echo $s['name']; ?>')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'add-student'): ?>
        <!-- ADD STUDENT PAGE -->
        <div class="page-header">
            <div>
                <h1>Add New <span>Student</span></h1>
                <p>Fill the form to register a new student</p>
            </div>
            <a href="admin.php?page=students" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="add_student">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Student Name <span class="req">*</span></label>
                        <input type="text" name="student_name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label>Class <span class="req">*</span></label>
                        <select name="class" required>
                            <option value="">Select Class</option>
                            <option>Class 1-A</option>
                            <option>Class 5-B</option>
                            <option>Class 9-A</option>
                            <option>Class 10-A</option>
                            <option>Class 12-A</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Parent Name <span class="req">*</span></label>
                        <input type="text" name="parent_name" placeholder="Parent's full name" required>
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="req">*</span></label>
                        <input type="tel" name="phone" placeholder="10-digit mobile" required>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-user-plus"></i> Add Student
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'teachers'): ?>
        <!-- TEACHERS PAGE -->
        <div class="page-header">
            <div>
                <h1>All <span>Teachers</span></h1>
                <p>Total <?php echo count($teachers_list); ?> teachers</p>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=add-teacher" class="page-btn primary">
                    <i class="fas fa-user-plus"></i> Add Teacher
                </a>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Subject</th><th>Email</th><th>Phone</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers_list as $t): ?>
                        <tr>
                            <td><strong><?php echo $t['id']; ?></strong></td>
                            <td><?php echo $t['name']; ?></td>
                            <td><?php echo $t['subject']; ?></td>
                            <td><?php echo $t['email']; ?></td>
                            <td><?php echo $t['phone']; ?></td>
                            <td>
                                <button class="action-btn view" onclick="alert('View <?php echo $t['name']; ?>')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'add-teacher'): ?>
        <!-- ADD TEACHER PAGE -->
        <div class="page-header">
            <div>
                <h1>Add New <span>Teacher</span></h1>
                <p>Register a new teacher</p>
            </div>
            <a href="admin.php?page=teachers" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="add_teacher">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Teacher Name <span class="req">*</span></label>
                        <input type="text" name="teacher_name" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <label>Subject <span class="req">*</span></label>
                        <select name="subject" required>
                            <option value="">Select Subject</option>
                            <option>English</option>
                            <option>Mathematics</option>
                            <option>Science</option>
                            <option>Computer Science</option>
                            <option>Hindi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="req">*</span></label>
                        <input type="email" name="email" placeholder="teacher@school.com" required>
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="req">*</span></label>
                        <input type="tel" name="phone" placeholder="10-digit mobile" required>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-user-plus"></i> Add Teacher
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'classes'): ?>
        <!-- CLASSES PAGE -->
        <div class="page-header">
            <div>
                <h1>All <span>Classes</span></h1>
                <p>Manage all classes</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Class</th><th>Students</th><th>Class Teacher</th><th>Room</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes_list as $c): ?>
                        <tr>
                            <td><strong><?php echo $c['name']; ?></strong></td>
                            <td><?php echo $c['students']; ?></td>
                            <td><?php echo $c['teacher']; ?></td>
                            <td><?php echo $c['room']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'subjects'): ?>
        <!-- SUBJECTS PAGE -->
        <div class="page-header">
            <div>
                <h1>All <span>Subjects</span></h1>
                <p>Manage subjects</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Subject</th><th>Classes</th><th>Teacher</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects_list as $s): ?>
                        <tr>
                            <td><strong><?php echo $s['name']; ?></strong></td>
                            <td><?php echo $s['classes']; ?></td>
                            <td><?php echo $s['teacher']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'admissions'): ?>
        <!-- ADMISSIONS PAGE -->
        <div class="page-header">
            <div>
                <h1>Admission <span>Applications</span></h1>
                <p><?php echo count($admission_requests); ?> pending requests</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Student</th><th>Class</th><th>Parent</th><th>Phone</th><th>Date</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admission_requests as $req): ?>
                        <tr>
                            <td><strong><?php echo $req['id']; ?></strong></td>
                            <td><?php echo $req['name']; ?></td>
                            <td><?php echo $req['class']; ?></td>
                            <td><?php echo $req['parent']; ?></td>
                            <td><?php echo $req['phone']; ?></td>
                            <td><?php echo $req['date']; ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn approve" onclick="approveAdmission(this, '<?php echo $req['name']; ?>')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn reject" onclick="rejectAdmission(this, '<?php echo $req['name']; ?>')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'approved'): ?>
        <!-- APPROVED PAGE -->
        <div class="page-header">
            <div>
                <h1>Approved <span>Admissions</span></h1>
                <p><?php echo count($approved_list); ?> students approved</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Class</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($approved_list as $a): ?>
                        <tr>
                            <td><strong><?php echo $a['id']; ?></strong></td>
                            <td><?php echo $a['name']; ?></td>
                            <td><?php echo $a['class']; ?></td>
                            <td><?php echo $a['date']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'fees'): ?>
        <!-- FEES PAGE -->
        <div class="page-header">
            <div>
                <h1>Fee <span>Management</span></h1>
                <p>Pending fees overview</p>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=collect-fee" class="page-btn primary">
                    <i class="fas fa-rupee-sign"></i> Collect Fee
                </a>
            </div>
        </div>
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Pending Fees</h3>
            </div>
            <?php foreach ($pending_fees as $fee): ?>
            <div class="pending-fee-item">
                <div class="pending-fee-icon"><i class="fas fa-rupee-sign"></i></div>
                <div class="pending-fee-info">
                    <h4><?php echo $fee['student']; ?></h4>
                    <p><?php echo $fee['class']; ?> • Overdue <?php echo $fee['days']; ?> days</p>
                </div>
                <div class="pending-fee-amount">
                    <h4>₹<?php echo number_format($fee['amount']); ?></h4>
                    <p>Pending</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($page === 'collect-fee'): ?>
        <!-- COLLECT FEE PAGE -->
        <div class="page-header">
            <div>
                <h1>Collect <span>Fee</span></h1>
                <p>Record a fee payment</p>
            </div>
            <a href="admin.php?page=fees" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="collect_fee">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Student Name <span class="req">*</span></label>
                        <input type="text" name="student" placeholder="Enter student name" required>
                    </div>
                    <div class="form-group">
                        <label>Amount (₹) <span class="req">*</span></label>
                        <input type="number" name="amount" placeholder="Enter amount" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Payment Method <span class="req">*</span></label>
                        <select name="method" required>
                            <option value="">Select Method</option>
                            <option>UPI</option>
                            <option>Card</option>
                            <option>Net Banking</option>
                            <option>Cash</option>
                        </select>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-rupee-sign"></i> Collect Fee
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'payments'): ?>
        <!-- PAYMENTS PAGE -->
        <div class="page-header">
            <div>
                <h1>Payment <span>History</span></h1>
                <p>All recent payments</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Transaction ID</th><th>Student</th><th>Amount</th><th>Method</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments_history as $p): ?>
                        <tr>
                            <td><strong><?php echo $p['txn']; ?></strong></td>
                            <td><?php echo $p['student']; ?></td>
                            <td><strong style="color: var(--green);">₹<?php echo number_format($p['amount']); ?></strong></td>
                            <td><?php echo $p['method']; ?></td>
                            <td><?php echo $p['date']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'notices'): ?>
        <!-- NOTICES PAGE -->
        <div class="page-header">
            <div>
                <h1>Manage <span>Notices</span></h1>
                <p>All published notices</p>
            </div>
            <div class="page-actions">
                <a href="admin.php?page=publish-notice" class="page-btn primary">
                    <i class="fas fa-plus"></i> New Notice
                </a>
            </div>
        </div>
        <div class="content-card">
            <?php foreach ($notices_list as $n): ?>
            <div class="activity-item">
                <div class="activity-icon <?php echo $n['type'] === 'exam' ? 'orange' : ($n['type'] === 'event' ? 'green' : 'blue'); ?>">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="activity-content">
                    <h4><?php echo $n['title']; ?></h4>
                    <span><i class="fas fa-calendar"></i> <?php echo $n['date']; ?> • <i class="fas fa-eye"></i> <?php echo $n['views']; ?> views</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($page === 'publish-notice'): ?>
        <!-- PUBLISH NOTICE PAGE -->
        <div class="page-header">
            <div>
                <h1>Publish <span>Notice</span></h1>
                <p>Create a new announcement</p>
            </div>
            <a href="admin.php?page=notices" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="publish_notice">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Notice Title <span class="req">*</span></label>
                        <input type="text" name="notice_title" placeholder="Enter notice title" required>
                    </div>
                    <div class="form-group full">
                        <label>Notice Content <span class="req">*</span></label>
                        <textarea name="notice_content" placeholder="Write the notice details..." required></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-bullhorn"></i> Publish Notice
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'gallery'): ?>
        <!-- GALLERY PAGE -->
        <div class="page-header">
            <div>
                <h1>Manage <span>Gallery</span></h1>
                <p>All photo albums</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Album Name</th><th>Photos</th><th>Date</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gallery_list as $g): ?>
                        <tr>
                            <td><strong><?php echo $g['name']; ?></strong></td>
                            <td><?php echo $g['photos']; ?> photos</td>
                            <td><?php echo $g['date']; ?></td>
                            <td>
                                <button class="action-btn view" onclick="alert('View album: <?php echo $g['name']; ?>')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'analytics'): ?>
        <!-- ANALYTICS PAGE -->
        <div class="page-header">
            <div>
                <h1>School <span>Analytics</span></h1>
                <p>Overview of key metrics</p>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <span class="stat-trend up">+12%</span>
                </div>
                <h3><?php echo number_format($stats['total_students']); ?></h3>
                <p>Students</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="stat-trend up">+5%</span>
                </div>
                <h3><?php echo $stats['total_teachers']; ?></h3>
                <p>Teachers</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
                    <span class="stat-trend up">+18%</span>
                </div>
                <h3>₹<?php echo number_format($stats['monthly_revenue'] / 100000, 1); ?>L</h3>
                <p>Revenue</p>
            </div>
            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-percentage"></i></div>
                    <span class="stat-trend up">+2%</span>
                </div>
                <h3>92.5%</h3>
                <p>Attendance</p>
            </div>
        </div>
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-chart-bar"></i> Fee Collection Trend</h3>
            </div>
            <div class="chart-container">
                <?php foreach ($fee_chart as $bar): 
                    $h = ($bar['amount'] / $max_amount) * 100;
                ?>
                <div class="chart-bar-wrapper">
                    <div class="chart-bar" style="height: <?php echo $h; ?>%;" data-value="₹<?php echo number_format($bar['amount'] / 100000, 1); ?>L"></div>
                    <div class="chart-label"><?php echo $bar['month']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ($page === 'reports'): ?>
        <!-- REPORTS PAGE -->
        <div class="page-header">
            <div>
                <h1>School <span>Reports</span></h1>
                <p>Generate and view reports</p>
            </div>
        </div>
        <div class="content-grid" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="quick-action-card" onclick="alert('Students Report')">
                <i class="fas fa-user-graduate"></i>
                <h4>Students Report</h4>
            </div>
            <div class="quick-action-card" onclick="alert('Teachers Report')">
                <i class="fas fa-chalkboard-teacher"></i>
                <h4>Teachers Report</h4>
            </div>
            <div class="quick-action-card" onclick="alert('Fee Report')">
                <i class="fas fa-rupee-sign"></i>
                <h4>Fee Report</h4>
            </div>
            <div class="quick-action-card" onclick="alert('Attendance Report')">
                <i class="fas fa-calendar-check"></i>
                <h4>Attendance Report</h4>
            </div>
            <div class="quick-action-card" onclick="alert('Exam Report')">
                <i class="fas fa-file-alt"></i>
                <h4>Exam Report</h4>
            </div>
            <div class="quick-action-card" onclick="alert('Admission Report')">
                <i class="fas fa-user-plus"></i>
                <h4>Admission Report</h4>
            </div>
        </div>

        <?php elseif ($page === 'settings'): ?>
        <!-- SETTINGS PAGE -->
        <div class="page-header">
            <div>
                <h1>Account <span>Settings</span></h1>
                <p>Manage your admin profile</p>
            </div>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="update_settings">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="admin_name" value="<?php echo htmlspecialchars($admin_name); ?>">
                    </div>
                    <div class="form-group">
                        <label>Email / Username</label>
                        <input type="text" name="admin_email" value="<?php echo htmlspecialchars($admin_email); ?>" readonly>
                    </div>
                    <div class="form-group full">
                        <label>New Password (leave empty to keep current)</label>
                        <input type="password" name="new_password" placeholder="Enter new password">
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php else: ?>
        <!-- 404 INSIDE ADMIN -->
        <div class="page-header">
            <div>
                <h1>Page <span>Not Found</span></h1>
                <p>The page you're looking for doesn't exist in the admin panel.</p>
            </div>
            <a href="admin.php" class="page-btn primary">
                <i class="fas fa-home"></i> Go to Dashboard
            </a>
        </div>

        <?php endif; ?>

    </main>

</div>


<script>
    // SIDEBAR TOGGLE
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    // APPROVE ADMISSION
    function approveAdmission(btn, name) {
        if (!confirm('Approve admission for ' + name + '?')) return;
        const row = btn.closest('tr');
        row.style.background = '#d1fae5';
        setTimeout(() => {
            row.style.transition = 'opacity 0.5s';
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
                alert('✅ Admission approved for ' + name);
            }, 500);
        }, 300);
    }

    // REJECT ADMISSION
    function rejectAdmission(btn, name) {
        if (!confirm('Reject admission for ' + name + '?')) return;
        const row = btn.closest('tr');
        row.style.background = '#fee2e2';
        setTimeout(() => {
            row.style.transition = 'opacity 0.5s';
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
                alert('❌ Admission rejected for ' + name);
            }, 500);
        }, 300);
    }

    // CHART BAR ANIMATION
    window.addEventListener('load', () => {
        const bars = document.querySelectorAll('.chart-bar');
        bars.forEach((bar, i) => {
            const targetHeight = bar.style.height;
            bar.style.height = '0%';
            setTimeout(() => {
                bar.style.height = targetHeight;
            }, 100 + i * 80);
        });
    });
</script>

</body>
</html>