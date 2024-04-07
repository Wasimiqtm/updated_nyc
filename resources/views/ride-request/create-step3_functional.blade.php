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
        <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery(".pay_now").click(function(){
                    jQuery("#exampleModal").modal("show");
                });

                // Attach the main function to the modal's shown.bs.modal event
                jQuery("#exampleModal").on('shown.bs.modal', function () {
                    main(); // Call the main function after the modal is shown
                });
            });

            async function main() {
                const appId = 'sandbox-sq0idb-zDR92CA8Fs0Uqyo_vCPYhw';
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
                        }
                    } catch (e) {
                        console.error(e);
                    }
                };

                const cardButton = document.getElementById('card-button');
                cardButton.addEventListener('click', eventHandler);
            }
        </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

