<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Classes;
use App\Models\Students;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helpers\ValidationHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:show-users')->only(['index', 'show']);
    //     $this->middleware('permission:create-user')->only(['create', 'store']);
    //     $this->middleware('permission:edit-user')->only(['edit', 'update']);
    //     $this->middleware('permission:delete-user')->only(['destroy']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    try {
        $search = $request->input('search');

        // $query = User::query()->with('roles')->latest('id');
$query = User::query()->with('roles')->whereDoesntHave('student') ->whereDoesntHave('teacher')->latest('id');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('roles', function($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
                });
            });
        }
        $users = $query->paginate(7)->withQueryString();
        if ($search && $users->isEmpty()) {
            return redirect()->route('users.index')
                ->with('not_found', 'لا توجد نتائج مطابقة لبحثك')->with('search', $search);
        }
        return view('admin.users.index', compact('users', 'search'));
    } catch (\Throwable $th) {
        Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return view('admin.users.index', ['users' => collect()]);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::query()->pluck('name')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request): RedirectResponse
{
    // store normal user
    $input = $request->validate(
        User::validation(),
        User::validationMessages()
    );
    DB::beginTransaction();
    try {
        $user = User::create([
            'name'    => $input['name'],
            'email'   => $input['email'],
            'password'=> Hash::make($input['password']),
            'status'  => $input['status'],
        ]);

        if (!empty($request->roles_name)) {
            foreach ($request->roles_name as $role) {
                $user->assignRole($role);
            }
        }
// if i need to non active the role
        //  $user->assignRole('admin');

        DB::commit();
        session()->flash('Add');
        return redirect()->route('users.index');
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->route('users.create');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(User $user): RedirectResponse
    {
        return redirect()->route('users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        if ($user->hasRole('admin') && $user->id !== auth()->id()) {
            // abort(403, 'ليس لديك صلاحية تعديل هذا المستخدم.');
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
    }
    //fetch all roles
    $roles = Role::pluck('name')->all();
    // fetch current roles
    $userRoles = $user->roles->pluck('name')->all();
    return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
}

/**
 * Update the specified resource in storage.
*/

public function update(Request $request, User $user): RedirectResponse
// when i use model binding it's not rquired get user by id
{
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'status'   => 'required|in:0,1',
        'password'   => 'nullable|string|min:8|confirmed',
        'roles'    => 'required|array',
    ], [
        'name.required'     => 'اسم المستخدم مطلوب.',
        'name.string'      => 'اسم المستخدم يجب أن يكون نصاً.',
        'name.max'       => 'اسم المستخدم يجب ألا يزيد عن 255 حرفاً.',
        'email.required'   => 'البريد الإلكتروني مطلوب.',
        'email.email'    => 'البريد الإلكتروني غير صالح.',
        'email.unique'   => 'البريد الإلكتروني مسجل بالفعل.',
        'status.required'  => 'الحالة مطلوبة.',
        'status.in'      => 'قيمة الحالة غير صحيحة.',
        'password.min'   => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
        'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        'roles.required' => 'يجب تحديد نوع المستخدم.',
        'roles.array'    => 'صيغة الأدوار غير صحيحة.',
    ]);
    $data = [
        'name' => $validated['name'],
        'email' => $validated['email'],
        'status' => $validated['status'],
    ];
    if (!empty($validated['password'])) {
        $data['password'] = Hash::make($validated['password']);
    }
    try {
        $user->update($data);
        $user->syncRoles($validated['roles']);
        session()->flash('update');
    } catch (\Throwable $th) {
        Log::channel("user")->error($th->getMessage() . $th->getFile()  . $th->getLine());
        session()->flash('Error');
    }

    return redirect()->back();
}

/**
 * Remove the specified resource from storage.
*/
public function destroy($id): RedirectResponse
{
    try {
        $user = User::findOrFail($id);
        // check from role and can't delete admin or user use app now
        if ($user->hasRole('admin') || $user->id == auth()->id()) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
    // if student i need to check the first if had file must delete from storage/public/student_file/fileName
    if ($user->student) {
        $attachment = $user->student->attachments;
        if($attachment){
            $filePath = $attachment->file_name;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $attachment->delete();
        }
        $user->student->delete();
    }
        // delete role before delete data
        $user->syncRoles([]);
        $user->delete();
        session()->flash('Delete');
        // session()->flash('Delete', 'تم حذف المستخدم بنجاح');
        // return redirect()->route('users.index');
    } catch (\Exception  $th) {
        Log::channel("user")->error( $th->getMessage() . $th->getFile()  . $th->getLine());
        session()->flash('Error');
        // session()->flash('Error', 'حدث خطأ أثناء الحذف');
        // return redirect()->route('users.index');
    }
    return redirect()->route('users.index');

}

public function getStudent(){
    // return view('admin.users.add_student');
    $roles = Role::query()->pluck('name')->all();
    // $classes = Classes::all();
    $classes = Classes::orderBy('id')->get();
    return view('admin.users.add_student', compact('roles', 'classes'));
    // return view('admin.users.add_student', compact('roles'));
}
public function getTeacher(){
    $roles = Role::query()->pluck('name')->all();
    return view('admin.users.add_teacher', compact('roles'));
    // return view('admin.users.add_teacher');
}

public function addStudent(Request $request){
    // return view('admin.users.add-student');
}
public function addTeacher(Request $request){
    // return view('admin.users.add-teacher');
}

public function storeStudent(Request $request)
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
        return redirect()->route('users.index');
    } catch (\Exception $th) {
        DB::rollBack();
        Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->route('users.student');
    }
}

// public function storeStudent(Request $request)
// {
    //    $validated = $request->validate([
//       // validation el users beskal eam
//         'name'       => 'required|string|max:255',
//         'email'      => 'required|email|unique:users,email',
//         'password'   => 'required|string|min:8|confirmed',
//         'status'     => 'required|in:0,1',

//        // validation el users beskal eam ooooooooooooooooooo
//         'class_id'   => 'required|exists:classes,id',
//         'gender'     => 'required|in:male,female',
//         'birth_date' => 'required|date',
//         'address'    => 'nullable|string|max:255',
//         'note'       => 'nullable|string|max:500',
//     ], [
//         // the message of users validateion ooooooooooooooooo
//         'name.required'      => 'اسم المستخدم مطلوب.',
//         'name.max'           => 'اسم المستخدم يجب ألا يزيد عن 255 حرفاً.',
//         'email.required'     => 'البريد الإلكتروني مطلوب.',
//         'email.email'        => 'البريد الإلكتروني غير صالح.',
//         'email.unique'       => 'البريد الإلكتروني مسجّل بالفعل.',
//         'password.required'  => 'كلمة المرور مطلوبة.',
//         'password.min'       => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
//         'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
//         'status.required'    => 'الحالة مطلوبة.',
//         'status.in'          => 'قيمة الحالة غير صحيحة.',

//         // message of students validation  ooooooooooooooooooooooooooo
//         'class_id.required'  => 'القسم مطلوب.',
//         'class_id.exists'    => 'القسم المختار غير موجود.',
//         'gender.required'    => 'النوع مطلوب.',
//         'gender.in'          => 'النوع يجب أن يكون ذكر أو أنثى فقط.',
//         'birth_date.required'=> 'تاريخ الميلاد مطلوب.',
//         'birth_date.date'    => 'تاريخ الميلاد غير صالح.',
//         'address.string'     => 'العنوان يجب أن يكون نصاً.',
//         'address.max'        => 'العنوان يجب ألا يزيد عن 255 حرفاً.',
//         'note.string'        => 'الملاحظة يجب أن تكون نصاً.',
//         'note.max'           => 'الملاحظة يجب ألا تزيد عن 500 حرف.',
//     ]);

//     try {
    //         DB::beginTransaction();

    //         $user = User::create([
//             'name'     => $validated['name'],
//             'email'    => $validated['email'],
//             'password' => Hash::make($validated['password']),
//             'status'   => $validated['status'],
//         ]);

//         $user->assignRole('student');

//         Students::create([
    //             'user_id'    => $user->id,
    //             'class_id'   => $validated['class_id'] ?? null,
    //             'gender'     => $validated['gender'] ?? null,
    //             'address'     => $validated['address'] ?? null,
    //             'birth_date' => $validated['birth_date'] ?? null,
    //             'note'       => $validated['note'] ?? null,
    //         ]);

    //         DB::commit();

    //         session()->flash('Add');
    //         return redirect()->route('users.index');

    //     } catch (\Exception $th) {
        //         DB::rollBack();
//         Log::channel("user")->error($th->getMessage() . $th->getFile() . $th->getLine());
//         session()->flash('Error');
//         // return redirect()->back()->withInput();
//         return redirect()->route('users.student');

//     }
// }


/***************************************************** */


// public function index(): View
//  {
//     try {
//         $users = User::query()->latest('id')->with('roles')->paginate(7);
//         return view('admin.users.index', compact('users'));
//     } catch (\Throwable $th) {
//     Log::channel("user")->error( $th->getMessage() . $th->getFile(). $th->getLine());
//         session()->flash('Error');
//         // can return empty page or error
//         return view('admin.users.index', ['users' => collect()]);// filter data
//     }}

// public function edit(User $user): View
// {
//     // Check Only Super Admin can update his own Profile
//     if ($user->hasRole('admin')){
//         if($user->id != Auth()->user()->id){
//             abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
//         }
//     }
//     $roles = Role::query()->pluck('name')->all();
//     $userRoles = $user->roles->pluck('name')->all();
//     return view('admin.users.edit', compact('user' , 'roles' , 'userRoles'));
// }
}

