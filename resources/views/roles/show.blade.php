@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Показать роль</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <th>Разрешения</th>
                                <td>
                                    @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            {{ $v->info }}@if(!$loop->last),@endif
                                        @endforeach
                                    @endif
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
