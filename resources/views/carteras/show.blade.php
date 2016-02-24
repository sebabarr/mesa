@extends('home')

@section('contenido')

    <h1>Cartera</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cartera->id }}</td> <td> {{ $cartera->nombre }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection