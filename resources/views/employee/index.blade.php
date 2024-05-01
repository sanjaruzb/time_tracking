@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Управление сотрудник</h3>

                        @can('employee-create')
                            <a href="{{ route('employee.create') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>
                                Создавать
                            </a>
                        @endcan

                        @can('employee-filter')
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#employee_filter" style="margin-right: 5px">
                                <span class="fas fa-filter"></span> Фильтр
                            </button>
                        @endcan
                    </div>
                    <!-- /.card-header -->
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
                        <table id="dataTable"
                               class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg"
                               user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>Ф.И.О</th>
                                <th>Дата</th>
                                <th>Должность</th>
                                <th>цех/отдел</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr style="{{$employee->position ? "" : "background-color: rgb(237 202 31 / 30%);" }}" >
                                    <td>{{ $employee->fio }}</td>
                                    <td>{{ $employee->date_entry }}</td>
                                    <td>
                                        @if(!empty($employee->position))
                                            {{ $employee->position->name  }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($employee->department))
                                            {{ $employee->department->name  }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">

                                            @can('employee-show')
                                                <a class="" href="{{ route('employee.show',$employee->id) }}"
                                                   style="margin-right: 7px">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            @endcan

                                            @can('employee-destroy')
                                                <form action="{{ route("employee.destroy", $employee->id) }}"
                                                      method="POST">
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
                                        {{ $employees->withQueryString()->links()   }}
                                    </td>
                                </tr>
                            </tfooter>
                        </table>

                        <div class="modal fade" id="employee_filter">
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
                                                    <strong>Дата:</strong>
                                                    {!! Form::date('date_entry', request()->get('date_entry'), ['placeholder' => 'Дата','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>цех/отдел:</strong>
                                                    {!! Form::select('department_id', $departments,request()->get('department_id'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Должность:</strong>
                                                    {!! Form::select('position_id', $positions,request()->get('position_id'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Статус:</strong>
                                                    {!! Form::select('status', \App\Helpers\StatusHelper::$commonStatus,request()->get('status'), ['placeholder' => '','maxlength'=> 100,'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрывать
                                        </button>
                                        <button type="submit" class="btn btn-primary">Фильтр</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
