@extends('home')

@section('contenido')
<div class='container'>    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                   
                    <th>Nrocheque</th>
                    
                    <th>F.de Vto</th>
                    <th>Cuit</th>
                    <th>cliente</th>
                    <th>Estado</th>
                    <th>Tomador</th>
                    
                </tr>
            </thead>
            
            <tbody>
                
                <tr>
                    <td>    
                        {!! Form::number('numero', null, ['class' => 'form-control',"placeholder"=>"000000",'id'=>'numche']) !!}
                    </td> 
                    <td>    
                        {!! Form::date('fecvto', null, ['class' => 'form-control','id'=>'fecvto']) !!}
                    </td>
                    <td>    
                        {!! Form::text('cuit', null, ['class' => 'form-control','id'=>'ncuit','placeholder'=>'000000000000']) !!}
                    </td>
                    <td>    
                        {!! Form::select('id_cliente', $clientes,Input::old('id_cliente'), ['class' => 'form-control']) !!}
                    </td>
                </tr>
                
            </tbody>
        </table>
       
    </div>
</div>
@endsection
