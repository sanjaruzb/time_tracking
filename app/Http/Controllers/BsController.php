<?php

namespace App\Http\Controllers;

use App\Models\Bs;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BsController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('bs-' . $action)) {
                    abort(403);
                }
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bss = Bs::filter($request->all())->latest()->paginate(20);
        $employees = User::select(
            'users.id as id',
            'users.number as number',
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
            ->where('users.number','!=',null)
            ->latest('users.updated_at')
            ->get();
        return view('bs.index',[
            'bss' => $bss,
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::select(
            'users.id as id',
            'users.number as number',
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
            ->latest('users.updated_at')
            ->get();
        return view('bs.create',[
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'number' => 'required',
            'auth_date' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        Bs::create([
            'number' => $request->number,
            'auth_date' => $request->auth_date,
            'start' => $request->start,
            'end' => $request->end,
            'hour' => round((strtotime($request->end) - strtotime($request->start))/3600)
        ]);
        return redirect()->route('bs.index')->with('success','BS успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bs = Bs::find($id);
        return view('bs.show', [
            'bs' => $bs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bs = Bs::find($id);
        $employees = User::select(
            'users.id as id',
            'users.number as number',
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
            ->latest('users.updated_at')
            ->get();
        return view('bs.edit', [
            'bs' => $bs,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(),[
            'number' => 'required',
            'auth_date' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $bs = Bs::find($id);
        $request->request->remove('_method');
        $request->request->remove('_token');
        $bs->update([
            'number' => $request->number,
            'auth_date' => $request->auth_date,
            'start' => $request->start,
            'end' => $request->end,
            'hour' => round((strtotime($request->end) - strtotime($request->start))/3600)
        ]);
        return redirect()->route('bs.index')->with('success','BS изменена успешно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bs = Bs::find($id);
        $bs->delete();
        return redirect()->route('bs.index')->with('success','BS удален успешно');
    }
}
