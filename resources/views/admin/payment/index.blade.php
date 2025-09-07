@extends('layouts.master')
@section('title', 'قائمة فواتير الطلاب')
@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f7fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .btn-success {
            background-color: #7dab91;
            border-color: #578269;
            border-radius: 6px;
        }
        .btn-success:hover {
            background-color: #7aeeaa;
            border-color: #7eecac;
        }
        .btn-danger {
            background-color: #e8a29b;
            border-color: #c97d75;
            border-radius: 6px;
        }
        .btn-danger:hover {
            background-color: #edc0bb;
            border-color: #cc847c;
        }
        .btn-secondary {
            background-color: #526b6d;
            border-color: #6d8385;
            border-radius: 6px;
        }
        .btn-secondary:hover {
            background-color: #6b7d7e;
            border-color: #485455;
        }
        .alert {
            border-radius: 8px;
            font-size: 1.1rem;
            margin: 1rem auto;
            width: 75%;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #3498db;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .modal-title {
            font-size: 1.2rem;
        }
        .form-control {
            border-radius: 6px;
            font-size: 1rem;
            padding: 0.75rem;
        }
        .breadcrumb-header {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .content-title {
            color: #2c3e50;
            font-weight: 600;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-money"></i> المصاريف
                </h4>
                <span class="text-muted mx-2">/ قائمة المصاريف</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('payments.create') }}" class="btn btn-success btn-md">
                    <i class="la la-plus-circle mr-1"></i> طلب دفع مصاريف
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="mb-4 d-flex justify-content-start" style="gap: 10px; max-width: 400px;">
                        <form method="GET" action="{{ route('payments.index') }}" class="d-flex w-100" style="gap: 10px;">
                            <input type="text" name="search" class="form-control" placeholder="ابحث باسم الطالب..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="la la-search"></i>
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
                                            <a href="{{ $payment->payment_url }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="la la-link mr-1"></i> رابط الدفع
                                            </a>
                                        </td>
                                        <td>{{ $payment->amount_all }}</td>
                                        <td>{{ $payment->current_paid }}</td>
                                        <td>{{ $payment->remaining }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                                    <i class="la la-cog mr-1"></i> العمليات
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('payments.show', $payment->id) }}">
                                                        <i class="la la-eye text-info mr-2"></i> عرض التفاصيل
                                                    </a>
                                                    <a class="dropdown-item" href="{{ $payment->payment_url }}" target="_blank">
                                                        <i class="la la-credit-card text-success mr-2"></i> إعادة الدفع
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $payments->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="modaldemo4" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
            <div class="modal-content">
                <div class="modal-header modal-success">
                    <h4 class="modal-title">تم الدفع بنجاح</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="la la-check-circle" style="font-size: 80px; color: #10b981; margin-bottom: 20px; display: inline-block;"></i>
                    <p style="color: #1e293b; font-size: 1.2rem; font-weight: 600;">تم دفع المبلغ بنجاح</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success" data-dismiss="modal">متابعة</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="modalUpdateSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
            <div class="modal-content">
                <div class="modal-header modal-error">
                    <h4 class="modal-title">خطأ في الدفع</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="la la-exclamation-circle" style="font-size: 80px; color: #ef4444; margin-bottom: 20px; display: inline-block;"></i>
                    <p style="color: #1e293b; font-size: 1.2rem; font-weight: 600;">حدث خطأ عند الدفع، يرجى إعادة المحاولة</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">متابعة</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
