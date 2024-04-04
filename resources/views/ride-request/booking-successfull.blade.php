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
                            <div class="step-icon">3.</div>
                        </div>
                        <div class="step-title">Enter Payment Details</div>
                    </div>
                    <div class="step-wrapper qns-last clearfix">
                        <div class="step-icon-wrapper">
                            <div class="step-icon step-icon-current">4.</div>
                        </div>
                        <div class="step-title">Confirmation</div>
                    </div>
                    <div class="step-line"></div>
                </div>
                <div class="booking-form-content clearfix">
                    <div class="full-booking-wrapper full-booking-wrapper-3 clearfix">
                        <h4>Booking Successful</h4>
                        <div class="title-block7"></div>
                        <p>Thanks for booking! We have received your request and our team will contact you shortly!</p>
                        <hr class="space7">
                        <h4>Trip Details</h4>
                        <div class="title-block7"></div>
                        <div class="clearfix">
                            <div class="qns-one-half">
                                <p class="clearfix"><strong>Service:</strong> <span>Distance</span></p>
                                <p class="clearfix"><strong>From:</strong> <span>{{$ride->pickup_location}}</span></p>
                                <p class="clearfix"><strong>To:</strong> <span>{{$ride->dropoff_location}}</span></p>
                                @if($ride['round_trip'] == '1')
                                    <p class="clearfix"><strong>From:</strong> <span>{{$ride['round_pickup_location']}}</span></p>
                                    <p class="clearfix"><strong>To:</strong> <span>{{$ride['round_dropoff_location']}}</span></p>
                                @endif
                                <p class="clearfix"><strong>Vehicle:</strong> <span>{{$ride->category->name}}</span></p>
                                <p class="clearfix"><strong>Return:</strong> <span>{{($ride['round_trip'] == 1) ? "Return" : (($ride['hourly'] == 1)  ? "Hourly" : "One Way")}}</span></p>
                            </div>
                            <div class="qns-one-half last-col">
                                <p class="clearfix"><strong>Trip Created On:</strong> <span>{{date('m-d-Y', strtotime($ride->created_at))}}</span></p>
                                <p class="clearfix"><strong>Total Distance:</strong> <span>{{$ride->distance}} Miles</span></p>
                                {{--<p class="clearfix"><strong>Pick Up Time:</strong> <span>{{$ride->pickup_time}}</span></p>--}}
                                <p class="clearfix"><strong>Pick Up Instructions:</strong> <span>{{$ride->pickup_inst}}</span></p>
                                <p class="clearfix"><strong>Drop Off Instructions:</strong> <span>{{$ride->dropoff_inst}}</span></p>
                                {{--<p class="clearfix"><strong>Route Estimate:</strong> <span><a href="https://maps.google.com/maps?saddr=Lahore, Pakistan&amp;daddr=Lahore Ring Road, Lahore, Pakistan&amp;ie=UTF8&amp;z=11&amp;layer=t&amp;t=m&amp;iwloc=A&amp;output=embed?iframe=true&amp;width=640&amp;height=480" data-gal="prettyPhoto[gallery]" class="view-map-button">View Map</a></span></p>--}}
                            </div>
                        </div>
                        <hr class="space2">
                        <h4>Passengers Details</h4>
                        <div class="title-block7"></div>
                        <div class="clearfix">
                            <div class="passenger-details-wrapper">
                                <div class="clearfix">
                                    <div class="passenger-details-half">
                                        <p class="clearfix"><strong>Passengers:</strong> <span>{{$ride->no_of_passengers}}</span></p>
                                        <p class="clearfix"><strong>Bags:</strong> <span>{{$ride->no_of_bags}}</span></p>
                                    </div>
                                    <div class="passenger-details-half last-col">
                                        <p class="clearfix"><strong>Name:</strong> <span>{{$ride->name}}</span></p>
                                        <p class="clearfix"><strong>Email:</strong> <span>{{$ride->email}}</span></p>
                                        <p class="clearfix"><strong>Phone:</strong> <span>{{$ride->phone_number}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="passenger-details-wrapper additional-information-wrapper last-col">
                                <p class="clearfix"><strong>Additional Information:</strong> <span>{{$ride->additional_info}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection





@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHH2WyrHbuChuvGc1zkbY3LwiODEF8zGI&libraries=places"></script>
    <script type="text/javascript">

        jQuery(document).ready(function() {

            jQuery(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        var autocomplete = new google.maps.places.Autocomplete(jQuery("#pickupaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var address = place.formatted_address;
            console.log(address);

            jQuery('#lat').val(place.geometry.location.lat());
            jQuery('#lng').val(place.geometry.location.lng());

        });

        var autocomplete2 = new google.maps.places.Autocomplete(jQuery("#dropoffaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete2, 'place_changed', function() {
            var place2 = autocomplete2.getPlace();
            var address2 = place2.formatted_address;
            console.log(address2);

            jQuery('#lat2').val(place2.geometry.location.lat());
            jQuery('#lng2').val(place2.geometry.location.lng());

        });

    </script>

@endsection



