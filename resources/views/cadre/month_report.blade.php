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

                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                data-target="#users_filter" style="margin-right: 5px">
                            <span class="fas fa-filter"></span> Фильтр
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Статус</th>
                                {{--<th>Опоздании [без причины]</th>
                                <th>Отсутствие [без причины]</th>
                                <th>Опоздании [причины]</th>
                                <th>Отсутствие [причины]</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['fio'] ?? "" }} </td>
                                    <td>
                                        <ul>
                                            @foreach($user['status_count'] as $status => $count)
                                                <li>{{ \App\Models\Tt::$arrival_statuses[$status] ?? "" }} - {{ $count }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="12">
                                        {{ $users->withQueryString()->links() }}
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
                                                    <strong>Ф.И.О:</strong>
                                                    {!! Form::text('fio', request()->get('fio'), ['placeholder' => 'Ф.И.О','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Месяц:(2024-10)</strong>
                                                    {!! Form::text('month', request()->get('month'), ['placeholder' => '2024-10','maxlength'=> 100,'class' => 'form-control']) !!}
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
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
