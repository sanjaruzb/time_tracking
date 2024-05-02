<?php

namespace App\Http\Controllers;

use App\Models\ChangeHours;
use App\Models\Department;
use App\Models\File;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy','change_template','change_template_submit','download_file','change_individual'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('employee-' . $action)) {
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
        $employees = User::select(
            'users.id as id',
            'users.firstname as firstname',
            'users.fio as fio',
            'users.date_entry as date_entry',
            'users.position_id as position_id',
            'users.department_id as department_id',
        )
            ->filter($request->only('fio','date_entry','department_id','position_id','status'))
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', 'Employee')
            ->where('model_has_roles.model_type', User::class)
            ->latest('users.updated_at')
            ->paginate(20);
        $positions = Position::get()->pluck('name','id');
        $departments = Department::get()->pluck('name','id');
        return view('employee.index', [
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
        $positions = Position::get()->pluck('name','id');
        $departments = Department::get()->pluck('name','id');
        return view('employee.create', [
            'positions' => $positions,
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'fio' => 'required|string|max:100',
            'date_entry' => 'required|date_format:Y-m-d',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'education' => 'nullable|string|max:100',
            'graduation_year' => 'nullable|string|max:4',
            'education_name' => 'nullable|string|max:100',
            'specialist' => 'nullable|string|max:100',
            'birthdate' => 'required|date_format:Y-m-d',
            'birth_place' => 'required|string|max:100',
            'gender' => 'required|integer|in:0,1',
            'nationality' => 'required|string|max:100',
            'citizenship' => 'required|string|max:100',
            'family_status' => 'required|string|max:100',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }

        $user = User::create($request->all());
        $role = Role::where('name','Employee')->first();
        $user->assignRole($role->name);
        return redirect()->route('employee.index')->with('success','Сотрудник успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        return view('employee.show',[
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $employee)
    {
        $positions = Position::get()->pluck('name','id');
        $departments = Department::get()->pluck('name','id');
        return view('employee.edit', [
            'positions' => $positions,
            'departments' => $departments,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $employee)
    {
        $validated = Validator::make($request->all(),[
            'fio' => 'required|string|max:100',
            'date_entry' => 'required|date_format:Y-m-d',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'education' => 'nullable|string|max:100',
            'graduation_year' => 'nullable|string|max:4',
            'education_name' => 'nullable|string|max:100',
            'specialist' => 'nullable|string|max:100',
            'birthdate' => 'required|date_format:Y-m-d',
            'birth_place' => 'required|string|max:100',
            'gender' => 'required|integer|in:0,1',
            'nationality' => 'required|string|max:100',
            'citizenship' => 'required|string|max:100',
            'family_status' => 'required|string|max:100',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $request->request->remove('_method');
        $request->request->remove('_token');
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('success','Обновление сотрудник успешно выполнено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success','Сотрудник удален успешно');
    }


    public function change_template($id){
        $user = User::where('id',$id)->first();
        return view('employee.change_template',[
            'user' => $user
        ]);
    }


    public function change_template_submit(Request $request){

        $this->validate($request, [
            'id' => 'required',
            'template' => 'required',
            'info' => 'required',
            'effective_date' => 'required',
        ]);

        $hour = ChangeHours::create([
            'user_id' => $request->id,
            'description' => $request->info,
            'shift' => json_encode(ChangeHours::TEMPLATES[$request->template]),
            'status' => 0,
            'effective_date' => $request->effective_date,
        ]);
        if ($request->hasFile('file')) {
            foreach ($request->file as $f){
                $file_name = date('Y_m_d_H_i_s').rand(10000, 99999).'.'.$f->getClientOriginalExtension();
                $f->move(public_path('employee_files'), $file_name);
                File::create([
                    'model' => ChangeHours::class,
                    'model_id' => $hour->id,
                    'name' => $file_name,
                    'ext' => $f->getClientOriginalExtension(),
                ]);
            }
        }


        return redirect()->route('employee.show', $request->id)->with('success','Данные сохронены');
    }

    public function download_file($file)
    {
        if (file_exists(public_path('employee_files/'.$file))) {
            return Response::download(public_path('employee_files/'.$file));
        } else {
            return redirect()->back()->with('error', "Файл не найден.");
        }
    }
    public function change_individual($id){
        $user = User::where('id',$id)->first();
        return view('employee.change_individual',[
            'user' => $user
        ]);
    }


    public function change_individual_submit(Request $request){

        $this->validate($request, [
            'id' => 'required',
            'template.*' => 'required',
            'info' => 'required',
            'effective_date' => 'required',
        ]);

        ChangeHours::create([
            'user_id' => $request->id,
            'description' => $request->info,
            'shift' => json_encode($request->template),
            'status' => 0,
            'effective_date' => $request->effective_date,
        ]);

        return redirect()->route('employee.show', $request->id)->with('success','Данные сохронены');
    }
}
