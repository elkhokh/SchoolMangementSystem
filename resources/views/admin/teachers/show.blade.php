@extends('layouts.master')

@section('title', 'تفاصيل المدرس')

@section('css')
    <style>
        /* Styles خاصة بالصفحة */
        .tabs-menu1 ul.nav li a {
            font-size: 1.05rem;
            padding: 12px 24px;
            border-radius: 8px 8px 0 0;
            color: #1e293b;
            background-color: #f1f5f9;
            transition: all 0.3s ease;
        }
        .tabs-menu1 ul.nav li a.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
        }
        .tabs-menu1 ul.nav li a:hover {
            background-color: #e0f2fe;
            color: #2563eb;
        }
        .tab-content {
            background-color: #ffffff;
            border-radius: 0 0 8px 8px;
            padding: 24px;
            border: 1px solid #e5e7eb;
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
                    <i class="la la-user"></i> المدرسين
                </h4>
                <span class="text-muted mx-2">/ تفاصيل المدرس</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-md">
                    <i class="la la-arrow-right mr-1"></i> رجوع
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (!isset($teacher))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>المدرس غير موجود.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                                                <li><a href="#tab_info" class="nav-link active" data-toggle="tab">معلومات المدرس</a></li>
                                                <li><a href="#tab_attach" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_info">
                                                <h4 class="mb-4">بيانات المستخدم الأساسية</h4>
                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>اسم المستخدم</th>
                                                            <td>{{ $teacher->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الإيميل</th>
                                                            <td>{{ $teacher->user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الحالة</th>
                                                            <td>
                                                                @if ($teacher->user->status == 1)
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
                                                </div>

                                                <h4 class="mb-4">بيانات المدرس</h4>
                                                <div class="table-responsive mb-5">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>العنوان</th>
                                                            <td>{{ $teacher->address ?? 'غير محدد' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>النوع</th>
                                                            <td>{{ $teacher->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>التخصص</th>
                                                            <td>{{ $teacher->specialization ?? 'غير محدد' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>الملاحظات</th>
                                                            <td>{{ $teacher->note ?? 'لا توجد ملاحظات' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <h4 class="mb-4">المادة</h4>
                                                <p>{{ $teacher->subject?->name ?? 'غير مسجل في مادة' }}</p>
                                            </div>

                                            <div class="tab-pane" id="tab_attach">
                                                <p class="text-muted">لم يتم إضافة مرفقات بعد.</p>
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
            $('.panel-tabs li a').on('click', function () {
                $(this).tab('show');
            });
        });
    </script>
@endsection
