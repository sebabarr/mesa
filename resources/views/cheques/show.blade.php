@extends('home')

@section('contenido')

    <h1>Cheque</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Nrocheque</th><th>Importe</th><th>Id Banco</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cheque->id }}</td> <td> {{ $cheque->nrocheque }} </td><td> {{ $cheque->importe }} </td><td> {{ $cheque->id_banco }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection