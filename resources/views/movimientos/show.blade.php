@extends('home')

@section('contenido')

    <h1>Movimiento</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Concepto Id</th><th>Comentario</th><th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $movimiento->id }}</td> <td> {{ $movimiento->concepto_id }} </td><td> {{ $movimiento->comentario }} </td><td> {{ $movimiento->importe }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection