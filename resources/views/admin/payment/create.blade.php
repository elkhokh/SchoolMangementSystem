@extends('layouts.master')
@section('title', 'دفع فاتورة')
@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8fafc;
            direction: rtl;
        }
        .page-header {
            background: linear-gradient(135deg, #ffffff, #f1f5f9);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        .content-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        .form-control, .select2-container--default .select2-selection--single {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .select2-container--default .select2-selection--single:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1e293b;
            line-height: 1.5;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
        }
        .btn-purple {
            background: #6d28d9;
            border-color: #6d28d9;
            color: #fff;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-purple:hover {
            background: #5b21b6;
            border-color: #5b21b6;
            box-shadow: 0 2px 8px rgba(107, 33, 168, 0.3);
        }
        .btn-secondary {
            background: #6b7280;
            border-color: #6b7280;
            color: #fff;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: #4b5563;
            border-color: #4b5563;
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
        }
        .text-danger {
            font-size: 0.9rem;
            margin-top: 0.25rem;
            color: #ef4444;
        }
        .select2-container .select2-selection--single {
            height: auto;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: #3b82f6;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="fas fa-chalkboard-teacher mr-2"></i> فاتورة
                </h4>
                <span class="text-muted mx-2">/ إضافة فاتورة</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="mb-4 text-end">
                        <a class="btn btn-secondary" href="{{ route('payments.index') }}">رجوع</a>
                    </div>

                    <form id="myform" action="{{ route('payments.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="student_id" class="form-label">اختر الطالب</label>
                            <select name="student_id" id="student_id" class="form-control">
                                <option value="">اختر الطالب</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="payment_type" class="form-label">نوع الدفع</label>
                            <select name="payment_type" id="payment_type" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="paymob">Paymob</option>
                                <option value="myfatoorah">MyFatoorah</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            @error('payment_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="form-label">المبلغ المدفوع</label>
                            <input type="number" name="amount" class="form-control">
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" form="myform" class="btn btn-purple">استكمال الدفع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#student_id').select2({
                placeholder: "ابحث عن اسم الطالب...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
