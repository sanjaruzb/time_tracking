@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Создать новую сотрудник</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'employee.store','method'=>'POST']) !!}
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="fio"><strong>Ф.И.О:</strong></label>{!! Form::label('fio',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('fio', null, ['autocomplete'=>'OFF','id'=>'fio','placeholder' => 'Ф.И.О','required'=>true,'class' => "form-control ".($errors->has('fio') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('fio'))
                                        <span class="error invalid-feedback">{{ $errors->first('fio') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="date_entry"><strong>Дата вступления в должность:</strong></label>{!! Form::label('date_entry',"*",['style'=>"color:red"]) !!}
                                    {!! Form::date('date_entry', null, ['autocomplete'=>'OFF','id'=>'date_entry','placeholder' => 'Дата вступления в должность','required'=>true,'class' => "form-control ".($errors->has('date_entry') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('date_entry'))
                                        <span class="error invalid-feedback">{{ $errors->first('date_entry') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="position_id"><strong>Должность:</strong></label>{!! Form::label('position_id',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('position_id',$positions, null, ['autocomplete'=>'OFF','id'=>'position_id','placeholder' => '','required'=>true,'class' => "form-control ".($errors->has('position_id') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('position_id'))
                                        <span class="error invalid-feedback">{{ $errors->first('position_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="department_id"><strong>цех/отдел:</strong></label>{!! Form::label('department_id',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('department_id',$departments, null, ['autocomplete'=>'OFF','id'=>'department_id','placeholder' => '','required'=>true,'class' => "form-control ".($errors->has('department_id') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('department_id'))
                                        <span class="error invalid-feedback">{{ $errors->first('department_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="education"><strong>Образование:</strong></label>
                                    {!! Form::text('education', null, ['autocomplete'=>'OFF','id'=>'education','placeholder' => 'Образование','class' => "form-control ".($errors->has('education') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('education'))
                                        <span class="error invalid-feedback">{{ $errors->first('education') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="graduation_year"><strong>Год окончания(2020):</strong></label>
                                    {!! Form::text('graduation_year', null, ['autocomplete'=>'OFF','id'=>'graduation_year','placeholder' => 'Год окончания','class' => "form-control ".($errors->has('graduation_year') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('graduation_year'))
                                        <span class="error invalid-feedback">{{ $errors->first('graduation_year') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="education_name"><strong>Название учебного:</strong></label>
                                    {!! Form::text('education_name', null, ['autocomplete'=>'OFF','id'=>'education_name','placeholder' => 'Название учебного','class' => "form-control ".($errors->has('education_name') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('education_name'))
                                        <span class="error invalid-feedback">{{ $errors->first('education_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="specialist"><strong>Специаль-ность по диплому:</strong></label>
                                    {!! Form::text('specialist', null, ['autocomplete'=>'OFF','id'=>'specialist','placeholder' => 'Специаль-ность по диплому','class' => "form-control ".($errors->has('specialist') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('specialist'))
                                        <span class="error invalid-feedback">{{ $errors->first('specialist') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="birthdate"><strong>Дата рождения:</strong></label>{!! Form::label('birthdate',"*",['style'=>"color:red"]) !!}
                                    {!! Form::date('birthdate', null, ['autocomplete'=>'OFF','id'=>'birthdate','placeholder' => 'Дата рождения','required'=>true,'class' => "form-control ".($errors->has('birthdate') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('birthdate'))
                                        <span class="error invalid-feedback">{{ $errors->first('birthdate') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="birth_place"><strong>Место рождения:</strong></label>{!! Form::label('birth_place',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('birth_place', null, ['autocomplete'=>'OFF','id'=>'birth_place','placeholder' => 'Место рождения','required'=>true,'class' => "form-control ".($errors->has('birth_place') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('birth_place'))
                                        <span class="error invalid-feedback">{{ $errors->first('birth_place') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="birth_place"><strong>Пол:</strong></label>{!! Form::label('gender',"*",['style'=>"color:red"]) !!}
                                    {!! Form::select('gender', \App\Models\User::$genders,null, ['autocomplete'=>'OFF','id'=>'gender','required'=>true,'class' => "form-control ".($errors->has('gender') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('gender'))
                                        <span class="error invalid-feedback">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="nationality"><strong>Нацио-наль-ность:</strong></label>{!! Form::label('nationality',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('nationality', null, ['autocomplete'=>'OFF','id'=>'nationality','placeholder' => 'Нацио-наль-ность','required'=>true,'class' => "form-control ".($errors->has('nationality') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('nationality'))
                                        <span class="error invalid-feedback">{{ $errors->first('nationality') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="citizenship"><strong>Гражданство:</strong></label>{!! Form::label('citizenship',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('citizenship', null, ['autocomplete'=>'OFF','id'=>'citizenship','placeholder' => 'Гражданство','required'=>true,'class' => "form-control ".($errors->has('citizenship') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('citizenship'))
                                        <span class="error invalid-feedback">{{ $errors->first('citizenship') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="family_status"><strong>Семейное положение:</strong></label>{!! Form::label('family_status',"*",['style'=>"color:red"]) !!}
                                    {!! Form::text('family_status', null, ['autocomplete'=>'OFF','id'=>'family_status','placeholder' => 'Семейное положение','required'=>true,'class' => "form-control ".($errors->has('family_status') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('family_status'))
                                        <span class="error invalid-feedback">{{ $errors->first('family_status') }}</span>
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
