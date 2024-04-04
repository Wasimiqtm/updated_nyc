@extends('layouts.app')



@section('css')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
<style type="text/css">
.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .help-block {color: #a94442;}
.has-error .form-control {border-color: #a94442;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);}   
.iti{width: 100%;} 
.register-heading {text-align: left;}
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
                    <p>Already have an account?</p>
                    <input type="submit" class="btn btn-white" name="" value="Login"/><br/>
                </div>
            </div>
            <div class="col-md-8 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a Rider</h3>
                        <div class="row register-form">
                            <form role="form" method="POST" action="{{ url('register') }}">

                                {{ csrf_field() }}   
                                
                                <input type="hidden" name="user_type" value="rider">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name *"  value="{{ old('first_name') }}" />
                                        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name *" value="{{ old('last_name') }}" />
                                        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" name="email" class="form-control" placeholder="Email *" value="{{ old('email') }}" />
                                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code') }}">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                        <input type="text" id="phone" name="phone_number" class="form-control" placeholder="Phone *" value="{{ old('phone_number') }}" />
                                        {!! $errors->first('country_code', '<p class="help-block">:message</p>') !!}
                                        {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                                        <p id="error-msg" class="hide help-block"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" name="password" class="form-control"  placeholder="Password *" />
                                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password *" />
                                        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  placeholder="Add Promo Code (Optional)" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p style="font-size: 12px;">By proceeding, I agree to our <a href="">Terms of Use</a> and acknowledge that I have read the <a href="">Privacy Policy.</a></p>
                                </div>
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-blue"  value="Register"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Driver Signup -->
      

@endsection





@section('scripts')
<script src="{{ asset('js/intlTelInput.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
            $('#myCarousel').carousel({
                interval: 10000
            })

            var input = document.querySelector("#phone");
            var errorMsg = document.querySelector("#error-msg");
            var errorMap = ["Invalid number", "Invalid country code", "Phone number is too short", "Phone number is too long", "Invalid phone number"];

            // initialise plugin
            var iti = window.intlTelInput(input, {
              utilsScript: "{{ asset('js/utils.js') }}?1570635132854"
            });

            var reset = function() {
              input.classList.remove("error");
              errorMsg.innerHTML = "";
              errorMsg.classList.add("hide");
            };
           
            var dialCode = iti.getSelectedCountryData().dialCode;
            $("#country_code").val(dialCode);

            // on blur: validate
            input.addEventListener('blur', function() {
              reset();
              
              var dialCode = iti.getSelectedCountryData().dialCode;
              $("#country_code").val(dialCode);

              if (input.value.trim()) {
                if (iti.isValidNumber()) {
                } else {
                  input.classList.add("error");
                  var errorCode = iti.getValidationError();
                  //errorMsg.innerHTML = errorMap[errorCode];
                  //errorMsg.innerHTML = "Invalid phone number";
                  //errorMsg.classList.remove("hide");
                }
              }
            });

            // on keyup / change flag: reset
            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);
        });

</script>

@endsection                            





