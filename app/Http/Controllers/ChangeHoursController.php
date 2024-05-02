<?php

namespace App\Http\Controllers;


use App\Models\ChangeHours;

class ChangeHoursController extends Controller
{
    public function index(){

        $hs = ChangeHours::where('status', 0)->paginate();

        return view('change_hours.index', [
            'hs' => $hs
        ]);
    }

    public function allow($id)
    {
        $hs = ChangeHours::where('id',$id)->first();
        if (empty($hs))
            return back()->with('error',"Инфо не находит");
        $hs->update([
            'status' => 1,
        ]);
        return back()->with('success',"Время изменено успешно");
    }

    public function cancel($id)
    {
        $hs = ChangeHours::where('id',$id)->first();
        if (empty($hs))
            return back()->with('error',"Инфо не находит");
        $hs->update([
            'status' => 2,
        ]);
        return back()->with('success',"Время изменено успешно");
    }
}
