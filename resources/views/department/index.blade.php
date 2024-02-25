@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Отделы</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Department</li>
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
                                        <th>Название</th>
                                        <th>Код</th>
                                        <th>Статус</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($departments as $key=>$department)
                                    <tr>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->code }}</td>
                                        <td>{{ $department->status  }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="12">
                                            {{ $departments->withQueryString()->links()   }}
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
