@extends('home')

@section('contenido')

    <h1>Edit Movimiento</h1>
    <hr/>

    {!! Form::model($movimiento, [
        'method' => 'PATCH',
        'url' => ['movicheques', $movimiento->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('concepto_id') ? 'has-error' : ''}}">
                {!! Form::label('concepto_id', 'Concepto Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('concepto_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('concepto_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('comentario') ? 'has-error' : ''}}">
                {!! Form::label('comentario', 'Comentario: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('comentario', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('importe') ? 'has-error' : ''}}">
                {!! Form::label('importe', 'Importe: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('importe', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('importe', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('operacion_id') ? 'has-error' : ''}}">
                {!! Form::label('operacion_id', 'Operacion Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('operacion_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('operacion_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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