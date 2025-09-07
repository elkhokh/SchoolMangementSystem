<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>نجاح</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>خطأ</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($totalQuestions > 0)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="progress w-50">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $answeredCount / $totalQuestions * 100 }}%" aria-valuenow="{{ $answeredCount }}" aria-valuemin="0" aria-valuemax="{{ $totalQuestions }}">
                    {{ $answeredCount }} / {{ $totalQuestions }} أسئلة مجابة
                </div>
            </div>
            <div class="timer badge" :class="{'bg-danger': time <= 300, 'bg-primary': time > 300}" x-data="{ time: {{ $timeRemaining }} }" x-init="setInterval(() => { if (time > 0) time--; else window.location.href = '{{ route('student_exams.index') }}'; }, 1000)">
                <i class="la la-clock mr-1"></i> الوقت المتبقي: <span x-text="Math.floor(time / 60) + ':' + (time % 60).toString().padStart(2, '0')"></span>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="confirmSubmit">
        @if($exam->questions->isEmpty())
            <div class="empty-state text-center">
                <i class="la la-exclamation-circle la-2x mb-2"></i>
                <p>لا توجد أسئلة متاحة لهذا الامتحان.</p>
            </div>
        @else
            @foreach($exam->questions as $question)
                <div class="card mb-3 question-card" wire:key="question-{{ $question->id }}">
                    <div class="card-header bg-gradient-success">
                        <i class="la la-question-circle mr-2"></i>
                        السؤال {{ $loop->iteration }}: {{ $question->question_text }}
                        <span class="badge bg-info float-left">الدرجة: {{ $question->mark }}</span>
                    </div>
                    <div class="card-body">
                        @if($question->type == 'mcq')
                            @foreach($question->options as $option)
                                <div class="form-check mb-2">
                                    <input type="radio"
                                           wire:model="answers.{{ $question->id }}"
                                           name="question_{{ $question->id }}"
                                           value="{{ $option->id }}"
                                           class="form-check-input"
                                           id="option_{{ $option->id }}">
                                    <label class="form-check-label" for="option_{{ $option->id }}">
                                        <i class="la la-circle mr-1"></i> {{ $option->option_text }}
                                    </label>
                                </div>
                                @error("answers.{$question->id}") <div class="text-danger">{{ $message }}</div> @enderror
                            @endforeach
                        @elseif($question->type == 'essay')
                            <div class="input-group">
                                <span class="input-group-text"><i class="la la-pen"></i></span>
                                <textarea wire:model="answers.{{ $question->id }}"
                                          class="form-control"
                                          rows="4"
                                          placeholder="أدخل إجابتك هنا..."></textarea>
                            </div>
                            @error("answers.{$question->id}") <div class="text-danger">{{ $message }}</div> @enderror
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="la la-save mr-1"></i> إرسال الإجابات
                </button>
                <a href="{{ route('student_exams.index') }}" class="btn btn-secondary">
                    <i class="la la-times mr-1"></i> إلغاء
                </a>
            </div>
        @endif
    </form>

    <!-- نافذة تأكيد الإرسال -->
    <div x-data="{ open: @entangle('showConfirmation') }" x-show="open" class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد إرسال الامتحان</h5>
                    <button type="button" class="close" x-on:click="open = false">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من إرسال إجاباتك؟ لا يمكنك تعديل الإجابات بعد الإرسال.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" x-on:click="open = false">
                        <i class="la la-times mr-1"></i> إلغاء
                    </button>
                    <button type="button" class="btn btn-success" wire:click="submitExam">
                        <i class="la la-save mr-1"></i> تأكيد الإرسال
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: @entangle('showConfirmation') }" x-show="open" class="modal-backdrop fade show"></div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timer = document.querySelector('.timer');
            let time = {{ $timeRemaining }};
            if (time <= 300) {
                timer.classList.add('bg-danger');
                timer.classList.remove('bg-primary');
            }
        });
    </script>
@endpush
