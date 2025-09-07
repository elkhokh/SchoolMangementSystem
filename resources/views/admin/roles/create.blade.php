@extends('layouts.master')
@section('title', 'إضافة صلاحية')
@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.3);
        }
        .input-group-text {
            background-color: #f1f5f9;
            border: 1px solid #d1d5db;
            border-radius: 10px 0 0 10px;
            padding: 12px;
        }
        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            margin-top: 0.3rem;
        }
        .form-check-label {
            font-size: 1.05rem;
            color: #1e293b;
        }
        .form-check:hover .form-check-label {
            color: #2563eb;
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
                    <i class="la la-user-plus"></i> الصلاحيات
                </h4>
                <span class="text-muted mx-2">/ إضافة صلاحية</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (count($errors) > 0)
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

    <form action="{{ route('roles.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="la la-shield mr-2"></i> إضافة صلاحية جديدة
                        </h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">اسم الصلاحية: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-shield"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="أدخل اسم الصلاحية...">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">الأذونات: <span class="tx-danger">*</span></label>
                                <div class="row">
                                    @foreach($permissions as $value)
                                        <div class="col-md-4">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $value->id }}"
                                                    {{ in_array($value->id, old('permission', $assignedPermissions ?? [])) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $value->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permission') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-save mr-1"></i> تأكيد
                            </button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                <i class="la la-times mr-1"></i> إلغاء
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('/') }}assets/plugins/notify/js/notifIt.js"></script>
    <script src="{{ asset('/') }}assets/plugins/notify/js/notifit-custom.js"></script>
@endsection
