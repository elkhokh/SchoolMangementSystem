@extends('layouts.master')
@section('title', 'قائمة المدرسين')

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
        <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-md">إضافة مدرس</a>
    </div>
</div>
@endsection

@section('content')
@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({ msg: "تم إضافة المدرس بنجاح",
        type: "success",
        position: "center",
        timeout: 3000 });
    }
</script>
@endif
@if (session()->has('Update'))
<script>
    window.onload = function() {
        notif({ msg: "تم تعديل المدرس بنجاح",
        type: "success",
        position: "center",
        timeout: 3000 });
    }
</script>
@endif
@if (session()->has('Delete'))
<script>
    window.onload = function() {
        notif({ msg: "تم حذف المدرس بنجاح",
        type: "success",
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
                    <form method="GET" action="{{ route('teachers.index') }}" class="d-flex w-100" style="gap: 10px;">
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
                                <th>اسم المدرس</th>
                                <th>البريد الإلكتروني</th>
                                <th>المادة</th>
                                <th>النوع</th>
                                <th>الحالة</th>
                                <th>الصلاحيات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
            @php $i = ($teachers->currentPage()-1) * $teachers->perPage() + 1; @endphp
                            @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $teacher->user->name }}</td>
                                <td>{{ $teacher->user->email }}</td>
                                <td>{{ $teacher->subject->name ?? 'غير محدد' }}</td>
                                <td>{{ $teacher->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                        <td>
                        @if ( $teacher->user->status  == 1)<span class="label text-success d-flex">
                        <div class="dot-label bg-success ml-1"></div>مفعل</span>
                        @else <span class="label text-danger d-flex">
                        <div class="dot-label bg-danger ml-1"></div>غير مفعل</span>
                        @endif</td>
                        <td>
                        @if ($teacher->user->getRoleNames()->isNotEmpty())
                        @foreach ($teacher->user->getRoleNames() as $role)
                        <label class="badge badge-success">{{ $role }}</label>
                        @endforeach
                        @else<label class="badge badge-danger">غير معين</label>@endif
                        </td>

<td>
    <div class="dropdown">
        <button aria-expanded="false" aria-haspopup="true"
            class="btn ripple btn-info btn-sm" data-toggle="dropdown"
            type="button">
            العمليات <i class="fas fa-caret-down ml-1"></i>
        </button>
        <div class="dropdown-menu tx-13">


            <a href="{{ route('teachers.edit', $teacher->id) }}" class="dropdown-item">
    <i class="fas fa-edit text-primary"></i> تعديل بيانات المدرس
</a>

            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash-alt"></i> حذف المدرس
                </button>
            </form>

            <form action="{{ route('teachers.show', $teacher->id) }}" method="POST"
                onsubmit="return confirm('هل تريد نقل المدرس إلى الأرشيف؟');">
                @csrf
                @method('PUT')
                <button type="submit" class="dropdown-item text-warning">
                    <i class="fas fa-exchange-alt"></i> نقل المدرس إلى الأرشيف
                </button>
            </form>

            {{-- رؤية تفاصيل الطالب --}}
            <form action="{{ route('teachers.show', $teacher->id) }}" method="GET">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-eye text-info"></i> رؤية تفاصيل المدرس
                </button>
            </form>

                            </tr>
                            @endforeach
                            {{ $teachers->links() }}
                        </tbody>
                    </table>
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
