<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreClassSessionRequest;
use App\Http\Requests\UpdateClassSessionRequest;

class ClassSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index(Request $request)
//     {
//     $search = $request->input('search');

//     $sessions = ClassSession::with(['class', 'subject', 'teacher'])
//         ->when($search, function ($query) use ($search) {
//             $query->where('day', 'like', "%{$search}%");
//         })
//         ->orderBy('day')
//         ->orderBy('start_time')
//         ->paginate(10);

//     return view('admin.sessions.index', compact('sessions', 'search'));
// }

public function index(Request $request)
{
    try {
        $search = $request->input('search');
        $query = ClassSession::with(['class', 'subject', 'teacher']);
        if ($search) {
            $query->where('day', 'like', "%{$search}%");
        }
$sessions = $query->orderBy('day')->orderBy('start_time')->paginate(10);

        if ($search && $sessions->isEmpty()) {
            return redirect()->route('sessions.index')
                ->with('not_found', 'لا توجد نتائج مطابقة لبحثك')
                ->with('search', '');
        }
        return view('admin.sessions.index', compact('sessions', 'search'));
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
    public function store(StoreClassSessionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSession $classSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSession $classSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassSessionRequest $request, ClassSession $classSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSession $classSession)
    {
        //
    }
}
