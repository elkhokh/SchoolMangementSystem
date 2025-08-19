<?php

namespace App\Http\Controllers\Api;

use App\Models\Subjects;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Http\Requests\StoreSubjectsRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // return subjects::all();
    // return ApiResponse::success(['subjects' =>Subjects::all() ],"Subjects retrieved successfully");
    // return ApiResponse::success(['subjects' =>Subjects::select('id', 'name')->paginate(3)],"Subjects retrieved successfully");
//collection when i need to fetch all data but in show i need to show one data
    return ApiResponse::success( [ "subjects" => SubjectResource::collection(Subjects::all()) ],"subjects retrieved successfully",200);
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(StoreSubjectsRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $subject = Subjects::create($data);
            DB::commit();
            return ApiResponse::success(new SubjectResource($subject), "Subject created successfully", 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::channel("subject")->error($th->getMessage() .  $th->getFile() . $th->getLine());
            return ApiResponse::error("فشل في إنشاء المادة", [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // to show one not collection 
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
    {
    // start trans - using try and catch   - check validation from form request - save all result or rollback
    //get data from id row - make validation rules - check name if repite or not
    $subjects = Subjects::findOrFail($id);
    $rules = [
        'note' => 'required|string',//nullab
        'degree' => 'required|numeric|min:0',//nullab
    ];
    if ($request->name == $subjects->name) {
        $rules['name'] = 'required|string|unique:subjects,name,' . $id;
    } else {
        $rules['name'] = 'required|string';
        }
    $request->validate($rules, [
        'name.required' => ' المادة مطلوب',
        'name.unique'   => ' المادة موجود بالفعل',
        'degree.required'   => 'درجة المادة مطلوبة',
        'degree.numeric'   => 'المادة ينبغي ان تكون رقم ',
        'degree.min' => 'الدرجة يجب ألا تكون أقل من 0',
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
        return ApiResponse::success(new SubjectResource($subjects), "subject updated successfully", 200);
        } catch (\Throwable $th) {
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("subject")->error($th->getMessage() . $th->getFile() . $th->getLine());
        return ApiResponse::error("Failed to update subject",500);
    }
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        DB::beginTransaction();
            try {
        Subjects::findOrFail($id)->delete();
        DB::commit();
    return ApiResponse::success(null, "subject deleted successfully", 200);
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::channel("subject")->error($th->getMessage() . $th->getFile() . $th->getLine());
       // // DB::rollBack();
        return ApiResponse::error("Failed to delete the subject", 500);
    }
    }
    }
