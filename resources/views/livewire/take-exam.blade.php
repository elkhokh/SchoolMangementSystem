<div>
    <form wire:submit.prevent="submitExam">
        @foreach($exam->questions as $question)
            <div class="card mb-3">
                <div class="card-header">
                    السؤال {{ $loop->iteration }}: {{ $question->question_text }}
                </div>
                <div class="card-body">
                    @if($question->type == 'mcq')
                        @foreach($question->options as $option)
                            <div class="form-check">
                                <input type="radio"
                                       wire:model="answers.{{ $question->id }}"
                                       name="question_{{ $question->id }}"
                                       value="{{ $option->id }}"
                                       class="form-check-input">
                                <label class="form-check-label">{{ $option->option_text }}</label>
                            </div>
                        @endforeach
                    @elseif($question->type == 'essay')
                        <textarea wire:model="answers.{{ $question->id }}" class="form-control" rows="4"></textarea>
                    @endif
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">إرسال الإجابات</button>
    </form>
</div>
