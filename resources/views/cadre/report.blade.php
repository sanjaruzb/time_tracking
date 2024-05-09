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
                                    <th style="writing-mode: vertical-lr; text-orientation: revert; {{$d['style']}}">{{$d['day']}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
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
                                    @php($temp = $employee->month_tt($mon))
                                    @php($statuses = [
                                        1 => 'badge badge-danger',
                                        -1 => 'badge badge-danger',
                                        2 => 'badge badge-success',
                                        -2 => 'badge badge-success',
                                        3 => 'badge badge-warning',
                                        -3 => 'badge badge-warning',
                                    ])
                                    @foreach($days as $d)
                                        <td style="writing-mode: vertical-lr; text-orientation: revert; {{$d['style']}}">
                                            @if(isset($temp[$d['day']][\App\Models\Tt::$kirish]))
                                            <small class="{{$statuses[$temp[$d['day']][\App\Models\Tt::$kirish]->arrival_status]}}"><i class="far fa-clock"></i>{{ $temp[$d['day']][\App\Models\Tt::$kirish]->auth_time ?: 'kemagan'}}</small>
                                            @endif
                                            <br>
                                            @if(isset($temp[$d['day']][\App\Models\Tt::$chiqish]))
                                                <small class="{{$statuses[$temp[$d['day']][\App\Models\Tt::$chiqish]->arrival_status]}}"><i class="far fa-clock"></i>{{ $temp[$d['day']][\App\Models\Tt::$chiqish]->auth_time ?: 'ketmagan' }}</small>
                                            @endif
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

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Ф.И.О:</strong>
                                                    {!! Form::text('fio', request()->get('fio'), ['placeholder' => 'Ф.И.О','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Дата:</strong>
                                                    {!! Form::date('date_entry', request()->get('date_entry'), ['placeholder' => 'Дата','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Статус:</strong>
                                                    {!! Form::select('status', \App\Helpers\StatusHelper::$commonStatus,request()->get('status'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
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
