<div>
    <!-- search item-->
    <div class="mb-3 d-flex justify-content-start" style="gap: 10px; max-width: 400px;">
        <input type="text" wire:model.live="search" class="form-control" placeholder="ابحث باسم الطالب">
    </div>
    <!-- accordion -->
    <div class="accordion" id="accordionExample">
        @foreach($classes as $class)
            <div class="accor bg-success text-white" id="heading{{ $class->id }}">
                <h4 class="m-0">
                    <a href="#collapse{{ $class->id }}" class="text-white d-flex align-items-center"
                       data-toggle="collapse" aria-expanded="false" aria-controls="collapse{{ $class->id }}">
                        <i class="si si-cursor-move ml-2"></i>
                        {{ $class->name }}
                    </a>
                </h4>
            </div>

            <div id="collapse{{ $class->id }}" class="collapse" aria-labelledby="heading{{ $class->id }}" data-parent="#accordionExample">
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
                            @php $i = 1; @endphp
                            @forelse($class->students as $student)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->user->email }}</td>
                                    <td>{{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <label class="mr-3">
                                                <input type="radio" name="attendences[{{ $student->id }}]" value="presence">
                                                <span class="text-success font-weight-bold">حضور</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="attendences[{{ $student->id }}]" value="absent">
                                                <span class="text-danger font-weight-bold">غياب</span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">لا يوجد طلاب في هذا الفصل</td>
                                </tr>
                                  <div class="mt-3">
        {{ $class->students->links() }}
    </div>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 text-center">
                        <button class="btn btn-success px-4" type="submit">
                            تأكيد عمليات الحضور والغياب
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
