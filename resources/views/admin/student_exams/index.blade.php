@extends('layouts.master')

@section('title', 'الامتحانات المتاحة')

@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .table-responsive {
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .table {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead th {
            background: linear-gradient(180deg, #ecfdf5, #d1fae5);
            border-bottom: 1px solid #34d399;
            color: #064e3b;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }
        .table tbody tr {
            transition: all 0.3s ease;
            animation: fadeIn 0.5s ease-in-out;
        }
        .table tbody tr:hover {
            background-color: #f8fafc;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .table tbody td {
            font-size: 1rem;
            color: #1e293b;
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }
        .badge.bg-success {
            background-color: #34d399;
            color: #064e3b;
            padding: 6px 10px;
            border-radius: 6px;
        }
        .badge.bg-secondary {
            background-color: #6b7280;
            color: #ffffff;
            padding: 6px 10px;
            border-radius: 6px;
        }
        .btn-success {
            background-color: #34d399;
            border-color: #34d399;
            border-radius: 8px;
            padding: 8px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
            box-shadow: 0 4px 12px rgba(52, 211, 153, 0.3);
            transform: scale(1.05);
        }
        .pagination .page-link {
            color: #2563eb;
            border-radius: 6px;
            margin: 0 4px;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: #eff6ff;
            color: #1d4ed8;
        }
        .pagination .page-item.active .page-link {
            background-color: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            font-size: 1.2rem;
            color: #6b7280;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .table thead th, .table tbody td {
                font-size: 0.9rem;
                padding: 10px;
            }
            .btn-success {
                padding: 6px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-list-alt"></i> الامتحانات
                </h4>
                <span class="text-muted mx-2">/ الامتحانات المتاحة</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-md">
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
                        <i class="la la-list-alt mr-2"></i> الامتحانات المتاحة
                    </h5>
                    @if($studentExams->isEmpty())
                        <div class="empty-state">
                            <i class="la la-exclamation-circle la-2x mb-2"></i>
                            <p>لا توجد امتحانات متاحة حاليًا.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الامتحان</th>
                                        <th>المادة</th>
                                        <th>المدرس</th>
                                        <th>الحالة</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentExams as $exam)
                                        <tr style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $exam->title }}</td>
                                            <td>{{ $exam->subject->name ?? '-' }}</td>
                                            <td>{{ $exam->teacher->user->name ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $exam->status ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $exam->status ? 'مفعل' : 'غير مفعل' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('student_exams.show', $exam->id) }}" class="btn btn-success btn-sm">
                                                    <i class="la la-play mr-1"></i> أداء الامتحان
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $studentExams->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add animation to table rows
            const rows = document.querySelectorAll('.table tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
@endsection
