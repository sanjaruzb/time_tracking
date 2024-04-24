@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Изменить информация</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($holiday, ['method' => 'PATCH','route' => ['holiday.update', $holiday->id]]) !!}
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="date"><strong>Дата:</strong></label>{!! Form::label('date',"*",['style'=>"color:red"]) !!}
                                    {!! Form::date('date', null, ['autocomplete'=>'OFF','id'=>'date','placeholder' => 'Дата','required'=>true,'class' => "form-control ".($errors->has('date') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('date'))
                                        <span class="error invalid-feedback">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="hour"><strong>Время:</strong></label>{!! Form::label('hour',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('hour', null, ['autocomplete'=>'OFF','id'=>'hour','placeholder' => 'Время','required'=>true,'class' => "form-control ".($errors->has('hour') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('hour'))
                                        <span class="error invalid-feedback">{{ $errors->first('hour') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="type"><strong>Тип:</strong></label>{!! Form::label('type',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('type', \App\Helpers\HolidayHelper::$holidays,$holiday->type, ['autocomplete'=>'OFF','id'=>'type','required'=>true,'class' => "form-control ".($errors->has('type') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('type'))
                                        <span class="error invalid-feedback">{{ $errors->first('type') }}</span>
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
            </div>
        </div>
    </section>
@endsection
