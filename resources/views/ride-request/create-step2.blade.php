@extends('layouts.app')

@section('css')

    <style>
        .text-warningg {
            color:#E95440;
        }
        .cardborder:hover {
            border: 2px solid #E95440 !important;
        }
        .box-border{
            border: 1px solid #1b1b1a;
            width: 60%;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="container mt-5 py-5">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <h5>Select Vehical</h5>

                    @foreach($categories as $category)
                        <div class="card cardborder mt-5 mb-3 vehicle-section" data-id="{{$category['id']}}" data-price1="{{$category['charges1']}}" data-price2="{{$category['charges2']}}" data-price="{{$category['total_charges']}}" data-title="{{$category['name']}}" data-bags="{{$category['no_of_bags']}}" data-passengers="{{$category['no_of_passengers']}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h6>{{$category['name']}}</h6>
                                        <h6 class="text-warningg">$ {{$category['fare_without_taxes']}}</h6>
                                    </div>
                                    <div class="col-lg-4">
                                        <img
                                                src="{{$category['image']}}"
                                                alt=""
                                                class="img-fluid"
                                                width="100%"
                                                height="180px"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="col-lg-7">
                    <div class="card cardbg mb-3">
                        <div class="card-body">
                            <h5>Trip Details</h5>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <p> <span class="text-secondary">Service Type:</span> {{($ride['round_trip'] == 1) ? "Return" : (($ride['hourly'] == 1)  ? "Hourly" : "One Way")}}</p>
                                    <hr>
                                    <p> <span class="text-secondary">From:</span> <span class="ml-2">{{$ride['pickup_location']}}</span></p>
                                    <hr>
                                    <p> <span class="text-secondary">To:</span> <span class="ml-2">{{$ride['dropoff_location']}}</span></p>
                                    <hr>
                                    @if($ride['round_trip'] == '1')
                                        <p> <span class="text-secondary">From:</span> <span class="ml-2">{{$ride['round_pickup_location']}}</span></p>
                                        <hr>
                                        <p> <span class="text-secondary">To:</span> <span class="ml-2">{{$ride['round_dropoff_location']}}</span></p>
                                        <hr>
                                    @endif
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <div class=" box-border px-4 py-2">
                                        <div class="ml-5 mt-3">
                                            <p>Date:</p>
                                            <h6>{{date('m-d-Y', strtotime($ride['pickup_date']))}}</h6>
                                        </div>

                                        <div class="ml-5">
                                            <p>Pick Up Time:</p>
                                            <h6>{{date('h:i:s a', strtotime($ride['pickup_time']))}}</h6>
                                        </div>
                                        @if($ride['round_trip'] == '1')
                                        <div class="ml-5 mt-3">
                                            <p>Date:</p>
                                            <h6>{{date('m-d-Y', strtotime($ride['round_pickup_date']))}}</h6>
                                        </div>

                                        <div class="ml-5">
                                            <p>Pick Up Time:</p>
                                            <h6>{{date('h:i:s a', strtotime($ride['round_pickup_time']))}}</h6>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <form class="booking-form-1" id="formId" action="{{url('ride-request/create-step2')}}" method="post">
                                {{ csrf_field() }}
                                <div class="row mt-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Number of Passangers</p>
                                            <select name="no_of_passengers" id="" class="form-control num-passengers">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Number of Bages</p>
                                            <select name="no_of_bags" id="" class="form-control">

                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Pick Up Instructions</p>
                                            <textarea class="form-control" name="pickup_inst" id="textAreaExample1" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Drop Off Instructions</p>
                                            <textarea class="form-control" name="dropoff_inst" id="textAreaExample1" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2"> Name <span class="text-danger">*</span></p>
                                            <input type="text" name="name" class="form-control" id="" placeholder="Enter Name" required>
                                            @if ($errors->has('name'))
                                                <span class="help-block with-errors">
                                                {{ $errors->first('name') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Phone Number <span class="text-danger">*</span></p>
                                            <input type="text" name="phone_number" class="form-control" id="" placeholder="Enter Phone Number" required>
                                            @if ($errors->has('phone_number'))
                                                <span class="help-block with-errors">
                                                {{ $errors->first('phone_number') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <p class="mb-2">Email <span class="text-danger">*</span></p>
                                            <input type="email" name="email" class="form-control" id="" placeholder="Enter Email" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block with-errors">
                                                {{ $errors->first('email') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <p class="mb-2">Additional Information</p>
                                            <textarea name="additional_info" class="form-control" id="textAreaExample1" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="cat_id" name="cat_id" value="">
                                <input type="hidden" id="cat_name" name="cat_name" value="">
                                <input type="hidden" id="cat_price1" name="cat_price1" value="">
                                <input type="hidden" id="cat_price2" name="cat_price2" value="">
                                <input type="hidden" id="cat_price" name="cat_price" value="">
                                <input type='button' value='Confirm' onClick='submitDetailsForm()' />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
<script src="{{asset('assets/js/vendors/jquery-3.6.0.min.js')}}"></script>

<script>
    // Define selectedCheck variable
    var selectedCheck = false;

    // Wait for the document to be ready
    jQuery(document).ready(function() {
        // Add click event listener to each box
        var boxes = document.querySelectorAll('.vehicle-section');
        boxes.forEach(function(box) {
            box.addEventListener('click', function() {
                // Remove border from all boxes
                boxes.forEach(function(box) {
                    box.style.border = 'none';
                });

                // Add border to the clicked box
                this.style.border = '2px solid red';
                selectedCheck = true;
            });
        });

        // Other jQuery event handlers
        jQuery(".num-passengers").on('click',function(){
            if(jQuery(".num-passengers option").length ==0){
                alert('Please Select Vehicle');
            }
        });

        jQuery(".num-bags").on('click',function(){
            if(jQuery(".num-bags option").length ==0){
                alert('Please Select Vehicle');
            }
        });

        jQuery('.vehicle-section').click(function() {
            // Populate form fields based on clicked vehicle
            jQuery('#cat_id').val(jQuery(this).attr('data-id'));
            jQuery('#cat_name').val(jQuery(this).attr('data-title'));
            jQuery('#cat_price1').val(jQuery(this).attr('data-price1'));
            jQuery('#cat_price2').val(jQuery(this).attr('data-price2'));
            jQuery('#cat_price').val(jQuery(this).attr('data-price'));

            // Update num-bags dropdown
            /*jQuery('.num-bags').val(jQuery(this).attr('data-bags')).trigger('change');
            var bagsCount = jQuery(this).attr('data-bags');
            var bagOptions = '';
            for (var i = 1; i <= bagsCount; i++) {
                bagOptions += '<option value="'+i+'">'+i+'</option>';
            }
            jQuery('.num-bags').html(bagOptions);*/

            // Update num-passengers dropdown
            /*jQuery('.num-passengers').val(jQuery(this).attr('data-passengers')).trigger('change');
            var passCount = jQuery(this).attr('data-passengers');
            var passOptions = '';
            for (var j = 1; j <= passCount; j++) {
                passOptions += '<option value="'+j+'">'+j+'</option>';
            }
            jQuery('.num-passengers').html(passOptions);*/
        });
    });

    // Function to submit form
    function submitDetailsForm() {
        if(!selectedCheck) {
            alert('Please Select Vehicle');
            return false;
        }
        jQuery("#formId").submit();
    }
</script>
