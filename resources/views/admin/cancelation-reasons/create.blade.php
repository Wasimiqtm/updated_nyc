@extends('admin.layouts.app')



@section('content')



<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                   <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                    <li><a href="{{ url('admin/cancelation-reasons') }}">Cancelation Reasons</a></li>

                    <li class="active">Create Cancelation Reason</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::open(['url' => 'admin/cancelation-reasons', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}



                @include ('admin.cancelation-reasons.form')



            {!! Form::close() !!}

            

    </section>

</section>





@endsection