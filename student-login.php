<?php
// ============================================
// Sunrise Public School - Student Dashboard
// Single File - All Pages Inside
// ============================================
session_start();

// ---------- SESSION CHECK ----------
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'student') {
    header("Location: student-login.php");
    exit;
}

// ---------- LOGOUT ----------
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$student_name = $_SESSION['user_name'] ?? 'Zain Student';
$student_email = $_SESSION['user_email'] ?? 'zain3';

$page = $_GET['page'] ?? 'overview';

// ---------- ACTION HANDLER ----------
$action_msg = "";
$action_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'submit_homework') {
        $task = trim($_POST['task'] ?? '');
        if ($task) {
            $action_msg = "✅ Homework submitted successfully!";
            $action_type = "success";
        } else {
            $action_msg = "❌ Please write your homework!";
            $action_type = "error";
        }
    }

    if ($action === 'update_profile') {
        $action_msg = "✅ Profile updated successfully!";
        $action_type = "success";
    }
}

// ---------- DEMO DATA ----------
$stats = [
    'attendance' => 93,
    'overall_marks' => 87,
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

$homeworks = [
    ['subject' => 'Mathematics', 'task' => 'Complete Chapter 5 exercises', 'due' => 'Tomorrow', 'status' => 'pending', 'priority' => 'high'],
    ['subject' => 'Science', 'task' => 'Write notes on Photosynthesis', 'due' => 'In 2 days', 'status' => 'pending', 'priority' => 'medium'],
    ['subject' => 'English', 'task' => 'Essay writing task', 'due' => 'In 3 days', 'status' => 'pending', 'priority' => 'medium'],
    ['subject' => 'Social Science', 'task' => 'Prepare PPT', 'due' => 'Next week', 'status' => 'in-progress', 'priority' => 'low'],
    ['subject' => 'Hindi', 'task' => 'Learn poem', 'due' => 'Completed', 'status' => 'done', 'priority' => 'low'],
];

$timetable = [
    ['time' => '8:00 - 8:45', 'mon' => 'English', 'tue' => 'Maths', 'wed' => 'Science', 'thu' => 'Hindi', 'fri' => 'English'],
    ['time' => '8:45 - 9:30', 'mon' => 'Maths', 'tue' => 'Science', 'wed' => 'English', 'thu' => 'Maths', 'fri' => 'Computer'],
    ['time' => '9:30 - 10:15', 'mon' => 'Science', 'tue' => 'Hindi', 'wed' => 'Maths', 'thu' => 'Science', 'fri' => 'Maths'],
    ['time' => '10:15 - 10:45', 'mon' => 'BREAK', 'tue' => 'BREAK', 'wed' => 'BREAK', 'thu' => 'BREAK', 'fri' => 'BREAK'],
    ['time' => '10:45 - 11:30', 'mon' => 'S.St', 'tue' => 'Computer', 'wed' => 'S.St', 'thu' => 'English', 'fri' => 'S.St'],
    ['time' => '11:30 - 12:15', 'mon' => 'Computer', 'tue' => 'S.St', 'wed' => 'Hindi', 'thu' => 'Computer', 'fri' => 'Hindi'],
    ['time' => '12:15 - 1:00', 'mon' => 'Sports', 'tue' => 'Library', 'wed' => 'Sports', 'thu' => 'Library', 'fri' => 'Sports'],
];

$notices = [
    ['title' => 'Half Yearly Exam Schedule Released', 'date' => '10 Jan', 'type' => 'exam'],
    ['title' => 'Annual Sports Day - 25th Dec', 'date' => '08 Jan', 'type' => 'event'],
    ['title' => 'PTM on 10th February', 'date' => '05 Jan', 'type' => 'general'],
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

$events = [
    ['title' => 'Unit Test 2', 'date' => '20 Jan 2025', 'days' => 8, 'icon' => '📝'],
    ['title' => 'Annual Function', 'date' => '15 Feb 2025', 'days' => 34, 'icon' => '🎭'],
    ['title' => 'PTM', 'date' => '10 Feb 2025', 'days' => 29, 'icon' => '👨‍👩‍👧'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace('-', ' ', $page)); ?> | Student Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        :root {
            --primary: #3b82f6;
            --primary-light: #60a5fa;
            --primary-dark: #2563eb;
            --secondary: #f59e0b;
            --secondary-dark: #d97706;
            --dark: #111827;
            --gray: #6b7280;
            --light: #f9fafb;
            --white: #ffffff;
            --border: #e5e7eb;
            --red: #ef4444;
            --green: #10b981;
            --purple: #8b5cf6;
            --orange: #f97316;
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

        /* MARKS TABLE */
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

        /* HOMEWORK ITEM */
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

        /* TIMETABLE */
        .timetable-scroll { overflow-x: auto; }
        .timetable {
            width: 100%; border-collapse: separate;
            border-spacing: 5px; min-width: 700px;
        }
        .timetable th {
            background: var(--primary); color: var(--white);
            padding: 12px 10px; border-radius: 8px;
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .timetable td {
            padding: 12px 10px; text-align: center;
            font-size: 12px; border-radius: 8px;
            background: var(--light); font-weight: 500;
            transition: all 0.3s ease;
        }
        .timetable td.time-cell {
            background: var(--primary); color: var(--white);
            font-weight: 700; font-size: 11px;
        }
        .timetable td.break-cell {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white); font-weight: 700;
            font-size: 11px;
        }
        .timetable td:not(.time-cell):not(.break-cell):hover {
            background: var(--primary); color: var(--white);
        }

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
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
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
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
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
            <div class="logo-icon">🎓</div>
            <div>
                <h2>Sunrise</h2>
                <span>STUDENT PORTAL</span>
            </div>
        </div>
    </div>

    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search homework, marks...">
    </div>

    <div class="topbar-right">
        <button class="notification-btn" onclick="alert('3 new notifications')">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </button>

        <div class="user-menu">
            <div class="user-avatar"><?php echo strtoupper(substr($student_name, 0, 1)); ?></div>
            <div class="user-menu-info">
                <h4><?php echo htmlspecialchars($student_name); ?></h4>
                <span>Class 10-A</span>
            </div>
        </div>
    </div>
</div>


<!-- LAYOUT -->
<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-profile">
            <div class="sidebar-avatar"><?php echo strtoupper(substr($student_name, 0, 1)); ?></div>
            <h3><?php echo htmlspecialchars($student_name); ?></h3>
            <p>CLASS 10-A</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Main</div>
            <a href="student.php?page=overview" class="<?php echo $page === 'overview' ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Overview
            </a>
            <a href="student.php?page=attendance" class="<?php echo $page === 'attendance' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-check"></i> Attendance
            </a>
            <a href="student.php?page=marks" class="<?php echo $page === 'marks' ? 'active' : ''; ?>">
                <i class="fas fa-chart-line"></i> Marks & Results
            </a>
            <a href="student.php?page=homework" class="<?php echo $page === 'homework' ? 'active' : ''; ?>">
                <i class="fas fa-book"></i> Homework
                <span class="nav-badge">3</span>
            </a>
            <a href="student.php?page=timetable" class="<?php echo $page === 'timetable' ? 'active' : ''; ?>">
                <i class="fas fa-clock"></i> Timetable
            </a>

            <div class="menu-label">Account</div>
            <a href="student.php?page=fees" class="<?php echo $page === 'fees' ? 'active' : ''; ?>">
                <i class="fas fa-credit-card"></i> Pay Fees
            </a>
            <a href="student.php?page=notices" class="<?php echo $page === 'notices' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i> Notices
            </a>
            <a href="student.php?page=profile" class="<?php echo $page === 'profile' ? 'active' : ''; ?>">
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
                <h1>Welcome, <span><?php echo explode(' ', $student_name)[0]; ?></span>! 👋</h1>
                <p>Here's what's happening with your academics today.</p>
            </div>
            <div class="page-actions">
                <a href="student.php?page=homework" class="page-btn">
                    <i class="fas fa-book"></i> View Homework
                </a>
                <a href="student.php?page=marks" class="page-btn primary">
                    <i class="fas fa-chart-line"></i> Check Marks
                </a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                </div>
                <h3><?php echo $stats['attendance']; ?>%</h3>
                <p>Attendance</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                </div>
                <h3><?php echo $stats['overall_marks']; ?>%</h3>
                <p>Overall Marks</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                </div>
                <h3><?php echo $stats['pending_homework']; ?></h3>
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
                    <a href="student.php?page=marks">View All <i class="fas fa-arrow-right"></i></a>
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
                <?php $paid_pct = round(($fees['paid'] / $fees['total']) * 100); ?>
                <div class="fee-progress">
                    <div class="fee-progress-bar" style="width: <?php echo $paid_pct; ?>%;"><?php echo $paid_pct; ?>%</div>
                </div>
                <a href="student.php?page=fees" class="btn-pay">
                    <i class="fas fa-credit-card"></i> Pay Now
                </a>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-book"></i> Recent Homework</h3>
                    <a href="student.php?page=homework">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <?php foreach (array_slice($homeworks, 0, 3) as $hw): ?>
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

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="student.php?page=marks" class="quick-action-card">
                        <i class="fas fa-chart-line"></i>
                        <h4>Check Marks</h4>
                    </a>
                    <a href="student.php?page=fees" class="quick-action-card">
                        <i class="fas fa-credit-card"></i>
                        <h4>Pay Fees</h4>
                    </a>
                    <a href="student.php?page=homework" class="quick-action-card">
                        <i class="fas fa-book"></i>
                        <h4>Homework</h4>
                    </a>
                    <a href="student.php?page=timetable" class="quick-action-card">
                        <i class="fas fa-clock"></i>
                        <h4>Timetable</h4>
                    </a>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bullhorn"></i> Recent Notices</h3>
                    <a href="student.php?page=notices">View All <i class="fas fa-arrow-right"></i></a>
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
        </div>

        <?php elseif ($page === 'attendance'): ?>
        <!-- ATTENDANCE -->
        <div class="page-header">
            <div>
                <h1>My <span>Attendance</span></h1>
                <p>Attendance record for academic session</p>
            </div>
            <a href="student.php?page=overview" class="page-btn">
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
                <h1>My <span>Marks</span></h1>
                <p>Subject-wise performance</p>
            </div>
            <a href="student.php?page=overview" class="page-btn">
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

        <?php elseif ($page === 'homework'): ?>
        <!-- HOMEWORK -->
        <div class="page-header">
            <div>
                <h1>My <span>Homework</span></h1>
                <p>All pending and submitted homework</p>
            </div>
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
            <?php if ($hw['status'] !== 'done'): ?>
            <div style="margin-top: 12px;">
                <a href="student.php?page=submit-homework" class="page-btn primary" style="padding: 8px 16px; font-size: 12px;">
                    <i class="fas fa-upload"></i> Submit
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php elseif ($page === 'submit-homework'): ?>
        <!-- SUBMIT HOMEWORK -->
        <div class="page-header">
            <div>
                <h1>Submit <span>Homework</span></h1>
                <p>Upload your completed homework</p>
            </div>
            <a href="student.php?page=homework" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="submit_homework">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Your Answer / Notes <span class="req">*</span></label>
                        <textarea name="task" placeholder="Write your homework or paste link..." required></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-upload"></i> Submit Homework
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'timetable'): ?>
        <!-- TIMETABLE -->
        <div class="page-header">
            <div>
                <h1>Weekly <span>Timetable</span></h1>
                <p>Your class schedule</p>
            </div>
        </div>
        <div class="content-card">
            <div class="timetable-scroll">
                <table class="timetable">
                    <thead>
                        <tr>
                            <th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timetable as $row): ?>
                        <tr>
                            <td class="time-cell"><?php echo $row['time']; ?></td>
                            <td class="<?php echo $row['mon'] === 'BREAK' ? 'break-cell' : ''; ?>"><?php echo $row['mon']; ?></td>
                            <td class="<?php echo $row['tue'] === 'BREAK' ? 'break-cell' : ''; ?>"><?php echo $row['tue']; ?></td>
                            <td class="<?php echo $row['wed'] === 'BREAK' ? 'break-cell' : ''; ?>"><?php echo $row['wed']; ?></td>
                            <td class="<?php echo $row['thu'] === 'BREAK' ? 'break-cell' : ''; ?>"><?php echo $row['thu']; ?></td>
                            <td class="<?php echo $row['fri'] === 'BREAK' ? 'break-cell' : ''; ?>"><?php echo $row['fri']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
                    <?php echo strtoupper(substr($student_name, 0, 1)); ?>
                </div>
                <div>
                    <h2 style="font-size: 24px; color: var(--primary); margin-bottom: 5px;"><?php echo htmlspecialchars($student_name); ?></h2>
                    <p style="color: var(--gray); font-size: 14px; margin-bottom: 8px;"><?php echo htmlspecialchars($student_email); ?></p>
                    <span style="background: var(--primary); color: var(--white); padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 700;">STUDENT • Class 10-A</span>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="page-header">
            <div>
                <h1>Page <span>Not Found</span></h1>
                <p>This page doesn't exist in student portal.</p>
            </div>
            <a href="student.php" class="page-btn primary">
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