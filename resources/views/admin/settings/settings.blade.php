@extends('admin.layouts.app')



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

                   <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li class="active">Settings</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

            

        {!! Form::open(['url' => 'admin/settings/update', 'class' => 'form-horizontal', 'files' => true]) !!}



                <div class="row">            

                    <div class="col-lg-12">

                        <section class="panel">

                        <header class="panel-heading">Settings</header>

                            <div class="panel-body">

                                <div class="position-center">



                                    <div class="form-group {{ $errors->has('site_title') ? 'has-error' : ''}}">

                                        {!! Form::label('site_title', 'Name', ['class' => 'col-md-4 control-label required-input']) !!}

                                        <div class="col-md-8">

                                            {!! Form::text('site_title', settingValue('site_title'), ['class' => 'form-control','required' => 'required']) !!}

                                            {!! $errors->first('site_title', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>

                                    <div class="form-group {{ $errors->has('radius') ? 'has-error' : ''}}">

                                        {!! Form::label('radius', 'Radius', ['class' => 'col-md-4 control-label required-input']) !!}

                                        <div class="col-md-8">

                                            {!! Form::number('radius', settingValue('radius'), ['class' => 'form-control','required' => 'required','min'=>0]) !!}

                                            {!! $errors->first('radius', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>

                                    <div class="form-group {{ $errors->has('cancelation_period') ? 'has-error' : ''}}">

                                        {!! Form::label('cancelation_period', 'Cancelation Period', ['class' => 'col-md-4 control-label required-input']) !!}

                                        <div class="col-md-8">

                                            {!! Form::number('cancelation_period', settingValue('cancelation_period'), ['class' => 'form-control','required' => 'required','min'=>0,'step'=>"0.001"]) !!}

                                            {!! $errors->first('cancelation_period', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
 
                                    </div>


                                    <div class="form-group {{ $errors->has('default_tip') ? 'has-error' : ''}}">
                                        {!! Form::label('default_tip', 'Default Tip', ['class' => 'col-md-4 control-label required-input']) !!}
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button">$</button>
                                                </span>
                                                {!! Form::number('default_tip', settingValue('default_tip'), ['class' => 'form-control','required' => 'required','min'=>0,'step'=>"0.001"]) !!}
                                            </div>    
                                            {!! $errors->first('default_tip', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('driver_commission') ? 'has-error' : ''}}">
                                        {!! Form::label('driver_commission', 'Driver Commission', ['class' => 'col-md-4 control-label required-input']) !!}
                                        <div class="col-md-8">
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">%</button>
                                            </span>
                                            {!! Form::number('driver_commission', settingValue('driver_commission'), ['class' => 'form-control','required' => 'required','min'=>0,'max'=>100,'step'=>"0.001"]) !!}
                                        </div>
                                            {!! $errors->first('driver_commission', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">

                                        {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label required-input']) !!}

                                        <div class="col-md-8">

                                            {!! Form::text('address', settingValue('address'), ['class' => 'form-control','required' => 'required']) !!}

                                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>



                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">

                                        {!! Form::label('email', 'Default Email', ['class' => 'col-md-4 control-label required-input']) !!}

                                        <div class="col-md-8">

                                            {!! Form::email('email', settingValue('email'), ['class' => 'form-control','required' => 'required']) !!}

                                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                            <div class="help-block with-errors"></div>
                                        </div>

                                    </div>                                                                                                        

                                     

                                    

                                     <!-- <div class="form-group {{ $errors->has('instructions') ? 'has-error' : ''}}">

                                        {!! Form::label('instructions', 'Instructions', ['class' => 'col-md-3 control-label required-input']) !!}

                                        <div class="col-md-9">

                                            {!! Form::textarea('instructions', settingValue('instructions'), ['class' => 'form-control ckeditor','required' => 'required']) !!}

                                            {!! $errors->first('instructions', '<p class="help-block">:message</p>') !!}

                                        </div>

                                    </div> -->



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



