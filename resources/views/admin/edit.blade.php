@extends('home')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>
				@if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
				@endif
				<div class="panel-body">
					@include('admin.parciales.errores')
					{!! Form::model($user,['route'=>['Admin.user.update',$user],'method'=>'PUT']) !!}
						<form>
							@include('admin.parciales.campos')
							<button type="submit" class="btn btn-default">Actualizar</button>
						</form>
					{!!Form::close() !!}
				</div>
			</div>
			{!! Form::open(['route'=>['Admin.user.destroy',$user],'method'=>'DELETE']) !!}
				<button type="submit" class="btn btn-danger">Eliminar Registro</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
