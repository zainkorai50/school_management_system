<?php
// ============================================
// Sunrise Public School - Parent Dashboard
// Single File - All Pages Inside
// ============================================
session_start();

// ---------- SESSION CHECK ----------
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'parent') {
    header("Location: parent-login.php");
    exit;
}

// ---------- LOGOUT ----------
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$parent_name = $_SESSION['user_name'] ?? 'Zain Parent';
$parent_email = $_SESSION['user_email'] ?? 'zain4';

$page = $_GET['page'] ?? 'overview';

// ---------- ACTION HANDLER ----------
$action_msg = "";
$action_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'contact_teacher') {
        $teacher = trim($_POST['teacher'] ?? '');
        $message = trim($_POST['message'] ?? '');
        if ($teacher && $message) {
            $action_msg = "✅ Message sent to <strong>" . htmlspecialchars($teacher) . "</strong> successfully!";
            $action_type = "success";
        } else {
            $action_msg = "❌ Please fill all fields!";
            $action_type = "error";
        }
    }

    if ($action === 'update_profile') {
        $action_msg = "✅ Profile updated successfully!";
        $action_type = "success";
    }
}

// ---------- DEMO DATA ----------
$child = [
    'name' => 'Aarav Sharma',
    'class' => 'Class 10-A',
    'roll' => '10A01',
    'dob' => '15 Aug 2008',
    'blood' => 'O+',
    'email' => 'aarav@sunriseschool.com',
];

$stats = [
    'attendance' => 93,
    'marks' => 87,
    'pending_homework' => 3,
    'fee_pending' => 15000,
];

$subjects = [
    ['name' => 'English', 'marks' => 87, 'total' => 100, 'grade' => 'A'],
    ['name' => 'Hindi', 'marks' => 82, 'total' => 100, 'grade' => 'A'],
    ['name' => 'Mathematics', 'marks' => 95, 'total' => 100, 'grade' => 'A+'],
    ['name' => 'Science', 'marks' => 89, 'total' => 100, 'grade' => 'A'],
    ['name' => 'Social Science', 'marks' => 78, 'total' => 100, 'grade' => 'B+'],
    ['name' => 'Computer Science', 'marks' => 92, 'total' => 100, 'grade' => 'A+'],
];

$teachers = [
    ['name' => 'Mrs. Anita Verma', 'subject' => 'English', 'phone' => '+91 98765 43211'],
    ['name' => 'Mr. Amit Singh', 'subject' => 'Mathematics', 'phone' => '+91 98765 43212'],
    ['name' => 'Mrs. Priya Sharma', 'subject' => 'Science', 'phone' => '+91 98765 43213'],
];

$homeworks = [
    ['subject' => 'Mathematics', 'task' => 'Complete Chapter 5 exercises', 'due' => 'Tomorrow', 'status' => 'pending', 'priority' => 'high'],
    ['subject' => 'Science', 'task' => 'Write notes on Photosynthesis', 'due' => 'In 2 days', 'status' => 'pending', 'priority' => 'medium'],
    ['subject' => 'English', 'task' => 'Essay writing task', 'due' => 'In 3 days', 'status' => 'in-progress', 'priority' => 'medium'],
];

$notices = [
    ['title' => 'PTM on 10th February', 'date' => '10 Jan', 'type' => 'event'],
    ['title' => 'Half Yearly Result Declared', 'date' => '08 Jan', 'type' => 'exam'],
    ['title' => 'Fee Payment Reminder', 'date' => '05 Jan', 'type' => 'general'],
];

$events = [
    ['title' => 'Parent-Teacher Meeting', 'date' => '10 Feb 2025', 'days' => 29, 'icon' => '👨‍👩‍👧'],
    ['title' => 'Annual Function', 'date' => '15 Feb 2025', 'days' => 34, 'icon' => '🎭'],
    ['title' => 'Sports Day', 'date' => '25 Feb 2025', 'days' => 44, 'icon' => '🏆'],
];

$activities = [
    ['text' => 'Aarav scored 95 in Mathematics test', 'time' => '2 hours ago', 'icon' => '📊', 'color' => 'green'],
    ['text' => 'Homework submitted: English Essay', 'time' => 'Yesterday', 'icon' => '✅', 'color' => 'blue'],
    ['text' => 'Attendance marked present', 'time' => 'Yesterday', 'icon' => '📅', 'color' => 'purple'],
    ['text' => 'Fee installment paid - ₹15,000', 'time' => '3 days ago', 'icon' => '💰', 'color' => 'orange'],
];

$attendance_details = [
    'total_days' => 220,
    'present' => 205,
    'absent' => 15,
    'percentage' => 93.18,
    'this_month_present' => 20,
    'this_month_absent' => 2,
];

$fees = [
    'total' => 45000,
    'paid' => 30000,
    'pending' => 15000,
    'due_date' => '31 Jan 2025',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace('-', ' ', $page)); ?> | Parent Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        :root {
            --primary: #10b981;
            --primary-light: #34d399;
            --primary-dark: #059669;
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
            --teal: #14b8a6;
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
            position: sticky; top: 0; z-index: 100;
            gap: 15px;
        }
        .topbar-left { display: flex; align-items: center; gap: 15px; }
        .menu-toggle {
            display: none; background: none; border: none;
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
            width: 100%; padding: 10px 15px 10px 40px;
            border: 2px solid var(--border); border-radius: 10px;
            font-size: 13px; font-family: 'Poppins', sans-serif;
            background: var(--light); transition: all 0.3s ease;
        }
        .topbar-search input:focus {
            outline: none; border-color: var(--primary); background: var(--white);
        }
        .topbar-search i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: var(--gray); font-size: 13px;
        }

        .topbar-right { display: flex; align-items: center; gap: 15px; }
        .notification-btn {
            position: relative; width: 42px; height: 42px;
            border-radius: 50%; background: var(--light); border: none;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--primary); transition: all 0.3s ease;
        }
        .notification-btn:hover { background: var(--primary); color: var(--white); }
        .notification-btn .badge {
            position: absolute; top: 5px; right: 5px;
            width: 18px; height: 18px; background: var(--red); color: var(--white);
            border-radius: 50%; font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid var(--white);
        }

        .user-menu {
            display: flex; align-items: center; gap: 10px;
            padding: 5px 12px 5px 5px; background: var(--light);
            border-radius: 50px; cursor: pointer;
        }
        .user-menu:hover { background: #e2e8f0; }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white); display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; border: 2px solid var(--secondary);
        }
        .user-menu-info h4 { font-size: 13px; font-weight: 700; color: var(--primary); line-height: 1; }
        .user-menu-info span { font-size: 11px; color: var(--gray); }

        /* LAYOUT */
        .dashboard-layout { display: flex; min-height: calc(100vh - 66px); }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary), var(--primary-dark));
            color: var(--white); padding: 25px 0;
            position: sticky; top: 66px; height: calc(100vh - 66px);
            overflow-y: auto; flex-shrink: 0;
            transition: transform 0.4s ease;
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 5px; }

        .sidebar-profile {
            padding: 0 25px 25px; text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-avatar {
            width: 80px; height: 80px; border-radius: 50%;
            background: rgba(255,255,255,0.15);
            color: var(--white); display: flex; align-items: center; justify-content: center;
            font-size: 30px; font-weight: 800; margin: 0 auto 12px;
            border: 4px solid var(--secondary);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .sidebar-profile h3 { font-size: 15px; font-weight: 700; margin-bottom: 3px; }
        .sidebar-profile p { font-size: 11px; color: var(--secondary); font-weight: 600; }

        .sidebar-menu { padding: 0 15px; }
        .menu-label {
            font-size: 11px; color: rgba(255,255,255,0.4);
            text-transform: uppercase; letter-spacing: 1px;
            padding: 15px 15px 8px; font-weight: 600;
        }

        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 15px; border-radius: 10px;
            color: rgba(255,255,255,0.75); font-size: 14px;
            font-weight: 500; margin-bottom: 4px;
            transition: all 0.3s ease;
        }
        .sidebar-menu a i { width: 22px; text-align: center; font-size: 15px; }
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: var(--white); transform: translateX(5px);
        }
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.2);
            color: var(--white);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .sidebar-menu a .nav-badge {
            margin-left: auto; background: var(--red); color: var(--white);
            padding: 2px 8px; border-radius: 10px;
            font-size: 10px; font-weight: 700;
        }
        .sidebar-menu a.logout {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5; margin-top: 15px;
        }
        .sidebar-menu a.logout:hover { background: var(--red); color: var(--white); }

        /* MAIN */
        .main-content { flex: 1; padding: 25px 30px; overflow-x: hidden; min-width: 0; }

        .page-header {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 25px;
            flex-wrap: wrap; gap: 15px;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; color: var(--dark); }
        .page-header h1 span { color: var(--primary); }
        .page-header p { font-size: 13px; color: var(--gray); margin-top: 3px; }

        .page-actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .page-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 20px; background: var(--white);
            color: var(--primary); border: 2px solid var(--border);
            border-radius: 10px; font-size: 13px; font-weight: 600;
            transition: all 0.3s ease; cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .page-btn:hover {
            background: var(--primary); color: var(--white);
            border-color: var(--primary); transform: translateY(-2px);
        }
        .page-btn.primary {
            background: var(--primary); color: var(--white);
            border-color: var(--primary);
        }
        .page-btn.primary:hover {
            background: var(--secondary); border-color: var(--secondary);
        }

        /* ALERT */
        .alert {
            padding: 16px 20px; border-radius: 12px;
            margin-bottom: 20px; font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 12px;
        }
        .alert.success { background: #d1fae5; color: #065f46; border-left: 5px solid var(--green); }
        .alert.error { background: #fee2e2; color: #991b1b; border-left: 5px solid var(--red); }

        /* CHILD HERO */
        .child-hero {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 25px;
            align-items: center;
        }
        .child-hero::before {
            content: '';
            position: absolute;
            top: -50%; right: -5%;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }
        .child-hero > * { position: relative; z-index: 2; }
        .child-hero-avatar {
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 40px; font-weight: 800;
            border: 5px solid rgba(255,255,255,0.3);
        }
        .child-hero-info h1 { font-size: 26px; font-weight: 800; margin-bottom: 6px; }
        .child-hero-info p { font-size: 14px; opacity: 0.9; margin-bottom: 12px; }
        .child-badges { display: flex; gap: 10px; flex-wrap: wrap; }
        .child-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 6px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 6px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .child-hero-stats { display: flex; gap: 25px; flex-wrap: wrap; }
        .child-hero-stat { text-align: center; }
        .child-hero-stat h3 {
            font-size: 28px; font-weight: 800;
            color: #fef3c7; line-height: 1; margin-bottom: 4px;
        }
        .child-hero-stat p { font-size: 11px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px; }

        /* STATS */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 18px; margin-bottom: 25px;
        }
        .stat-card {
            background: var(--white); padding: 22px;
            border-radius: 15px; box-shadow: 0 3px 15px rgba(0,0,0,0.04);
            transition: all 0.3s ease; position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute; top: 0; left: 0;
            width: 100%; height: 4px;
        }
        .stat-card.blue::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
        .stat-card.green::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card.orange::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card.red::before { background: linear-gradient(90deg, #ef4444, #dc2626); }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }
        .stat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: var(--white);
        }
        .stat-card.blue .stat-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .stat-card.green .stat-icon { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-card.orange .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-card.red .stat-icon { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .stat-card h3 { font-size: 28px; font-weight: 800; color: var(--dark); line-height: 1.1; margin-bottom: 5px; }
        .stat-card > p { font-size: 13px; color: var(--gray); font-weight: 500; }

        /* CONTENT GRIDS */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 22px; margin-bottom: 22px; }
        .content-grid-full { display: grid; grid-template-columns: 1fr; gap: 22px; margin-bottom: 22px; }

        .content-card {
            background: var(--white); border-radius: 15px;
            padding: 25px; box-shadow: 0 3px 15px rgba(0,0,0,0.04);
        }
        .card-header {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 20px;
            padding-bottom: 15px; border-bottom: 1px solid var(--border);
            gap: 15px; flex-wrap: wrap;
        }
        .card-header h3 {
            font-size: 16px; color: var(--dark); font-weight: 700;
            display: flex; align-items: center; gap: 10px;
        }
        .card-header h3 i {
            width: 36px; height: 36px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white); display: inline-flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .card-header a {
            font-size: 13px; color: var(--secondary); font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
        }

        /* TABLE */
        .table-wrapper { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .data-table thead th {
            background: var(--light); padding: 12px;
            text-align: left; font-size: 11px;
            font-weight: 700; color: var(--primary);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .data-table thead th:first-child { border-radius: 8px 0 0 8px; }
        .data-table thead th:last-child { border-radius: 0 8px 8px 0; }
        .data-table tbody td {
            padding: 14px 12px; border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: var(--light); }
        .data-table .subject-name { font-weight: 600; color: var(--dark); }

        .grade-badge {
            display: inline-block; padding: 4px 12px;
            border-radius: 20px; font-size: 11px; font-weight: 700;
        }
        .grade-badge.Aplus { background: #d1fae5; color: #065f46; }
        .grade-badge.A { background: #dbeafe; color: #1e40af; }
        .grade-badge.Bplus { background: #fef3c7; color: #92400e; }
        .grade-badge.B { background: #fed7aa; color: #9a3412; }

        .marks-progress {
            width: 100%; height: 6px;
            background: var(--light); border-radius: 3px;
            overflow: hidden; margin-top: 4px;
        }
        .marks-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 3px;
        }

        /* TEACHER ROW */
        .teacher-row {
            display: flex; align-items: center;
            gap: 12px; padding: 12px 15px;
            background: var(--light); border-radius: 12px;
            margin-bottom: 10px; transition: all 0.3s ease;
        }
        .teacher-row:hover { background: #f1f5f9; transform: translateX(5px); }
        .teacher-avatar {
            width: 45px; height: 45px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), #7c3aed);
            color: var(--white); display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px;
            flex-shrink: 0; border: 2px solid var(--secondary);
        }
        .teacher-info { flex: 1; min-width: 0; }
        .teacher-info h4 { font-size: 13px; color: var(--primary); font-weight: 700; margin-bottom: 2px; }
        .teacher-info p { font-size: 11px; color: var(--gray); }
        .teacher-action {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--primary); color: var(--white);
            border: none; cursor: pointer;
            font-size: 13px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
        }
        .teacher-action:hover { background: var(--secondary); transform: scale(1.1); }

        /* HOMEWORK */
        .hw-item {
            padding: 16px 18px; background: var(--light);
            border-radius: 12px; margin-bottom: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        .hw-item.priority-high { border-left-color: var(--red); }
        .hw-item.priority-medium { border-left-color: var(--secondary); }
        .hw-item.priority-low { border-left-color: var(--green); }
        .hw-item:hover { transform: translateX(5px); background: #f1f5f9; }

        .hw-header {
            display: flex; justify-content: space-between;
            align-items: center; gap: 10px;
            margin-bottom: 8px; flex-wrap: wrap;
        }
        .hw-header h4 { font-size: 14px; color: var(--primary); font-weight: 700; }
        .hw-status {
            padding: 4px 12px; border-radius: 20px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .hw-status.pending { background: #fee2e2; color: #991b1b; }
        .hw-status.in-progress { background: #fef3c7; color: #92400e; }
        .hw-status.done { background: #d1fae5; color: #065f46; }
        .hw-item p { font-size: 13px; color: var(--gray); margin-bottom: 8px; }
        .hw-meta { display: flex; gap: 15px; flex-wrap: wrap; font-size: 11px; }
        .hw-meta span { display: inline-flex; align-items: center; gap: 5px; color: var(--gray); font-weight: 500; }
        .hw-meta span i { color: var(--secondary); }

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

        /* NOTICE */
        .notice-item {
            display: flex; gap: 12px; align-items: flex-start;
            padding: 14px 15px; background: var(--light);
            border-radius: 10px; margin-bottom: 10px;
            transition: all 0.3s ease;
            border-left: 3px solid var(--primary);
        }
        .notice-item:hover { background: #f1f5f9; transform: translateX(4px); }
        .notice-item.exam { border-left-color: var(--red); }
        .notice-item.event { border-left-color: var(--secondary); }
        .notice-item.general { border-left-color: var(--primary); }
        .notice-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }
        .notice-content { flex: 1; min-width: 0; }
        .notice-content h4 { font-size: 13px; color: var(--primary); font-weight: 600; margin-bottom: 4px; line-height: 1.4; }
        .notice-content span { font-size: 11px; color: var(--gray); display: flex; align-items: center; gap: 5px; }

        /* EVENTS */
        .event-item {
            display: flex; align-items: center;
            gap: 15px; padding: 15px;
            background: var(--light); border-radius: 12px;
            margin-bottom: 10px; transition: all 0.3s ease;
        }
        .event-item:hover { background: var(--primary); color: var(--white); transform: translateX(5px); }
        .event-icon-box {
            width: 50px; height: 50px; border-radius: 12px;
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .event-info h4 { font-size: 14px; color: var(--primary); font-weight: 700; margin-bottom: 3px; transition: color 0.3s; }
        .event-item:hover .event-info h4 { color: var(--white); }
        .event-info p { font-size: 12px; color: var(--gray); transition: color 0.3s; }
        .event-item:hover .event-info p { color: rgba(255,255,255,0.85); }
        .event-days {
            margin-left: auto; background: var(--white); color: var(--primary);
            padding: 8px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 800;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            white-space: nowrap;
        }
        .event-days small { font-size: 9px; font-weight: 600; display: block; text-align: center; color: var(--gray); }

        /* FEE WIDGET */
        .fee-widget {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 15px; padding: 25px;
            position: relative; overflow: hidden;
        }
        .fee-widget .card-header { border-bottom-color: rgba(245, 158, 11, 0.3); }
        .fee-widget .card-header h3 { color: #78350f; }
        .fee-amounts {
            display: grid; grid-template-columns: 1fr 1fr 1fr;
            gap: 12px; margin-bottom: 20px;
        }
        .fee-amount-item {
            background: var(--white); padding: 15px 12px;
            border-radius: 12px; text-align: center;
        }
        .fee-amount-item h4 { font-size: 18px; font-weight: 800; line-height: 1; margin-bottom: 5px; }
        .fee-amount-item.total h4 { color: var(--primary); }
        .fee-amount-item.paid h4 { color: var(--green); }
        .fee-amount-item.pending h4 { color: var(--red); }
        .fee-amount-item p { font-size: 10px; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; }

        .fee-progress {
            height: 10px; background: rgba(255,255,255,0.6);
            border-radius: 5px; overflow: hidden; margin-bottom: 15px;
        }
        .fee-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--green), #059669);
            border-radius: 5px; display: flex;
            align-items: center; justify-content: flex-end;
            padding-right: 8px; color: var(--white);
            font-size: 9px; font-weight: 700;
        }
        .btn-pay {
            display: flex; align-items: center; justify-content: center;
            gap: 8px; width: 100%; padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white); border-radius: 10px;
            font-weight: 700; font-size: 14px;
            transition: all 0.3s ease;
        }
        .btn-pay:hover {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            transform: translateY(-3px);
        }

        /* QUICK ACTIONS */
        .quick-actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .quick-action-card {
            padding: 20px 15px; background: var(--light);
            border-radius: 12px; text-align: center;
            transition: all 0.3s ease; cursor: pointer;
            border: 2px solid transparent; text-decoration: none;
            color: inherit; display: block;
        }
        .quick-action-card:hover {
            background: var(--white); border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        }
        .quick-action-card i { font-size: 26px; color: var(--primary); margin-bottom: 10px; display: block; }
        .quick-action-card h4 { font-size: 13px; color: var(--dark); font-weight: 600; }

        /* FORM */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-group label .req { color: var(--red); }
        .form-group input, .form-group select, .form-group textarea {
            padding: 13px 16px; border: 2px solid var(--border);
            border-radius: 10px; font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: var(--white); color: var(--dark);
            transition: all 0.3s ease;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none; border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-submit { margin-top: 25px; grid-column: 1 / -1; }
        .form-submit button {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white); border: none;
            border-radius: 10px; font-size: 15px;
            font-weight: 700; cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 10px;
        }
        .form-submit button:hover {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            transform: translateY(-3px);
        }

        /* SIDEBAR OVERLAY */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.5); z-index: 99;
        }
        .sidebar-overlay.active { display: block; }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1100px) {
            .content-grid { grid-template-columns: 1fr; }
            .topbar-search { display: none; }
            .child-hero { grid-template-columns: auto 1fr; }
            .child-hero-stats { grid-column: 1 / -1; justify-content: center; }
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
            .quick-actions-grid { grid-template-columns: 1fr 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .child-hero { grid-template-columns: 1fr; text-align: center; padding: 25px 20px; }
            .child-hero-avatar { margin: 0 auto; width: 80px; height: 80px; font-size: 32px; }
            .child-hero-info h1 { font-size: 22px; }
            .child-badges { justify-content: center; }
            .child-hero-stats { justify-content: center; gap: 20px; }
            .child-hero-stat h3 { font-size: 22px; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-header h1 { font-size: 18px; }
            .fee-amounts { grid-template-columns: 1fr 1fr 1fr; }
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
            <div class="logo-icon">👨‍👩‍👧</div>
            <div>
                <h2>Sunrise</h2>
                <span>PARENT PORTAL</span>
            </div>
        </div>
    </div>

    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search marks, notices...">
    </div>

    <div class="topbar-right">
        <button class="notification-btn" onclick="alert('3 new notifications')">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </button>

        <div class="user-menu">
            <div class="user-avatar"><?php echo strtoupper(substr($parent_name, 0, 1)); ?></div>
            <div class="user-menu-info">
                <h4><?php echo htmlspecialchars($parent_name); ?></h4>
                <span>Parent</span>
            </div>
        </div>
    </div>
</div>


<!-- LAYOUT -->
<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-profile">
            <div class="sidebar-avatar"><?php echo strtoupper(substr($parent_name, 0, 1)); ?></div>
            <h3><?php echo htmlspecialchars($parent_name); ?></h3>
            <p>PARENT</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Overview</div>
            <a href="parent.php?page=overview" class="<?php echo $page === 'overview' ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="parent.php?page=child-profile" class="<?php echo $page === 'child-profile' ? 'active' : ''; ?>">
                <i class="fas fa-child"></i> Child Profile
            </a>
            <a href="parent.php?page=attendance" class="<?php echo $page === 'attendance' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
            <a href="parent.php?page=marks" class="<?php echo $page === 'marks' ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i> Marks & Results
            </a>

            <div class="menu-label">Communication</div>
            <a href="parent.php?page=teachers" class="<?php echo $page === 'teachers' ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard-teacher"></i> Contact Teachers
            </a>
            <a href="parent.php?page=messages" class="<?php echo $page === 'messages' ? 'active' : ''; ?>">
                <i class="fas fa-comments"></i> Messages
                <span class="nav-badge">2</span>
            </a>
            <a href="parent.php?page=notices" class="<?php echo $page === 'notices' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i> Notices
            </a>

            <div class="menu-label">Account</div>
            <a href="parent.php?page=fees" class="<?php echo $page === 'fees' ? 'active' : ''; ?>">
                <i class="fas fa-credit-card"></i> Pay Fees
            </a>
            <a href="parent.php?page=profile" class="<?php echo $page === 'profile' ? 'active' : ''; ?>">
                <i class="fas fa-user-circle"></i> My Profile
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
        <!-- OVERVIEW -->
        <div class="page-header">
            <div>
                <h1>Welcome, <span><?php echo explode(' ', $parent_name)[0]; ?></span>! 👋</h1>
                <p>Track your child's academic progress</p>
            </div>
            <div class="page-actions">
                <a href="parent.php?page=marks" class="page-btn">
                    <i class="fas fa-chart-line"></i> View Marks
                </a>
                <a href="parent.php?page=teachers" class="page-btn primary">
                    <i class="fas fa-comments"></i> Contact Teacher
                </a>
            </div>
        </div>

        <!-- CHILD HERO -->
        <div class="child-hero">
            <div class="child-hero-avatar"><?php echo strtoupper(substr($child['name'], 0, 1)); ?></div>
            <div class="child-hero-info">
                <h1><?php echo htmlspecialchars($child['name']); ?></h1>
                <p>Class: <?php echo $child['class']; ?> | Roll No: <?php echo $child['roll']; ?></p>
                <div class="child-badges">
                    <span class="child-badge"><i class="fas fa-birthday-cake"></i> <?php echo $child['dob']; ?></span>
                    <span class="child-badge"><i class="fas fa-tint"></i> <?php echo $child['blood']; ?></span>
                    <span class="child-badge"><i class="fas fa-envelope"></i> <?php echo $child['email']; ?></span>
                </div>
            </div>
            <div class="child-hero-stats">
                <div class="child-hero-stat">
                    <h3><?php echo $stats['attendance']; ?>%</h3>
                    <p>Attendance</p>
                </div>
                <div class="child-hero-stat">
                    <h3><?php echo $stats['marks']; ?>%</h3>
                    <p>Marks</p>
                </div>
                <div class="child-hero-stat">
                    <h3>A+</h3>
                    <p>Grade</p>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                </div>
                <h3><?php echo $attendance_details['this_month_present']; ?>/<?php echo $attendance_details['this_month_present'] + $attendance_details['this_month_absent']; ?></h3>
                <p>This Month Attendance</p>
            </div>
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                </div>
                <h3><?php echo $stats['marks']; ?>%</h3>
                <p>Overall Percentage</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                </div>
                <h3><?php echo count($homeworks); ?></h3>
                <p>Pending Homework</p>
            </div>
            <div class="stat-card red">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
                </div>
                <h3>₹<?php echo number_format($stats['fee_pending'] / 1000, 0); ?>K</h3>
                <p>Fee Pending</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> Subject-wise Marks</h3>
                    <a href="parent.php?page=marks">View Full Result <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr><th>Subject</th><th>Marks</th><th>Percentage</th><th>Grade</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($subjects, 0, 4) as $s): 
                                $pct = round(($s['marks'] / $s['total']) * 100);
                                $gc = str_replace('+', 'plus', $s['grade']);
                            ?>
                            <tr>
                                <td class="subject-name"><?php echo $s['name']; ?></td>
                                <td><strong><?php echo $s['marks']; ?></strong>/<?php echo $s['total']; ?></td>
                                <td>
                                    <?php echo $pct; ?>%
                                    <div class="marks-progress"><div class="marks-progress-bar" style="width: <?php echo $pct; ?>%"></div></div>
                                </td>
                                <td><span class="grade-badge <?php echo $gc; ?>"><?php echo $s['grade']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-card fee-widget">
                <div class="card-header">
                    <h3><i class="fas fa-credit-card"></i> Fee Status</h3>
                </div>
                <div class="fee-amounts">
                    <div class="fee-amount-item total">
                        <h4>₹<?php echo number_format($fees['total'] / 1000, 0); ?>K</h4>
                        <p>Total</p>
                    </div>
                    <div class="fee-amount-item paid">
                        <h4>₹<?php echo number_format($fees['paid'] / 1000, 0); ?>K</h4>
                        <p>Paid</p>
                    </div>
                    <div class="fee-amount-item pending">
                        <h4>₹<?php echo number_format($fees['pending'] / 1000, 0); ?>K</h4>
                        <p>Pending</p>
                    </div>
                </div>
                <?php $pct = round(($fees['paid'] / $fees['total']) * 100); ?>
                <div class="fee-progress">
                    <div class="fee-progress-bar" style="width: <?php echo $pct; ?>%;"><?php echo $pct; ?>%</div>
                </div>
                <a href="parent.php?page=fees" class="btn-pay">
                    <i class="fas fa-credit-card"></i> Pay Now
                </a>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-chalkboard-teacher"></i> Contact Teachers</h3>
                    <a href="parent.php?page=teachers">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <?php foreach ($teachers as $t): ?>
                <div class="teacher-row">
                    <div class="teacher-avatar"><?php echo strtoupper(substr($t['name'], 0, 1)); ?></div>
                    <div class="teacher-info">
                        <h4><?php echo $t['name']; ?></h4>
                        <p><?php echo $t['subject']; ?> Teacher</p>
                    </div>
                    <button class="teacher-action" onclick="alert('Calling <?php echo $t['name']; ?>...\n<?php echo $t['phone']; ?>')" title="Call">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="teacher-action" onclick="window.location.href='parent.php?page=messages&teacher=<?php echo urlencode($t['name']); ?>'" title="Message">
                        <i class="fas fa-comment"></i>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bullhorn"></i> Recent Notices</h3>
                    <a href="parent.php?page=notices">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <?php foreach ($notices as $n): ?>
                <div class="notice-item <?php echo $n['type']; ?>">
                    <div class="notice-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="notice-content">
                        <h4><?php echo $n['title']; ?></h4>
                        <span><i class="fas fa-calendar-alt"></i> <?php echo $n['date']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-calendar-alt"></i> Upcoming Events</h3>
                </div>
                <?php foreach ($events as $e): ?>
                <div class="event-item">
                    <div class="event-icon-box"><?php echo $e['icon']; ?></div>
                    <div class="event-info">
                        <h4><?php echo $e['title']; ?></h4>
                        <p><?php echo $e['date']; ?></p>
                    </div>
                    <div class="event-days">
                        <?php echo $e['days']; ?>
                        <small>days left</small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

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

        <div class="content-grid-full">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-book"></i> Pending Homework</h3>
                </div>
                <?php foreach ($homeworks as $hw): ?>
                <div class="hw-item priority-<?php echo $hw['priority']; ?>">
                    <div class="hw-header">
                        <h4><?php echo $hw['subject']; ?></h4>
                        <span class="hw-status <?php echo $hw['status']; ?>"><?php echo str_replace('-', ' ', $hw['status']); ?></span>
                    </div>
                    <p><?php echo $hw['task']; ?></p>
                    <div class="hw-meta">
                        <span><i class="fas fa-clock"></i> Due: <?php echo $hw['due']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php elseif ($page === 'child-profile'): ?>
        <!-- CHILD PROFILE -->
        <div class="page-header">
            <div>
                <h1>Child's <span>Profile</span></h1>
                <p>Complete information about your child</p>
            </div>
            <a href="parent.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <div style="display: flex; gap: 25px; align-items: center; flex-wrap: wrap; padding: 20px 0;">
                <div class="sidebar-avatar" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); margin: 0; width: 100px; height: 100px; font-size: 38px;">
                    <?php echo strtoupper(substr($child['name'], 0, 1)); ?>
                </div>
                <div>
                    <h2 style="font-size: 24px; color: var(--primary); margin-bottom: 5px;"><?php echo htmlspecialchars($child['name']); ?></h2>
                    <p style="color: var(--gray); font-size: 14px; margin-bottom: 8px;"><?php echo htmlspecialchars($child['email']); ?></p>
                    <span style="background: var(--primary); color: var(--white); padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 700;">STUDENT • <?php echo $child['class']; ?></span>
                </div>
            </div>
            <div class="stats-grid" style="margin-top: 25px; grid-template-columns: 1fr 1fr 1fr;">
                <div class="stat-card blue">
                    <div class="stat-header"><div class="stat-icon"><i class="fas fa-birthday-cake"></i></div></div>
                    <h3 style="font-size: 16px;"><?php echo $child['dob']; ?></h3>
                    <p>Date of Birth</p>
                </div>
                <div class="stat-card red">
                    <div class="stat-header"><div class="stat-icon"><i class="fas fa-tint"></i></div></div>
                    <h3 style="font-size: 16px;"><?php echo $child['blood']; ?></h3>
                    <p>Blood Group</p>
                </div>
                <div class="stat-card green">
                    <div class="stat-header"><div class="stat-icon"><i class="fas fa-id-card"></i></div></div>
                    <h3 style="font-size: 16px;"><?php echo $child['roll']; ?></h3>
                    <p>Roll Number</p>
                </div>
            </div>
        </div>

        <?php elseif ($page === 'attendance'): ?>
        <!-- ATTENDANCE -->
        <div class="page-header">
            <div>
                <h1>Child's <span>Attendance</span></h1>
                <p>Attendance record for academic session</p>
            </div>
            <a href="parent.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-header"><div class="stat-icon"><i class="fas fa-calendar-check"></i></div></div>
                <h3><?php echo $attendance_details['percentage']; ?>%</h3>
                <p>Overall Percentage</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header"><div class="stat-icon"><i class="fas fa-check"></i></div></div>
                <h3><?php echo $attendance_details['present']; ?></h3>
                <p>Days Present</p>
            </div>
            <div class="stat-card red">
                <div class="stat-header"><div class="stat-icon"><i class="fas fa-times"></i></div></div>
                <h3><?php echo $attendance_details['absent']; ?></h3>
                <p>Days Absent</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header"><div class="stat-icon"><i class="fas fa-list"></i></div></div>
                <h3><?php echo $attendance_details['total_days']; ?></h3>
                <p>Total Days</p>
            </div>
        </div>
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-calendar-alt"></i> This Month</h3>
            </div>
            <div class="stats-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                <div class="stat-card green">
                    <div class="stat-header"><div class="stat-icon"><i class="fas fa-check"></i></div></div>
                    <h3><?php echo $attendance_details['this_month_present']; ?></h3>
                    <p>Present Days</p>
                </div>
                <div class="stat-card red">
                    <div class="stat-header"><div class="stat-icon"><i class="fas fa-times"></i></div></div>
                    <h3><?php echo $attendance_details['this_month_absent']; ?></h3>
                    <p>Absent Days</p>
                </div>
            </div>
        </div>

        <?php elseif ($page === 'marks'): ?>
        <!-- MARKS -->
        <div class="page-header">
            <div>
                <h1>Child's <span>Marks</span></h1>
                <p>Subject-wise performance</p>
            </div>
            <a href="parent.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Subject</th><th>Marks</th><th>Percentage</th><th>Grade</th></tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_marks = 0; $total_max = 0;
                        foreach ($subjects as $s): 
                            $pct = round(($s['marks'] / $s['total']) * 100);
                            $gc = str_replace('+', 'plus', $s['grade']);
                            $total_marks += $s['marks'];
                            $total_max += $s['total'];
                        ?>
                        <tr>
                            <td class="subject-name"><?php echo $s['name']; ?></td>
                            <td><strong><?php echo $s['marks']; ?></strong>/<?php echo $s['total']; ?></td>
                            <td>
                                <?php echo $pct; ?>%
                                <div class="marks-progress"><div class="marks-progress-bar" style="width: <?php echo $pct; ?>%"></div></div>
                            </td>
                            <td><span class="grade-badge <?php echo $gc; ?>"><?php echo $s['grade']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 20px; padding: 20px; background: var(--light); border-radius: 12px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                <div>
                    <div style="font-size: 11px; color: var(--gray); text-transform: uppercase;">Total</div>
                    <div style="font-size: 22px; font-weight: 800; color: var(--primary);"><?php echo $total_marks; ?>/<?php echo $total_max; ?></div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 11px; color: var(--gray); text-transform: uppercase;">Percentage</div>
                    <div style="font-size: 22px; font-weight: 800; color: var(--green);"><?php echo round(($total_marks / $total_max) * 100, 2); ?>%</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 11px; color: var(--gray); text-transform: uppercase;">Grade</div>
                    <div style="font-size: 22px; font-weight: 800; color: var(--secondary);">A+</div>
                </div>
            </div>
        </div>

        <?php elseif ($page === 'teachers'): ?>
        <!-- TEACHERS -->
        <div class="page-header">
            <div>
                <h1>Contact <span>Teachers</span></h1>
                <p>Reach out to your child's teachers</p>
            </div>
            <a href="parent.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <?php foreach ($teachers as $t): ?>
            <div class="teacher-row">
                <div class="teacher-avatar"><?php echo strtoupper(substr($t['name'], 0, 1)); ?></div>
                <div class="teacher-info">
                    <h4><?php echo $t['name']; ?></h4>
                    <p><?php echo $t['subject']; ?> Teacher • <?php echo $t['phone']; ?></p>
                </div>
                <button class="teacher-action" onclick="alert('Calling <?php echo $t['name']; ?>...\n<?php echo $t['phone']; ?>')" title="Call">
                    <i class="fas fa-phone"></i>
                </button>
                <a href="parent.php?page=messages&teacher=<?php echo urlencode($t['name']); ?>" class="teacher-action" title="Message">
                    <i class="fas fa-comment"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($page === 'messages'): ?>
        <!-- MESSAGES -->
        <div class="page-header">
            <div>
                <h1>Send <span>Message</span></h1>
                <p><?php echo isset($_GET['teacher']) ? 'To: ' . htmlspecialchars($_GET['teacher']) : 'Contact a teacher'; ?></p>
            </div>
            <a href="parent.php?page=teachers" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="contact_teacher">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Select Teacher <span class="req">*</span></label>
                        <select name="teacher" required>
                            <option value="">Choose a teacher</option>
                            <?php foreach ($teachers as $t): ?>
                                <option <?php echo (isset($_GET['teacher']) && $_GET['teacher'] === $t['name']) ? 'selected' : ''; ?>>
                                    <?php echo $t['name']; ?> (<?php echo $t['subject']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Your Message <span class="req">*</span></label>
                        <textarea name="message" placeholder="Write your message..." required></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'notices'): ?>
        <!-- NOTICES -->
        <div class="page-header">
            <div>
                <h1>School <span>Notices</span></h1>
                <p>All announcements and updates</p>
            </div>
        </div>
        <div class="content-card">
            <?php foreach ($notices as $n): ?>
            <div class="notice-item <?php echo $n['type']; ?>">
                <div class="notice-icon"><i class="fas fa-file-alt"></i></div>
                <div class="notice-content">
                    <h4><?php echo $n['title']; ?></h4>
                    <span><i class="fas fa-calendar-alt"></i> <?php echo $n['date']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php elseif ($page === 'fees'): ?>
        <!-- FEES -->
        <div class="page-header">
            <div>
                <h1>Pay <span>Fees</span></h1>
                <p>Fee details and online payment</p>
            </div>
        </div>
        <div class="content-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="content-card fee-widget">
                <div class="card-header">
                    <h3><i class="fas fa-credit-card"></i> Fee Summary</h3>
                </div>
                <div class="fee-amounts">
                    <div class="fee-amount-item total">
                        <h4>₹<?php echo number_format($fees['total'] / 1000, 0); ?>K</h4>
                        <p>Total</p>
                    </div>
                    <div class="fee-amount-item paid">
                        <h4>₹<?php echo number_format($fees['paid'] / 1000, 0); ?>K</h4>
                        <p>Paid</p>
                    </div>
                    <div class="fee-amount-item pending">
                        <h4>₹<?php echo number_format($fees['pending'] / 1000, 0); ?>K</h4>
                        <p>Pending</p>
                    </div>
                </div>
                <?php $pct = round(($fees['paid'] / $fees['total']) * 100); ?>
                <div class="fee-progress">
                    <div class="fee-progress-bar" style="width: <?php echo $pct; ?>%;"><?php echo $pct; ?>%</div>
                </div>
                <div style="padding: 12px 15px; background: rgba(255,255,255,0.7); border-radius: 10px; font-size: 12px; margin-bottom: 15px;">
                    <strong>Next Due:</strong> <?php echo $fees['due_date']; ?>
                </div>
                <button class="btn-pay" onclick="alert('Fee payment page coming soon')">
                    <i class="fas fa-credit-card"></i> Pay ₹<?php echo number_format($fees['pending']); ?>
                </button>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-history"></i> Payment History</h3>
                </div>
                <div class="hw-item priority-low">
                    <div class="hw-header">
                        <h4>Installment 1</h4>
                        <span class="hw-status done">Paid</span>
                    </div>
                    <p>₹15,000 via UPI on 15 Aug 2024</p>
                </div>
                <div class="hw-item priority-low">
                    <div class="hw-header">
                        <h4>Installment 2</h4>
                        <span class="hw-status done">Paid</span>
                    </div>
                    <p>₹10,000 via Card on 10 Sep 2024</p>
                </div>
                <div class="hw-item priority-low">
                    <div class="hw-header">
                        <h4>Installment 3</h4>
                        <span class="hw-status done">Paid</span>
                    </div>
                    <p>₹5,000 via Net Banking on 05 Nov 2024</p>
                </div>
            </div>
        </div>

        <?php elseif ($page === 'profile'): ?>
        <!-- PROFILE -->
        <div class="page-header">
            <div>
                <h1>My <span>Profile</span></h1>
                <p>Your account information</p>
            </div>
        </div>
        <div class="content-card">
            <div style="display: flex; gap: 25px; align-items: center; flex-wrap: wrap; padding: 20px 0;">
                <div class="sidebar-avatar" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); margin: 0; width: 100px; height: 100px; font-size: 38px;">
                    <?php echo strtoupper(substr($parent_name, 0, 1)); ?>
                </div>
                <div>
                    <h2 style="font-size: 24px; color: var(--primary); margin-bottom: 5px;"><?php echo htmlspecialchars($parent_name); ?></h2>
                    <p style="color: var(--gray); font-size: 14px; margin-bottom: 8px;"><?php echo htmlspecialchars($parent_email); ?></p>
                    <span style="background: var(--primary); color: var(--white); padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 700;">PARENT</span>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="page-header">
            <div>
                <h1>Page <span>Not Found</span></h1>
                <p>This page doesn't exist in parent portal.</p>
            </div>
            <a href="parent.php" class="page-btn primary">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </div>
        <?php endif; ?>

    </main>

</div>


<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
</script>

</body>
</html>