


@extends('layouts.master')

@section('title', 'قائمة الغياب')

@section('css')
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/accordion/accordion.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">متابعة الغياب والحضور</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفصول بالطلاب الخاصة بيهم</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <h2>تفاصيل حضور الطالب</h2>

    {{-- <div class="card mb-3">
        <div class="card-body">
            <h4>{{ $student->user->name }}</h4>
            <p><strong>الفصل:</strong> {{ $student->class->name }}</p>
            <p><strong>عدد الغيابات:</strong> {{ $absencesCount }}</p>
            <p><strong>عدد الإنذارات:</strong> {{ $warnings }}</p>
        </div>
    </div> --}}

    <h3>سجل الحضور</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>التاريخ</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($student->attendances as $attendance)
                <tr>
                    <td>{{ $attendance->attendence_date }}</td>
                    <td>
                        @if($attendance->attendence_status == 1)
                            <span class="badge bg-success">حاضر</span>
                        @else
                            <span class="badge bg-danger">غائب</span>
                        @endif
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

</div>
@endsection

@section('js')
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/accordion/accordion.min.js')}}"></script>
<script src="{{URL::asset('assets/js/accordion.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
