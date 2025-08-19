@extends('layouts.master')
@section('title', 'تفاصيل الطالب')

@section('css')
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلاب</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الطالب</span>
            </div>
        </div>
    </div>
@endsection

@section('content')

    @if (!isset($student))
        <div class="alert alert-danger">الطالب غير موجود.</div>
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
                                                <li><a href="#tab_info" class="nav-link active" data-toggle="tab">معلومات
                                                        الطالب</a></li>
                                                <li><a href="#tab_attach" class="nav-link" data-toggle="tab">المرفقات</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">

                                            <div class="tab-pane active" id="tab_info">
                                                <div class="table-responsive mt-3">
                                {{-- بيانات المستخدم الأساسية --}}
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
            {{-- <td>{{ $student->user->status ? 'مفعل' : 'غير مفعل' }}</td> --}}
                                                <td>
                                        @if ($student->user->status == 1)
                                            <span class="label text-success d-flex">
                                                <div class="dot-label bg-success ml-1"></div>مفعل
                                            </span>
                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>غير مفعل
                                            </span>
                                        @endif
                                    </td>

        </tr>
    </table>

    {{-- بيانات الطالب --}}
    <h4>بيانات الطالب</h4>
    <table class="table table-bordered">
        <tr>
            <th>العنوان</th>
            <td>{{ $student->address }}</td>
        </tr>
        <tr>
            <th>النوع</th>
            <td>{{ $student->gender }}</td>
        </tr>
        <tr>
            <th>تاريخ الميلاد</th>
            <td>{{ $student->birth_date }}</td>
        </tr>
        <tr>
            <th>الملاحظات</th>
            <td>{{ $student->note }}</td>
        </tr>
    </table>

    {{-- بيانات الفصل --}}
    <h4>الفصل</h4>
    <p>{{ $student->class?->name ?? 'غير مسجل في فصل' }}</p>

    {{-- بيانات المرفقات --}}
    @if($student->attachments)
        <h4>معلومات ولي الأمر</h4>
        <table class="table table-bordered">
            <tr>
                <th>اسم الأب</th>
                <td>{{ $student->attachments->father_name }}</td>
            </tr>
            <tr>
                <th>اسم الأم</th>
                <td>{{ $student->attachments->mother_name }}</td>
            </tr>
            <tr>
                <th>إيميل ولي الأمر</th>
                <td>{{ $student->attachments->parent_email }}</td>
            </tr>
            <tr>
                <th>تليفون ولي الأمر</th>
                <td>{{ $student->attachments->parent_phone }}</td>
            </tr>
            <tr>
                <th> الملاحظات الخاصة ببيانات ولي الامر</th>
                <td>{{ $student->attachments->note ?? 'مفيش' }}</td>
            </tr>
    <tr>
    <th>الملف المرفق</th>
    <td>
        @if($student->attachments->file_name)
            <a href="{{ asset('storage/' . $student->attachments->file_name) }}" target="_blank">
                <img src="{{ asset('storage/' . $student->attachments->file_name) }}"
        alt="Attachment"  class="img-thumbnail rounded shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
        @else
            <span class="text-muted">لا يوجد</span>
        @endif
    </td>
</tr>

        </table>
    @endif

    {{-- المواد --}}
    <h4>المواد المسجل بها</h4>
    <ul>
        @forelse($student->subjects as $subject)
            <li>{{ $subject->name }} (الدرجة: {{ $subject->degree }})</li>
        @empty
            <li>لا يوجد مواد مسجلة</li>
        @endforelse
    </ul>

    {{-- المدرسين --}}
    <h4>المدرسين</h4>
    <ul>
        @forelse($student->teachers as $teacher)
            <li>{{ $teacher->user->name ?? 'بدون اسم' }}</li>
        @empty
            <li>لا يوجد مدرسين مرتبطين</li>
        @endforelse
    </ul>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    @endif
@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection
