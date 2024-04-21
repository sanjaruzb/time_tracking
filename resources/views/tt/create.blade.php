@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Excelda malumotlarni yuklash
            </h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'tt.store','method'=>'POST','enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleInputFile">iVMS AC 4200 dan olingan excel fayl</label>{!! Form::label('*',"*",['style'=>"color:red"]) !!}

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Faylni tanlang</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


{{--    <div class="card mb-12 mb-xl-12" id="kt_profile_details_view" style="margin: 10px; padding: 10px">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12 margin-tb">--}}
{{--                <div class="pull-left">--}}
{{--                    <h2>Create New Excel</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="card mb-12 mb-xl-12" id="kt_profile_details_view" style="margin: 10px; padding: 10px">--}}
{{--        @if (count($errors) > 0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}


{{--        {!! Form::open(['route' => 'tt.store','method'=>'POST','enctype' => 'multipart/form-data']) !!}--}}
{{--        <div class="row">--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Excel File:</strong>{!! Form::label('*',"*",['style'=>"color:red"]) !!}--}}
{{--                    {!! Form::file('excel', null, ['placeholder' => 'Excel','class' => 'form-control']) !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                <br>--}}
{{--                <button type="submit" class="btn btn-primary form-control">Submit</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        {!! Form::close() !!}--}}

{{--    </div>--}}
@endsection
