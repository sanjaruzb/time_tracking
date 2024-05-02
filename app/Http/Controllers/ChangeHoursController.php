<?php

namespace App\Http\Controllers;


use App\Models\ChangeHours;
use Illuminate\Support\Facades\Gate;

class ChangeHoursController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'allow', 'cancel'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('changehour-' . $action)) {
                    abort(403);
                }
            }
            return $next($request);
        });
    }

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
