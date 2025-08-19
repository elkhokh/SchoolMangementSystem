@extends('layouts.master')
@section('title', 'تعديل المدرس')

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
            <h4 class="content-title mb-0 my-auto">المدرس</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل المدرس</span>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session()->has('Update'))
<script>
    window.onload = function() {
        notif({ msg: "تم تحديث المدرس بنجاح", type: "success" });
    }
</script>
@endif

@if (session()->has('Error'))
<script>
    window.onload = function() {
        notif({ msg: "حدثت مشكلة أثناء تحديث الطالب", type: "danger" });
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

                <form class="parsley-style-1" autocomplete="off" action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">اسم الطالب: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name', $teacher->user->name) }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">البريد الإلكتروني: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" name="email" type="email" value="{{ old('email', $teacher->user->email) }}" placeholder="example@email.com">
                            </div>
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password">كلمة المرور الجديدة (اختياري)</label>
                            <input class="form-control" name="password" type="password">
                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                            <input class="form-control" name="password_confirmation" type="password">
                            @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address">العنوان</label>
                            <input class="form-control" name="address" type="text" value="{{ old('address', $teacher->address) }}">
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                         <div class="col-md-6 mb-3">
                            <label> التخصص</label>
                            <input class="form-control" name="specialization" value="{{ old('specialization', $teacher->specialization) }}" type="text">
                            @error('specialization') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender">النوع</label>
                            <select name="gender" class="form-control">
                                <option value="">اختر النوع</option>
                                <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="class_id">الفصل</label>
                            <select name="class_id" class="form-control">
                                <option value="">اختر الفصل</option>
                                @foreach($subjects as $sub)
                                    <option value="{{ $sub->id }}" {{ old('subject_id', $sub->subject_id) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">الحالة</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $teacher->user->status) == '1' ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ old('status', $teacher->user->status) == '0' ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control" name="note" rows="3">{{ old('note', $teacher->note) }}</textarea>
                            @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                        <div class="col-md-6 mb-3">
                            <label for="phone">رقم هاتف  </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input class="form-control" name="phone" type="tel" value="{{ old('phone', $teacher->phone ?? '') }}" placeholder="رقم الهاتف">
                            </div>
                            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="text-center mt-4">
                        <button class="btn btn-primary" type="submit">تحديث</button>
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">إلغاء</a>
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
