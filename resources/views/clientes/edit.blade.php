@extends('home')

@section('contenido')

    <h1>Edit Cliente</h1>
    <hr/>

    {!! Form::model($cliente, [
        'method' => 'PATCH',
        'url' => ['clientes', $cliente->id],
        'class' => 'form-horizontal'
    ]) !!}
    @include('clientes.clicampos')


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