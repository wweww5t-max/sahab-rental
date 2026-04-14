@extends('layouts.app')

@section('title', 'السيارات')

@section('content')
    <h1>قائمة السيارات</h1>

    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">➕ إضافة سيارة</a>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <tr>
            <th>الماركة</th>
            <th>الموديل</th>
            <th>السنة</th>
            <th>اللوحة</th>
            <th>اللون</th>
            <th>السعر اليومي</th>
            <th>الحالة</th>
        </tr>

        @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->brand }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->year }}</td>
                <td>{{ $vehicle->plate_number }}</td>
                <td>{{ $vehicle->color }}</td>
                <td>{{ $vehicle->daily_rate }}</td>
                <td>{{ $vehicle->status }}</td>
<td>
    <a href="{{ route('vehicles.edit', $vehicle->id) }}"
       style="background:blue;color:white;padding:5px 10px;">
        تعديل
    </a>
</td>
            </tr>
        @endforeach
    </table>
@endsection