@extends('home')

@section('contenido')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				@if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
				@endif
				<div class="panel-heading">Usuarios</div>

				<div class="panel-body">
					<a class='btn btn-info' href="{{ route('Admin.user.create') }}" role='button'>Nuevo Usuario</a>
					{!! Form::open(['route'=>'Admin.user.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}	
	  					<div class="form-group">
	    				{!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre Usuario']) !!}
	  					</div>
	  					<button type="submit" class="btn btn-default">Buscar</button>
					{!! Form::close() !!}
        				<table class='table table-striped'>
        				    <tr>
        				        <th>#</th>
        				        <th>Nombre</th>
        				        <th>Email</th>
        				        <th>Acciones</th>
        				        <th></th>
        				    </tr>
        				    @foreach($usuarios as $usu)
        				    <tr>
        				        <td>{{ $usu->id }}</td>
        				        <td>{{ $usu->name }}</td>
        				        <td>{{ $usu->email }}</td>
        				        <td>
        				            <a class="btn btn-info" role="button" href="{{ route('Admin.user.edit', $usu) }}">Editar</a>
        				        </td>
        				        <td>
        				            {!! Form::open(['route'=>['Admin.user.destroy',$usu->id],'method'=>'DELETE']) !!}
        				            	<button type="submit" class="btn btn-danger">Eliminar Registro</button>
        				            {!! Form::close() !!}
        				        </td>
        				    </tr>
        				    @endforeach
        				</table>	
        				{!! $usuarios->setPath('')->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
