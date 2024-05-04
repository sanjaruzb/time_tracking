@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Действия с данными сотрудников
            </h3>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <tbody>
                            <tr>
                                <th>Системный Идентификатор</th>
                                <td>{{$user->id}}</td>
                            </tr>
                            <tr>
                                <th>Уникальный номер</th>
                                <td>{{$user->number}}</td>
                            </tr>
                            <tr>
                                <th>Ф.И.О</th>
                                <td>{{$user->fio}}</td>
                            </tr>
                            <tr>
                                <th>Дата вступления в должность</th>
                                <td>{{$user->date_entry}}</td>
                            </tr>

                            <tr>
                                <th>Должность</th>
                                <td>{{$user->position->name??''}}</td>
                            </tr>

                            <tr>
                                <th>цех/отдел</th>
                                <td>{{$user->department->name??''}}</td>
                            </tr>

                            <tr>
                                <th>Образование</th>
                                <td>{{$user->education}}</td>
                            </tr>

                            <tr>
                                <th>Год окончания учебного заведения</th>
                                <td>{{$user->graduation_year}}</td>
                            </tr>

                            <tr>
                                <th>Название оконченного учебного заведения</th>
                                <td>{{$user->education_name}}</td>
                            </tr>

                            <tr>
                                <th>Специаль-ность по диплому</th>
                                <td>{{$user->specialist}}</td>
                            </tr>

                            <tr>
                                <th>Дата рождения</th>
                                <td>{{$user->birthdate}}</td>
                            </tr>

                            <tr>
                                <th>Место рождения</th>
                                <td>{{$user->birth_place}}</td>
                            </tr>
                            <tr>
                                <th>Пол</th>
                                <td>{{$user->gender_text()}}</td>
                            </tr>

                            <tr>
                                <th>Нацио-наль-ность</th>
                                <td>{{$user->nationality}}</td>
                            </tr>

                            <tr>
                                <th>Гражданство</th>
                                <td>{{$user->citizenship}}</td>
                            </tr>

                            <tr>
                                <th>Семейное положение</th>
                                <td>{{$user->family_status}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
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
                                <td>{{$user->day1_1}}</td>
                                <td>{{$user->day1_2}}</td>
                            </tr>
                            <tr>
                                <td>Вторник</td>
                                <td>{{$user->day2_1}}</td>
                                <td>{{$user->day2_2}}</td>
                            </tr>
                            <tr>
                                <td>Среда</td>
                                <td>{{$user->day3_1}}</td>
                                <td>{{$user->day3_2}}</td>
                            </tr>
                            <tr>
                                <td>Четверг</td>
                                <td>{{$user->day4_1}}</td>
                                <td>{{$user->day4_2}}</td>
                            </tr>
                            <tr>
                                <td>Пятница</td>
                                <td>{{$user->day5_1}}</td>
                                <td>{{$user->day5_2}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <br>
                        @canany(['employee-change-template','employee-edit'])
                            <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                                <thead>
                                <tr>
                                    <th>Называния действие</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @can('employee-change-template')
                                    <tr>
                                        <td>Изменить рабочее время по шаблону</td>
                                        <td>
                                            <a href="/employee/chane-template/{{$user->id}}" class="btn btn-primary">action</a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>Изменить рабочее время индувидуально</td>
                                        <td>
                                            <a href="/employee/chane-individual/{{$user->id}}" class="btn btn-primary">action</a>
                                        </td>
                                    </tr>
                                @endcan
                                @can('employee-edit')
                                    <tr>

                                        <td>Изменить данные сотрудника</td>
                                        <td>
                                            <a href="{{ route('employee.edit',$user->id) }}" class="btn btn-primary">action</a>
                                        </td>
                                    </tr>
                                @endcan
                                </tbody>
                            </table>
                        @endcanany

                        <br>
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th colspan="4">История изменении рабочего времени</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($user->change_hours as $c)
                                    <tr>
                                        <td>
                                            <b class="badge bg-warning">{{$c->status_name()}}</b>
                                            <br>
                                            {{mb_strlen($c->description) > 33 ? mb_substr($c->description,0,30) . ' ...' : $c->description }}
                                        </td>
                                        <td>
                                            file<br>
                                            @foreach($c->files as $f)
                                                @if($f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'png' or $f->ext == 'gif' or $f->ext == 'bmp' or $f->ext == 'tiff' or $f->ext == 'tif' or $f->ext == 'webp' or $f->ext == 'svg' or $f->ext == 'jfif')
                                                    <img src="{{ asset("public/employee_files/".$f->name) }}" height="150px" width="150px" style="margin: 5px">
                                                    <a href="{{ route("employee.download-file",$f->name) }}">Скачать</a>
                                                @elseif($f->ext == 'pdf' or $f->ext == 'pdfa' or $f->ext == 'pdfx' or $f->ext == 'pdfe' or $f->ext == 'pdfua' or $f->ext == 'pdx')
                                                    <object data="{{ asset("public/employee_files/".$f->name) }}" type="application/pdf" width="150px" height="150px">
                                                    </object>
                                                    <a href="{{ asset("public/employee_files/".$f->name) }}" target="_blank">Показывать</a>
                                                    <a href="{{ route("employee.download-file",$f->name) }}">Скачать</a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{substr($c->created_at, 0, 10)}}
                                            <br>
                                            {{$c->effective_date}}
                                        </td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
