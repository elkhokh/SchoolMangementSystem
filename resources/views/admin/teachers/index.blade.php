@extends('layouts.master')

@section('title', 'قائمة المدرسين')

@section('css')

    <style>
        /* Styles خاصة بالصفحة */
        .label {
            font-size: 0.95rem;
            padding: 6px 12px;
            border-radius: 6px;
        }
        .dot-label {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-left: 8px;
        }
        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            border: none;
            background-color: #ffffff;
        }
        .dropdown-item {
            font-size: 1rem;
            padding: 10px 20px;
            color: #1e293b;
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #eff6ff;
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
                    <i class="la la-users"></i> المدرسين
                </h4>
                <span class="text-muted mx-2">/ قائمة المدرسين</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-md">
                    <i class="la la-plus mr-1"></i> إضافة مدرس
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
@if (session()->has('Add'))
    <script>
        notif({
            msg: "تمت الإضافة بنجاح ",
            type: "success"
        });
    </script>
@endif

@if (session()->has('Update'))
    <script>
        notif({
            msg: "تم التحديث بنجاح ",
            type: "success"
        });
    </script>
@endif

@if (session()->has('Delete'))
    <script>
        notif({
            msg: "تم الحذف بنجاح ",
            type: "success"
        });
    </script>
@endif

@if (session()->has('Error'))
    <script>
        notif({
            msg: "حدث خطأ ",
            type: "error"
        });
    </script>
@endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="card-title mb-4">
                        <i class="la la-list-alt mr-2"></i> قائمة المدرسين
                    </h5> --}}

                    @livewire('teachers')

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
