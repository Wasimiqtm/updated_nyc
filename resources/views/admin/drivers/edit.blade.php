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

                    <li class="active">Update Driver</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::model($driver, [

                    'method' => 'PATCH',

                    'url' => ['admin/drivers', Hashids::encode($driver->id)],

                    'class' => 'form-horizontal',

                    'data-toggle' => 'validator',

                    'data-disable' => 'false',

                    'files' => true

                ]) !!}



                @include ('admin.drivers.form', ['submitButtonText' => 'Update'])



                {!! Form::close() !!}

            

    </section>

</section>





@endsection



