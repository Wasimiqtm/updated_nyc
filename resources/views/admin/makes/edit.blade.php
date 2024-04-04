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

                    <li class="active">Update Make</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

            {!! Form::model($make, [

                    'method' => 'PATCH',

                    'url' => ['admin/makes', Hashids::encode($make->id)],

                    'class' => 'form-horizontal',

                    'data-toggle' => 'validator',

                    'data-disable' => 'false',

                    'files' => true

                ]) !!}



                @include ('admin.makes.form', ['submitButtonText' => 'Update'])



                {!! Form::close() !!}

            

    </section>

</section>





@endsection



