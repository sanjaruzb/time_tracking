<?php

namespace App\Http\Controllers;

use App\Imports\Report;
use App\Models\Department;
use App\Models\Tt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Shuchkin\SimpleXLS;
use Spatie\Permission\Models\Role;

class TtController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('tt-' . $action)) {
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
        $tts = Tt::with('department')->filter($request->all())->latest()->paginate(40);
        return view('tt.index', [
            'tts' => $tts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tt.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 300);
        $this->validate($request, [
            'excel' => 'required|file|mimes:xlsx',
        ]);

        $file_name = date('Y_m_d_H_i_s') . rand(10000, 99999) . '.xlsx';
        $request->file('excel')->move(storage_path('excel_files'), $file_name);
        $array = Excel::toArray(new Report(), storage_path('excel_files\\' . $file_name));
        foreach ($array[0] as $key => $a){
            if($key != 0){

                $names = explode(' ',$a[2]);

                $dep = Department::firstOrCreate([
                    'code' => (int)substr($a[3],strpos($a[3], 'TMZ/') + 4),
                ],[
                    'name' => $a[3],
                    'status' => 1,
                ]);
                $temp = User::firstOrCreate([
                    'number' => $a[1],
                ],[
                    'firstname' => $names[1] ?? '',
                    'lastname' => $names[0] ?? '',
                    'email' => 'tmz'. $a[1] .'@tmz.com',
                    'department_id' => $dep->id ?? null,
                    'password' => $a[1],
                    'fio' => $a[2],
                    'date_entry' => date("Y-m-d"),
                ]);

                $role = Role::where(['name' => 'Employee'])->first();
                $temp->assignRole([$role->id]);

                $today_k = 'day' . date('w', strtotime($a[6])) . '_1';
                $today_c = 'day' . date('w', strtotime($a[6])) . '_2';


                if(strlen($a[9]) > 7){
                    Tt::updateOrCreate([
                        'number' => $a[1],
                        'auth_date' => $a[6],
                        'track' => Tt::$kirish,
                    ],[
                        'name' => $a[2],
                        'auth_time' => $a[9],
                        'arrival_status' => strtotime('1970-01-01 ' . $a[9]) < strtotime('1970-01-01 ' . ($temp->$today_k ?: '00:00:00')) ? 2 : 3
                    ]);
                }
                if(strlen($a[10]) > 7) {
                    Tt::updateOrCreate([
                        'number' => $a[1],
                        'auth_date' => $a[6],
                        'track' => Tt::$chiqish,
                    ], [
                        'name' => $a[2],
                        'auth_time' => $a[10],
                        'arrival_status' => strtotime('1970-01-01 ' . $a[10]) > strtotime('1970-01-01 ' . ($temp->$today_c ?: '23:59:59')) ? -2 : -3
                    ]);
                }
            }
        }
        return redirect()->route('tt.index')->with('success', 'Excel успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tt $tt)
    {
        return view('tt.show',[
            'tt' => $tt,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tt $tt)
    {
        return view('tt.edit',[
            'tt' => $tt,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tt $tt)
    {
        $tt->delete();
        return redirect()->route('tt.index')->with('success','Учетом времени удален успешно');
    }
}
