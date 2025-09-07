@extends('layouts.master')

@section('title', 'قائمة الغياب')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #f5f7fa;
        }

        .page-header {
            background-color: #1c2526;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #3498db;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .card-header.bg-success {
            background-color: #2ecc71 !important;
        }

        .card-header.bg-warning {
            background-color: #6c757d !important;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px;
            border-color: #e9ecef;
        }

        .modal-content {
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-header {
            background-color: #1c2526;
            color: white;
            border-bottom: none;
        }

        .modal-header .close {
            color: white;
            opacity: 1;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 8px;
            padding: 8px 20px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-success {
            background-color: #2ecc71;
            border-color: #2ecc71;
            border-radius: 8px;
            padding: 8px 20px;
        }

        .btn-success:hover {
            background-color: #27ae60;
            border-color: #27ae60;
        }

        .btn-warning {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 8px;
            padding: 8px 20px;
        }

        .btn-warning:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            border-color: #ced4da;
        }

        .accordion .card-header a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .accordion .card-header a:hover {
            opacity: 0.9;
        }

        .badge-success {
            background-color: #2ecc71;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .badge-warning {
            background-color: #6c757d;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .form-check-input {
            margin-left: 10px;
        }

        .form-check-label {
            cursor: pointer;
        }

        .text-success {
            color: #2ecc71 !important;
        }

        .text-warning {
            color: #6c757d !important;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-users mr-2"></i> متابعة الغياب والحضور</h4>
                <span class="text-white-50 mx-2">/ قائمة الفصول</span>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @if (session()->has('success'))
        <div id="successModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-check-circle mr-2"></i> نجاح العملية</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success" style="font-size: 50px; margin-bottom: 15px;"></i>
                            <h4 class="text-success font-weight-bold mb-4">تم تسجيل الغياب بنجاح</h4>
                            <button type="button" class="btn btn-success px-4" data-dismiss="modal">
                                <i class="fas fa-arrow-left mr-2"></i> متابعة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('Update'))
        <div id="updateSuccessModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title"><i class="fas fa-check-circle mr-2"></i> نجاح التعديل</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-check-circle text-primary" style="font-size: 50px; margin-bottom: 15px;"></i>
                            <h4 class="text-primary font-weight-bold mb-4">تم تعديل الغياب بنجاح</h4>
                            <button type="button" class="btn btn-primary px-4" data-dismiss="modal">
                                <i class="fas fa-arrow-left mr-2"></i> متابعة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('danger'))
        <div class="alert alert-warning text-center" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i> لم يتم تحديد طلاب لأخذ الغياب
        </div>
    @endif
    @if (session()->has('Error'))
        <div class="alert alert-danger text-center" role="alert">
            <i class="fas fa-times-circle mr-2"></i> حدث خطأ أثناء العملية
        </div>
    @endif
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">
                <!-- Choose Day -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i> اختيار اليوم</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('attandances.index') }}" method="GET" class="form-row align-items-center">
                            <div class="col-md-4">
                                <label for="date" class="font-weight-bold">التاريخ</label>
                            </div>
                            <div class="col-md-6">
                                <input type="date" id="date" name="date"
                                    value="{{ old('date', $select_day ?? date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-check mr-2"></i>
                                    تأكيد</button>
                            </div>
                            @error('date')
                                <div class="text-danger mt-2 col-12">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>
                <h5 class="font-weight-bold mb-4" style="color: #1c2526;">
                    <i class="fas fa-calendar-check mr-2"></i> التاريخ المختار: {{ $select_day }}
                </h5>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-list-alt mr-2"></i> قائمة الفصول</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @foreach ($classes as $class)
                                @php
                                    $mark_class_as_ok =
                                        $class->students->count() > 0 &&
                                        $class->students
                                            ->pluck('attendances')
                                            ->flatten()
                                            ->where('attendence_date', $select_day)
                                            ->count() == $class->students->count();
                                @endphp

                                <div class="card mb-3">
                                    <div class="card-header {{ $mark_class_as_ok ? 'bg-success' : 'bg-warning' }}"
                                        id="heading{{ $class->id }}">
                                        <h4 class="mb-0">
                                            <a href="#collapse{{ $class->id }}" class="d-flex align-items-center"
                                                data-toggle="collapse" aria-expanded="true"
                                                aria-controls="collapse{{ $class->id }}">
                                                <i class="fas fa-chevron-down mr-2"></i> {{ $class->name }}
                                                @if ($mark_class_as_ok)
                                                    <span class="badge badge-success ml-2">تم التسجيل</span>
                                                @else
                                                    <span class="badge badge-warning ml-2">غير مكتمل</span>
                                                @endif
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapse{{ $class->id }}" class="collapse"
                                        aria-labelledby="heading{{ $class->id }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <form action="{{ route('attandances.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="attendence_date"
                                                    value="{{ $select_day }}">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-center">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>اسم الطالب</th>
                                                                <th>ايميل الطالب</th>
                                                                <th>النوع</th>
                                                                <th>الحالة</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($class->students as $student)
                                                                @php $attendance = $student->attendances->first(); @endphp
                                                                <tr>
                                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                    <td>{{ $student->user->name }}</td>
                                                                    <td>{{ $student->user->email }}</td>
                                                                    <td>{{ $student->gender }}</td>
                                                                    <td>
                                                                        <div
                                                                            class="d-flex justify-content-center align-items-center">
                                                                            @if ($attendance)
                                                                                <span
                                                                                    class="{{ $attendance->attendence_status == '1' ? 'text-success' : 'text-warning' }} font-weight-bold">
                                                                                    <i
                                                                                        class="fas {{ $attendance->attendence_status == '1' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                                                                    {{ $attendance->attendence_status == '1' ? 'حضور' : 'غياب' }}
                                                                                </span>
                                                                                <button type="button"
                                                                                    class="btn btn-warning btn-sm mx-2"
                                                                                    data-toggle="modal"
                                                                                    data-target="#editModal{{ $attendance->id }}">
                                                                                    <i class="fas fa-edit"></i>
                                                                                </button>
                                                                            @else
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="attendance[{{ $student->id }}]"
                                                                                        value="1">
                                                                                    <label
                                                                                        class="form-check-label text-success font-weight-bold">حضور</label>
                                                                                </div>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio"
                                                                                        name="attendance[{{ $student->id }}]"
                                                                                        value="0">
                                                                                    <label
                                                                                        class="form-check-label text-warning font-weight-bold">غياب</label>
                                                                                </div>
                                                                                <input type="hidden"
                                                                                    name="class_id[{{ $student->id }}]"
                                                                                    value="{{ $class->id }}">
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button class="btn btn-success px-5" type="submit">
                                                        <i class="fas fa-save mr-2"></i> تأكيد
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($classes as $class)
        @foreach ($class->students as $student)
            @php $attendance = $student->attendances->first(); @endphp
            @if ($attendance)
                <div class="modal fade" id="editModal{{ $attendance->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel{{ $attendance->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="editModalLabel{{ $attendance->id }}">
                                    <i class="fas fa-user-edit mr-2"></i> تعديل حالة
                                    {{ $attendance->student->user->name }}
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('attandances.update', $attendance->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group text-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="attendence_status"
                                                value="1"
                                                {{ $attendance->attendence_status == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label text-success">حضور</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="attendence_status"
                                                value="0"
                                                {{ $attendance->attendence_status == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label text-warning">غياب</label>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-success mx-1">
                                            <i class="fas fa-save mr-2"></i> حفظ
                                        </button>
                                        <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">
                                            <i class="fas fa-times mr-2"></i> إلغاء
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
@endsection

@section('js')

@endsection
