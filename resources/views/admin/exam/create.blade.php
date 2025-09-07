@extends('layouts.master')
@section('title', 'إنشاء امتحان')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
        .alert {
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
                    <i class="la la-file-alt"></i> الامتحانات
                </h4>
                <span class="text-muted mx-2">/ إنشاء امتحان</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('exams.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>خطأ</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="la la-file-alt mr-2"></i> إنشاء امتحان جديد
                    </h5>
                    <form action="{{ route('exams.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="title" class="form-label">عنوان الامتحان: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-heading"></i></span>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="أدخل عنوان الامتحان..." required>
                                </div>
                                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="subject_id" class="form-label">المادة: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-book"></i></span>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
                                        <option value="">اختر المادة</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('subject_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="teacher_id" class="form-label">المدرس: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-chalkboard-teacher"></i></span>
                                    <select name="teacher_id" id="teacher_id" class="form-control" required>
                                        <option value="">اختر المدرس</option>
                                        @foreach($teachers as $id => $name)
                                            <option value="{{ $id }}" {{ old('teacher_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('teacher_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">الحالة: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-toggle-on"></i></span>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>مفعل</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غير مفعل</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="start_time" class="form-label">وقت البدء: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-clock"></i></span>
                                    <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" class="form-control" required>
                                </div>
                                @error('start_time') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="end_time" class="form-label">وقت الانتهاء: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-clock"></i></span>
                                    <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" class="form-control" required>
                                </div>
                                @error('end_time') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="time_of_exam" class="form-label">مدة الامتحان (بالدقائق): <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-hourglass"></i></span>
                                    <input type="number" name="time_of_exam" value="{{ old('time_of_exam') }}" class="form-control" min="1" required>
                                </div>
                                @error('time_of_exam') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="note" class="form-label">ملاحظات</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-sticky-note"></i></span>
                                    <textarea name="note" class="form-control" placeholder="أدخل ملاحظات الامتحان...">{{ old('note') }}</textarea>
                                </div>
                                @error('note') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-save mr-1"></i> إنشاء الامتحان
                            </button>
                            <a href="{{ route('exams.index') }}" class="btn btn-secondary">
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

@endsection
