@extends('layouts.app')

@section('content')

<div class="page-card" style="width:100%; max-width:100%;">
    
    <div class="section-head">
        <div>
            <h2 class="page-title">قائمة السيارات</h2>
            <p class="page-subtitle"></p>
        </div>

        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">+ إضافة سيارة</a>
    </div>

    <div style="max-width:1100px; margin:auto;">

        <div style="
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:20px;
            margin:25px 0;
        ">
            <div style="
                background: linear-gradient(135deg, #10b981, #059669);
                color:white;
                padding:18px;
                border-radius:16px;
                box-shadow:0 8px 20px rgba(0,0,0,0.08);
                text-align:center;
            ">
                <div style="font-size:13px; opacity:0.9;">السيارات المتاحة</div>
                <div style="font-size:32px; font-weight:bold; margin-top:5px;">
                    {{ $available }}
                </div>
            </div>

            <div style="
                background: linear-gradient(135deg, #3b82f6, #1e40af);
                color:white;
                padding:18px;
                border-radius:16px;
                box-shadow:0 8px 20px rgba(0,0,0,0.08);
                text-align:center;
            ">
                <div style="font-size:13px; opacity:0.9;">السيارات المؤجرة</div>
                <div style="font-size:32px; font-weight:bold; margin-top:5px;">
                    {{ $rented }}
                </div>
            </div>

            <div style="
                background: linear-gradient(135deg, #f59e0b, #d97706);
                color:white;
                padding:18px;
                border-radius:16px;
                box-shadow:0 8px 20px rgba(0,0,0,0.08);
                text-align:center;
            ">
                <div style="font-size:13px; opacity:0.9;">في الصيانة</div>
                <div style="font-size:32px; font-weight:bold; margin-top:5px;">
                    {{ $maintenance }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>الماركة</th>
                        <th>الموديل</th>
                        <th>اللوحة</th>
                        <th>السنة</th>
                        <th>اللون</th>
                        <th>الحالة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>{{ $vehicle->year ?? '-' }}</td>
                        <td>{{ $vehicle->color ?? '-' }}</td>

                        <td>
                            @if($vehicle->status == 'available')
                                <span class="status-active">متاحة</span>
                            @elseif($vehicle->status == 'rented')
                                <span class="status-closed">مؤجرة</span>
                            @else
                                <span class="status-closed" style="background:#fef3c7;color:#b45309;box-shadow:inset 0 0 0 1px #fcd34d;">صيانة</span>
                            @endif
                        </td>

                        <td>
                            <div class="actions">
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">تعديل</a>

                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف السيارة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding:30px;color:#64748b;font-weight:bold; text-align:center;">
                            لا توجد سيارات حالياً
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection