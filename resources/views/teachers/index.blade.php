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
            <h4 class="content-title mb-0 my-auto">المدرسين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المدرسين</span>
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">قائمة المدرسين</h5>

       @livewire('teachers')


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
