@extends('admin.layouts.app')



@section('content')



<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                   <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/makes') }}">Make</a></li>

                    <li class="active">Create Make</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::open(['url' => 'admin/makes', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}



                @include ('admin.makes.form')



            {!! Form::close() !!}

            

    </section>

</section>





@endsection