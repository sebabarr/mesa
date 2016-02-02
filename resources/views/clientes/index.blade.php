
@extends('home')

@section('contenido')

    <h1>Clientes <a href="{{ url('clientes/create') }}" class="btn btn-primary pull-right btn-sm">Add New Cliente</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Razonsocial</th><th>Direccion</th><th>Telefono</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($clientes as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('clientes', $item->id) }}">{{ $item->razonsocial }}</a></td><td>{{ $item->direccion }}</td><td>{{ $item->telefono }}</td>
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
