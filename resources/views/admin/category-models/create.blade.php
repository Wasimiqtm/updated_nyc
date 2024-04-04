@extends('admin.layouts.app')



@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                   <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ url('admin/categories') }}"> Categories</a></li>
                    <li><a href="{{ url('admin/category-models/'.$encoded_id) }}"> Category Models</a></li>
                    <li class="active">Create Category Model</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                

            {!! Form::open(['url' => 'admin/category-models/'.$encoded_id, 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}

                <div class="row">            
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">Add Category Model</header>
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
                                      {!! Form::select('model_id', [],null, ['class' => 'form-control select2 model_id','placeholder'=>'Select Model','required' => 'required']) !!}
                                      {!! $errors->first('model_id', '<p class="help-block">:message</p>') !!}
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

            {!! Form::close() !!}
    </section>
</section>

@endsection

@section('scripts')



<script>

    $("document").ready(function () {

        $(document).on("change",".make_id",function(){
            $('.model_id').val(null).trigger('change');
            var id = $(this).val();
            var el = $("#select2-model_id-container");
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
                       }else{
                            $('.model_id').val(null).trigger('change');
                       }
                       
                        el.LoadingOverlay("hide"); 
                  },
                    error: function (request, status, error) {
                       el.LoadingOverlay("hide"); 
                    } 
                  });
            }else{
                $('.model_id').val(null).trigger('change');
            }
        

        });

    }); //..... end of ready() .....//

</script>



@endsection