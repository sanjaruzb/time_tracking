<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Tt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BugalterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::select(
            'users.id as id',
            'users.firstname as firstname',
            'users.fio as fio',
            'users.date_entry as date_entry',
            'users.position_id as position_id',
            'users.department_id as department_id',
        )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('tt','users.number','=','tt.number')
            ->where('roles.name', 'Employee')
            ->where('model_has_roles.model_type', User::class)
            ->latest('users.id')
            ->paginate(20);

        $userInfo = [];
        foreach ($employees as $user){
            // 1. Total working hours workers need to work this month
            $totalWorkingHoursThisMonth = 8 * 5; // Assuming 8 hours per day, 5 days a week

            // 2. Total working hours this month for the current user
            $totalWorkingHours = Tt::where('number', $user->number)
                ->whereBetween('auth_date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('track', 1)
                ->whereIn(DB::raw('DAYOFWEEK(auth_date)'), [2, 3, 4, 5, 6]) // Monday to Friday
                ->sum(DB::raw("TIME_TO_SEC('17:00:00') - TIME_TO_SEC(auth_time)"));

            // 3. Calculate how many hours the current user was late to work
            $totalLateHours = Tt::where('number', $user->number)
                ->whereBetween('auth_date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('track', 1)
                ->whereIn(DB::raw('DAYOFWEEK(auth_date)'), [2, 3, 4, 5, 6]) // Monday to Friday
                ->whereTime('auth_time', '>', '09:00:00')
                ->sum(DB::raw("TIME_TO_SEC(auth_time) - TIME_TO_SEC('09:00:00')"));

            // 4. Calculate how many additional hours the current user stayed after work hours
            $totalAdditionalHours = Tt::where('number', $user->number)
                ->whereBetween('auth_date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('track', -1)
                ->whereIn(DB::raw('DAYOFWEEK(auth_date)'), [2, 3, 4, 5, 6]) // Monday to Friday
                ->whereTime('auth_time', '>', '17:00:00')
                ->sum(DB::raw("TIME_TO_SEC(auth_time) - TIME_TO_SEC('17:00:00')"));

            // Format the results
            $userInfo[$user->id] = [
                'name' => $user->fio,
                'total_working_hours_needed' => $totalWorkingHoursThisMonth,
                'total_working_hours' => gmdate("H:i:s", $totalWorkingHours),
                'total_late_hours' => gmdate("H:i:s", $totalLateHours),
                'total_additional_hours' => gmdate("H:i:s", $totalAdditionalHours),
            ];
        }

        //dd($userInfo);
        $positions = Position::get()->pluck('name','id');
        $departments = Department::get()->pluck('name','id');
        return view('bugalter.index',[
            'employees' => $employees,
            'positions' => $positions,
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
