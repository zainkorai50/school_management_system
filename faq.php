<?php
// ============================================
// Sunrise Public School - FAQ / Help Page
// Searchable FAQs + Categories + Support
// ============================================

// ---------- FAQ DATA ----------
$faqs = [
    // ADMISSION
    [
        'id' => 1,
        'category' => 'admission',
        'question' => 'What is the admission procedure for the new session?',
        'answer' => 'The admission process is simple and fully online:
        1. Visit our Admission page and fill out the online application form.
        2. Upload required documents (birth certificate, Aadhar, photos, etc.).
        3. Our team will verify your application within 2-3 working days.
        4. You will receive an admission confirmation via email/SMS.
        5. Pay the admission fee online to complete the process.',
        'helpful' => 245,
    ],
    [
        'id' => 2,
        'category' => 'admission',
        'question' => 'What documents are required for admission?',
        'answer' => 'Required documents for admission:
        • Birth Certificate (photocopy)
        • Aadhar Card of student and parents
        • Passport size photographs (4 copies)
        • Medical fitness certificate
        • Transfer Certificate (if applicable)
        • Previous class marksheet/report card',
        'helpful' => 189,
    ],
    [
        'id' => 3,
        'category' => 'admission',
        'question' => 'What is the age criteria for different classes?',
        'answer' => 'Age criteria for admission:
        • Nursery: 3-4 years
        • LKG: 4-5 years
        • UKG: 5-6 years
        • Class 1-5: 6-10 years
        • Class 6-8: 11-13 years
        • Class 9-10: 14-15 years
        • Class 11-12: 16-18 years
        Age is calculated as on 31st March of the admission year.',
        'helpful' => 156,
    ],
    [
        'id' => 4,
        'category' => 'admission',
        'question' => 'Is there any entrance test for admission?',
        'answer' => 'For Nursery to Class 1, there is no entrance test. For Class 2 and above, a basic assessment test is conducted to evaluate the student\'s level. For Class 11, admission is based on Class 10 board results.',
        'helpful' => 98,
    ],

    // FEES
    [
        'id' => 5,
        'category' => 'fees',
        'question' => 'How can I pay the school fees?',
        'answer' => 'We offer multiple payment options:
        • Online: UPI, Credit/Debit Card, Net Banking, Wallet (via our website)
        • Offline: Cash/Cheque at the school accounts office
        • Bank Transfer: NEFT/RTGS to school\'s bank account
        All online payments receive an instant receipt via email.',
        'helpful' => 312,
    ],
    [
        'id' => 6,
        'category' => 'fees',
        'question' => 'What is the fee structure for different classes?',
        'answer' => 'Fee structure for session 2024-25:
        • Pre-Primary (Nursery-UKG): ₹25,000/year
        • Primary & Middle (Class 1-8): ₹45,000/year
        • Secondary (Class 9-10): ₹65,000/year
        • Senior Secondary (Class 11-12): ₹75,000/year
        Additional charges: Transport, Exam, Sports (optional).',
        'helpful' => 267,
    ],
    [
        'id' => 7,
        'category' => 'fees',
        'question' => 'Is there any late fee for delayed payment?',
        'answer' => 'Yes, a late fee of ₹500 is applicable if fees are not paid by the due date. For payments delayed beyond 30 days, an additional ₹100 per week penalty applies. We recommend paying online to avoid any late fees.',
        'helpful' => 145,
    ],
    [
        'id' => 8,
        'category' => 'fees',
        'question' => 'Are scholarships available for meritorious students?',
        'answer' => 'Yes! We offer merit-based scholarships:
        • 100% fee waiver: Students scoring 95%+ in board exams
        • 50% fee waiver: Students scoring 90-94%
        • 25% fee waiver: Students scoring 85-89%
        Additionally, sports quota and single-girl-child scholarships are available.',
        'helpful' => 178,
    ],

    // ACADEMICS
    [
        'id' => 9,
        'category' => 'academics',
        'question' => 'What is the school timing?',
        'answer' => 'School timings:
        • Pre-Primary: 8:30 AM - 12:00 PM
        • Primary (Class 1-5): 8:00 AM - 2:00 PM
        • Middle & Secondary (Class 6-10): 7:45 AM - 2:15 PM
        • Senior Secondary (Class 11-12): 7:45 AM - 2:30 PM
        • Office Hours: 8:00 AM - 4:00 PM (Mon-Fri), 8:00 AM - 12:00 PM (Sat)',
        'helpful' => 289,
    ],
    [
        'id' => 10,
        'category' => 'academics',
        'question' => 'Which board is the school affiliated to?',
        'answer' => 'Sunrise Public School is affiliated to the Central Board of Secondary Education (CBSE), New Delhi. Our affiliation number is 1234567. We follow the NCERT curriculum and CBSE examination pattern.',
        'helpful' => 167,
    ],
    [
        'id' => 11,
        'category' => 'academics',
        'question' => 'What subjects are offered in Class 11 and 12?',
        'answer' => 'We offer three streams in Class 11-12:
        • Science: Physics, Chemistry, Maths/Biology, English, Computer
        • Commerce: Accountancy, Business Studies, Economics, English, IP
        • Arts: History, Geography, Political Science, Economics, English
        Students can choose elective subjects as per their career goals.',
        'helpful' => 198,
    ],
    [
        'id' => 12,
        'category' => 'academics',
        'question' => 'How often are exams conducted?',
        'answer' => 'Assessment pattern:
        • Weekly Tests: Every Friday
        • Unit Tests: Monthly (3 per year)
        • Half Yearly: September-October
        • Pre-Board: January (for Class 10 & 12)
        • Annual Exam: February-March
        Continuous Comprehensive Evaluation (CCE) is followed for all classes.',
        'helpful' => 234,
    ],

    // TRANSPORT
    [
        'id' => 13,
        'category' => 'transport',
        'question' => 'Is transport facility available for all areas?',
        'answer' => 'Yes, we have a wide transport network covering most areas of the city. Currently, 25+ buses operate on different routes covering a 20 km radius. You can check route availability at the school transport office or call +91 98765 43212.',
        'helpful' => 145,
    ],
    [
        'id' => 14,
        'category' => 'transport',
        'question' => 'What is the school bus fee?',
        'answer' => 'Bus fee structure (annual):
        • 0-5 km: ₹8,000
        • 5-10 km: ₹10,000
        • 10-15 km: ₹12,000
        • 15-20 km: ₹15,000
        Fees can be paid annually or in two installments. GPS tracking is available for all buses.',
        'helpful' => 121,
    ],
    [
        'id' => 15,
        'category' => 'transport',
        'question' => 'Is there a GPS tracking facility for buses?',
        'answer' => 'Yes! All our school buses are equipped with GPS tracking. Parents can track their child\'s bus in real-time through our mobile app. You will receive notifications when the bus is 5 minutes away from your stop.',
        'helpful' => 98,
    ],

    // RESULTS
    [
        'id' => 16,
        'category' => 'results',
        'question' => 'How can I check my child\'s result online?',
        'answer' => 'To check results online:
        1. Visit our Results page
        2. Enter your child\'s Student ID (e.g., SPS2024001)
        3. Enter Date of Birth as per school records
        4. Click "View Result"
        5. View, print, or download the report card
        Results are also accessible through the Student and Parent portals.',
        'helpful' => 356,
    ],
    [
        'id' => 17,
        'category' => 'results',
        'question' => 'When are the results declared?',
        'answer' => 'Result declaration schedule:
        • Unit Tests: Within 7 days of exam
        • Half Yearly: Within 15 days
        • Pre-Board: Within 10 days
        • Board Results: As per CBSE announcement (usually May)
        • Annual Results: By 31st March
        Results are published on the website and communicated via SMS/email.',
        'helpful' => 201,
    ],
    [
        'id' => 18,
        'category' => 'results',
        'question' => 'What if I find an error in my result?',
        'answer' => 'If you find any discrepancy in your result:
        1. Contact your class teacher immediately
        2. Submit a written application to the exam department
        3. Re-evaluation request must be submitted within 7 days
        4. A nominal fee of ₹200 per subject applies for re-checking
        5. Results will be updated within 10 working days',
        'helpful' => 87,
    ],

    // TECHNICAL
    [
        'id' => 19,
        'category' => 'technical',
        'question' => 'I forgot my portal password. How to reset it?',
        'answer' => 'To reset your password:
        1. Go to the respective login page (Student/Teacher/Parent)
        2. Click on "Forgot Password?"
        3. Enter your registered email or mobile number
        4. You will receive a reset link/code
        5. Create a new password
        If you still face issues, contact the IT helpdesk at +91 98765 43215.',
        'helpful' => 278,
    ],
    [
        'id' => 20,
        'category' => 'technical',
        'question' => 'The website is not loading properly. What should I do?',
        'answer' => 'Try these troubleshooting steps:
        1. Refresh the page (Ctrl+F5)
        2. Clear browser cache and cookies
        3. Try a different browser (Chrome, Firefox, Edge)
        4. Check your internet connection
        5. Disable browser extensions temporarily
        If the issue persists, contact IT support at support@sunriseschool.com',
        'helpful' => 156,
    ],
    [
        'id' => 21,
        'category' => 'technical',
        'question' => 'Is the website mobile-friendly?',
        'answer' => 'Yes! Our website is fully responsive and optimized for all devices — mobile phones, tablets, laptops, and desktops. You can access all features including fee payment, results, and portals from any device.',
        'helpful' => 112,
    ],

    // GENERAL
    [
        'id' => 22,
        'category' => 'general',
        'question' => 'How can I contact the school administration?',
        'answer' => 'You can reach us through multiple channels:
        • Phone: +91 98765 43210 (Main), +91 98765 43211 (Admissions)
        • Email: info@sunriseschool.com
        • Visit: 123, Main Road, Delhi - 110001
        • Office Hours: Mon-Sat, 8:00 AM - 4:00 PM
        You can also use the contact form on our website.',
        'helpful' => 198,
    ],
    [
        'id' => 23,
        'category' => 'general',
        'question' => 'Is there a uniform policy? Where can I buy uniforms?',
        'answer' => 'Yes, school uniform is mandatory for all students. Uniforms can be purchased from:
        • School Uniform Shop (on campus, near Gate 2)
        • Authorized dealers: XYZ Garments (Main Market), ABC Uniforms (Sector 15)
        Summer and winter uniforms are available. PE uniform is required on sports days.',
        'helpful' => 145,
    ],
    [
        'id' => 24,
        'category' => 'general',
        'question' => 'What extracurricular activities are offered?',
        'answer' => 'We offer a wide range of extracurricular activities:
        • Sports: Cricket, Football, Basketball, Athletics, Yoga
        • Arts: Music (Vocal & Instrumental), Dance, Drama, Drawing
        • Clubs: Science Club, Robotics, Debate, Quiz, Eco Club
        • Others: Scouts & Guides, NCC, Photography
        Activities are conducted after school hours and on Saturdays.',
        'helpful' => 167,
    ],
];

// ---------- CATEGORY COUNTS ----------
$category_counts = [];
foreach ($faqs as $faq) {
    $cat = $faq['category'];
    $category_counts[$cat] = ($category_counts[$cat] ?? 0) + 1;
}

// ---------- HELP CATEGORIES ----------
$categories = [
    'admission' => ['icon' => 'fa-user-plus', 'color' => 'blue', 'label' => 'Admission'],
    'fees' => ['icon' => 'fa-rupee-sign', 'color' => 'green', 'label' => 'Fees & Payment'],
    'academics' => ['icon' => 'fa-graduation-cap', 'color' => 'purple', 'label' => 'Academics'],
    'transport' => ['icon' => 'fa-bus', 'color' => 'orange', 'label' => 'Transport'],
    'results' => ['icon' => 'fa-chart-line', 'color' => 'pink', 'label' => 'Results'],
    'technical' => ['icon' => 'fa-laptop-code', 'color' => 'teal', 'label' => 'Technical'],
    'general' => ['icon' => 'fa-info-circle', 'color' => 'indigo', 'label' => 'General'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Help | Sunrise Public School</title>

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
            --pink: #ec4899;
            --teal: #14b8a6;
            --orange: #f97316;
            --indigo: #6366f1;
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
            color: var(--white);
            border-color: var(--white);
        }

        .btn-outline:hover {
            background: var(--white);
            color: var(--primary);
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

        /* SECTION HEADER */
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

        /* SEARCH SECTION */
        .search-hero {
            padding: 60px 0 40px;
            background: var(--white);
        }

        .search-box-big {
            max-width: 750px;
            margin: 0 auto;
            position: relative;
        }

        .search-box-big input {
            width: 100%;
            padding: 22px 65px 22px 65px;
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            color: var(--dark);
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(30, 58, 138, 0.1);
        }

        .search-box-big input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 15px 50px rgba(30, 58, 138, 0.2);
        }

        .search-box-big .search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 20px;
            pointer-events: none;
        }

        .search-box-big .clear-icon {
            position: absolute;
            right: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            cursor: pointer;
            display: none;
            background: none;
            border: none;
            padding: 5px;
            transition: color 0.3s;
        }

        .search-box-big .clear-icon:hover { color: var(--red); }
        .search-box-big .clear-icon.show { display: block; }

        .search-hint {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: var(--gray);
        }

        .search-hint strong { color: var(--primary); }

        /* CATEGORIES SECTION */
        .categories-section {
            padding: 40px 0 60px;
            background: var(--white);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 15px;
        }

        .category-card {
            background: var(--white);
            padding: 22px 15px;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.4s ease;
            border: 2px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.15);
        }

        .category-card.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            border-color: var(--secondary);
            box-shadow: 0 15px 40px rgba(30, 58, 138, 0.3);
        }

        .category-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--white);
            transition: all 0.4s ease;
        }

        .category-card.active .category-icon {
            background: rgba(255,255,255,0.2);
            transform: scale(1.1);
        }

        .category-icon.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .category-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        .category-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .category-icon.orange { background: linear-gradient(135deg, #f97316, #ea580c); }
        .category-icon.pink { background: linear-gradient(135deg, #ec4899, #db2777); }
        .category-icon.teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }
        .category-icon.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }

        .category-card h4 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .category-card p {
            font-size: 11px;
            color: var(--gray);
            transition: color 0.3s;
        }

        .category-card.active p { color: rgba(255,255,255,0.85); }

        /* FAQ SECTION */
        .faq-section {
            padding: 60px 0 100px;
            background: var(--light);
        }

        .faq-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
            padding: 20px 25px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .faq-results-count {
            font-size: 14px;
            color: var(--gray);
        }

        .faq-results-count strong {
            color: var(--primary);
            font-size: 16px;
            font-weight: 800;
        }

        .faq-sort {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--gray);
        }

        .faq-sort select {
            padding: 8px 14px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            background: var(--white);
            font-weight: 600;
            color: var(--primary);
        }

        .faq-sort select:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* FAQ Container */
        .faq-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-item {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 2px solid var(--border);
            box-shadow: 0 3px 15px rgba(0,0,0,0.03);
        }

        .faq-item:hover {
            border-color: var(--primary-light);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.08);
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
            transition: all 0.3s ease;
            user-select: none;
        }

        .faq-question:hover { background: var(--light); }
        .faq-item.active .faq-question { background: var(--light); }

        .faq-question-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .faq-number {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .faq-item.active .faq-number {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        }

        .faq-question-text {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary);
            line-height: 1.5;
        }

        .faq-toggle-icon {
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

        .faq-item.active .faq-toggle-icon {
            background: var(--secondary);
            color: var(--white);
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, padding 0.3s ease;
            padding: 0 30px;
            color: var(--gray);
            font-size: 14.5px;
            line-height: 1.9;
            white-space: pre-line;
        }

        .faq-item.active .faq-answer {
            max-height: 600px;
            padding: 0 30px 25px 83px;
        }

        .faq-answer-footer {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px dashed var(--border);
            flex-wrap: wrap;
        }

        .faq-answer-footer span {
            font-size: 12px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .helpful-btn {
            padding: 6px 14px;
            border-radius: 20px;
            background: var(--light);
            color: var(--gray);
            border: 2px solid var(--border);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .helpful-btn:hover {
            background: var(--green);
            color: var(--white);
            border-color: var(--green);
        }

        .helpful-btn.voted {
            background: var(--green);
            color: var(--white);
            border-color: var(--green);
            pointer-events: none;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 70px 20px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
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

        .no-results p {
            color: var(--gray);
            margin-bottom: 25px;
        }

        /* SUPPORT SECTION */
        .support-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .support-section::before,
        .support-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .support-section::before {
            width: 400px;
            height: 400px;
            top: -150px;
            left: -100px;
        }

        .support-section::after {
            width: 500px;
            height: 500px;
            bottom: -250px;
            right: -100px;
        }

        .support-section .section-title { color: var(--white); }
        .support-section .section-title span { color: var(--secondary); }
        .support-section .section-tag { color: var(--secondary); }
        .support-section .section-tag::before { background: var(--secondary); }
        .support-section .section-desc { color: rgba(255,255,255,0.85); }

        .support-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            position: relative;
            z-index: 2;
        }

        .support-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            padding: 35px 25px;
            border-radius: 18px;
            text-align: center;
            transition: all 0.4s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .support-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
            border-color: var(--secondary);
        }

        .support-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 20px;
            background: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--white);
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        }

        .support-card:hover .support-icon {
            transform: rotate(360deg) scale(1.1);
        }

        .support-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .support-card p {
            font-size: 13px;
            opacity: 0.85;
            line-height: 1.7;
        }

        .support-card .support-action {
            display: inline-block;
            margin-top: 15px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--secondary);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* TROUBLESHOOTING SECTION */
        .troubleshoot-section {
            padding: 100px 0;
            background: var(--white);
        }

        .troubleshoot-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .troubleshoot-card {
            background: var(--light);
            padding: 35px 30px;
            border-radius: 18px;
            transition: all 0.4s ease;
            border-bottom: 4px solid transparent;
            position: relative;
        }

        .troubleshoot-card:hover {
            background: var(--white);
            transform: translateY(-10px);
            border-bottom-color: var(--secondary);
            box-shadow: 0 20px 45px rgba(30, 58, 138, 0.12);
        }

        .troubleshoot-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .troubleshoot-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            transition: all 0.4s ease;
        }

        .troubleshoot-card:hover .troubleshoot-icon {
            background: var(--secondary);
            transform: rotate(-10deg) scale(1.05);
        }

        .troubleshoot-header h3 {
            font-size: 18px;
            color: var(--primary);
            font-weight: 700;
            line-height: 1.3;
        }

        .troubleshoot-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .troubleshoot-step {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            font-size: 13.5px;
            color: var(--gray);
            line-height: 1.6;
        }

        .troubleshoot-step .step-num {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--secondary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* CONTACT CTA */
        .contact-cta {
            padding: 80px 0;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            position: relative;
            overflow: hidden;
        }

        .contact-cta::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(245, 158, 11, 0.15);
            border-radius: 50%;
        }

        .contact-cta-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .contact-cta-text h2 {
            font-size: 34px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .contact-cta-text h2 span { color: var(--secondary); }

        .contact-cta-text p {
            font-size: 16px;
            color: #78350f;
        }

        .contact-cta-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .contact-cta-buttons .btn-primary {
            background: var(--primary);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
        }

        .contact-cta-buttons .btn-primary:hover {
            background: var(--secondary);
        }

        .contact-cta-buttons .btn-outline {
            color: var(--primary);
            border-color: var(--primary);
        }

        .contact-cta-buttons .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
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

        /* LIVE CHAT BUTTON */
        .chat-btn {
            position: fixed;
            bottom: 95px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green), #059669);
            color: var(--white);
            border: none;
            cursor: pointer;
            font-size: 24px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5);
            z-index: 998;
            transition: all 0.3s ease;
            animation: chatPulse 2s infinite;
        }

        .chat-btn:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            animation-play-state: paused;
        }

        @keyframes chatPulse {
            0%, 100% { box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5); }
            50% { box-shadow: 0 10px 35px rgba(16, 185, 129, 0.8); }
        }

        /* SCROLL REVEAL */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.active { opacity: 1; transform: translateY(0); }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .categories-grid { grid-template-columns: repeat(4, 1fr); }
            .support-grid { grid-template-columns: repeat(2, 1fr); }
            .troubleshoot-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 992px) {
            .page-banner h1 { font-size: 38px; }
            .page-banner p { font-size: 15px; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .section-title { font-size: 32px; }
            .contact-cta-text h2 { font-size: 26px; }
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

            .search-box-big input {
                padding: 18px 55px 18px 55px;
                font-size: 14px;
            }

            .categories-grid { grid-template-columns: repeat(3, 1fr); gap: 10px; }
            .category-card { padding: 16px 10px; }
            .category-icon { width: 45px; height: 45px; font-size: 18px; }
            .category-card h4 { font-size: 11px; }
            .category-card p { font-size: 10px; }

            .faq-controls { flex-direction: column; align-items: stretch; gap: 12px; }

            .faq-question { padding: 18px 20px; }
            .faq-question-left { gap: 12px; }
            .faq-question-text { font-size: 14px; }
            .faq-number { width: 32px; height: 32px; font-size: 12px; }
            .faq-toggle-icon { width: 32px; height: 32px; font-size: 12px; }

            .faq-item.active .faq-answer {
                padding: 0 20px 20px 20px;
                font-size: 13.5px;
            }

            .support-grid { grid-template-columns: 1fr; }
            .troubleshoot-grid { grid-template-columns: 1fr; }

            .contact-cta-content { flex-direction: column; text-align: center; }
            .contact-cta-text h2 { font-size: 22px; }

            .footer-grid { grid-template-columns: 1fr; }

            .section-title { font-size: 24px; }
            .section-desc { font-size: 14px; }

            .search-hero,
            .categories-section,
            .faq-section,
            .support-section,
            .troubleshoot-section,
            .contact-cta { padding: 50px 0; }

            .chat-btn { width: 50px; height: 50px; font-size: 20px; bottom: 90px; right: 20px; }
            #backToTop { width: 45px; height: 45px; font-size: 16px; right: 20px; bottom: 25px; }
        }

        @media (max-width: 480px) {
            .page-banner h1 { font-size: 22px; }
            .section-title { font-size: 20px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .search-box-big input { padding: 16px 50px 16px 50px; font-size: 13px; }
            .faq-question-text { font-size: 13px; }
            .contact-cta-text h2 { font-size: 20px; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="container topbar-wrapper">
        <div class="topbar-left">
            <span><i class="fas fa-phone"></i> +91 98765 43210</span>
            <span><i class="fas fa-envelope"></i> help@sunriseschool.com</span>
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
        <h1>FAQ & <span>Help Center</span></h1>
        <p>Find answers to your questions, browse help topics, and get support.</p>
        <div class="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            <span>FAQ & Help</span>
        </div>
    </div>
</section>


<!-- SEARCH SECTION -->
<section class="search-hero">
    <div class="container">
        <div class="search-box-big reveal">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="faqSearch" placeholder="Search your question... (e.g. admission, fee, results)" oninput="handleSearch()">
            <button type="button" class="clear-icon" id="clearBtn" onclick="clearSearch()">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
        <div class="search-hint">
            💡 <strong>Tip:</strong> Try searching "admission", "fee", "transport", or "results"
        </div>
    </div>
</section>


<!-- CATEGORIES SECTION -->
<section class="categories-section">
    <div class="container">
        <div class="categories-grid reveal">

            <div class="category-card active" data-category="all" onclick="filterCategory('all', this)">
                <div class="category-icon blue"><i class="fas fa-th-large"></i></div>
                <h4>All</h4>
                <p><?php echo count($faqs); ?> FAQs</p>
            </div>

            <?php foreach ($categories as $key => $cat): ?>
            <div class="category-card" data-category="<?php echo $key; ?>" onclick="filterCategory('<?php echo $key; ?>', this)">
                <div class="category-icon <?php echo $cat['color']; ?>">
                    <i class="fas <?php echo $cat['icon']; ?>"></i>
                </div>
                <h4><?php echo $cat['label']; ?></h4>
                <p><?php echo $category_counts[$key] ?? 0; ?> FAQs</p>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


<!-- FAQ SECTION -->
<section class="faq-section">
    <div class="container">

        <div class="section-header reveal">
            <span class="section-tag">Frequently Asked</span>
            <h2 class="section-title">Your <span>Questions</span> Answered</h2>
            <p class="section-desc">Click on any question to see the answer. Still need help? Contact support below.</p>
        </div>

        <!-- Controls -->
        <div class="faq-controls reveal">
            <div class="faq-results-count">
                Showing <strong id="resultCount"><?php echo count($faqs); ?></strong> FAQs
            </div>
            <div class="faq-sort">
                <label><i class="fas fa-sort"></i> Sort by:</label>
                <select id="sortSelect" onchange="sortFaqs()">
                    <option value="default">Default</option>
                    <option value="helpful">Most Helpful</option>
                    <option value="az">A → Z</option>
                    <option value="za">Z → A</option>
                </select>
            </div>
        </div>

        <!-- FAQ List -->
        <div class="faq-container" id="faqContainer">

            <?php foreach ($faqs as $index => $faq): ?>
            <div class="faq-item reveal"
                 data-category="<?php echo $faq['category']; ?>"
                 data-question="<?php echo strtolower($faq['question'] . ' ' . $faq['answer']); ?>"
                 data-helpful="<?php echo $faq['helpful']; ?>">

                <div class="faq-question" onclick="toggleFaq(this)">
                    <div class="faq-question-left">
                        <div class="faq-number"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></div>
                        <div class="faq-question-text"><?php echo $faq['question']; ?></div>
                    </div>
                    <div class="faq-toggle-icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <div class="faq-answer">
                    <?php echo $faq['answer']; ?>

                    <div class="faq-answer-footer">
                        <span><i class="fas fa-thumbs-up"></i> <?php echo $faq['helpful']; ?> people found this helpful</span>
                        <button class="helpful-btn" onclick="markHelpful(this)">
                            <i class="fas fa-check"></i> Yes, helpful
                        </button>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>

            <!-- No Results -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="fas fa-search-minus"></i>
                <h3>No results found</h3>
                <p>Try different keywords or browse all categories.</p>
                <button class="btn btn-primary" onclick="resetAll()">
                    <i class="fas fa-redo"></i> Reset Search
                </button>
            </div>

        </div>

    </div>
</section>


<!-- SUPPORT SECTION -->
<section class="support-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Get Support</span>
            <h2 class="section-title">Still Need <span>Help?</span></h2>
            <p class="section-desc">Our support team is here to help you with any queries.</p>
        </div>

        <div class="support-grid">

            <a href="tel:+919876543210" class="support-card reveal">
                <div class="support-icon"><i class="fas fa-phone-alt"></i></div>
                <h3>Call Support</h3>
                <p>Talk to our team directly on phone. Mon-Sat, 8 AM - 4 PM.</p>
                <span class="support-action">+91 98765 43210 <i class="fas fa-arrow-right"></i></span>
            </a>

            <a href="mailto:help@sunriseschool.com" class="support-card reveal">
                <div class="support-icon"><i class="fas fa-envelope"></i></div>
                <h3>Email Support</h3>
                <p>Send us your query and we'll respond within 24 hours.</p>
                <span class="support-action">help@sunriseschool.com <i class="fas fa-arrow-right"></i></span>
            </a>

            <a href="contact.php" class="support-card reveal">
                <div class="support-icon"><i class="fas fa-comments"></i></div>
                <h3>Contact Form</h3>
                <p>Fill out our contact form and we'll get back to you soon.</p>
                <span class="support-action">Open Form <i class="fas fa-arrow-right"></i></span>
            </a>

            <a href="#" onclick="alert('📍 School Location:\n123, Main Road, Delhi - 110001\n\nOffice Hours:\nMon-Sat: 8:00 AM - 4:00 PM'); return false;" class="support-card reveal">
                <div class="support-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3>Visit Office</h3>
                <p>Come meet us in person at the school campus.</p>
                <span class="support-action">View Location <i class="fas fa-arrow-right"></i></span>
            </a>

        </div>
    </div>
</section>


<!-- TROUBLESHOOTING SECTION -->
<section class="troubleshoot-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Troubleshooting</span>
            <h2 class="section-title">Common <span>Issues</span> & Fixes</h2>
            <p class="section-desc">Quick fixes for common technical problems.</p>
        </div>

        <div class="troubleshoot-grid">

            <div class="troubleshoot-card reveal">
                <div class="troubleshoot-header">
                    <div class="troubleshoot-icon"><i class="fas fa-lock"></i></div>
                    <h3>Can't Login to Portal</h3>
                </div>
                <div class="troubleshoot-list">
                    <div class="troubleshoot-step">
                        <span class="step-num">1</span>
                        <span>Click "Forgot Password?" on the login page</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">2</span>
                        <span>Enter registered email or mobile</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">3</span>
                        <span>Check inbox for reset link</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">4</span>
                        <span>Create new password</span>
                    </div>
                </div>
            </div>

            <div class="troubleshoot-card reveal">
                <div class="troubleshoot-header">
                    <div class="troubleshoot-icon"><i class="fas fa-credit-card"></i></div>
                    <h3>Payment Failed?</h3>
                </div>
                <div class="troubleshoot-list">
                    <div class="troubleshoot-step">
                        <span class="step-num">1</span>
                        <span>Check your internet connection</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">2</span>
                        <span>Verify card details & balance</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">3</span>
                        <span>Wait 10 minutes & retry</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">4</span>
                        <span>If money deducted, contact accounts with txn ID</span>
                    </div>
                </div>
            </div>

            <div class="troubleshoot-card reveal">
                <div class="troubleshoot-header">
                    <div class="troubleshoot-icon"><i class="fas fa-file-alt"></i></div>
                    <h3>Result Not Found?</h3>
                </div>
                <div class="troubleshoot-list">
                    <div class="troubleshoot-step">
                        <span class="step-num">1</span>
                        <span>Check Student ID spelling</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">2</span>
                        <span>Verify DOB format (YYYY-MM-DD)</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">3</span>
                        <span>Ensure result is declared</span>
                    </div>
                    <div class="troubleshoot-step">
                        <span class="step-num">4</span>
                        <span>Contact exam dept if still failing</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- CONTACT CTA -->
<section class="contact-cta">
    <div class="container contact-cta-content">
        <div class="contact-cta-text">
            <h2>Couldn't Find What You <span>Need?</span></h2>
            <p>Our support team is just a click away. Reach out to us anytime!</p>
        </div>
        <div class="contact-cta-buttons">
            <a href="contact.php" class="btn btn-primary">
                <i class="fas fa-envelope"></i> Contact Support
            </a>
            <a href="tel:+919876543210" class="btn btn-outline">
                <i class="fas fa-phone"></i> Call Now
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
                        <li><a href="faq.php">→ FAQ & Help</a></li>
                        <li><a href="contact.php">→ Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Get In Touch</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123, Main Road, Delhi, India - 110001</li>
                        <li><i class="fas fa-phone"></i> +91 98765 43210</li>
                        <li><i class="fas fa-envelope"></i> help@sunriseschool.com</li>
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

<button class="chat-btn" onclick="alert('💬 Live chat feature coming soon!\n\nFor now, please use:\n📞 Call: +91 98765 43210\n✉️ Email: help@sunriseschool.com')" title="Live Chat">
    <i class="fas fa-comment-dots"></i>
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

    // FAQ TOGGLE
    function toggleFaq(element) {
        const faqItem = element.parentElement;
        const isActive = faqItem.classList.contains('active');

        // Close all others
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });

        // Toggle current
        if (!isActive) {
            faqItem.classList.add('active');
        }
    }

    // SEARCH
    let activeCategory = 'all';

    function handleSearch() {
        const searchValue = document.getElementById('faqSearch').value.toLowerCase().trim();
        const clearBtn = document.getElementById('clearBtn');

        if (searchValue) {
            clearBtn.classList.add('show');
        } else {
            clearBtn.classList.remove('show');
        }

        applyFilters();
    }

    function clearSearch() {
        document.getElementById('faqSearch').value = '';
        document.getElementById('clearBtn').classList.remove('show');
        applyFilters();
    }

    function filterCategory(category, element) {
        activeCategory = category;

        document.querySelectorAll('.category-card').forEach(card => {
            card.classList.remove('active');
        });
        element.classList.add('active');

        applyFilters();
    }

    function applyFilters() {
        const searchValue = document.getElementById('faqSearch').value.toLowerCase().trim();
        const items = document.querySelectorAll('.faq-item');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            const itemText = item.getAttribute('data-question');

            const categoryMatch = (activeCategory === 'all' || itemCategory === activeCategory);
            const searchMatch = (!searchValue || itemText.includes(searchValue));

            if (categoryMatch && searchMatch) {
                item.style.display = 'block';
                item.style.animation = 'fadeUp 0.5s ease forwards';
                visibleCount++;
            } else {
                item.style.display = 'none';
                item.classList.remove('active');
            }
        });

        document.getElementById('resultCount').textContent = visibleCount;
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    function resetAll() {
        document.getElementById('faqSearch').value = '';
        document.getElementById('clearBtn').classList.remove('show');
        activeCategory = 'all';

        document.querySelectorAll('.category-card').forEach(card => {
            card.classList.remove('active');
        });
        document.querySelector('.category-card[data-category="all"]').classList.add('active');

        applyFilters();
    }

    // SORT
    function sortFaqs() {
        const sortValue = document.getElementById('sortSelect').value;
        const container = document.getElementById('faqContainer');
        const items = Array.from(container.querySelectorAll('.faq-item'));

        items.sort((a, b) => {
            if (sortValue === 'helpful') {
                return parseInt(b.getAttribute('data-helpful')) - parseInt(a.getAttribute('data-helpful'));
            } else if (sortValue === 'az') {
                return a.getAttribute('data-question').localeCompare(b.getAttribute('data-question'));
            } else if (sortValue === 'za') {
                return b.getAttribute('data-question').localeCompare(a.getAttribute('data-question'));
            }
            return 0;
        });

        const noResults = document.getElementById('noResults');
        items.forEach(item => container.insertBefore(item, noResults));
    }

    // MARK HELPFUL
    function markHelpful(btn) {
        btn.classList.add('voted');
        btn.innerHTML = '<i class="fas fa-check-circle"></i> Thank you!';
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

    // PAGE LOAD
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('load', handleScroll);
</script>

</body>
</html>