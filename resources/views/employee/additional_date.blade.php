@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Дополнительная работа
            </h3>
            <br>
            <b>
                {{$user->fio}}
            </b>
        </div>
        <div class="card-body">
            {!! Form::model($user, ['method' => 'POST','route' => ['employee.additional-date-submit'], 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <input type="hidden" name="id" value="{{$user->id}}">

                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputFile">Файл</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file[]" multiple="multiple" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                            @if($errors->has('file'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <label for="come_date">День прибытия</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <input type="date" class="form-control" name="come_date" placeholder="YYYY-MM-DD">
                            @if($errors->has('come_date'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('come_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <label for="come_time">Время прибытия</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <input type="time" class="form-control" name="come_time" placeholder="YYYY-MM-DD">
                            @if($errors->has('come_time'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('come_time') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <label for="left_date">День отъезда</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <input type="date" class="form-control" name="left_date" placeholder="YYYY-MM-DD">
                            @if($errors->has('left_date'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('left_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <label for="left_time">Время отъезда</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}
                        <div class="input-group">
                            <input type="time" class="form-control" name="left_time" placeholder="YYYY-MM-DD">
                            @if($errors->has('left_time'))
                                <span class="error invalid-feedback" style="display: block">{{ $errors->first('left_time') }}</span>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12">
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
                    <button type="submit" class="btn btn-primary form-control">Сохранять</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
