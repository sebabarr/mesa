@extends('home')

@section('contenido')

    <h1>Cuit</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Razonsocial</th><th>Numero</th><th>Limite</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cuit->id }}</td> <td> {{ $cuit->razonsocial }} </td><td> {{ $cuit->numero }} </td><td> {{ $cuit->limite }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection