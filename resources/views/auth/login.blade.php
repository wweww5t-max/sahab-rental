<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-box {
            width: 360px;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
        h1 {
            margin: 0 0 20px;
            font-size: 24px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 14px;
            border: 1px solid #d0d7de;
            border-radius: 8px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: #111827;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>دخول النظام</h1>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <label>البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>كلمة المرور</label>
            <input type="password" name="password" required>

            <button type="submit">دخول</button>
        </form>
    </div>
</body>
</html>