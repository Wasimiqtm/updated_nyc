

<div class="row">            

    <div class="col-lg-12">

        <section class="panel">

            <header class="panel-heading">{{ isset($submitButtonText) ? $submitButtonText : 'Create' }} Make</header>

            <div class="panel-body">

                <div class="position-center">                                                                            
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">

                    {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label required-input']) !!}

                    <div class="col-md-9">

                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Name','required' => 'required']) !!}

                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}

                        <div class="help-block with-errors"></div>

                    </div>

                  </div>                                

                  <div class="form-group {{ $errors->has('nys_driver_license') ? 'has-error' : ''}}">                     
                    {!! Form::label('nys_driver_license', 'NYS Driver License', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$driver->nys_driver_license != '')
                                    <img src="{{ checkImage('users/'. $driver->nys_driver_license) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="nys_driver_license" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('nys_driver_license', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>

                <div class="form-group {{ $errors->has('tlc_license') ? 'has-error' : ''}}">                     
                    {!! Form::label('tlc_license', 'TLC License', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$driver->tlc_license != '')
                                    <img src="{{ checkImage('users/'. $driver->tlc_license) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="tlc_license" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('tlc_license', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div> 

                <div class="form-group {{ $errors->has('car_registration') ? 'has-error' : ''}}">                     
                    {!! Form::label('car_registration', 'Car Registration', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$driver->car_registration != '')
                                    <img src="{{ checkImage('users/'. $driver->car_registration) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="car_registration" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('car_registration', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>   

                <div class="form-group {{ $errors->has('insurance_certificate_of_liability') ? 'has-error' : ''}}">                     
                    {!! Form::label('insurance_certificate_of_liability', 'Insurance Certificate Of Liability', ['class' => 'col-lg-3 col-sm-3 control-label','style'=>'width: 235px;margin-left: -80px;']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$driver->insurance_certificate_of_liability != '')
                                    <img src="{{ checkImage('users/'. $driver->insurance_certificate_of_liability) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="insurance_certificate_of_liability" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('insurance_certificate_of_liability', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>   

                <div class="form-group {{ $errors->has('insurance_declaration_page') ? 'has-error' : ''}}">                     
                    {!! Form::label('insurance_declaration_page', 'Insurance Declaration Page', ['class' => 'col-lg-3 col-sm-3 control-label','style'=>'width: 235px;margin-left: -80px;']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$driver->insurance_declaration_page != '')
                                    <img src="{{ checkImage('users/'. $driver->insurance_declaration_page) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="insurance_declaration_page" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('insurance_declaration_page', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>   

                  <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

                    {!! Form::label('status', 'Status', ['class' => 'col-md-3 control-label required-input']) !!}

                    <div class="col-md-9">

                        {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'],null, ['class' => 'form-control select2','placeholder'=>'Status','required' => 'required']) !!}

                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}

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

