@extends('home')

@section('contenido')

    <h1>Edit Cuit</h1>
    <hr/>

    {!! Form::model($cuit, [
        'method' => 'PATCH',
        'url' => ['cuits', $cuit->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('razonsocial') ? 'has-error' : ''}}">
                {!! Form::label('razonsocial', 'Razonsocial: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('razonsocial', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    
                </div>
            </div>
           
            <div class="form-group {{ $errors->has('limite') ? 'has-error' : ''}}">
                {!! Form::label('limite', 'Limite: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('limite', null, ['class' => 'form-control']) !!}
                    
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