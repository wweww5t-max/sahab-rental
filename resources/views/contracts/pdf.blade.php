<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: DejaVu Sans, sans-serif;
    direction: rtl;
    text-align: right;
    font-size: 14px;
}
h1 {
    text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
td, th {
    border: 1px solid #ccc;
    padding: 8px;
}
th {
    background: #f3f4f6;
}
</style>
</head>
<body>

<h1>عقد تأجير</h1>

<table>
<tr>
    <th>رقم العقد</th>
    <td>{{ $contract->contract_number }}</td>
</tr>
<tr>
    <th>العميل</th>
    <td>{{ $contract->customer->full_name ?? '-' }}</td>
</tr>
<tr>
    <th>السيارة</th>
    <td>{{ $contract->vehicle->model ?? '-' }}</td>
</tr>
<tr>
    <th>تاريخ البداية</th>
    <td>{{ $contract->start_date }}</td>
</tr>
<tr>
    <th>تاريخ النهاية</th>
    <td>{{ $contract->end_date }}</td>
</tr>
<tr>
    <th>الإجمالي</th>
    <td>{{ number_format($contract->total_amount, 2) }} ريال</td>
</tr>
</table>

</body>
</html>