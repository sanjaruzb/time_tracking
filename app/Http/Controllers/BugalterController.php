<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class BugalterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::select(
            'users.id as id',
            'users.firstname as firstname',
            'users.fio as fio',
            'users.date_entry as date_entry',
            'users.position_id as position_id',
            'users.department_id as department_id',
        )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', 'Employee')
            ->where('model_has_roles.model_type', User::class)
            ->latest('users.id')
            ->paginate(20);

        $positions = Position::get()->pluck('name','id');
        $departments = Department::get()->pluck('name','id');
        return view('bugalter.index',[
            'employees' => $employees,
            'positions' => $positions,
            'departments' => $departments,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
