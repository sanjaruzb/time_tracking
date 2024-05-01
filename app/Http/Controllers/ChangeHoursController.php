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
}
