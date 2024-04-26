<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('department-' . $action)) {
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
        $departments = Department::filter($request->only('name','code','status'))->latest()->paginate(20);
        return view('department.index',[
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'code' => 'required|integer',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        Department::create($request->all());
        return redirect()->route('department.index')->with('success','Отдел успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('department.show', [
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('department.edit', [
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'code' => 'required|integer',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $department->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
        ]);
        return redirect()->route('department.index')->with('success','Отдел изменена успешно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('success','Отдел удален успешно');
    }
}
