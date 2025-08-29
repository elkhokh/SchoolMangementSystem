<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختر طريقة الدخول</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 500px;
        }

        .welcome-side {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .welcome-side::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .welcome-side::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            bottom: -75px;
            left: -75px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            z-index: 1;
        }

        .welcome-text {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
            z-index: 1;
        }

        .login-side {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-subtitle {
            color: #7f8c8d;
            margin-bottom: 40px;
            font-size: 14px;
        }

        .user-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .user-option {
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .user-option:hover {
            transform: translateY(-5px);
            border-color: #667eea;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
            background: #fff;
        }

        .user-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .user-option:hover::before {
            left: 100%;
        }

        .user-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .user-option:hover .user-icon {
            transform: scale(1.1);
        }

        .user-name {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .user-desc {
            font-size: 12px;
            color: #7f8c8d;
        }

        /* ألوان مخصصة */
        .admin-option:hover {
            border-color: #e74c3c;
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.2);
        }

        .teacher-option:hover {
            border-color: #3498db;
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.2);
        }

        .parent-option:hover {
            border-color: #2ecc71;
            box-shadow: 0 10px 25px rgba(46, 204, 113, 0.2);
        }

        .student-option:hover {
            border-color: #9b59b6;
            box-shadow: 0 10px 25px rgba(155, 89, 182, 0.2);
        }

        /* استجابة للشاشات الصغيرة */
        @media (max-width: 768px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .welcome-side {
                padding: 40px 30px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .login-side {
                padding: 40px 30px;
            }

            .user-options {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .login-wrapper {
                margin: 10px;
            }

            .user-option {
                padding: 20px 15px;
            }

            .user-icon {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="welcome-side">
        <h1 class="welcome-title">أهلاً بك</h1>
        <p class="welcome-text">نظام إدارة المدرسة الشامل<br>اختر نوع حسابك للدخول إلى النظام</p>
    </div>

    <div class="login-side">
        <h2 class="login-title">تسجيل الدخول</h2>
        <p class="login-subtitle">اختر نوع المستخدم المناسب</p>

        <div class="user-options">
            <a href="#admin" class="user-option admin-option">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/2910/2910766.png" alt="Admin">
                <div class="user-name">مدير</div>
                <div class="user-desc">إدارة النظام</div>
            </a>

            <a href="#teacher" class="user-option teacher-option">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Teacher">
                <div class="user-name">معلم</div>
                <div class="user-desc">إدارة الفصول</div>
            </a>

            <a href="#parent" class="user-option parent-option">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Parent">
                <div class="user-name">ولي أمر</div>
                <div class="user-desc">متابعة الطلاب</div>
            </a>

            <a href="#student" class="user-option student-option">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Student">
                <div class="user-name">طالب</div>
                <div class="user-desc">الدروس والواجبات</div>
            </a>
        </div>
    </div>
</div>

</body>
</html>
