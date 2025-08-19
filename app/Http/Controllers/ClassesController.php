<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//     public function index(){
//     try {
//         $classes = Classes::orderBy('id', 'asc')->paginate(7);
//         return view('classes.index', ['classes' => $classes]);
//     } catch (\Throwable $th) {
//         Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
//         session()->flash('Error');
//         // return redirect()->route('classes.index');
//         // session()->flash('Error', 'حدث خطأ أثناء تحميل الفصول');
//         return redirect()->back();
//     }
// }

public function index(Request $request)
{
    try {
    $search = $request->input('search');
    $query = Classes::query();
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }
    $classes = $query->orderBy('id', 'asc')->paginate(7);
    if ($search && $classes->isEmpty()) {
    return redirect()->route('classes.index')->with('not_found', 'لا توجد نتائج مطابقة لبحثك')->with('search', '');
    }
    return view('classes.index', compact('classes', 'search'));
    } catch (\Throwable $th) {
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->back();
    }
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
    public function store(StoreClassesRequest $request)
    {
        // dd($request->all());
    try {
        $data = $request->validated();
        Classes::create([
            'name' => $data['name'],
            'note' => $data['note'],
        ]);
        // session()->flash('Add', "تمت إضافة القسم بنجاح");
        session()->flash('Add');

    } catch (\Exception $th) {
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
    }
return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
    // start trans - using try and catch   - check validation from form request - save all result or rollback
    //get data from id row - make validation rules - check name if repite or not -
    $classes = classes::findOrFail($id);
    $rules = [
        'note' => 'required|string',//nullab
    ];
    if ($request->name == $classes->name) {
        $rules['name'] = 'required|string|unique:classes,name,' . $id;
    } else {
        $rules['name'] = 'required|string';
        }
        //role validation
    $request->validate($rules, [
        'name.required' => 'اسم الفصل مطلوب',
        'name.unique'   => 'اسم الفصل موجود بالفعل',
        'note.required'  => 'الوصف مطلوب',//
    ]);
    DB::beginTransaction();
    try {
        $classes->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);
        DB::commit();
        session()->flash('Update');
        // session()->flash('Update', 'تم التحديث بنجاح');
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
    }
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    try {
        classes::findOrFail($id)->delete();
        session()->flash('Delete');
    } catch (\Throwable $th) {
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
    }
    return redirect()->back();
    }
}
