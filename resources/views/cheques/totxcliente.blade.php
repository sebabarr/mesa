@extends('home')

@section('contenido')

    <h1>Totales x Clientes</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nro.Cliente</th>
                        <td>Razon Social</td>
                        <th>Importe Total</th>
                        <th>Porcentaje Cartera</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totxclie as $item)
                        <tr>
                        <td>{{ $item->id_cliente }}</td>
                        <td></td>   
                        <td>{{ $item->total_cliente }}</td>
                        </tr>
                    @endforeach    
                </tbody>    
            </table>
        </div>
   
@endsection