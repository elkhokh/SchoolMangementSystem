<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Helpers\ValidationHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    try {
        $search = $request->input('search');
        $query = Students::with(['user', 'class'])->latest('id');
        if ($search) {
            $query->whereRelation('user', 'name', 'like', "%{$search}%");
        }
        $students = $query->paginate(7);
        if ($search && $students->isEmpty()) {
        return redirect()->route('students.index')->with('not_found', 'لا توجد نتائج مطابقة لبحثك');
        }
        return view('students.index', compact('students', 'search'));
    } catch (\Throwable $th) {
        Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return view('students.index', ['students' => collect()]);
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    $roles = Role::query()->pluck('name')->all();
    // $classes = Classes::all();
    $classes = Classes::orderBy('id')->get();
    return view('students.create', compact('roles', 'classes'));
    // return view('users.add_student', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // return $request->all();
    // dd($request->file('file_name'));
    //helper classssssssssssssssssss
    $validated = $request->validate(
        ValidationHelper::studentRules(),
        ValidationHelper::studentMessages()
    );
    try {

        DB::beginTransaction();
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status'   => $validated['status'],
        ]);
        $user->assignRole('student');
    $student = Students::create([
            'user_id'    => $user->id,
            'class_id'   => $validated['class_id'] ?? null,
            'gender'     => $validated['gender'] ?? null,
            'address'    => $validated['address'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'note'       => $validated['note'] ?? null,
        ]);

// attachment data for student
        $fileName = null;
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            // file_name - upload file in storage - save to var
            // $fileName = time() . "_" . $file->getClientOriginalName();
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $url =Storage::disk("public")->putFileAs("student_file", $file, $fileName);
            //save the name of file with name of image
            $validated['file_name'] = $url;
        }
        $student->attachments()->create([
            'father_name'  => $validated['father_name'],
            'mother_name'  => $validated['mother_name'],
            'parent_email' => $validated['parent_email'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            // 'file_name'    => $fileName ?? null, //just save name of image
            'file_name'    => $validated['file_name'] ?? null,
            'note'         => $validated['note'] ?? null,
        ]);

        DB::commit();
        session()->flash('Add');
        return redirect()->route('students.index');
    } catch (\Exception $th) {
        DB::rollBack();
        Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->route('students.create');
    }
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        try {
            // $student = Students::with(['user','class','attachments','teachers','subjects'])->findOrFail($id);
            $student = Students::with(['user', 'class', 'attachments'])->findOrFail($id);
            // return $student ;
            return view('students.show', compact('student'));
        } catch (\Exception $th) {
            Log::channel('user')->error($th->getMessage()  . $th->getFile()  . $th->getLine());
            session()->flash('Error');
            return redirect()->route('students.index');
        }
        // $users = user::findOrFail($id);
        // $students  = students::where('user_id',$id)->get();
        // $attachments  = attachments::where('student_id',$id)->get();
        // return view('students.show',compact('users','students','attachments'));

    }

    /**
     * Show the form for editing the specified resource.
     */

public function edit($id)
{
    // dd($id);
    try {
            $student = Students::with(['user.roles', 'class', 'attachments'])->findOrFail($id);
            $classes = Classes::orderBy('id')->get();
            if ($student->user->hasRole('admin') && $student->user->id !== auth()->id()) {
                abort(403, 'لا تملك الصلاحيات لتعديل هذا المستخدم');
            }
            $roles = Role::pluck('name')->all();
            $userRoles = $student->user->roles->pluck('name')->all();
            return view('students.edit', compact('student', 'roles', 'userRoles', 'classes'));
        } catch (\Exception $th) {
            Log::channel('user')->error($th->getMessage() . $th->getFile(). $th->getLine());
            session()->flash('Error');
            return redirect()->route('students.index');
        }
}


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Students $students)
    // {
    //     //
    // }
    public function update(UpdateStudentsRequest $request, $id)
{
    $student = Students::with(['user', 'attachments'])->findOrFail($id);

    try {
        DB::beginTransaction();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ];
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        $student->user->update($userData);

        // update data
        $studentData = [
            'class_id' => $request->class_id ?? null,
            'gender' => $request->gender ?? null,
            'address' => $request->address ?? null,
            'birth_date' => $request->birth_date ?? null,
            'note' => $request->note ?? null,
        ];
        $student->update($studentData);


        $attachmentData = [
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'parent_email' => $request->parent_email ?? null,
            'parent_phone' => $request->parent_phone ?? null,
            'note' => $request->note ?? null,
        ];
        //steps
    //check the first fi has file sec if send file delete the old file after that save new file or create new file if don't have
        if ($request->hasFile('file_name')) {

            if ($student->attachments && $student->attachments->file_name && Storage::disk('public')->exists($student->attachments->file_name)) {
                Storage::disk('public')->delete($student->attachments->file_name);
            }
            $file = $request->file('file_name');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $url = Storage::disk('public')->putFileAs('student_file', $file, $fileName);
            $attachmentData['file_name'] = $url;
        }
    // make process
        if ($student->attachments) {
            $student->attachments->update($attachmentData);
        } else {
            $student->attachments()->create($attachmentData);
        }
    // ok man save data
        DB::commit();
        session()->flash('Update');
        return redirect()->route('students.index');
    } catch (\Exception $th) {
        DB::rollBack();
        Log::channel('user')->error($th->getMessage() .$th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->route('students.edit', $id);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
        $student = students::with(['user','class','attachments'])->findOrFail($id);
        // dd($id, $student);
        if ($student->attachments) {
            $filePath = $student->attachments->file_name;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $student->attachments->delete();
        }
        // $student->delete();
    //when i had many files or hasMany relation with attachment must make foreach to get all files
        // foreach ($student->attachments as $attachment) {
        //     $filePath = $attachment->file_name;
        //     if (Storage::disk('public')->exists($filePath)) {
        //         Storage::disk('public')->delete($filePath);
        //     }       $attachment->delete();       }

        // $student->forceDelete();// forece delete

        $student->user->syncRoles([]);
        $student->user->delete();// soft delete
        session()->flash('Delete');
        } catch (\Exception $th) {
            Log::channel('user')->error($th->getMessage()  . $th->getFile()  . $th->getLine());
            session()->flash('Error');
        }
        return redirect()->route('students.index');
    }

}

