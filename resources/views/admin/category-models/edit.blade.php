@extends('admin.layouts.app')



@section('content')



<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/categories') }}">Category</a></li>

                    <li class="active">Update Category</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::model($category, [

                    'method' => 'PATCH',

                    'url' => ['admin/categories', Hashids::encode($category->id)],

                    'class' => 'form-horizontal',

                    'data-toggle' => 'validator',

                    'data-disable' => 'false',

                    'files' => true

                ]) !!}



                @include ('admin.categories.form', ['submitButtonText' => 'Update'])



                {!! Form::close() !!}

            

    </section>

</section>





@endsection



@section('scripts')



<script>

    $("document").ready(function () {

        $("#select2-make_id-container").LoadingOverlay("show");
        setTimeout(function(){ 
            $('.make_id').val({{ @$category->model->make_id }}).trigger('change');
            $("#select2-make_id-container").LoadingOverlay("hide");
        }, 1000);


        

        $(document).on("change",".make_id",function(){
        
            var id = $(this).val();
            var el = $("#select2-model_id-container");
            $('.model_id').val(null).trigger('change');
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
                            $('.model_id').val({{ @$category->model_id }}).trigger('change');     
                            el.LoadingOverlay("hide");           
                        }, 1000);
                       }else{
                            $('.model_id').val(null).trigger('change');
                            el.LoadingOverlay("hide");
                       }
                       
                       
              
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