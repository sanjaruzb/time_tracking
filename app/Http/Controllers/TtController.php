<?php

namespace App\Http\Controllers;

use App\Imports\Report;
use App\Models\Tt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Shuchkin\SimpleXLS;

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
        $tts = Tt::filter($request->all())->latest()->paginate(40);
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
            if($key != 0 and isset($a[10]) and (strlen($a[9]) == 8 and strlen($a[10]) == 8)){

                if(!User::where(['number'=>$a[1]])->exists()){
                    $names = explode(' ',$a[2]);
                    $temp = User::create([
                        'firstname' => $names[1] ?? '',
                        'lastname' => $names[0] ?? '',
                        'email' => 'tmz'. $a[1] .'@tmz.com',
                        'password' => $a[1],
                        'number' => $a[1],
                        'fio' => $a[2],
                        'date_entry' => date("Y-m-d"),
                    ]);
                }


                Tt::create([
                    'number' => $a[1],
                    'name' => $a[2],
                    'auth_date' => $a[6],
                    'auth_time' => $a[9],
                    'track' => Tt::$kirish,
                ]);

                Tt::create([
                    'number' => $a[1],
                    'name' => $a[2],
                    'auth_date' => $a[6],
                    'auth_time' => $a[10],
                    'track' => Tt::$chiqish,
                ]);
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
