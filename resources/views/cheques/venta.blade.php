@extends('home')

@section('contenido')

<script type="text/javascript">
        
        var importe=parseFloat("<?php echo $chequeven->importe; ?>");
        var f = parseInt("<?php echo $chequeven->id; ?>");
        $(document).ready(function(){
            
            $("#total_neto").val(importe);
            $("#idch").val(f);
            
            function numdias(){
            
                var d1 = "<?php echo $chequeven->fechavto; ?>";
                var a1 =  d1.substr(0, 4);
                var m1 = d1.substr(5,2);
                var c1 = d1.substr(8,2);
                var dat1 = new Date(a1,m1-1,c1);
                var dat2 = new Date();
            	var fin = dat1.getTime() - dat2.getTime();
            	var dias = Math.floor(fin / (1000 * 60 * 60 * 24))  
             
            	return (dias+1);
            }
            function caltot(){
                
                var dias = numdias();
                var desctasa = (($("#tasa_d").val()/30*dias)/100)*importe;
                $("#des_tasa").val(desctasa);
                var descgasto = ($("#tasa_gas").val()/100)*importe;
                $("#des_gasto").val(descgasto);
                var tn1 = importe-$("#des_gasto").val()-$("#des_tasa").val()-$("#descufijo").val();
                $("#total_neto").val(tn1);
                return;
            }
            $("#total_neto").change(function(){
                caltot();
                return;
            });
            
            $("#tasa_d").change(function(){
                caltot();    
                return;

            });
            $("#tasa_gas").change(function(){

                caltot();
                return;

            });
            $("#descufijo").change(function(){

                caltot();
                
                return;

            });
            $("#fechaventa").change(function(){

                caltot();
                
                return;

            });
        });
</script>
    <h3>Cargar Venta Cheque Nro: {!! $chequeven->nrocheque !!}</h3>
    
    {!! Form::open(array('action' => array('ChequesController@grabarVenta'))) !!}
  
    <div class="cointener">
        <div class="row">
            <div class="col-md-6">
                <label>Importe: $</label>
                <strong>{{ number_format($chequeven->importe, 2, ",", ".") }}</strong>
            
                <label>Fecha Vto: </label>
                <strong>{{ $chequeven->fechavto }}</strong>
           
                <label>Cuit: </label>
               <strong> {{ $chequeven->id_cuit }}</strong>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('importe') ? 'has-error' : ''}}">
                    {!! Form::label('tomador', 'Tomador: ', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::select('id_tomador', $clientes,Input::old('id_tomador'), ['class' => 'form-control','required' => 'required']) !!}
                        {!! $errors->first('importe', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('fechavto') ? 'has-error' : ''}}">
                        {!! Form::label('fechavta', 'Fecha Venta: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::date('fechaventa', null, ['class' => 'form-control','required' => 'required', "id"=>"fecvta"]) !!}
                            {!! $errors->first('fechaventa', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('tasa_desc', 'Tasa: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('tasa_descu', null, ['class' => 'form-control',"step"=>"0.01" ,"placeholder"=>"0.00",'id'=>'tasa_d']) !!}
                        </div>    
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">    
                    <div class="form-group {{ $errors->has('desctasa') ? 'has-error' : ''}}">
                        {!! Form::label('desctasa', 'Tasa Gasto: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::number('tasa_gasto', null, ['class' => 'form-control',
                                                                "step"=>"0.01",'id'=> 'tasa_gas',"placeholder"=>"0.00"]) !!}
                            {!! $errors->first('tasa_gasto', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('desc','Descuento Tasa: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::number('descuento', null, ['class' => 'form-control', "step"=>"0.01",'id'=>'des_tasa',"placeholder"=>"0.00","readonly"=>""]) !!}
                        </div>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('desc1','Descuento Gasto: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::number('gasto', null, ['class' => 'form-control', "step"=>"0.01",'id'=>'des_gasto',"placeholder"=>"0.00","readonly"=>""]) !!}
                        </div>
                    </div>        
                </div>
            </div>
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('descfijo') ? 'has-error' : ''}}">
                        {!! Form::label('descjo1', 'Descuento fijo: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::number('descuentofijo', null, ['class' => 'form-control',"step"=>"0.01","id"=>"descufijo",'placeholder'=>'0.00']) !!}
                            {!! $errors->first('descuentofijo', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="spam col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('tn', 'Total Neto: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::number('neto', null, ['class' => 'form-control',"step"=>"0.01","id"=>"total_neto",'placeholder'=>'0.00','readonly'=>'']) !!}
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Grabar Venta', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    {!! Form::hidden('id_cheque', null, ["id"=>"idch"]) !!}
    {!! Form::close() !!}
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
@endsection