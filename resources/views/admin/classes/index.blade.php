@extends('layouts.master')
@section('title', 'إدارة الفصول')
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
            background-color: #2ecc71;
            border-color: #2ecc71;
            border-radius: 6px;
        }
        .btn-success:hover {
            background-color: #27ae60;
            border-color: #27ae60;
        }
        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
            border-radius: 6px;
        }
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .btn-secondary {
            background-color: #95a5a6;
            border-color: #95a5a6;
            border-radius: 6px;
        }
        .btn-secondary:hover {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
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
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 font-weight-bold">
                <i class="la la-clipboard mr-2"></i> الفصول
            </h4>
            <span class="text-white-50 mx-2">/ قائمة الفصول</span>
        </div>
    </div>
</div>

@endsection
@section('content')

    @if (session()->has('Delete'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم حذف الفصل بنجاح</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Update'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم تعديل الفصل بنجاح</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم إضافة الفصل بنجاح</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Error') || session()->has('not_found'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('Error') ?? session('not_found') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20 p-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 15px;">
                    <div>
                        <a class="modal-effect btn btn-primary" style="min-width: 200px;" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">
                            إضافة فصل
                        </a>
                    </div>
                    <form method="GET" action="{{ route('classes.index') }}" class="d-flex" style="gap: 10px; max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="la la-search"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الفصل</th>
                                    <th>الوصف</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($classes->currentPage()-1) * $classes->perPage() + 1; @endphp
                                @foreach($classes as $class)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td title="{{ $class->note }}">{{ \Illuminate\Support\Str::limit($class->note, 20, '...') }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $class->id }}">تعديل</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $class->id }}">حذف</button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $class->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('classes.update', $class->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تعديل الفصل</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>اسم الفصل</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $class->name }}" required>
                                                            @error('name')
                                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>الوصف</label>
                                                            <textarea name="note" class="form-control" rows="3">{{ $class->note }}</textarea>
                                                            @error('note')
                                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $class->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">حذف الفصل</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من حذف الفصل: <strong>{{ $class->name }}</strong>؟</p>
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
                        {{ $classes->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة فصل جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>اسم الفصل</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
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

@endsection
