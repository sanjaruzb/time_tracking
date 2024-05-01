@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Изменить рабочее время по шаблону
            </h3>
            <br>
            <b>
                {{$user->fio}}
            </b>
        </div>
        <div class="card-body">
            {!! Form::model($user, ['method' => 'POST','route' => ['employee.chane-template-submit']]) !!}
            <div class="row">
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="fio"><strong>Рабочая смена (шаблон):</strong></label>
                        <select name="template" class="form-control" id="">
                            <option value="0" {{old('template') == 0 ? 'selected' : ''}}>Первая смена</option>
                            <option value="1" {{old('template') == 1 ? 'selected' : ''}}>Вторая смена</option>
                            <option value="2" {{old('template') == 2 ? 'selected' : ''}}>Ночная смена</option>
                        </select>
                        @if($errors->has('template'))
                            <span class="error invalid-feedback" style="display: block">{{ $errors->first('template') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-4">
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

                <div class="col-xs-4 col-sm-4 col-md-4">
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
                    <button type="submit" class="btn btn-primary form-control">Редактировать</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
