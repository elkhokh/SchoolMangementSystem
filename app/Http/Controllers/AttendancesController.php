<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Students;
use App\Models\Attendances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreAttendancesRequest;
use App\Http\Requests\UpdateAttendancesRequest;

// class AttendancesController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */

// //   $nums = [1, 2, 3, 4, 5];
// // $result = array_filter($nums, function($value) {
// //     return $value % 2 == 0;
// // });
// // print_r($result);

//     public function index()
//     {

//         // $classes =Classes::with('students.user')->orderBy('id')->get();
//         // return view('admin.attandances.index',['classes'=>$classes]);

// // $classes = Classes::with(['students.attendances' => function($q) {
// //     $q->where('date', date('Y-m-d'));
// // }, 'students.user'])->get();
// try {
// // get all class but if class do not have students do not get it i will user Anonymous function
// $today = date('Y-m-d');
// $classes = Classes::whereHas('students')
//     ->with([
//         'students.attendances' =>
//         function($data) use ($today) {
//         $data->where('attendence_date', $today)->with('student.user');
//         },'students.user'])->get();
// //flatten علشان نحول المصفوفة المجمعة من كل الطلاب لمجموعة واحدة
//         foreach ($classes as $class) {
//                 $class->allMarked = $class->students->count() > 0 &&
//     $class->students->pluck('attendances')->flatten()
//     ->where('attendence_date', $today)->count() == $class->students->count();
//             }
// // $classes = Classes::whereHas('students')->with(['students.attendances' => function($data)
// //     {$data->where('attendence_date', date('Y-m-d'));}, 'students.user'])->get();
//     return view('admin.attandances.index', compact('classes'));

//     } catch (\Throwable $th) {
//         Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
//         session()->flash('Error');
//         return redirect()->back();
//     }
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(StoreAttendancesRequest $request)
//     {
//         // return $request ;
//                     {
// // "_token"         : "5xccPksJl7eYZ9eQLTgZGHckUtcEfd1wMqPgdyRH",
// // "attendence_date":   "2025-08-23",    //get data
// // "attendance"     : { "22": "1"    }, //get attandance_status with id of student
// // "class_id"       : { "22": "4"    } } //get class_id with student

//         try {
//         $today = date('Y-m-d');
//         // make condation to check attandnce
//             if (!$request->has('attendance')) {
//                 session()->flash('danger');
//                 return redirect()->back();
//             }
//         foreach ($request->attendance as $student_id => $status) {
//     $Check_status = Attendances::where('student_id', $student_id)->where('attendence_date', $today)->first();

//                 if ($Check_status)
//                     {
//                     $Check_status->update([
//                         'attendence_status' => $status,
//                         'class_id'          => $request->class_id[$student_id],
//                     ]);
//                 }
//                 else {
//                     Attendances::create([
//                         'student_id'  => $student_id,
//                         'class_id'   => $request->class_id[$student_id],
//                         'attendence_date'  => $today,
//                         'attendence_status' => $status,
//                     ]);}
//                 }
//     session()->flash('success');
//     } catch (\Throwable $th) {
//         Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
//         session()->flash('Error');
//     }
//  return redirect()->back();
//     }
// }


//     /**
//      * Display the specified resource.
//      */
//     // public function show(Attendances $attendances)
//     // {

//     // }


//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Attendances $attendances)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, $id)
// {
//     try {
//         $attendance = Attendances::findOrFail($id);

//         $request->validate([
//             'attendence_status' => 'required|in:1,0',
//         ]
//     );

//         $attendance->update([
//             'attendence_status' => $request->attendence_status
//         ]);

//         session()->flash('Update');
//         return redirect()->back();
//     } catch (\Throwable $th) {
//         Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
//         session()->flash('Error');
//         return redirect()->back();
//     }
// }


//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Attendances $attendances)
//     {
//         //
//     }
// }

class AttendancesController extends Controller
{
    public function index(Request $request)
    {
        // return $request;
        try {
            $select_day = $request->input('date', date('Y-m-d'));
            // return $select_day;
            $classes = Classes::whereHas('students')->with([
                'students.attendances' =>
                function($data) use ($select_day) {$data->where('attendence_date', $select_day)->with('student.user');},
                'students.user'
                ])->get();
            // return $classes ;

        // foreach ($classes as $class) {
        //     $all_students = $class->students->count();
        //     $mark_students = $class->students->filter(function ($student) use ($select_day) {
        //     return $student->attendances->where('attendence_date', $select_day)->count() > 0;})->count();
        //     $class->mark_class_as_ok = $all_students > 0 && $mark_students == $all_students;}
            return view('admin.attandances.index', compact('classes', 'select_day'));
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
            return redirect()->back();
        }
    }

    public function store(StoreAttendancesRequest $request)
    {
   // return $request ;

//                     {
// "_token"         : "5xccPksJl7eYZ9eQLTgZGHckUtcEfd1wMqPgdyRH",
//  "attendence_date":   "2025-08-23",    //get data
//  "attendance"     : { "22": "1"    }, //get attandance_status with id of student
// "class_id"
        try {
            $select_day = $request->attendence_date;

            if (!$request->has('attendance')) {
                session()->flash('danger');
                return redirect()->back();
            }

            foreach ($request->attendance as $student_id => $status) {
                $Check_status = Attendances::where('student_id', $student_id)
                    ->where('attendence_date', $select_day)
                    ->first();

                if ($Check_status) {
                    $Check_status->update([
                        'attendence_status' => $status,
                        'class_id'          => $request->class_id[$student_id],
                    ]);
                } else {
                    Attendances::create([
                        'student_id'        => $student_id,
                        'class_id'          => $request->class_id[$student_id],
                        'attendence_date'   => $select_day,
                        'attendence_status' => $status,
                    ]);
                }
            }

            session()->flash('success');
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        try {
            $attendance = Attendances::findOrFail($id);

            $request->validate([
                'attendence_status' => 'required|in:1,0',
            ]);

            $attendance->update([
                'attendence_status' => $request->attendence_status
            ]);

            session()->flash('Update');
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::channel("class")->error($th->getMessage() . $th->getFile() . $th->getLine());
            session()->flash('Error');
            return redirect()->back();
        }
    }
}
