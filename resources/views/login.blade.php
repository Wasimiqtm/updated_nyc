@extends('layouts.app')



@section('css')
<style type="text/css">
.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline {color: #a94442 !important;}
.has-error .form-control {border-color: #a94442 !important;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);}    
</style>

@endsection

@section('content')

    <!-- Driver Signup -->
    <div class="container register">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="register-left">
                    <i class="fa fa-rocket" aria-hidden="true"></i>
                    <h3>Welcome</h3>
                    <p>Take a few moments to start making money on your schedule</p>
                    <p>Don't have an account?</p>
                    <input type="submit" class="btn btn-white" name="" value="Signup"/><br/>
                </div>
            </div>
            <div class="col-md-8 register-right login">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <div class="row register-form">
                            <form role="form" method="POST" action="{{ url('login') }}">

                                {{ csrf_field() }} 
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input name="email" type="email" class="form-control" placeholder="Email *" value="{{ old('email') }}" />
                                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input name="password" type="password" class="form-control"  placeholder="Password *" />
                                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p style="font-size: 12px;">By proceeding, I agree to our <a href="">Terms of Use</a> and acknowledge that I have read the <a href="">Privacy Policy.</a></p>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-blue"  value="Login"/>
                                </div>
                             </form>   
                        </div>
                    </div>


                    <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="menu1-tab">
                        <h3 class="register-heading">Login as a Rider</h3>
                        <div class="row register-form">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" value="" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" class="form-control"  placeholder="Password *" value="" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p style="font-size: 12px;">By proceeding, I agree to our <a href="">Terms of Use</a> and acknowledge that I have read the <a href="">Privacy Policy.</a></p>
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-blue"  value="Login"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Driver Signup -->
@endsection





@section('scripts')

<script type="text/javascript">

   $(document).ready(function() {
            $('#myCarousel').carousel({
                interval: 10000
            })
        });
    

</script>

@endsection                            



