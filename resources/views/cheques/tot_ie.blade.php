@extends('home')

@section('contenido')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    
</script>

<script>

$(document).ready(function(){
    $("#btncon").click(function(){
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
        var fdata = { "fechad" : $("#fec1").val(),
                      "fechah": $("#fec2").val(),
        };
        $.ajax({
            url:"/cheques/t_ing_eng",
            type:"get",
            dataType:"json",
            data: fdata,
            success:function(datos){
                console.log(datos);
                $("#totxtasa").val(datos.tot_int);
                $("#tot_egre_xtasa").val(datos.tot_pag);
                $("#totxgastos").val(datos.tot_gas);
                $("#totxgaspag").val(datos.tot_pag_gas);
                $("#totxotr").val(datos.tot_otr);
            },
            error:function(){
                alert("error");
            }
        });
        
    });
    
});


</script>


    <div class="row">
        <div class="col-md-6"> <h2>Totales Ingresos - Egresos </h2> </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('fechadesde', 'Fecha Desde: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::date('fechadesde', null, ['class' => 'form-control','required' => 'required','id'=>'fec1']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('fechahasta', 'Fecha Hasta: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-8">
                    {!! Form::date('fechahasta', null, ['class' => 'form-control','required' => 'required','id'=>'fec2']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="col-sm-8">
                    <a href="#!" class="btn btn-primary pull-right btn-sm" id="btncon">Consultar</a>
                </div>
            </div>
        </div>
    </div>
         
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Rubro</th>
                        <th>Ingresos</th>
                        <th>Egresos</th>
                        
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>Interesese Cobrados</td>
                            <td> {!! Form::number('tot_ingxtasa', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'totxtasa']) !!}</td>   
                            <td>{!! Form::number('tot_extasa', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_egre_xtasa']) !!}</td>
                        </tr>
                        <tr>
                            <td>Gastos Cobrados</td>
                            <td>{!! Form::number('gascob', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'totxgastos']) !!}</td>   
                            <td>{!! Form::number('gaspag', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'totxgaspag']) !!}</td>
                        </tr>
                        <tr>
                            <td>Otros Ingresos</td>
                            <td>{!! Form::number('totxotri', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'totxotr']) !!}</td>   
                            <td>0.00</td>
                        </tr>
                </tbody>    
            </table>
        </div>
 
@endsection