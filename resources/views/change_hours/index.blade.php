@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Действия с данными сотрудников
            </h3>
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
            <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                <thead>
                <tr>
                    <th>Сотрудник</th>
                    <th>Описания</th>
                    <th class="">Файл</th>
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
                            <td>
                                @foreach($c->files as $f)
                                    @if($f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'png' or $f->ext == 'gif' or $f->ext == 'bmp' or $f->ext == 'tiff' or $f->ext == 'tif' or $f->ext == 'webp' or $f->ext == 'svg' or $f->ext == 'jfif')
                                        @if(file_exists(public_path("employee_files/".$f->name)))
                                            <img src="{{ asset("public/employee_files/".$f->name) }}" height="150px" width="150px" style="margin: 5px">
                                            <br>
                                            <a href="{{ route("employee.download-file",$f->name) }}">Скачать</a>
                                        @endif
                                    @elseif($f->ext == 'pdf' or $f->ext == 'pdfa' or $f->ext == 'pdfx' or $f->ext == 'pdfe' or $f->ext == 'pdfua' or $f->ext == 'pdx')
                                        @if(file_exists(public_path("employee_files/".$f->name)))
                                            <object data="{{ asset("public/employee_files/".$f->name) }}" type="application/pdf" width="150px" height="150px">
                                            </object> <br>
                                            <a href="{{ asset("public/employee_files/".$f->name) }}" target="_blank">Показывать</a>
                                            <a href="{{ route("employee.download-file",$f->name) }}">Скачать</a>
                                        @endif
                                    @endif
                                @endforeach
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
                            <td>{{$c->effective_date}}</td>
                            <td>
                                <a href="{{ route("change_hours.allow",$c->id) }}" class="btn btn-success">Разрешить</a>
                                <a href="{{ route("change_hours.cancel",$c->id) }}" class="btn btn-primary">Отменить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
