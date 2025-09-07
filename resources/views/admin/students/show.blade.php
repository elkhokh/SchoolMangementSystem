@extends('layouts.master')

@section('title', 'تفاصيل الطالب')

@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .tabs-menu1 .nav.panel-tabs li a {
            font-size: 1.1rem;
            padding: 12px 20px;
            color: #1e293b;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
        }
        .tabs-menu1 .nav.panel-tabs li a.active {
            background-color: #eff6ff;
            color: #2563eb;
            border-bottom: 3px solid #2563eb;
        }
        .tabs-menu1 .nav.panel-tabs li a:hover {
            background-color: #f0f9ff;
            color: #2563eb;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 16px;
            font-size: 1.05rem;
        }
        .table thead th {
            background-color: #e0f2fe;
            color: #1e293b;
            font-weight: 700;
            border-bottom: 2px solid #bfdbfe;
        }
        .table tbody tr:hover {
            background-color: #f0f9ff;
            transition: background-color 0.3s ease;
        }
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
        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .subject-card, .teacher-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .subject-card:hover, .teacher-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
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
                    <i class="la la-user"></i> الطلاب
                </h4>
                <span class="text-muted mx-2">/ تفاصيل الطالب</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('students.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (!isset($student))
        <div class="alert alert-danger text-center">
            الطالب غير موجود.
        </div>
    @else
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card mg-b-20" id="tabs-style2">
                    <div class="card-body">
                        <div class="text-wrap">
                            <div class="example">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <ul class="nav panel-tabs main-nav-line">
                                                <li><a href="#tab_info" class="nav-link active" data-toggle="tab"><i class="la la-info-circle mr-2"></i>معلومات الطالب</a></li>
                                                <li><a href="#tab_attach" class="nav-link" data-toggle="tab"><i class="la la-paperclip mr-2"></i>المرفقات</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_info">
                                                <div class="table-responsive mt-3">
                                                    {{-- بيانات المستخدم الأساسية --}}
                                                    <h5 class="content-title mb-4"><i class="la la-user mr-2"></i>بيانات المستخدم الأساسية</h5>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>اسم المستخدم</th>
                                                            <td>{{ $student->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الإيميل</th>
                                                            <td>{{ $student->user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الحالة</th>
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
                                                        </tr>
                                                    </table>

                                                    {{-- بيانات الطالب --}}
                                                    <h5 class="content-title mb-4"><i class="la la-graduation-cap mr-2"></i>بيانات الطالب</h5>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>العنوان</th>
                                                            <td>{{ $student->address ?? 'غير محدد' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>النوع</th>
                                                            <td>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>تاريخ الميلاد</th>
                                                            <td>{{ $student->birth_date ?? 'غير محدد' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الملاحظات</th>
                                                            <td>{{ $student->note ?? 'لا يوجد' }}</td>
                                                        </tr>
                                                    </table>

                                                    {{-- بيانات الفصل --}}
                                                    <h5 class="content-title mb-4"><i class="la la-school mr-2"></i>الفصل</h5>
                                                    <p>{{ $student->class?->name ?? 'غير مسجل في فصل' }}</p>

                                                    {{-- المواد --}}
                                                    <h5 class="content-title mb-4"><i class="la la-book mr-2"></i>المواد المسجل بها</h5>
                                                    <div class="row">
                                                        @forelse($student->subjects as $subject)
                                                            <div class="col-md-4">
                                                                <div class="subject-card">
                                                                    <i class="la la-book mr-2 text-primary"></i>
                                                                    {{ $subject->name }} (الدرجة: {{ $subject->degree ?? 'غير محدد' }})
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <p class="text-muted">لا يوجد مواد مسجلة</p>
                                                        @endforelse
                                                    </div>

                                                    {{-- المدرسين --}}
                                                    <h5 class="content-title mb-4"><i class="la la-chalkboard-teacher mr-2"></i>المدرسين</h5>
                                                    <div class="row">
                                                        @forelse($student->teachers as $teacher)
                                                            <div class="col-md-4">
                                                                <div class="teacher-card">
                                                                    <i class="la la-chalkboard-teacher mr-2 text-primary"></i>
                                                                    {{ $teacher->user->name ?? 'بدون اسم' }}
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <p class="text-muted">لا يوجد مدرسين مرتبطين</p>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab_attach">
                                                @if($student->attachments)
                                                    <h5 class="content-title mb-4"><i class="la la-paperclip mr-2"></i>معلومات ولي الأمر</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>اسم الأب</th>
                                                                <td>{{ $student->attachments->father_name ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>اسم الأم</th>
                                                                <td>{{ $student->attachments->mother_name ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>إيميل ولي الأمر</th>
                                                                <td>{{ $student->attachments->parent_email ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>تليفون ولي الأمر</th>
                                                                <td>{{ $student->attachments->parent_phone ?? 'غير محدد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>ملاحظات المرفقات</th>
                                                                <td>{{ $student->attachments->note ?? 'لا يوجد' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>الملف المرفق</th>
                                                                <td>
                                                                    @if($student->attachments->file_name)
                                                                        <a href="{{ asset('storage/' . $student->attachments->file_name) }}" target="_blank">
                                                                            <img src="{{ asset('storage/' . $student->attachments->file_name) }}"
                                                                                alt="Attachment" class="img-thumbnail rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                                                                        </a>
                                                                    @else
                                                                        <span class="text-muted">لا يوجد</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p class="text-muted">لا توجد مرفقات متاحة</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.nav.panel-tabs a').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@endsection
