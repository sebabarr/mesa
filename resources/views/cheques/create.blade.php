@extends('home')

@section('contenido')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <script type="text/javascript">
        $(document).ready(function(){
            
            $("#importe").val(0);
            $("#des_gasto").val(0);
            $("#desc_d").val(0);
            $("#descufijo").val(0);
            $("#total_neto").val(0);
            
            
            function numdias(){
            
                var d1 = $('#fechavto').val();
                var a1 =  d1.substr(0, 4);
                var m1 = d1.substr(5,2);
                var c1 = d1.substr(8,2);
                var dat1 = new Date(a1,m1-1,c1);
                var dat2 = new Date();
            	var fin = dat1.getTime() - dat2.getTime();
            	var dias1 = Math.floor(fin / (1000 * 60 * 60 * 24));  
                var clearing=0;
                var dow = dat1.getDay();
                
                switch (dow) {
                    case 1:
                        clearing=2;
                        break;
                    case 2:
                        clearing=2;
                        break;
                    case 3:
                        clearing=2;
                        break;
                    case 4:
                        clearing=4;
                        break;
                    case 5:
                        clearing=4;
                        break;    
                    case 6:
                        clearing=4;
                        break;    
                    default:
                        clearing=4;
                }
                
                
                //alert("dia de la semana"+dow+"clearing"+clearing+"cantidad de dias"+dias1);
            	return (dias1+clearing+1);
            }
            function caltot(){
                
                var dias = numdias();
                var desctasa = (($("#tasa_d").val()/30*dias)/100)*$("#importe").val();
                desctasa.toPrecision(2);
                $("#desc_d").val(desctasa);
                var descgasto = ($("#tasa_g").val()/100)*$("#importe").val(); 
                descgasto.toPrecision(2);
                $("#des_gasto").val(descgasto);
                var tn1 = $("#importe").val()-$("#des_gasto").val()-$("#desc_d").val()-$("#descufijo").val();
                tn1.toPrecision(2);
                $("#total_neto").val(tn1);
                return;
            }
            $("#importe").change(function(){
                caltot();
                return;
            });
            
            $("#tasa_d").change(function(){
                caltot();    
                return;

            });
            $("#tasa_g").change(function(){

                caltot();
                return;

            });
            $("#descufijo").change(function(){

                caltot();
                
                return;

            });
            $("#fechavto").change(function(){

                caltot();
                
                return;

            });
        });
</script>
   

    <h1>Cargar Nuevo Cheque</h1>
    

    {!! Form::open(['url' => 'cheques', 'class' => 'form-horizontal']) !!}
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('nrocheque') ? 'has-error' : ''}}">
                    {!! Form::label('nrocheque', 'Nrocheque: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('nrocheque', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! $errors->first('nrocheque', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('importe') ? 'has-error' : ''}}">
                    {!! Form::label('importe', 'Importe: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('importe', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'required' => 'required']) !!}
                        {!! $errors->first('importe', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('id_banco') ? 'has-error' : ''}}">
                    {!! Form::label('id_banco', 'Id Banco: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('id_banco',$bancos,Input::old('id_banco'), ['class' => 'form-control','placeholder'=>'Seleccione Banco',"required"=>"required"]) !!}
                        {!! $errors->first('id_banco', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('fechavto') ? 'has-error' : ''}}">
                    {!! Form::label('fechavto', 'Fechavto: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::date('fechavto', null, ['class' => 'form-control','required' => 'required']) !!}
                        {!! $errors->first('fechavto', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>    
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('id_cuit') ? 'has-error' : ''}}">
                    {!! Form::label('id_cuit', 'Id Cuit: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('id_cuit',$cuits,Input::old('id_cuit'),['class'=>'form-control',"required"=>"required",'placeholder'=>'Seleccione cuit']) !!}
                        {!! $errors->first('id_cuit', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               {!! Form::label('id_cliente', 'Id Cliente: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('id_cliente',$clientes,Input::old('id_cliente'), ['class' => 'form-control', 'placeholder'=>'Seleccione Cliente']) !!}
                
                </div>
            </div>
        </div>    
        <div class="row">   
            <div class="col-md-6">    
                <div class="form-group {{ $errors->has('id_cartera') ? 'has-error' : ''}}">
                    {!! Form::label('id_cartera', 'Id Cartera: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('id_cartera',$carteras,Input::old('id_cartera'), ['class' => 'form-control']) !!}
                        {!! $errors->first('id_cartera', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>    
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('tasa_desc', 'Tasa: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::number('tasa_desc', null, ['class' => 'form-control',"step"=>"0.01" ,"placeholder"=>"0.00",'id'=>'tasa_d']) !!}
                    </div>    
                </div>    
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('desctasa') ? 'has-error' : ''}}">
                    {!! Form::label('desctasa', 'Descuento: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('desctasa', null, ['class' => 'form-control',
                                                            "step"=>"0.01",'id'=> 'desc_d',"placeholder"=>"0.00","readonly"=>""]) !!}
                        {!! $errors->first('desctasa', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>    
        <div class="row"> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('tasa_gast', 'Tasa Gasto: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('tasa_gast', null, ['class' => 'form-control',"step"=>"0.01",'id' => 'tasa_g',"placeholder"=>"0.00"]) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('desc','Descuento Gasto: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('descgasto', null, ['class' => 'form-control', "step"=>"0.01",'id'=>'des_gasto',"placeholder"=>"0.00","readonly"=>""]) !!}
                       
                    </div>
                </div>
            </div>    
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('descfijo') ? 'has-error' : ''}}">
                    {!! Form::label('descfijo1', 'Descuento fijo: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('descfijo', null, ['class' => 'form-control',"step"=>"0.01","id"=>"descufijo"]) !!}
                        {!! $errors->first('descfijo', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>   
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('total_neto', 'Total Neto: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('total_neto', null, ['class' => 'form-control',"placeholder"=> "0.00" ,"readonly"=>""]) !!}
                    </div>
                </div>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
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