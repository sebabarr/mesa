@extends('home')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-6">
           {!! Form::open(['action'=> 'ChequesController@imprimircesion', 'method' => 'GET']) !!}
            <div class="col-md-2">
                {!! Form::label('id_cliente', 'Cliente: ', ['class' => 'control-label ']) !!}
            </div>
            <div class=col-md-6>
                {!! Form::select('id_cliente',$clientes,Input::old('id_cliente'), ['class' => 'form-control ', 'placeholder'=>'Seleccione Cliente','id'=>'idcli', "required"=> "required"]) !!}
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="col-md-2">
                {!! Form::label('id_liqui', 'Lquidacion', ['class' => 'control-label ']) !!}
            </div>
            <div class=col-md-6>
                {!! Form::number('nro_liqui',null, ['class' => 'form-control ', 'placeholder'=>'Ingrese liquidacion', "required"=> "required"]) !!}
            </div>    
            {!! Form::submit('Buscar e Imprimir') !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection('contenido')