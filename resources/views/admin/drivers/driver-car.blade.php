@extends('admin.layouts.app')



@section('content')



<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/drivers') }}">Drivers</a></li>

                    <li class="active">Update Driver Car</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::model($driver, [

                    'method' => 'POST',

                    'url' => ['admin/driver-car', Hashids::encode($driver->id)],

                    'class' => 'form-horizontal',

                    'data-toggle' => 'validator',

                    'data-disable' => 'false',

                    'files' => true

                ]) !!}



                

                <div class="row">            

                    <div class="col-lg-12">

                        <section class="panel">

                            <header class="panel-heading">Driver Car</header>

                            <div class="panel-body">

                                <div class="position-center">                       

                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    {!! Form::label('make_id', 'Make Name', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::select('make_id', $makes, null, ['class' => 'form-control select2 make_id','placeholder'=>'Select Make','required' => 'required']) !!}
                                        {!! $errors->first('make_id', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    {!! Form::label('model_id', 'Model Name', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::select('model_id', [], null, ['class' => 'form-control select2 model_id','placeholder'=>'Select Model','required' => 'required']) !!}
                                        {!! $errors->first('model_id', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div> 

                                  <div class="form-group {{ $errors->has('registration_number') ? 'has-error' : ''}}">

                                    {!! Form::label('registration_number', 'Registration Number', ['class' => 'col-md-3 control-label required-input']) !!}

                                    <div class="col-md-9">

                                        {!! Form::text('registration_number', @$driver->driver_car->registration_number, ['class' => 'form-control','placeholder'=>'Registration Number','required' => 'required']) !!}

                                        {!! $errors->first('registration_number', '<p class="help-block">:message</p>') !!}

                                        <div class="help-block with-errors"></div>

                                    </div>

                                  </div>                                

                                  <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">
                                    {!! Form::label('year', 'Year', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::text('year', @$driver->driver_car->year, ['class' => 'form-control','placeholder'=>'Year','required' => 'required']) !!}
                                        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
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





@endsection


@section('scripts')



<script>

    $("document").ready(function () {

        $("#select2-make_id-container").LoadingOverlay("show");
        setTimeout(function(){ 
            
            @if(@$driver->driver_car->category_model->model)
                $('.make_id').val({{ @$driver->driver_car->category_model->model->make_id }}).trigger('change');
            @endif
                
            $("#select2-make_id-container").LoadingOverlay("hide");
        }, 1000);


        

        $(document).on("change",".make_id",function(){
        
            var id = $(this).val();
            var el = $(".select2-selection");
            $('.model_id').empty().trigger('change');
            if(id!=""){
                el.LoadingOverlay("show");
                $.ajax({
                  type: 'get',
                  url: '{{ url("admin/get-make-models") }}'+'/'+id,
                  dataType: "json",
                  success:function (res) {
                       var result = res.result;
                       if(result.status){
                        $.each(result.models, function(id,name){
                            var newOption = new Option(name, id, false, false);
                            $('.model_id').append(newOption);
                        });

                        setTimeout(function(){

                            @if($driver->driver_car)
                            $('.model_id').val({{ @$driver->driver_car->category_model->model_id }}).trigger('change'); 
                            @endif

                            el.LoadingOverlay("hide");           
                        }, 1000);
                       }else{
                            $('.model_id').empty().trigger('change');
                            el.LoadingOverlay("hide");
                       }
                  },
                    error: function (request, status, error) {
                      el.LoadingOverlay("hide");                         
                    } 
                  });
            }
        

        });

    }); //..... end of ready() .....//

</script>



@endsection

