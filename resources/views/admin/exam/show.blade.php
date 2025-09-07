@extends('layouts.master')
@section('title', 'أسئلة الامتحان')
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
            margin-right: 10px;
        }
        .question-list li {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border: 1px solid #34d399;
            color: #064e3b;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .question-list li:hover {
            background: linear-gradient(180deg, #d1fae5, #a7f3d0);
            box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
            transform: scale(1.02);
        }
        .question-list ul {
            list-style: none;
            padding-right: 20px;
        }
        .question-list ul li {
            background: none;
            border: none;
            padding: 5px 0;
            font-size: 0.95rem;
            color: #1e293b;
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
                    <i class="la la-question-circle"></i> الامتحانات
                </h4>
                <span class="text-muted mx-2">/ أسئلة الامتحان: {{ $exam->title }}</span>
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
                        <i class="la la-question mr-2"></i> أسئلة الامتحان: {{ $exam->title }}
                    </h5>
                    <livewire:exam-questions :exam="$exam" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
