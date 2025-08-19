
@extends('layouts.master')
@section('title', 'اضافة مدرس')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة الفصل بنجاح",
                    type: "success"
                })}
        </script>
    @endif
    @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: " حدث مشكلة اثناء حذف الفصل بنجاح",
                    type: "danger"
                })}
        </script>
    @endif
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        {{-- @if($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

            @if (session()->has('success'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: "{{session()->get('success')}}",
                            type: "success"
                        })
                    }

                </script>
            @endif
            @if (session()->has('error'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: "{{session()->get('error')}}",
                            type: "error"
                        })
                    }

                </script>
            @endif --}}

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.store')}}" method="post">
                    @csrf

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name" required="" type="text">
                                    @error('name')
    <div class="text-danger">{{ $message }}</div>
@enderror
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="email" required="" type="email">
                                    @error('email')
    <div class="text-danger">{{ $message }}</div>
@enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password" required="" type="password">
                                @error('password')
    <div class="text-danger">{{ $message }}</div>
@enderror
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password_confirmation" required type="password">
                                @error('password_confirmation')
    <div class="text-danger">{{ $message }}</div>
@enderror
                        </div>


                    </div>
       <!-- العنوان -->
                    <div class="row mg-b-20">
                        <div class="col-md-6">
                            <label>العنوان</label>
                            <input class="form-control form-control-sm" name="address"
                                value="{{ old('address') }}" type="text">
                                @error('address')
    <div class="text-danger">{{ $message }}</div>
@enderror
                        </div>

                            <!-- الجيندر -->
                        <div class="col-md-6">
                            <label>النوع</label>
                            <select name="gender" class="form-control nice-select custom-select">
                                <option value="">اختر النوع</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            @error('gender')
    <div class="text-danger">{{ $message }}</div>
@enderror
                        </div>
                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                                <option value="1">مفعل</option>
                                <option value="0">غير مفعل</option>
                            </select>
                            @error('status')
    <div class="text-danger">{{ $message }}</div>
@enderror
                        </div>
                    </div>

                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label"> صلاحية المستخدم</label>
                                <div class="form-group ">
                                    @foreach ($roles as $key => $role)
                                        <div class="form-check my-2">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="roles_name[]"
                                                id="role{{ $key }}"
                                                value="{{ $role }}">
                                            <label class="form-check-label mx-4" for="role{{ $key }}">
                                                {{ $role }}
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')


<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
