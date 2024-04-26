@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Изменить {{ $tt->name }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($tt, ['method' => 'PATCH','route' => ['cadre.update', $tt->id], 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="info"><strong>Тип информации:</strong></label>
                                    {!! Form::select('info_type', \App\Models\Tt::$infoType,null, ['autocomplete'=>'OFF','id'=>'info','placeholder' => '','class' => "form-control ".($errors->has('info_type') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('info_type'))
                                        <span class="error invalid-feedback">{{ $errors->first('info_type') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="info"><strong>Информация:</strong></label>
                                    {!! Form::textarea('info', null, ['rows' => 5, 'autocomplete'=>'OFF','id'=>'info','placeholder' => 'Информация','class' => "form-control ".($errors->has('info') ? 'is-invalid' : '')]) !!}
                                    @if($errors->has('info'))
                                        <span class="error invalid-feedback">{{ $errors->first('info') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Файл</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file[]" multiple="multiple" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                        </div>
                                    </div>
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
