
@extends('home')

@section('contenido')

    <h1>Movimientos <a href="{{ url('movimientos/create') }}" class="btn btn-primary pull-right btn-sm">Add New Movimiento</a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Concepto Id</th><th>Comentario</th><th>Importe</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($movimientos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('movimientos', $item->id) }}">{{ $item->conceptos->concepto }}</a></td><td>{{ $item->comentario }}</td><td>{{ $item->importe }}</td>
                    <td>
                        <a href="{{ url('movimientos/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Update</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['movimientos', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $movimientos->render() !!} </div>
    </div>

@endsection
