@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Управление ролями</h3>
                        @can('role-create')
                            @can('role-create')
                                <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm float-right">
                                    <span class="fas fa-plus-circle"></span>
                                    Создавать
                                </a>
                            @endcan

                            @can('role-filter')
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#role_filter" style="margin-right: 5px">
                                    <span class="fas fa-filter"></span> Фильтр
                                </button>
                            @endcan
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
                        <!-- Data table -->
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" role="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Разрешения</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }} </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('role-show')
                                                <a class="" href="{{ route('roles.show',$role->id) }}"
                                                   style="margin-right: 7px">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            @endcan

                                            @can('role-edit')
                                                <a class="" href="{{ route('roles.edit',$role->id) }}"
                                                   style="margin-right: 2px">
                                                    <span class="fa fa-edit" style="color: #562bb0"></span>
                                                </a>
                                            @endcan

                                            @can('role-destroy')
                                                <form action="{{ route("roles.destroy", $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="button"
                                                            style='display:inline; border:none; background: none'
                                                            onclick="if (confirm('Вы уверены?')) { this.form.submit() } "><span
                                                            class="fa fa-trash"></span></button>
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
                                        {{ $roles->withQueryString()->links() }}
                                    </td>
                                </tr>
                            </tfooter>
                        </table>

                        <div class="modal fade" id="role_filter">
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
                                                    <strong>Название:</strong>
                                                    {!! Form::text('name', request()->get('name'), ['placeholder' => 'Название','maxlength'=> 100,'class' => 'form-control']) !!}
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
