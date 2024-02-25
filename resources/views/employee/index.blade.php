@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Сотрудник</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Сотрудник</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (\Session::has('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{!! \Session::get('error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>Ф.И.О</th>
                                    <th>Дата</th>
                                    <th>Должность</th>
                                    <th>цех/отдел</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($employees as $key=>$employee)
                                    <tr>
                                        <td>{{ $employee->fio }}</td>
                                        <td>{{ $employee->date_entry }}</td>
                                        <td>@if(!empty($employee->position)) {{ $employee->position->name  }} @endif</td>
                                        <td>@if(!empty($employee->department)) {{ $employee->department->name  }} @endif</td>
                                        <td>
                                            <a class="" style="margin-right: 10px" href="{{ route('employee.show',$employee->id) }}">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
