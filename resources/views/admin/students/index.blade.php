@extends('layouts.master')
@section('title', 'قائمة الطلاب')
@section('css')

    <style>

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
        .modal-content {
            animation: slideIn 0.3s ease-in-out;
        }
        @keyframes slideIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
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
                    <i class="la la-users"></i> الطلاب
                </h4>
                <span class="text-muted mx-2">/ قائمة الطلاب</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('students.create') }}" class="btn btn-primary btn-md">
                    <i class="la la-plus mr-1"></i> إضافة طالب
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                $('#modaldemo4').modal('show');
            }
        </script>
    @endif
    @if (session()->has('Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل الطالب بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الطالب بنجاح",
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
                    msg: "حدث خطأ أثناء العملية",
                    type: "error",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif

    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('not_found'))
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('not_found') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">


                    {{-- Search Form --}}
                    <div class="mb-4 d-flex justify-content-start" style="gap: 10px; max-width: 400px;">
            
                         <form method="GET" action="{{ route('students.index') }}" class="d-flex" style="gap: 10px; max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="la la-search"></i>
                        </button>
                    </form>
                    </div>

                    <div class="table-responsive">
                        <table id="students-table" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الطالب</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الفصل</th>
                                    <th>النوع</th>
                                    <th>الحالة</th>
                                    <th>الصلاحيات</th>
                                    <th>غياب اليوم</th>
                                    <th>عدد مرات الغياب</th>
                                    <th>الإنذار</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($students->currentPage()-1) * $students->perPage() + 1; @endphp
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->user->email }}</td>
                                        <td>{{ $student->class->name ?? 'غير معروف' }}</td>
                                        <td>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                        <td>
                                            @if ($student->user->status == 1)
                                                <span class="label text-success d-flex align-items-center">
                                                    <div class="dot-label bg-success ml-1"></div> مفعل
                                                </span>
                                            @else
                                                <span class="label text-danger d-flex align-items-center">
                                                    <div class="dot-label bg-danger ml-1"></div> غير مفعل
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($student->user->getRoleNames()->isNotEmpty())
                                                @foreach ($student->user->getRoleNames() as $role)
                                                    <label class="badge badge-success">{{ $role }}</label>
                                                @endforeach
                                            @else
                                                <label class="badge badge-danger">غير معين</label>
                                            @endif
                                        </td>
                                        <td>
                                            @php $attendance_today = $student->attendances->first(); @endphp
                                            @if ($attendance_today)
                                                <span class="{{ $attendance_today->attendence_status ? 'text-success' : 'text-danger' }}">
                                                    {{ $attendance_today->attendence_status ? 'حضور' : 'غياب' }}
                                                </span>
                                            @else
                                                <span class="text-warning">لم يتم تسجيل الحضور</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $absenceCount = $student->attendances->where('attendence_status', 0)->count();
                                            @endphp
                                            {{ $absenceCount }}
                                        </td>
                                        <td>
                                            @if ($absenceCount > 2)
                                                <span class="badge badge-danger">⚠️ إنذار</span>
                                            @else
                                                <span class="badge badge-success">لا يوجد</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" type="button">
                                                    <i class="la la-cog mr-1"></i> العمليات
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('students.edit', $student->id) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="la la-edit text-primary mr-2"></i> تعديل بيانات الطالب
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="la la-trash-o mr-2"></i> حذف الطالب
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('students.show', $student->id) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="la la-eye text-info mr-2"></i> رؤية تفاصيل الطالب
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $students->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal alert message -->
    <div class="modal fade" id="modaldemo4" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 380px;">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="la la-check-circle" style="font-size: 70px; color: #34d399; margin-bottom: 20px;"></i>
                    <h4 style="color: #1e293b; font-size: 18px; font-weight: 600; margin-bottom: 25px;">تم إضافة الطالب بنجاح</h4>
                    <button type="button" class="btn btn-success" data-dismiss="modal">متابعة</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
