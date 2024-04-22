@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Показать oтдел</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <td>{{ $department->name }}</td>
                            </tr>

                            <tr>
                                <th>Код</th>
                                <td>{{ $department->code }}</td>
                            </tr>

                            <tr>
                                <th>Статус</th>
                                <td>{{ \App\Helpers\StatusHelper::getCommonStatus($department->status) }}</td>
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
