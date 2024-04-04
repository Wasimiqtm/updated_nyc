@extends('admin.layouts.app')



@section('content')



<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/drivers') }}">Riders</a></li>

                    <li class="active">Send Message</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

        {!! Form::open(['url' => 'admin/send-message-to-riders', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}

                <!-- @if(Session::has('invalid_numbers'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('invalid_numbers') }}</div>
                @endif -->

                <div class="row">            

                    <div class="col-lg-12">

                        <section class="panel">

                            <header class="panel-heading">Send Message to Riders</header>

                            <div class="panel-body">

                                <div class="position-center">                     

                                  <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        {!! Form::checkbox('send_all',1,null,['id'=>'send_all']) !!}
                                        {!! Form::label('send_all', 'Select All Riders', ['class' => 'control-label']) !!}                                    
                                    </div>
                                  </div>  
                                                                                           
                                  <div class="form-group {{ $errors->has('rider_id') ? 'has-error' : ''}}">
                                    {!! Form::label('rider_id', 'Select Rider', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::select('rider_id[]', $riders,null, ['class' => 'form-control select2','required' => 'required','multiple' => 'multiple']) !!}
                                        {!! $errors->first('rider_id', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>                                  

                                  <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                                    {!! Form::label('message', 'Message', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::textarea('message', null, ['class' => 'form-control','required' => 'required','rows' => '5']) !!}
                                        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>

                                  <div class="form-group">

                                        <div class="col-lg-offset-2 col-lg-10">

                                            {!! Form::submit('Send Message', ['class' => 'btn btn-info pull-right']) !!}

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





@endsection


@section('scripts')
<script>

    $("document").ready(function () {

        $("#send_all").click(function(){
            if($("#send_all").is(':checked') ){
                $('.select2').select2('destroy').find('option').prop('selected', 'selected').end().select2();

            }else{
                $('.select2').select2('destroy').find('option').prop('selected', false).end().select2();
             }
        });
    }); //..... end of ready() .....//

</script>
@endsection







