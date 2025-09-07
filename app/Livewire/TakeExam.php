<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TakeExam extends Component
{
    public $exam;
    public $answers = [];
    public $answeredCount = 0;
    public $totalQuestions;
    public $timeRemaining;
    public $showConfirmation = false;

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->totalQuestions = $exam->questions->count();

        // التأكد إن المستخدم مسجل دخوله
        if (!Auth::check()) {
            session()->flash('error', 'يجب تسجيل الدخول لأداء الامتحان.');
            return redirect()->route('login');
        }

        // التأكد إن المستخدم لم يرسل الامتحان من قبل
        if (StudentExam::where('exam_id', $exam->id)->where('student_id', Auth::id())->exists()) {
            session()->flash('error', 'لقد قمت بتقديم هذا الامتحان بالفعل.');
            return redirect()->route('student_exams.index');
        }

        // إعداد المؤقت (افتراضيًا 60 دقيقة إذا لم يكن محدد)
        $duration = $exam->duration ?? 60;
        $this->timeRemaining = $duration * 60;
    }

    public function updatedAnswers()
    {
        $this->answeredCount = count(array_filter($this->answers, fn($answer) => !empty($answer)));
    }

    public function confirmSubmit()
    {
        $this->showConfirmation = true;
    }

    public function submitExam()
    {
        $this->showConfirmation = false;

        // التحقق من إجابة كل الأسئلة
        $this->validate(
            array_merge(
                ['answers.*' => 'required'],
                $this->exam->questions->mapWithKeys(function ($question) {
                    return ["answers.{$question->id}" => $question->type == 'mcq' ? 'required|exists:options,id' : 'required|string'];
                })->toArray()
            ),
            [
                'answers.*.required' => 'يجب الإجابة على كل الأسئلة.',
                'answers.*.exists' => 'الخيار المختار غير صالح.',
                'answers.*.string' => 'الإجابة المقالية يجب أن تكون نصًا.'
            ]
        );

        // إنشاء سجل الامتحان
        $studentExam = StudentExam::create([
            'exam_id' => $this->exam->id,
            'student_id' => Auth::id(),
            'started_at' => Carbon::now(),
            'submitted_at' => Carbon::now(),
        ]);

        // حفظ الإجابات
        foreach ($this->exam->questions as $question) {
            StudentAnswer::create([
                'student_exam_id' => $studentExam->id,
                'question_id' => $question->id,
                'option_id' => $question->type == 'mcq' ? ($this->answers[$question->id] ?? null) : null,
                'answer_text' => $question->type == 'essay' ? ($this->answers[$question->id] ?? null) : null,
            ]);
        }

        session()->flash('success', 'تم تقديم الامتحان بنجاح');
        return redirect()->route('student_exams.index');
    }

    public function render()
    {
        return view('admin.livewire.take-exam');
    }
}
