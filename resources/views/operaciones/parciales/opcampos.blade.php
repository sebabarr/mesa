<div class="form-group">
	{!! Form::label('moneda','Moneda') !!}
	{!! Form::select('moneda',[''=>'Seleccione moneda','Real'=>'Real','Dolar'=>'Dolar','Euro'=>'Euro'],null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('movimiento','Moneda') !!}
	{!! Form::select('tipo_mov',[''=>'Seleccione movimiento','compra'=>'Compra','venta'=>'Venta',
								'aporte'=>'Aporte','retiro'=>'Retiro'],null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('comprador','Comprador') !!}
	{!! Form::text('comprador',null,['class'=>'form-control','placeholder'=>'Intrduzca su Nombre']) !!}
</div>
<div class="form-group">
	{!! Form::label('vendedor','Vendedor') !!}
	{!! Form::text('vendedor',null,['class'=>'form-control','placeholder'=>'Intrduzca su Nombre']) !!}
</div>
<div>
	{!! Form::label('cotizacion','Cotizacion') !!}
	{!! Form::input('number','cotizacion',null,['class'=>'form-control','step'=>"0.01",'min'=>"0.00",'max'=>'99999999.99',"id"=>"cot"]) !!}
</div>
<div>
	{!! Form::label('importe','Importe') !!}
	{!! Form::input('number','importe',null,['class'=>'form-control','step'=>"0.01","id"=>"imp" ]) !!}
</div>
