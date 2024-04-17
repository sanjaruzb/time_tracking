<?php

namespace App\Http\Controllers;

use App\Imports\Report;
use App\Models\Tt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tts = Tt::latest()->paginate(40);
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
        $this->validate($request, [
            'excel' => 'required',
        ]);
        $datas = Excel::toArray(new Report(), $request->file('excel'));

        foreach ($datas[0] as $d){
            if (is_int((int)$d[0]) and (int)$d[0] > 0){
                if (!empty($d[9])){
                    Tt::create([
                        'number' => substr($d[1],0,20),
                        'name' => $d[2],
                        'auth_date' => $d[6],
                        'auth_time' => $d[9],
                        'track' => 1,
                    ]);
                }
                if (!empty($d[10])){
                    Tt::create([
                        'number' => substr($d[1],0,20),
                        'name' => $d[2],
                        'auth_date' => $d[6],
                        'auth_time' => $d[10],
                        'track' => -1,
                    ]);
                }
            }
        }
        return redirect()->route('tt.index')->with('success', 'Excel created successfully');
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
