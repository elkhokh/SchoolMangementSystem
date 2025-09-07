@extends('layouts.master')
@section('title', 'تعديل المستخدم')
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
                    <i class="la la-user-edit"></i> المستخدمين
                </h4>
                <span class="text-muted mx-2">/ تعديل مستخدم</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session()->has('update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل المستخدم بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: "حدثت مشكلة أثناء التعديل",
                    type: "error",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label">اسم المستخدم: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" placeholder="أدخل اسم المستخدم...">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label">البريد الإلكتروني: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="example@email.com">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">كلمة المرور: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور...">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور...">
                                </div>
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="status" class="form-label">حالة المستخدم</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>مفعل</option>
                                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>غير مفعل</option>
                                </select>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">نوع المستخدم</label>
                                <div class="row">
                                    @foreach($roles as $id => $role)
                                        <div class="col-md-4">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role }}"
                                                    {{ in_array($role, old('roles', $userRoles)) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $role }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-save mr-1"></i> تحديث
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
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
