@extends('layouts.app')

@section('title', 'السيارات')

@section('content')

<h2>قائمة السيارات</h2>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('vehicles.create') }}" 
   style="background:green;color:white;padding:5px 10px;">
    إضافة سيارة
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>الماركة</th>
            <th>الموديل</th>
            <th>اللوحة</th>
            <th>السنة</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->plate_number }}</td>
            <td>{{ $vehicle->year }}</td>

            <td>
                @if($vehicle->status == 'available')
                    <span style="color:green;">متاحة</span>
                @elseif($vehicle->status == 'rented')
                    <span style="color:red;">مؤجرة</span>
                @else
                    <span style="color:orange;">صيانة</span>
                @endif
            </td>

            <td>
                <!-- زر تعديل -->
                <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                   style="background:blue;color:white;padding:5px 10px;margin-right:5px;">
                    تعديل
                </a>

                <!-- زر حذف -->
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('⚠️ هل أنت متأكد من حذف السيارة؟')"
                            style="background:red;color:white;padding:5px 10px;border:none;">
                        حذف
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection