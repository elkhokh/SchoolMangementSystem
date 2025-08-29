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
@if (session()->has('success'))
<script>
    window.onload = function() {
        $('#modaldemo4').modal('show');
    }
</script>
@endif

@if (session()->has('Update'))
<script>
    window.onload = function() {
        $('#modalUpdateSuccess').modal('show');
    }
</script>
@endif

@if (session()->has('danger'))
<script>
    window.onload = function() {
        notif({ msg: "لم يتم تحديد طلاب لأخذ الغياب",
         type: "danger",
          position: "center",
          timeout: 3000 });
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
    <div class="col-lg-12 col-md-12">
{{-- choise day  --}}
        <div class="mb-3">
            <form action="{{ route('attandances.index') }}" method="GET" class="form-inline">
                <label for="date" class="mr-2">اختر التاريخ:</label>
                <input type="date" id="date" name="date"
                    value="{{ request('date', date('Y-m-d')) }}"
                class="form-control mr-2">
                <button type="submit" class="btn btn-gray">عرض</button>
            </form>
        </div>

      {{-- show day --}}
        <h5 style="font-family: 'Cairo', sans-serif; color: red">
            التاريخ المختار : {{ $selectedDate }}
        </h5>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">قائمة الفصول</h3>
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">

@foreach($classes as $class)

{{-- start mark  --}}
{{--  here i need to show all classes and check if all students in the class taken the attandance or not--}}
@php    $mark_class_as_ok = (
//first check if class have students or not
($class->students->count() > 0 ) &&
//get all attendances at this class and get all arhive of each student with flatten and taken the just attandence today with count students
($class->students->pluck('attendances')->flatten()->where('attendence_date', $selectedDate)->count())
== ($class->students->count())
        );     @endphp
{{-- end mark --}}
<div class="card mb-2">
{{-- mark --}}
<div class="card-header {{ $mark_class_as_ok ? 'bg-success' : 'bg-dark' }}" id="heading{{ $class->id }}">
{{-- mark --}}
{{-- <div class="card-header" id="heading{{ $class->id }}"> --}}
    <h4 class="m-0">
    <a href="#collapse{{ $class->id }}" class="text-dark d-flex align-items-center" data-toggle="collapse" aria-expanded="true">
    <i class="si si-cursor-move ml-2"></i> {{ $class->name }}
{{-- mark --}}
    @if($mark_class_as_ok)
    <span class="badge badge-success ml-2">تم تسجيل الغياب</span>
    @endif
{{-- mark --}}
</a></h4></div>

                <div id="collapse{{ $class->id }}" class="collapse" aria-labelledby="heading{{ $class->id }}" data-parent="#accordionExample">
                                <form action="{{ route('attandances.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="attendence_date" value="{{ $selectedDate }}">
                                    <div class="border p-3">
                                        <table class="table table-bordered text-center">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>اسم الطالب</th>
                                                    <th>ايميل الطالب</th>
                                                    <th>نوع الطالب</th>
                                                    <th>عملية الغياب</th>
                                                </tr>
                                            </thead>
                                            <tbody>

    {{-- <div id="collapse{{ $class->id }}" class="collapse" aria-labelledby="heading{{ $class->id }}" data-parent="#accordionExample">
                <form action="{{ route('attandances.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="attendence_date" value="{{ date('Y-m-d') }}">
                    <div class="border p-3">
                <table class="table table-bordered text-center">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>اسم الطالب</th>
                    <th>ايميل الطالب</th>
                    <th>نوع الطالب</th>
                    <th>عملية الغياب</th>
                </tr>
            </thead>
            <tbody> --}}

                    @foreach($class->students as $student)
        @php $attendance = $student->attendances->first(); @endphp
                <tr>
            <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $student->user->name }}</td>
            <td>{{ $student->user->email }}</td>
            <td>{{ $student->gender }}</td>
            <td>
                <div class="d-flex justify-content-center">

            @if($attendance)
{{--  1 presence --}}
        <span class="{{ $attendance->attendence_status == '1' ? 'text-success' : 'text-danger' }}">
                {{ $attendance->attendence_status == '1' ? 'حضور' : 'غياب' }}
                </span>
<button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#editModal{{ $attendance->id }}">
                تعديل    </button>
            @else
        <label class="mr-3">
            {{-- presence 1 --}}
<input type="radio" name="attendance[{{ $student->id }}]" value="1">
<span class="text-success font-weight-bold">حضور</span>
                </label>
                {{-- 0 absent --}}
        <label>
            <input type="radio" name="attendance[{{ $student->id }}]" value="0">
        <span class="text-danger font-weight-bold">غياب</span>
            </label>
    <input type="hidden" name="class_id[{{ $student->id }}]" value="{{ $class->id }}">
        @endif
    </div></td>
            </tr>
        @endforeach
        </tbody>
        </table>
        <div class="mt-3 text-center">
    <button class="btn btn-success px-4" type="submit">تأكيد الحضور والغياب لفصل {{ $class->name }}</button>
        </div></div>
                </form>
    </div></div>
@endforeach
</div></div></div></div></div>
                                                {{-- @foreach($class->students as $student)
                                                    @php $attendance = $student->attendances->first(); @endphp
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $student->user->name }}</td>
                                                        <td>{{ $student->user->email }}</td>
                                                        <td>{{ $student->gender }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                @if($attendance)
                                                                    <span class="{{ $attendance->attendence_status == '1' ? 'text-success' : 'text-danger' }}">
                                                                        {{ $attendance->attendence_status == '1' ? 'حضور' : 'غياب' }}
                                                                    </span>
                                                                    <button type="button" class="btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#editModal{{ $attendance->id }}">
                                                                        تعديل
                                                                    </button>
                                                                @else
                                                                    <label class="mr-3">
                                                                        <input type="radio" name="attendance[{{ $student->id }}]" value="1">
                                                                        <span class="text-success font-weight-bold">حضور</span>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="attendance[{{ $student->id }}]" value="0">
                                                                        <span class="text-danger font-weight-bold">غياب</span>
                                                                    </label>
                                                                    <input type="hidden" name="class_id[{{ $student->id }}]" value="{{ $class->id }}">
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-3 text-center">
                                            <button class="btn btn-success px-4" type="submit">
                                                تأكيد الحضور والغياب لفصل {{ $class->name }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div> --}}


{{-- @foreach($classes as $class)
    @foreach($class->students as $student)
        @php $attendance = $student->attendances->first(); @endphp
        @if($attendance)
            <div class="modal fade" id="editModal{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $attendance->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content p-3">
                        <form action="{{ route('attandances.update', $attendance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <h5 class="text-center mb-3">تعديل الغياب للطالب {{ $attendance->student->user->name }}</h5>
                            <div class="form-group text-center">
                                <label class="mr-3">
                                    <input type="radio" name="attendence_status" value="1" {{ $attendance->attendence_status == '1' ? 'checked' : '' }}> حضور
                                </label>
                                <label>
                                    <input type="radio" name="attendence_status" value="0" {{ $attendance->attendence_status == '0' ? 'checked' : '' }}> غياب
                                </label>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-success">حفظ</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endforeach --}}

 {{-- model edit  --}}
@foreach($classes as $class)
    @foreach($class->students as $student)
        @php $attendance = $student->attendances->first(); @endphp
                        @if($attendance)

<div class="modal fade" id="editModal{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $attendance->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content p-3">

<form action="{{ route('attandances.update', $attendance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
        <h5 class="text-center mb-3">تعديل الغياب للطالب {{ $attendance->student->user->name }}</h5>
            <div class="form-group text-center">
        <label class="mr-3">
{{-- 1 presence --}}
<input type="radio" name="attendence_status" value="1" {{ $attendance->attendence_status == '1' ? 'checked' : '' }}>
        حضور</label>
    <label>
        {{-- 0 absent --}}
<input type="radio" name="attendence_status" value="0" {{ $attendance->attendence_status == '0' ? 'checked' : '' }}>
        غياب</label>
    </div>
    <div class="text-center mt-3">
    <button type="submit" class="btn btn-success">حفظ</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
    </div>
</form>
</div></div></div>
@endif
@endforeach
@endforeach

<!-- Modal message -->
<div class="modal fade" id="modaldemo4" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 380px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <div class="modal-body" style="padding: 30px 25px; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 20px; opacity: 0.6;">
                     <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-circle-outline" style="font-size: 70px; color: #28a745; margin-bottom: 20px; display: inline-block;"></i>
                <h4 style="color: #28a745; font-size: 18px; font-weight: 600; margin-bottom: 25px;">تم تسجيل الغياب </h4>
                <button type="button" class="btn" data-dismiss="modal" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; border-radius: 25px; padding: 10px 30px; color: white; font-weight: 600;"> متابعة </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalUpdateSuccess" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 380px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <div class="modal-body" style="padding: 30px 25px; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position: absolute; top: 15px; right: 20px; opacity: 0.6;">
                     <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-circle-outline"
                   style="font-size: 70px; color: #2d047f; margin-bottom: 20px; display: inline-block;"></i>
                <h4 style="color: #34059a; font-size: 18px; font-weight: 600; margin-bottom: 25px;">
                    تم التعديل الغياب بنجاح
                </h4>
                <button type="button" class="btn" data-dismiss="modal"
                        style="background: linear-gradient(135deg, #00055e 0%, #001aaa 100%);
                               border: none; border-radius: 25px; padding: 10px 30px; color: white; font-weight: 600;">
                    متابعة
                </button>
            </div>
        </div>
    </div>
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
<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Attendances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreAttendancesRequest;

class AttendancesController extends Controller
{

    public function index(Request $request)
    {
        try {

            $selectedDate = $request->input('date', date('Y-m-d'));

            $classes = Classes::whereHas('students')
                ->with([
                    'students.attendances' => function($data) use ($selectedDate) {
                        $data->where('attendence_date', $selectedDate)->with('student.user');
                    },
                    'students.user'
                ])->get();

            foreach ($classes as $class) {
                $class->allMarked = $class->students->count() > 0 &&
                    $class->students->pluck('attendances')->flatten()
                        ->where('attendence_date', $selectedDate)->count() == $class->students->count();
            }

            return view('attandances.index', compact('classes', 'selectedDate'));

        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
            return redirect()->back();
        }
    }

    public function store(StoreAttendancesRequest $request)
    {
        try {
            $selectedDate = $request->attendence_date;

            if (!$request->has('attendance')) {
                session()->flash('danger');
                return redirect()->back();
            }

            foreach ($request->attendance as $student_id => $status) {
                $Check_status = Attendances::where('student_id', $student_id)
                    ->where('attendence_date', $selectedDate)
                    ->first();

                if ($Check_status) {
                    $Check_status->update([
                        'attendence_status' => $status,
                        'class_id'          => $request->class_id[$student_id],
                    ]);
                } else {
                    Attendances::create([
                        'student_id'        => $student_id,
                        'class_id'          => $request->class_id[$student_id],
                        'attendence_date'   => $selectedDate,
                        'attendence_status' => $status,
                    ]);
                }
            }

            session()->flash('success');
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        try {
            $attendance = Attendances::findOrFail($id);

            $request->validate([
                'attendence_status' => 'required|in:1,0',
            ]);

            $attendance->update([
                'attendence_status' => $request->attendence_status
            ]);

            session()->flash('Update');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
            return redirect()->back();
        }
    }
}
