@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تعديل العقد</h2>

    <form action="{{ route('contracts.update', $contract) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>رقم العقد</label>
            <input type="text" name="contract_number" value="{{ $contract->contract_number }}">
        </div>

        <div>
            <label>تاريخ البداية</label>
            <input type="date" name="start_date" value="{{ $contract->start_date }}">
        </div>

        <div>
            <label>تاريخ النهاية</label>
            <input type="date" name="end_date" value="{{ $contract->end_date }}">
        </div>

        <div>
            <label>الإجمالي</label>
            <input type="number" name="total_amount" value="{{ $contract->total_amount }}">
        </div>

        <br>

        <button type="submit">حفظ التعديل</button>
    </form>
</div>
@endsection