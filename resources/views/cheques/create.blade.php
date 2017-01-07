@extends('home')

@section('contenido')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script type="text/javascript">
        
        
        $(document).ready(function(){
            
            
            /*funcion para formatear a numero*/
            
            $("#carcheques").hide();
            var formatNumber = {
                                 separador: ".", // separador para los miles
                                 sepDecimal: ',', // separador para los decimales
                                 formatear:function (num){
                                  num +='';
                                  var splitStr = num.split('.');
                                  var splitLeft = splitStr[0];
                                  var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                                  var regx = /(\d+)(\d{3})/;
                                  while (regx.test(splitLeft)) {
                                  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                                  }
                                  return this.simbol + splitLeft  +splitRight;
                                 },
                                 new:function(num, simbol){
                                  this.simbol = simbol ||'';
                                  return this.formatear(num);
                                 }
                                }
            
            /*-----------------------------------------*/
            
            
            
            
            
            
            $("#importe").val(0);
            $("#des_gasto").val(0);
            $("#desc_d").val(0);
            $("#descufijo").val(0);
            $("#total_neto").val(0);
            
            
            function numdias(ind){
            
                var d1 = $('input[name="fechavto[]"]')[ind].value;
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
                    
                    
                    var imp = $('input[name="importe[]"]');
                    
                    var dias =0;
                    var totalimporte = 0;
                    var totaldescu = 0;
                    var totalfijo = 0;
                    var totalgasto = 0;
                    var totalneto = 0;
                    var importe = 0;
                    var fijo = 0;
                    
                    $.each( imp, function( index, value ){
                        
                        dias = numdias(index);
                        
                        /*calculode importes */
                        var importe = $('input[name="importe[]"]')[index].value*1;
                        var fijo = $('input[name="descfijo[]"]')[index].value*1;
                        var desctasa = (($('#tasa_d').val()/30*dias)/100)*$('input[name="importe[]"]')[index].value;
                        
                        $('input[name="desctasa[]"]')[index].value = desctasa.toFixed(2);
                        
                        var descgasto = ($('#tasa_g').val()/100)*$('input[name="importe[]"]')[index].value; 
                        
                        $('input[name="descgasto[]"]')[index].value = descgasto.toFixed(2);
                        var tn1 = $('input[name="importe[]"]')[index].value-$('input[name="descgasto[]"]')[index].value
                                    -$('input[name="desctasa[]"]')[index].value-$('input[name="descfijo[]"]')[index].value;
                       
                        $('input[name="total_neto[]"]')[index].value = tn1.toFixed(2);
                        
                        totalimporte += parseFloat(importe);
                        totalfijo += parseFloat(fijo);
                        totalneto += parseFloat(tn1);
                        totaldescu += parseFloat(desctasa);
                        totalgasto += parseFloat(descgasto);
                        console.log("dias"+dias);
                        console.log("monto de descuento"+desctasa);
                        console.log("tasa"+desctasa);
                        

                    });
                    $("#totgas").val(totalgasto);
                    $("#totdes").val(totaldescu);
                    $("#totfij").val(totalfijo);
                    $("#totnet").val(totalneto);
                    $("#totimp").val(totalimporte);
                    

                }
            
            $('input[name="importe[]"]').change(function(){
               caltot();
                return;
            });
            $('input[name="tasa_desc1"]').change(function(){

                caltot();
                return;

            });
            $('input[name="tasa_gast1"]').change(function(){

                caltot();
                return;

            });
            $('input[name="descfijo[]"]').change(function(){

                caltot();
                
                return;

            });
            $('input[name="fechavto[]"]').change(function(){

                caltot();
                
                return;

            });
            
        $("#btncli").click(function(){
       
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
            var fdata = { "cliente" : $("#idcli").val(),
                        };
            $.ajax({
                url:"/cheques/buscasaldo",
                type:"get",
                dataType:"json",
                data: fdata,
                success:function(datos){
                    console.log(datos);
                    $("#saldisp").val(datos.sal_disp);
                    $("#tasa_d").val(datos.cli_tasa);
                    $("#tasa_g").val(datos.cli_tasag);
                     $("#carcheques").show();
                    
                },
                error:function(){
                    alert("error");
                }
            });
        
        });
        
        
        $("#btncuit").click(function(){
       
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
            var fdata = { "cuit" : $("#idcuit").val(),
                        };
            $.ajax({
                url:"/cheques/buscasaldocuit",
                type:"get",
                dataType:"json",
                data: fdata,
                success:function(datos){
                    console.log(datos);
                    $("#saldisp_cuit").val(datos.sal_disp_cuit);
                },
                error:function(){
                    alert("error");
                }
            });
        
        });
        
        
        
    });
    
    
</script>

   

    <h3>Cargar Nuevo Cheque</h3>
    

    {!! Form::open(['url' => 'cheques', 'class' => 'form-horizontal']) !!}
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#cargarcheque">Cargar Ch.</a></li>
            <li><a data-toggle="tab" href="#liquidacion">Liquidacion</a></li>
            
        </ul>   
        <div class="tab-content">
            <div id="cargarcheque" class="tab-pane fade in active">
                <div class="row">
                    
                        <div class="col-md-6">
                            <div class="col-md-1">
                                {!! Form::label('id_cliente', 'Cliente: ', ['class' => 'control-label ']) !!}
                            </div>
                            <div class=col-md-4>
                                {!! Form::select('id_cliente',$clientes,Input::old('id_cliente'), ['class' => 'form-control ', 'placeholder'=>'Seleccione Cliente','id'=>'idcli', "required"=> "required"]) !!}
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-default" id="btncli">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('id_cliente2', 'Disponible', ['class' => 'control-label ']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::number('saldodisp', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'saldisp',"readonly"=>""]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-1">
                                {!! Form::label('tasa_desc', 'Tasa: ', ['class' => 'control-label']) !!}
                            </div>     
                            <div class="col-md-3">
                                {!! Form::number('tasa_desc1', null, ['class' => 'form-control',"step"=>"0.01" ,"placeholder"=>"0.00",'id'=>'tasa_d']) !!}
                            </div>  
                            <div class="col-md-3">
                            {!! Form::label('tasa_gast', 'Tasa Gasto: ', ['class' => 'control-label']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::number('tasa_gast1', null, ['class' => 'form-control',"step"=>"0.01",'id' => 'tasa_g',"placeholder"=>"0.00"]) !!}
                            </div>
                        </div>
                </div>    
            </div>
                <div class="table" id="carcheques" >
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-1">Cuit</th>
                                        <th>Disponible</th>
                                        <th>Nro.Cheque</th>
                                        <th>Fecha</th>
                                        <th>Banco</th>
                                        <th>Importe</th>
                                        <th>Descuento</th>
                                        <th>Gasto</th>
                                        <th>D.Fijo</th>
                                        <th>Neto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 4; $i++)
                                        <tr>
                                            <td>
                                                {!! Form::select('id_cuit[]',$cuits,Input::old('id_cuit'),['class'=>'form-control input-sm',"id"=>'idcuit','placeholder'=>'Seleccione cuit']) !!}
                                            </td>
                                            <td></td>
                                            <td>
                                                {!! Form::number('nrocheque[]', null, ['class' => 'form-control', 'id'=>'nrocheque1']) !!}
                                            </td>
                                            <td>
                                               {!! Form::date('fechavto[]', null, ['class' => 'form-control', 'id'=>'fechas1']) !!} 
                                             </td>
                                            <td>
                                               {!! Form::select('id_banco[]',$bancos,Input::old('id_banco'), ['class' => 'form-control','placeholder'=>'Seleccione Banco']) !!} 
                                            </td>
                                            <td>
                                                {!! Form::number('importe[]', null, ['class' => 'form-control', 
                                                "step"=>"0.01","value"=>"0.00"])!!}
                                            </td>
                                            <td>
                                                {!! Form::number('desctasa[]', null, ['class' => 'form-control',
                                                                    "step"=>"0.01",'id'=> 'desc_d',"placeholder"=>"0.00","readonly"=>""]) !!}
                                            </td>
                                            <td>
                                               {!! Form::number('descgasto[]', null, ['class' => 'form-control', "step"=>"0.01",'id'=>'des_gasto',"placeholder"=>"0.00","readonly"=>""]) !!} 
                                            </td>
                                            <td>
                                               {!! Form::number('descfijo[]', null, ['class' => 'form-control',"step"=>"0.01","id"=>"descufijo"]) !!} 
                                            </td>
                                            <td>
                                               {!! Form::number('total_neto[]', null, ['class' => 'form-control',"placeholder"=> "0.00" ,"readonly"=>""]) !!} 
                                            </td>
                                        </tr>
                                        
                                    @endfor
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                          {!! Form::number('ti', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'totimp',"readonly"=>""]) !!}  
                                        </td>
                                        <td>
                                          {!! Form::number('td', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'totdes',"readonly"=>""]) !!}  
                                        </td>
                                        <td>
                                          {!! Form::number('tg', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'totgas',"readonly"=>""]) !!}  
                                        </td>
                                        <td>
                                            {!! Form::number('tf', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'totfij',"readonly"=>""]) !!}    
                                        </td>
                                        <td>
                                          {!! Form::number('tn', null, ['class' => 'form-control', "step"=>"0.01","value"=>"0.00",'id'=>'totnet',"readonly"=>""]) !!}  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Grabar Cheques', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
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