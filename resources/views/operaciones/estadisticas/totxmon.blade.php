@extends('home')

@section('contenido')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript"></script>

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
            url:"/operacion/caltotmoneda",
            type:"get",
            dataType:"json",
            data: fdata,
            success:function(datos){
                console.log(datos);
                $("#tot_com_dol").val(datos.tot_compradol);
                $("#tot_ven_dol").val(datos.tot_ventadol);
                $("#tot_com_eur").val(datos.tot_comeuro);
                $("#tot_ven_eur").val(datos.tot_veneuro);
                $("#tot_com_real").val(datos.tot_comreal);
                $("#tot_ven_real").val(datos.tot_venreal);
            },
            error:function(){
                alert("error");
            }
        });
        
    });
    
});


</script>



<div class="row">
        <div class="col-md-6"> <h2>Totales Compra y Venta por Moneda </h2> </div>
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
         
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h3>Dolares</h3>
            </div>
            <div class="col-md-4">
                <h3>Euros</h3>
            </div>
            <div class="col-md-4">
                <h3>Reales</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <h4>Compras</h4>
            </div>
            <div class="col-md-2">
                <h4>Ventas</h4>
            </div>
            <div class="col-md-2">
                <h4>Compras</h4>
            </div>
            <div class="col-md-2">
                <h4>Ventas</h4>
            </div>
            <div class="col-md-2">
                <h4>Compras</h4>
            </div>
            <div class="col-md-2">
                <h4>Ventas</h4>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-2">
                <h5>
                    {!! Form::number('t_c_d', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_com_dol']) !!}
                </h5>
            </div>
            <div class="col-md-2">
                <h5>
                    {!! Form::number('t_v_d', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_ven_dol']) !!}
                </h5>
            </div>
            <div class="col-md-2">
                <h5>
                    {!! Form::number('t_c_e', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_com_eur']) !!}
                </h5>
            </div>
            <div class="col-md-2">
                <h5>
                    {!! Form::number('t_v_e', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_ven_eur']) !!}
                </h5>
            </div>
            <div class="col-md-2">
                <h5>
                    {!! Form::number('t_c_r', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_com_real']) !!}
                </h5>
            </div>
            <div class="col-md-2">
                <h5>{!! Form::number('t_v_r', null, ['class' => 'form-control',"step"=>"0.01" ,"readonly"=>"true","placeholder"=>"0.00",'id'=>'tot_ven_real']) !!}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
            <div class="col-md-2">
                <h5>$xxxxxx</h5>
            </div>
        </div>
    </div>
    
    
    

@endsection