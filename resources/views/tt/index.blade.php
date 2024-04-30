@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header" id="kt_profile_details_view">
            <h3 class="card-title">Управление учетом времени</h3>
            @can('tt-create')
                <a href="{{ route('tt.create') }}" class="btn btn-success btn-sm float-right">
                    <span class="fas fa-file-import"></span>
                    Импорт
                </a>
            @endcan

            @can('tt-filter')
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tt_filter" style="margin-right: 5px">
                    <span class="fas fa-filter"></span> Фильтр
                </button>
            @endcan
        </div>
        <div class="card-body mb-12 mb-xl-12" id="kt_profile_details_view" style="margin: 10px; padding: 10px">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <table class="table table-bordered table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Ф.И.О</th>
                        <th>Отдел</th>
                        <th>Дата авторизации</th>
                        <th>Время авторизации</th>
                        <th>вход/выход</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tts as $key => $tt)
                        <tr>
                            <td>{{ $tt->number }}</td>
                            <td>{{ $tt->name }}</td>
                            <td>{{ $tt->department->name ?? "" }}</td>
                            <td>{{ $tt->auth_date }}</td>
                            <td>{{ $tt->auth_time }}</td>
                            <td>{{ \App\Helpers\TrackHelper::getTrack($tt->track) }}</td>
                            <td>
                                <div class="btn-group">
                                    @can('tt-show')
                                        <a class="" style="margin-right: 10px" href="{{ route('tt.show',$tt->id) }}">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                    @endcan

                                    @can('tt-destroy')
                                        <form action="{{ route("tt.destroy", $tt->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button" style='display:inline; border:none; background: none' onclick="if (confirm('Вы уверены?')) { this.form.submit() } "><span class="fa fa-trash"></span></button>
                                        </form>
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

            <div class="modal fade" id="tt_filter">
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
                                        <strong>Отдел:</strong>
                                        {!! Form::text('department', request()->get('department'), ['placeholder' => 'Номер отдела','maxlength'=> 100,'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Дата авторизации:</strong>
                                        {!! Form::date('auth_date', request()->get('auth_date'), ['placeholder' => 'Дата авторизации','maxlength'=> 100,'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Время авторизации:</strong>
                                        {!! Form::time('auth_time', request()->get('auth_time'), ['placeholder' => 'Время авторизации','maxlength'=> 100,'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>вход/выход:</strong>
                                        {!! Form::select('track', \App\Helpers\TrackHelper::$tracks,request()->get('auth_time'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
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
                </div>
            </div>
        </div>
    </div>

@endsection
