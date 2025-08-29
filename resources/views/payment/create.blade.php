@extends('layouts.master')
@section('title', 'دفع فاتورة')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الطلاب</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة طالب</span>
        </div>
    </div>
</div>
@endsection

@section('content')

@if (session()->has('Error'))
<script>
    window.onload = function() {
        notif({ msg: "حدثت مشكلة   ", type: "danger" })
    }
</script>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="mb-3 text-end">
                    <a class="btn btn-primary" href="{{ route('payments.index') }}">رجوع</a>
                </div>

        <form id="myform" class="parsley-style-1" autocomplete="off" action="{{ route('payments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">اختر الطالب</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- نوع الدفع --}}
        <div class="mb-3">
            <label for="payment_type" class="form-label">نوع الدفع</label>
            <select name="payment_type" id="payment_type" class="form-control">
                <option value="cash">كاش</option>
                <option value="paymob">paymob</option>
                <option value="myfatoorah">myfatoorah</option>
                <option value="paypal">paypal</option>

            </select>
        </div>

        {{-- المبلغ --}}
        <div class="mb-3">
            <label for="amount" class="form-label">المبلغ المدفوع</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <button type="submit" form="myform" class="btn btn-primary">حفظ</button>
    </form>
</div>

                {{-- <div class="row">
                <div class="col-md-6 mb-3">
                <label>الطالب<span class="tx-danger">*</span></label>
                <input class="form-control" name="student_id" type="text" value="{{ old('student_id') }}">
                @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                <label>نوع عمبية الدفع <span class="tx-danger">*</span></label>
                <input class="form-control" name="payment_type" type="text" value="{{ old('payment_type') }}">
                @error('payment_type') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>الطالب</label>
                            <select name="class_id" class="form-control">
                                <option value=""> اكتب الطالب</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student') == $student->id ? 'selected' : '' }}>
                                        {{ $student_id->student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="roles_name[]" value="student">

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
    // Search filter for students
    document.getElementById('student-search').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let options = document.querySelectorAll('#student_id option');
        options.forEach(function(option) {
            let text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
