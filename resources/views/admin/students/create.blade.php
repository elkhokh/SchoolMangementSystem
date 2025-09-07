@extends('layouts.master')
@section('title', 'إضافة طالب')
@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .select2-container--default .select2-selection--single {
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background-color: #ffffff;
            padding: 8px 12px;
            height: 48px;
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1e293b;
            line-height: 32px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px;
            right: 10px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #eff6ff;
            color: #2563eb;
        }
        .select2-container--default .select2-results__option {
            padding: 10px 15px;
            font-size: 1rem;
        }
        .form-control:focus, .select2-container--default .select2-selection--single:focus {
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.3);
            outline: none;
        }
        .input-group-text {
            background-color: #f1f5f9;
            border: 1px solid #d1d5db;
            border-radius: 10px 0 0 10px;
            padding: 12px;
        }
        .custom-file-label {
            border-radius: 10px;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            padding: 12px;
            font-size: 1.05rem;
            color: #1e293b;
            cursor: pointer;
        }
        .custom-file-label::after {
            content: "اختيار";
            background-color: #2563eb;
            color: #ffffff;
            border-radius: 0 10px 10px 0;
            padding: 12px 20px;
        }
        .custom-file-input:focus ~ .custom-file-label {
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.3);
        }
        .notif {
            font-family: 'Cairo', sans-serif;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-user-plus"></i> الطلاب
                </h4>
                <span class="text-muted mx-2">/ إضافة طالب</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="parsley-style-1" autocomplete="off" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label">اسم الطالب: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input class="form-control" name="name" type="text" value="{{ old('name') }}" placeholder="أدخل اسم الطالب...">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">البريد الإلكتروني: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input class="form-control" name="email" type="email" value="{{ old('email') }}" placeholder="example@email.com">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">كلمة المرور: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input class="form-control" name="password" type="password" placeholder="أدخل كلمة المرور...">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input class="form-control" name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور...">
                                </div>
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="address" class="form-label">العنوان</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-map-marker"></i></span>
                                    <input class="form-control" name="address" type="text" value="{{ old('address') }}" placeholder="أدخل العنوان...">
                                </div>
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-calendar"></i></span>
                                    <input class="form-control" name="birth_date" type="date" value="{{ old('birth_date') }}">
                                </div>
                                @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="gender" class="form-label">النوع</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">اختر النوع</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="class_id" class="form-label">الفصل</label>
                                <select name="class_id" id="class_id" class="form-control">
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

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">الحالة</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير مفعل</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="note" class="form-label">ملاحظات الطالب</label>
                                <input class="form-control" name="note" type="text" value="{{ old('note') }}" placeholder="أدخل ملاحظات الطالب...">
                                @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>


                        <h5 class="mt-5 mb-4 content-title">
                            <i class="la la-paperclip mr-2"></i> المرفقات
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="father_name" class="form-label">اسم الأب: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input class="form-control" name="father_name" type="text" value="{{ old('father_name') }}" placeholder="أدخل اسم الأب...">
                                </div>
                                @error('father_name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="mother_name" class="form-label">اسم الأم: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input class="form-control" name="mother_name" type="text" value="{{ old('mother_name') }}" placeholder="أدخل اسم الأم...">
                                </div>
                                @error('mother_name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="parent_email" class="form-label">البريد الإلكتروني لولي الأمر</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input class="form-control" name="parent_email" type="email" value="{{ old('parent_email') }}" placeholder="example@email.com">
                                </div>
                                @error('parent_email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="parent_phone" class="form-label">رقم هاتف ولي الأمر</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-phone"></i></span>
                                    <input class="form-control" name="parent_phone" type="tel" value="{{ old('parent_phone') }}" placeholder="أدخل رقم الهاتف...">
                                </div>
                                @error('parent_phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="attachment_note" class="form-label">ملاحظات المرفقات</label>
                                <textarea class="form-control" name="attachment_note" rows="4" placeholder="أدخل ملاحظات المرفقات...">{{ old('attachment_note') }}</textarea>
                                @error('attachment_note') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="file_name" class="form-label">اختر المرفق</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_name" name="file_name" accept=".jpg,.jpeg,.png,.pdf">
                                    <label class="custom-file-label" for="file_name">اختر ملف...</label>
                                </div>
                                @error('file_name') <div class="text-danger">{{ $message }}</div> @enderror
                                <div class="form-text text-muted">* الصيغ المسموحة: jpeg, jpg, png, pdf</div>
                            </div>
                        </div>

                        {{-- Hidden role --}}
                        <input type="hidden" name="roles_name[]" value="student">

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-success">
                                <i class="la la-save mr-1"></i> حفظ البيانات
                            </button>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="la la-times mr-1"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#gender, #class_id, #status').select2({
                placeholder: function() {
                    return $(this).attr('data-placeholder') || $(this).find('option:first').text();
                },
                allowClear: true,
                width: '100%'
            });

            // File input preview
            $('#file_name').on('change', function() {
                var fileName = this.files[0] ? this.files[0].name : 'اختر ملف...';
                $(this).next('.custom-file-label').text(fileName);
            });
        });
    </script>
@endsection
