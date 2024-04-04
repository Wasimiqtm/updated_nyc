@extends('layouts.app')

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('students') }}">Jobs</a></li>
                    <li class="active">Job Book In</li>                    
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
        
            {!! Form::model($job, [
                    'method' => 'PATCH',
                    'url' => ['/job-book-in', Hashids::encode($job->id)],
                    'class' => 'form-horizontal',
                    'data-toggle' => 'validator',
                    'data-disable' => 'false',
                    'files' => true
                ]) !!}

                @include ('jobs.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}
            
    </section>
</section>


@endsection

