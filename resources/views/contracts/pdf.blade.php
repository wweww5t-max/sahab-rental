<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td {
            border: 1px solid #000;
            padding: 6px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>عقد إيجار</h2>

<table>
    <tr>
        <td>رقم العقد</td>
        <td>{{ $contract->contract_number }}</td>
    </tr>
    <tr>
        <td>اسم العميل</td>
        <td>{{ $contract->customer->full_name }}</td>
    </tr>
    <tr>
        <td>الجوال</td>
        <td>{{ $contract->customer->mobile }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>السيارة</td>
        <td>{{ $contract->vehicle->brand }} {{ $contract->vehicle->model }}</td>
    </tr>
    <tr>
        <td>رقم اللوحة</td>
        <td>{{ $contract->vehicle->plate_number }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>تاريخ البداية</td>
        <td>{{ $contract->start_date }}</td>
    </tr>
    <tr>
        <td>تاريخ النهاية</td>
        <td>{{ $contract->end_date }}</td>
    </tr>
    <tr>
        <td>عدد الأيام</td>
        <td>{{ $contract->rent_days }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>السعر اليومي</td>
        <td>{{ $contract->daily_rate }}</td>
    </tr>
    <tr>
        <td>الإجمالي</td>
        <td>{{ $contract->total_amount }}</td>
    </tr>
</table>

</body>
</html>