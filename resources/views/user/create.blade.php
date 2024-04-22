@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Создать нового пользователя</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'user.store','method'=>'POST']) !!}
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="firstname"><strong>Имя:</strong></label>{!! Form::label('firstname',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('firstname', null, ['autocomplete'=>'OFF','id'=>'firstname','placeholder' => 'Имя','required'=>true,'class' => "form-control ".($errors->has('firstname') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('firstname'))
                                        <span class="error invalid-feedback">{{ $errors->first('firstname') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="lastname"><strong>Фамилия:</strong></label>{!! Form::label('lastname',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('lastname', null, ['autocomplete'=>'OFF','id'=>'lastname','placeholder' => 'Фамилия','required'=>true,'class' => 'form-control '.($errors->has('lastname') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('lastname'))
                                        <span class="error invalid-feedback">{{ $errors->first('lastname') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="email"><strong>Почта:</strong></label>{!! Form::label('email',"*",['style'=>"color:red"]) !!}
                                    {!! Form::email('email', null, ['autocomplete'=>'OFF','id'=>'email','placeholder' => 'Почта','required'=>true,'class' => 'form-control '.($errors->has('email') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('email'))
                                        <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="password"><strong>Пароль:</strong></label>{!! Form::label('password',"*",['style'=>"color:red"]) !!}
                                    {!! Form::password('password', ['autocomplete'=>'OFF','id'=>'password','placeholder' => 'Пароль','required'=>true,'class' => 'form-control '.($errors->has('password') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('password'))
                                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="password_confirmation"><strong>Подтвердите пароль</strong></label>{!! Form::label('password_confirmation',"*",['style'=>"color:red"]) !!}
                                    {!! Form::password('password_confirmation', ['autocomplete'=>'OFF','id'=>'password_confirmation','placeholder' => 'Подтвердите пароль','required'=>true,'class' => 'form-control '.($errors->has('confirm-password') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('password_confirmation'))
                                        <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="role"><strong>Роль:</strong></label>{!! Form::label('role',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('roles[]', $roles,[], ['id'=>'role', 'multiple','required'=>true, 'class' => 'form-control '.($errors->has('roles') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('roles'))
                                        <span class="error invalid-feedback">{{ $errors->first('roles') }}</span>
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
