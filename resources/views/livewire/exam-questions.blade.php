<div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>خطأ</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="type" class="form-label">نوع السؤال: <span class="tx-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="la la-list"></i></span>
                <select wire:model="type" id="type" class="form-control">
                    <option value="mcq">اختيار من متعدد</option>
                    <option value="essay">سؤال مقالي</option>
                </select>
            </div>
            @error('type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 mb-4">
            <label for="question_text" class="form-label">نص السؤال: <span class="tx-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="la la-question"></i></span>
                <input type="text" wire:model="question_text" class="form-control" placeholder="أدخل نص السؤال...">
            </div>
            @error('question_text') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="mark" class="form-label">الدرجة: <span class="tx-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="la la-star"></i></span>
                <input type="number" wire:model="mark" class="form-control" min="1" placeholder="أدخل الدرجة...">
            </div>
            @error('mark') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        @if($type == 'essay')
            <div class="col-md-6 mb-4">
                <label for="keywords" class="form-label">الكلمات المفتاحية للإجابة:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="la la-key"></i></span>
                    <input type="text" wire:model="keywords" class="form-control" placeholder="مثال: keyword1, keyword2">
                </div>
                @error('keywords') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        @endif
    </div>
    @if($type == 'mcq')
        <h5 class="card-title mb-4">
            <i class="la la-check-circle mr-2"></i> الخيارات
        </h5>
        @foreach($options as $index => $opt)
            <div class="row mb-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="la la-circle"></i></span>
                        <input type="text" wire:model="options.{{ $index }}.option_text" class="form-control" placeholder="أدخل نص الخيار...">
                    </div>
                    @error("options.{$index}.option_text") <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input type="checkbox" wire:model="options.{{ $index }}.is_correct" class="form-check-input">
                        <label class="form-check-label">صحيح</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" wire:click="removeOption({{ $index }})" class="btn btn-danger btn-sm">
                        <i class="la la-trash-o"></i> حذف
                    </button>
                </div>
            </div>
        @endforeach
        <button type="button" wire:click="addOption" class="btn btn-primary btn-sm mb-3">
            <i class="la la-plus mr-1"></i> إضافة خيار
        </button>
    @endif
    <div class="text-center mt-5">
        <button type="button" wire:click="addQuestion" class="btn btn-success">
            <i class="la la-save mr-1"></i> إضافة السؤال
        </button>
        <a href="{{ route('exams.index') }}" class="btn btn-secondary">
            <i class="la la-times mr-1"></i> إلغاء
        </a>
    </div>
    <hr>
    <h5 class="card-title mb-4">
        <i class="la la-list-alt mr-2"></i> أسئلة الامتحان
    </h5>
    @if (empty($questions))
        <div class="text-center text-muted">لا توجد أسئلة مضافة بعد.</div>
    @else
        <ul class="question-list">
            @foreach($questions as $q)
                <li>
                    <i class="la {{ $q->type == 'mcq' ? 'la-check-circle' : 'la-file-text' }} mr-2"></i>
                    {{ $q->question_text }}
                    <span class="badge bg-primary">{{ $q->type == 'mcq' ? 'اختيار متعدد' : 'مقالي' }}</span>
                    <span class="badge bg-info">الدرجة: {{ $q->mark }}</span>
                    @if($q->type == 'mcq')
                        <ul>
                            @foreach($q->options as $opt)
                                <li>{{ $opt->option_text }} {{ $opt->is_correct ? '<span class="badge bg-success">صحيح</span>' : '' }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
