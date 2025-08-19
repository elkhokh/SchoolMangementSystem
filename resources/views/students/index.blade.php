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
@if (session()->has('Add'))
<script>
    window.onload = function() {
        notif({ msg: "تم إضافة الطالب بنجاح",
         type: "success", position: "center",
         timeout: 3000 });
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
                                {{-- <th>اسم الأب</th>
                                <th>اسم الأم</th>
                                <th>بريد ولي الأمر</th>
                                <th>هاتف ولي الأمر</th>
                                <th>المرفقات</th> --}}
                                <th>الإجراءات</th>
                                {{-- <th>الإجراءات</th> --}}
                            </tr>
                        </thead>
                        <tbody>
            @php $i = ($students->currentPage()-1) * $students->perPage() + 1; @endphp
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $student->user->name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->class->name ?? 'غير محدد' }}</td>
                                <td>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                {{-- <td>{{ $student->user->status ? 'مفعل' : 'غير مفعل' }}</td> --}}
                                {{-- <td>{{ $student->attachments->first()->father_name ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->first()->mother_name ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->first()->parent_email ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->first()->parent_phone ?? 'غير محدد' }}</td> --}}


                                {{-- <td>{{ $student->attachments->father_name ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->mother_name ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->parent_email ?? 'غير محدد' }}</td>
                                <td>{{ $student->attachments->parent_phone ?? 'غير محدد' }}</td> --}}
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
                        {{-- <td>
                            @if(optional($student->attachments)->file_name)
                 <a href="{{ Storage::url($student->attachments->file_name) }}" target="_blank">عرض المرفق</a>
                                    @else
                                        غير متوفر
                                    @endif
                                </td> --}}
                                {{-- <td>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                    </form>
                                </td> --}}

<td>
    <div class="dropdown">
        <button aria-expanded="false" aria-haspopup="true"
            class="btn ripple btn-info btn-sm" data-toggle="dropdown"
            type="button">
            العمليات <i class="fas fa-caret-down ml-1"></i>
        </button>
        <div class="dropdown-menu tx-13">
            {{-- تعديل الطالب --}}
            {{-- <form action="{{ route('students.edit', $student->id) }}" method="GET">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-edit text-primary"></i> تعديل بيانات الطالب
                </button>
            </form> --}}

            <a href="{{ route('students.edit', $student->id) }}" class="dropdown-item">
    <i class="fas fa-edit text-primary"></i> تعديل بيانات الطالب
</a>
            {{-- حذف الطالب --}}
            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash-alt"></i> حذف الطالب
                </button>
            </form>

            {{-- نقل الطالب الي الارشيف --}}
            <form action="{{ route('students.show', $student->id) }}" method="POST"
                onsubmit="return confirm('هل تريد نقل الطالب إلى الأرشيف؟');">
                @csrf
                @method('PUT')
                <button type="submit" class="dropdown-item text-warning">
                    <i class="fas fa-exchange-alt"></i> نقل الطالب إلى الأرشيف
                </button>
            </form>

            {{-- رؤية تفاصيل الطالب --}}
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
                            {{ $students->links() }}
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
