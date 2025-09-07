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
     * Display a listing of available exams for the authenticated user.
     */
    public function index()
    {
        // جلب الامتحانات المتاحة للمستخدم (مفعلة أو مرتبطة بالمستخدم)
        $studentExams = Exam::with(['teacher.user', 'subject'])
            ->where(function ($query) {
                $query->whereHas('studentExams', function ($q) {
                    $q->where('student_id', Auth::id());
                })->orWhere('status', 1); // الامتحانات المفعلة
            })
            ->latest()
            ->paginate(10);

        return view('admin.student_exams.index', compact('studentExams'));
    }

    /**
     * Display the specified exam for the user to take.
     */
    public function show(Exam $exam)
    {
        // التأكد إن المستخدم مسجل دخوله
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول لأداء الامتحان.');
        }

        // السماح لأي مستخدم مسجل دخوله بدخول الامتحان
        return view('admin.student_exams.show', compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // لسه مش مستخدم
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentExamRequest $request)
    {
        // لسه مش مستخدم
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentExam $studentExam)
    {
        // لسه مش مستخدم
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentExamRequest $request, StudentExam $studentExam)
    {
        // لسه مش مستخدم
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentExam $studentExam)
    {
        // لسه مش مستخدم
    }
}
