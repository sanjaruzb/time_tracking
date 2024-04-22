@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Показать пользователя</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <td>{{ $user->firstname }}</td>
                            </tr>
                            <tr>
                                <th>Фамилия</th>
                                <td>{{ $user->lastname }}</td>
                            </tr>
                            <tr>
                                <th>Почта</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Роль</th>
                                <td>
                                    @foreach($user->roles()->pluck('name') as $role)
                                        <span class="badge badge-primary">{{ $role }} </span>
                                    @endforeach
                                </td>
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
