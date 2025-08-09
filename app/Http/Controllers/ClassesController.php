<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
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
        return redirect()->back();
    } catch (\Exception $th) {
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
        return redirect()->back()->with('Error', 'حدث خطأ أثناء تخزين الفصل ');
    }
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
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
