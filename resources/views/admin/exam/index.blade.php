@extends('layouts.master')

@section('title', 'قائمة الامتحانات')

@section('css')

    <style>
        /* Styles خاصة بالصفحة */
        .table th, .table td {
            vertical-align: middle;
            padding: 16px;
            font-size: 1.05rem;
        }
        .table thead th {
            background-color: #e0f2fe;
            color: #1e293b;
            font-weight: 700;
            border-bottom: 2px solid #bfdbfe;
        }
        .table tbody tr:hover {
            background-color: #f0f9ff;
            transition: background-color 0.3s ease;
        }
        .alert {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-file-alt"></i> الامتحانات
                </h4>
                <span class="text-muted mx-2">/ قائمة الامتحانات</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                {{-- @can('create-exam') --}}
                    <a href="{{ route('exams.create') }}" class="btn btn-primary btn-md">
                        <i class="la la-plus mr-1"></i> إضافة امتحان
                    </a>
                {{-- @endcan --}}
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="la la-list-alt mr-2"></i> قائمة الامتحانات
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center" id="exams-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العنوان</th>
                                    <th>المادة</th>
                                    <th>المدرس</th>
                                    <th>الحالة</th>
                                    <th>من</th>
                                    <th>إلى</th>
                                    <th>المدة (دقيقة)</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($exams as $exam)
                                    <tr>
                                        <td>{{ $exam->id }}</td>
                                        <td>{{ $exam->title }}</td>
                                        <td>{{ optional($exam->subject)->name ?? 'غير محدد' }}</td>
                                        <td>{{ optional($exam->teacher)->name ?? 'غير محدد' }}</td>
                                        <td>
                                            @if($exam->status)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($exam->start_time)->format('Y-m-d H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($exam->end_time)->format('Y-m-d H:i') }}</td>
                                        <td>{{ $exam->time_of_exam }}</td>
                                        <td>
                                            {{-- @can('show-exam') --}}
                                                <a href="{{ route('exams.show', $exam) }}" class="btn btn-sm btn-info" title="عرض">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('edit-exam') --}}
                                                <a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-warning" title="تعديل">
                                                    <i class="la la-edit"></i>
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete-exam') --}}
                                                <form action="{{ route('exams.destroy', $exam) }}" method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('هل أنت متأكد أنك تريد الحذف نهائيًا؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                        <i class="la la-trash-o"></i>
                                                    </button>
                                                </form>
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" class="text-center">لا توجد امتحانات متاحة</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $exams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
