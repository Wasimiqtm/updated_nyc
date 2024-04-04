

<div class="row">            
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ isset($submitButtonText) ? $submitButtonText : 'Create' }} Model</header>
            <div class="panel-body">
                <div class="position-center">                                                                            
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('make_id', 'Make Name', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {!! Form::select('make_id', $makes,null, ['class' => 'form-control select2','placeholder'=>'Select Make Name','required' => 'required']) !!}
                        {!! $errors->first('make_id', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>                                

                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Model Name','required' => 'required']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-info pull-right']) !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>

