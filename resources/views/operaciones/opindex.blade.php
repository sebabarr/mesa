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
						<div class="col-md-3">
							<a class='btn btn-info' href="{{ route('operacion.create') }}" role='button'>Nueva Operacion</a>
						</div>
						<div class="col-md-3">
							<h4 class="text-info">Saldo U$S: {{ number_format($total_dolar, 2, ",", ".") }}</h4>
						</div>
						<div class="col-md-3">
							<h4 class="text-info">Saldo Euro: {{ number_format($total_euro, 2, ",", ".") }}</h4>
						</div>
						<div class="col-md-3">
							<h4 class="text-info">Saldo Real: {{ number_format($total_real, 2, ",", ".") }}</h4>
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
        				        <th>Comprador</th>
        				        <th>Vendedor</th>
        				        <th>Movimiento</th>
        				        <th>Cotizacion</th>
        				        <th>Importe</th>
        				        <th>Fecha y hora</th>
        				        <th>Acciones</th>
        				        <th>    </th>
        				    </tr>
        				    @foreach($operaciones as $ope)
        				    <tr>
        				        <td>{{ $ope->id }}</td>
        				        <td>{{ $ope->moneda }}</td>
        				        <td>{{ $ope->comprador }}</td>
        				        <td>{{ $ope->vendedor }}</td>
        				        <td>{{ $ope->tipo_mov }}</td>
        				        <td>{{ number_format($ope->cotizacion, 2, ",", ".") }}</td>
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

