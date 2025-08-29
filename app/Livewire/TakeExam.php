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

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
    }

    public function submitExam()
    {
        $studentExam = StudentExam::create([
            'exam_id' => $this->exam->id,
            'student_id' => Auth::id(),
            'started_at' => Carbon::now(),
            'submitted_at' => Carbon::now(),
        ]);

        foreach($this->exam->questions as $question){
            StudentAnswer::create([
                'student_exam_id' => $studentExam->id,
                'question_id' => $question->id,
                'option_id' => $question->type == 'mcq' ? $this->answers[$question->id] ?? null : null,
                'answer_text' => $question->type == 'essay' ? $this->answers[$question->id] ?? null : null,
            ]);
        }

        session()->flash('success', 'تم تقديم الامتحان بنجاح');
        return redirect()->route('student_exams.index');
    }

    public function render()
    {
        return view('livewire.take-exam');
    }
}
