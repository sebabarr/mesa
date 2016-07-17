@extends('home')

@section('contenido')

    <div class="row">
        <div class="col-md-6">Totales x Cuit</div>
        <div class="col-md-4">{{ $totalcartera }}</div>
        
    </div>
           
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nro.Cuit</th>
                        <td>Razon Social</td>
                        <th>Imp.Cartera + Vendidos</th>
                       
                        <th>% Cartera</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totxcuit as $item)
                        <tr>
                        <td>{{ $item->numcuit }}</td>
                        <td>{{ $item->razonsocial }}</td>   
                        <td>$ {{ number_format($item->total_cuit, 2, '.',',') }}</td>
                        
                        <td>{{ number_format($item->por_cart,2) }}%</td>
                        </tr>
                    @endforeach    
                </tbody>    
            </table>
        </div>
   
@endsection