@extends('layouts.app')

@section('title', 'تعديل السيارة')

@section('content')

<h2>تعديل السيارة</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>الماركة:</label>
    <input type="text" name="brand" value="{{ old('brand', $vehicle->brand) }}">

    <label>الموديل:</label>
    <input type="text" name="model" value="{{ old('model', $vehicle->model) }}">

    <label>رقم اللوحة:</label>
    <input type="text" name="plate_number" value="{{ old('plate_number', $vehicle->plate_number) }}">

    <label>السنة:</label>
    <input type="number" name="year" value="{{ old('year', $vehicle->year) }}">

    <label>اللون:</label>
    <input type="text" name="color" value="{{ old('color', $vehicle->color) }}">

    <label>رقم الهيكل:</label>
    <input type="text" name="chassis_number" value="{{ old('chassis_number', $vehicle->chassis_number) }}">

    <label>الحالة:</label>
    <select name="status">
        <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>متاحة</option>
        <option value="rented" {{ old('status', $vehicle->status) == 'rented' ? 'selected' : '' }}>مؤجرة</option>
        <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>صيانة</option>
    </select>

    <br><br>
    <button type="submit">حفظ التعديل</button>
</form>

@endsection