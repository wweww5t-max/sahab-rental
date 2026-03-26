@extends('layouts.app')

@section('title', 'إضافة عميل')

@section('content')
    <h1>إضافة عميل</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <label>الاسم الكامل:</label>
        <input type="text" name="full_name">

        <label>رقم الهوية:</label>
        <input type="text" name="national_id">

        <label>رقم الجوال:</label>
        <input type="text" name="mobile">

        <label>رقم الرخصة:</label>
        <input type="text" name="license_number">

        <label>الجنسية:</label>
        <input type="text" name="nationality">

        <label>ملاحظات:</label>
        <textarea name="notes"></textarea>

        <button type="submit" class="btn btn-success">💾 حفظ</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">⬅ رجوع</a>
    </form>
@endsection