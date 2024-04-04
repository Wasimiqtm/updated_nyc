@extends('layouts.app')



@section('css')

    <style>
        .cardborder:hover {
            border:2px solid #ffc107;
        }
        .cardbg{
            background-color: #E5E5E5;
        }
        hr {
            border: 1px solid #1b1b1a;
            margin: 20px 0;
        }
        .box-border{
            border: 1px solid #1b1b1a;
        }

        .box-border2{
            border: 2px solid #1b1b1a;

        }
        .main{
            color:#1b1b1a
        }




    </style>
@endsection

@section('content')
    <main class="main">
        <div class="container mt-5 py-5">
            <div class="card cardbg">
                <div class="card-body">
                    <h5>Trip Details</h5>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <p>
                                <span class="text-secondary">Select Type :</span>
                                <span class="ml-5"> {{($ride['round_trip'] == 1) ? "Return" : (($ride['hourly'] == 1)  ? "Hourly" : "One Way")}}</span>
                            </p>
                            <hr />
                            <p>
                                <span class="text-secondary">From :</span>
                                <span class="ml-5"> {{$ride['pickup_location']}}</span>
                            </p>
                            <hr />
                            <p>
                                <span class="text-secondary">To :</span>
                                <span class="ml-5"> {{$ride['dropoff_location']}}</span>
                            </p>
                            <hr />
                            @if($ride['round_trip'] == '1')
                                <p>
                                    <span class="text-secondary">From :</span>
                                    <span class="ml-5"> {{$ride['round_pickup_location']}}</span>
                                </p>
                                <hr />
                                <p>
                                    <span class="text-secondary">To :</span>
                                    <span class="ml-5"> {{$ride['round_dropoff_location']}}</span>
                                </p>
                                <hr />
                            @endif
                            <p>
                                <span class="text-secondary">Vehicle :</span>
                                <span class="ml-5"> {{$ride_request->category->name}}</span>
                            </p>
                            <hr />
                        </div>
                        <div class="col-lg-6">
                            <p>
                                <span class="text-secondary">Date :</span>
                                <span class="ml-5"> {{date('m-d-Y', strtotime($ride['pickup_date']))}}</span>
                            </p>
                            <hr />
                            <p>
                                <span class="text-secondary">Pick Up Time :</span>
                                <span class="ml-5"> {{date('h:i:s a', strtotime($ride['pickup_time']))}}</span>
                            </p>
                            <hr />
                            @if($ride['round_trip'] == '1')
                                <p>
                                    <span class="text-secondary">Date :</span>
                                    <span class="ml-5"> {{date('m-d-Y', strtotime($ride['round_pickup_date']))}}</span>
                                </p>
                                <hr />
                                <p>
                                    <span class="text-secondary">Pick Up Time :</span>
                                    <span class="ml-5"> {{date('h:i:s a', strtotime($ride['round_pickup_time']))}}</span>
                                </p>
                                <hr />
                            @endif
                            <p>
                                <span class="text-secondary">Distance :</span>
                                <span class="ml-5"> {{$ride['distance']}} Miles</span>
                            </p>
                            <hr />
                            <p>
                                <span class="text-secondary">Pick Up Instructions :</span>
                                <span class="ml-5">{{$ride['pickup_inst']}}</span>
                            </p>
                            <hr />
                            <p>
                                <span class="text-secondary">Drop Off Instructions :</span>
                                <span class="ml-5">{{$ride['dropoff_inst']}}</span>
                            </p>
                            <hr />
                        </div>
                    </div>

                    <h5 class="mt-5">Passangers Details</h5>
                    <div class="row mt-5">
                        <div class="col-lg-5">
                            <div class="box-border p-3">
                                <div class="row">
                                    <div class="col-lg-5 mb-3">
                                        <p class="mb-2">
                                            <span class="text-secondary">Passanger :</span>
                                            <span class=""> {{$ride['no_of_passengers']}}</span>
                                        </p>
                                        <p >
                                            <span class="text-secondary">Bags :</span>
                                            <span class=""> {{$ride['no_of_bags']}}</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        <p class="mb-2">
                                            <span class="text-secondary">Name :</span>
                                            <span class=""> {{$ride['name']}}</span>
                                        </p>
                                        <p class="mb-2">
                                            <span class="text-secondary">Email :</span>
                                            <span class=""> {{$ride['email']}}</span>
                                        </p>
                                        <p>
                                            <span class="text-secondary">Phone Number :</span>
                                            <span class=""> {{$ride['phone_number']}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 ">
                            <div class="box-border p-3">
                                <p>
                                    <span class="text-secondary">Additional Information :</span>
                                    <span class=""> {{$ride['additional_info']}}</span>
                                </p>
                            </div>
                        </div>
                    </div>

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
                        <div class="row mt-5">
                            <div class="col-lg-5">
                                <div class="box-border p-3">
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
                            </div>
                        </div>
                    @endif

                    <div class="total-price-inner clearfix">
                        <p>Total Price: <strong>${{$ride['charges']}}</strong>

                            <span style="color: red">*Tolls  may be Applicable</span>
                        </p>
                    </div>
                    <a href="#" class="btn btn-primary btn-lg payment-button pay_now" data-toggle="modal" data-target="#exampleModal">Proceed To Payment</a>

                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="margin-top: 130px;">
                    <div class="modal-body">
                        <div id="card-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                        <button id="card-button" class="btn btn-success btn-lg button-credit-card">Pay ${{$ride['charges']}}</button>

                    </div>
                </div>
            </div>
        </div>

        <form role="form" id="paymentDetails" action="{{url('ride-request/create-step3')}}"  method="post">
            {{ csrf_field() }}
            <input type="hidden" id="card-nonce" name="nonce">
            <input type="hidden" name="ride_id" id="ride_id" value="{{$ride_request->id}}" />
            <input type="hidden" name="amount" id="amount" value="{{($ride['charges']*100)}}" />
        </form>
    </main>
@endsection



<script src="{{asset('assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    {{-- sandbox --}}
    {{-- <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script> --}}
    {{-- production --}}
    <script src="https://web.squarecdn.com/v1/square.js"></script>

      <!-- Configure the Web Payments SDK and Card payment method -->
      <script type="text/javascript">
        async function main() {
            // const appId = 'sandbox-sq0idb-bBUzTOCxs4mveGJHj-9h2A'; //sandbox
            const appId = 'sandbox-sq0idb-Qz-U1bZsfzYWOHSY05wDsA';
            const payments = Square.payments(appId, 'en');
            const card = await payments.card();
            await card.attach('#card-container');

          async function eventHandler(event) {
            event.preventDefault();

            try {
              const result = await card.tokenize();
              if (result.status === 'OK') {

                var nonceField = document.getElementById('card-nonce');
                nonceField.value = result.token;

                // Submit the form
                document.getElementById('paymentDetails').submit();

                //console.log(`Payment token is ${result.token}`);
              }
            } catch (e) {
              console.error(e);
            }
          };

        const cardButton = document.getElementById('card-button');
            cardButton.addEventListener('click', eventHandler);
        }

        main();
      </script>

   {{-- <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script> --}}
      {{-- <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script> --}}
    {{-- <script type="text/javascript">
        console.log('Square Payment Form Starting');
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
                        console.log('Square Payment Form error');
                        var errorDiv = document.getElementById('errors');
                        errorDiv.innerHTML = "";
                        errors.forEach(function(error) {
                            var p = document.createElement('p');
                            p.innerHTML = error.message;
                            errorDiv.appendChild(p);
                        });
                    } else {
                        console.log('Square Payment Form Completed');
                        var nonceField = document.getElementById('card-nonce');
                        nonceField.value = nonce;

                        // Submit the form
                        document.getElementById('paymentDetails').submit();
                    }
                },
                unsupportedBrowserDetected: function() {
                    console.log('Square Payment Form unsupportedBrowserDetected');
                    // Alert the buyer that their browser is not supported
                }
            }
        });
        sqPaymentForm.build();
        function onGetCardNonce(event) {
            event.preventDefault();
            sqPaymentForm.requestCardNonce();
        }
    </script> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery(".pay_now").click(function(){
                jQuery("#exampleModal").modal("show");
            });
        });

    </script>




