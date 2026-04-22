@extends('layouts.app')

@section('content')

<div class="stats-grid">
    <div class="stat-card">
        

<div class="page-card">
    <div class="section-head">
        <div>
            <h2 class="page-title">قائمة العملاء</h2>
            <p class="page-subtitle"ي</p>
        </div>

        <a href="{{ route('customers.create') }}" class="btn btn-primary">+ إضافة عميل جديد</a>
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
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>الجوال</th>
                    <th>رقم الرخصة</th>
                    <th>الجنسية</th>
                    <th>الإجراء</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->national_id ?? '-' }}</td>
                    <td>{{ $customer->mobile ?? '-' }}</td>
                    <td>{{ $customer->license_number ?? '-' }}</td>
                    <td>{{ $customer->nationality ?? '-' }}</td>

                    <td>
                        <div class="actions">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">تعديل</a>

                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف العميل؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 30px; color: #64748b; font-weight: bold;">
                        لا يوجد عملاء حالياً
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection