
@extends('home')

@section('contenido')
    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['action'=>'ChequesController@buscarcheque','method'=>'GET','class'=>'navbar-form','role'=>'search']) !!}	
            <div class="form-group">
            	{!! Form::number('numche',null,['class'=>'form-control', 'placeholder'=>'Nro. de cheque']) !!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}
        </div>
        <div class="col-md-5">
            {!! Form::open(['action'=>'ChequesController@buscarcheque','method'=>'GET','class'=>'navbar-form','role'=>'search']) !!}	
            <div class="form-group">
            	{!! Form::date('fechadesde',null,['class'=>'form-control', 'placeholder'=>'Desde']) !!}
            	{!! Form::date('fechahasta',null,['class'=>'form-control', 'placeholder'=>'Hasta']) !!}
            </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}    
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
                    <th>Estado</th>
                    <th>Tomador</th>
                    
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
                    <td>{{ $item->estado }}</td>
                   <td>{{ $item->cheque_ven['id_tomador'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
       
    </div>

@endsection
