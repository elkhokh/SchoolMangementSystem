<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Option;

class ExamQuestions extends Component
{
    public $exam;
    public $question_text;
    public $type = 'mcq';
    public $mark;
    public $keywords = '';
    public $options = [];

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->options = [
            ['option_text'=>'', 'is_correct'=>false],
            ['option_text'=>'', 'is_correct'=>false],
        ]; // افتراضي خيارين
    }

    public function addOption()
    {
        $this->options[] = ['option_text'=>'', 'is_correct'=>false];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function addQuestion()
    {
        $this->validate([
            'question_text' => 'required|string',
            'type'          => 'required|in:mcq,essay',
            'mark'          => 'required|integer|min:1',
        ]);

        $question = Question::create([
            'exam_id'       => $this->exam->id,
            'question_text' => $this->question_text,
            'type'          => $this->type,
            'mark'          => $this->mark,
            'keywords'      => $this->type == 'essay' ? $this->keywords : null,
        ]);

        // لو MCQ اضف الخيارات
        if($this->type == 'mcq' && !empty($this->options)){
            foreach($this->options as $opt){
                if(!empty($opt['option_text'])){
                    $question->options()->create($opt);
                }
            }
        }

        $this->reset(['question_text', 'mark', 'keywords']);
        $this->options = [
            ['option_text'=>'', 'is_correct'=>false],
            ['option_text'=>'', 'is_correct'=>false],
        ];

        session()->flash('success', 'تمت إضافة السؤال بنجاح ✅');
    }

public function render()
{
    return view('admin.livewire.exam-questions', [
        'questions' => $this->exam->questions()->with('options')->latest()->get(),
    ]);
}
}
