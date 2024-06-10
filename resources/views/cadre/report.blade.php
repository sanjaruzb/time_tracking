@extends('layouts.admin')

@section('content')
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header no-print">
                        <h3 class="card-title">Отчет</h3>

                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                data-target="#employee_filter" style="margin-right: 5px">
                            <span class="fas fa-filter"></span> Фильтр
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow: auto;">
                    <!-- Data table -->
                        <table id="dataTable"
                               class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg"
                               user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>
                                    Ф.И.О
                                    <br>
                                    Должность
                                    <br>
                                    цех/отдел
                                </th>
                                @foreach($days as $d)
                                    <th style="{{$d['style']}}">{{substr($d['day'], -5)}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                @php
                                    $temp = $employee->month_tt($mon);
                                    $weekly = 0;
                                @endphp
                                <tr>
                                    <td style="{{$employee->position ? "" : "background-color: rgb(237 202 31 / 30%);" }}">
                                        {{ $employee->fio }}
                                        @if(!empty($employee->position))
                                            <br>{{ $employee->position->name  }}
                                        @endif
                                        @if(!empty($employee->department))
                                            <br>{{ $employee->department->name  }}
                                        @endif
                                    </td>
                                    @foreach($days as $d)
                                        <td style="line-height: 1px;">
                                            @if(isset($temp[$d['day']][\App\Models\Tt::$kirish]))
                                                @if(!in_array($temp[$d['day']][\App\Models\Tt::$kirish]->info_type * 1, [9,1,2,4]))
                                                    <small class="{{$statuses[$temp[$d['day']][\App\Models\Tt::$kirish]->arrival_status] ?? ''}}">{{ $temp[$d['day']][\App\Models\Tt::$kirish]->auth_time ?: 'kemagan'}}</small>
                                                @endif
                                                <a href="/cadre/{{$temp[$d['day']][\App\Models\Tt::$kirish]->id}}" data-toggle="tooltip" data-placement="top" title="{{$temp[$d['day']][\App\Models\Tt::$kirish]->info}}" class="badge badge-dark" >{{ $temp[$d['day']][\App\Models\Tt::$kirish]->info_type_short()}}</a>
                                            @endif
                                            <br>
                                            @if(isset($temp[$d['day']][\App\Models\Tt::$chiqish]) and !in_array($temp[$d['day']][\App\Models\Tt::$chiqish]->info_type * 1, [9,1,2,4]))
                                                <small class="{{$statuses[$temp[$d['day']][\App\Models\Tt::$chiqish]->arrival_status] ?? ''}}">{{ $temp[$d['day']][\App\Models\Tt::$chiqish]->auth_time ?: 'ketmagan' }}</small>
                                                <a href="/cadre/{{$temp[$d['day']][\App\Models\Tt::$chiqish]->id}}" data-toggle="tooltip" data-placement="top" title="{{$temp[$d['day']][\App\Models\Tt::$chiqish]->info}}" class="badge badge-dark" >{{ $temp[$d['day']][\App\Models\Tt::$chiqish]->info_type_short()}}</a>
                                            @endif
                                            @php
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
                                            @endphp
                                            @php
                                                if($today == 0){
                                                    echo '<small class="badge bg-primary"><i class="far fa-clock"></i>' . $weekly . '<small>';
                                                    $weekly = 0;
                                                }
                                            @endphp
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $employees->withQueryString()->links()   }}
                                    </td>
                                </tr>
                            </tfooter>
                        </table>

                        <div class="modal fade" id="employee_filter">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Фильтр</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {!! Form::open(['method'=>'GET']) !!}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>Имя:</strong>
                                                    {!! Form::text('firstname', request()->get('firstname'), ['placeholder' => 'Имя','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <strong>Фамилия:</strong>
                                                    {!! Form::text('lastname', request()->get('lastname'), ['placeholder' => 'Фамилия','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Номер:</strong>
                                                    {!! Form::text('number', request()->get('number'), ['placeholder' => 'Номер','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Должность:</strong>
                                                    {!! Form::select('position_id', $positions,request()->get('position_id'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>цех/отдел:</strong>
                                                    {!! Form::select('department_id', $departments,request()->get('department_id'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Мясец</strong>
                                                    @php($arr = [
                                                      '01'=>'январь',
                                                      '02'=>'февраль',
                                                      '03'=>'март',
                                                      '04'=>'апрель',
                                                      '05'=>'май',
                                                      '06'=>'июнь',
                                                      '07'=>'июль',
                                                      '08'=>'август',
                                                      '09'=>'сентябрь',
                                                      '10'=>'октябрь',
                                                      '11'=>'ноябрь',
                                                      '12'=>'декабрь'
                                                    ])
                                                    <select maxlength="100" class="form-control" name="month">
                                                        @foreach($months as $m)
                                                            <option value="{{$m}}" {{$m == $mon ? 'selected' : ''}}>{{$arr[substr($m, 5,2)]}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрывать
                                        </button>
                                        <button type="submit" class="btn btn-primary">Фильтр</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
