@extends('layouts.master')
@section('title', 'إدارة الفصول')
@section('css')
    <!-- Internal Data table css -->
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
                <h4 class="content-title mb-0 my-auto">الفصول</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفصول</span>
            </div>
        </div>

    </div>


				<!-- breadcrumb -->

                {{-- print email export --}}
				{{-- <div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Utilities</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Margin</span>
						</div>
					</div>
					<div class="d-flex my-auto breadcrumb-right">
						<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope"></i></span> <span class="btn-text">Email</span></button> <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print"></i></span> <span class="btn-text">Print</span></button> <button class="btn btn-success mr-3"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
					</div>
				</div> --}}
				<!-- breadcrumb -->

    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفصل بنجاح",
                    type: "success"
                })}
        </script>
    @endif
    @if (session()->has('Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم التعديل الفصل بنجاح",
                    type: "success"
                })}
        </script>
    @endif
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة الفصل بنجاح",
                    type: "success"
                })}
        </script>
    @endif
    @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: " حدث مشكلة اثناء حذف الفصل بنجاح",
                    type: "danger"
                })}
        </script>
    @endif
    <!-- row -->
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
    {{-- @if(session()->has('Error'))
    <div class="alert alert-warning alert-dismissible fade show fs-5 w-75 mx-auto text-center" role="alert">
        <strong>{{ session('Error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

</div>
<div class="col-xl-12">
    <div class="card mg-b-20 p-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <a class="modal-effect btn btn-outline-primary" style="min-width: 300px;" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">
                    إضافة فصل
                </a>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('classes.index') }}" class="d-flex" style="gap: 10px; max-width: 400px;">
                {{-- <input type="text" name="search" class="form-control" placeholder="ابحث" value=" {{$search}}"> --}}
                <input type="text" name="search" class="form-control" placeholder="ابحث" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                    <thead>
            <tr>
                <th>#</th>
                <th>اسم الفصل</th>
                <th>الوصف</th>
                <th>العمليات</th>
            </tr>
                </thead>
                        <tbody>
                            {{-- @php $i=1 @endphp --}}
                             @php $i = ($classes->currentPage()-1) * $classes->perPage() + 1; @endphp
                            @foreach($classes as $class)
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{ $class->name}}</td>
                                <td title="{{ $class->note}}">
                    {{ \Illuminate\Support\Str::limit($class->note , 20, '...')}}
    <td>
        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal{{ $class->id}}">تعديل</button>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $class->id}}">حذف</button>
    </td>
            </tr>

            <!-- edit -->
            <div class="modal fade" id="editModal{{ $class->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('classes.update',$class->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">تعديل الفصل</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control" value="{{ $class->name}}">
                                <textarea name="note" class="form-control mt-2">{{$class->note}}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">حفظ</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- delete -->

            <div class="modal fade" id="deleteModal{{$class->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('classes.destroy',$class->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">حذف الفصل</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>هل أنت متأكد من حذف الفصل: <strong>{{ $class->name}}</strong>؟</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">حذف</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endforeach


    </tbody>
</table>
                    {{ $classes->links()}}
                    {{-- {{ $sections->appends(request()->query())->links()}} --}}
<!-- add-->
<div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('classes.store',$class->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة فصل جديد</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>اسم الفصل</label>
                        <input type="text" name="name" class="form-control">
                        {{-- <input type="text" name="name" class="form-control" value="{{ old('name') }}> --}}

                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>الوصف</label>
                        <textarea name="note" class="form-control" rows="3"></textarea>
                        @error('note')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
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
<!-- Internal Data tables -->
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
{{-- <script src="{{ URL::asset('assets/js/table-data.js') }}"></script> --}}
{{-- show pagenation --}}
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<!--Internal  Notify js -->
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
				{{-- <div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<div>
									<h6 class="card-title mb-1">File Upload</h6>
									<p class="text-muted card-sub-title">Dropify is a jQuery plugin to create a beautiful file uploader that converts a standard <code>input type="file"</code> into a nice drag & drop zone with previews and custom styles.</p>
								</div>
								<div class="row mb-4">
									<div class="col-sm-12 col-md-4">
										<input type="file" class="dropify" data-height="200" />
									</div>
									<div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
										<input type="file" class="dropify" data-default-file="{{URL::asset('assets/img/photos/1.jpg')}}" data-height="200"  />
									</div>
									<div class="col-sm-12 col-md-4 mg-t-10 mg-sm-t-0">
										<input type="file" class="dropify" disabled="disabled"  />
									</div>
								</div>
								<div>
									<input id="demo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png, html, zip, css,js" multiple>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
