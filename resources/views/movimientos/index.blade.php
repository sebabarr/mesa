
@extends('home')
@section('contenido')
    <div class='col-md-4'>
        <h1>Movimientos</h1>
    </div>    
    <div class="col-md-4">    
        <h2><a>Saldo: </a><a>{{ $saldo }}</a></h2>
    </div>    
    <div class="col-md-4">
        <a href="{{ url('movimientos/create') }}" class="btn btn-primary pull-right btn-sm">Add New Movimiento</a></h1>
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Concepto Id</th>
                    <th>Comentario</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Operacion id</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($movimientos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('movimientos', $item->id) }}">{{ $item->conceptos->concepto }}</a></td>
                    <td>{{ $item->comentario }}</td>
                    <td>{{ $item->importe }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->operacion_id }}</td>
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
        <div class="pagination"> {!! $movimientos->setPath('')->render() !!} </div>
    </div>

@endsection

