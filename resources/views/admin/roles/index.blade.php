@extends('layouts.master')

@section('title', 'صلاحيات المستخدمين')

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
        .notif {
            font-family: 'Cairo', sans-serif;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
                    <i class="la la-user-shield"></i> المستخدمين
                </h4>
                <span class="text-muted mx-2">/ صلاحيات المستخدمين</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                @can('create-role')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-md">
                        <i class="la la-plus mr-1"></i> إضافة صلاحية
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم إضافة الصلاحية بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث بيانات الصلاحية بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الصلاحية بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="card-title mb-4">
                        <i class="la la-list-alt mr-2"></i> قائمة الصلاحيات
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center" id="roles-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            {{-- @can('show-role') --}}
                                                <a class="btn btn-sm btn-success" href="{{ route('roles.show', $role->id) }}" title="عرض">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('edit-role') --}}
                                                <a class="btn btn-sm btn-primary" href="{{ route('roles.edit', $role->id) }}" title="تعديل">
                                                    <i class="la la-edit"></i>
                                                </a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete-role') --}}
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
