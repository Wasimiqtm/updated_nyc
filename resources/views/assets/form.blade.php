
<div class="row">            
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ isset($submitButtonText) ? $submitButtonText : 'Create' }} Company Asset</header>
            <div class="panel-body">
                <div class="position-center">                                                                            
                    
                    <input type="hidden" name="current_fees" id="current_fees" value="0" >

                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Asset Name', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Asset Name','required' => 'required']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>                                

                  <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                    {!! Form::label('price', 'Asset Cost', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('price', null, ['class' => 'form-control','placeholder'=>'Asset Cost']) !!}
                        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::textarea('description', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Description']) !!}
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                 <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">                     
                        {!! Form::label('image', 'Image', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if(@$asset->image != '')
                                    <img src="{{ checkImage('assets/'. $asset->image) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif

                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="image" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
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
