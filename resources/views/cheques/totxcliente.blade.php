@extends('home')

@section('contenido')

    <div class="row">
        <div class="col-md-4">Totales x Clientes</div>
        <div class="col-md-4">{{ $totalcartera }}</div>
        <div class="col-md-4">.col-md-4</div>
    </div>
           
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
                        <td>{{ $item->razonsocial }}</td>   
                        <td>$ {{ number_format($item->total_cliente, 2, '.',',') }}</td>
                        <td>{{ number_format($item->por_cartera,2) }}%</td>
                        </tr>
                    @endforeach    
                </tbody>    
            </table>
        </div>
   
@endsection