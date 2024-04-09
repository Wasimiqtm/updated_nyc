@extends('layouts.app')

<!-- @section('title')
Affordable Black Car Airport Service Nyc - Sprinter and limo services NY NJ JFK
@endsection

@section('meta_description')
Every Ultra Luxury Sedan, Luxury Sedan, Executive Sedan, Luxury SUVs, Sprinter Vans are late model equipped with the newest and convenient features. From refined styling to sophisticated and easy booking system.
@endsection -->
<!--
@section('css')


@endsection
 -->
@section('content')

    <main class="main">
      <section class="section banner-home1">
        <div class="box-swiper">
          <div class="swiper-container swiper-banner-1 pb-0">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h1 class="heading-32-medium color-white wow fadeInUp">Airport Car Service</h1>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner2.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h1 class="heading-32-medium color-white wow fadeInUp">Airport Transfer</h1>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner3.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h1 class="heading-32-medium color-white wow fadeInUp">Black Car Service</h1>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner4.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h1 class="heading-32-medium color-white wow fadeInUp">SUV Service in nyc</h1>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner5.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h1 class="heading-32-medium color-white wow fadeInUp">Sprinter Van Service ny</h1>
                </div>
              </div>
            </div>
            <div class="box-pagination-button">
              <div class="swiper-button-prev swiper-button-prev-banner"></div>
              <div class="swiper-button-next swiper-button-next-banner"></div>
              <div class="swiper-pagination swiper-pagination-banner"></div>
            </div>
          </div>
        </div>
 <div class="box-search-ride box-search-ride-style-2">
            <div class="box-search-tabs wow fadeInUp">
              <div class="head-tabs">
                <ul class="nav nav-tabs nav-tabs-search" role="tablist">
                  <li><a class="active" href="#tab-distance" data-bs-toggle="tab" role="tab" aria-controls="tab-distance" aria-selected="true">One Way</a></li>
                  <li><a href="#tab-hourly" data-bs-toggle="tab" role="tab" aria-controls="tab-hourly" aria-selected="false">Hourly</a></li>
                  <li><a href="#tab-rate" data-bs-toggle="tab" role="tab" aria-controls="tab-rate" aria-selected="false">Round Trip</a></li>
                </ul>
              </div>
              <div class="tab-content">

                  <div class="tab-pane fade active show" id="tab-distance" role="tabpanel" aria-labelledby="tab-distance">
                    <div class="box-form-search">
                        <form id="formOneWay" action="{{url('ride-request/create-step1')}}" class="booking-form-1 w-100" method="post">
                          {{ csrf_field() }}
                        <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {{--<input class="search-input " type="text" placeholder="Pick Up Address">--}}
                        {!! Form::text('pickup_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                        {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                        {!! Form::hidden('lng', null, ['id' => "lng"]) !!}
                      </div>
                    </div>
                       <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {{--<input class="search-input " type="text" placeholder="Drop Off Address">--}}
                        {!! Form::text('dropoff_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                        {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                        {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}
                      </div>
                    </div>
                          <div class="airport_data_OneWay" style="display: none">
                            <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                            <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                            <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                          </div>
                          <div class="select-wrapper" style="display:none;">
                            <i class="fa fa-angle-down"></i>
                            <select name="return-journey">
                              <option value="false">One Way</option>
                              <option value="true">Return</option>
                            </select>
                          </div>
                    <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Date</label>
                        {{--<input class="search-input datepicker-2" type="text" placeholder="" value="Thu, Oct 06, 2022">--}}
                        <input class="search-input datepicker pickup-date1" name="pickup_date" type="text" placeholder="" value="" required>
                      </div>
                    </div>
                          @if ($errors->has('pickup_date'))
                            <span class="help-block with-errors">
                                                {{ $errors->first('pickup_date') }}
                                            </span>
                          @endif
                    <div class="search-item search-time">
                      <div class="search-icon"> <span class="item-icon icon-time"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Pick Up Time</label>
                        {{--<input class="search-input" type="time" placeholder="" >--}}
                        <input class="search-input" name="pickup_time_hour" type="time" placeholder="" required>
                      </div>
                    </div>
                    <div class="search-item search-button mb-0">
                      <input type="hidden" name="form_type" value="one_way" />
                      <input type="hidden" name="external_form" value="true" />
                      <button class="btn btn-search" type="submit"> <img src="{{asset('assets/imgs/template/icons/search.svg')}}" alt="luxride">Search</button>
                    </div>
                    </form>
                  </div>
                  </div>

                  <div class="tab-pane fade" id="tab-hourly" role="tabpanel" aria-labelledby="tab-hourly">
                    <div class="box-form-search">
                      <form id="formHourly" action="{{url('ride-request/create-step1')}}" class="booking-form-1 w-100" method="post">
                        {{ csrf_field() }}
                          <div class="search-item search-date">
                        <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                        <div class="search-inputs">
                          {!! Form::text('pickup_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                          {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                          {!! Form::hidden('lng', null, ['id' => "lng"]) !!}
                        </div>
                      </div>
                          <div class="search-item search-date">
                        <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                        <div class="search-inputs">
                        {{--<select class="search-input form-control">
                            <option>Select Trip Duration</option>
                            <option>4Hour(s)</option>
                            <option>5Hour(s)</option>
                            <option>6Hour(s)</option>
                            <option>7Hour(s)</option>
                        </select>--}}
                          <select name="number_of_hours" class="ch-num-hours search-input form-control"><option value="4">4 Hour(s)</option><option value="5">5 Hour(s)</option><option value="6">6 Hour(s)</option><option value="7">7 Hour(s)</option><option value="8">8 Hour(s)</option><option value="9">9 Hour(s)</option><option value="10">10 Hour(s)</option><option value="11">11 Hour(s)</option><option value="12">12 Hour(s)</option><option value="13">13 Hour(s)</option><option value="14">14 Hour(s)</option><option value="15">15 Hour(s)</option><option value="16">16 Hour(s)</option><option value="17">17 Hour(s)</option><option value="18">18 Hour(s)</option><option value="19">19 Hour(s)</option><option value="20">20 Hour(s)</option><option value="21">21 Hour(s)</option><option value="22">22 Hour(s)</option><option value="23">23 Hour(s)</option><option value="24">24 Hour(s)</option><option value="25">25 Hour(s)</option><option value="26">26 Hour(s)</option><option value="27">27 Hour(s)</option><option value="28">28 Hour(s)</option><option value="29">29 Hour(s)</option><option value="30">30 Hour(s)</option><option value="31">31 Hour(s)</option><option value="32">32 Hour(s)</option><option value="33">33 Hour(s)</option><option value="34">34 Hour(s)</option><option value="35">35 Hour(s)</option><option value="36">36 Hour(s)</option><option value="37">37 Hour(s)</option><option value="38">38 Hour(s)</option><option value="39">39 Hour(s)</option><option value="40">40 Hour(s)</option><option value="41">41 Hour(s)</option><option value="42">42 Hour(s)</option><option value="43">43 Hour(s)</option><option value="44">44 Hour(s)</option><option value="45">45 Hour(s)</option><option value="46">46 Hour(s)</option><option value="47">47 Hour(s)</option><option value="48">48 Hour(s)</option></select>
                          <!--<input class="search-input " type="text" placeholder="Drop Off Address">-->
                        </div>
                      </div>
                         <div class="search-item search-date">
                        <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                        <div class="search-inputs">
                          {!! Form::text('dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                          {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                          {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}
                        </div>
                      </div>

                        <div class="airport_data_Hourly" style="display: none">
                          <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                          <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                          <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                        </div>

                      <div class="search-item search-date">
                        <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                        <div class="search-inputs">
                          <label class="text-14 color-grey">Date</label>
{{--                          <input class="search-input datepicker-2" type="text" placeholder="" value="Thu, Oct 06, 2022">--}}
                          <input type="text" name="pickup_date" class="datepicker pickup-date2 search-input datepicker-2" value="" placeholder="Pick Up Date" required />

                        </div>
                      </div>
                      <div class="search-item search-time">
                        <div class="search-icon"> <span class="item-icon icon-time"> </span></div>
                        <div class="search-inputs">
                          <label class="text-14 color-grey">Pick Up Time</label>
                          <input class="search-input" name="pickup_time_hour" type="time" placeholder="" required>
                        </div>
                      </div>
                        <input type="hidden" name="form_type" value="hourly" />
                        <input type="hidden" name="external_form" value="true" />
                      <div class="search-item search-button mb-0">
                        <button class="btn btn-search" type="submit"> <img src="{{asset('assets/imgs/template/icons/search.svg')}}" alt="luxride">Search</button>
                      </div>
                      </form>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="tab-rate" role="tabpanel" aria-labelledby="tab-rate">
                  <div class="box-form-search">
                    <form id="formFlat" action="{{url('ride-request/create-step1')}}" class="booking-form-1 w-100" method="post">
                      {{ csrf_field() }}
                        <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {!! Form::text('pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                        {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                        {!! Form::hidden('lng', null, ['id' => "lng"]) !!}
                      </div>

                          <div class="airport_data_Flat" style="display: none">
                            <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                            <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                            <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                          </div>

                    </div>
                       <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {!! Form::text('dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                        {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                        {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}
                      </div>
                    </div>
                    <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Date</label>
{{--                        <input class="search-input datepicker-2" type="text" placeholder="" value="Thu, Oct 06, 2022">--}}
                        <input class="search-input datepicker datepicker-2 pickup-date1" name="pickup_date" type="text" placeholder="Pick Up Date" value="" required>
                      </div>
                    </div>
                    <div class="search-item search-time">
                      <div class="search-icon"> <span class="item-icon icon-time"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Pick Up Time</label>
                        <input class="search-input" name="pickup_time_hour" type="time" placeholder="" required>
                      </div>
                    </div>
                    <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {!! Form::text('round_pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress2", 'required' => 'required']) !!}
                        {!! Form::hidden('lat3', null, ['id' => "lat3"]) !!}
                        {!! Form::hidden('lng3', null, ['id' => "lng3"]) !!}
                      </div>
                    </div>
                       <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        {!! Form::text('round_dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress2", 'required' => 'required']) !!}
                        {!! Form::hidden('lat4', null, ['id' => "lat4"]) !!}
                        {!! Form::hidden('lng4', null, ['id' => "lng4"]) !!}
                      </div>
                    </div>
                      <div class="airport_data_Flat1" style="display: none">
                        <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name1"  name="flight_name1" type="text" >
                        <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number1"  name="flight_number1" type="text" >
                        <input class="form-control pac-target-input" placeholder="terminal" id="terminal1"  name="terminal1" type="text" >
                      </div>
                    <div class="search-item search-date">
                      <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Date</label>
                        {{--                        <input class="search-input datepicker-2" type="text" placeholder="" value="Thu, Oct 06, 2022">--}}
                        <input class="search-input datepicker datepicker-2 pickup-date1" name="round_pickup_date" type="text" placeholder="Pick Up Date" value="" required>
                      </div>
                    </div>

                    <div class="search-item search-time">
                      <div class="search-icon"> <span class="item-icon icon-time"> </span></div>
                      <div class="search-inputs">
                        <label class="text-14 color-grey">Pick Up Time</label>
                        <input class="search-input" name="round_pickup_time_hour" type="time" placeholder="" required>
                      </div>
                    </div>
                      <input type="hidden" name="form_type" value="flat" />
                      <input type="hidden" name="external_form" value="true" />
                    <div class="search-item search-button mb-0">
                      <button class="btn btn-search" type="submit"> <img src="{{asset('assets/imgs/template/icons/search.svg')}}" alt="luxride">Search</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--<form id="formOneWay" action="{{url('ride-request/create-step1')}}" class="booking-form-1" method="post">-->
        <!--  {{ csrf_field() }}-->
        <!--  <div class="box-search-ride wow fadeInUp">-->
        <!--  <div class="search-item search-date">-->
        <!--    <div class="search-icon"> <span class="item-icon icon-date"> </span></div>-->
        <!--    <div class="search-inputs">-->
        <!--      <label class="text-14 color-grey">Date</label>-->
        <!--      <input class="search-input datepicker pickup-date1" name="pickup_date" type="text" placeholder="Pick Up Date" value="">-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="search-item search-time">-->
        <!--    <div class="search-icon"> <span class="item-icon icon-time"> </span></div>-->
        <!--    <div class="search-inputs">-->
        <!--      <label class="text-14 color-grey">Time</label>-->
        <!--      <input class="search-input timepicker" name="pickup_time_hour" type="text" placeholder="" value="Pick Up Time">-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="search-item search-from">-->
        <!--    <div class="search-icon"> <span class="item-icon icon-from"> </span></div>-->
        <!--    <div class="search-inputs">-->
        <!--      <label class="text-14 color-grey">From</label>-->
        <!--      {!! Form::text('pickup_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}-->
        <!--      {!! Form::hidden('lat', null, ['id' => "lat"]) !!}-->
        <!--      {!! Form::hidden('lng', null, ['id' => "lng"]) !!}-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="search-item search-to">-->
        <!--    <div class="search-icon"> <span class="item-icon icon-to"> </span></div>-->
        <!--    <div class="search-inputs">-->
        <!--      <label class="text-14 color-grey">To</label>-->
        <!--      {!! Form::text('dropoff_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}-->
        <!--      {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}-->
        <!--      {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}-->
        <!--    </div>-->
        <!--  </div>-->
        <!--    <input type="hidden" name="form_type" value="one_way" />-->
        <!--    <input type="hidden" name="external_form" value="true" />-->
        <!--  <div class="search-item search-button">-->
        <!--    <button class="btn btn-search" type="submit"> Submit</button>-->
        <!--  </div>-->
        <!--</div>-->
        <!--</form>-->

      </section>
      <section class="section pt-65 pb-35 border-bottom">
          <div class="container">
               <div class="row ">
                   <div class="col-lg-8 col-xl-7 col-md-6 col-sm-12">

          <h2 class="heading-44-medium color-text wow fadeInUp" style="font-size:35px">Here's what you can expect when you ride with AlphaRides</h2>
          <h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">Prices With No Surprises</h3>
          <p class="text-16 color-text">At AlphaRides, we understand that one of the biggest concerns when it comes to hiring a taxi service is uncertainty about pricing. No one likes surprises, especially when it comes to costs. That's why we're committed to providing you with transparent pricing every step of the way. With our "Prices With No Surprises" guarantee, you can enjoy your ride without worrying about unexpected charges or hidden fees.</p>
          <h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">Clear Fare Estimates Before Payment:</h3>
          <p class="text-16 color-text">Before you even book your ride, you'll receive a clear and accurate fare estimate. Simply enter your pickup and drop-off locations in our app or website, and we'll provide you with an estimate of the cost upfront. No more guessing games or unexpected surges – you'll know exactly how much your ride will cost.</p>
          <h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">No Surge Pricing:</h3>
          <p class="text-16 color-text">We believe in fair pricing, which is why we never engage in surge pricing. Whether it's rush hour or a busy weekend night, you can trust that our prices will remain consistent and reasonable.</p>

<h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">Transparent Billing:</h3>
<p class="text-16 color-text">Say goodbye to confusing invoices. With us, you'll receive a straightforward and transparent bill detailing the cost of your ride, including any applicable taxes or fees. We'll never sneak in extra charges or hidden fees – what you see is what you pay.</p>

<h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">Multiple Payment Options:</h3>
<p class="text-16 color-text">Paying for your ride should be convenient and hassle-free. That's why we offer multiple payment options, including credit/debit cards etc. Choose the method that works best for you and enjoy a seamless payment experience.</p>

<h3 class="heading-44-medium color-text wow fadeInUp" style="font-size:25px">24/7 Customer Support:</h3>
<p class="text-16 color-text">Have questions about pricing or need assistance with your ride? Our dedicated customer support team is available 24/7 to help. Whether you prefer to chat online, send an email @ <b>booking.alpharides@gmail.com</b>, or speak with a live representative on <b>800 786 0393</b>, we're here to ensure your experience is smooth and stress-free.</p>
                   </div>
                   <div class="col-lg-4 col-xl-5 col-md-6 col-sm-12">
                       <img src="{{asset('assets/imgs/page/homepage1/car3.jpeg')}}" alt="Luxride">
                         </div>
          </div>
           </div>

      </section>
      <section class="section pt-120 pb-120 bg-our-fleet">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-lg-6 col-7">
              <h2 class="heading-44-medium title-fleet wow fadeInUp">Our Fleet</h2>
            </div>
            <div class="col-lg-6 col-5 text-end"><a class="text-16-medium color-primary wow fadeInUp" href="https://alpharides.com/fleets">More Fleet
                <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                </svg></a></div>
          </div>
        </div>
        <div class="box-slide-fleet mt-50">
          <div class="box-swiper">
            <div class="swiper-container swiper-group-4-fleet pb-0">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="cardFleet wow fadeInUp">
                    <div class="cardInfo"><a href="fleet-single.html">
                        <h3 class="text-20-medium color-text mb-10">Business Class</h3></a>
                      <p class="text-14 color-text mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p>
                    </div>
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="{{asset('assets/imgs/page/homepage1/e-class.png')}}" alt="Luxride"></a></div>
                    <div class="cardInfoBottom">
                      <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                      <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardFleet wow fadeInUp">
                    <div class="cardInfo"><a href="fleet-single.html">
                        <h3 class="text-20-medium color-text mb-10">First Class</h3></a>
                      <p class="text-14 color-text mb-30">Mercedes-Benz EQS, BMW 7 Series, Audi A8 or similar</p>
                    </div>
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="{{asset('assets/imgs/page/homepage1/eqs.png')}}" alt="Luxride"></a></div>
                    <div class="cardInfoBottom">
                      <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                      <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardFleet wow fadeInUp">
                    <div class="cardInfo"><a href="fleet-single.html">
                        <h3 class="text-20-medium color-text mb-10">Business Van/SUV</h3></a>
                      <p class="text-14 color-text mb-30">Mercedes-Benz V-Class, Chevrolet Suburban, Cadillac Escalade, Toyota Alphard or similar</p>
                    </div>
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="{{asset('assets/imgs/page/homepage1/suv.png')}}" alt="Luxride"></a></div>
                    <div class="cardInfoBottom">
                      <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                      <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardFleet wow fadeInUp">
                    <div class="cardInfo"><a href="fleet-single.html">
                        <h3 class="text-20-medium color-text mb-10">Electric Class</h3></a>
                      <p class="text-14 color-text mb-30">Mercedes-Benz V-Class, Chevrolet Suburban, Cadillac Escalade, Toyota Alphard or similar</p>
                    </div>
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="{{asset('assets/imgs/page/homepage1/v-class.png')}}" alt="Luxride"></a></div>
                    <div class="cardInfoBottom">
                      <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                      <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-pagination-fleet">
                <div class="swiper-button-prev swiper-button-prev-fleet">
                  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                  </svg>
                </div>
                <div class="swiper-button-next swiper-button-next-fleet">
                  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section pt-120 pb-20 bg-primary bg-how-it-works">
        <div class="container-sub">
          <h2 class="heading-44-medium color-white mb-60 wow fadeInUp">How It Works</h2>
          <div class="row">
            <div class="col-lg-6 order-lg-last">
              <div class="box-main-slider">
                <div class="detail-gallery wow fadeInUp">
                  <div class="main-image-slider">
                    <figure><img src="{{asset('assets/imgs/page/homepage1/laptop.png')}}" alt="luxride"></figure>
                    <figure><img src="{{asset('assets/imgs/page/homepage1/desktop.png')}}" alt="luxride"></figure>
                    <figure><img src="{{asset('assets/imgs/page/homepage1/desktop2.png')}}" alt="luxride"></figure>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 order-lg-first justify-content-between position-z3 wow fadeInUp">
              <ul class="slider-nav-thumbnails list-how">
                <li> <span class="line-white"></span>
                  <h4 class="text-20-medium mb-20">Create Your Route</h4>
                  <p class="text-16">Enter your pickup & dropoff locations or the number of hours you wish to book a car and driver for</p>
                </li>
                <li> <span class="line-white"></span>
                  <h4 class="text-20-medium mb-20">Choose Vehicle For You</h4>
                  <p class="text-16">On the day of your ride, you will receive confirmation email with complete ride details</p>
                </li>
                <li> <span class="line-white"></span>
                  <h4 class="text-20-medium mb-20">Enjoy The Journey</h4>
                  <p class="text-16">After your ride has taken place, we would appreciate it if you could rate your car and driver.</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="section mt-110">
        <div class="container-sub">
          <div class="text-center">
            <h2 class="heading-44-medium color-text wow fadeInUp">Make Your Trip Your Way With Us</h2>
          </div>
          <div class="row mt-50 cardIconStyleCircle">
            <div class="col-lg-4">
              <div class="cardIconTitleDesc wow fadeInUp">
                <div class="cardIcon"><img src="{{asset('assets/imgs/page/homepage1/safe.svg')}}" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Safety First</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">Booking your ride with AlphaRides, is quick and easy. Simply visit our website to reserve your ride in advance. Need a ride? Our Booking System allows you to book a ride with just a few taps, ensuring that you always have transportation when you need it.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardIconTitleDesc wow fadeInUp">
                <div class="cardIcon"><img src="{{asset('assets/imgs/page/homepage1/price.svg')}}" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Prices With No Surprises</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">With AlphaRides, you'll never have to worry about hidden fees or unexpected surcharges. Our transparent pricing ensures that you know exactly what to expect before you book your ride. Plus, with multiple payment options available, paying for your ride is convenient and hassle-free.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardIconTitleDesc wow fadeInUp">
                <div class="cardIcon"><img src="{{asset('assets/imgs/page/homepage1/vehicle.svg')}}" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Professional and Reliable Drivers</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">At Alpharides, we take pride in our team of professional drivers. Friendly, courteous, and knowledgeable, our drivers are dedicated to providing you with a safe and comfortable ride every time. Whether you need local recommendations or simply prefer a quiet journey, our drivers are here to accommodate your requests.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section mb-30 mt-80 box-showcase">
        <div class="bg-showcase pt-100 pb-70">
          <div class="container-sub">
            <div class="row align-items-center">
              <div class="col-lg-6 mb-30">
                <h2 class="heading-44-medium color-white wow fadeInUp">Showcase some impressive numbers.</h2>
              </div>
              <div class="col-lg-6">
                <div class="row align-items-center">
                  <div class="col-4 mb-30 wow fadeInUp">
                    <div class="box-number">
                      <h2 class="heading-44-medium color-white">285</h2>
                      <p class="text-20 color-white">Vehicles</p>
                    </div>
                  </div>
                  <div class="col-4 mb-30 wow fadeInUp">
                    <div class="box-number">
                      <h2 class="heading-44-medium color-white">97</h2>
                      <p class="text-20 color-white">Awards</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-12 mb-30 wow fadeInUp">
                    <div class="box-number">
                      <h2 class="heading-44-medium color-white">13K</h2>
                      <p class="text-20 color-white">Happy Customer</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section pt-90 pb-120 bg-our-service">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-lg-6 col-sm-7 col-7">
              <h2 class="heading-44-medium title-fleet wow fadeInUp">Our Services</h2>
            </div>
            <div class="col-lg-6 col-sm-5 col-5 text-end"><a class="text-16-medium color-primary d-flex align-items-center justify-content-end wow fadeInUp" href="https://alpharides.com/services">More Services
                <svg class="icon-16 ml-5" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                </svg></a></div>
          </div>
        </div>
        <div class="box-slide-fleet mt-50">
          <div class="box-swiper">
            <div class="swiper-container swiper-group-4-service pb-0">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="cardService wow fadeInUp">
                    <div class="cardInfo">
                      <h3 class="cardTitle text-20-medium color-white mb-10">Luxury Sprinter Van in ny</h3>
                      <div class="box-inner-info">
                        <p class="cardDesc text-14 color-white mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p><a class="cardLink btn btn-arrow-up" href="service-single.html">
                          <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                          </svg></a>
                      </div>
                    </div>
                    <div class="cardImage"><img src="{{asset('assets/imgs/page/homepage1/service1.png')}}" alt="Luxride"></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardService wow fadeInUp">
                    <div class="cardInfo">
                      <h3 class="cardTitle text-20-medium color-white mb-10">Chauffeur Hailing</h3>
                      <div class="box-inner-info">
                        <p class="cardDesc text-14 color-white mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p><a class="cardLink btn btn-arrow-up" href="service-single.html">
                          <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                          </svg></a>
                      </div>
                    </div>
                    <div class="cardImage"><img src="{{asset('assets/imgs/page/homepage1/service2.png')}}" alt="Luxride"></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardService wow fadeInUp">
                    <div class="cardInfo">
                      <h3 class="cardTitle text-20-medium color-white mb-10">Airport Transfers</h3>
                      <div class="box-inner-info">
                        <p class="cardDesc text-14 color-white mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p><a class="cardLink btn btn-arrow-up" href="service-single.html">
                          <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                          </svg></a>
                      </div>
                    </div>
                    <div class="cardImage"><img src="{{asset('assets/imgs/page/homepage1/service3.png')}}" alt="Luxride"></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="cardService wow fadeInUp">
                    <div class="cardInfo">
                      <h3 class="cardTitle text-20-medium color-white mb-10">Sprinter Class</h3>
                      <div class="box-inner-info">
                        <p class="cardDesc text-14 color-white mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p><a class="cardLink btn btn-arrow-up" href="service-single.html">
                          <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                          </svg></a>
                      </div>
                    </div>
                    <div class="cardImage"><img src="{{asset('assets/imgs/page/homepage1/service5.png')}}" alt="Luxride"></div>
                  </div>
                </div>
              </div>
              <div class="box-pagination-fleet">
                <div class="swiper-button-prev swiper-button-prev-fleet">
                  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                  </svg>
                </div>
                <div class="swiper-button-next swiper-button-next-fleet">
                  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
     <!-- <section class="section pt-130 pb-130 bg-primary box-testimonials">
        <div class="container-sub">
          <div class="row">
            <div class="col-lg-5 col-md-6 mb-30">
              <div class="box-swiper">
                <div class="swiper-container swiper-group-testimonials pb-50">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote">
                          <div class="icon-quote"> </div>
                          <div class="info-quote">
                            <h5 class="color-white text-18-medium">Jonathan Miller</h5>
                            <p class="color-white text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote">
                          <div class="icon-quote"> </div>
                          <div class="info-quote">
                            <h5 class="color-white text-18-medium">Jonathan Miller</h5>
                            <p class="color-white text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote">
                          <div class="icon-quote"> </div>
                          <div class="info-quote">
                            <h5 class="color-white text-18-medium">Jonathan Miller</h5>
                            <p class="color-white text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote">
                          <div class="icon-quote"> </div>
                          <div class="info-quote">
                            <h5 class="color-white text-18-medium">Jonathan Miller</h5>
                            <p class="color-white text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                  </div>
                  <div class="box-pagination-testimonials mt-40 wow fadeInUp"> <span class="firstNumber"></span><span class="lastNumber"></span>
                    <div class="swiper-pagination swiper-pagination-testimonials"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-30 text-lg-end text-center d-none d-md-block">
              <div class="box-video wow fadeInUp"> <a class="btn btn-play popup-youtube hover-up" href="https://www.youtube.com/watch?v=sVPYIRF9RCQ"></a><img src="{{asset('assets/imgs/page/homepage1/img-video.png')}}" alt="luxride"></div>
            </div>
          </div>
        </div>
      </section>-->
      <section class="section pt-120 pb-120 bg-region">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-30">
              <div class="box-gallery justify-content-center justify-content-lg-start">
                <div class="gallery-1 wow fadeInUp"><img src="{{asset('assets/imgs/page/homepage1/img1.png')}}" alt="luxride"></div>
                <div class="gallery-2 wow fadeInUp"><img src="{{asset('assets/imgs/page/homepage1/img2.png')}}" alt="luxride"><img src="{{asset('assets/imgs/page/homepage1/img3.png')}}" alt="luxride"></div>
              </div>
            </div>
            <div class="col-lg-6 mb-30">
              <div class="box-region-right wow fadeInUp">
                <h2 class="heading-44-medium color-text mb-30">Looking for premium transportation?</h2>
                <p class="text-16 color-text mb-30">Looking for premium transportation services in all airports of New York, New Jersey, Hampton, and Suffolk, Long Island? Look no further than our luxury black car service. Whether you're heading to a business meeting, catching a flight, or attending a special event, we're here to provide you with top-notch transportation that exudes style, comfort, and reliability.

              </div>
            </div>
          </div>
        </div>
      </section>
     <!-- <section class="section pt-120 pb-90 bg-primary">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-lg-6 col-7">
              <h2 class="heading-44-medium color-white wow fadeInUp">Latest From News</h2>
            </div>
            <div class="col-lg-6 col-5 text-end"><a class="text-16-medium color-white hover-up d-inline-block wow fadeInUp" href="#">More News
                <svg class="icon-16 color-white" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                </svg></a></div>
          </div>
          <div class="row mt-50">
            <div class="col-lg-4">
              <div class="cardNews wow fadeInUp"><a href="blog-single.html">
                  <div class="cardImage">
                    <div class="datePost">
                      <div class="heading-52-medium color-white">14.</div>
                      <p class="text-14 color-white">Jun, 2022</p>
                    </div><img src="{{asset('assets/imgs/page/homepage1/news1.png')}}" alt="luxride">
                  </div></a>
                <div class="cardInfo">
                  <div class="tags mb-10"><a href="#">Travel</a></div><a class="color-white" href="blog-single.html">
                    <h3 class="text-20-medium color-white mb-20">3 hidden-gem destinations for your wish list</h3></a><a class="cardLink btn btn-arrow-up" href="blog-single.html">
                    <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                    </svg></a>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardNews wow fadeInUp"><a href="blog-single.html">
                  <div class="cardImage">
                    <div class="datePost">
                      <div class="heading-52-medium color-white">18.</div>
                      <p class="text-14 color-white">Jun, 2022</p>
                    </div><img src="{{asset('assets/imgs/page/homepage1/news2.png')}}" alt="luxride">
                  </div></a>
                <div class="cardInfo">
                  <div class="tags mb-10"><a href="#">Culture</a></div><a class="color-white" href="blog-single.html">
                    <h3 class="text-20-medium color-white mb-20">Explore the big things happening in Dallas</h3></a><a class="cardLink btn btn-arrow-up" href="blog-single.html">
                    <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                    </svg></a>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardNews wow fadeInUp"><a href="blog-single.html">
                  <div class="cardImage">
                    <div class="datePost">
                      <div class="heading-52-medium color-white">20.</div>
                      <p class="text-14 color-white">Jun, 2022</p>
                    </div><img src="{{asset('assets/imgs/page/homepage1/news3.png')}}" alt="luxride">
                  </div></a>
                <div class="cardInfo">
                  <div class="tags mb-10"><a href="#">News</a></div><a class="color-white" href="blog-single.html">
                    <h3 class="text-20-medium color-white mb-20">LA’s worst traffic areas and how to avoid them</h3></a><a class="cardLink btn btn-arrow-up" href="blog-single.html">
                    <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                    </svg></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>-->
      <!--<section class="section pt-80 mb-30 bg-faqs">
        <div class="container-sub">
          <div class="box-faqs">
            <div class="text-center">
              <h2 class="color-brand-1 mb-20 wow fadeInUp">Frequently Asked Questions</h2>
            </div>
            <div class="mt-60 mb-40">
              <div class="accordion wow fadeInUp" id="accordionFAQ">
                <div class="accordion-item">
                  <h5 class="accordion-header" id="headingOne">
                    <button class="accordion-button text-heading-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">How do I create an account?</button>
                  </h5>
                  <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">Sad ipscing elitrsed diamnonu myeir mod, sadipscing elitrsed dia morem ipsum dolor situamet consetetur loutrytru hury. Lorem ipsum dolor sitametco nsetetur sa cingelitrse diamonu eirmoid, sad ipscing elitrstrud diamtre ute riyutroui tout.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h5 class="accordion-header" id="headingTwo">
                    <button class="accordion-button text-heading-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How do I earn Easy Ride Rewards points?</button>
                  </h5>
                  <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">Sad ipscing elitrsed diamnonu myeir mod, sadipscing elitrsed dia morem ipsum dolor situamet consetetur loutrytru hury. Lorem ipsum dolor sitametco nsetetur sa cingelitrse diamonu eirmoid, sad ipscing elitrstrud diamtre ute riyutroui tout.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h5 class="accordion-header" id="headingThree">
                    <button class="accordion-button text-heading-5 collapsed text-heading-5 type=" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How can I add my credit card on the app for payments?</button>
                  </h5>
                  <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">Sad ipscing elitrsed diamnonu myeir mod, sadipscing elitrsed dia morem ipsum dolor situamet consetetur loutrytru hury. Lorem ipsum dolor sitametco nsetetur sa cingelitrse diamonu eirmoid, sad ipscing elitrstrud diamtre ute riyutroui tout.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h5 class="accordion-header" id="headingFour">
                    <button class="accordion-button text-heading-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">How do I become a Captain?</button>
                  </h5>
                  <div class="accordion-collapse collapse" id="collapseFour" aria-labelledby="headingFour" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">Sad ipscing elitrsed diamnonu myeir mod, sadipscing elitrsed dia morem ipsum dolor situamet consetetur loutrytru hury. Lorem ipsum dolor sitametco nsetetur sa cingelitrse diamonu eirmoid, sad ipscing elitrstrud diamtre ute riyutroui tout.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h5 class="accordion-header" id="headingFive">
                    <button class="accordion-button text-heading-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Where can I get more information, support or make a claim?     </button>
                  </h5>
                  <div class="accordion-collapse collapse" id="collapseFive" aria-labelledby="headingFive" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body">Sad ipscing elitrsed diamnonu myeir mod, sadipscing elitrsed dia morem ipsum dolor situamet consetetur loutrytru hury. Lorem ipsum dolor sitametco nsetetur sa cingelitrse diamonu eirmoid, sad ipscing elitrstrud diamtre ute riyutroui tout.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>-->
     <!-- <section class="section mt-50 bg-download">
        <div class="container-sub">
          <h2 class="heading-44-medium color-text mb-20 wow fadeInUp">Download the app</h2>
          <p class="color-text text-16 mb-60 wow fadeInUp">Have a personal driver at your fingertips no matter where you <br class="d-none d-md-block">are with our easy-to-use smartphone app.</p>
          <div class="box-button-download"> <a class="btn btn-download mr-15 hover-up wow fadeInUp" href="#">
              <div class="inner-download">
                <div class="icon-download"> <img src="{{asset('assets/imgs/template/icons/apple-icon.svg')}}" alt="luxride"></div>
                <div class="info-download"> <span class="text-download-top">Download on the</span><span class="text-14-medium">Apple Store</span></div>
              </div></a><a class="btn btn-download hover-up wow fadeInUp" href="#">
              <div class="inner-download">
                <div class="icon-download"> <img src="{{asset('assets/imgs/template/icons/google-icon.svg')}}" alt="luxride"></div>
                <div class="info-download"> <span class="text-download-top">Download on the</span><span class="text-14-medium">Apple Store</span></div>
              </div></a></div>
        </div>
      </section>-->
    </main>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHH2WyrHbuChuvGc1zkbY3LwiODEF8zGI&libraries=places"></script>
    <script src="{{asset('assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">

      jQuery(document).ready(function() {

        jQuery(window).keydown(function(event){
          if(event.keyCode == 13) {
            event.preventDefault();
            return false;
          }
        });
      });

      // var autocomplete = new google.maps.places.Autocomplete(jQuery("#formOneWay > #pickupaddress1")[0], {});
      var autocomplete = new google.maps.places.Autocomplete(document.getElementById("formOneWay").querySelector("#pickupaddress1"), {});

      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete, 'place_changed', function() {console.log(1);
        var place = autocomplete.getPlace();
        var address = place.formatted_address;
        if(place.name.includes("Airport")){


          jQuery(".airport_data_OneWay").show();
          jQuery("#flight_name").attr('required','required')
          jQuery("#flight_number").attr('required','required')
        }else{
          jQuery(".airport_data_OneWay").hide();
          jQuery("#flight_name").removeAttr('required')
          jQuery("#flight_number").removeAttr('required')
        }

        document.getElementById("formOneWay").querySelector("#lat").value = place.geometry.location.lat();
        document.getElementById("formOneWay").querySelector("#lng").value = place.geometry.location.lng();
      });

      // var autocomplete2 = new google.maps.places.Autocomplete(jQuery("#formOneWay > #dropoffaddress1")[0], {});
      var autocomplete2 = new google.maps.places.Autocomplete(document.getElementById("formOneWay").querySelector("#dropoffaddress1"), {});

      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete2, 'place_changed', function() {console.log(2);
        var place2 = autocomplete2.getPlace();
        var address2 = place2.formatted_address;

        document.getElementById("formOneWay").querySelector("#lat2").value = place2.geometry.location.lat();
        document.getElementById("formOneWay").querySelector("#lng2").value = place2.geometry.location.lng();

      });

      var autocomplete3 = new google.maps.places.Autocomplete(document.getElementById("formHourly").querySelector("#pickupaddress1"), {});

      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete3, 'place_changed', function() {console.log(3);
        var place3 = autocomplete3.getPlace();
        var address3 = place3.formatted_address;
        if(place3.name.includes("Airport")){


          jQuery(".airport_data_Hourly").show();
          jQuery("#flight_name").attr('required','required')
          jQuery("#flight_number").attr('required','required')
        }else{
          jQuery(".airport_data_Hourly").hide();
          jQuery("#flight_name").removeAttr('required')
          jQuery("#flight_number").removeAttr('required')
        }

        document.getElementById("formHourly").querySelector("#lat").value = place3.geometry.location.lat();
        document.getElementById("formHourly").querySelector("#lng").value = place3.geometry.location.lng();

      });

      var autocomplete4 = new google.maps.places.Autocomplete(document.getElementById("formHourly").querySelector("#dropoffaddress1"), {});

      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete4, 'place_changed', function() {console.log(4);
        var place4 = autocomplete4.getPlace();
        var address4 = place4.formatted_address;

        document.getElementById("formHourly").querySelector("#lat2").value = place4.geometry.location.lat();
        document.getElementById("formHourly").querySelector("#lng2").value = place4.geometry.location.lng();

      });

      // round trip
      var autocomplete5 = new google.maps.places.Autocomplete(document.getElementById("formFlat").querySelector("#pickupaddress1"), {});

      google.maps.event.addListener(autocomplete5, 'place_changed', function() {console.log(5);
        var place5 = autocomplete5.getPlace();
        var address5 = place5.formatted_address;
        if(place5.name.includes("Airport")){


          jQuery(".airport_data_Flat").show();
          jQuery("#flight_name").attr('required','required')
          jQuery("#flight_number").attr('required','required')
        }else{
          jQuery(".airport_data_Flat").hide();
          jQuery("#flight_name").removeAttr('required')
          jQuery("#flight_number").removeAttr('required')
        }

        document.getElementById("formFlat").querySelector("#lat").value = place5.geometry.location.lat();
        document.getElementById("formFlat").querySelector("#lng").value = place5.geometry.location.lng();

      });

      var autocomplete6 = new google.maps.places.Autocomplete(document.getElementById("formFlat").querySelector("#dropoffaddress1"), {});

      google.maps.event.addListener(autocomplete6, 'place_changed', function() {console.log(6);
        var place6 = autocomplete6.getPlace();
        var address6 = place6.formatted_address;


        document.getElementById("formFlat").querySelector("#lat2").value = place6.geometry.location.lat();
        document.getElementById("formFlat").querySelector("#lng2").value = place6.geometry.location.lng();

      });

      // var autocomplete7= new google.maps.places.Autocomplete(jQuery("#formFlat > #pickupaddress2")[0], {});
      var autocomplete7= new google.maps.places.Autocomplete(document.getElementById("formFlat").querySelector("#pickupaddress2"), {});

      google.maps.event.addListener(autocomplete7, 'place_changed', function() {console.log(7);
        var place7 = autocomplete7.getPlace();
        var address7 = place7.formatted_address;
        if(place7.name.includes("Airport")){


          jQuery(".airport_data_Flat1").show();
          jQuery("#flight_name").attr('required','required')
          jQuery("#flight_number").attr('required','required')
        }else{
          jQuery(".airport_data_Flat1").hide();
          jQuery("#flight_name").removeAttr('required')
          jQuery("#flight_number").removeAttr('required')
        }

        document.getElementById("formFlat").querySelector("#lat3").value = place7.geometry.location.lat();
        document.getElementById("formFlat").querySelector("#lng3").value = place7.geometry.location.lng();

      });

      // var autocomplete8 = new google.maps.places.Autocomplete(jQuery("#formFlat > #dropoffaddress2")[0], {});
      var autocomplete8 = new google.maps.places.Autocomplete(document.getElementById("formFlat").querySelector("#dropoffaddress2"), {});

      google.maps.event.addListener(autocomplete8, 'place_changed', function() {console.log(8);
        var place8 = autocomplete8.getPlace();
        var address8 = place8.formatted_address;


        document.getElementById("formFlat").querySelector("#lat4").value = place8.geometry.location.lat();
        document.getElementById("formFlat").querySelector("#lng4").value = place8.geometry.location.lng();

      });




    </script>

@endsection



