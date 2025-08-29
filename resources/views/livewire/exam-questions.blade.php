<div>
    <h6>إضافة سؤال جديد</h6>
    <div class="form-group">
        <label>نوع السؤال</label>
        <select wire:model="type" class="form-control">
            <option value="mcq">اختيار من متعدد</option>
            <option value="essay">سؤال مقالي</option>
        </select>
    </div>

    <div class="form-group">
        <label>نص السؤال</label>
        <input type="text" wire:model="question_text" class="form-control">
    </div>

    <div class="form-group">
        <label>الدرجة</label>
        <input type="number" wire:model="mark" class="form-control">
    </div>

    @if($type == 'essay')
    <div class="form-group">
        <label>الكلمات المفتاحية للإجابة</label>
        <input type="text" wire:model="keywords" class="form-control" placeholder="مثال: keyword1, keyword2">
    </div>
    @endif

    @if($type == 'mcq')
    <h6>الخيارات</h6>
    @foreach($options as $index => $opt)
        <div class="d-flex mb-2">
            <input type="text" wire:model="options.{{ $index }}.option_text" class="form-control mr-2" placeholder="نص الخيار">
            <input type="checkbox" wire:model="options.{{ $index }}.is_correct" class="mt-2"> صحيح
            <button type="button" wire:click="removeOption({{ $index }})" class="btn btn-danger btn-sm ml-2">حذف</button>
        </div>
    @endforeach
    <button type="button" wire:click="addOption" class="btn btn-primary btn-sm">إضافة خيار</button>
    @endif

    <button type="button" wire:click="addQuestion" class="btn btn-success mt-3">إضافة السؤال</button>

    <hr>

    <h6>أسئلة الامتحان</h6>
    <ul>
        @foreach($questions as $q)
            <li>
                {{ $q->question_text }} ({{ $q->type }}) - الدرجة: {{ $q->mark }}
                @if($q->type == 'mcq')
                    <ul>
                        @foreach($q->options as $opt)
                            <li>{{ $opt->option_text }} {{ $opt->is_correct ? '(صحيح)' : '' }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
