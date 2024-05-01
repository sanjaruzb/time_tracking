@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<h3 class="card-title">Показать </h3>--}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" user="grid" aria-describedby="dataTable_info">
                            <thead>
                                <tr>
                                    <th>Номер</th>
                                    <td>{{ $tt->number }}</td>
                                </tr>
                                <tr>
                                    <th>Ф.И.О</th>
                                    <td>{{ $tt->number }}</td>
                                </tr>
                                <tr>
                                    <th>Дата авторизации</th>
                                    <td>{{ $tt->auth_date }}</td>
                                </tr>
                                <tr>
                                    <th>Время авторизации</th>
                                    <td>{{ $tt->auth_time }}</td>
                                </tr>
                                <tr>
                                    <th>вход/выход</th>
                                    <td>{{ \App\Helpers\TrackHelper::getTrack($tt->track) }}</td>
                                </tr>
                                <tr>
                                    <th>Информация</th>
                                    <td>{{ $tt->info }}</td>
                                </tr>

                                <tr>
                                    <th>Тип информации</th>
                                    <td>{{ \App\Models\Tt::$infoType[$tt->info_type] ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th>Файл</th>
                                    <td>
                                        @foreach($tt->files as $f)
                                            @if($f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'jpeg' or $f->ext == 'jpg' or $f->ext == 'png' or $f->ext == 'gif' or $f->ext == 'bmp' or $f->ext == 'tiff' or $f->ext == 'tif' or $f->ext == 'webp' or $f->ext == 'svg' or $f->ext == 'jfif')
                                                <img src="{{ asset("public/tt_files/".$f->name) }}" height="150px" width="150px" style="margin: 5px">
                                            @elseif($f->ext == 'pdf' or $f->ext == 'pdfa' or $f->ext == 'pdfx' or $f->ext == 'pdfe' or $f->ext == 'pdfua' or $f->ext == 'pdx')

                                            @endif

                                        @endforeach
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
