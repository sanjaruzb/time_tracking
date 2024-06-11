@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Показать BS</h3>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Сотрудник</th>
                                <td>{{ $bs->employee->fio ?? '' }}</td>
                            </tr>

                            <tr>
                                <th>Дата</th>
                                <td>{{ $bs->auth_date }}</td>
                            </tr>

                            <tr>
                                <th>Время начала</th>
                                <td>{{ date("H:i", strtotime($bs->start)) }}</td>
                            </tr>

                            <tr>
                                <th>Время окончания</th>
                                <td>{{ date("H:i", strtotime($bs->end)) }}</td>
                            </tr>

                            <tr>
                                <th>Разница</th>
                                <td>{{ $bs->hour }}</td>
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
