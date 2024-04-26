<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('user-' . $action)) {
                    abort(403, 'К сожалению, у вас нет разрешения на доступ к этому ресурсу.');
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
        $users = User::filter($request->only('firstname','lastname','email','role_id'))->latest()->paginate(20);
        $roles = Role::get()->pluck('name','id');
        return view('user.index',[
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get()->pluck('name','name');
        return view('user.create',[
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'roles' => new \App\Rules\ValidRoles,
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }

        $user = User::create($request->all());
        $user->assignRole($request->input('roles'));
        return redirect()->route('user.index')->with('success','Пользователь успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::get()->pluck('name','name');
        return view('user.edit',[
            'roles' => $roles,
            'user' => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = Validator::make($request->all(),[
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id),],
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'roles' => ['nullable', new \App\Rules\ValidRoles],
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
        ]);

        if (isset($request->roles)) {
            $user->syncRoles($request->roles);
        }
        return redirect()->route('user.index')->with('success','Обновление пользователя успешно выполнено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success','Пользователь удален успешно');
    }
}
