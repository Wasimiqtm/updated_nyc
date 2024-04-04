@extends('admin.layouts.app')



@section('content')


<style>
    .cke_inner{border: #d4d4d4 1px solid;}
</style>

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/ride-requests') }}">Rider Requests</a></li>

                    <li class="active">Send Email</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

        {!! Form::open(['url' => 'admin/send-email-to-rider', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}

                <div class="row">            

                    <div class="col-lg-12">

                        <section class="panel">

                            <header class="panel-heading">Send Email to Rider</header>

                            <div class="panel-body">

                                <div class="form-group">
                                    {!! Form::label('charges_1', 'Extra Charges 1', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::number('charges_1', null, ['class' => 'form-control','min'=>0]) !!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('charges_2', 'Extra Charges 2', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::number('charges_2', null, ['class' => 'form-control','min'=>0]) !!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('charges_3', 'Extra Charges 3', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::number('charges_3', null, ['class' => 'form-control','min'=>0]) !!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('charges_4', 'Extra Charges 4', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::number('charges_4', null, ['class' => 'form-control','min'=>0]) !!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('charges_5', 'Extra Charges 5', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::number('charges_5', null, ['class' => 'form-control','min'=>0]) !!}                                        
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                    {!! Form::label('status', 'Status', ['class' => 'col-md-3 control-label']) !!}
                                    <div class="col-md-4">
                                        {!! Form::select('status', ['pending'=>'Pending', 'accepted'=>'Accepted', 'rejected'=>'Rejected'], @$ride->status, ['class' => 'form-control']) !!}                                        
                                    </div>
                                </div>

                                <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                                  <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                                    {!! Form::label('email', 'Email Body', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::textarea('email', $email_body, ['class' => 'form-control','required' => 'required','rows' => '10']) !!}
                                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>

                                  <div class="form-group">

                                        <div class="col-lg-offset-2 col-lg-10">

                                            {!! Form::submit('Send Email', ['class' => 'btn btn-info pull-right']) !!}

                                        </div>

                                    </div>

                            </div>

                        </section>



                    </div>

                    

                </div>



                {!! Form::close() !!}

            

    </section>

</section>





@endsection


@section('scripts')
<script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
<script>

    $("document").ready(function () {

        CKEDITOR.replace( 'email',{            
            removePlugins: 'elementspath,magicline',
            resize_enabled: false,
            allowedContent: true,
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_BR,
            height: 400,
            toolbar: [
                [ 'Source','-','Underline','Bold','Italic','-','TextColor', 'BGColor','Table','-','Styles','-', 'Format', 'Font', 'FontSize','-'],
            ],
        });

    }); //..... end of ready() .....//

</script>
@endsection







