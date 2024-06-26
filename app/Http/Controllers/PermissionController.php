<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('permission-' . $action)) {
                    abort(403);
                }
            }
            return $next($request);
        });
    }

    public function index(){
        $permissions = Permission::latest()->paginate(20);
        return view('permission.index',[
            'permissions' => $permissions,
        ]);
    }

    public function create(){
        return view('permission.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
        $request->request->add([
            'guard_name' => 'web',
        ]);
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success','Permission created successfully');
    }

    public function show($id){
        $permission = Permission::find($id);
        return view('permission.show',[
            'permission' => $permission,
        ]);
    }

    public function edit($id){
        $permission = Permission::find($id);
        return view('permission.edit',[
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
        ]);
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
        ]);
        return redirect()->route('permissions.index')
            ->with('success','Permission updated successfully');
    }

    public function destroy($id){
        Permission::where('id',$id)->delete();
        return redirect()->route('permissions.index')
            ->with('success','Permission deleted successfully');
    }
}
