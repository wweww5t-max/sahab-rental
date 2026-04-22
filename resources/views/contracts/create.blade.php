@extends('layouts.app')

@section('content')

<div class="page-card">
    <div class="section-head">
        <div>
            <h2 class="page-title">إنشاء عقد جديد</h2>
            <p class="page-subtitle">أدخل بيانات العقد ليتم احتساب الإجمالي الشهري تلقائياً</p>
        </div>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:14px;padding:14px 16px;margin-bottom:18px;font-weight:bold;">
            <ul style="margin:0;padding-right:18px;">
                @foreach ($errors->all() as $error)
                    <li style="margin-bottom:6px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf

        <div class="form-group">
    <label for="customer_id">العميل</label>
    <select name="customer_id" id="customer_id" required>
        <option value="">اختر العميل</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                {{ $customer->full_name }}
            </option>
        @endforeach
    </select>
</div>
            <div>
                <label>السيارة</label>
                <select name="vehicle_id">
                    <option value="">اختر السيارة</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->plate_number }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>تاريخ بداية العقد</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}">
            </div>

            <div>
                <label>تاريخ نهاية العقد</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">
            </div>

            <div>
                <label>السعر الشهري</label>
                <input type="number" step="0.01" id="monthly_rate" name="monthly_rate" value="{{ old('monthly_rate') }}">
            </div>

            <div>
                <label>الإجمالي</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" readonly>
            </div>

            <div class="full-width">
                <label>الشروط</label>
                <textarea name="terms" rows="4">{{ old('terms') }}</textarea>
            </div>

            <div>
                <label>الحالة</label>
                <select name="status">
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>ساري</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>منتهي</option>
                </select>
            </div>
        </div>

        <div style="margin-top:20px;">
            <button type="submit" class="btn btn-success">حفظ العقد</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const monthlyRate = document.getElementById('monthly_rate');
    const totalAmount = document.getElementById('total_amount');

    function calculateTotal() {
        if (!startDate.value || !endDate.value || !monthlyRate.value) {
            totalAmount.value = '';
            return;
        }

        const start = new Date(startDate.value);
        const end = new Date(endDate.value);

        let months = (end.getFullYear() - start.getFullYear()) * 12;
        months += (end.getMonth() - start.getMonth()) + 1;

        if (months < 1) months = 1;

        totalAmount.value = (months * parseFloat(monthlyRate.value || 0)).toFixed(2);
    }

    startDate.addEventListener('change', calculateTotal);
    endDate.addEventListener('change', calculateTotal);
    monthlyRate.addEventListener('input', calculateTotal);
});
</script>
@endsection