@extends('layouts.master')
@section('title', 'تعديل طالب')

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
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل طالب</span>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session()->has('Update'))
<script>
    window.onload = function() {
        notif({ msg: "تم تحديث الطالب بنجاح", type: "success" });
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
                    <a class="btn btn-primary" href="{{ route('students.index') }}">رجوع</a>
                </div>

                <form class="parsley-style-1" autocomplete="off" action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">اسم الطالب: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name', $student->user->name) }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">البريد الإلكتروني: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" name="email" type="email" value="{{ old('email', $student->user->email) }}" placeholder="example@email.com">
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
                            <input class="form-control" name="address" type="text" value="{{ old('address', $student->address) }}">
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="birth_date">تاريخ الميلاد</label>
                            <input class="form-control" name="birth_date" type="date" value="{{ old('birth_date', $student->birth_date) }}">
                            @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender">النوع</label>
                            <select name="gender" class="form-control">
                                <option value="">اختر النوع</option>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="class_id">الفصل</label>
                            <select name="class_id" class="form-control">
                                <option value="">اختر الفصل</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">الحالة</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $student->user->status) == '1' ? 'selected' : '' }}>مفعل</option>
                                <option value="0" {{ old('status', $student->user->status) == '0' ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note">ملاحظات</label>
                            <textarea class="form-control" name="note" rows="3">{{ old('note', $student->note) }}</textarea>
                            @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h5 class="mt-4">المرفقات</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="father_name">اسم الأب: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="father_name" type="text" value="{{ old('father_name', $student->attachments->father_name ?? '') }}">
                            @error('father_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mother_name">اسم الأم: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="mother_name" type="text" value="{{ old('mother_name', $student->attachments->mother_name ?? '') }}">
                            @error('mother_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="parent_email">البريد الإلكتروني لولي الأمر</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input class="form-control" name="parent_email" type="email" value="{{ old('parent_email', $student->attachments->parent_email ?? '') }}" placeholder="example@email.com">
                            </div>
                            @error('parent_email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="parent_phone">رقم هاتف ولي الأمر</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input class="form-control" name="parent_phone" type="tel" value="{{ old('parent_phone', $student->attachments->parent_phone ?? '') }}" placeholder="رقم الهاتف">
                            </div>
                            @error('parent_phone') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="file_name" class="form-label">اختر المرفق</label>
                        @if($student->attachments && $student->attachments->file_name)
                            <p>
                                المرفق الحالي:
                                @if(in_array(pathinfo($student->attachments->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/' . $student->attachments->file_name) }}"alt="Attachment" class="img-thumbnail rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                                <a href="{{ asset('storage/' . $student->attachments->file_name) }}" target="_blank">
                                    {{ basename($student->attachments->file_name) }}
                                </a>
                            </p>
                        @endif
                        <input class="form-control" type="file" id="file_name" name="file_name" accept=".jpg,.jpeg,.png,.pdf">
                        @error('file_name') <div class="text-danger">{{ $message }}</div> @enderror
                        <div class="form-text text-muted">* صيغة المرفق: jpeg, jpg, png, pdf</div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" type="submit">تحديث</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">إلغاء</a>
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
