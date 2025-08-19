@extends('layouts.master')
@section('title', 'إضافة مدرس')

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
                    <a class="btn btn-primary" href="{{ route('teachers.index') }}">رجوع</a>
                </div>

                <form class="parsley-style-1" autocomplete="off" action="{{ route('teachers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- بيانات المستخدم --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>


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

                    {{-- بيانات المدرس --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>العنوان</label>
                            <input class="form-control" name="address" value="{{ old('address') }}" type="text">
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label> التخصص</label>
                            <input class="form-control" name="specialization" value="{{ old('specialization') }}" type="text">
                            @error('specialization') <div class="text-danger">{{ $message }}</div> @enderror
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
                            <label>المادة</label>
                            <select name="subject_id" class="form-control">
                                <option value="">اختر المادة</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id') <div class="text-danger">{{ $message }}</div> @enderror
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
    <label>رقم هاتف </label>
    <div class="input-group">
        <span class="input-group-text"><i class="fa fa-phone"></i></span>
        <input class="form-control" name="phone" type="tel" value="{{ old('phone') }}" placeholder="">
    </div>
    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
</div>
                    </div>

                <div class="col-md-12 mb-3">
    <label class="form-label">ملاحظات</label>
    <textarea class="form-control" name="note" rows="4" style="min-height: 2
    100px; width:100%;">{{ old('note', $teacher->note ?? '') }}</textarea>
    @error('note') <div class="text-danger">{{ $message }}</div> @enderror
</div>

                    {{-- Hidden role --}}
                    <input type="hidden" name="roles_name[]" value="teacher">
                <div class="col-md-20 mb-3">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                    </div>
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
