@extends('layouts.app')

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('stocks') }}">Stocks</a></li>
                    <li class="active">Update Stock</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
        
            {!! Form::model($stock, [
                    'method' => 'PATCH',
                    'url' => ['/stocks', Hashids::encode($stock->id)],
                    'class' => 'form-horizontal',
                    'data-toggle' => 'validator',
                    'data-disable' => 'false',
                    'files' => true
                ]) !!}

                @include ('stocks.form', ['submitButtonText' => 'Update'])

                {!! Form::close() !!}
            
    </section>
</section>


@endsection

