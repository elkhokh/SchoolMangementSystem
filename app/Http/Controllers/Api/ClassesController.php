<?php

namespace App\Http\Controllers\Api;

use App\Models\Classes;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassResource;
use App\Http\Requests\UpdateClassesRequest;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // return Classes::all();
    // return ApiResponse::success(['classes' =>Classes::all() ],"Classes retrieved successfully");
    // return ApiResponse::success(['classes' =>Classes::select('id', 'name')->paginate(3)],"Classes retrieved successfully");

return ApiResponse::success( [ "classes" => ClassResource::collection(Classes::all()) ],"Classes retrieved successfully",200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate(
        [
        'name' => 'required|string|unique:classes,name',
        'note' => 'nullable|string',
    ]);
    $class = Classes::create($validated);
    return ApiResponse::success( new ClassResource($class), "Class created successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
    {
        $class = Classes::findOrFail($id);
        $rules = [
            'note' => 'required|string',
        ];
        if ($request->name == $class->name) {
            $rules['name'] = 'required|string|unique:classes,name,' . $id;
        } else {
            $rules['name'] = 'required|string|unique:classes,name';
        }
        $request->validate($rules, [
            'name.required' => 'اسم الفصل مطلوب',
            'name.unique' => 'اسم الفصل موجود بالفعل',
            'note.required' => 'الوصف مطلوب',
        ]);
        DB::beginTransaction();
        try {
            $class->update([
                'name' => $request->name,
                'note' => $request->name,
            ]);
            DB::commit();
            return ApiResponse::success(new ClassResource($class), "Class updated successfully", 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel("class")->error($th->getMessage()  . $th->getFile()  . $th->getLine());
            return ApiResponse::error("Failed to update class", 500);
        }
    }
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        DB::beginTransaction();
            try {
        classes::findOrFail($id)->delete();
        DB::commit();
    return ApiResponse::success(null, "Class deleted successfully", 200);
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
       // // DB::rollBack();
        return ApiResponse::error("Failed to delete the class", 500);
    }
    }
    }

    //  public function update(UpdateClassesRequest $request, string $id)
    // {
    //     $class = Classes::findOrFail($id);

    //     DB::beginTransaction();
    //     try {
    //         $class->update([
    //             'name' => $request->name,
    //             'note' => $request->note,
    //         ]);
    //         DB::commit();
    //         return ApiResponse::success(new ClassResource($class), "Class updated successfully", 200);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         Log::channel("class")->error($th->getMessage() . ' in ' . $th->getFile() . ' at line ' . $th->getLine());
    //         return ApiResponse::error("Failed to update class", 500);
    //     }
    // }

// public function update(Request $request, string $id)
// {
//     $class = Classes::findOrFail($id);
//     $validated = $request->validate(
//         [
//         'name' => 'required|string|unique:classes,name,' . $class->id,
//         'note' => 'nullable|string',
//     ]);
//     $class->update($validated);
//     return ApiResponse::success(new ClassResource($class), "Class updated successfully", 200);
// }

