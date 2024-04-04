
<style>
      #map {
        height: 550px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
.form-control {
    display: block;
    width: 30%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    margin: 5px 0 5px 862px;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>

<input type="text" id="search_location" class="form-control" placeholder="Search Location" >

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfe1Nw8nQENKRT9WcLlz7Uu0wTlrrFLQU&libraries=geometry,places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="{{ asset('js/jquery.geocomplete.min.js') }}"></script>
<script>

    setInterval(getCars, 5000);

      var map;
      var icon = '{{ asset("img/car-top-view-png.png") }}';
      var markersArray = [];

      $(document).ready(function() { 
        
        initMap();

        $("#search_location").geocomplete()
          .bind("geocode:result", function(event, result){
            map = new google.maps.Map(document.getElementById('map'), {
              center: new google.maps.LatLng(result.geometry.location.lat(), result.geometry.location.lng()),
               zoom: 14
             });
          });
      });

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(40.742482, -73.935416),
           zoom: 14
         });
      };

        function getCars()
        {
            $.ajax({
              type: 'get',
              url: '{{ url("get-drivers") }}',
              dataType: "json",
              success:function (res) {
                
                   if(res.status){
                        //google.maps.Map.prototype.clearOverlays = function() {
                          for (var i = 0; i < markersArray.length; i++ ) {
                              markersArray[i].setMap(null);
                            }
                            markersArray.length = 0;
                         // }
                        $.each(res.drivers, function(index,driver){

                
                          if(driver.car_icon != 'https://alpharides.com/uploads/thumbs/no_image.png' && driver.car_icon != 'http://alpharides.com/uploads/thumbs/no_image.png' && driver.car_icon != 'https://alpharides.com/public/uploads/thumbs/no_image.png' && driver.car_icon != 'http://alpharides.com/public/uploads/thumbs/no_image.png'){
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(driver.lat, driver.lon),
                                    icon: driver.car_icon,
                                    map: map,
                                    title: driver.driver.name +' ('+ driver.driver.phone_number+' )'
                                });
                                markersArray.push(marker);
                            }
                        });
                       }else{
                           
                       }
              },
                error: function (request, status, error) {
                                          
                } 
              });
        }
    </script>




