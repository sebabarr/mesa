@extends('home')

@section('contenido')

    <h1>Banco</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Entidad</th><th>Codigo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $banco->id }}</td> <td> {{ $banco->entidad }} </td><td> {{ $banco->codigo }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection