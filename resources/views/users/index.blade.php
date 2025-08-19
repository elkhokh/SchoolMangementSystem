@extends('layouts.master')
@section('title', 'إدارة المستخدمين')
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-md">إضافة ادمن</a>
    </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة الادمن بنجاح",
                    type: "success"
                })}
        </script>
    @endif
    @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: " حدث مشكلة اثناء حذف الادمن بنجاح",
                    type: "info"
                })}
        </script>
    @endif
    @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف هذا المستخدم بنجاح",
                    type: "success"
                })}
        </script>
    @endif

    <!-- row opened -->
    <div class="row row">
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
        <div class="card">
   <div class="card-header pb-0">
    <div class="d-flex justify-content-between flex-wrap align-items-center">

             {{-- <a class="btn btn-success btn mb-2" href="{{ route('users.create') }}">
            <i class="fas fa-plus"></i> إضافة مستخدم
        </a> --}}
        <!-- Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="input-group mb-2" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو البريد أو الصلاحية" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i> بحث
            </button>
        </form>

        <!-- Add Button -->

    </div>
</div>

            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style="text-align: center;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>حالة المستخدم</th>
                                <th>صلاحية المستخدم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = ($users->currentPage()-1) * $users->perPage() + 1; @endphp
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td class="fw-bold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="label text-success d-flex">
                                                <div class="dot-label bg-success ml-1"></div>مفعل
                                            </span>
                                        @else
                                            <span class="label text-danger d-flex">
                                                <div class="dot-label bg-danger ml-1"></div>غير مفعل
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->getRoleNames()->isNotEmpty())
                                            @foreach ($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ $role }}</label>
                                            @endforeach
                                        @else
                                            <label class="badge badge-danger">غير معين</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info" title="تعديل"><i class="las la-pen"></i></a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد الحذف نهائيًا؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">لا توجد بيانات لعرضها.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->links() }}
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
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
