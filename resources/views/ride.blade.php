@extends('layouts.app')



@section('css')

<style>
      #map_canvas {
        height: 300px;
        width: 540px;
      }
</style>
@endsection

@section('content')
<!-- Page Header -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1>AlphaRides</h1>
                    <h3>Affordable daily rides</h3>
                    <p>Once you have AlphaRides user account, you can request a vehicle to pick you up in a few minutes.</p>
                    <a href="{{ url('/rider-signup') }}" class="btn btn-blue">Signup to ride</a>
                </div>
                <div class="col">
                    <img src="img/header-img.jpg" class="img-fluid img-thumbnail" alt="car">
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- How to -->
    <div class="container-fluid how-to">
        <div class="container">
            <h4>How it works</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline">
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-compass"></i></div>
                            <div class="timeline-content">
                                <h3 class="title">Request</h3>
                                <p class="description">
                                    Open the app and enter destination in the  box. Tap to confirm your pickup location and tap Confirm again to be matched to a nearby driver.
                                </p>
                            </div>
                        </a>
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-car"></i></div>
                            <div class="timeline-content">
                                <h3 class="title">Ride</h3>
                                <p class="description">
                                    Every time you take a trip with alpharides, please make sure you’re getting into the right car with the right driver by matching the license plate, car make and model, and driver photo with what’s provided in your app.
                                </p>
                            </div>
                        </a>
                        <a href="#" class="timeline">
                            <div class="timeline-icon"><i class="fa fa-globe"></i></div>
                            <div class="timeline-content">
                                <h3 class="title">Hop Out</h3>
                                <p class="description">
                                    When you arrive at your destination, payment is easy. Let’s us know how your trip went, you can also give driver rating or add a tip in the app at your own discretion.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /How to -->

    <!-- Fair Calculator -->
    <div class="container-fluid fair-calculator">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h2><strong>Get fare estimate</strong></h2>
                    <form class="calculator_form">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label>
                                <i class="fa fa-map-marker" aria-hidden="true"></i> Enter Pickup Location</label>
                                <input type="text" id="pickup" class="form-control" placeholder="E.g. Twin Towers" >
                                <input type="hidden" id="pickup-lat" name="pickup_lat">
                                <input type="hidden" id="pickup-lng" name="pickup_lon">
                            </div>
                            <div class="form-group">
                                <label>
                                    <i class="fa fa-map-pin" aria-hidden="true"></i> Enter Destination</label>
                                    <input type="text" id="dropoff" class="form-control" placeholder="E.g. ParkCity Height" >
                                    <input type="hidden" id="dropoff-lat" name="dropoff_lat">
                                    <input type="hidden" id="dropoff-lng" name="dropoff_lon">
                                </div>
                                <div class="form-group">
                                    <ul class="fleet-list nostyle">
                                        
                                        
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <a href="{{ url('/rider-signup') }}" value="Get Estimate" class="btn btn-blue">Signup to Ride <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <div id="map_canvas"></div>
                            <!-- <div class="map shadowbox"> -->
                                
                                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9095685801913!2d-73.93762598467077!3d40.7420153437157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25ed3364a9963%3A0xcd8d28a8cbb6c4ed!2s3100%2047th%20Ave%20%233100%2C%20Long%20Island%20City%2C%20NY%2011101%2C%20USA!5e0!3m2!1sen!2s!4v1571157449312!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Fair Calculator -->

            <!-- Call to action -->
            <div class="container-fluid callto">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <h1>Are you ready?</h1>
                        <p>We’re committed to helping you get where you want to go with confidence, whether it’s building emergency features in the app or making it easy for you to check your ride.</p>
                        <a href="{{ url('/rider-signup') }}" class="btn btn-white">Ride Now</a>
                    </div>
                </div>
            </div>
            <!-- /Call to action -->

            <!-- Product for -->
            <div class="container-fluid product-use inner">
                <div class="container">
                    <h2>Other ride options</h2>
                    <div class="row align-items-center justify-content-center">
                        <div class="col pr-box">
                            <div class="thumbnail-span">
                                <img class="img-fluid" src="img/ride-1.jpg" alt="">
                            </div>
                            <div class="data">
                                <strong>alphaexpress</strong>
                                <p>Promote your business around</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col pr-box">
                            <div class="thumbnail-span">
                                <img class="img-fluid" src="img/ride-2.jpg" alt="">
                            </div>
                            <div class="data">
                                <strong>alphaluxury</strong>
                                <p>Promote your business around</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col pr-box">
                            <div class="thumbnail-span">
                                <img class="img-fluid" src="img/ride-3.jpg" alt="">
                            </div>
                            <div class="data">
                                <strong>AlphaSUV</strong>
                                <p>Promote your business around</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col pr-box">
                            <div class="thumbnail-span">
                                <img class="img-fluid" src="img/ride-4.jpg" alt="">
                            </div>
                            <div class="data">
                                <strong>AlphaUL (ultra-luxury)</strong>
                                <p>Promote your business around</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Product for -->
      
            <!-- Modal -->
            <div class="modal fade" id="fleetInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Black SUV</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="fare-info">
                                <div class="row">
                                    <div class="col">
                                        <h5>Pickup</h5>
                                        <hr>
                                        <ul class="nostyle">
                                            <li>
                                                <strong>Base Fare</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Base Fare</strong>
                                                <span>$4.55</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <h5>During Trip</h5>
                                        <hr>
                                        <ul class="nostyle">
                                            <li>
                                                <strong>Booking Fee</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Minimum Fare</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Per Minute</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Per Mile</strong>
                                                <span>$4.55</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <h5>Cancellations</h5>
                                        <hr>
                                        <ul class="nostyle">
                                            <li>
                                                <strong>Cancellation Fee</strong>
                                                <span>Variable</span>
                                            </li>
                                            <li>
                                                <strong>Rider no-show Fee</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Standard rider-initiated cancellation fee</strong>
                                                <span>$4.55</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <h5>During Trip</h5>
                                        <hr>
                                        <ul class="nostyle">
                                            <li>
                                                <strong>Booking Fee</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Minimum Fare</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Per Minute</strong>
                                                <span>$4.55</span>
                                            </li>
                                            <li>
                                                <strong>Per Mile</strong>
                                                <span>$4.55</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p class="rider-note text-muted">
                                You agree to pay the fare shown at booking. If your route or destination changes on trip, your fare may change based on the rates above and other applicable taxes, tolls, charges and adjustments. US Partners: Rates used to calculate partner fares are published and require an active partner account to view. Additional wait time charges may apply to your trip if the driver has waited 5 minutes: PKR 1.15 per minute.
                            </p>
                            <button type="button" class="btn btn-blue">Signup to Ride <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
@endsection





@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHH2WyrHbuChuvGc1zkbY3LwiODEF8zGI&libraries=geometry,places"></script>

<!-- old API key
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU&libraries=geometry,places"></script>-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
<script src="{{ asset('js/jquery.geocomplete.min.js') }}"></script>
<script type="text/javascript">
  
  var map;
  var icon = '{{ asset("img/car-top-view-png.png") }}';
  var origin = [];
  var destination = [];


    
   
$(document).ready(function() { 

    map = new google.maps.Map(document.getElementById('map_canvas'), {
      center: new google.maps.LatLng(40.742482, -73.935416),
      zoom: 13
    });


    $("#pickup").geocomplete()
    .bind("geocode:result", function(event, result){
        $('#pickup-lat').val(result.geometry.location.lat());
        $('#pickup-lng').val(result.geometry.location.lng());
        origin = [result.geometry.location.lat(),result.geometry.location.lng()];
        drawRoute();
        //calculateFare();
    });
    $("#dropoff").geocomplete()
    .bind("geocode:result", function(event, result){
        $('#dropoff-lat').val(result.geometry.location.lat());
        $('#dropoff-lng').val(result.geometry.location.lng());
        destination = [result.geometry.location.lat(),result.geometry.location.lng()];
        drawRoute();
        //calculateFare();
    });

    function drawRoute()
    {
        if(origin.length>0){
            map = new google.maps.Map(document.getElementById('map_canvas'), {
              center: new google.maps.LatLng(origin[0], origin[1]),
              zoom: 13
            });

            if(destination.length>0){

                var directionsService = new google.maps.DirectionsService;
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    draggable: true,
                    map: map
                });

                directionsRenderer.addListener('directions_changed',function(){
                    var result = directionsRenderer.getDirections();
                    var legs = result.routes[0].legs[0];
                    console.log(legs);
                    $('#pickup').val(legs.start_address);
                    $('#dropoff').val(legs.end_address);
                    
                    $('#pickup-lat').val(legs.start_location.lat());
                    $('#pickup-lng').val(legs.start_location.lng());
                    $('#dropoff-lat').val(legs.end_location.lat());
                    $('#dropoff-lng').val(legs.end_location.lng());

                    origin = [legs.start_location.lat(),legs.start_location.lng()];
                    destination = [legs.end_location.lat(),legs.end_location.lng()];
                    calculateFare();
                });

                displayRoute(directionsService,directionsRenderer);
            }else{
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(origin[0],origin[1])
                });
                marker.setMap(map);
            }
        }
    }

    function displayRoute(service, display)  
    {  
        service.route({
            origin: new google.maps.LatLng(origin[0],origin[1]),
            destination: new google.maps.LatLng(destination[0],destination[1]),
            travelMode: 'DRIVING',
            avoidTolls: true        
        },function(response, status){
            if (status === 'OK') {
                display.setDirections(response);
            }else{
                alert('Could not display directions due to :' +status);
            }
            
        });
    } 

    function calculateFare()
    {
        var pickup_lat = $('#pickup-lat').val();
        var pickup_lng = $('#pickup-lng').val();
        var dropoff_lat = $('#dropoff-lat').val();
        var dropoff_lng = $('#dropoff-lng').val();

        if(pickup_lat != "" && pickup_lng != "" && dropoff_lat != "" && dropoff_lng != ""){
            $(".fleet-list").html('');
            var el = $(".calculator_form");
            el.LoadingOverlay("show");   
            $.ajax({
              type: 'post',
              url: '{{ url("calculate-fare") }}',
              dataType: "json",
              data: $(".calculator_form").serialize(),
              success:function (res) {
                   // console.log(res.categories);
                    el.LoadingOverlay("hide");
                   if(res.status){
                        $.each(res.categories, function(index,category){
                            if(category.total_charges>0){
                                $(".fleet-list").append('<li><span class="fleet-name">'+category.name+'</span><span class="fleet-price">$'+category.total_charges+'</span></li>');
                            }
                        });
                       }else{
                           
                       }
              },
                error: function (request, status, error) {
                  el.LoadingOverlay("hide");                         
                } 
              });
        }
    }

    

    if (window.location.hash) {         
        var hash = window.location.hash        
        if (hash != '') {
            setTimeout(function(){ $("html").scrollTop( 1280 ); }, 1000);    
       }        
    }

});
    

</script>

@endsection                            



