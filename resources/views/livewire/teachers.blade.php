<div>
    {{-- Search --}}
    <div class="mb-4 d-flex justify-content-start" style="gap: 10px; max-width: 600px;">
        <div class="position-relative">
            <input type="text" wire:model.live="search" class="form-control" placeholder="ابحث باسم المدرس...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المدرس</th>
                    <th>البريد الإلكتروني</th>
                    <th>المادة</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>الصلاحيات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @php $i = ($teachers->currentPage()-1) * $teachers->perPage() + 1; @endphp
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $teacher->user->name }}</td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->subject->name ?? 'غير محدد' }}</td>
                        <td>{{ $teacher->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                        <td>
                            @if ($teacher->user->status == 1)
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
                            @if ($teacher->user->getRoleNames()->isNotEmpty())
                                @foreach ($teacher->user->getRoleNames() as $role)
                                    <label class="badge badge-success">{{ $role }}</label>
                                @endforeach
                            @else
                                <label class="badge badge-danger">غير معين</label>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" type="button">
                                    <i class="la la-cog mr-1"></i> العمليات
                                </button>
                                <div class="dropdown-menu tx-13">
                                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="dropdown-item">
                                        <i class="la la-edit text-primary mr-2"></i> تعديل بيانات المدرس
                                    </a>
                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="la la-trash-o mr-2"></i> حذف المدرس
                                        </button>
                                    </form>
                                    <form action="{{ route('teachers.show', $teacher->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="la la-eye text-info mr-2"></i> رؤية تفاصيل المدرس
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">لا توجد بيانات</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $teachers->links() }}
    </div>
</div>
