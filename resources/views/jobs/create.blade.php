@extends('layouts.app')

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                   <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('jobs') }}">Jobs</a></li>
                    <li class="active">Job Book In</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
        
            {!! Form::open(['url' => 'job-book-in', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}

                @include ('jobs.form')

            {!! Form::close() !!}
            
    </section>
</section>


@endsection