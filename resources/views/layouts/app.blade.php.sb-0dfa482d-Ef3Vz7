<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'مؤسسة سحاب لتأجير السيارات')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .topbar {
            background: linear-gradient(90deg, #0f172a, #1e293b);
            color: #fff;
            padding: 18px 28px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
        }

        .topbar-left {
            text-align: left;
        }

        .topbar-center {
            text-align: center;
        }

        .topbar-right {
            text-align: right;
        }

        .brand-title {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        .brand-subtitle {
            margin: 6px 0 0;
            font-size: 13px;
            color: #cbd5e1;
        }

        .username {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .logout-btn {
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .navbar {
            background: #111827;
            padding: 0 28px;
            display: flex;
            justify-content: flex-start;
            gap: 8px;
        }

        .navbar a {
            color: #fff;
            padding: 14px 18px;
            display: inline-block;
            font-size: 15px;
            border-bottom: 3px solid transparent;
        }

        .navbar a:hover {
            background: rgba(255,255,255,0.06);
            border-bottom-color: #38bdf8;
        }

        .page {
            max-width: 1380px;
            margin: 28px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            padding: 26px;
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .top-actions h1 {
            margin: 0;
            font-size: 36px;
            color: #111827;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary,
        .btn {
            background: #0f172a;
            color: #fff;
        }

        .btn-primary:hover,
        .btn:hover {
            opacity: 0.93;
        }

        .btn-secondary {
            background: #1d4ed8;
            color: #fff;
        }

        .btn-success {
            background: #15803d;
            color: #fff;
        }

        .btn-danger {
            background: #dc2626;
            color: #fff;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: right;
            white-space: nowrap;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background: #f3f4f6;
            color: #111827;
            font-weight: bold;
        }

        tr:hover td {
            background: #fafafa;
        }

        form {
            margin: 0;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #fff;
            font-size: 14px;
            margin-top: 6px;
            margin-bottom: 14px;
        }

        label {
            font-weight: bold;
            font-size: 14px;
            color: #111827;
        }

        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            padding: 28px;
            max-width: 900px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        @media (max-width: 900px) {
            .topbar {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .topbar-left,
            .topbar-center,
            .topbar-right {
                text-align: center;
            }

            .navbar {
                flex-wrap: wrap;
                justify-content: center;
            }

            .top-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@if(auth()->check())
    <div class="topbar">
        <div class="topbar-left">
            <div class="username">👤 {{ auth()->user()->name }}</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>

        <div class="topbar-center">
            <h1 class="brand-title">مؤسسة سحاب لتأجير السيارات</h1>
            <p class="brand-subtitle">نظام إدارة العقود والعملاء والسيارات</p>
        </div>

        <div class="topbar-right"></div>
    </div>

    <div class="navbar">
        <a href="{{ route('contracts.index') }}">العقود</a>
        <a href="{{ route('customers.index') }}">العملاء</a>
        <a href="{{ route('vehicles.index') }}">السيارات</a>
    </div>
@endif

<div class="page">
    <div class="card">
        @yield('content')
    </div>
</div>

</body>
</html>