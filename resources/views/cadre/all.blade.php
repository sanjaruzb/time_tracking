@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Управление кадрами</h3>

                        @can('cadre-filter')
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#users_filter" style="margin-right: 5px">
                                <span class="fas fa-filter"></span> Фильтр
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Номер</th>
                                <th>Ф.И.О</th>
                                <th>Статус прибытия</th>
                                <th>Дата авторизации</th>
                                <th>Время авторизации</th>
                                <th>вход/выход</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tts as $key => $tt)
                                <tr >
                                    <td>{{ $tt->number }}</td>
                                    <td>{{ $tt->name }}</td>
                                    <td>
                                        <small class="badge
                                        <?php
                                            if ($tt->arrival_status == 1 or $tt->arrival_status == -1) echo "badge-danger";
                                            if ($tt->arrival_status == 2 or $tt->arrival_status == -2) echo "badge-success";
                                            if ($tt->arrival_status == 3 or $tt->arrival_status == -3) echo "badge-warning";
                                        ?>">
                                            <i class="far fa-clock"></i>
                                            {{ $tt->arrival_status_name() }}
                                        </small>
                                        <small role="button" data-toggle="tooltip" data-placement="top" title="{{$tt->info}}" class="badge badge-dark" >{{ $tt->info_type_short()}}</small>
                                    </td>
                                    <td>{{ $tt->auth_date }}</td>
                                    <td>{{ $tt->auth_time }}</td>
                                    <td>{{ \App\Helpers\TrackHelper::getTrack($tt->track) }}</td>
                                    <td>
                                        {{ \App\Models\Tt::$statuses[$tt->status] }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('cadre-changeStatus')
                                                <a class="" onclick="if (confirm('Вы уверены?')) { this.form.submit() }" style="margin-right: 10px" href="{{ route('ttChangeStatus',[$tt->id,3]) }}">
                                                    <span class="fa fa-check" style="color: #00a379"></span>
                                                </a>
                                            @endcan

                                            @can('cadre-changeStatus')
                                                <a class="" onclick="if (confirm('Вы уверены?')) { this.form.submit() } " style="margin-right: 10px" href="{{ route('ttChangeStatus',[$tt->id,2]) }}">
                                                    ❌
                                                </a>
                                            @endcan

                                            @can('cadre-show')
                                                <a class="" style="margin-right: 10px" href="{{ route('cadre.show',$tt->id) }}">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            @endcan

                                            @can('cadre-edit')
                                                <a class="" href="{{ route('cadre.edit',$tt->id) }}"
                                                   style="margin-right: 2px">
                                                    <span class="fa fa-edit" style="color: #562bb0"></span>
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $tts->withQueryString()->links()   }}
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
                                                    <strong>Дата авторизации:</strong>
                                                    {!! Form::date('auth_date', request()->get('auth_date'), ['placeholder' => 'Ф.И.О','maxlength'=> 100,'class' => 'form-control']) !!}
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
