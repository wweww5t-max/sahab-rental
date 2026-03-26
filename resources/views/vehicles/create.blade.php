@extends('layouts.app')

@section('title', 'إضافة سيارة')

@section('content')
    <h1>إضافة سيارة</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf

        <label>الماركة:</label>
        <input type="text" name="brand">

        <label>الموديل:</label>
        <input type="text" name="model">

        <label>السنة:</label>
        <input type="text" name="year">

        <label>رقم اللوحة:</label>
        <input type="text" name="plate_number">

        <label>اللون:</label>
        <input type="text" name="color">

        <label>رقم الهيكل:</label>
        <input type="text" name="chassis_number">

        <label>السعر اليومي:</label>
        <input type="number" step="0.01" name="daily_rate">

        <label>الحالة:</label>
        <select name="status">
            <option value="available">متاحة</option>
            <option value="rented">مؤجرة</option>
            <option value="maintenance">صيانة</option>
        </select>

        <button type="submit" class="btn btn-success">💾 حفظ</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">⬅ رجوع</a>
    </form>
@endsection