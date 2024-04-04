@extends('layouts.app')

@section('css')
    <style>
        .cke_inner{border: 1px solid #e2e2e4 !important;border-radius: 4px !important;}
    </style>    
@endsection

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                   <li><a href="{{ url('company/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Settings</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
            
        {!! Form::open(['url' => 'settings/update', 'class' => 'form-horizontal', 'files' => true]) !!}

                <div class="row">            
                    <div class="col-lg-12">
                        <section class="panel">
                        <header class="panel-heading">Settings</header>
                            <div class="panel-body">
                                <div class="position-center">

                                    <div class="form-group {{ $errors->has('site_title') ? 'has-error' : ''}}">
                                        {!! Form::label('site_title', 'Name', ['class' => 'col-md-3 control-label required-input']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('site_title', settingValue('site_title'), ['class' => 'form-control','required' => 'required']) !!}
                                            {!! $errors->first('site_title', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                        {!! Form::label('address', 'Address', ['class' => 'col-md-3 control-label required-input']) !!}
                                        <div class="col-md-9">
                                            {!! Form::text('address', settingValue('address'), ['class' => 'form-control','required' => 'required']) !!}
                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        {!! Form::label('email', 'Default Email', ['class' => 'col-md-3 control-label required-input']) !!}
                                        <div class="col-md-9">
                                            {!! Form::email('email', settingValue('email'), ['class' => 'form-control','required' => 'required']) !!}
                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>                                                                                                        
                                     
                                    
                                     <div class="form-group {{ $errors->has('instructions') ? 'has-error' : ''}}">
                                        {!! Form::label('instructions', 'Instructions', ['class' => 'col-md-3 control-label required-input']) !!}
                                        <div class="col-md-9">
                                            {!! Form::textarea('instructions', settingValue('instructions'), ['class' => 'form-control ckeditor','required' => 'required']) !!}
                                            {!! $errors->first('instructions', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            {!! Form::submit('Update', ['class' => 'btn btn-info pull-right']) !!}
                                        </div>
                                    </div>

                                </div> 
                            </div>
                        </section>
                    </div>
                </div>

            {!! Form::close() !!}
            
    </section>
</section>
 
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        <!--     </section>     
</div> -->
 
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replace( 'instructions',{            
            removePlugins: 'elementspath,magicline',
            resize_enabled: false,
            allowedContent: true,
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_BR,
            toolbar: [
                [ 'Source','-','Bold','-','Italic','-','Underline'],
            ],
        });
    });
</script>
@endsection

