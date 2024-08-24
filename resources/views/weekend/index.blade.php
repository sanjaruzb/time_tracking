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
                    <th>Статус</th>
                    <th>Файлы</th>
                    <th>Коммент</th>
                    <th>Начало</th>
                    <th>Конец</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($ws as $w)
                        <tr>
                            <td>{{ $w->user->fio ?? "" }}<br>{{$w->user->department->name ?? ''}}</td>
                            <td><b class="badge bg-warning">{{$w->status_name()}}</b></td>
                            <td>
                                @foreach($w->files as $f)
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
                            <td>{{mb_strlen($w->description) > 33 ? mb_substr($w->description,0,30) . ' ...' : $w->description }}</td>
                            <td>{{ $w->come }} {{ date("H:i", strtotime($w->come_time)) }}</td>
                            <td>{{ $w->left }} {{ date("H:i", strtotime($w->left_time)) }}</td>
                            <td>
                                @can('weekend-allow')
                                    <a href="{{ route("weekend.allow",$w->id) }}" class="btn btn-success">Разрешить</a>
                                @endcan

                                @can('weekend-cancel')
                                    <a href="{{ route("weekend.cancel",$w->id) }}" class="btn btn-primary">Отменить</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
