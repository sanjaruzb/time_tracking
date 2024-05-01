@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Действия с данными сотрудников
            </h3>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                <thead>
                <tr>
                    <th>Сотрудник</th>
                    <th>Описания</th>
                    <th>Файл</th>
                    <th>Новое время</th>
                    <th>Вступление в силу</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($hs as $c)
                        <tr>
                            <td>{{$c->user->fio}}<br>{{$c->user->department->name ?? ''}}</td>
                            <td>{{mb_strlen($c->description) > 33 ? mb_substr($c->description,0,30) . ' ...' : $c->description }}</td>
                            <td>file</td>
                            <td>
                                @php($c->shift = json_decode($c->shift))
                                <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                                    <thead>
                                    <tr>
                                        <th>День</th>
                                        <th>Начало</th>
                                        <th>Конец</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Понедельник</td>
                                        <td>{{$c->shift->day1_1}}</td>
                                        <td>{{$c->shift->day1_2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Вторник</td>
                                        <td>{{$c->shift->day2_1}}</td>
                                        <td>{{$c->shift->day2_2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Среда</td>
                                        <td>{{$c->shift->day3_1}}</td>
                                        <td>{{$c->shift->day3_2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Четверг</td>
                                        <td>{{$c->shift->day4_1}}</td>
                                        <td>{{$c->shift->day4_2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Пятница</td>
                                        <td>{{$c->shift->day5_1}}</td>
                                        <td>{{$c->shift->day5_2}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>{{$c->effective_date}}</td>
                            <td>
                                <a href="" class="btn btn-success">Разрешить</a>
                                <a href="" class="btn btn-primary">Отменить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
