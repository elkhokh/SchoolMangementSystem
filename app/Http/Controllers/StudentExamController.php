<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\StudentExam;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStudentExamRequest;
use App\Http\Requests\UpdateStudentExamRequest;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        // جلب الامتحانات الخاصة بالطالب أو المتاحة له
        $studentExams = Exam::with('teacher.user')
            ->whereHas('studentExams', function($q){
                $q->where('student_id', Auth::id());
            })
            ->orWhere('status', 1) // لو الامتحان مفعل
            ->latest()
            ->paginate(10);

        return view('student_exams.index', compact('studentExams'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // رابط للـLivewire component للطالب لبدء الامتحان
        return view('student_exams.show', compact('exam'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentExamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(StudentExam $studentExam)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentExam $studentExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentExamRequest $request, StudentExam $studentExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentExam $studentExam)
    {
        //
    }
}
