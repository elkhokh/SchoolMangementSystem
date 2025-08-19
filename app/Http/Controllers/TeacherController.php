<?php

namespace App\Http\Controllers;

use session;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    try {
        $search = $request->input('search');
        $query = Teacher::with(['user', 'subject'])->latest('id');
        if ($search) {
            $query->whereRelation('user', 'name', 'like', "%{$search}%");
        }
        $teachers = $query->paginate(7);
        if ($search && $teachers->isEmpty()) {
        return redirect()->route('teachers.index')->with('not_found', 'لا توجد نتائج مطابقة لبحثك');
        }
        return view('teachers.index', compact('teachers', 'search'));
    } catch (\Throwable $th) {
        Log::channel("teacher")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return view('teachers.index', ['teachers' => collect()]);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $roles = Role::query()->pluck('name')->all();
    // $classes = Classes::all();
    $subjects = Subjects::orderBy('id')->get();
    return view('teachers.create', compact('roles', 'subjects'));
    // return view('users.add_student', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        // return $request;
        try{
        // DB::beginTransaction();
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('teacher');

        Teacher::create([
            'user_id'        => $user->id,
            'subject_id'     => $request->subject_id,
            'address'     => $request->address,
            'gender'     => $request->gender,
            'phone'          => $request->phone,
            'specialization' => $request->specialization,
            'note'           => $request->note,
        ]);
        // DB::commit();
        session()->flash('Add');
        return redirect()->route('teachers.index');
        } catch (\Throwable $th) {
            // DB::rollBack();
        Log::channel("teacher")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->route('teachers.index');
    }

    }

    /**
     * Display the specified resource.
     */
       public function show($id)
    {

        try {
            $teacher = Teacher::with(['user', 'subject'])->findOrFail($id);
            return view('teachers.show', compact('teacher'));
        } catch (\Exception $th) {
            Log::channel('user')->error($th->getMessage()  . $th->getFile()  . $th->getLine());
            session()->flash('Error');
            return redirect()->route('teachers.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    // dd($id);
    try {
            $teacher = Teacher::with(['user.roles', 'subject'])->findOrFail($id);
            $subjects = Subjects::orderBy('id')->get();
            if ($teacher->user->hasRole('admin') && $teacher->user->id !== auth()->id()) {
                abort(403, 'لا تملك الصلاحيات لتعديل هذا المستخدم');
            }
            $roles = Role::pluck('name')->all();
            $userRoles = $teacher->user->roles->pluck('name')->all();
            return view('teachers.edit', compact('teacher', 'roles', 'userRoles', 'subjects'));
        } catch (\Exception $th) {
            Log::channel('user')->error($th->getMessage() . $th->getFile(). $th->getLine());
            session()->flash('Error');
            return redirect()->route('teachers.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
