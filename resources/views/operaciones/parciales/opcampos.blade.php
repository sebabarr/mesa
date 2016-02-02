<div class="form-group">
	{!! Form::label('moneda','Moneda') !!}
	{!! Form::select('moneda',[''=>'Seleccione moneda','Real'=>'Real','Dolar'=>'Dolar','Euro'=>'Euro'],null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('movimiento','Tipo de Mov') !!}
	{!! Form::select('tipo_mov',[''=>'Seleccione movimiento','compra'=>'Compra','venta'=>'Venta',
								'aporte'=>'Aporte','retiro'=>'Retiro'],null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('contraparte','Contraparte') !!}
	{!! Form::select('cliente_id',$cliente,Input::old('cliente_id'),['class'=>'form-control','placeholder'=>'Seleccione Nombre']) !!}
</div>

<div>
	{!! Form::label('cotizacion','Cotizacion') !!}
	{!! Form::input('number','cotizacion',null,['class'=>'form-control','step'=>"0.01",'min'=>"0.00",'max'=>'99999999.99',"id"=>"cot"]) !!}
</div>
<div>
	{!! Form::label('cantidad','Cantidad') !!}
	{!! Form::input('number','cantidad',null,['class'=>'form-control','step'=>"0.01","id"=>"can" ]) !!}
</div>
