@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<h3 class="card-title">Показать должность</h3>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                                <tr>
                                    <th>Номер</th>
                                    <td>{{ $tt->number }}</td>
                                </tr>
                                <tr>
                                    <th>Ф.И.О</th>
                                    <td>{{ $tt->number }}</td>
                                </tr>
                                <tr>
                                    <th>Дата авторизации</th>
                                    <td>{{ $tt->auth_date }}</td>
                                </tr>
                                <tr>
                                    <th>Время авторизации</th>
                                    <td>{{ $tt->auth_time }}</td>
                                </tr>
                                <tr>
                                    <th>вход/выход</th>
                                    <td>{{ \App\Helpers\TrackHelper::getTrack($tt->track) }}</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
