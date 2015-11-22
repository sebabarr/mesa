@extends('home')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>

				<div class="panel-body">
					@include('admin.parciales.errores')
					{!! Form::open(['route'=>'Admin.user.store','method'=>'post']) !!}
						<form>
							@include('admin.parciales.campos')
							<button type="submit" class="btn btn-default">Grabar</button>
						</form>
					{!!Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
