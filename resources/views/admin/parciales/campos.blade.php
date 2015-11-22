
							<div class="form-group">
								{!! Form::label('name','Nombre Completo') !!}
								{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Intrduzca su Nombre']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('email','Correo Electronico') !!}
								{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Intrduzca su email']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('password','Contraseña') !!}
								{!! Form::password('Contraseña',['class'=>'form-control','placeholder'=>'Contraseña']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('type','Tipo Usuario') !!}
								{!! Form::select('type',[''=>'Seleccione Tipo','user'=>'Usuario','admin'=>'Administrador'],null,['class'=>'form-control']) !!}
							</div>
								
						