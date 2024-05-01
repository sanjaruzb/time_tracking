@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Изменить рабочее время Индивидуально
            </h3>
            <br>
            <b>
                {{$user->fio}}
            </b>
        </div>
        <div class="card-body">
            {!! Form::model($user, ['method' => 'POST','route' => ['employee.chane-individual-submit']]) !!}
            <div class="row">
                <input type="hidden" name="id" value="{{$user->id}}">

                <div class="col-12">
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
                            <td><input type="text" name="template[day1_1]" value="{{$user->day1_1}}" class="form-control"></td>
                            <td><input type="text" name="template[day1_2]" value="{{$user->day1_2}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Вторник</td>
                            <td><input type="text" name="template[day2_1]" value="{{$user->day2_1}}" class="form-control"></td>
                            <td><input type="text" name="template[day2_2]" value="{{$user->day2_2}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Среда</td>
                            <td><input type="text" name="template[day3_1]" value="{{$user->day3_1}}" class="form-control"></td>
                            <td><input type="text" name="template[day3_2]" value="{{$user->day3_2}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Четверг</td>
                            <td><input type="text" name="template[day4_1]" value="{{$user->day4_1}}" class="form-control"></td>
                            <td><input type="text" name="template[day4_2]" value="{{$user->day4_2}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Пятница</td>
                            <td><input type="text" name="template[day5_1]" value="{{$user->day5_1}}" class="form-control"></td>
                            <td><input type="text" name="template[day5_2]" value="{{$user->day5_2}}" class="form-control"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Файл (Основа для изменение рабочего времени)</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            @if($errors->has('file'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputFile">Дата вступления в силу</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <input type="text" class="form-control" name="effective_date" placeholder="YYYY-MM-DD">
                            @if($errors->has('effective_date'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('effective_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="info"><strong>Дополнительная информация:</strong></label>
                        <textarea rows="5" autocomplete="OFF" id="info" placeholder="Текст" class="form-control " name="info" cols="50">{{old('info') ? old('info') : ''}}</textarea>
                        @if($errors->has('info'))
                            <span class="error invalid-feedback" style="display: block">{{ $errors->first('info') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Редактировать</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
