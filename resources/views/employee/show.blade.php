@extends('layouts.admin')
@section('content')
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Ф.И.О</th>
                                    <td>{!! $user->fio !!}</td>
                                </tr>

                                <tr>
                                    <th>Дата вступления в должность</th>
                                    <td>{!! $user->date_entry !!}</td>
                                </tr>

                                <tr>
                                    <th>Должность</th>
                                    <td>@if(!empty($user->position)) {{ $user->position->name  }} @endif</td>
                                </tr>

                                <tr>
                                    <th>цех/отдел</th>
                                    <td>@if(!empty($user->department)) {{ $user->department->name  }} @endif</td>
                                </tr>

                                <tr>
                                    <th>Образование</th>
                                    <td>{{ $user->education }}</td>
                                </tr>

                                <tr>
                                    <th>Год окончания учебного заведения</th>
                                    <td>{{ $user->graduation_year }}</td>
                                </tr>

                                <tr>
                                    <th>Название оконченного учебного заведения</th>
                                    <td>{{ $user->education_name }}</td>
                                </tr>

                                <tr>
                                    <th>Специаль-ность по диплому</th>
                                    <td>{{ $user->specialist }}</td>
                                </tr>

                                <tr>
                                    <th>Дата рождения</th>
                                    <td>{{ $user->birtdate }}</td>
                                </tr>

                                <tr>
                                    <th>Место рождения</th>
                                    <td>{{ $user->birth_place }}</td>
                                </tr>
                                <tr>
                                    <th>Пол</th>
                                    <td>{{ $user->gender }}</td>
                                </tr>

                                <tr>
                                    <th>Нацио-наль-ность</th>
                                    <td>{{ $user->nationality }}</td>
                                </tr>

                                <tr>
                                    <th>Гражданство</th>
                                    <td>{{ $user->citizenship }}</td>
                                </tr>

                                <tr>
                                    <th>Семейное положение</th>
                                    <td>{{ $user->family_status }}</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
