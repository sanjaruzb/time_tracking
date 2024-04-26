<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('holiday-' . $action)) {
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
        $holidays = Holiday::filter($request->all())->latest()->paginate(20);
        return view('holiday.index',[
            'holidays' => $holidays,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'date' => 'required|date|date_format:Y-m-d',
            'hour' => 'required|integer',
            'type' => 'required|integer|in:1,-1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        Holiday::create($request->all());
        return redirect()->route('holiday.index')->with('success','Информация создана успешно');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        return view('holiday.show',[
            'holiday' => $holiday,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        return view('holiday.edit',[
            'holiday' => $holiday,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        $validated = Validator::make($request->all(),[
            'date' => 'required|date|date_format:Y-m-d',
            'hour' => 'required|integer',
            'type' => 'required|integer|in:1,-1',
        ]);
        if ($validated->fails()){
            return back()->withInput()->withErrors($validated);
        }
        $request->request->remove('_method');
        $request->request->remove('_token');
        $holiday->update($request->all());
        return redirect()->route('holiday.index')->with('success','Информация изменена успешно');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return redirect()->route('holiday.index')->with('success','Информация удален успешно');
    }
}
