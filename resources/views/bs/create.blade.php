@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Создать новую BS</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'bs.store','method'=>'POST']) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="number"><strong>Сотрудник:</strong></label>{!! Form::label('number',"*",['style'=>"color:red"]) !!}
                                    <select class="form-control {{ $errors->has('number') ? 'is-invalid' : ''}}" name="number" required>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->number }}">{{ $employee->fio }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('number'))
                                        <span class="error invalid-feedback">{{ $errors->first('number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="auth_date"><strong>Дата:</strong></label>{!! Form::label('auth_date',"*",['style'=>"color:red"]) !!}
                                    {!! Form::date('auth_date', null, ['autocomplete'=>'OFF','id'=>'auth_date','placeholder' => 'Auth Date','required'=>true,'class' => "form-control ".($errors->has('auth_date') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('auth_date'))
                                        <span class="error invalid-feedback">{{ $errors->first('auth_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="start"><strong>Время начала:</strong></label>{!! Form::label('start',"*",['style'=>"color:red"]) !!}
                                    {!! Form::time('start', null, ['autocomplete'=>'OFF','id'=>'start','placeholder' => 'Start','required'=>true,'class' => "form-control ".($errors->has('start') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('start'))
                                        <span class="error invalid-feedback">{{ $errors->first('start') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="end"><strong>Время окончания:</strong></label>{!! Form::label('end',"*",['style'=>"color:red"]) !!}
                                    {!! Form::time('end', null, ['autocomplete'=>'OFF','id'=>'end','placeholder' => 'end','required'=>true,'class' => "form-control ".($errors->has('end') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('end'))
                                        <span class="error invalid-feedback">{{ $errors->first('end') }}</span>
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
            </div>
        </div>
    </section>
@endsection
