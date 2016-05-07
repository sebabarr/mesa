    <div class="form-group {{ $errors->has('razonsocial') ? 'has-error' : ''}}">
        {!! Form::label('razonsocial', 'Razonsocial: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('razonsocial', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('razonsocial', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
        {!! Form::label('direccion', 'Direccion: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
            {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
        {!! Form::label('telefono', 'Telefono: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
            {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
        {!! Form::label('cui', 'Cuit: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('cuit', null, ['class' => 'form-control']) !!}
            {!! $errors->first('cuit', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('limite_chp') ? 'has-error' : ''}}">
        {!! Form::label('limite_chp', 'Limite Chp: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('limite_chp', null, ['class' => 'form-control','step'=>"0.01"]) !!}
            {!! $errors->first('limite_chp', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('limite_cht') ? 'has-error' : ''}}">
        {!! Form::label('limite_cht', 'Limite Cht: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('limite_cht', null, ['class' => 'form-control','step'=>"0.01"]) !!}
            {!! $errors->first('limite_cht', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('tasa_desc') ? 'has-error' : ''}}">
        {!! Form::label('tasa_desc', 'Tasa Desc: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('tasa_desc', null, ['class' => 'form-control','step'=>"0.01"]) !!}
            {!! $errors->first('tasa_desc', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('tasa_gasto') ? 'has-error' : ''}}">
        {!! Form::label('tasa_gasto', 'Tasa Gasto: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('tasa_gasto', null, ['class' => 'form-control','step'=>"0.01"]) !!}
            {!! $errors->first('tasa_gasto', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('gasto_fijo') ? 'has-error' : ''}}">
        {!! Form::label('gasto_fijo', 'Gasto Fijo: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::input('number','gasto_fijo', null, ['class' => 'form-control','step'=>"0.01"]) !!}
            {!! $errors->first('gasto_fijo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
