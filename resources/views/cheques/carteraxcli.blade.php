@extends('home')

@section('contenido')
<div class='container'>    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                </tr>
            </thead>
            
            <tbody>
                
                <tr>
                    {!! Form::open(['action'=>'ChequesController@CarxCli','method'=>'GET']) !!}	
                    <td>    
                        {!! Form::select('id_cliente', $clientes,Input::old('id_cliente'), ['class' => 'form-control']) !!}
                    </td>
                    <td>
                        
	 	  				{!! Form::submit('Buscar') !!}
    					{!! Form::close() !!}
                    </td>>
                </tr>
                
            </tbody>
        </table>
       
    </div>
</div>
@endsection
