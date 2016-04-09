@extends('home')

@section('contenido')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            var tn1 = $("#imp").val()-$("#dg").val()-$("#dt").val()-$("#df").val();
                tn1.toPrecision(2);
                $("#netoch").val(tn1);
        });
   
   
    </script>
    <h1>Edit Cheque</h1>
    <hr/>

    {!! Form::model($cheque, [
        'method' => 'PATCH',
        'url' => ['cheques', $cheque->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('nrocheque') ? 'has-error' : ''}}">
                {!! Form::label('nrocheque', 'Nrocheque: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('nrocheque', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('nrocheque', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('importe') ? 'has-error' : ''}}">
                {!! Form::label('importe', 'Importe: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('importe', null, ['class' => 'form-control', "id" => "imp" ,'required' => 'required']) !!}
                    {!! $errors->first('importe', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_banco') ? 'has-error' : ''}}">
                {!! Form::label('id_banco', 'Id Banco: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_banco', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_banco', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('fechavto') ? 'has-error' : ''}}">
                {!! Form::label('fechavto', 'Fechavto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('fechavto', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('fechavto', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_cuit') ? 'has-error' : ''}}">
                {!! Form::label('id_cuit', 'Id Cuit: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('id_cuit', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_cuit', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
                {!! Form::label('estado', 'Estado: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_cliente') ? 'has-error' : ''}}">
                {!! Form::label('id_cliente', 'Id Cliente: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_cliente', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_cliente', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_cartera') ? 'has-error' : ''}}">
                {!! Form::label('id_cartera', 'Id Cartera: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('id_cartera', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('id_cartera', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('desctasa') ? 'has-error' : ''}}">
                {!! Form::label('desctasa', 'Desctasa: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('desctasa', null, ['class' => 'form-control',"id"=>"dt"]) !!}
                    {!! $errors->first('desctasa', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('descgasto') ? 'has-error' : ''}}">
                {!! Form::label('descgasto', 'Descgasto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('descgasto', null, ['class' => 'form-control',"id"=>"dg"]) !!}
                    {!! $errors->first('descgasto', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('descfijo') ? 'has-error' : ''}}">
                {!! Form::label('descfijo', 'Descfijo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('descfijo', null, ['class' => 'form-control',"id"=>"df"]) !!}
                    {!! $errors->first('descfijo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Neto', 'Neto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('neto', null, ['class' => 'form-control', "id"=>"netoch"]) !!}
                    
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