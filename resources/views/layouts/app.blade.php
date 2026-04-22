<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شركة جياد لتأجير السيارات</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: linear-gradient(180deg, #eef4fb 0%, #f8fbff 100%);
            color: #1f2937;
        }

        .main-header {
            background: linear-gradient(135deg, #0f172a, #1e3a8a 65%, #2563eb);
            color: #fff;
            padding: 24px 28px 34px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.18);
            text-align: center;
        }

        .main-header h1 {
            margin: 0;
            font-size: 40px;
            font-weight: 900;
        }

        .main-header p {
            margin: 10px 0 0;
            font-size: 16px;
            color: #dbeafe;
        }

        .nav-wrap {
            width: 95%;
            margin: -18px auto 24px;
        }

        .nav-card {
            background: #fff;
            border-radius: 18px;
            padding: 12px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-link {
            text-decoration: none;
            color: #0f172a;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 11px 22px;
            border-radius: 12px;
            font-weight: 800;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }

        .container {
            width: 95%;
            margin: 0 auto 34px;
        }

        .page-card {
            background: #fff;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .page-title {
            margin: 0;
            font-size: 34px;
            font-weight: 900;
            color: #0f172a;
        }

        .page-subtitle {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 15px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-weight: bold;
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
            font-weight: 800;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-warning {
            background: #f59e0b;
            color: #fff;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-info {
            background: #0ea5e9;
            color: #fff;
        }

        .btn-info:hover {
            background: #0284c7;
        }

        .table-wrap {
            overflow-x: auto;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead th {
            background: #0f172a;
            color: white;
            padding: 15px 12px;
            font-size: 14px;
            text-align: center;
            white-space: nowrap;
        }

        tbody td {
            padding: 14px 10px;
            border-bottom: 1px solid #eef2f7;
            text-align: center;
            font-size: 14px;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        .status-active {
            display: inline-block;
            min-width: 76px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #dcfce7;
            color: #15803d;
            font-weight: 900;
        }

        .status-closed {
            display: inline-block;
            min-width: 76px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: 900;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .main-header h1 {
                font-size: 28px;
            }

            .page-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="main-header">
        <h1>شركة جياد لتأجير السيارات</h1>
        <p>نظام احترافي متكامل لإدارة العقود والعملاء والسيارات</p>
    </div>

    <div class="nav-wrap">
        <div class="nav-card">
            <a href="{{ route('contracts.index') }}" class="nav-link">العقود</a>
            <a href="{{ route('customers.index') }}" class="nav-link">العملاء</a>
            <a href="{{ route('vehicles.index') }}" class="nav-link">السيارات</a>
        </div>
    </div>

   <div class="container" style="max-width:100%; padding:20px 40px;">
        @yield('content')
    </div>

</body>
</html>