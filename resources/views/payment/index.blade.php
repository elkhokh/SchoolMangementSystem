@extends('layouts.master')
@section('title', 'قائمة فواتير الطلاب')

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
            <h4 class="content-title mb-0 my-auto">المصاريف</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المصاريف</span>
        </div>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ route('payments.create') }}" class="btn btn-success btn-md">طلب دفع مصاريف</a>
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

@if (session()->has('Error'))
<script>
    window.onload = function() {
        $('#modalUpdateSuccess').modal('show');
    }
</script>
@endif



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">قائمة المدفوعات</h5>
                        {{-- Search Form --}}
                <div class="mb-3 d-flex justify-content-start" style="gap: 10px; max-width: 400px;">
                    <form method="GET" action="{{ route('payments.index') }}" class="d-flex w-100" style="gap: 10px;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث باسم الطالب"
                        value="{{ request('search') }}">
                        {{-- value="{{ $search}}"> --}}
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
<div class="table-responsive">
    <table id="payments-table" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>نوع الدفع</th>
                <th>الحالة</th>
                <th>رقم العملية</th>
                <th>رابط الدفع</th>
                <th>إجمالي المبلغ</th>
                <th>المدفوع</th>
                <th>المتبقي</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @php $i = ($payments->currentPage()-1) * $payments->perPage() + 1; @endphp
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $payment->student->user->name ?? '-' }}</td>
                    <td>{{ $payment->payment_type }}</td>
                    <td>
                        @if ($payment->payment_status == 'paid')
                            <span class="badge badge-success">مدفوع</span>
                        @elseif($payment->payment_status == 'unpaid')
                            <span class="badge badge-danger">غير مدفوع</span>
                        @else
                            <span class="badge badge-warning">معلق</span>
                        @endif
                    </td>
                    <td>{{ $payment->payment_id }}</td>
                    <td>
                        <a href="{{ $payment->payment_url }}" target="_blank" class="btn btn-sm btn-info">
                            رابط الدفع
                        </a>
                    </td>
                    <td>{{ $payment->amount_all }}</td>
                    <td>{{ $payment->current_paid }}</td>
                    <td>{{ $payment->remaining }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                العمليات
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('payments.show', $payment->id) }}">
                                    <i class="fas fa-eye text-info"></i> عرض التفاصيل
                                </a>
                                <a class="dropdown-item" href="{{ $payment->payment_url }}" target="_blank">
                                    <i class="fas fa-credit-card text-success"></i> إعادة الدفع
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">لا توجد مدفوعات مسجلة</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        {{ $payments->links() }}

            </div>
        </div>
    </div>
</div>

<!-- Modal message -->
<div class="modal fade" id="modaldemo4" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 380px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
            <div class="modal-body" style="padding: 30px 25px; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 20px; opacity: 0.6;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-circle-outline" style="font-size: 70px; color: #28a745; margin-bottom: 20px; display: inline-block;"></i>
                <h4 style="color: #28a745; font-size: 18px; font-weight: 600; margin-bottom: 25px;">تم  دفع المبلغ بنجاح  </h4>
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
                   style="font-size: 70px; color: #9c0d0d; margin-bottom: 20px; display: inline-block;"></i>
                <h4 style="color: #ed0000; font-size: 18px; font-weight: 600; margin-bottom: 25px;">
                    حدث خطأ عند الدفع يرجي اعادة المحاولة
                </h4>
                <button type="button" class="btn" data-dismiss="modal"
                        style="background: linear-gradient(135deg, #9a0303 0%, #ae0b13 100%);
                border: none; border-radius: 25px; padding: 10px 30px; color: white; font-weight: 600;">
                    متابعة
                </button>
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
