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

    @if (!isset($teacher))
        <div class="alert alert-danger">لمدرس غير موجود.</div>
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
            <td>{{ $teacher->user->name }}</td>
        </tr>
        <tr>
            <th>الإيميل</th>
            <td>{{ $teacher->user->email }}</td>
        </tr>
        <tr>
            <th>الحالة</th>
            {{-- <td>{{ $student->user->status ? 'مفعل' : 'غير مفعل' }}</td> --}}
                                                <td>
                                        @if ($teacher->user->status == 1)
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
    <h4>بيانات المدرس</h4>
    <table class="table table-bordered">
        <tr>
            <th>العنوان</th>
            <td>{{ $teacher->address }}</td>
        </tr>
        <tr>
            <th>النوع</th>
            <td>{{ $teacher->gender }}</td>
        </tr>
        <tr>
            <th> التخصص</th>
            <td>{{ $teacher->specialization }}</td>
        </tr>
        <tr>
            <th>الملاحظات</th>
            <td>{{ $teacher->note }}</td>
        </tr>
    </table>

    {{-- بيانات الفصل --}}
    <h4>الفصل</h4>
    <p>{{ $teacher->subject?->name ?? 'غير مسجل في مادة' }}</p>

</div></div></div></div></div></div>
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
