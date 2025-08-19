@extends('layouts.master')
@section('title', 'إضافة طالب')

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
@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({ msg: "تم إضافة المستخدم بنجاح", type: "success" })
    }
</script>
@endif

@if (session()->has('Error'))
<script>
    window.onload = function() {
        notif({ msg: "حدثت مشكلة أثناء إضافة المستخدم", type: "danger" })
    }
</script>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="mb-3 text-end">
                    <a class="btn btn-primary" href="{{ route('students.index') }}">رجوع</a>
                </div>

                <form class="parsley-style-1" autocomplete="off" action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- بيانات المستخدم --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label>البريد الإلكتروني: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="email" type="email" value="{{ old('email') }}">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div> --}}

                                            <div class="col-md-6 mb-3">
    <label>البريد الإلكتروني لولي الأمر</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
        <input class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="example@email.com">
    </div>
    </div>
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="password" type="password">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="password_confirmation" type="password">
                            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- بيانات الطالب --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>العنوان</label>
                            <input class="form-control" name="address" value="{{ old('address') }}" type="text">
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>تاريخ الميلاد</label>
                            <input class="form-control" name="birth_date" value="{{ old('birth_date') }}" type="date">
                            @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>النوع</label>
                            <select name="gender" class="form-control">
                                <option value="">اختر النوع</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>الفصل</label>
                            <select name="class_id" class="form-control">
                                <option value="">اختر الفصل</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- حالة المستخدم وملاحظات --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>حالة المستخدم</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>ملاحظات</label>
                            <input class="form-control" name="note" value="{{ old('note') }}" type="text">
                            @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- بيانات المرفقات --}}
                    <h5 class="mt-4">المرفقات</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>اسم الأب: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="father_name" type="text" value="{{ old('father_name') }}">
                            @error('father_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>اسم الأم: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="mother_name" type="text" value="{{ old('mother_name') }}">
                            @error('mother_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>


                        {{-- <div class="col-md-6 mb-3">
                            <label>البريد الإلكتروني لولي الأمر</label>
                            <input class="form-control" name="parent_email" type="email" value="{{ old('parent_email') }}">
                            @error('parent_email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div> --}}
                        <div class="col-md-6 mb-3">
    <label>البريد الإلكتروني لولي الأمر</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
        <input class="form-control" name="parent_email" type="email" value="{{ old('parent_email') }}" placeholder="example@email.com">
    </div>
    @error('parent_email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

         <div class="col-md-6 mb-3">
    <label>رقم هاتف ولي الأمر</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa fa-phone"></i></span>
        <input class="form-control" name="parent_phone" type="tel" value="{{ old('parent_phone') }}" placeholder="">
    </div>
    @error('parent_phone') <div class="text-danger">{{ $message }}</div> @enderror
</div>
                    </div>

                    <div class="mb-3">
                        <label>ملاحظات المرفقات</label>
                        <textarea class="form-control" name="note" rows="3">{{ old('note') }}</textarea>
                        @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

       <div class="mb-3">
    <label for="file_name" class="form-label">اختر المرفق</label>
    <input class="form-control" type="file" id="file_name" name="file_name" accept=".jpg,.jpeg,.png,.pdf">
    @error('file_name')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
    <div class="form-text text-muted">* صيغة المرفق: jpeg, jpg, png, pdf</div>
</div>

                    {{-- Hidden role --}}
                    <input type="hidden" name="roles_name[]" value="student">

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
