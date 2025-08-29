@extends('layouts.master')
@section('title', 'قائمةالغياب ')
@section('css')
<!-- Interenal Accordion Css -->
<link href="{{URL::asset('assets/plugins/accordion/accordion.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">متابعة الغياب والحضور </h4>
			<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفصول بالطلاب الخاصة بيهم</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <h5 style="font-family: 'Cairo', sans-serif; color: red">
            تاريخ اليوم : {{ date('Y-m-d') }}
        </h5>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">قائمة الفصول</h3>

                <form method="GET" action="{{ route('students.index') }}" class="d-flex" style="gap: 10px; max-width: 300px;">
                    <input type="text" name="search" class="form-control" placeholder="ابحث باسم الطالب" value="">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="card-body">
                <div class="accordion" id="accordionExample">

                    <!-- Item 1 -->
                    <div class="accor bg-info" id="headingOne">
                        <h4 class="m-0">
            <a href="#collapseOne" class="text-dark d-flex align-items-center" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                <i class="si si-cursor-move ml-2"></i>
                                الفصول بالطلاب
                            </a>
                        </h4>
                    </div>

                    <div id="collapseOne" class="collapse show b-b0 bg-white" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Birddsdfsfsefsdff</td>
                                        <td>@twitter</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <label class="mr-3">
                                                    <input type="radio" name="attendences" value="presence">
                                                    <span class="text-success font-weight-bold">حضور</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="attendences" value="absent">
                                                    <span class="text-danger font-weight-bold">غياب</span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="mt-3 text-center">
                                <button class="btn btn-success px-4" type="submit">
                                    تأكيد عمليات الحضور والغياب
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Item 1 -->

                </div> <!-- accordion end -->
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection

@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--- Internal Accordion Js -->
<script src="{{URL::asset('assets/plugins/accordion/accordion.min.js')}}"></script>
<script src="{{URL::asset('assets/js/accordion.js')}}"></script>
@endsection
