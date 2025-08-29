@extends('layouts.master')
@section('title', 'قائمة الطلاب')

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
            <h4 class="content-title mb-0 my-auto">الطلاب</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الطلاب</span>
        </div>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-md">إضافة طالب</a>
    </div>
</div>
@endsection

@section('content')
{{-- @if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({ msg: "تم إضافة الطالب بنجاح",
         type: "success", position: "center",
         timeout: 3000 });
    }
</script>
@endif --}}


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
        notif({ msg: "تم تعديل الطالب بنجاح", type: "success", position: "center", timeout: 3000 });
    }
</script>
@endif
@if (session()->has('Delete'))
<script>
    window.onload = function() {
        notif({ msg: "تم حذف الطالب بنجاح", type: "success", position: "center", timeout: 3000 });
    }
</script>
@endif
@if (session()->has('Error'))
<script>
    window.onload = function() {
        notif({ msg: "حدث خطأ أثناء العملية",
        type: "info",
        position: "center", timeout: 3000 });
    }
</script>
@endif

<div class="row">
    <div class="col-lg-12">

    @if(session()->has('not_found'))
<div class="alert alert-warning alert-dismissible fade show fs-5 w-75 mx-auto text-center" role="alert" style="background-color: #fff8e1; border-color: #ffecb3; color: #856404;">
    <strong>{{ session('not_found') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">قائمة الطلاب</h5>
                        {{-- Search Form --}}
                <div class="mb-3 d-flex justify-content-start" style="gap: 10px; max-width: 400px;">
                    <form method="GET" action="{{ route('students.index') }}" class="d-flex w-100" style="gap: 10px;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث باسم الطالب"
                        {{-- value="{{ request('search') }}"> --}}
                        value="{{ $search}}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
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
                                <th> عدد مرات الغياب</th>
                                <th>الانذار</th>
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
                                <td>{{ $student->class->name ?? 'مش معروف' }}</td>
                                <td>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
        {{-- <td>{{ \Illuminate\Support\Str::limit($invoice->note, 10, '..') }}</td> --}}
                        <td>
                        @if ( $student->user->status  == 1)<span class="label text-success d-flex">
                        <div class="dot-label bg-success ml-1"></div>مفعل</span>
                        @else <span class="label text-danger d-flex">
                        <div class="dot-label bg-danger ml-1"></div>غير مفعل</span>
                        @endif</td>
                        <td>
                        @if ($student->user->getRoleNames()->isNotEmpty())
                        @foreach ($student->user->getRoleNames() as $role)
                        <label class="badge badge-success">{{ $role }}</label>
                        @endforeach
                        @else<label class="badge badge-danger">غير معين</label>@endif
                        </td>
                        <td>
        @php   $attendance_today = $student->attendances->first();      @endphp

        @if($attendance_today)
            <span class="{{ $attendance_today->attendence_status ? 'text-success' : 'text-danger' }}">
                {{ $attendance_today->attendence_status ? 'حضور' : 'هربان ومحضرش' }}
            </span>
        @else
            <span class="text-warning">متاخدش غيابه</span>
        @endif
    </td>

 <td>
        @php
            $absenceCount = $student->attendances->where('attendence_status', 0)->count();
        @endphp
        {{ $absenceCount }}
    </td>

    {{-- الانذار --}}
    <td>
        @if($absenceCount > 2)
            <span class="badge badge-danger">⚠️ انذار</span>
        @else
            <span class="badge badge-success">لا يوجد</span>
        @endif
    </td>

<td>
    <div class="dropdown">
        <button aria-expanded="false" aria-haspopup="true"
            class="btn ripple btn-info btn-sm" data-toggle="dropdown"
            type="button">
            العمليات <i class="fas fa-caret-down ml-1"></i>
        </button>
        <div class="dropdown-menu tx-13">

{{-- edit student --}}
            <form action="{{ route('students.edit', $student->id) }}" method="GET">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-edit text-primary"></i> تعديل بيانات الطالب
                </button>
            </form>

            {{-- delete  --}}
            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash-alt"></i> حذف الطالب
                </button>
            </form>

     {{--  archive --}}
            {{-- <form action="{{ route('students.show', $student->id) }}" method="POST"
                onsubmit="return confirm('هل تريد نقل الطالب إلى الأرشيف؟');">
                @csrf
                @method('PUT')
                <button type="submit" class="dropdown-item text-warning">
                    <i class="fas fa-exchange-alt"></i> نقل الطالب إلى الأرشيف
                </button>
            </form> --}}

           {{-- show --}}
            <form action="{{ route('students.show', $student->id) }}" method="GET">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-eye text-info"></i> رؤية تفاصيل الطالب
                </button>
            </form>

            {{-- طباعة بيانات الطالب --}}
            {{-- <form action="{{ url('Print_invoice', $student->id) }}" method="GET" target="_blank">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="text-success fas fa-print"></i> طباعة بيانات الطالب
                </button>
            </form>

        </div>
    </div>
</td> --}}
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                 {{ $students->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal alert message --> <div class="modal fade" id="modaldemo4" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 380px;">
         <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <div class="modal-body" style="padding: 30px 25px; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 20px; opacity: 0.6;">
                     <span aria-hidden="true">&times;</span>
                    </button> <i class="icon ion-ios-checkmark-circle-outline" style="font-size: 70px; color: #28a745; margin-bottom: 20px; display: inline-block;"></i>
                     <h4 style="color: #28a745; font-size: 18px; font-weight: 600; margin-bottom: 25px;">تم اضافة الطالب بنجاح    </h4>
                     <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 25px; padding: 10px 30px; color: white; font-weight: 600;"> متابعة </button>
</div> </div> </div> </div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
