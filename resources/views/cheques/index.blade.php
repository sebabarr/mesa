
@extends('home')

@section('contenido')
    <div class="row"></div>
    
        
        <div class="col-md-3">
            <h3>Total Cartera: $ {{ number_format($tot_cartera, 2, ",", ".") }}</h3>
        </div>
        <div class="col-md-4">
            <h3>Total Vendidos: $ {{ number_format($tot_cartera, 2, ",", ".") }}</h3>
        </div>
        <div class="col-md-4">
            <a href="{{ url('cheques/create') }}" class="btn btn-primary pull-right btn-sm">Comprar Cheque</a>
        </div>    
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Nrocheque</th>
                    <th>Importe</th>
                    <th>F.de Vto</th>
                    <th>Cuit</th>
                    <th>cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($cheques as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td><a href="{{ url('cheques', $item->id) }}">{{ $item->nrocheque }}</a></td>
                    <td>{{ $item->importe }}</td>
                    <td>{{ $item->fechavto }}</td>
                    <td>{{ $item->cuits->razonsocial }}</td>
                    <td>{{ $item->clientes->razonsocial }}</td>
                    <td>
                        <a href="{{ url('cheques/' . $item->id . '/edit') }}">
                            <button type="submit" class="btn btn-primary btn-xs">Modificar</button>
                        </a> /
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['cheques', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                        <a href="{{ url('cheques/' . $item->id . '/venta') }}"> 
                            <button type="submit" class="btn btn-primary btn-xs">Vender</button>
                        </a>
                        <a href="{{ url('cheques/' . $item->id . '/imprimircesion') }}"> 
                            <button type="submit" class="btn btn-primary btn-xs">Cesion</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination"> {!! $cheques->render() !!} </div>
    </div>

@endsection
