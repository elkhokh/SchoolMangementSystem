<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSubjectsRequest;
use App\Http\Requests\UpdateSubjectsRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request);
            try {
    $search = $request->input('search');
    $query = Subjects::query();
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }
    $subjects = $query->orderBy('id', 'asc')->paginate(7);
    if ($search && $subjects->isEmpty()) {
    return redirect()->route('subjects.index')->with('not_found', 'لا توجد نتائج مطابقة لبحثك')->with('search', '');
    }
    return view('subjects.index', compact('subjects', 'search'));
    } catch (\Throwable $th) {
        Log::channel("subject")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
        return redirect()->back();
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectsRequest $request)
    {
                // dd($request->all());
    try {
        $data = $request->validated();
        Subjects::create([
            'name' => $data['name'],
            'degree' => $data['degree'],
            'note' => $data['note'],
        ]);
        // session()->flash('Add', "تمت إضافة المادة بنجاح");
        session()->flash('Add');
        return redirect()->back();
    } catch (\Exception $th) {
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        return redirect()->back()->with('Error', 'حدث خطأ أثناء تخزين المادة ');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subjects $subjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subjects $subjects)
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
    $subjects = Subjects::findOrFail($id);
    $rules = [
        'note' => 'required|string',//nullab
        'degree' => 'required|numeric',//nullab
    ];

    if ($request->name == $subjects->name) {
        $rules['name'] = 'required|string|unique:subjects,name,' . $id;
    } else {
        $rules['name'] = 'required|string';
        }
        //role validation
    $request->validate($rules, [
        'name.required' => ' المادة مطلوب',
        'name.unique'   => ' المادة موجود بالفعل',
        'degree.required'   => 'درجة المادة مطلوبة',
        'degree.numeric'   => 'المادة ينبغي ان تكون رقم ',
        'note.required'  => 'الوصف مطلوب',
    ]);
    DB::beginTransaction();
    try {
        $subjects->update([
            'name' => $request->name,
            'degree' => $request->degree,
            'note' => $request->note,
        ]);
        DB::commit();
        session()->flash('Update');
        // session()->flash('Update', 'تم التحديث بنجاح');
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("subject")->error($th->getMessage() . $th->getFile() . $th->getLine());
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
        Subjects::findOrFail($id)->delete();
        session()->flash('Delete');
    } catch (\Throwable $th) {
        Log::channel("subject")->error($th->getMessage() . $th->getFile() . $th->getLine());
        session()->flash('Error');
    }
    return redirect()->back();
    }
}
