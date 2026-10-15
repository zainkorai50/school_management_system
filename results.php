<?php
// ============================================
// Sunrise Public School - Results Page
// Public Result Check + Report Card
// ============================================

// ---------- DEMO STUDENT DATABASE ----------
$students_db = [
    'SPS2024001' => [
        'password_dob' => '2008-08-15',
        'name' => 'Aarav Sharma',
        'father' => 'Mr. Rajesh Sharma',
        'mother' => 'Mrs. Sunita Sharma',
        'class' => 'Class 10-A',
        'roll' => '10A01',
        'session' => '2024-25',
        'photo' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=300',
        'subjects' => [
            ['name' => 'English', 'marks' => 87, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Hindi', 'marks' => 82, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Mathematics', 'marks' => 95, 'total' => 100, 'grade' => 'A+'],
            ['name' => 'Science', 'marks' => 89, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Social Science', 'marks' => 78, 'total' => 100, 'grade' => 'B+'],
            ['name' => 'Computer Science', 'marks' => 92, 'total' => 100, 'grade' => 'A+'],
        ],
        'attendance' => 93.18,
        'rank' => 3,
        'total_students' => 42,
        'remarks' => 'Excellent performance! Keep it up. Focus on Social Science for even better results.',
    ],
    'SPS2024002' => [
        'password_dob' => '2009-05-22',
        'name' => 'Priya Verma',
        'father' => 'Mr. Suresh Verma',
        'mother' => 'Mrs. Anita Verma',
        'class' => 'Class 9-B',
        'roll' => '09B15',
        'session' => '2024-25',
        'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300',
        'subjects' => [
            ['name' => 'English', 'marks' => 92, 'total' => 100, 'grade' => 'A+'],
            ['name' => 'Hindi', 'marks' => 88, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Mathematics', 'marks' => 85, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Science', 'marks' => 94, 'total' => 100, 'grade' => 'A+'],
            ['name' => 'Social Science', 'marks' => 90, 'total' => 100, 'grade' => 'A+'],
            ['name' => 'Computer Science', 'marks' => 96, 'total' => 100, 'grade' => 'A+'],
        ],
        'attendance' => 96.5,
        'rank' => 1,
        'total_students' => 38,
        'remarks' => 'Outstanding! You are a top performer. Continue this excellence.',
    ],
    'SPS2024003' => [
        'password_dob' => '2007-12-10',
        'name' => 'Rohan Kumar',
        'father' => 'Mr. Suresh Kumar',
        'mother' => 'Mrs. Meera Kumar',
        'class' => 'Class 12-A',
        'roll' => '12A07',
        'session' => '2024-25',
        'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300',
        'subjects' => [
            ['name' => 'English', 'marks' => 85, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Physics', 'marks' => 78, 'total' => 100, 'grade' => 'B+'],
            ['name' => 'Chemistry', 'marks' => 82, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Mathematics', 'marks' => 88, 'total' => 100, 'grade' => 'A'],
            ['name' => 'Computer Science', 'marks' => 91, 'total' => 100, 'grade' => 'A+'],
        ],
        'attendance' => 89.5,
        'rank' => 5,
        'total_students' => 40,
        'remarks' => 'Good performance. Work harder on Physics to improve overall percentage.',
    ],
];

// ---------- HANDLE SEARCH ----------
$result = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = strtoupper(trim($_POST['student_id'] ?? ''));
    $dob = trim($_POST['dob'] ?? '');

    if (empty($student_id) || empty($dob)) {
        $error = "Please enter both Student ID and Date of Birth!";
    } elseif (!isset($students_db[$student_id])) {
        $error = "Student ID not found! Please check and try again.";
    } elseif ($students_db[$student_id]['password_dob'] !== $dob) {
        $error = "Date of Birth does not match our records!";
    } else {
        $result = $students_db[$student_id];
        $result['student_id'] = $student_id;

        // Calculate totals
        $total_marks = 0;
        $total_max = 0;
        foreach ($result['subjects'] as $s) {
            $total_marks += $s['marks'];
            $total_max += $s['total'];
        }
        $result['total_marks'] = $total_marks;
        $result['total_max'] = $total_max;
        $result['percentage'] = round(($total_marks / $total_max) * 100, 2);
        $result['overall_grade'] = $result['percentage'] >= 90 ? 'A+' : 
                                  ($result['percentage'] >= 80 ? 'A' : 
                                  ($result['percentage'] >= 70 ? 'B+' : 
                                  ($result['percentage'] >= 60 ? 'B' : 'C')));
        $result['status'] = $result['percentage'] >= 33 ? 'PASS' : 'FAIL';
        $result['result_date'] = date('d M Y');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results | Sunrise Public School</title>

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

        /* SEARCH SECTION */
        .search-section {
            padding: 80px 0 60px;
            background: var(--light);
        }

        .search-container {
            max-width: 700px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 25px 60px rgba(30, 58, 138, 0.15);
            overflow: hidden;
            position: relative;
        }

        .search-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 35px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .search-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 250px;
            height: 250px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .search-header > * { position: relative; z-index: 2; }

        .search-header .search-icon-box {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: var(--secondary);
            margin: 0 auto 15px;
        }

        .search-header h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .search-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .search-body {
            padding: 40px;
        }

        .error-alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 16px 20px;
            border-radius: 12px;
            border-left: 5px solid var(--red);
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            animation: shake 0.5s ease;
        }

        .error-alert i {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .search-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .search-group { display: flex; flex-direction: column; }

        .search-group label {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .search-group label i { color: var(--secondary); }

        .search-group input {
            padding: 14px 18px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--dark);
            transition: all 0.3s ease;
            width: 100%;
        }

        .search-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        .search-submit {
            margin-top: 25px;
        }

        .search-submit .btn {
            width: 100%;
            padding: 16px 32px;
            font-size: 16px;
        }

        .demo-hint {
            margin-top: 20px;
            padding: 16px 18px;
            background: #fef3c7;
            border-radius: 12px;
            border-left: 4px solid var(--secondary);
            font-size: 13px;
            color: #78350f;
            line-height: 1.7;
        }

        .demo-hint strong {
            display: block;
            color: var(--primary);
            margin-bottom: 6px;
            font-size: 13px;
        }

        .demo-hint code {
            background: var(--white);
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: var(--primary);
        }

        /* RESULT SECTION */
        .result-section {
            padding: 40px 0 80px;
            background: var(--light);
        }

        /* Success Banner */
        .success-banner {
            background: linear-gradient(135deg, var(--green), #059669);
            color: var(--white);
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.25);
            animation: fadeUp 0.5s ease;
        }

        .success-banner-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .success-banner-text h2 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .success-banner-text p {
            font-size: 13px;
            opacity: 0.9;
        }

        /* Report Card Container */
        .report-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            animation: fadeUp 0.6s ease;
            position: relative;
        }

        /* Report Header */
        .report-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 40px 45px;
            position: relative;
            overflow: hidden;
        }

        .report-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .report-header::after {
            content: '';
            position: absolute;
            bottom: -60%;
            left: -5%;
            width: 250px;
            height: 250px;
            background: rgba(245, 158, 11, 0.15);
            border-radius: 50%;
        }

        .report-header > * { position: relative; z-index: 2; }

        .report-school-info {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .report-school-logo {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            flex-shrink: 0;
        }

        .report-school-text h1 {
            font-size: 26px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .report-school-text p {
            font-size: 13px;
            opacity: 0.9;
        }

        .report-title {
            text-align: center;
            padding: 15px 25px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            display: inline-block;
            margin: 0 auto 25px;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }

        .report-title h2 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }

        .report-title p {
            font-size: 12px;
            opacity: 0.85;
            letter-spacing: 1px;
        }

        /* Student Info Grid */
        .student-info-grid {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 25px;
            align-items: center;
        }

        .student-report-photo {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .student-report-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 30px;
        }

        .student-report-details .detail-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .student-report-details .detail-label {
            font-size: 11px;
            opacity: 0.7;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .student-report-details .detail-value {
            font-size: 15px;
            font-weight: 700;
        }

        .student-report-result-badge {
            text-align: center;
        }

        .result-badge {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 2px;
            background: var(--green);
            color: var(--white);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .result-badge.fail {
            background: var(--red);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
        }

        .result-rank {
            font-size: 12px;
            margin-top: 8px;
            opacity: 0.9;
        }

        /* Report Body */
        .report-body {
            padding: 40px 45px;
        }

        /* Marks Table */
        .marks-table-container {
            overflow-x: auto;
            border-radius: 15px;
            border: 2px solid var(--border);
            margin-bottom: 25px;
        }

        .marks-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .marks-table thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .marks-table thead th {
            padding: 16px 18px;
            text-align: left;
            color: var(--white);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .marks-table thead th:nth-child(2),
        .marks-table thead th:nth-child(3),
        .marks-table thead th:nth-child(4),
        .marks-table thead th:nth-child(5) { text-align: center; }

        .marks-table tbody tr {
            border-bottom: 1px solid var(--border);
        }

        .marks-table tbody tr:last-child { border-bottom: none; }
        .marks-table tbody tr:hover { background: var(--light); }

        .marks-table tbody td {
            padding: 16px 18px;
            font-size: 14px;
            vertical-align: middle;
        }

        .marks-table tbody td:nth-child(2),
        .marks-table tbody td:nth-child(3),
        .marks-table tbody td:nth-child(4),
        .marks-table tbody td:nth-child(5) { text-align: center; }

        .marks-table .subject-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .subject-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .subject-name-cell strong {
            font-size: 14px;
            color: var(--dark);
            font-weight: 600;
        }

        .marks-value {
            font-size: 15px;
            font-weight: 800;
            color: var(--primary);
        }

        .marks-total {
            font-size: 12px;
            color: var(--gray);
        }

        .marks-progress-bar {
            width: 100%;
            max-width: 120px;
            height: 6px;
            background: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin: 0 auto;
        }

        .marks-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 3px;
            transition: width 1s ease;
        }

        .grade-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .grade-badge.Aplus { background: #d1fae5; color: #065f46; }
        .grade-badge.A { background: #dbeafe; color: #1e40af; }
        .grade-badge.Bplus { background: #fef3c7; color: #92400e; }
        .grade-badge.B { background: #fed7aa; color: #9a3412; }
        .grade-badge.C { background: #fee2e2; color: #991b1b; }

        /* Summary Grid */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: var(--light);
            padding: 22px;
            border-radius: 15px;
            text-align: center;
            border-top: 4px solid;
            transition: all 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .summary-card.primary { border-top-color: var(--primary); }
        .summary-card.success { border-top-color: var(--green); }
        .summary-card.warning { border-top-color: var(--secondary); }
        .summary-card.info { border-top-color: var(--blue); }

        .summary-card h4 {
            font-size: 11px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .summary-card .summary-value {
            font-size: 26px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }

        .summary-card.primary .summary-value { color: var(--primary); }
        .summary-card.success .summary-value { color: var(--green); }
        .summary-card.warning .summary-value { color: var(--secondary); }
        .summary-card.info .summary-value { color: var(--blue); }

        .summary-card p {
            font-size: 11px;
            color: var(--gray);
            font-weight: 500;
        }

        /* Remarks Box */
        .remarks-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            padding: 25px 30px;
            border-radius: 15px;
            border-left: 5px solid var(--secondary);
            margin-bottom: 25px;
        }

        .remarks-box h4 {
            font-size: 14px;
            color: #78350f;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remarks-box h4 i { color: var(--secondary); }

        .remarks-box p {
            font-size: 14px;
            color: #78350f;
            line-height: 1.8;
            font-style: italic;
        }

        /* Signature Section */
        .signature-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 2px dashed var(--border);
        }

        .signature-item {
            text-align: center;
        }

        .signature-line {
            border-bottom: 2px solid var(--dark);
            margin-bottom: 10px;
            padding-top: 40px;
        }

        .signature-item h4 {
            font-size: 13px;
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 3px;
        }

        .signature-item p {
            font-size: 11px;
            color: var(--gray);
        }

        /* Actions */
        .report-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            justify-content: center;
        }

        .report-actions .btn {
            min-width: 180px;
        }

        /* Legend */
        .legend-box {
            background: var(--light);
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid var(--blue);
        }

        .legend-box h4 {
            font-size: 13px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-box h4 i { color: var(--secondary); }

        .legend-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 10px;
            font-size: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
        }

        .legend-color {
            width: 24px;
            height: 14px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .legend-color.aplus { background: #d1fae5; border: 1px solid #065f46; }
        .legend-color.a { background: #dbeafe; border: 1px solid #1e40af; }
        .legend-color.bplus { background: #fef3c7; border: 1px solid #92400e; }
        .legend-color.b { background: #fed7aa; border: 1px solid #9a3412; }
        .legend-color.c { background: #fee2e2; border: 1px solid #991b1b; }

        /* Info Section */
        .info-section {
            padding: 80px 0;
            background: var(--white);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .info-card {
            background: var(--light);
            padding: 35px 30px;
            border-radius: 18px;
            text-align: center;
            transition: all 0.4s ease;
            border-bottom: 4px solid transparent;
        }

        .info-card:hover {
            background: var(--white);
            transform: translateY(-10px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.12);
        }

        .info-icon {
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

        .info-card:hover .info-icon {
            background: var(--secondary);
            transform: rotate(360deg) scale(1.1);
        }

        .info-card h3 {
            font-size: 19px;
            color: var(--primary);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .info-card p {
            color: var(--gray);
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

        /* PRINT STYLES */
        @media print {
            .topbar, .navbar, .page-banner, .search-section, .info-section,
            .cta-section, .footer, #backToTop, .report-actions, .success-banner {
                display: none !important;
            }

            body { background: white; }

            .result-section { padding: 0; }

            .report-card {
                box-shadow: none;
                border: 2px solid var(--dark);
                border-radius: 0;
            }

            .report-header {
                background: var(--primary) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .summary-card, .remarks-box, .legend-box {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .page-banner h1 { font-size: 38px; }
            .page-banner p { font-size: 15px; }

            .student-info-grid { grid-template-columns: auto 1fr; }
            .student-report-result-badge { grid-column: 1 / -1; text-align: left; margin-top: 15px; }

            .summary-grid { grid-template-columns: repeat(2, 1fr); }
            .info-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }

            .signature-section { grid-template-columns: 1fr 1fr; }

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

            .search-container { border-radius: 18px; }
            .search-header { padding: 28px 25px; }
            .search-header h2 { font-size: 20px; }
            .search-header .search-icon-box { width: 55px; height: 55px; font-size: 24px; }
            .search-body { padding: 25px 22px; }
            .search-grid { grid-template-columns: 1fr; }

            .report-header { padding: 28px 22px; }
            .report-school-info { flex-direction: column; text-align: center; }
            .report-school-text h1 { font-size: 20px; }
            .report-title h2 { font-size: 16px; }

            .student-info-grid { grid-template-columns: 1fr; text-align: center; }
            .student-report-photo { margin: 0 auto; width: 90px; height: 90px; }
            .student-report-details { grid-template-columns: 1fr; text-align: left; }
            .student-report-result-badge { text-align: center; }

            .report-body { padding: 25px 20px; }

            .summary-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .summary-card { padding: 16px; }
            .summary-card .summary-value { font-size: 20px; }

            .info-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }

            .signature-section { grid-template-columns: 1fr; gap: 20px; }

            .report-actions { flex-direction: column; }
            .report-actions .btn { width: 100%; }

            .cta-section h2 { font-size: 22px; }
            .cta-section p { font-size: 14px; }

            .search-section,
            .result-section,
            .info-section { padding: 60px 0; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 22px; }
            .report-school-text h1 { font-size: 18px; }
            .summary-grid { grid-template-columns: 1fr; }
            .student-report-details { font-size: 13px; }
            .result-badge { font-size: 15px; padding: 10px 22px; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="container topbar-wrapper">
        <div class="topbar-left">
            <span><i class="fas fa-phone"></i> +91 98765 43210</span>
            <span><i class="fas fa-envelope"></i> results@sunriseschool.com</span>
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
        <h1>Check Your <span>Results</span></h1>
        <p>Enter your Student ID and Date of Birth to view your report card online.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>Results</span>
        </div>
    </div>
</section>


<!-- SEARCH SECTION -->
<section class="search-section">
    <div class="container">
        <div class="search-container reveal">

            <div class="search-header">
                <div class="search-icon-box">
                    <i class="fas fa-search"></i>
                </div>
                <h2>Result Lookup</h2>
                <p>Enter your credentials to view your report card</p>
            </div>

            <div class="search-body">

                <?php if (!empty($error)): ?>
                    <div class="error-alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <div><?php echo htmlspecialchars($error); ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="resultForm">

                    <div class="search-grid">

                        <div class="search-group">
                            <label><i class="fas fa-id-card"></i> Student ID</label>
                            <input type="text" name="student_id" placeholder="e.g. SPS2024001" required style="text-transform: uppercase;">
                        </div>

                        <div class="search-group">
                            <label><i class="fas fa-calendar-alt"></i> Date of Birth</label>
                            <input type="date" name="dob" required>
                        </div>

                    </div>

                    <div class="search-submit">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> View Result
                        </button>
                    </div>

                </form>

                <div class="demo-hint">
                    <strong><i class="fas fa-info-circle"></i> Demo Credentials for Testing:</strong>
                    Student ID: <code>SPS2024001</code> | DOB: <code>2008-08-15</code><br>
                    Student ID: <code>SPS2024002</code> | DOB: <code>2009-05-22</code><br>
                    Student ID: <code>SPS2024003</code> | DOB: <code>2007-12-10</code>
                </div>

            </div>

        </div>
    </div>
</section>


<?php if ($result): ?>
<!-- RESULT SECTION -->
<section class="result-section">
    <div class="container">

        <!-- Success Banner -->
        <div class="success-banner">
            <div class="success-banner-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="success-banner-text">
                <h2>Result Found Successfully!</h2>
                <p>Session: <?php echo $result['session']; ?> | Published on: <?php echo $result['result_date']; ?></p>
            </div>
        </div>

        <!-- Report Card -->
        <div class="report-card" id="reportCard">

            <!-- Report Header -->
            <div class="report-header">

                <div class="report-school-info">
                    <div class="report-school-logo">🎓</div>
                    <div class="report-school-text">
                        <h1>SUNRISE PUBLIC SCHOOL</h1>
                        <p>123, Main Road, Delhi - 110001 | Affiliated to CBSE</p>
                        <p>Contact: +91 98765 43210 | Email: results@sunriseschool.com</p>
                    </div>
                </div>

                <div class="report-title">
                    <h2>ANNUAL REPORT CARD</h2>
                    <p>ACADEMIC SESSION <?php echo $result['session']; ?></p>
                </div>

                <div class="student-info-grid">

                    <img class="student-report-photo" src="<?php echo $result['photo']; ?>" alt="<?php echo $result['name']; ?>">

                    <div class="student-report-details">
                        <div class="detail-item">
                            <span class="detail-label">Student Name</span>
                            <span class="detail-value"><?php echo $result['name']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Student ID</span>
                            <span class="detail-value"><?php echo $result['student_id']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Class</span>
                            <span class="detail-value"><?php echo $result['class']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Roll Number</span>
                            <span class="detail-value"><?php echo $result['roll']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Father's Name</span>
                            <span class="detail-value"><?php echo $result['father']; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Mother's Name</span>
                            <span class="detail-value"><?php echo $result['mother']; ?></span>
                        </div>
                    </div>

                    <div class="student-report-result-badge">
                        <div class="result-badge <?php echo $result['status'] === 'FAIL' ? 'fail' : ''; ?>">
                            <?php echo $result['status']; ?>
                        </div>
                        <div class="result-rank">
                            <i class="fas fa-trophy" style="color: var(--secondary);"></i>
                            Rank <?php echo $result['rank']; ?> / <?php echo $result['total_students']; ?>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Report Body -->
            <div class="report-body">

                <!-- Legend -->
                <div class="legend-box">
                    <h4><i class="fas fa-info-circle"></i> Grading System</h4>
                    <div class="legend-grid">
                        <div class="legend-item"><span class="legend-color aplus"></span> A+ = 90-100%</div>
                        <div class="legend-item"><span class="legend-color a"></span> A = 80-89%</div>
                        <div class="legend-item"><span class="legend-color bplus"></span> B+ = 70-79%</div>
                        <div class="legend-item"><span class="legend-color b"></span> B = 60-69%</div>
                        <div class="legend-item"><span class="legend-color c"></span> C = 33-59%</div>
                    </div>
                </div>

                <!-- Marks Table -->
                <div class="marks-table-container">
                    <table class="marks-table">
                        <thead>
                            <tr>
                                <th style="width: 35%;">Subject</th>
                                <th style="width: 12%;">Marks</th>
                                <th style="width: 10%;">Total</th>
                                <th style="width: 25%;">Performance</th>
                                <th style="width: 18%;">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result['subjects'] as $s): 
                                $pct = round(($s['marks'] / $s['total']) * 100);
                                $gradeClass = str_replace('+', 'plus', $s['grade']);

                                $icon = 'fa-book';
                                if (stripos($s['name'], 'math') !== false) $icon = 'fa-calculator';
                                elseif (stripos($s['name'], 'science') !== false) $icon = 'fa-atom';
                                elseif (stripos($s['name'], 'english') !== false) $icon = 'fa-language';
                                elseif (stripos($s['name'], 'hindi') !== false) $icon = 'fa-feather-alt';
                                elseif (stripos($s['name'], 'social') !== false) $icon = 'fa-globe-asia';
                                elseif (stripos($s['name'], 'computer') !== false) $icon = 'fa-laptop-code';
                                elseif (stripos($s['name'], 'physics') !== false) $icon = 'fa-magnet';
                                elseif (stripos($s['name'], 'chemistry') !== false) $icon = 'fa-flask';
                            ?>
                            <tr>
                                <td>
                                    <div class="subject-name-cell">
                                        <div class="subject-icon-box"><i class="fas <?php echo $icon; ?>"></i></div>
                                        <strong><?php echo $s['name']; ?></strong>
                                    </div>
                                </td>
                                <td><span class="marks-value"><?php echo $s['marks']; ?></span></td>
                                <td><span class="marks-total">/ <?php echo $s['total']; ?></span></td>
                                <td>
                                    <div class="marks-progress-bar">
                                        <div class="marks-progress-fill" style="width: <?php echo $pct; ?>%;"></div>
                                    </div>
                                    <div style="font-size: 11px; color: var(--gray); margin-top: 4px; text-align: center; font-weight: 600;"><?php echo $pct; ?>%</div>
                                </td>
                                <td><span class="grade-badge <?php echo $gradeClass; ?>"><?php echo $s['grade']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Summary Grid -->
                <div class="summary-grid">

                    <div class="summary-card primary">
                        <h4>Total Marks</h4>
                        <div class="summary-value"><?php echo $result['total_marks']; ?></div>
                        <p>out of <?php echo $result['total_max']; ?></p>
                    </div>

                    <div class="summary-card success">
                        <h4>Percentage</h4>
                        <div class="summary-value"><?php echo $result['percentage']; ?>%</div>
                        <p>Overall Score</p>
                    </div>

                    <div class="summary-card warning">
                        <h4>Grade</h4>
                        <div class="summary-value"><?php echo $result['overall_grade']; ?></div>
                        <p>Final Grade</p>
                    </div>

                    <div class="summary-card info">
                        <h4>Attendance</h4>
                        <div class="summary-value"><?php echo $result['attendance']; ?>%</div>
                        <p>Attendance Record</p>
                    </div>

                </div>

                <!-- Remarks -->
                <div class="remarks-box">
                    <h4><i class="fas fa-comment-dots"></i> Class Teacher's Remarks</h4>
                    <p>"<?php echo $result['remarks']; ?>"</p>
                </div>

                <!-- Signatures -->
                <div class="signature-section">
                    <div class="signature-item">
                        <div class="signature-line"></div>
                        <h4>Class Teacher</h4>
                        <p>Signature</p>
                    </div>
                    <div class="signature-item">
                        <div class="signature-line"></div>
                        <h4>Principal</h4>
                        <p>Signature</p>
                    </div>
                    <div class="signature-item">
                        <div class="signature-line"></div>
                        <h4>Parent / Guardian</h4>
                        <p>Signature</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="report-actions">
                    <button class="btn btn-green" onclick="printResult()">
                        <i class="fas fa-print"></i> Print Report Card
                    </button>
                    <button class="btn btn-primary" onclick="downloadResult()">
                        <i class="fas fa-download"></i> Download PDF
                    </button>
                    <button class="btn btn-outline" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
                        <i class="fas fa-search"></i> Search Another
                    </button>
                </div>

            </div>

        </div>

    </div>
</section>
<?php endif; ?>


<!-- INFO SECTION -->
<section class="info-section">
    <div class="container">
        <div class="section-header reveal" style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
            <span class="section-tag" style="display: inline-block; color: var(--secondary); font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px; position: relative; padding-left: 30px;">Helpful Info</span>
            <h2 style="font-size: 36px; font-weight: 800; color: var(--dark); margin-bottom: 15px;">Need <span style="color: var(--primary);">Help</span>?</h2>
            <p style="color: var(--gray); font-size: 16px;">Get all the information you need about results.</p>
        </div>

        <div class="info-grid">

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-id-card"></i></div>
                <h3>Forgot Student ID?</h3>
                <p>Contact your class teacher or the school office to retrieve your Student ID.</p>
            </div>

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-file-alt"></i></div>
                <h3>Result Not Found?</h3>
                <p>Make sure you enter the correct Date of Birth as per school records.</p>
            </div>

            <div class="info-card reveal">
                <div class="info-icon"><i class="fas fa-redo"></i></div>
                <h3>Re-evaluation</h3>
                <p>For re-checking or re-evaluation, contact the exam department within 7 days.</p>
            </div>

        </div>
    </div>
</section>


<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <h2>Have Questions About Your Result?</h2>
        <p>Our exam department is here to help you with any queries.</p>
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
                        <li><a href="results.php">→ Check Result</a></li>
                        <li><a href="notice.php">→ Notice Board</a></li>
                        <li><a href="fee-payment.php">→ Pay Fees</a></li>
                        <li><a href="student-login.php">→ Student Login</a></li>
                        <li><a href="contact.php">→ Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Get In Touch</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123, Main Road, Delhi, India - 110001</li>
                        <li><i class="fas fa-phone"></i> +91 98765 43210</li>
                        <li><i class="fas fa-envelope"></i> results@sunriseschool.com</li>
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

    // PRINT RESULT
    function printResult() {
        window.print();
    }

    // DOWNLOAD RESULT AS TEXT
    function downloadResult() {
        <?php if ($result): ?>
        const studentName = '<?php echo $result['name']; ?>';
        const studentId = '<?php echo $result['student_id']; ?>';
        const className = '<?php echo $result['class']; ?>';
        const roll = '<?php echo $result['roll']; ?>';
        const totalMarks = '<?php echo $result['total_marks']; ?>';
        const totalMax = '<?php echo $result['total_max']; ?>';
        const percentage = '<?php echo $result['percentage']; ?>';
        const grade = '<?php echo $result['overall_grade']; ?>';
        const status = '<?php echo $result['status']; ?>';
        const attendance = '<?php echo $result['attendance']; ?>';
        const rank = '<?php echo $result['rank']; ?>';
        const totalStudents = '<?php echo $result['total_students']; ?>';

        let content = '';
        content += "================================================\n";
        content += "        SUNRISE PUBLIC SCHOOL - REPORT CARD     \n";
        content += "================================================\n\n";
        content += "Student Name: " + studentName + "\n";
        content += "Student ID: " + studentId + "\n";
        content += "Class: " + className + "\n";
        content += "Roll Number: " + roll + "\n\n";
        content += "------------------------------------------------\n";
        content += "SUBJECT-WISE MARKS\n";
        content += "------------------------------------------------\n";

        <?php foreach ($result['subjects'] as $s): ?>
        content += "<?php echo str_pad($s['name'], 20); ?> : <?php echo $s['marks']; ?>/<?php echo $s['total']; ?> (Grade: <?php echo $s['grade']; ?>)\n";
        <?php endforeach; ?>

        content += "------------------------------------------------\n";
        content += "SUMMARY\n";
        content += "------------------------------------------------\n";
        content += "Total Marks: " + totalMarks + "/" + totalMax + "\n";
        content += "Percentage: " + percentage + "%\n";
        content += "Overall Grade: " + grade + "\n";
        content += "Result Status: " + status + "\n";
        content += "Attendance: " + attendance + "%\n";
        content += "Rank: " + rank + " / " + totalStudents + "\n\n";
        content += "------------------------------------------------\n";
        content += "Generated on: <?php echo date('d M Y, h:i A'); ?>\n";
        content += "Sunrise Public School\n";
        content += "================================================\n";

        const blob = new Blob([content], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'Report_Card_' + studentId + '_' + studentName.replace(/\s+/g, '_') + '.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);

        alert('✅ Report card downloaded: ' + a.download);
        <?php else: ?>
        alert('Please search for a result first!');
        <?php endif; ?>
    }

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

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // AUTO SCROLL TO RESULT
    <?php if ($result): ?>
    window.addEventListener('load', () => {
        setTimeout(() => {
            const resultSection = document.querySelector('.result-section');
            if (resultSection) {
                resultSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 400);
    });
    <?php endif; ?>

    window.addEventListener('scroll', handleScroll);
    window.addEventListener('load', handleScroll);
</script>

</body>
</html>