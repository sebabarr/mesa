
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
                <tr>
                    
                @foreach($movimientos as $item)
                
                <td><a href="{{ url('movimientos', $item->id) }}">{{ $item->id }}</a></td><td>{{ $item->comentario }}</td><td>{{ $item->importe }}</td>
                {{ $item->id }}
                {{ $item->importe}}
                @endforeach
                </tr>
            </tbody>
        </table>
  
    </div>



@endsection