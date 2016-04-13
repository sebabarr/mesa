@extends('home')

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <h1>Cuits <a href="{{ url('cuits/create') }}" class="btn btn-primary pull-right btn-sm">Nuevo Cuit</a></h1>
        </div>
        
    </div>	
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>
                        <div class="row">
                            <div class="col-md-2">
                                Razonsocial:
                            </div>
                            <div class="col-md-4">                        
                                {!! Form::open(['route'=>'cuits.index','method'=>'GET']) !!}	
                    	    	{!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Cuit a Buscar']) !!}
                    	    </div>
                    	    <div class="col-md-1">
                    	        <input type="hidden" name="numero" value="off"/>
                    	    	<button type="submit" class="btn btn-default">Buscar</button>
                    	        {!! Form::close() !!}
                	        </div>
            	        </div>
            	    </th>
        	        <th>
        	            <div class="row">
                            <div class="col-md-2">
                                Cuit:
                            </div>
                            <div class="col-md-4">                        
                                {!! Form::open(['route'=>'cuits.index','method'=>'GET']) !!}	
                    	    	{!! Form::text('nume',null,['class'=>'form-control', 'placeholder'=>'Nro.Cuit a Buscar']) !!}
                    	    </div>
                    	    <div class="col-md-1">
                    	        <input type="hidden" name="numero" value="on"/>
                    	    	<button type="submit" class="btn btn-default">Buscar</button>
                    	        {!! Form::close() !!}
                	        </div>
            	        </div>    
        	        </th>
        	        <th>Limite</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($cuits as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('cuits', $item->id) }}">{{ $item->razonsocial }}</a></td><td>{{ $item->numero }}</td><td>{{ $item->limite }}</td>
                    <td>
                        <a href="{{ url('cuits/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Modificar</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['cuits', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $cuits->render() !!} </div>
    </div>

@endsection
