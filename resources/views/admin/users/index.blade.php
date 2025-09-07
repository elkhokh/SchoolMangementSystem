@extends('layouts.master')
@section('title', 'إدارة الأدمن')
@section('css')
    <style>
        .label {
            font-size: 0.95rem;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .dot-label {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-left: 8px;
        }

        .notif {
            font-family: 'Cairo', sans-serif;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('page-header')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 content-title">
                    <i class="la la-users"></i> المستخدمين
                </h4>
                <span class="text-muted mx-2">/ قائمة المستخدمين</span>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-md">
                    <i class="la la-plus mr-1"></i> إضافة أدمن
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم إضافة الأدمن بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('Error'))
        <script>
            window.onload = function() {
                notif({
                    msg: "حدثت مشكلة أثناء الحذف",
                    type: "error",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif
    @if (session()->has('Delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف المستخدم بنجاح",
                    type: "success",
                    position: "center",
                    timeout: 3000
                });
            }
        </script>
    @endif

    <div class="row">
        <div class="col-xl-12">
            @if (session()->has('not_found'))
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('not_found') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between flex-wrap align-items-center">
                        <h5 class="card-title mb-4">
                            <i class="la la-list-alt mr-2"></i> قائمة المستخدمين
                        </h5>


                        <form method="GET" action="{{ route('users.index') }}" class="d-flex"
                            style="gap: 10px; max-width: 400px;">
                            <input type="text" name="search" class="form-control"
                                placeholder="ابحث بالاسم أو البريد أو الصلاحية..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="la la-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center" id="users-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المستخدم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>حالة المستخدم</th>
                                    <th>صلاحية المستخدم</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($users->currentPage()-1) * $users->perPage() + 1; @endphp
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class="fw-bold">{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="label text-success d-flex align-items-center">
                                                    <div class="dot-label bg-success ml-1"></div> مفعل
                                                </span>
                                            @else
                                                <span class="label text-danger d-flex align-items-center">
                                                    <div class="dot-label bg-danger ml-1"></div> غير مفعل
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
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                                title="تعديل">
                                                <i class="la la-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline-block;"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد الحذف نهائيًا؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                    <i class="la la-trash-o"></i>
                                                </button>
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
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
