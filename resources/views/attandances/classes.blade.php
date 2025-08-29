@extends('layouts.master')
@section('title', 'الحضور والغياب')

@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الحضور</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الحضور والغياب</span>
        </div>
    </div>
</div>
@endsection

@section('content')
 <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                {{-- <div class="card-body">
    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">اضافة فصل</a>
    </div> --}}

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($Grades as $Grade)

                                <div class="acd-group">
                                    {{-- <a href="#" class="acd-heading">{{ $Grade->Name }}</a> --}}
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                {{-- @foreach ($Grade->Sections as $list_Sections) --}}
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        {{-- <td>{{ $i }}</td> --}}
                                                                        {{-- <td>{{ $list_Sections->Name_Section }}</td> --}}
                                                                        {{-- <td>{{ $list_Sections->My_classs->Name_Class }}</td> --}}
                                                                        <td>
                                                                            {{-- <label class="badge badge-{{$list_Sections->Status == 1 ? 'success':'danger'}}">{{$list_Sections->Status == 1 ? 'نشط':'غير نشط'}}</label> --}}
                                                                        </td>

                                                                        <td>
                                                                            {{-- <a href="{{route('Attendance.show',$list_Sections->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">قائمة الطلاب</a> --}}
                                                                        </td>
                                                                    </tr>
                                                                {{-- @endforeach --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

@endsection
