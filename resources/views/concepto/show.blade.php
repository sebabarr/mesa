@extends('home')

@section('contenido')

    <h1>Concepto</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Concepto</th><th>Signo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $concepto->id }}</td> <td> {{ $concepto->concepto }} </td><td> {{ $concepto->signo }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection