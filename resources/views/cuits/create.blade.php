@extends('home')

@section('contenido')

    <h1>Create New Cuit</h1>
    <hr/>

    {!! Form::open(['url' => 'cuits', 'class' => 'form-horizontal']) !!}
                @include('flash::message')
                @if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
				@endif
                <div class="form-group {{ $errors->has('razonsocial') ? 'has-error' : ''}}">
                    {!! Form::label('razonsocial', 'Razonsocial: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('razonsocial', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('razonsocial', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
                <div class="form-group {{ $errors->has('numero') ? 'has-error' : ''}}">
                    {!! Form::label('numero', 'Numero: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('limite') ? 'has-error' : ''}}">
                {!! Form::label('limite', 'Limite: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('limite', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('limite', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection