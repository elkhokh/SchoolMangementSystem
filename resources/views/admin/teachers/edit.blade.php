@extends('layouts.master')

@section('title', 'تعديل المدرس')

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
                    <i class="la la-user-edit"></i> المدرسين
                </h4>
                <span class="text-muted mx-2">/ تعديل المدرس</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-md">
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
                    <form class="parsley-style-1" autocomplete="off" action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label">اسم المدرس: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input class="form-control" name="name" type="text" value="{{ old('name', $teacher->user->name) }}">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">البريد الإلكتروني: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input class="form-control" name="email" type="email" value="{{ old('email', $teacher->user->email) }}" placeholder="example@email.com">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input class="form-control" name="password" type="password" placeholder="أدخل كلمة المرور...">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
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
                                    <input class="form-control" name="address" type="text" value="{{ old('address', $teacher->address) }}" placeholder="أدخل العنوان...">
                                </div>
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="specialization" class="form-label">التخصص</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-graduation-cap"></i></span>
                                    <input class="form-control" name="specialization" type="text" value="{{ old('specialization', $teacher->specialization) }}" placeholder="أدخل التخصص...">
                                </div>
                                @error('specialization') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="gender" class="form-label">النوع</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">اختر النوع</option>
                                    <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="subject_id" class="form-label">المادة</label>
                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="">اختر المادة</option>
                                    @foreach($subjects as $sub)
                                        <option value="{{ $sub->id }}" {{ old('subject_id', $teacher->subject_id) == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">الحالة</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $teacher->user->status) == '1' ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('status', $teacher->user->status) == '0' ? 'selected' : '' }}>غير مفعل</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-phone"></i></span>
                                    <input class="form-control" name="phone" type="tel" value="{{ old('phone', $teacher->phone ?? '') }}" placeholder="أدخل رقم الهاتف...">
                                </div>
                                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="note" class="form-label">ملاحظات</label>
                                <textarea class="form-control" name="note" rows="4" placeholder="أدخل ملاحظات إضافية...">{{ old('note', $teacher->note) }}</textarea>
                                @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button class="btn btn-primary" type="submit">
                                <i class="la la-save mr-1"></i> تحديث
                            </button>
                            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
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
            $('#gender, #subject_id, #status').select2({
                placeholder: function() {
                    return $(this).attr('data-placeholder') || $(this).find('option:first').text();
                },
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
