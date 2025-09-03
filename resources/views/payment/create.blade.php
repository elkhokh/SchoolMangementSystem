@extends('layouts.master')
@section('title', 'دفع فاتورة')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فاتورة</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة فاتورة</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <div class="mb-3 text-end">
                        <a class="btn btn-secondary" href="{{ route('payments.index') }}">رجوع</a>
                    </div>

                    <form id="myform" action="{{ route('payments.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label">اختر الطالب</label>
                            <select name="student_id" id="student_id" class="form-control">
                                <option value=""> اختر الطالب </option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                                @endforeach
                            </select>
                                @error('student_id')
                        <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="mb-3">
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

                        <div class="mb-3">
                            <label for="amount" class="form-label">المبلغ المدفوع</label>
                            <input type="number" name="amount" class="form-control" >
                        @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        {{-- <div class="text-end mt-3">--}}
                    <div class="text-center mt-3">
                            <button type="submit" form="myform" class="btn btn-purple">استكمال الدفع</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
