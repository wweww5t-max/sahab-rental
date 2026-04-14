@extends('layouts.app')

@section('title', 'تعديل العميل')

@section('content')
<h2>تعديل العميل</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('customers.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>الاسم الكامل:</label>
    <input type="text" name="full_name" value="{{ old('full_name', $customer->full_name) }}">

    <label>رقم الهوية:</label>
    <input type="text" name="national_id" value="{{ old('national_id', $customer->national_id) }}">

    <label>رقم الجوال:</label>
    <input type="text" name="mobile" value="{{ old('mobile', $customer->mobile) }}">

    <label>رقم الرخصة:</label>
    <input type="text" name="license_number" value="{{ old('license_number', $customer->license_number) }}">

    <label>تاريخ الميلاد:</label>
    <input type="date" name="birth_date" value="{{ old('birth_date', $customer->birth_date) }}">

    <label>الجنسية:</label>
    <input type="text" name="nationality" value="{{ old('nationality', $customer->nationality) }}">

    <br><br>
    <button type="submit">حفظ التعديل</button>
</form>
@endsection