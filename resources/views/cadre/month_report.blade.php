@extends('layouts.admin')

@section('content')
@php
    /**
     * @param $u \App\Models\User
     * @param $month string
     */
@endphp
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Управление кадрами</h3>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>Опоздании [без причины]</th>
                                <th>Отсутствие [без причины]</th>
                                <th>Опоздании [причины]</th>
                                <th>Отсутствие [причины]</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $u)
                                <tr>
                                    <td>1</td>
                                    <td>{{$u->firstname}} {{$u->lastname}}</td>
                                    <td>{{$u->sababsiz_kechikishlar($month)}}</td>
                                    <td>{{$u->sababsiz_kemaslik($month)}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $users->withQueryString()->links()   }}
                                    </td>
                                </tr>
                            </tfooter>
                        </table>
                        <div class="modal fade" id="users_filter">
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
                                                    <strong>Номер:</strong>
                                                    {!! Form::text('number', request()->get('number'), ['placeholder' => 'Номер','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Ф.И.О:</strong>
                                                    {!! Form::text('name', request()->get('name'), ['placeholder' => 'Ф.И.О','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Статус:</strong>
                                                    {!! Form::select('status', \App\Models\Tt::$statuses,request()->get('status'), ['placeholder' => '','class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Статус прибытия:</strong>
                                                    {!! Form::select('arrival_status', \App\Models\Tt::$arrival_statuses,request()->get('status'), ['placeholder' => '','class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>вход/выход:</strong>
                                                    {!! Form::select('track', \App\Helpers\TrackHelper::$tracks,request()->get('track'), ['placeholder' => '','class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>цех/отдел:</strong>
                                                    {!! Form::select('department_id', $departments, request()->get('department_id'), ['placeholder' => '','class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Должность:</strong>
                                                    {!! Form::select('position_id', $positions, request()->get('position_id'), ['placeholder' => '','class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрывать</button>
                                        <button type="submit" class="btn btn-primary">Фильтр</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
