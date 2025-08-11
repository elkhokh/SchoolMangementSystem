@extends('layouts.master')
@section('title', 'إدارة الحصص')
@section('css')
    <!-- نفس روابط CSS لجدول البيانات وnotifIt -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الحصص</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الحصص</span>
            </div>
        </div>
    </div>
@endsection
@section('content')

@if (session()->has('Delete'))
<script>
    window.onload = function() {
        notif({ msg: "تم حذف الحصة بنجاح", type: "success" });
    }
</script>
@endif

@if (session()->has('Update'))
<script>
    window.onload = function() {
        notif({ msg: "تم تعديل الحصة بنجاح", type: "success" });
    }
</script>
@endif

@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({ msg: "تم إضافة الحصة بنجاح", type: "success" });
    }
</script>
@endif

@if (session()->has('Error'))
<script>
    window.onload = function() {
        notif({ msg: "حدث خطأ أثناء العملية", type: "danger" });
    }
</script>
@endif

<div class="row">
<div class="container mt-3">

    @if(session()->has('not_found'))
    <div class="alert alert-warning alert-dismissible fade show fs-5 w-75 mx-auto text-center" role="alert" style="background-color: #fff8e1; border-color: #ffecb3; color: #856404;">
        <strong>{{ session('not_found') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

</div>
<div class="col-xl-12">
    <div class="card mg-b-20 p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <a class="modal-effect btn btn-outline-primary" style="min-width: 300px;" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">
                    إضافة حصة جديدة
                </a>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('sessions.index') }}" class="d-flex" style="gap: 10px; max-width: 400px;">
                <select name="search" onchange="this.form.submit()" class="form-control">
                    <option value="">-- اختر اليوم --</option>
                    {{-- @foreach(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                        <option value="{{ $day }}" {{ request('search') == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach --}}
                </select>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table key-buttons text-md-nowrap" style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اليوم</th>
                            <th>اسم الفصل</th>
                            <th>اسم المادة</th>
                            <th>اسم المدرس</th>
                            <th>بداية الحصة</th>
                            <th>نهاية الحصة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php $i = ($sessions->currentPage()-1) * $sessions->perPage() + 1; @endphp
                        @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $session->day }}</td>
                            <td>{{ $session->class->name }}</td>
                            <td>{{ $session->subject->name }}</td>
                            <td>{{ $session->teacher->user->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</td>
                            <td>
                                <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('هل أنت متأكد؟')" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr> --}}


    <!-- مودال تعديل الحصة -->

    {{-- <div class="modal fade" id="editModal{{ $session->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('sessions.update', $session->id) }}" method="POST"> --}}
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الحصة</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>اليوم</label>
                            <select name="day" class="form-control" required>
                                {{-- @foreach(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                    <option value="{{ $day }}" {{ $session->day == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>اسم الفصل</label>
                            <select name="class_id" class="form-control" required>
                                {{-- @foreach(App\Models\Classes::all() as $class)
                                    <option value="{{ $class->id }}" {{ $session->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>اسم المادة</label>
                            <select name="subject_id" class="form-control" required>
                                {{-- @foreach(App\Models\Subjects::all() as $subject)
                                    <option value="{{ $subject->id }}" {{ $session->subject_id == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>اسم المدرس</label>
                            <select name="teacher_id" class="form-control" required>
                                {{-- @foreach(App\Models\Teacher::all() as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $session->teacher_id == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name ?? 'N/A' }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>وقت بداية الحصة</label>
                            {{-- <input type="time" name="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }}" required> --}}
                        </div>
                        <div class="form-group">
                            <label>وقت نهاية الحصة</label>
                            {{-- <input type="time" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}" required> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ التعديل</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- مودال حذف الحصة -->

    {{-- <div class="modal fade" id="deleteModal{{ $session->id }}" tabindex="-1" role="dialog" aria-hidden="true"> --}}
        <div class="modal-dialog" role="document">
            {{-- <form action="{{ route('sessions.destroy', $session->id) }}" method="POST"> --}}
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف الحصة</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{-- <p>هل أنت متأكد من حذف الحصة ليوم <strong>{{ $session->day }}</strong>، الفصل: <strong>{{ $session->class->name }}</strong>، المادة: <strong>{{ $session->subject->name }}</strong>؟</p> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">حذف</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                {{-- {{ $sessions->links() }} --}}
            </div>
        </div>
    </div>
</div>
</div>

{{-- مودال إضافة حصة جديدة --}}
<div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sessions.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة حصة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>اليوم</label>
                        <select name="day" class="form-control" required>
                            <option value="">اختر اليوم</option>
                            @foreach(['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>اسم الفصل</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">اختر الفصل</option>
                            @foreach(App\Models\Classes::all() as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>اسم المادة</label>
                        <select name="subject_id" class="form-control" required>
                            <option value="">اختر المادة</option>
                            @foreach(App\Models\Subjects::all() as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>اسم المدرس</label>
                        <select name="teacher_id" class="form-control" required>
                            <option value="">اختر المدرس</option>
                            @foreach(App\Models\Teacher::all() as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->user->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>وقت بداية الحصة</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>وقت نهاية الحصة</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">إضافة</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        @if ($errors->any())
            $(document).ready(function () {
                $('#modaldemo8').modal('show');
            });
        @endif
    </script>
@endsection
