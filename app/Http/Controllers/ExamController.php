<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Teacher;
use App\Models\Subjects;
use App\Livewire\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $exams = Exam::with(['subject:id,name', 'teacher:id,user_id'])
                     ->latest()
                     ->paginate(15);

        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subjects::select('id', 'name')->orderBy('name')->get();

        // جلب المدرسين مع اسم المستخدم (User)
        $teachers = Teacher::with('user')
                    ->get()
                    ->mapWithKeys(function($teacher) {
                        return [$teacher->id => $teacher->user->name];
                    });

        return view('exam.create', compact('subjects','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $data = $request->validate([
            'title'         => ['required','string','max:255'],
            'subject_id'    => ['required','exists:subjects,id'],
            'teacher_id'    => ['required','exists:teachers,id'],
            'status'        => ['required','boolean'],              // عندك boolean
            'start_time'    => ['required','date'],
            'end_time'      => ['required','date','after:start_time'],
            'time_of_exam'  => ['required','integer','min:1'],      // بالدقايق عندك
            'note'          => ['nullable','string'],
        ]);

        // تحويل الـ datetime-local (لو جاية بـ T) إلى Timestamp مناسب
        $data['start_time']   = Carbon::parse($data['start_time']);
        $data['end_time']     = Carbon::parse($data['end_time']);

        Exam::create($data);

        return redirect()->route('exams.index')->with('success','تم إنشاء الامتحان بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
return view('exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
