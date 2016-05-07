
@extends('home')

@section('contenido')
    
    <div class="row">
        <div class="col-md-4">
            <h1>Clientes <a href="{{ url('clientes/create') }}" class="btn btn-primary pull-right btn-sm">Nuevo Cliente</a></h1>
            @if (Session::has('message'))
        					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
        	@endif
        </div>
        <div class="col-md-4">
        	{!! Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}	
              	<div class="form-group">
                	{!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Cliente a Buscar']) !!}
        	  	</div>
        	  	<button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}
        </div>    
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Razonsocial</th><th>Direccion</th><th>Telefono</th><th>Cuit</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($clientes as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('clientes', $item->id) }}">{{ $item->razonsocial }}</a></td>
                    <td>{{ $item->direccion }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->cuit }}</td>
                    <td>
                        <a href="{{ url('clientes/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['clientes', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $clientes->render() !!} </div>
    </div>

@endsection
