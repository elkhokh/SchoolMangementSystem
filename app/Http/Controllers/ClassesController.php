<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Admin\ClassService;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;

class ClassesController extends Controller
{
    protected $classService;
    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $classes = $this->classService->indexService($search);
            if ($search && $classes->isEmpty()) {
                return redirect()->route('classes.index')->with('not_found', 'لا توجد نتائج مطابقة لبحثك')->with('search', '');
            }
            return view('admin.classes.index', compact('classes', 'search'));
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
            return redirect()->back();
        }
    }

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
            'name.unique' => 'اسم الفصل موجود بالفعل',
            'note.required' => 'الوصف مطلوب',//
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
