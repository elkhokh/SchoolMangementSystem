<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Http\Requests\StoreAttendancesRequest;
use App\Http\Requests\UpdateAttendancesRequest;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAttendancesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendances $attendances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendances $attendances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendancesRequest $request, Attendances $attendances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendances $attendances)
    {
        //
    }
}
