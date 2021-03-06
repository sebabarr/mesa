@extends('home')

@section('contenido')
    
<div class="container">
	<div class="row">
	
		
		
		<!--<div class="col-md-10 col-md-offset-1">-->
			<div class="panel panel-default">
				@if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
				@endif
				<div class="panel-heading">Operaciones</div>
				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-2">
							<a class='btn btn-info' href="{{ route('operacion.create') }}" role='button'>Nueva Operacion</a>
						</div>
						<div class="col-md-2">
							<h4 class="text-info">U$S: {{ number_format($total_dolar, 2, ",", ".") }}</h4>
							<div class="span6">
								<h5>PC: $ {{ number_format($prom_dolcompras,2,",", ".") }} PV: $ {{ number_format($prom_dolventas,2,",", ".") }}</h5>
								<h5>PUC: ${{ number_format($ult_predol_com,2,",", ".") }}  PUV: ${{ number_format($ult_predol_ven,2,",", ".") }}</h5>
								
							</div>
						</div>
						<div class="col-md-2">
							<h4 class="text-info">Euro: {{ number_format($total_euro, 2, ",", ".") }}</h4>
							<h5>PC: $ {{ number_format($prom_eurocompras,2,",", ".") }} PV: $ {{ number_format($prom_euroventas,2,",", ".") }}</h5>
							<h5>PUC: $ {{ number_format($ult_preeur_com,2,",", ".") }}  PUV: $ {{ number_format($ult_preeur_ven,2,",", ".") }}  </h5>

						</div>
						<div class="col-md-2">
							<h4 class="text-info">Real: {{ number_format($total_real, 2, ",", ".") }}</h4>
							<h5>PC: $ {{ number_format($prom_realcompras,2,",", ".") }} PV: $ {{ number_format($prom_realventas,2,",", ".") }}</h5>
							<h5>PUC $ {{ number_format($ult_rea_com,2,",", ".") }} PUV $ {{ number_format($ult_rea_ven,2,",", ".") }}</h5> 

						</div>
						<div class="col-md-2">
							<h4 class="text-info">Pesos: {{ number_format($total_pesos, 2, ",", ".") }}</h4>
						</div>
							<!--{!! Form::open(['route'=>'operacion.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}	
			  					<div class="form-group">
			    					{!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre Usuario']) !!}
			  						</div>
			  					<button type="submit" class="btn btn-default">Buscar</button>
							{!! Form::close() !!}-->
						
					</div>
					
					
        				<table class='table table-striped'>
        				    <tr>
        				        <th>#</th>
        				        <th>Moneda</th>
        				        <th>Contraparte</th>
        				        
        				        <th>Movimiento</th>
        				        <th>Cotizacion</th>
        				        <th>Cantidad</th>
        				        <th>Importe</th>
        				        <th>Fecha y hora</th>
        				        <th>Acciones</th>
        				        <th>    </th>
        				    </tr>
        				    @foreach($operaciones as $ope)
        				    <tr>
        				        <td>{{ $ope->id }}</td>
        				        <td>{{ $ope->moneda }}</td>
        				        <td>{{ $ope->clientes->razonsocial }}</td>
        				        
        				        <td>{{ $ope->tipo_mov }}</td>
        				        <td>{{ number_format($ope->cotizacion, 2, ",", ".") }}</td>
        				        <td>{{ number_format($ope->cantidad, 2, ",", ".") }}</td>
        				        <td>{{ number_format($ope->importe, 2, ",", ".") }}</td>
        				        <td>{{ $ope->created_at }}</td>
        				        <td>
        				            <a class="btn btn-info" role="button" href="{{ route('operacion.edit', $ope) }}">Editar</a>
        				        </td>
        				        <td>
        				            {!! Form::open(['route'=>['operacion.destroy',$ope->id],'method'=>'DELETE']) !!}
        				            	<button type="submit" class="btn btn-danger">Eliminar Registro</button>
        				            {!! Form::close() !!}
        				        </td>
        				    </tr>
        				    @endforeach 
        				</table>	
        				{!! $operaciones->setPath('')->render() !!}
				</div>
			</div>
			
	<!--	</div>-->
	

	</div>
</div>
@endsection

