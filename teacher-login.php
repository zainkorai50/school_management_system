<?php
// ============================================
// Sunrise Public School - Teacher Dashboard
// ============================================
session_start();

// ---------- SESSION CHECK ----------
if (!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'teacher') {
    header("Location: teacher-login.php");
    exit;
}

// ---------- LOGOUT ----------
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$teacher_name = $_SESSION['user_name'] ?? 'Zain Teacher';
$teacher_email = $_SESSION['user_email'] ?? 'zain2';

$page = $_GET['page'] ?? 'overview';

// ---------- ACTION MESSAGES ----------
$action_msg = "";
$action_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'mark_attendance') {
        $class = trim($_POST['class'] ?? '');
        $present = (int)($_POST['present'] ?? 0);
        $absent = (int)($_POST['absent'] ?? 0);
        if ($class && ($present + $absent) > 0) {
            $action_msg = "✅ Attendance marked for <strong>" . htmlspecialchars($class) . "</strong> — Present: $present, Absent: $absent";
            $action_type = "success";
        } else {
            $action_msg = "❌ Please fill all fields!";
            $action_type = "error";
        }
    }

    if ($action === 'enter_marks') {
        $student = trim($_POST['student'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $marks = (int)($_POST['marks'] ?? 0);
        if ($student && $subject && $marks > 0) {
            $action_msg = "✅ Marks saved! <strong>" . htmlspecialchars($student) . "</strong> got $marks in " . htmlspecialchars($subject);
            $action_type = "success";
        } else {
            $action_msg = "❌ Please fill all fields!";
            $action_type = "error";
        }
    }

    if ($action === 'upload_homework') {
        $class = trim($_POST['class'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $task = trim($_POST['task'] ?? '');
        if ($class && $subject && $task) {
            $action_msg = "✅ Homework uploaded for <strong>" . htmlspecialchars($class) . "</strong> — " . htmlspecialchars($subject);
            $action_type = "success";
        } else {
            $action_msg = "❌ Please fill all fields!";
            $action_type = "error";
        }
    }

    if ($action === 'approve_leave') {
        $student = trim($_POST['student'] ?? '');
        $action_msg = "✅ Leave approved for <strong>" . htmlspecialchars($student) . "</strong>";
        $action_type = "success";
    }

    if ($action === 'reject_leave') {
        $student = trim($_POST['student'] ?? '');
        $action_msg = "❌ Leave rejected for <strong>" . htmlspecialchars($student) . "</strong>";
        $action_type = "error";
    }
}

// ---------- DEMO DATA ----------
$stats = [
    'today_classes' => 5,
    'total_students' => 156,
    'attendance_marked' => 2,
    'homework_active' => 4,
];

$today_classes = [
    ['time' => '8:00 - 8:45', 'class' => 'Class 10-A', 'subject' => 'English', 'room' => 'R-101', 'status' => 'done'],
    ['time' => '8:45 - 9:30', 'class' => 'Class 9-A', 'subject' => 'English', 'room' => 'R-205', 'status' => 'done'],
    ['time' => '10:45 - 11:30', 'class' => 'Class 10-B', 'subject' => 'Grammar', 'room' => 'R-102', 'status' => 'ongoing'],
    ['time' => '11:30 - 12:15', 'class' => 'Class 9-B', 'subject' => 'English', 'room' => 'R-206', 'status' => 'upcoming'],
    ['time' => '12:15 - 1:00', 'class' => 'Class 10-A', 'subject' => 'Literature', 'room' => 'R-101', 'status' => 'upcoming'],
];

$attendance_summary = [
    ['class' => 'Class 10-A', 'total' => 40, 'present' => 38, 'absent' => 2, 'marked' => true],
    ['class' => 'Class 9-A', 'total' => 38, 'present' => 35, 'absent' => 3, 'marked' => true],
    ['class' => 'Class 10-B', 'total' => 42, 'present' => 0, 'absent' => 0, 'marked' => false],
    ['class' => 'Class 9-B', 'total' => 36, 'present' => 0, 'absent' => 0, 'marked' => false],
];

$homeworks = [
    ['class' => 'Class 10-A', 'subject' => 'English', 'task' => 'Essay: My Role Model', 'date' => '10 Jan', 'submissions' => 32, 'total' => 40],
    ['class' => 'Class 9-A', 'subject' => 'English', 'task' => 'Chapter 5 Exercise', 'date' => '09 Jan', 'submissions' => 35, 'total' => 38],
    ['class' => 'Class 10-A', 'subject' => 'Grammar', 'task' => 'Tenses Worksheet', 'date' => '08 Jan', 'submissions' => 38, 'total' => 40],
    ['class' => 'Class 10-B', 'subject' => 'Literature', 'task' => 'Poem Analysis', 'date' => '07 Jan', 'submissions' => 40, 'total' => 42],
];

$top_students = [
    ['name' => 'Aarav Sharma', 'class' => '10-A', 'marks' => 95],
    ['name' => 'Priya Verma', 'class' => '10-A', 'marks' => 92],
    ['name' => 'Rohan Kumar', 'class' => '10-B', 'marks' => 89],
    ['name' => 'Ananya Singh', 'class' => '9-A', 'marks' => 88],
];

$notices = [
    ['title' => 'Staff Meeting at 4 PM today', 'date' => '15 Jan', 'type' => 'admin'],
    ['title' => 'Half Yearly Exam Schedule', 'date' => '10 Jan', 'type' => 'exam'],
    ['title' => 'PTM on 10th Feb', 'date' => '08 Jan', 'type' => 'event'],
];

$leaves = [
    ['name' => 'Aarav Sharma', 'class' => '10-A', 'reason' => 'Medical', 'dates' => '12 Jan - 14 Jan'],
    ['name' => 'Priya Verma', 'class' => '10-A', 'reason' => 'Family Function', 'dates' => '18 Jan'],
];

$students_list = [
    ['id' => 'SPS2024001', 'name' => 'Aarav Sharma', 'class' => '10-A', 'roll' => '10A01', 'phone' => '+91 98765 43211'],
    ['id' => 'SPS2024002', 'name' => 'Priya Verma', 'class' => '10-A', 'roll' => '10A02', 'phone' => '+91 98765 43212'],
    ['id' => 'SPS2024003', 'name' => 'Rohan Kumar', 'class' => '10-B', 'roll' => '10B07', 'phone' => '+91 98765 43213'],
    ['id' => 'SPS2024004', 'name' => 'Ananya Singh', 'class' => '9-A', 'roll' => '09A22', 'phone' => '+91 98765 43214'],
    ['id' => 'SPS2024005', 'name' => 'Vivek Reddy', 'class' => '9-A', 'roll' => '09A05', 'phone' => '+91 98765 43215'],
];

$my_classes = [
    ['name' => 'Class 10-A', 'students' => 40, 'subject' => 'English', 'room' => 'R-101'],
    ['name' => 'Class 9-A', 'students' => 38, 'subject' => 'English', 'room' => 'R-205'],
    ['name' => 'Class 10-B', 'students' => 42, 'subject' => 'Grammar', 'room' => 'R-102'],
    ['name' => 'Class 9-B', 'students' => 36, 'subject' => 'English', 'room' => 'R-206'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace('-', ' ', $page)); ?> | Teacher Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        :root {
            --primary: #7c3aed;
            --primary-light: #8b5cf6;
            --primary-dark: #6d28d9;
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
        .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }
        .stat-card.green::before { background: linear-gradient(90deg, #10b981, #059669); }
        .stat-card.orange::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .stat-card.blue::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }

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
        .stat-card.purple .stat-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .stat-card.green .stat-icon { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-card.orange .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-card.blue .stat-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }

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

        /* CLASS ITEM */
        .class-item {
            display: flex; gap: 15px;
            padding: 15px 18px; background: var(--light);
            border-radius: 12px; margin-bottom: 12px;
            border-left: 4px solid; transition: all 0.3s ease;
            align-items: center;
        }
        .class-item:hover { transform: translateX(5px); background: #f1f5f9; }
        .class-item.done { border-left-color: var(--green); opacity: 0.7; }
        .class-item.ongoing { border-left-color: var(--secondary); background: #fef3c7; }
        .class-item.upcoming { border-left-color: var(--blue); }

        .class-time {
            min-width: 100px; font-size: 12px;
            font-weight: 700; color: var(--primary);
            display: flex; align-items: center; gap: 6px;
        }
        .class-time i { color: var(--secondary); }
        .class-info { flex: 1; min-width: 0; }
        .class-info h4 { font-size: 14px; color: var(--primary); font-weight: 700; margin-bottom: 3px; }
        .class-info p { font-size: 12px; color: var(--gray); }
        .class-status {
            padding: 5px 14px; border-radius: 20px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .class-status.done { background: #d1fae5; color: #065f46; }
        .class-status.ongoing { background: var(--secondary); color: var(--white); }
        .class-status.upcoming { background: #dbeafe; color: #1e40af; }

        /* ATTENDANCE ROW */
        .attendance-row {
            padding: 15px 18px; background: var(--light);
            border-radius: 12px; display: flex;
            justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 12px;
            transition: all 0.3s ease;
        }
        .attendance-row:hover { background: #f1f5f9; }
        .attendance-class-info h4 { font-size: 14px; color: var(--primary); font-weight: 700; margin-bottom: 3px; }
        .attendance-class-info p { font-size: 12px; color: var(--gray); }
        .attendance-numbers { display: flex; gap: 15px; align-items: center; }
        .att-number { text-align: center; }
        .att-number strong { display: block; font-size: 16px; font-weight: 800; }
        .att-number.present strong { color: var(--green); }
        .att-number.absent strong { color: var(--red); }
        .att-number span { font-size: 10px; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; }
        .att-marked-badge {
            padding: 5px 14px; border-radius: 20px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .att-marked-badge.done { background: #d1fae5; color: #065f46; }
        .att-marked-badge.pending { background: #fee2e2; color: #991b1b; }

        /* TOP STUDENTS */
        .student-row {
            display: flex; align-items: center;
            gap: 12px; padding: 12px 15px;
            background: var(--light); border-radius: 12px;
            margin-bottom: 10px; transition: all 0.3s ease;
        }
        .student-row:hover { background: #f1f5f9; transform: translateX(5px); }
        .student-avatar {
            width: 45px; height: 45px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white); display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; border: 2px solid var(--secondary);
            flex-shrink: 0;
        }
        .student-info { flex: 1; min-width: 0; }
        .student-info h4 { font-size: 13px; color: var(--primary); font-weight: 700; margin-bottom: 2px; }
        .student-info p { font-size: 11px; color: var(--gray); }
        .student-marks {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white); padding: 6px 14px;
            border-radius: 20px; font-size: 13px; font-weight: 800;
        }

        /* HOMEWORK ITEM */
        .hw-item {
            padding: 16px 18px; background: var(--light);
            border-radius: 12px; margin-bottom: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        .hw-item:hover { transform: translateX(5px); background: #f1f5f9; }
        .hw-header {
            display: flex; justify-content: space-between;
            align-items: center; gap: 10px;
            margin-bottom: 8px; flex-wrap: wrap;
        }
        .hw-header h4 { font-size: 14px; color: var(--primary); font-weight: 700; }
        .hw-header .hw-class {
            font-size: 11px; padding: 3px 10px;
            background: var(--primary); color: var(--white);
            border-radius: 12px; font-weight: 600;
        }
        .hw-item p { font-size: 13px; color: var(--gray); margin-bottom: 10px; }
        .hw-meta {
            display: flex; gap: 15px; flex-wrap: wrap; font-size: 11px;
        }
        .hw-meta span {
            display: inline-flex; align-items: center; gap: 5px;
            color: var(--gray); font-weight: 500;
        }
        .hw-meta span i { color: var(--secondary); }
        .hw-meta .submission { color: var(--green); font-weight: 700; }

        /* LEAVE ITEM */
        .leave-item {
            padding: 15px 18px; background: #fef3c7;
            border-radius: 12px; margin-bottom: 12px;
            border-left: 4px solid var(--secondary);
            transition: all 0.3s ease;
        }
        .leave-item:hover { transform: translateX(5px); }
        .leave-header {
            display: flex; justify-content: space-between;
            align-items: center; gap: 10px;
            margin-bottom: 8px; flex-wrap: wrap;
        }
        .leave-header h4 { font-size: 14px; color: var(--primary); font-weight: 700; }
        .leave-header .leave-class {
            font-size: 11px; padding: 3px 10px;
            background: var(--primary); color: var(--white);
            border-radius: 12px; font-weight: 600;
        }
        .leave-item p { font-size: 12px; color: #78350f; margin-bottom: 12px; }
        .leave-actions { display: flex; gap: 8px; }
        .leave-btn {
            padding: 7px 16px; border-radius: 8px;
            border: none; cursor: pointer;
            font-size: 12px; font-weight: 700;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .leave-btn.approve { background: var(--green); color: var(--white); }
        .leave-btn.approve:hover { background: #059669; transform: translateY(-2px); }
        .leave-btn.reject { background: var(--red); color: var(--white); }
        .leave-btn.reject:hover { background: #dc2626; transform: translateY(-2px); }

        /* NOTICE ITEM */
        .notice-item {
            display: flex; gap: 12px; align-items: flex-start;
            padding: 14px 15px; background: var(--light);
            border-radius: 10px; margin-bottom: 10px;
            transition: all 0.3s ease;
            border-left: 3px solid var(--primary);
        }
        .notice-item:hover { background: #f1f5f9; transform: translateX(4px); }
        .notice-item.admin { border-left-color: var(--primary); }
        .notice-item.exam { border-left-color: var(--red); }
        .notice-item.event { border-left-color: var(--secondary); }
        .notice-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }
        .notice-content { flex: 1; min-width: 0; }
        .notice-content h4 {
            font-size: 13px; color: var(--primary);
            font-weight: 600; margin-bottom: 4px; line-height: 1.4;
        }
        .notice-content span {
            font-size: 11px; color: var(--gray);
            display: flex; align-items: center; gap: 5px;
        }

        /* QUICK ACTIONS */
        .quick-actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .quick-action-card {
            padding: 20px 15px;
            background: var(--light); border-radius: 12px;
            text-align: center; transition: all 0.3s ease;
            cursor: pointer; border: 2px solid transparent;
            text-decoration: none; color: inherit; display: block;
        }
        .quick-action-card:hover {
            background: var(--white);
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.15);
        }
        .quick-action-card i {
            font-size: 26px; color: var(--primary);
            margin-bottom: 10px; display: block;
        }
        .quick-action-card h4 { font-size: 13px; color: var(--dark); font-weight: 600; }

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

        .student-cell { display: flex; flex-direction: column; gap: 3px; }
        .student-cell strong { font-weight: 700; color: var(--dark); font-size: 13px; }
        .student-cell small { font-size: 11px; color: var(--gray); }

        .action-btn {
            padding: 6px 12px; border-radius: 6px;
            border: none; cursor: pointer;
            font-size: 11px; font-weight: 700;
            font-family: 'Poppins', sans-serif;
            display: inline-flex; align-items: center; gap: 4px;
            transition: all 0.3s ease;
        }
        .action-btn.view { background: #ede9fe; color: #6d28d9; }
        .action-btn.view:hover { background: var(--primary); color: var(--white); transform: translateY(-2px); }

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
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
        }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-submit { margin-top: 25px; grid-column: 1 / -1; }
        .form-submit button {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
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
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.4);
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
            .class-item { padding: 12px 15px; flex-wrap: wrap; }
            .class-time { min-width: auto; font-size: 11px; }
            .quick-actions-grid { grid-template-columns: 1fr 1fr; }
            .form-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-header h1 { font-size: 18px; }
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
            <div class="logo-icon">👨‍🏫</div>
            <div>
                <h2>Sunrise</h2>
                <span>TEACHER PANEL</span>
            </div>
        </div>
    </div>

    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search students, classes...">
    </div>

    <div class="topbar-right">
        <button class="notification-btn" onclick="alert('3 new notifications')">
            <i class="fas fa-bell"></i>
            <span class="badge">3</span>
        </button>

        <div class="user-menu">
            <div class="user-avatar"><?php echo strtoupper(substr($teacher_name, 0, 1)); ?></div>
            <div class="user-menu-info">
                <h4><?php echo htmlspecialchars($teacher_name); ?></h4>
                <span>Teacher</span>
            </div>
        </div>
    </div>
</div>


<!-- LAYOUT -->
<div class="dashboard-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-profile">
            <div class="sidebar-avatar"><?php echo strtoupper(substr($teacher_name, 0, 1)); ?></div>
            <h3><?php echo htmlspecialchars($teacher_name); ?></h3>
            <p>TEACHER</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Teaching</div>
            <a href="teacher.php?page=overview" class="<?php echo $page === 'overview' ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Overview
            </a>
            <a href="teacher.php?page=mark-attendance" class="<?php echo $page === 'mark-attendance' ? 'active' : ''; ?>">
                <i class="fas fa-user-check"></i> Mark Attendance
            </a>
            <a href="teacher.php?page=enter-marks" class="<?php echo $page === 'enter-marks' ? 'active' : ''; ?>">
                <i class="fas fa-edit"></i> Enter Marks
            </a>
            <a href="teacher.php?page=upload-homework" class="<?php echo $page === 'upload-homework' ? 'active' : ''; ?>">
                <i class="fas fa-upload"></i> Upload Homework
            </a>
            <a href="teacher.php?page=my-classes" class="<?php echo $page === 'my-classes' ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard"></i> My Classes
            </a>

            <div class="menu-label">Management</div>
            <a href="teacher.php?page=students" class="<?php echo $page === 'students' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Student List
            </a>
            <a href="teacher.php?page=leaves" class="<?php echo $page === 'leaves' ? 'active' : ''; ?>">
                <i class="fas fa-clipboard-list"></i> Leave Requests
                <span class="nav-badge">2</span>
            </a>

            <div class="menu-label">Account</div>
            <a href="teacher.php?page=notices" class="<?php echo $page === 'notices' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i> Notices
            </a>
            <a href="teacher.php?page=profile" class="<?php echo $page === 'profile' ? 'active' : ''; ?>">
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
        <!-- ================================================
             OVERVIEW
             ================================================ -->
        <div class="page-header">
            <div>
                <h1>Welcome, <span><?php echo explode(' ', $teacher_name)[0]; ?></span>! 👋</h1>
                <p>You have <strong><?php echo $stats['today_classes']; ?> classes</strong> scheduled today</p>
            </div>
            <div class="page-actions">
                <a href="teacher.php?page=mark-attendance" class="page-btn">
                    <i class="fas fa-user-check"></i> Mark Attendance
                </a>
                <a href="teacher.php?page=enter-marks" class="page-btn primary">
                    <i class="fas fa-edit"></i> Enter Marks
                </a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-chalkboard"></i></div>
                </div>
                <h3><?php echo $stats['today_classes']; ?></h3>
                <p>Today's Classes</p>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                </div>
                <h3><?php echo $stats['attendance_marked']; ?></h3>
                <p>Attendance Marked</p>
            </div>
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                </div>
                <h3><?php echo $stats['homework_active']; ?></h3>
                <p>Active Homework</p>
            </div>
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
                <h3><?php echo $stats['total_students']; ?></h3>
                <p>Total Students</p>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-calendar-day"></i> Today's Classes</h3>
                </div>
                <?php foreach ($today_classes as $cls): ?>
                <div class="class-item <?php echo $cls['status']; ?>">
                    <div class="class-time">
                        <i class="fas fa-clock"></i> <?php echo $cls['time']; ?>
                    </div>
                    <div class="class-info">
                        <h4><?php echo $cls['class']; ?> - <?php echo $cls['subject']; ?></h4>
                        <p>Room: <?php echo $cls['room']; ?></p>
                    </div>
                    <span class="class-status <?php echo $cls['status']; ?>">
                        <?php echo $cls['status'] === 'done' ? '✓ Done' : ($cls['status'] === 'ongoing' ? '● Ongoing' : '○ Upcoming'); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-trophy"></i> Top Students</h3>
                </div>
                <?php foreach ($top_students as $s): ?>
                <div class="student-row">
                    <div class="student-avatar"><?php echo strtoupper(substr($s['name'], 0, 1)); ?></div>
                    <div class="student-info">
                        <h4><?php echo $s['name']; ?></h4>
                        <p>Class <?php echo $s['class']; ?></p>
                    </div>
                    <div class="student-marks"><?php echo $s['marks']; ?>%</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="content-grid">
            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-user-check"></i> Attendance Summary - Today</h3>
                </div>
                <?php foreach ($attendance_summary as $att): ?>
                <div class="attendance-row">
                    <div class="attendance-class-info">
                        <h4><?php echo $att['class']; ?></h4>
                        <p>Total Students: <?php echo $att['total']; ?></p>
                    </div>
                    <?php if ($att['marked']): ?>
                        <div class="attendance-numbers">
                            <div class="att-number present">
                                <strong><?php echo $att['present']; ?></strong>
                                <span>Present</span>
                            </div>
                            <div class="att-number absent">
                                <strong><?php echo $att['absent']; ?></strong>
                                <span>Absent</span>
                            </div>
                        </div>
                        <span class="att-marked-badge done">✓ Marked</span>
                    <?php else: ?>
                        <a href="teacher.php?page=mark-attendance" class="page-btn primary" style="padding: 8px 16px; font-size: 12px;">
                            <i class="fas fa-check"></i> Mark Now
                        </a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bullhorn"></i> Recent Notices</h3>
                    <a href="teacher.php?page=notices">View All <i class="fas fa-arrow-right"></i></a>
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
                    <h3><i class="fas fa-book"></i> Recent Homework</h3>
                    <a href="teacher.php?page=upload-homework">Upload New <i class="fas fa-plus"></i></a>
                </div>
                <?php foreach (array_slice($homeworks, 0, 3) as $hw): 
                    $pct = round(($hw['submissions'] / $hw['total']) * 100);
                ?>
                <div class="hw-item">
                    <div class="hw-header">
                        <h4><?php echo $hw['subject']; ?></h4>
                        <span class="hw-class"><?php echo $hw['class']; ?></span>
                    </div>
                    <p><?php echo $hw['task']; ?></p>
                    <div class="hw-meta">
                        <span><i class="fas fa-calendar"></i> <?php echo $hw['date']; ?></span>
                        <span class="submission">
                            <i class="fas fa-check-circle"></i> 
                            <?php echo $hw['submissions']; ?>/<?php echo $hw['total']; ?> (<?php echo $pct; ?>%)
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="content-card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    <a href="teacher.php?page=mark-attendance" class="quick-action-card">
                        <i class="fas fa-user-check"></i>
                        <h4>Mark Attendance</h4>
                    </a>
                    <a href="teacher.php?page=enter-marks" class="quick-action-card">
                        <i class="fas fa-edit"></i>
                        <h4>Enter Marks</h4>
                    </a>
                    <a href="teacher.php?page=upload-homework" class="quick-action-card">
                        <i class="fas fa-upload"></i>
                        <h4>Upload Homework</h4>
                    </a>
                    <a href="teacher.php?page=students" class="quick-action-card">
                        <i class="fas fa-users"></i>
                        <h4>Student List</h4>
                    </a>
                </div>
            </div>
        </div>

        <?php elseif ($page === 'mark-attendance'): ?>
        <!-- MARK ATTENDANCE -->
        <div class="page-header">
            <div>
                <h1>Mark <span>Attendance</span></h1>
                <p>Record today's attendance for your classes</p>
            </div>
            <a href="teacher.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="mark_attendance">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Class <span class="req">*</span></label>
                        <select name="class" required>
                            <option value="">Select Class</option>
                            <option>Class 10-A</option>
                            <option>Class 9-A</option>
                            <option>Class 10-B</option>
                            <option>Class 9-B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Present Students <span class="req">*</span></label>
                        <input type="number" name="present" min="0" placeholder="e.g. 38" required>
                    </div>
                    <div class="form-group">
                        <label>Absent Students <span class="req">*</span></label>
                        <input type="number" name="absent" min="0" placeholder="e.g. 2" required>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-check"></i> Mark Attendance
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'enter-marks'): ?>
        <!-- ENTER MARKS -->
        <div class="page-header">
            <div>
                <h1>Enter <span>Marks</span></h1>
                <p>Update student exam scores</p>
            </div>
            <a href="teacher.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="enter_marks">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Student Name <span class="req">*</span></label>
                        <input type="text" name="student" placeholder="Enter student name" required>
                    </div>
                    <div class="form-group">
                        <label>Subject <span class="req">*</span></label>
                        <select name="subject" required>
                            <option value="">Select Subject</option>
                            <option>English</option>
                            <option>Grammar</option>
                            <option>Literature</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Marks (out of 100) <span class="req">*</span></label>
                        <input type="number" name="marks" min="0" max="100" placeholder="e.g. 85" required>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-save"></i> Save Marks
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'upload-homework'): ?>
        <!-- UPLOAD HOMEWORK -->
        <div class="page-header">
            <div>
                <h1>Upload <span>Homework</span></h1>
                <p>Share assignments with students</p>
            </div>
            <a href="teacher.php?page=overview" class="page-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="content-card">
            <form method="POST">
                <input type="hidden" name="action" value="upload_homework">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Class <span class="req">*</span></label>
                        <select name="class" required>
                            <option value="">Select Class</option>
                            <option>Class 10-A</option>
                            <option>Class 9-A</option>
                            <option>Class 10-B</option>
                            <option>Class 9-B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject <span class="req">*</span></label>
                        <select name="subject" required>
                            <option value="">Select Subject</option>
                            <option>English</option>
                            <option>Grammar</option>
                            <option>Literature</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Homework Task <span class="req">*</span></label>
                        <textarea name="task" placeholder="Describe the homework..." required></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit">
                            <i class="fas fa-upload"></i> Upload Homework
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php elseif ($page === 'my-classes'): ?>
        <!-- MY CLASSES -->
        <div class="page-header">
            <div>
                <h1>My <span>Classes</span></h1>
                <p>All classes you teach</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>Class</th><th>Subject</th><th>Students</th><th>Room</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($my_classes as $c): ?>
                        <tr>
                            <td><strong><?php echo $c['name']; ?></strong></td>
                            <td><?php echo $c['subject']; ?></td>
                            <td><?php echo $c['students']; ?></td>
                            <td><?php echo $c['room']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'students'): ?>
        <!-- STUDENTS -->
        <div class="page-header">
            <div>
                <h1>Student <span>List</span></h1>
                <p>Total <?php echo count($students_list); ?> students</p>
            </div>
        </div>
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Class</th><th>Roll</th><th>Phone</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students_list as $s): ?>
                        <tr>
                            <td><strong><?php echo $s['id']; ?></strong></td>
                            <td><?php echo $s['name']; ?></td>
                            <td><?php echo $s['class']; ?></td>
                            <td><?php echo $s['roll']; ?></td>
                            <td><?php echo $s['phone']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php elseif ($page === 'leaves'): ?>
        <!-- LEAVE REQUESTS -->
        <div class="page-header">
            <div>
                <h1>Leave <span>Requests</span></h1>
                <p><?php echo count($leaves); ?> pending requests</p>
            </div>
        </div>
        <?php foreach ($leaves as $l): ?>
        <div class="leave-item">
            <div class="leave-header">
                <h4><?php echo $l['name']; ?></h4>
                <span class="leave-class"><?php echo $l['class']; ?></span>
            </div>
            <p>
                <strong>Reason:</strong> <?php echo $l['reason']; ?><br>
                <strong>Dates:</strong> <?php echo $l['dates']; ?>
            </p>
            <div class="leave-actions">
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="approve_leave">
                    <input type="hidden" name="student" value="<?php echo $l['name']; ?>">
                    <button type="submit" class="leave-btn approve">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="reject_leave">
                    <input type="hidden" name="student" value="<?php echo $l['name']; ?>">
                    <button type="submit" class="leave-btn reject">
                        <i class="fas fa-times"></i> Reject
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>

        <?php elseif ($page === 'notices'): ?>
        <!-- NOTICES -->
        <div class="page-header">
            <div>
                <h1>Recent <span>Notices</span></h1>
                <p>School announcements</p>
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
            <div class="student-row" style="padding: 25px;">
                <div class="student-avatar" style="width: 80px; height: 80px; font-size: 32px;">
                    <?php echo strtoupper(substr($teacher_name, 0, 1)); ?>
                </div>
                <div class="student-info">
                    <h4 style="font-size: 20px;"><?php echo htmlspecialchars($teacher_name); ?></h4>
                    <p style="font-size: 14px;"><?php echo htmlspecialchars($teacher_email); ?></p>
                    <p style="font-size: 13px; margin-top: 5px; color: var(--primary); font-weight: 700;">TEACHER</p>
                </div>
            </div>
        </div>

        <?php else: ?>
        <div class="page-header">
            <div>
                <h1>Page <span>Not Found</span></h1>
                <p>This page doesn't exist in teacher panel.</p>
            </div>
            <a href="teacher.php" class="page-btn primary">
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