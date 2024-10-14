<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Department;
use App\Models\File;
use App\Models\Position;
use App\Models\Tt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CadreController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'show', 'edit', 'update', 'destroy', 'changeStatus', 'report', 'weekend', 'all'];
            foreach ($actions as $action) {
                if ($request->route()->getActionMethod() === $action && !Gate::allows('cadre-' . $action)) {
                    abort(403);
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $tts = Tt::with('user')->latest();
        if ($request->number) {
            $tts = $tts->where('number', $request->number);
        }
        if ($request->name) {
            $tts = $tts->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->track) {
            $tts = $tts->where('track', $request->track);
        }
        if ($request->status) {
            $tts = $tts->where('status', $request->status);
        }
        if ($request->arrival_status) {
            $tts = $tts->where('arrival_status', $request->arrival_status);
        }
        if ($request->department_id) {
            $tts = $tts->whereHas('user', function ($query) use ($request) {
                $query->where('department_id', $request->department_id);
            });
        }
        if ($request->position_id) {
            $tts = $tts->whereHas('user', function ($query) use ($request) {
                $query->where('position_id', $request->position_id);
            });
        }

        $week_day = date('w');

        if ($week_day == '0')
            $strtt = strtotime('-2 days');
        elseif ($week_day == '1')
            $strtt = strtotime('-3 days');
        else
            $strtt = strtotime('-1 day');

        $tts = $tts->where('status', 0)->where('auth_date', date('Y-m-d', $strtt));
        $tts = $tts->paginate(40);
        $positions = Position::latest()->get()->pluck('name', 'id');
        $departments = Department::latest()->get()->pluck('name', 'id');
        return view('cadre.index', [
            'tts' => $tts,
            'positions' => $positions,
            'departments' => $departments,
        ]);
    }

    public function show($id)
    {
        $tt = Tt::find($id);
        return view('cadre.show', [
            'tt' => $tt,
        ]);
    }

    public function edit($id)
    {
        $tt = Tt::find($id);
        return view('cadre.edit', [
            'tt' => $tt,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'info' => 'nullable|string|max:250',
            /*'file' => 'nullable|file',*/
        ]);
        if ($request->hasFile('file')) {
            foreach ($request->file as $f) {
                $file_name = date('Y_m_d_H_i_s') . rand(10000, 99999) . '.' . $f->getClientOriginalExtension();
                $f->move(public_path('tt_files'), $file_name);
                File::create([
                    'model' => Tt::class,
                    'model_id' => $id,
                    'name' => $file_name,
                    'ext' => $f->getClientOriginalExtension(),
                ]);
            }
        }

        if (in_array($request->info_type, [0, 1, 2, 4])) {
            $temp = Tt::where('id', $id)->first();
            Tt::where([
                'auth_date' => $temp->auth_date,
                'number' => $temp->number,
            ])->update([
                'info' => $request->info,
                'difference' => $request->difference,
                'info_type' => $request->info_type,
            ]);
        } else {
            Tt::where('id', $id)->update([
                'info' => $request->info,
                'difference' => $request->difference,
                'info_type' => $request->info_type,
            ]);
        }
        return redirect()->route('cadre.show', $id)->with('success', 'Информация изменена успешно');
    }

    public function changeStatus($id, $status)
    {
        $tt = Tt::where('id', $id)->first();
        if (!$tt) {
            return redirect()->back()->with('error', "Время не найдено");
        }
        if (!in_array($status, [0, 1, 2, 3])) {
            return redirect()->back()->with('error', "Неверное значение статуса");
        }
        $tt->update([
            'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Статус изменена успешно');
    }

    public function report(Request $request)
    {

        $count = date('t');

        $days = [];

        $mon = date('Y-m-');

        $last = (int)date('m', strtotime($mon . '01'));

        $year = date('Y');
        $minusyear = date('Y', strtotime('-1 year'));

        $a = [
            1 => '11',
            2 => '12',
        ];
        $b = [
            1 => '12'
        ];

        $months = [
            0 => ($last < 3 ? $minusyear : $year) . '-' . ($a[$last] ?? str_pad($last - 2, 2, '0', 0)) . '-',
            1 => ($last < 2 ? $minusyear : $year) . '-' . ($b[$last] ?? str_pad($last - 1, 2, '0', 0)) . '-',
            2 => $mon,
        ];

        if ($request->month) {
            $mon = $request->month;
        }


        for ($i = 1; $i <= $count; $i++) {
            $date = $mon . str_pad($i, 2, '0', STR_PAD_LEFT);
            $dam = (int)(date('w', strtotime($date)));
            $days[] = [
                'day' => $date,
                'style' => ($dam == 0 || $dam == 6) ? "background-color: rgb(0 50 255 / 69%);" : ""
            ];
        }


        $employees = User::select(
            'users.id as id',
            'users.firstname as firstname',
            'users.fio as fio',
            'users.date_entry as date_entry',
            'users.position_id as position_id',
            'users.department_id as department_id',
            'users.number as number',
            'day1_1 as day1_1',
            'day1_2 as day1_2',
            'day2_1 as day2_1',
            'day2_2 as day2_2',
            'day3_1 as day3_1',
            'day3_2 as day3_2',
            'day4_1 as day4_1',
            'day4_2 as day4_2',
            'day5_1 as day5_1',
            'day5_2 as day5_2',
        )
            ->filter($request->only('firstname', 'lastname', 'number', 'fio', 'date_entry', 'department_id', 'position_id', 'status'))
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', 'Employee')
            ->where('model_has_roles.model_type', User::class)
            ->whereNotNull('number');


        $employees = $employees->latest('users.updated_at')->paginate(20);
        $positions = Position::latest()->get()->pluck('name', 'id');
        $departments = Department::latest()->get()->pluck('name', 'id');
        return view('cadre.report', [
            'days' => $days,
            'employees' => $employees,
            'months' => $months,
            'mon' => $mon,
            'positions' => $positions,
            'departments' => $departments,
            'statuses' => [
                1 => 'badge badge-danger',
                -1 => 'badge badge-danger',
                2 => 'badge badge-success',
                -2 => 'badge badge-success',
                3 => 'badge badge-warning',
                -3 => 'badge badge-warning',
            ]
        ]);
    }

    public function month_report(Request $request, $month = null)
    {
        if($month == null){
            $month = date('Y-m', strtotime('-1 month'));
        }
        $users = User::paginate(15);
        return view('cadre.month_report', [
            'users' => $users,
            'month' => $month
        ]);
    }

    public function export(Request $request)
    {
        $count = date('t');
        $days = [];
        $mon = date('Y-m-');
        $last = (int)date('m', strtotime($mon . '01'));
        $year = date('Y');
        $minusyear = date('Y', strtotime('-1 year'));
        $a = [
            1 => '11',
            2 => '12',
        ];
        $b = [
            1 => '12'
        ];
        $months = [
            0 => ($last < 3 ? $minusyear : $year) . '-' . ($a[$last] ?? str_pad($last - 2, 2, '0', 0)) . '-',
            1 => ($last < 2 ? $minusyear : $year) . '-' . ($b[$last] ?? str_pad($last - 1, 2, '0', 0)) . '-',
            2 => $mon,
        ];
        if ($request->month) {
            $mon = $request->month;
        }
        for ($i = 1; $i <= $count; $i++) {
            $date = $mon . str_pad($i, 2, '0', STR_PAD_LEFT);
            $dam = (int)(date('w', strtotime($date)));
            $days[] = [
                'day' => $date,
                'style' => ($dam == 0 || $dam == 6) ? "background-color: rgb(0 50 255 / 69%);" : ""
            ];
        }
        $employees = User::select(
            'users.id as id',
            'users.firstname as firstname',
            'users.fio as fio',
            'users.date_entry as date_entry',
            'users.position_id as position_id',
            'users.department_id as department_id',
            'users.number as number',
            'day1_1 as day1_1',
            'day1_2 as day1_2',
            'day2_1 as day2_1',
            'day2_2 as day2_2',
            'day3_1 as day3_1',
            'day3_2 as day3_2',
            'day4_1 as day4_1',
            'day4_2 as day4_2',
            'day5_1 as day5_1',
            'day5_2 as day5_2',
        )
            ->filter($request->only('firstname', 'lastname', 'number', 'fio', 'date_entry', 'department_id', 'position_id', 'status'))
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', 'Employee')
            ->where('model_has_roles.model_type', User::class)
            ->whereNotNull('number');
        $employees = $employees->latest('users.updated_at')->get();
        $head = [
            'name' => 'Ф.И.О/Должность/цех.отдел',
        ];
        foreach ($days as $d) {
            $head[substr($d['day'], -5)] = substr($d['day'], -5);
        }
        $data = [
            $head,
        ];
        $num = 1;
        foreach ($employees as $employee) {
            $temp = $employee->month_tt($mon);
            $weekly = 0;
            $pos = $employee->position->name ?? '';
            $dep = $employee->department->name ?? '';
            $body = [
                $num => $employee->fio . $pos . $dep
            ];
            $num++;
            foreach ($days as $d) {
                $txt = "";
                if (isset($temp[$d['day']][\App\Models\Tt::$kirish])) {
                    if (!in_array($temp[$d['day']][\App\Models\Tt::$kirish]->info_type * 1, [9, 1, 2, 4])) {
                        $txt .= $temp[$d['day']][\App\Models\Tt::$kirish]->auth_time ?: ' kemagan ';
                    }
                    $txt .= $temp[$d['day']][\App\Models\Tt::$kirish]->info_type_short();
                }
                if (isset($temp[$d['day']][\App\Models\Tt::$chiqish]) and !in_array($temp[$d['day']][\App\Models\Tt::$chiqish]->info_type * 1, [9, 1, 2, 4])) {
                    $txt .= $temp[$d['day']][\App\Models\Tt::$chiqish]->auth_time ?: ' ketmagan ';
                    $txt .= $temp[$d['day']][\App\Models\Tt::$chiqish]->info_type_short();
                }

                $today = date('w', strtotime($d['day']));
                if(isset($temp[$d['day']][\App\Models\Tt::$kirish]) and isset($temp[$d['day']][\App\Models\Tt::$chiqish]) and $temp[$d['day']][\App\Models\Tt::$kirish]->arrival_status != 1 and $temp[$d['day']][\App\Models\Tt::$chiqish]->arrival_status != -1 and !in_array($temp[$d['day']][\App\Models\Tt::$chiqish]->info_type * 1, [9,1,2,4])){
                    $k = "day" . $today . '_2';
                    $ch = "day" . $today . '_1';
                    $t_soat = (int)$employee->$k - (int)$employee->$ch;
                    if($t_soat < 0)
                        $t_soat += 12;
                    $weekly += $t_soat;
                    $weekly += $temp[$d['day']][\App\Models\Tt::$kirish]->difference;
                    $weekly += $temp[$d['day']][\App\Models\Tt::$chiqish]->difference;

                    if($today == 6 or $today == 0){
                        $t = floor(strtotime('1970-01-01 ' . $temp[$d['day']][\App\Models\Tt::$chiqish]->auth_time) / 3600) - ceil(strtotime('1970-01-01 ' . $temp[$d['day']][\App\Models\Tt::$kirish]->auth_time) / 3600);

                        $weekly += $t;
                    }
                }
                if($today == 0){
                    $txt .= $weekly;
                    $weekly = 0;
                }

                $body[] = $txt;
            }
            $data[] = $body;
        }
        return Excel::download(new ReportExport($data), time() . '.xlsx');
    }

    public function weekend(Request $request)
    {
        $start = strtotime($request->start_date ? $request->start_date : date("Y-m-01"));
        $end = strtotime($request->end_date ? $request->end_date : date("Y-m-t"));
        $weekends = [];
        for ($day = $start; $day <= $end; $day = strtotime("+1 day", $day)) {
            if (date("N", $day) == 6 || date("N", $day) == 7) {
                $weekends[] = date("Y-m-d", $day);
            }
        }

        $tts = Tt::whereIn('auth_date', $weekends)->latest();
        if ($request->number) {
            $tts = $tts->where('number', $request->number);
        }
        if ($request->name) {
            $tts = $tts->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->track) {
            $tts = $tts->where('track', $request->track);
        }
        if (isset($request->status)) {
            $tts = $tts->where('status', $request->status);
        }
        if ($request->arrival_status) {
            $tts = $tts->where('arrival_status', $request->arrival_status);
        }
        $tts = $tts->paginate(40);
        return view("cadre.weekend", [
            'tts' => $tts,
        ]);
    }

    public function all(Request $request)
    {
        $tts = Tt::with('user')->latest();
        if ($request->number) {
            $tts = $tts->where('number', $request->number);
        }
        if ($request->name) {
            $tts = $tts->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->track) {
            $tts = $tts->where('track', $request->track);
        }
        if ($request->auth_date) {
            $tts = $tts->where('auth_date', $request->auth_date);
        }
        if ($request->auth_date_from) {
            $tts = $tts->where('auth_date', $request->auth_date_from_type, $request->auth_date_from);
        }
        if ($request->auth_date_to) {
            $tts = $tts->where('auth_date', $request->auth_date_to_type, $request->auth_date_to);
        }
        if ($request->auth_time_from) {
            $tts = $tts->where('auth_time', $request->auth_time_from_type, $request->auth_time_from);
        }
        if ($request->auth_time_to) {
            $tts = $tts->where('auth_time', $request->auth_time_to_type, $request->auth_time_to);
        }
        if ($request->status) {
            $tts = $tts->where('status', $request->status);
        }
        if ($request->arrival_status) {
            $tts = $tts->where('arrival_status', $request->arrival_status);
        }
        if ($request->department_id) {
            $tts = $tts->whereHas('user', function ($query) use ($request) {
                $query->where('department_id', $request->department_id);
            });
        }
        if ($request->department_id) {
            $tts = $tts->whereHas('user', function ($query) use ($request) {
                $query->where('department_id', $request->department_id);
            });
        }
        if ($request->position_id) {
            $tts = $tts->whereHas('user', function ($query) use ($request) {
                $query->where('position_id', $request->position_id);
            });
        }

        $tts = $tts->where('status', 0)->paginate(40);
        $types = [
            '=' => '=',
            '>' => '>',
            '<' => '<',
            '>=' => '>=',
            '<=' => '<=',
        ];
        $positions = Position::latest()->get()->pluck('name', 'id');
        $departments = Department::latest()->get()->pluck('name', 'id');
        return view('cadre.all', [
            'tts' => $tts,
            'types' => $types,
            'positions' => $positions,
            'departments' => $departments,
        ]);
    }

}
