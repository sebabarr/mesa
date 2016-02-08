@extends('home')

@section('contenido')

    <h1>Cuits <a href="{{ url('cuits/create') }}" class="btn btn-primary pull-right btn-sm">Nuevo Cuit</a></h1>
    @if (Session::has('message'))
					<p class='alert alert-danger'>{{ Session::get('message') }}</p>
	@endif
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th><th>Razonsocial</th><th>Numero</th><th>Limite</th><th>Acciones</th>
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