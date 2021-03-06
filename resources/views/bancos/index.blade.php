
@extends('home')

@section('contenido')
    <div class="row">
        
        <div class="col-md-4">
            <h1>Bancos <a href="{{ url('bancos/create') }}" class="btn btn-primary pull-right btn-md">Nuevo Banco</a></h1>
            @if (Session::has('message'))
        		<p class='alert alert-danger'>{{ Session::get('message') }}</p>
        	@endif
        </div>
        
        <div class="col-md-8">
            <ul class="list-inline">
                <li>
                    {!! Form::open(['route'=>'bancos.index','method'=>'GET','class'=>'navbar-form','role'=>'search']) !!}	
                      	<div class="form-group">
                        	{!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Cliente a Buscar']) !!}
                	  	</div>
                	  	<button type="submit" class="btn btn-default">Buscar</button>
                    {!! Form::close() !!}
                </li>
                <li>
                    <a href="{{ url('bancos/imprimir') }}" class="btn btn-primary">Imprimir</a>
                </li>
            </ul>
        </div>
        
	</div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Entidad</th><th>Codigo</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($bancos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('bancos', $item->id) }}">{{ $item->entidad }}</a></td><td>{{ $item->codigo }}</td>
                    <td>
                        <a href="{{ url('bancos/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['bancos', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $bancos->render() !!} </div>
    </div>

@endsection
