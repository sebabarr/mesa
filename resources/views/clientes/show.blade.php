@extends('home')

@section('contenido')

    <h1>Cliente</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> 
                    <th>Razonsocial</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Cuit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td> {{ $cliente->razonsocial }} </td>
                    <td> {{ $cliente->direccion }} </td>
                    <td> {{ $cliente->telefono }} </td>
                    <td> {{ $cliente->cuit}}</td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection