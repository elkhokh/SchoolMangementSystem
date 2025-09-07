@extends('layouts.master')

@section('title', 'إدارة المواد')
@section('css')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8fafc;
            direction: rtl;
        }

        .page-header {
            background: linear-gradient(135deg, #ffffff, #f1f5f9);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .btn-primary {
            background-color: #1e90ff;
            border-color: #1e90ff;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #187bcd;
            border-color: #187bcd;
            box-shadow: 0 2px 8px rgba(30, 144, 255, 0.3);
        }

        .btn-success {
            background-color: #28c76f;
            border-color: #28c76f;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #21a95c;
            border-color: #21a95c;
            box-shadow: 0 2px 8px rgba(40, 199, 111, 0.3);
        }

        .btn-danger,
        .btn-outline-danger {
            background-color: #ff4757;
            border-color: #ff4757;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover,
        .btn-outline-danger:hover {
            background-color: #e8414e;
            border-color: #e8414e;
            box-shadow: 0 2px 8px rgba(255, 71, 87, 0.3);
        }

        .btn-secondary {
            background-color: #b0bec5;
            border-color: #b0bec5;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
            border-color: #95a5a6;
            box-shadow: 0 2px 8px rgba(176, 190, 197, 0.3);
        }

        .alert {
            border-radius: 10px;
            font-size: 1.1rem;
            margin: 1.5rem auto;
            width: 80%;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background-color: #e6f7ec;
            border-color: #28c76f;
            color: #1a3c34;
        }

        .alert-danger,
        .alert-warning {
            background-color: #fff1f0;
            border-color: #ff4757;
            color: #4a1a1a;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
            padding: 14px;
            font-size: 1rem;
        }

        .table thead th {
            background-color: #f1f5f9;
            color: #2d3748;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #1e90ff, #187bcd);
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: none;
            padding: 15px 20px;
        }

        .form-control {
            border-radius: 8px;
            font-size: 1rem;
            padding: 10px;
            border: 1px solid #e2e8f0;
        }

        .form-control:focus {
            border-color: #1e90ff;
            box-shadow: 0 0 6px rgba(30, 144, 255, 0.3);
        }

        .content-title {
            color: #2d3748;
            font-weight: 700;
        }

        .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .text-danger {
            font-size: 0.9rem;
        }

        .right-content .btn {
            margin-left: 10px;
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-book mr-2"></i> المواد الدراسية
                </h4>
                <span class="text-muted mx-2">/ قائمة المواد</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="#modaldemo8" class="btn btn-primary btn-md" data-effect="effect-scale" data-toggle="modal">
                    <i class="la la-plus-circle mr-1"></i> إضافة مادة
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session()->has('Delete'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم حذف المادة/المواد بنجاح</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Update'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم تعديل المادة بنجاح</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>تم إضافة المادة بنجاح</strong>
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
                        <button type="button" class="btn btn-danger btn-md" id="btn_delete_all">
                            <i class="la la-trash-o mr-1"></i> حذف المواد المحددة
                        </button>
                    </div>
                    <form method="GET" action="{{ route('subjects.index') }}" class="d-flex"
                        style="gap: 10px; max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث عن مادة..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="la la-search"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50"
                            style="text-align: center;">
                            <thead>
                                <tr>
    <th><input name="select_all" id="example-select-all" type="checkbox"onclick="CheckAll('box1', this)" /></th>
                                    <th>#</th>
                                    <th>اسم المادة</th>
                                    <th>الدرجة</th>
                                    <th>الوصف</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($subjects->currentPage()-1) * $subjects->perPage() + 1; @endphp
                                @foreach ($subjects as $sub)
                                    <tr>
                                        <td><input type="checkbox" value="{{ $sub->id }}" class="box1"></td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td>{{ $sub->degree }}</td>
                                        <td title="{{ $sub->note }}">
                                            {{ \Illuminate\Support\Str::limit($sub->note, 20, '...') }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $sub->id }}">
                                                <i class="la la-edit"></i> تعديل
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $sub->id }}">
                                                <i class="la la-trash-o"></i> حذف
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $sub->id }}" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('subjects.update', $sub->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تعديل بيانات المادة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>اسم المادة</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ old('name', $sub->name) }}" required>
                                                            @error('name')
                                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>الدرجة الخاصة بالمادة</label>
                                                            <input type="number" name="degree" class="form-control"
                                                                value="{{ old('degree', $sub->degree) }}" required>
                                                            @error('degree')
                                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>الوصف</label>
                                                            <textarea name="note" class="form-control" rows="3">{{ old('note', $sub->note) }}</textarea>
                                                            @error('note')
                                                                <div class="text-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $sub->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('subjects.destroy', $sub->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">حذف المادة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>هل أنت متأكد من حذف المادة:
                                                            <strong>{{ $sub->name }}</strong>؟</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">حذف</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة مادة جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>اسم المادة</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>الدرجة الخاصة بالمادة</label>
                            <input type="number" name="degree" class="form-control" value="{{ old('degree') }}"
                                required>
                            @error('degree')
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

    <!-- Delete All Modal -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('subjects.delete_all') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تأكيد حذف المواد المحددة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف جميع المواد المحددة؟</p>
                        <input type="hidden" id="delete_all_id" name="delete_all_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">تراجع</button>
                        <button type="submit" class="btn btn-danger">تأكيد</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Select/Deselect all checkboxes
        function CheckAll(className, elem) {
            $('.' + className).prop('checked', $(elem).prop('checked'));
        }

        // Handle Delete All button click
        $(document).ready(function() {
            $('#btn_delete_all').on('click', function() {
                var ids = [];
                $('.box1:checked').each(function() {
                    ids.push($(this).val());
                });
                if (ids.length > 0) {
                    $('#delete_all_id').val(ids.join(','));
                    $('#delete_all').modal('show');
                } else {
                    notif({
                        msg: "يرجى تحديد مادة واحدة على الأقل",
                        type: "warning"
                    });
                }
            });
        });
    </script>
@endsection
