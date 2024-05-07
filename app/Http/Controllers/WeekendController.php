<?php

namespace App\Http\Controllers;

use App\Models\Tt;
use App\Models\Weekend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WeekendController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'allow', 'cancel'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('weekend-' . $action)) {
                    abort(403);
                }
            }
            return $next($request);
        });
    }

    public function index(){

        $ws = Weekend::where('status', 0)->paginate();

        return view('weekend.index', [
            'ws' => $ws
        ]);
    }

    public function allow($id)
    {
        $w = Weekend::where('id',$id)->first();
        if (empty($w))
            return back()->with('error',"Инфо не находит");
        $w->update([
            'status' => 1,
        ]);
        Tt::create([
            'number' => $w->user->number ?? '',
            'auth_date' => $w->come,
            'auth_time' => $w->come_time,
            'track' => 1,
            'name' => $w->user->fio ?? '',
        ]);
        Tt::create([
            'number' => $w->user->number ?? '',
            'auth_date' => $w->left,
            'auth_time' => $w->left_time,
            'track' => -1,
            'name' => $w->user->fio ?? '',
        ]);
        return back()->with('success',"Время изменено успешно");
    }

    public function cancel($id)
    {
        $w = Weekend::where('id',$id)->first();
        if (empty($w))
            return back()->with('error',"Инфо не находит");
        $w->update([
            'status' => 2,
        ]);
        return back()->with('success',"Время изменено успешно");
    }
}
