

<div class="row">            

    <div class="col-lg-12">

        <section class="panel">

            <header class="panel-heading">{{ isset($submitButtonText) ? $submitButtonText : 'Create' }} Cancelation Reason</header>

            <div class="panel-body">

                <div class="position-center">                                                                            

                    <div class="form-group {{ $errors->has('reason') ? 'has-error' : ''}}">

                    {!! Form::label('reason', 'Cancelation Reason', ['class' => 'col-md-4 control-label required-input']) !!}

                    <div class="col-md-8">

                        {!! Form::text('reason', null, ['class' => 'form-control','placeholder'=>'Cancelation Reason','required' => 'required']) !!}

                        {!! $errors->first('reason', '<p class="help-block">:message</p>') !!}

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

