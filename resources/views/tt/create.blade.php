@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Загрузить данные в Excel
            </h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'tt.store','method'=>'POST','enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleInputFile">Файл Excel из iVMS AC 4200</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                            </div>
                        </div>
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
