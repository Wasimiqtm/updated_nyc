@extends('layouts.app')



@section('css')


@endsection

@section('content')

    <div class="content-wrapper-outer content-wrapper-full clearfix">

        <!-- BEGIN .main-content -->
        <div class="main-content main-content-full">

            <div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-full clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill"><div class="vc_column-inner vc_custom_1483261287357"><div class="wpb_wrapper"><!-- BEGIN .large-header-wrapper -->
                                <div class="large-header-wrapper">

                                    <!-- BEGIN .large-header -->
                                    <div class="large-header">

                                        <!-- BEGIN .header-booking-form-wrapper -->
                                        <div class="header-booking-form-wrapper">

                                            <!-- BEGIN #booking-tabs -->
                                            <div id="booking-tabs">

                                                <ul class="nav clearfix">
                                                    <li><a id="tab1" href="#tab-one-way">Distance</a></li>
                                                    <li><a id="tab2" href="#tab-hourly">Hourly</a></li>
                                                    <li><a id="tab3" href="#tab-flat">Flat Rate</a></li>
                                                </ul>

                                                <!-- BEGIN #tab-one-way -->
                                                <div id="tab-one-way">

                                                    <!-- BEGIN .booking-form-1 -->
                                                    <form id="formOneWay" action="{{url('ride-request/create-step1')}}" class="booking-form-1" method="post">
                                                        {{ csrf_field() }}
                                                            {!! Form::text('pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                                                            {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                                                            {!! Form::hidden('lng', null, ['id' => "lng"]) !!}

                                                            {!! Form::text('dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                                                            {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                                                            {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}
                                                        <div class="airport_data" style="display: none">
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                                                        </div>
                                                        <div class="select-wrapper">
                                                            <i class="fa fa-angle-down"></i>
                                                            <select name="return-journey">
                                                                <option value="false">One Way</option>
                                                                <option value="true">Return</option>
                                                            </select>
                                                        </div>

                                                        <input type="text" name="pickup_date" class="datepicker pickup-date1" value="" placeholder="Pick Up Date" />

                                                        <div class="booking-form-time">
                                                            <label>Pick Up Time</label>
                                                        </div>

                                                        <div class="booking-form-hour">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_hour" class="time-hour1">
                                                                    <option value="01">01 AM</option>
                                                                    <option value="02">02 AM</option>
                                                                    <option value="03">03 AM</option>
                                                                    <option value="04">04 AM</option>
                                                                    <option value="05">05 AM</option>
                                                                    <option value="06">06 AM</option>
                                                                    <option value="07">07 AM</option>
                                                                    <option value="08">08 AM</option>
                                                                    <option value="09">09 AM</option>
                                                                    <option value="10">10 AM</option>
                                                                    <option value="11">11 AM</option>
                                                                    <option value="12">12 PM</option>
                                                                    <option value="13">1 PM</option>
                                                                    <option value="14">2 PM</option>
                                                                    <option value="15">3 PM</option>
                                                                    <option value="16">4 PM</option>
                                                                    <option value="17">5 PM</option>
                                                                    <option value="18">6 PM</option>
                                                                    <option value="19">7 PM</option>
                                                                    <option value="20">8 PM</option>
                                                                    <option value="21">9 PM</option>
                                                                    <option value="22">10 PM</option>
                                                                    <option value="23">11 PM</option>
                                                                    <option value="00">12 AM</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="booking-form-min">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_min" class="time-min1">
                                                                    <option value="00">00</option>
                                                                    <option value="05">05</option>
                                                                    <option value="10">10</option>
                                                                    <option value="15">15</option>
                                                                    <option value="20">20</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="35">35</option>
                                                                    <option value="40">40</option>
                                                                    <option value="45">45</option>
                                                                    <option value="50">50</option>
                                                                    <option value="55">55</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="form_type" value="one_way" />
                                                        <input type="hidden" name="external_form" value="true" />

                                                        <button type="submit">
                                                            <span> Submit</span>
                                                        </button>

                                                        <!-- END .booking-form-1 -->
                                                    </form>

                                                    <!-- END #tab-one-way -->
                                                </div>

                                                <!-- BEGIN #tab-hourly -->
                                                <div id="tab-hourly">

                                                    <!-- BEGIN .booking-form-1 -->
                                                    <form id="formHourly" action="{{url('ride-request/create-step1')}}" class="booking-form-1" method="post">
                                                        {{ csrf_field() }}

{{--                                                        <input type="text" name="pickup-address" id="pickup-address2" class="pickup-address" value="" placeholder="Pick Up Address" />--}}
                                                        {!! Form::text('pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                                                        {!! Form::hidden('lng', null, ['id' => "lng"]) !!}


                                                        <div class="airport_data" style="display: none">
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                                                        </div>
                                                        <div class="one-third">
                                                            <label>Trip Duration</label>
                                                        </div>

                                                        <div class="two-thirds last-col">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="number_of_hours" class="ch-num-hours"><option value="3">3 Hour(s)</option><option value="4">4 Hour(s)</option><option value="5">5 Hour(s)</option><option value="6">6 Hour(s)</option><option value="7">7 Hour(s)</option><option value="8">8 Hour(s)</option><option value="9">9 Hour(s)</option><option value="10">10 Hour(s)</option><option value="11">11 Hour(s)</option><option value="12">12 Hour(s)</option><option value="13">13 Hour(s)</option><option value="14">14 Hour(s)</option><option value="15">15 Hour(s)</option><option value="16">16 Hour(s)</option><option value="17">17 Hour(s)</option><option value="18">18 Hour(s)</option><option value="19">19 Hour(s)</option><option value="20">20 Hour(s)</option><option value="21">21 Hour(s)</option><option value="22">22 Hour(s)</option><option value="23">23 Hour(s)</option><option value="24">24 Hour(s)</option><option value="25">25 Hour(s)</option><option value="26">26 Hour(s)</option><option value="27">27 Hour(s)</option><option value="28">28 Hour(s)</option><option value="29">29 Hour(s)</option><option value="30">30 Hour(s)</option><option value="31">31 Hour(s)</option><option value="32">32 Hour(s)</option><option value="33">33 Hour(s)</option><option value="34">34 Hour(s)</option><option value="35">35 Hour(s)</option><option value="36">36 Hour(s)</option><option value="37">37 Hour(s)</option><option value="38">38 Hour(s)</option><option value="39">39 Hour(s)</option><option value="40">40 Hour(s)</option><option value="41">41 Hour(s)</option><option value="42">42 Hour(s)</option><option value="43">43 Hour(s)</option><option value="44">44 Hour(s)</option><option value="45">45 Hour(s)</option><option value="46">46 Hour(s)</option><option value="47">47 Hour(s)</option><option value="48">48 Hour(s)</option></select>
                                                            </div>
                                                        </div>

{{--                                                        <input type="text" name="dropoff-address" id="dropoff-address2" class="dropoff-address" value="" placeholder="Drop Off Address" />--}}
                                                        {!! Form::text('dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                                                        {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}


                                                        <input type="text" name="pickup_date" class="datepicker pickup-date2" value="" placeholder="Pick Up Date" />

                                                        <div class="booking-form-time">
                                                            <label>Pick Up Time</label>
                                                        </div>

                                                        <div class="booking-form-hour">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_hour" class="time-hour2">
                                                                    <option value="01">01 AM</option>
                                                                    <option value="02">02 AM</option>
                                                                    <option value="03">03 AM</option>
                                                                    <option value="04">04 AM</option>
                                                                    <option value="05">05 AM</option>
                                                                    <option value="06">06 AM</option>
                                                                    <option value="07">07 AM</option>
                                                                    <option value="08">08 AM</option>
                                                                    <option value="09">09 AM</option>
                                                                    <option value="10">10 AM</option>
                                                                    <option value="11">11 AM</option>
                                                                    <option value="12">12 PM</option>
                                                                    <option value="13">1 PM</option>
                                                                    <option value="14">2 PM</option>
                                                                    <option value="15">3 PM</option>
                                                                    <option value="16">4 PM</option>
                                                                    <option value="17">5 PM</option>
                                                                    <option value="18">6 PM</option>
                                                                    <option value="19">7 PM</option>
                                                                    <option value="20">8 PM</option>
                                                                    <option value="21">9 PM</option>
                                                                    <option value="22">10 PM</option>
                                                                    <option value="23">11 PM</option>
                                                                    <option value="00">12 AM</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="booking-form-min">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_min" class="time-min2">
                                                                    <option value="00">00</option>
                                                                    <option value="05">05</option>
                                                                    <option value="10">10</option>
                                                                    <option value="15">15</option>
                                                                    <option value="20">20</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="35">35</option>
                                                                    <option value="40">40</option>
                                                                    <option value="45">45</option>
                                                                    <option value="50">50</option>
                                                                    <option value="55">55</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="form_type" value="hourly" />
                                                        <input type="hidden" name="external_form" value="true" />

                                                        <button type="submit">
                                                            <span> Submit</span>
                                                        </button>

                                                        <!-- END .booking-form-1 -->
                                                    </form>

                                                    <!-- END #tab-hourly -->
                                                </div>

                                                <!-- BEGIN #tab-flat -->
                                                <div id="tab-flat">

                                                    <!-- BEGIN .booking-form-1 -->
                                                    <form id="formFlat" action="{{url('ride-request/create-step1')}}" class="booking-form-1" method="post">
                                                        {{ csrf_field() }}
                                                        {!! Form::text('pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
                                                        {!! Form::hidden('lng', null, ['id' => "lng"]) !!}
                                                        <div class="airport_data" style="display: none">
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Name" id="flight_name"  name="flight_name" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="Enter Flight Number" id="flight_number"  name="flight_number" type="text" >
                                                            <input class="form-control pac-target-input" placeholder="terminal" id="terminal"  name="terminal" type="text" >
                                                        </div>
                                                        {!! Form::text('dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
                                                        {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}

                                                        <input type="text" name="pickup_date" class="datepicker pickup-date1" value="" placeholder="Pick Up Date" />

                                                        <div class="booking-form-time">
                                                            <label>Pick Up Time</label>
                                                        </div>

                                                        <div class="booking-form-hour">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_hour" class="time-hour1">
                                                                    <option value="01">01 AM</option>
                                                                    <option value="02">02 AM</option>
                                                                    <option value="03">03 AM</option>
                                                                    <option value="04">04 AM</option>
                                                                    <option value="05">05 AM</option>
                                                                    <option value="06">06 AM</option>
                                                                    <option value="07">07 AM</option>
                                                                    <option value="08">08 AM</option>
                                                                    <option value="09">09 AM</option>
                                                                    <option value="10">10 AM</option>
                                                                    <option value="11">11 AM</option>
                                                                    <option value="12">12 PM</option>
                                                                    <option value="13">1 PM</option>
                                                                    <option value="14">2 PM</option>
                                                                    <option value="15">3 PM</option>
                                                                    <option value="16">4 PM</option>
                                                                    <option value="17">5 PM</option>
                                                                    <option value="18">6 PM</option>
                                                                    <option value="19">7 PM</option>
                                                                    <option value="20">8 PM</option>
                                                                    <option value="21">9 PM</option>
                                                                    <option value="22">10 PM</option>
                                                                    <option value="23">11 PM</option>
                                                                    <option value="00">12 AM</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="booking-form-min">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="pickup_time_min" class="time-min1">
                                                                    <option value="00">00</option>
                                                                    <option value="05">05</option>
                                                                    <option value="10">10</option>
                                                                    <option value="15">15</option>
                                                                    <option value="20">20</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="35">35</option>
                                                                    <option value="40">40</option>
                                                                    <option value="45">45</option>
                                                                    <option value="50">50</option>
                                                                    <option value="55">55</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        {!! Form::text('round_pickup_location', null, ['class' => 'form-control','placeholder'=>'Pick Up Address', 'id' => "pickupaddress2", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat3', null, ['id' => "lat3"]) !!}
                                                        {!! Form::hidden('lng3', null, ['id' => "lng3"]) !!}

                                                        {!! Form::text('round_dropoff_location', null, ['class' => 'form-control','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress2", 'required' => 'required']) !!}
                                                        {!! Form::hidden('lat4', null, ['id' => "lat4"]) !!}
                                                        {!! Form::hidden('lng4', null, ['id' => "lng4"]) !!}

                                                        <input type="text" name="round_pickup_date" class="datepicker pickup-date1" value="" placeholder="Pick Up Date" />

                                                        <div class="booking-form-time">
                                                            <label>Pick Up Time</label>
                                                        </div>

                                                        <div class="booking-form-hour">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="round_pickup_time_hour" class="time-hour1"><option value="01">01 AM</option>
                                                                    <option value="01">01 AM</option>
                                                                    <option value="02">02 AM</option>
                                                                    <option value="03">03 AM</option>
                                                                    <option value="04">04 AM</option>
                                                                    <option value="05">05 AM</option>
                                                                    <option value="06">06 AM</option>
                                                                    <option value="07">07 AM</option>
                                                                    <option value="08">08 AM</option>
                                                                    <option value="09">09 AM</option>
                                                                    <option value="10">10 AM</option>
                                                                    <option value="11">11 AM</option>
                                                                    <option value="12">12 PM</option>
                                                                    <option value="13">1 PM</option>
                                                                    <option value="14">2 PM</option>
                                                                    <option value="15">3 PM</option>
                                                                    <option value="16">4 PM</option>
                                                                    <option value="17">5 PM</option>
                                                                    <option value="18">6 PM</option>
                                                                    <option value="19">7 PM</option>
                                                                    <option value="20">8 PM</option>
                                                                    <option value="21">9 PM</option>
                                                                    <option value="22">10 PM</option>
                                                                    <option value="23">11 PM</option>
                                                                    <option value="00">12 AM</option></select>
                                                            </div>
                                                        </div>

                                                        <div class="booking-form-min">
                                                            <div class="select-wrapper">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select name="round_pickup_time_min" class="time-min1">
                                                                    <option value="00">00</option>
                                                                    <option value="05">05</option>
                                                                    <option value="10">10</option>
                                                                    <option value="15">15</option>
                                                                    <option value="20">20</option>
                                                                    <option value="25">25</option>
                                                                    <option value="30">30</option>
                                                                    <option value="35">35</option>
                                                                    <option value="40">40</option>
                                                                    <option value="45">45</option>
                                                                    <option value="50">50</option>
                                                                    <option value="55">55</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="form_type" value="flat" />
                                                        <input type="hidden" name="external_form" value="true" />

                                                        <button type="submit">
                                                            <span> Submit</span>
                                                        </button>

                                                        <!-- END .booking-form-1 -->
                                                    </form>

                                                    <!-- END #tab-flat -->
                                                </div>

                                                <!-- END #booking-tabs -->
                                            </div>

                                            <!-- END .header-booking-form-wrapper -->
                                        </div>

                                        <!-- END .large-header -->
                                    </div>

                                    <!-- END .large-header-wrapper -->
                                </div></div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-standard clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
                                <!-- BEGIN .content-wrapper-outer -->
                                <section class="content-wrapper-outer content-wrapper clearfix our-fleet-sections">

                                    <h3 class="center-title">Our Fleet</h3>
                                    <div class="title-block2"></div>

                                    <p class="fleet-intro-text">
                                        Every Ultra Luxury Sedan, Luxury Sedan, Executive Sedan, Luxury SUV, Sprinter Vans are late model equipped with the newest and convenient features. From refined styling to sophisticated and easy booking system. Choose from a wide selection of vehicles ranging from executive to luxury and SUV’s, we have every type of luxury and ultraluxury vehicles available to meet your needs. </p>


                                    <!-- BEGIN .fleet-block-wrapper -->
                                    <div class="owl-carousel1 fleet-block-wrapper">



                                        <!-- BEGIN .fleet-block -->
                                        <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-sedan/index.html" rel="bookmark" title="Mercedes Sedan">
                                                    <img src="wp-content/uploads/2017/02/standard.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/mercedes-sedan/index.html" rel="bookmark" title="Mercedes Sedan">Standard Sedan</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>3 Passengers</li>
                                                    <li>2 Bags</li>
                                                </ul>				</div>

                                            <!-- END .fleet-block -->
                                        </div>



                                        <!-- BEGIN .fleet-block -->
                                        <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-sedan/index.html" rel="bookmark" title="Mercedes Sedan">
                                                    <img src="wp-content/uploads/2017/02/executive.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/mercedes-sedan/index.html" rel="bookmark" title="Mercedes Sedan">Executive Sedan</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>3 Passengers</li>
                                                    <li>2 Bags</li>
                                                </ul>				</div>

                                            <!-- END .fleet-block -->
                                        </div>


                                        <!-- BEGIN .fleet-block -->
                                       <!-- <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-van/index.html" rel="bookmark" title="Mercedes Van">
                                                    <img src="wp-content/uploads/2017/02/image19-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                <div class="fleet-price">From $190</div>

                                                <h4><a href="fleet/mercedes-van/index.html" rel="bookmark" title="Mercedes Van">Mercedes Van</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>6 Passengers</li>
                                                    <li>6 Bags</li>
                                                </ul>				</div>

                                            
                                        </div>-->


                                        <!-- BEGIN .fleet-block -->
                                        


                                        <!-- BEGIN .fleet-block -->
                                        


                                        <!-- BEGIN .fleet-block -->
                                       <!-- <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/lincoln-mkt-2/index.html" rel="bookmark" title="Lincoln MKT">
                                                    <img src="wp-content/uploads/2017/02/image2-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                <div class="fleet-price">From $90</div>

                                                <h4><a href="fleet/lincoln-mkt-2/index.html" rel="bookmark" title="Lincoln MKT">Lincoln MKT</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>6 Passengers</li>
                                                    <li>3 Bags</li>
                                                </ul>				</div>

                                            
                                        </div>-->


                                        <!-- BEGIN .fleet-block -->
                                        <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-sedan-2/index.html" rel="bookmark" title="Mercedes Sedan">
                                                    <img src="wp-content/uploads/2017/02/luxury1.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/mercedes-sedan-2/index.html" rel="bookmark" title="Mercedes Sedan">Luxury Sedan</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>3 Passengers</li>
                                                    <li>3 Bags</li>
                                                </ul>				</div>

                                            <!-- END .fleet-block -->
                                        </div>


                                        <!-- BEGIN .fleet-block -->
                                       <!-- <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/bmw-grand-sedan-3/index.html" rel="bookmark" title="BMW Grand Sedan">
                                                    <img src="wp-content/uploads/2017/02/image1-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                <div class="fleet-price">From $110</div>

                                                <h4><a href="fleet/bmw-grand-sedan-3/index.html" rel="bookmark" title="BMW Grand Sedan">BMW Grand Sedan</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>4 Passengers</li>
                                                    <li>2 Bags</li>
                                                </ul>				</div>

                                            
                                        </div>-->





                                        <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/bmw-grand-sedan-2/index.html" rel="bookmark" title="BMW Grand Sedan">
                                                    <img src="wp-content/uploads/2017/02/image2-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/bmw-grand-sedan-2/index.html" rel="bookmark" title="BMW Grand Sedan">SUV</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>6 Passengers</li>
                                                    <li>5 Bags</li>
                                                </ul>				</div>

                                            <!-- END .fleet-block -->
                                        </div>


                                        <!-- BEGIN .fleet-block -->
                                        <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-sedan-3/index.html" rel="bookmark" title="Mercedes Sedan">
                                                    <img src="wp-content/uploads/2017/02/alphaultra.png" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/mercedes-sedan-3/index.html" rel="bookmark" title="Mercedes Sedan">Ultra Luxury Sedan</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>3 Passengers</li>
                                                    <li>3 Bags</li>
                                                </ul>				</div>

                                            <!-- END .fleet-block -->
                                        </div>


                                        <!-- BEGIN .fleet-block -->
                                       <!-- <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/mercedes-van-2-3/index.html" rel="bookmark" title="Mercedes Van">
                                                    <img src="wp-content/uploads/2017/02/image19-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                

                                                <h4><a href="fleet/mercedes-van-2-3/index.html" rel="bookmark" title="Mercedes Van">Mercedes Van</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>6 Passengers</li>
                                                    <li>6 Bags</li>
                                                </ul>				</div>

                                            
                                        </div>-->


                                        <!-- BEGIN .fleet-block -->
                                       <!-- <div class="fleet-block">


                                            <div class="fleet-block-image">

                                                <a href="fleet/ford-party-bus-3/index.html" rel="bookmark" title="Ford Party Bus">
                                                    <img src="wp-content/uploads/2017/02/image20-600x380.jpg" alt="" />						</a>
                                            </div>


                                            <div class="fleet-block-content">

                                                <div class="fleet-price">From $240</div>

                                                <h4><a href="fleet/ford-party-bus-3/index.html" rel="bookmark" title="Ford Party Bus">Ford Party Bus</a></h4>
                                                <div class="title-block3"></div>
                                                <ul class="list-style4">
                                                    <li>8 Passengers</li>
                                                    <li>5 Bags</li>
                                                </ul>				</div>

                                           
                                        </div>-->


                                        <!-- END .fleet-block-wrapper -->
                                    </div>


                                    <!-- END .content-wrapper-outer -->
                                </section>

                            </div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-full clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill"><div class="vc_column-inner vc_custom_1483319394148"><div class="wpb_wrapper"><!-- BEGIN .content-wrapper-outer -->
                                <section class=".content-wrapper-outer clearfix call-to-action-1-section" style="background:url(wp-content/uploads/2017/02/image12.jpg) no-repeat center top;">

                                    <div class="call-to-action-1-section-inner">

                                        <h3 style="text-align: center;">Nycblackcarservice has a wide array of pricing options to meet all of your needs.
                                        <br>
                                         
                                        Various booking methods to simplify the process
                                        </h3>

                                    </div>

                                    <!-- END .content-wrapper-outer -->
                                </section></div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-standard clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="clearfix"><div class="qns-one-half home-icon-wrapper-2">
                                        <div class="qns-home-icon"><i class="fa fa-calendar-check-o"></i></div>
                                        <div class="home-icon-inner">
                                            <h4>Easy Online Booking</h4>
                                            <div class="title-block3"></div>
                                            <p>Active and energetic Customer Service Team to ensure your requests. Online Reservations at your convenience, 24 hours a day, 7 days a week.</p>
                                        </div>
                                    </div><div class="qns-one-half home-icon-wrapper-2 qns-last">
                                        <div class="qns-home-icon"><i class="fa fa-star"></i></div>
                                        <div class="home-icon-inner">
                                            <h4>Professional Drivers</h4>
                                            <div class="title-block3"></div>
                                            <p>Nycblackcarservice proudly offers clean, modern vehicles, courteous, professional drivers. All Drivers receive formal training both prior to acceptance as a Franchisee and periodically at regularly scheduled refresher classes.</p>
                                        </div>
                                    </div><div class="qns-one-half home-icon-wrapper-2">
                                        <div class="qns-home-icon"><i class="fa fa-car"></i></div>
                                        <div class="home-icon-inner">
                                            <h4>Big Fleet Of Vehicles</h4>
                                            <div class="title-block3"></div>
                                            <p>The largest fleet of late model executive and luxury class vehicles in New York. Our fleet is meticulously cared for and maintained with the highest level of cleaning. We also apply a professional cleaning method for all Sedan and SUV. All of this created to provide our customers with the best service possible.</p>
                                        </div>
                                    </div><div class="qns-one-half home-icon-wrapper-2 qns-last">
                                        <div class="qns-home-icon"><i class="fa fa-cc-visa"></i></div>
                                        <div class="home-icon-inner">
                                            <h4>Online Payment</h4>
                                            <div class="title-block3"></div>
                                            <p>For a reservation, you just need to call us or book it online. We will book the most appropriate package for you once you are done with the payments,  leave the rest to us. Immediate confirmation after booking and automated pre-trip reminders
Rapid, detailed receipts to reconcile expenses.</p>
                                        </div>
                                    </div></div></div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-full clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill"><div class="vc_column-inner vc_custom_1483323508403"><div class="wpb_wrapper"><!-- BEGIN .clearfix -->
                                <section class="clearfix">

                                    <!-- BEGIN .about-us-block -->
                                    <div class="about-us-block about-us-block-1">

                                        <h3>About Us</h3>
                                        <div class="title-block4"></div>
                                        <p>Nycblackcarservice is the home of luxurious and professional Black Car Service. Customer comfort, satisfaction, and pleasure is our greatest priority. We offer top-quality Black Car Service for residential, office and airport pickup. We have been in operation for over a decade and our customers can testify to the outstanding and second to none service we have always rendered. We are always committed to ensure customer’s satisfaction.</p>
                                        

                                        <!-- END .about-us-block -->
                                    </div>

                                    <div class="video-wrapper video-wrapper-home" style="background:url(wp-content/uploads/2020/06/image6.jpg) no-repeat center top;">

                                       <!-- <div class="video-play">
                                            <a href="https://www.youtube.com/watch?v=u_2vohBw5sA" data-gal="prettyPhoto"><i class="fa fa-play"></i></a>
                                        </div>-->

                                    </div>

                                    <!-- END .clearfix -->
                                </section></div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-standard clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
                                <!-- BEGIN .content-wrapper-outer -->
                                <section class="content-wrapper-outer content-wrapper clearfix latest-news-section">

                                    <h3 class="center-title">Latest News</h3>
                                    <div class="title-block2"></div>


                                    <!-- BEGIN .latest-news-block-wrapper -->
                                    <div class="owl-carousel2 latest-news-block-wrapper">


                                        <!-- BEGIN .latest-news-block -->
                                        <div id="post-230" class="latest-news-block post-230 post type-post status-publish format-standard has-post-thumbnail hentry category-transport tag-los-angeles">


                                            <div class="latest-news-block-image">
                                                
                                                    <img src="wp-content/uploads/2017/02/image44-500x300-1-500x3000.jpg" alt="" />						
                                            </div>


                                            <div class="latest-news-block-content">

                                                <h4> Booking Options</h4>

                                                <!-- BEGIN .news-meta -->
                                                

                                                <div class="latest-news-excerpt">

                                                    <p>Flexible Booking options,
Accessible, Convenient, Easy.</p>

                                                </div>

                                            </div>

                                            <!-- END .latest-news-block -->
                                        </div>











<div id="post-230" class="latest-news-block post-230 post type-post status-publish format-standard has-post-thumbnail hentry category-transport tag-los-angeles">


                                            <div class="latest-news-block-image">
                                                
                                                    <img src="wp-content/uploads/2017/02/image44-500x300-1-500x3001.jpg" alt="" />						
                                            </div>


                                            <div class="latest-news-block-content">

                                                <h4> Get to or from the airport</h4>

                                                <!-- BEGIN .news-meta -->
                                                

                                                <div class="latest-news-excerpt">

                                                    <p>It could take 10 to 60 minutes to get to your ride after you land.</p>

                                                </div>

                                            </div>

                                            <!-- END .latest-news-block -->
                                        </div>










                                        <!-- BEGIN .latest-news-block -->
                                        


                                        <!-- BEGIN .latest-news-block -->
                                        <div id="post-232" class="latest-news-block post-232 post type-post status-publish format-standard has-post-thumbnail hentry category-los-angeles tag-long-distance-travel">


                                            <div class="latest-news-block-image">
                                                <img src="wp-content/uploads/2017/02/image42-500x300-1-500x300022.jpg" alt="" />						
                                            </div>


                                            <div class="latest-news-block-content">

                                                <h4>Join us as Driver!</h4>

                                                <!-- BEGIN .news-meta -->
                                               

                                                <div class="latest-news-excerpt">

                                                    <p>Work with Nycblackcarservice, Set your own schedule &
begin earning money</p>

                                                </div>

                                            </div>

                                            <!-- END .latest-news-block -->
                                        </div>


                                        <!-- BEGIN .latest-news-block -->
                                        <div id="post-233" class="latest-news-block post-233 post type-post status-publish format-standard has-post-thumbnail hentry category-limousine tag-taxi">


                                            <div class="latest-news-block-image">
                                                
                                                    <img src="wp-content/uploads/2017/02/image41-500x300-1-500x300.jpg" alt="" />						
                                            </div>


                                            <div class="latest-news-block-content">

                                                <h4>Our New Fleet</h4>

                                                <!-- BEGIN .news-meta -->
                                             

                                                <div class="latest-news-excerpt">

                                                    <p>Each vehicle is pristine, best-in-class, late-model, and fully insured.</p>

                                                </div>

                                            </div>

                                            <!-- END .latest-news-block -->
                                        </div>


                                        <!-- BEGIN .latest-news-block -->
                                        


                                        <!-- BEGIN .latest-news-block -->
                                        <div id="post-235" class="latest-news-block post-235 post type-post status-publish format-standard has-post-thumbnail hentry category-business-trips tag-luxury-cars">


                                            <div class="latest-news-block-image">
                                                
                                                    <img src="wp-content/uploads/2017/02/image39-500x300-1-500x300.jpg" alt="" />						                                    </div>


                                            <div class="latest-news-block-content">

                                                <h4>New Safety Standards</h4>

                                                <!-- BEGIN .news-meta -->
                                               

                                                <div class="latest-news-excerpt">

                                                    <p>Our fleet is meticulously cared for and maintained with the highest level of cleaning. </p>

                                                </div>

                                            </div>

                                            <!-- END .latest-news-block -->
                                        </div>


                                        <!-- END .latest-news-block-wrapper -->
                                    </div>


                                </section>

                            </div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-full clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill"><div class="vc_column-inner vc_custom_1483325712669"><div class="wpb_wrapper"><!-- BEGIN .call-to-action-2-section -->
                                <section class="clearfix call-to-action-2-section" style="background:url(wp-content/uploads/2020/06/image10.jpg) no-repeat center top;">

                                    <div class="call-to-action-2-section-inner">

                                        <h3>Book Online Today And Travel In Comfort On Your Next Trip</h3>
                                        <div class="title-block5"></div>
                                        <p>Call Us On (800) 786-0393 or Email booking.alpharides@gmail.com.com</p>
                                        <a href="#" class="button0">Online Booking</a>

                                    </div>

                                    <!-- END .call-to-action-2-section -->
                                </section></div></div></div></div></div><div  class="wpb_row vc_row-fluid content-wrapper content-wrapper-standard clearfix    " style="padding-left: 0px; padding-right: 0px; "><div class="col span_12"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner"><div class="wpb_wrapper"><h3 class="center-title">Photo Gallery</h3><div class="title-block2"></div>
                                <div class="wpb_text_column wpb_content_element " >
                                    <div class="wpb_wrapper">

                                        <div id='gallery-1' class='gallery galleryid-316 gallery-columns-3 gallery-size-thumbnail'><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/image123.jpg" data-gal="prettyPhoto[gallery-1]" title="image123"><img src="wp-content/uploads/2020/06/image123.jpg" alt="" /></a></div></div><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/image12-100.jpg" data-gal="prettyPhoto[gallery-1]" title="image12 (1)"><img src="wp-content/uploads/2020/06/image12-100.jpg" alt="" /></a></div></div><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/image13.jpg" data-gal="prettyPhoto[gallery-1]" title="image13"><img src="wp-content/uploads/2020/06/image13.jpg" alt="" /></a></div></div><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/image14.jpg" data-gal="prettyPhoto[gallery-1]" title="image14"><img src="wp-content/uploads/2020/06/image14.jpg" alt="" /></a></div></div><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/image15.jpg" data-gal="prettyPhoto[gallery-1]" title="image15"><img src="wp-content/uploads/2020/06/image15.jpg" alt="" /></a></div></div><div class='gallery-item'><div class='gallery-icon'><a href="wp-content/uploads/2020/06/black5.jpg" data-gal="prettyPhoto[gallery-1]" title="image16"><img src="wp-content/uploads/2020/06/black5.jpg" alt="" /></a></div></div>
                                            <br style='clear: both;' />
                                        </div>


                                    </div>
                                </div>
                            </div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner vc_custom_1485767312828"><div class="wpb_wrapper">


                                <h3 class="center-title">Testimonials</h3>
                                <div class="title-block2"></div>


                                <!-- BEGIN .testimonial-wrapper-outer -->
                                <div class="testimonial-wrapper-outer">

                                    <!-- BEGIN .testimonial-list-wrapper -->
                                    <div class="testimonial-list-wrapper owl-carousel3">



                                        <!-- BEGIN .testimonial-wrapper -->
                                        <div class="testimonial-wrapper">

                                            <div><span class="qns-open-quote">“</span><p>Fast and professional are the best words to best describe the Chauffeur team, they got me to my business meeting on time, looking forward to next time!</p>
                                                <span class="qns-close-quote">”</span></div>


                                            <div class="testimonial-image">
                                                <img src="wp-content/uploads/2017/02/image05-1-80x80.jpg" alt="" />							</div>


                                            <div class="testimonial-author"><p>Tony &amp; Gary Biffer - Luxury SUV</p></div>

                                            <!-- END .testimonial-wrapper -->
                                        </div>



                                        <!-- BEGIN .testimonial-wrapper -->
                                        <div class="testimonial-wrapper">

                                            <div><span class="qns-open-quote">“</span><p>These guys are so reliable, I can always count on them to get me to my business meetings on time regardless of the traffic, weather or time of day!</p>
                                                <span class="qns-close-quote">”</span></div>


                                            <div class="testimonial-image">
                                                <img src="wp-content/uploads/2017/02/image05-80x80.jpg" alt="" />							</div>


                                            <div class="testimonial-author"><p>Mike Jones - Luxury Sedan</p></div>

                                            <!-- END .testimonial-wrapper -->
                                        </div>



                                        <!-- BEGIN .testimonial-wrapper -->
                                        <div class="testimonial-wrapper">

                                            <div><span class="qns-open-quote">“</span><p>Whenever I am in New York, I always ride with NYC Black Car Service. They are reliable, on time, and the vehicle are always new. Very affordable for a great service!</p>
                                                <span class="qns-close-quote">”</span></div>


                                            <div class="testimonial-image">
                                                <img src="wp-content/uploads/2017/02/image05-80x80.jpg" alt="" />							</div>


                                            <div class="testimonial-author"><p> J. Ragsdale - Ultra Luxury Sedan</p></div>

                                            <!-- END .testimonial-wrapper -->
                                        </div>


                                        <!-- END .testimonial-list-wrapper -->
                                    </div>

                                    <!-- END .testimonial-wrapper-outer -->
                                </div>


                            </div></div></div></div></div>



            <!-- END .main-content -->
        </div>


<!--<div class="row">-->
<!--  <div class="column">-->
<!--    <a href="https://apps.apple.com/us/app/alpharides/id1471702745"><img src="wp-content/uploads/2020/06/app.png" float="left" margin="20px" /></a>-->
<!--  </div>-->
<!--  <div class="column">-->
<!--    <a href="https://play.google.com/store/apps/details?id=com.kmktech.alpha&hl=en_US"><img src="wp-content/uploads/2020/06/play.png" float="left" />-->
<!--  </div>-->
 
<!--</div>-->


        <!-- END .content-wrapper-outer -->
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

        var autocomplete = new google.maps.places.Autocomplete(jQuery("#formOneWay > #pickupaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var address = place.formatted_address;
            if(place.name.includes("Airport")){


                jQuery(".airport_data").show();
                jQuery("#flight_name").attr('required','required')
                jQuery("#flight_number").attr('required','required')
            }else{
                jQuery(".airport_data").hide();
                jQuery("#flight_name").removeAttr('required')
                jQuery("#flight_number").removeAttr('required')
            }

            jQuery('#formOneWay > #lat').val(place.geometry.location.lat());
            jQuery('#formOneWay > #lng').val(place.geometry.location.lng());

        });

        var autocomplete2 = new google.maps.places.Autocomplete(jQuery("#formOneWay > #dropoffaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete2, 'place_changed', function() {
            var place2 = autocomplete2.getPlace();
            var address2 = place2.formatted_address;

            jQuery('#formOneWay > #lat2').val(place2.geometry.location.lat());
            jQuery('#formOneWay > #lng2').val(place2.geometry.location.lng());

        });

        var autocomplete3 = new google.maps.places.Autocomplete(jQuery("#formHourly > #pickupaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete3, 'place_changed', function() {
            var place3 = autocomplete3.getPlace();
            var address3 = place3.formatted_address;
            if(place3.name.includes("Airport")){


                jQuery(".airport_data").show();
                jQuery("#flight_name").attr('required','required')
                jQuery("#flight_number").attr('required','required')
            }else{
                jQuery(".airport_data").hide();
                jQuery("#flight_name").removeAttr('required')
                jQuery("#flight_number").removeAttr('required')
            }

            jQuery('#formHourly > #lat').val(place3.geometry.location.lat());
            jQuery('#formHourly > #lng').val(place3.geometry.location.lng());

        });

        var autocomplete4 = new google.maps.places.Autocomplete(jQuery("#formHourly > #dropoffaddress1")[0], {});

        // restrict to pakistan
        /*autocomplete.setComponentRestrictions(
            {'country': ['pak']});*/

        google.maps.event.addListener(autocomplete4, 'place_changed', function() {
            var place4 = autocomplete4.getPlace();
            var address4 = place4.formatted_address;

            jQuery('#formHourly > #lat2').val(place4.geometry.location.lat());
            jQuery('#formHourly > #lng2').val(place4.geometry.location.lng());

        });

        // round trip
        var autocomplete5 = new google.maps.places.Autocomplete(jQuery("#formFlat > #pickupaddress1")[0], {});

        google.maps.event.addListener(autocomplete5, 'place_changed', function() {
            var place5 = autocomplete5.getPlace();
            var address5 = place5.formatted_address;
            if(place5.name.includes("Airport")){


                jQuery(".airport_data").show();
                jQuery("#flight_name").attr('required','required')
                jQuery("#flight_number").attr('required','required')
            }else{
                jQuery(".airport_data").hide();
                jQuery("#flight_name").removeAttr('required')
                jQuery("#flight_number").removeAttr('required')
            }
            jQuery('#formFlat > #lat').val(place5.geometry.location.lat());
            jQuery('#formFlat > #lng').val(place5.geometry.location.lng());

        });

        var autocomplete6 = new google.maps.places.Autocomplete(jQuery("#formFlat > #dropoffaddress1")[0], {});

        google.maps.event.addListener(autocomplete6, 'place_changed', function() {
            var place6 = autocomplete6.getPlace();
            var address6 = place6.formatted_address;


            jQuery('#formFlat > #lat2').val(place6.geometry.location.lat());
            jQuery('#formFlat > #lng2').val(place6.geometry.location.lng());

        });

        var autocomplete7= new google.maps.places.Autocomplete(jQuery("#formFlat > #pickupaddress2")[0], {});

        google.maps.event.addListener(autocomplete7, 'place_changed', function() {
            var place7 = autocomplete7.getPlace();
            var address7 = place7.formatted_address;


            jQuery('#formFlat > #lat3').val(place7.geometry.location.lat());
            jQuery('#formFlat > #lng3').val(place7.geometry.location.lng());

        });

        var autocomplete8 = new google.maps.places.Autocomplete(jQuery("#formFlat > #dropoffaddress2")[0], {});

        google.maps.event.addListener(autocomplete8, 'place_changed', function() {
            var place8 = autocomplete8.getPlace();
            var address8 = place8.formatted_address;


            jQuery('#formFlat > #lat4').val(place8.geometry.location.lat());
            jQuery('#formFlat > #lng4').val(place8.geometry.location.lng());

        });




    </script>

@endsection



