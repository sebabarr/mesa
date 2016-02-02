                <div class="form-group {{ $errors->has('concepto') ? 'has-error' : ''}}">
                {!! Form::label('concepto', 'Concepto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('concepto', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('concepto', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('signo') ? 'has-error' : ''}}">
                {!! Form::label('signo', 'Signo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('signo', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('signo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
