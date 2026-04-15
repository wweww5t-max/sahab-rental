@extends('layouts.app')

@section('title', 'العملاء')

@section('content')

<h2>قائمة العملاء</h2>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('customers.create') }}" 
   style="background:green;color:white;padding:5px 10px;">
    إضافة عميل
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>رقم الهوية</th>
            <th>الجوال</th>
            <th>الإجراء</th>
        </tr>
    </thead>

    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->full_name }}</td>
            <td>{{ $customer->national_id }}</td>
            <td>{{ $customer->mobile }}</td>

            <td>
                <!-- تعديل -->
                <a href="{{ route('customers.edit', $customer->id) }}"
                   style="background:blue;color:white;padding:5px 10px;margin-right:5px;">
                    تعديل
                </a>

                <!-- حذف -->
                <form action="{{ route('customers.destroy', $customer->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('⚠️ هل أنت متأكد من حذف العميل؟')"
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