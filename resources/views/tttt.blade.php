<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختر طريقة الدخول</title>
    <style>
        body {
            margin: 0;
            font-family: 'Tajawal', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e9ecef;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        .login-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            border: 1px solid #ddd;
            padding: 30px;
            text-align: center;
            width: 500px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: #007bff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        .login-options {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .login-options div {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .login-options div:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .login-options img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #007bff;
            padding: 5px;
            background: #fff;
            transition: border-color 0.3s;
        }

        .login-options div:hover img {
            border-color: #0056b3;
        }

        .login-options span {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <div class="title">اختر نوع المستخدم</div>
    <div class="login-options">
        <div onclick="login('admin')">
            <img src="https://cdn-icons-png.flaticon.com/512/2910/2910766.png" alt="Admin">
            <span>مدير</span>
        </div>
        <div onclick="login('teacher')">
            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Teacher">
            <span>معلم</span>
        </div>
        <div onclick="login('parent')">
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Parent">
            <span>ولي أمر</span>
        </div>
        <div onclick="login('student')">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Student">
            <span>طالب</span>
        </div>
    </div>
</div>

<script>
    function login(role) {
        alert('تم اختيار: ' + role);
        // مثال: window.location.href = role + '.html';
    }
</script>

</body>
</html>
