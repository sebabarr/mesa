@extends('home')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Operaciones</div>

				<div class="panel-body">
					@include('admin.parciales.errores')
					{!! Form::open(['route'=>'operacion.store','method'=>'post']) !!}
						<form>
							@include('operaciones.parciales.opcampos')
							<button type="submit" class="btn btn-default">Grabar</button>
						</form>
					{!!Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
