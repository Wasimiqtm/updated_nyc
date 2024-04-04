@extends('layouts.app')



@section('css')


@endsection

@section('content')
    <div id="page-header" style="background:url(http://themes.quitenicestuff2.com/chauffeurwp/demo3/wp-content/uploads/2017/02/image28-1.jpg) top center;">
        <div class="page-header-inner">
            <h1>Booking</h1>
            <div class="title-block3"></div>
            <p><span><a href="http://themes.quitenicestuff2.com/chauffeurwp/demo3/"><span>Home</span></a></span> <span class="sep"><i class="fa fa-angle-right"></i></span> <span class="current">Booking</span></p>	</div>
    </div>
    <div class="content-wrapper-standard clearfix">
        <div class="main-content main-content-full">
            <div class="content-wrapper-standard aligncenter">
                <!-- Stepper Tabs -->
                <div class="booking-step-wrapper clearfix">
                    <div class="step-wrapper clearfix">
                        <div class="step-icon-wrapper">
                            <div class="step-icon">1.</div>
                        </div>
                        <div class="step-title">Trip Details</div>
                    </div>
                    <div class="step-wrapper clearfix">
                        <div class="step-icon-wrapper">
                            <div class="step-icon">2.</div>
                        </div>
                        <div class="step-title">Select Vehicle</div>
                    </div>
                    <div class="step-wrapper clearfix">
                        <div class="step-icon-wrapper">
                            <div class="step-icon step-icon-current">3.</div>
                        </div>
                        <div class="step-title">Enter Payment Details</div>
                    </div>
                    <div class="step-wrapper qns-last clearfix">
                        <div class="step-icon-wrapper">
                            <div class="step-icon">4.</div>
                        </div>
                        <div class="step-title">Confirmation</div>
                    </div>
                    <div class="step-line"></div>
                </div>
                <div class="booking-form-content clearfix">
                    <div class="full-booking-wrapper full-booking-wrapper-3 clearfix">
                        <h4>Trip Details</h4>
                        <div class="title-block7"></div>
                        <div class="clearfix">
                            <div class="qns-one-half">
                                <p class="clearfix"><strong>Service:</strong> <span>{{($ride['round_trip'] == 1) ? "Return" : (($ride['hourly'] == 1)  ? "Hourly" : "One Way")}}</span></p>
                                <p class="clearfix"><strong>From:</strong> <span>{{$ride['pickup_location']}}</span></p>
                                <p class="clearfix"><strong>To:</strong> <span>{{$ride['dropoff_location']}}</span></p>
                                @if($ride['round_trip'] == '1')
                                    <p class="clearfix"><strong>From:</strong> <span>{{$ride['round_pickup_location']}}</span></p>
                                    <p class="clearfix"><strong>To:</strong> <span>{{$ride['round_dropoff_location']}}</span></p>
                                @endif
                                <p class="clearfix"><strong>Vehicle:</strong> <span>{{$ride_request->category->name}}</span></p>
{{--                                <p class="clearfix"><strong>Return:</strong> <span>{{($ride['round_trip'] == 1) ? "Return" : (($ride['hourly'] == 1)  ? "Hourly" : "One Way")}}</span></p>--}}
                            </div>
                            <div class="qns-one-half last-col">
                                <p class="clearfix"><strong>Date:</strong> <span>{{date('m-d-Y', strtotime($ride['pickup_date']))}}</span></p>
                                <p class="clearfix"><strong>Pick Up Time:</strong> <span>{{date('h:i:s a', strtotime($ride['pickup_time']))}}</span></p>
                                @if($ride['round_trip'] == '1')
                                    <p><strong>Date:</strong> {{date('m-d-Y', strtotime($ride['round_pickup_date']))}}</p>
                                    <p><strong>Pick Up Time:</strong>{{date('h:i:s a', strtotime($ride['round_pickup_time']))}}</p>
                                @endif
                                <p class="clearfix"><strong>Distance:</strong> <span>{{$ride['distance']}} Miles</span></p>
                                <p class="clearfix"><strong>Pick Up Instructions:</strong> <span>{{$ride['pickup_inst']}}</span></p>
                                <p class="clearfix"><strong>Drop Off Instructions:</strong> <span>{{$ride['dropoff_inst']}}</span></p>
                                @if(isset($ride['flight_name']) and !empty($ride['flight_name']))
                                <p class="clearfix"><strong>Flight Name:</strong> <span>{{$ride['flight_name']}}</span></p>
                                @endif

                                @if(isset($ride['flight_number']) and !empty($ride['flight_number']))
                                    <p class="clearfix"><strong>Flight Number:</strong> <span>{{$ride['flight_number']}}</span></p>
                                @endif
                                @if( isset($ride['terminal']) and !empty($ride['terminal']))
                                    <p class="clearfix"><strong>Terminal:</strong> <span>{{$ride['terminal']}}</span></p>
                                @endif
                                {{--<p class="clearfix"><strong>Route Estimate:</strong> <span><a href="https://maps.google.com/maps?saddr=Lahore, Pakistan&amp;daddr=Lahore, Pakistan&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button">View Map</a></span></p>--}}
                            </div>
                        </div>
                        <hr class="space2">
                        <h4>Passengers Details</h4>
                        <div class="title-block7"></div>
                        <div class="clearfix">
                            <div class="passenger-details-wrapper">
                                <div class="clearfix">
                                    <div class="passenger-details-half">
                                        <p class="clearfix"><strong>Passengers:</strong> <span>{{$ride['no_of_passengers']}}</span></p>
                                        <p class="clearfix"><strong>Bags:</strong> <span>{{$ride['no_of_bags']}}</span></p>
                                    </div>
                                    <div class="passenger-details-half last-col">
                                        <p class="clearfix"><strong>Name:</strong> <span>{{$ride['name']}}</span></p>
                                        <p class="clearfix"><strong>Email:</strong> <span>{{$ride['email']}}</span></p>
                                        <p class="clearfix"><strong>Phone:</strong> <span>{{$ride['phone_number']}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="passenger-details-wrapper additional-information-wrapper last-col">
                                <p class="clearfix"><strong>Additional Information:</strong> <span>{{$ride['additional_info']}} </span></p>
                            </div>
                        </div>
                        <form class="total-price-display clearfix" method="post" action="#">
                            <input type="hidden" name="num-passengers" value="6">
                            <input type="hidden" name="num-bags" value="1">
                            <input type="hidden" name="first-name" value="soh">
                            <input type="hidden" name="last-name" value="asdh">
                            <input type="hidden" name="email-address" value="asdasd@gmail.com">
                            <input type="hidden" name="phone-number" value="789712938712983">
                            <input type="hidden" name="flight-number" value="asdasd">
                            <input type="hidden" name="additional-info" value="asdasd">
                            <input type="hidden" name="selected-vehicle-name" value="Mercedes Van">
                            <input type="hidden" name="selected-vehicle-price" value="140.00">
                            <input type="hidden" name="form-type" value="one_way">
                            <input type="hidden" name="pickup-address" value="Lahore, Pakistan">
                            <input type="hidden" name="dropoff-address" value="Lahore, Pakistan">
                            <input type="hidden" name="pickup-date" value="30/06/2020">
                            <input type="hidden" name="pickup-time" value="01:00">
                            <input type="hidden" name="trip-distance" value="1 m">
                            <input type="hidden" name="trip-time" value="1 min">
                            <input type="hidden" name="num-hours" value="">
                            <input type="hidden" name="flat-location" value="">
                            <input type="hidden" name="full-pickup-address" value="">
                            <input type="hidden" name="pickup-instructions" value="asas">
                            <input type="hidden" name="full-dropoff-address" value="">
                            <input type="hidden" name="dropoff-instructions" value="asas">
                            <input type="hidden" name="return-journey" value="true">

                            @if ($ride['hourly'] == 1)
                                <div>
                                    <div>Trip Type : Hourly</div>
                                    <div>Base Fare : ${{$ride['fare_without_taxes']}}</div>
                                    {{--<div>Gratuity : ${{$ride['gratuty']}}</div>--}}
                                    <div>Black Car Fund : ${{$ride['black_car_finder_fee']}}</div>
                                    <div>Gratiuty : ${{$ride['gratuty']}}</div>
                                    <div>Congestion : ${{$ride['congestion']}}</div>
                                    @if($toll['toll'] && $toll['total_toll']>0)
                                    <div>Toll : ${{ $toll['total_toll'] }}</div>
                                    @endif
                                    {{--<div>State Wise Percentage : ${{$ride['state_wise_percentage']}}</div>--}}
                                    <div>Sales Tax : ${{$ride['new_york_city_fee']}}</div>
                                    
                                </div>
                            @elseif ($ride['hourly'] == 0 && $ride['round_trip'] == 0)
                                <div>
                                    <div>Trip Type : One Way</div>
                                    <div>Base Fare : ${{$ride['fare_without_taxes']}}</div>
                                    {{--<div>Gratuity : ${{$ride['gratuty']}}</div>--}}
                                    <div>Black Car Fund : ${{$ride['black_car_finder_fee']}}</div>
                                     <div>Gratiuty : ${{$ride['gratuty']}}</div>
                                     <div>Congestion : ${{$ride['congestion']}}</div>
                                    @if($toll['toll'] && $toll['total_toll']>0)
                                    <div>Toll : ${{ $toll['total_toll'] }}</div>
                                    @endif
                                    {{--<div>State Wise Percentage : ${{$ride['state_wise_percentage']}}</div>--}}
                                    <div>Sales Tax : ${{$ride['new_york_city_fee']}}</div>
                                    
                                </div>
                            @else
                                <div>
                                    <div>Trip Type : Return</div>
                                    <div>Base Fare : ${{$ride['fare_without_taxes1']}}</div>
                                    {{--<div>Gratuity : ${{$ride['gratuty1']}}</div>--}}
                                    <div>Black Car Fund : ${{$ride['black_car_finder_fee1']}}</div>
                                     <div>Gratiuty : ${{$ride['gratuty']}}</div>
                                     <div>Congestion : ${{$ride['congestion']}}</div>
                                    @if($toll['toll'] && $toll['total_toll']>0)
                                    <div>Toll : ${{ $toll['total_toll'] }}</div>
                                    @endif
                                    {{--<div>State Wise Percentage : ${{$ride['state_wise_percentage1']}}</div>--}}
                                    <div>Sales Tax : ${{$ride['new_york_city_fee1']}}</div>
                                    <div>1st Ride Price : ${{$ride['charges1']}}</div>
                                    <hr>
                                    <div>Base Fare : ${{$ride['fare_without_taxes2']}}</div>
                                    {{--<div>Gratuity : ${{$ride['gratuty2']}}</div>--}}
                                    <div>Black Car Fund : ${{$ride['black_car_finder_fee2']}}</div>
                                    <div>Congestion : ${{$ride['congestion']}}</div>
                                    <div>Sales Tax : ${{$ride['new_york_city_fee2']}}</div>
                                    @if($ride['toll2'] )
                                        <div>Toll : ${{ $ride['toll2'] }}</div>
                                    @endif
                                    <div>2nd Ride Price : ${{$ride['charges2']}}</div>
                                </div>
                            @endif

                            <div class="total-price-inner clearfix">
                                <p>Total Price: <strong>${{$ride['charges']}}</strong>

                                    <span style="color: red">*Tolls  may be Applicable</span>
                                </p>
                            </div>

                            <div class="payment-options-section clearfix">
                                {{--<div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="paypal" checked="checked"><label>Pay with PayPal</label><img src="http://themes.quitenicestuff2.com/chauffeurwp/demo3/wp-content/plugins/chauffeur-shortcodes-post-types/includes/templates/../../assets/images/paypal.png"></div>
                                <div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="stripe"><label>Pay with Credit Card</label><img src="http://themes.quitenicestuff2.com/chauffeurwp/demo3/wp-content/plugins/chauffeur-shortcodes-post-types/includes/templates/../../assets/images/stripe.png"></div>
                                <div class="radio-wrapper clearfix"><input type="radio" name="payment-method" value="cash"><label>Pay with Cash</label></div>--}}
                                <!--
                                
                                <button name="pay_now" class="payment-button pay_now" type="submit">
                                    <a href="javascript:void(0)" class="fa-inverse payment-button pay_now">Proceed To Payment</a>
                                </button>
                                -->
                                
                                
                                
                                <a href="javascript:void(0)" class="fa-inverse payment-button pay_now">Proceed To Payment</a>
                                
                                
                                {{--<a href="javascript:void(0)" id="pay_now" class="fa-inverse">Proceed To Payment</a>--}}
                            </div>
                        </form>
                    </div></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 130px;">

                <form role="form" id="paymentDetails" action="{{url('ride-request/create-step3')}}"  method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <input type="hidden" id="card-nonce" name="nonce">
                    <input type="hidden" name="ride_id" id="ride_id" value="{{$ride_request->id}}" />
                    <input type="hidden" name="amount" id="amount" value="{{($ride['charges']*100)}}" />
                        <div class="form-group">
                            <label for="cardNumber">Card number</label>
                             <div id="sq-card-number"></div> <!-- input-group.// -->
                        </div> <!-- form-group.// -->

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">


                                    <label><span class="hidden-xs">Expiration</span> </label>
                                    <div id="sq-expiration-date"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV</label>
                                     <div id="sq-cvv"></div>
                                </div> <!-- form-group.// -->
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label data-toggle="tooltip" title="" data-original-title="Postal Code">Post Code</label>
                                    <div id="sq-postal-code"></div>
                                </div> <!-- form-group.// -->
                            </div>
                        </div> <!-- row.// -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event)">Pay ${{$ride['charges']}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection





@section('scripts')
   {{-- <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script> --}}
      <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
    <script type="text/javascript">

        var sqPaymentForm = new SqPaymentForm({

            // Replace this value with your application's ID (available from the merchant dashboard).
            // If you're just testing things out, replace this with your _Sandbox_ application ID,
            // which is also available there.
            applicationId: 'sq0idp-J0ZAvTr9dkEQuMOpsHEdWw',
            //applicationId: 'sandbox-sq0idb-bBUzTOCxs4mveGJHj-9h2A',
            inputClass: 'sq-input',
            autoBuild: false,
            cardNumber: {
                elementId: 'sq-card-number',
                placeholder: "0000 0000 0000 0000"
            },
            cvv: {
                elementId: 'sq-cvv',
                placeholder: 'CVV'
            },
            expirationDate: {
                elementId: 'sq-expiration-date',
                placeholder: 'MM/YY'
            },
            postalCode: {
                elementId: 'sq-postal-code',
                placeholder: 'Postal Code'
            },
            inputStyles: [

                // Because this object provides no value for mediaMaxWidth or mediaMinWidth,
                // these styles apply for screens of all sizes, unless overridden by another
                // input style below.
                {
                    fontSize: '14px',
                    padding: '3px'
                },

                // These styles are applied to inputs ONLY when the screen width is 400px
                // or smaller. Note that because it doesn't specify a value for padding,
                // the padding value in the previous object is preserved.
                {
                    mediaMaxWidth: '400px',
                    fontSize: '18px',
                }
            ],
            callbacks: {

                cardNonceResponseReceived: function(errors, nonce, cardData) {

                    if (errors) {
                        var errorDiv = document.getElementById('errors');
                        errorDiv.innerHTML = "";
                        errors.forEach(function(error) {
                            var p = document.createElement('p');
                            p.innerHTML = error.message;
                            errorDiv.appendChild(p);
                        });
                    } else {

                        var nonceField = document.getElementById('card-nonce');
                        nonceField.value = nonce;

                        // Submit the form
                        document.getElementById('paymentDetails').submit();
                    }
                },
                unsupportedBrowserDetected: function() {
                    // Alert the buyer that their browser is not supported
                }
            }
        });
        sqPaymentForm.build();
        function onGetCardNonce(event) {
            event.preventDefault();
            sqPaymentForm.requestCardNonce();
        }
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery(".pay_now").click(function(){
                /*alert();return false;
                var ride_id = jQuery(this).data("id");
                jQuery('#ride_id').val(ride_id);*/
                jQuery("#exampleModal").modal("show");
            });
        });

    </script>

@endsection



