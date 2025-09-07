@extends('layouts.master')

@section('title', 'أداء امتحان: ' . $exam->title)

@section('css')
    <style>
        .question-card {
            background: linear-gradient(180deg, #ffffff, #f8fafc);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-in-out;
        }
        .question-card .card-header {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border-bottom: 1px solid #34d399;
            color: #064e3b;
            font-weight: 600;
            font-size: 1.2rem;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
            transition: all 0.3s ease;
        }
        .question-card:hover .card-header {
            background: linear-gradient(180deg, #d1fae5, #a7f3d0);
            box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
        }
        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            margin-top: 0.3rem;
            transition: all 0.3s ease;
        }
        .form-check-label {
            font-size: 1.05rem;
            color: #1e293b;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .form-check:hover .form-check-label {
            color: #2563eb;
        }
        .form-control {
            border-radius: 10px;
            font-size: 1.05rem;
            padding: 12px 40px 12px 12px;
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.3);
        }
        .form-control::placeholder {
            color: #9ca3af;
        }
        .input-group-text {
            background-color: #f1f5f9;
            border: 1px solid #d1d5db;
            border-radius: 10px 0 0 10px;
            padding: 12px;
            color: #64748b;
        }
        .progress-bar {
            background-color: #34d399;
            transition: width 0.3s ease;
        }
        .alert {
            animation: fadeIn 0.5s ease-in-out;
        }
        .alert-success {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border: 1px solid #34d399;
            color: #064e3b;
            font-size: 1.1rem;
            margin: 1.5rem auto;
            width: 80%;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            text-align: center;
        }
        .alert-danger {
            background: linear-gradient(180deg, #fef2f2, #fee2e2);
            border: 1px solid #f87171;
            color: #991b1b;
            font-size: 1.1rem;
            margin: 1.5rem auto;
            width: 80%;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            text-align: center;
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            font-size: 1.2rem;
            color: #6b7280;
        }
        .timer {
            font-size: 1.1rem;
            padding: 8px 12px;
            border-radius: 6px;
        }
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .modal-header {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border-bottom: 1px solid #34d399;
            color: #064e3b;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .question-card .card-header {
                font-size: 1rem;
            }
            .form-check-label, .form-control {
                font-size: 0.95rem;
            }
            .btn {
                padding: 8px 15px;
                font-size: 0.95rem;
            }
            .timer {
                font-size: 0.95rem;
            }
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-exam"></i> الامتحانات
                </h4>
                <span class="text-muted mx-2">/ أداء امتحان: {{ $exam->title }}</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('student_exams.index') }}" class="btn btn-secondary btn-md">
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
                    <h5 class="card-title mb-4">
                        <i class="la la-exam mr-2"></i> أداء امتحان: {{ $exam->title }}
                    </h5>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <div class="alert alert-danger text-center">
                            <i class="la la-exclamation-circle mr-2"></i> يجب تسجيل الدخول لأداء الامتحان.
                        </div>
                    @else
                        {{-- @livewire('take-exam', ['exam' => $exam]) --}}
                        <livewire:take-exam :exam="$exam" />
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.question-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
@endsection
