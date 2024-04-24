@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Показать информация</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <td>{{ $holiday->date }}</td>
                            </tr>

                            <tr>
                                <th>Время</th>
                                <td>{{ $holiday->hour }}</td>
                            </tr>

                            <tr>
                                <th>Тип</th>
                                <td>{{ \App\Helpers\HolidayHelper::getHoliday($holiday->type) }}</td>
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
