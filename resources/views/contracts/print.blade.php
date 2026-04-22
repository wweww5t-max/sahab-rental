<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عقد تأجير</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            padding:20px;
            font-family: Tahoma, Arial, sans-serif;
            direction: rtl;
            background:#f3f4f6;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .page{
            width:210mm;
            margin:auto;
            background:#fff;
            padding:20px;
            border-radius:10px;
        }

        
        .header{
            background:#1473ff !important;
            color:#fff !important;
            text-align:center;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
        }

        .title{
            text-align:center;
            margin-bottom:10px;
        }

        .status{
            text-align:center;
            margin-bottom:10px;
        }

        .status span{
            padding:6px 15px;
            border-radius:20px;
            background:#dcfce7;
            color:#166534;
            font-weight:bold;
        }

        .section{
            background:#1473ff !important;
            color:#fff !important;
            padding:8px;
            border-radius:6px;
            margin-top:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:10px;
        }

        th, td{
            border:1px solid #ddd;
            padding:8px;
            text-align:center;
            font-size:13px;
        }

        th{
            background:#f3f4f6;
        }

        .total{
            color:green;
            font-weight:bold;
            font-size:16px;
        }

        .terms{
            border:1px solid #ddd;
            padding:10px;
            background:#fafafa;
            line-height:1.8;
        }

        .signatures{
            margin-top:20px;
            width:100%;
        }

        .signatures td{
            border:none;
            text-align:center;
            padding-top:30px;
        }

        .line{
            border-top:1px solid #000;
            width:120px;
            margin:auto;
        }

        .actions{
            text-align:center;
            margin-top:15px;
        }

        button{
            padding:10px 15px;
            background:#1473ff;
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }

        @media print{
            body{
                background:#fff;
                padding:0;
            }

            .page{
                width:100%;
                border:none;
            }

            .actions{
                display:none;
            }

            
            .header{
                background:#1473ff !important;
                color:#fff !important;
            }

            .section{
                background:#1473ff !important;
                color:#fff !important;
            }

            @page{
                size:A4;
                margin:10mm;
            }
        }
    </style>
</head>

<body>

<div class="page">

   
    <div class="header" style="background:#1473ff;color:#fff;">
        <h2>شركة جياد لتأجير السيارات</h2>
        <small>تم انشاء هذا العقد إلكترونياً بواسطة نظام شركة جياد لتأجير السيارات</small>
    </div>

    <div class="title">
        <h3>عقد تأجير مركبة</h3>
    </div>

    <div class="status">
        <span>{{ ($contract->status ?? '') === 'active' ? 'ساري' : 'منتهي' }}</span>
    </div>

    <div class="section">بيانات العميل</div>
    <table>
        <tr>
            <th>الاسم</th>
            <td>{{ $contract->customer->full_name ?? '-' }}</td>
            <th>الجوال</th>
            <td>{{ $contract->customer->mobile ?? '-' }}</td>
        </tr>
        <tr>
            <th>رقم الهوية</th>
            <td>{{ $contract->customer->national_id ?? '-' }}</td>
            <th>رقم الرخصة</th>
            <td>{{ $contract->customer->license_number ?? '-' }}</td>
        </tr>
    </table>

    <div class="section">بيانات السيارة</div>
    <table>
        <tr>
            <th>الماركة</th>
            <td>{{ $contract->vehicle->brand ?? '-' }}</td>
            <th>الموديل</th>
            <td>{{ $contract->vehicle->model ?? '-' }}</td>
        </tr>
        <tr>
            <th>اللوحة</th>
            <td>{{ $contract->vehicle->plate_number ?? '-' }}</td>
            <th>اللون</th>
            <td>{{ $contract->vehicle->color ?? '-' }}</td>
        </tr>
    </table>

    <div class="section">تفاصيل العقد</div>
    <table>
        <tr>
            <th>رقم العقد</th>
            <td>{{ $contract->contract_number ?? '-' }}</td>
            <th>عدد الأيام</th>
            <td>{{ $contract->rent_days ?? '-' }}</td>
        </tr>
        <tr>
            <th>تاريخ البداية</th>
            <td>{{ $contract->start_date ?? '-' }}</td>
            <th>تاريخ النهاية</th>
            <td>{{ $contract->end_date ?? '-' }}</td>
        </tr>
        <tr>
            <th>الإجمالي</th>
            <td colspan="3" class="total">
                {{ number_format((float)($contract->total_amount ?? 0), 2) }} ريال
            </td>
        </tr>
    </table>

    <div class="terms">
    @if(!empty($contract->terms))
        {!! nl2br(e($contract->terms)) !!}
    @else
        <ol class="terms-list">
            <li>يلتزم المستأجر بالمحافظة على المركبة طوال مدة العقد.</li>
            <li>يتحمل المستأجر جميع المخالفات والأضرار الناتجة عن الاستخدام.</li>
            <li>يمنع استخدام المركبة في أي نشاط مخالف للأنظمة والتعليمات.</li>
            <li>يجب إعادة المركبة في الموعد المحدد وبنفس حالتها.</li>
            <li>يحق للشركة المطالبة بأي مستحقات أو تعويضات مترتبة.</li>
        </ol>
    @endif
</div>

    <table class="signatures">
        <tr>
            <td>
                <div class="line"></div>
                توقيع العميل
            </td>
            <td>
                <div class="line"></div>
                توقيع الشركة
            </td>
        </tr>
    </table>

    <div class="actions">
        <button onclick="window.print()">تحميل PDF</button>
    </div>

</div>

<script>
window.onload = function () {
    setTimeout(function () {
        window.print();
    }, 300);
}
</script>

</body>
</html>