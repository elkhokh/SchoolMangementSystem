@extends('layouts.master')
@section('title', 'تعديل المستخدم ')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل المسخدم بنجاح",
                    type: "success"
                })}
        </script>
    @endif
        @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: "حدث خطا في التعديل ",
                    type: "success"
                })}
        </script>
    @endif
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control" >
                                                                @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                            <input type="text" value="{{$user->email}}" name="email" class="form-control" >
                                                                @error('email')
    <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                        <input type="password" name="password" class="form-control" autocomplete="false" >
                                                            @error('password')
    <div class="text-danger">{{ $message }}</div>
@enderror
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        <input type="password" name="password_confirmation" autocomplete="false" class="form-control" >
                                                            @error('password_confirmation')
    <div class="text-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">حالة المستخدم</label>
                        <select name="status" id="select-beast" required class="form-control  nice-select  custom-select">
                            <option {{ $user->status == 1 ? 'selected' : '' }}
                                    value="1">مفعل</option>
                            <option {{$user->status == 0 ? 'selected' : ''}} value="0">غير مفعل</option>
                        </select>
                                                            @error('status')
    <div class="text-danger">{{ $message }}</div>
@enderror
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong >نوع المستخدم</strong>
                            @foreach($roles as $id => $role)
                                <div class="form-check ">
                                    <input class="form-check-input my-4"
                                        type="checkbox"
                                        name="roles[]"
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'checked' : '' }}>
                                    <label class="form-check-label mx-4 my-3">
                                        {{ $role }}
                                    </label>
@error('roles')
<div class="text-danger">{{ $message }}</div>
@enderror
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="mg-t-30">
                    <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
                </div>
                </form>
            </div>
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

<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

@endsection
