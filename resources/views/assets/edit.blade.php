@extends('layouts.app')

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('company-assets') }}">Company Assets</a></li>
                    <li class="active">Update Company Asset</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
        
            {!! Form::model($asset, [
                    'method' => 'PATCH',
                    'url' => ['/company-assets', Hashids::encode($asset->id)],
                    'class' => 'form-horizontal',
                    'data-toggle' => 'validator',
                    'data-disable' => 'false',
                    'files' => true
                ]) !!}

                @include ('assets.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}
            
    </section>
</section>


@endsection

