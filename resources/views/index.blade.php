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
                  <h2 class="heading-52-medium color-white wow fadeInUp">Your Personal <br class="d-none d-lg-block">Chauffeur Services</h2>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner2.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h2 class="heading-52-medium color-white wow fadeInUp">Your Personal <br class="d-none d-lg-block">Chauffeur Services</h2>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner3.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h2 class="heading-52-medium color-white wow fadeInUp">Your Personal <br class="d-none d-lg-block">Chauffeur Services</h2>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner4.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h2 class="heading-52-medium color-white wow fadeInUp">Your Personal <br class="d-none d-lg-block">Chauffeur Services</h2>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="box-cover-image" style="background-image:url(assets/imgs/page/homepage1/banner5.png)"></div>
                <div class="box-banner-info">
                  <p class="text-16 color-white wow fadeInUp">Where Would You Like To Go?</p>
                  <h2 class="heading-52-medium color-white wow fadeInUp">Your Personal <br class="d-none d-lg-block">Chauffeur Services</h2>
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

        <form id="formOneWay" action="{{url('ride-request/create-step1')}}" class="booking-form-1" method="post">
          {{ csrf_field() }}
          <div class="box-search-ride wow fadeInUp">
          <div class="search-item search-date">
            <div class="search-icon"> <span class="item-icon icon-date"> </span></div>
            <div class="search-inputs">
              <label class="text-14 color-grey">Date</label>
              <input class="search-input datepicker pickup-date1" name="pickup_date" type="text" placeholder="Pick Up Date" value="">
            </div>
          </div>
          <div class="search-item search-time">
            <div class="search-icon"> <span class="item-icon icon-time"> </span></div>
            <div class="search-inputs">
              <label class="text-14 color-grey">Time</label>
              <input class="search-input timepicker" name="pickup_time_hour" type="text" placeholder="" value="Pick Up Time">
            </div>
          </div>
          <div class="search-item search-from">
            <div class="search-icon"> <span class="item-icon icon-from"> </span></div>
            <div class="search-inputs">
              <label class="text-14 color-grey">From</label>
              {!! Form::text('pickup_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Pick Up Address', 'id' => "pickupaddress1", 'required' => 'required']) !!}
              {!! Form::hidden('lat', null, ['id' => "lat"]) !!}
              {!! Form::hidden('lng', null, ['id' => "lng"]) !!}
            </div>
          </div>
          <div class="search-item search-to">
            <div class="search-icon"> <span class="item-icon icon-to"> </span></div>
            <div class="search-inputs">
              <label class="text-14 color-grey">To</label>
              {!! Form::text('dropoff_location', null, ['class' => 'search-input dropdown-location','placeholder'=>'Drop Off Address', 'id' => "dropoffaddress1", 'required' => 'required']) !!}
              {!! Form::hidden('lat2', null, ['id' => "lat2"]) !!}
              {!! Form::hidden('lng2', null, ['id' => "lng2"]) !!}
            </div>
          </div>
            <input type="hidden" name="form_type" value="one_way" />
            <input type="hidden" name="external_form" value="true" />
          <div class="search-item search-button">
            <button class="btn btn-search" type="submit"> Submit</button>
          </div>
        </div>
        </form>

      </section>
      <section class="section pt-65 pb-35 border-bottom">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-xl-3 col-lg-4 mb-30">
              <h3 class="color-primary wow fadeInUp">The partners who sell<br class="d-none d-lg-block">our products</h3>
            </div>
            <div class="col-xl-9 col-lg-8 mb-30">
              <ul class="list-logos d-flex align-item-center wow fadeInUp">
                <li><img src="assets/imgs/slider/logo/air.svg" alt="luxride"></li>
                <li><img src="assets/imgs/slider/logo/eb.svg" alt="luxride"></li>
                <li><img src="assets/imgs/slider/logo/nba.svg" alt="luxride"></li>
                <li><img src="assets/imgs/slider/logo/nla.svg" alt="luxride"></li>
              </ul>
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
            <div class="col-lg-6 col-5 text-end"><a class="text-16-medium color-primary wow fadeInUp" href="#">More Fleet
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
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/e-class.png" alt="Luxride"></a></div>
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
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/eqs.png" alt="Luxride"></a></div>
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
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/suv.png" alt="Luxride"></a></div>
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
                    <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/v-class.png" alt="Luxride"></a></div>
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
                    <figure><img src="assets/imgs/page/homepage1/laptop.png" alt="luxride"></figure>
                    <figure><img src="assets/imgs/page/homepage1/desktop.png" alt="luxride"></figure>
                    <figure><img src="assets/imgs/page/homepage1/desktop2.png" alt="luxride"></figure>
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
                  <p class="text-16">On the day of your ride, you will receive two email and SMS updates - one informing you that.</p>
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
                <div class="cardIcon"><img src="assets/imgs/page/homepage1/safe.svg" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Safety First</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">Both you and your shipments will travel with professional drivers. Always with the highest quality standards.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardIconTitleDesc wow fadeInUp">
                <div class="cardIcon"><img src="assets/imgs/page/homepage1/price.svg" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Prices With No Surprises</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">Both you and your shipments will travel with professional drivers. Always with the highest quality standards.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cardIconTitleDesc wow fadeInUp">
                <div class="cardIcon"><img src="assets/imgs/page/homepage1/vehicle.svg" alt="luxride"></div>
                <div class="cardTitle">
                  <h5 class="text-20-medium color-text">Private Travel Solutions</h5>
                </div>
                <div class="cardDesc">
                  <p class="text-16 color-text">Both you and your shipments will travel with professional drivers. Always with the highest quality standards.</p>
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
            <div class="col-lg-6 col-sm-5 col-5 text-end"><a class="text-16-medium color-primary d-flex align-items-center justify-content-end wow fadeInUp" href="#">More Services
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
                      <h3 class="cardTitle text-20-medium color-white mb-10">Intercity Rides</h3>
                      <div class="box-inner-info">
                        <p class="cardDesc text-14 color-white mb-30">Mercedes-Benz E-Class, BMW 5 Series, Cadillac XTS or similar</p><a class="cardLink btn btn-arrow-up" href="service-single.html">
                          <svg class="icon-16" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                          </svg></a>
                      </div>
                    </div>
                    <div class="cardImage"><img src="assets/imgs/page/homepage1/service1.png" alt="Luxride"></div>
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
                    <div class="cardImage"><img src="assets/imgs/page/homepage1/service2.png" alt="Luxride"></div>
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
                    <div class="cardImage"><img src="assets/imgs/page/homepage1/service3.png" alt="Luxride"></div>
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
                    <div class="cardImage"><img src="assets/imgs/page/homepage1/service5.png" alt="Luxride"></div>
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
      <section class="section pt-130 pb-130 bg-primary box-testimonials">
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
              <div class="box-video wow fadeInUp"> <a class="btn btn-play popup-youtube hover-up" href="https://www.youtube.com/watch?v=sVPYIRF9RCQ"></a><img src="assets/imgs/page/homepage1/img-video.png" alt="luxride"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section pt-120 pb-120 bg-region">
        <div class="container-sub">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-30">
              <div class="box-gallery justify-content-center justify-content-lg-start">
                <div class="gallery-1 wow fadeInUp"><img src="assets/imgs/page/homepage1/img1.png" alt="luxride"></div>
                <div class="gallery-2 wow fadeInUp"><img src="assets/imgs/page/homepage1/img2.png" alt="luxride"><img src="assets/imgs/page/homepage1/img3.png" alt="luxride"></div>
              </div>
            </div>
            <div class="col-lg-6 mb-30">
              <div class="box-region-right wow fadeInUp">
                <h2 class="heading-44-medium color-text mb-30">From the region, for the region</h2>
                <p class="text-16 color-text mb-30">Superide operates in more than 120 cities in 18 countries from Morocco to Pakistan.</p><a class="btn btn-primary">View All Cities
                  <svg class="icon-16 ml-5" fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"></path>
                  </svg></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section pt-120 pb-90 bg-primary">
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
                    </div><img src="assets/imgs/page/homepage1/news1.png" alt="luxride">
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
                    </div><img src="assets/imgs/page/homepage1/news2.png" alt="luxride">
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
                    </div><img src="assets/imgs/page/homepage1/news3.png" alt="luxride">
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
      </section>
      <section class="section pt-80 mb-30 bg-faqs">
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
      </section>
      <section class="section mt-50 bg-download">
        <div class="container-sub">
          <h2 class="heading-44-medium color-text mb-20 wow fadeInUp">Download the app</h2>
          <p class="color-text text-16 mb-60 wow fadeInUp">Have a personal driver at your fingertips no matter where you <br class="d-none d-md-block">are with our easy-to-use smartphone app.</p>
          <div class="box-button-download"> <a class="btn btn-download mr-15 hover-up wow fadeInUp" href="#">
              <div class="inner-download">
                <div class="icon-download"> <img src="assets/imgs/template/icons/apple-icon.svg" alt="luxride"></div>
                <div class="info-download"> <span class="text-download-top">Download on the</span><span class="text-14-medium">Apple Store</span></div>
              </div></a><a class="btn btn-download hover-up wow fadeInUp" href="#">
              <div class="inner-download">
                <div class="icon-download"> <img src="assets/imgs/template/icons/google-icon.svg" alt="luxride"></div>
                <div class="info-download"> <span class="text-download-top">Download on the</span><span class="text-14-medium">Apple Store</span></div>
              </div></a></div>
        </div>
      </section>
    </main>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHH2WyrHbuChuvGc1zkbY3LwiODEF8zGI&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      var autocomplete = new google.maps.places.Autocomplete(document.getElementById("pickupaddress1"), {});


      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var address = place.formatted_address;

        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();

      });

      // var autocomplete2 = new google.maps.places.Autocomplete(jQuery("#formOneWay > #dropoffaddress1")[0], {});
      var autocomplete2 = new google.maps.places.Autocomplete(document.getElementById("dropoffaddress1"), {});
      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete2, 'place_changed', function() {
        var place2 = autocomplete2.getPlace();
        var address2 = place2.formatted_address;

        /*jQuery('#formOneWay > #lat2').val(place2.geometry.location.lat());
        jQuery('#formOneWay > #lng2').val(place2.geometry.location.lng());*/
        document.getElementById('lat2').value = place2.geometry.location.lat();
        document.getElementById('lng2').value = place2.geometry.location.lng();

      });

      // var autocomplete3 = new google.maps.places.Autocomplete(jQuery("#formHourly > #pickupaddress1")[0], {});
      var autocomplete3 = new google.maps.places.Autocomplete(document.getElementById("pickupaddress1"), {});


      // restrict to pakistan
      /*autocomplete.setComponentRestrictions(
          {'country': ['pak']});*/

      google.maps.event.addListener(autocomplete3, 'place_changed', function() {
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

        jQuery('#formHourly > #lat').val(place3.geometry.location.lat());
        jQuery('#formHourly > #lng').val(place3.geometry.location.lng());

      });

      // var autocomplete4 = new google.maps.places.Autocomplete(jQuery("#formHourly > #dropoffaddress1")[0], {});
      var autocomplete4 = new google.maps.places.Autocomplete(document.getElementById("dropoffaddress1"), {});

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
      // var autocomplete5 = new google.maps.places.Autocomplete(jQuery("#formFlat > #pickupaddress1")[0], {});
      var autocomplete5 = new google.maps.places.Autocomplete(document.getElementById("pickupaddress1"), {});

      google.maps.event.addListener(autocomplete5, 'place_changed', function() {
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
        jQuery('#formFlat > #lat').val(place5.geometry.location.lat());
        jQuery('#formFlat > #lng').val(place5.geometry.location.lng());

      });

      // var autocomplete6 = new google.maps.places.Autocomplete(jQuery("#formFlat > #dropoffaddress1")[0], {});
      var autocomplete6 = new google.maps.places.Autocomplete(document.getElementById("dropoffaddress1"), {});

      google.maps.event.addListener(autocomplete6, 'place_changed', function() {
        var place6 = autocomplete6.getPlace();
        var address6 = place6.formatted_address;


        jQuery('#formFlat > #lat2').val(place6.geometry.location.lat());
        jQuery('#formFlat > #lng2').val(place6.geometry.location.lng());

      });

      // var autocomplete7= new google.maps.places.Autocomplete(jQuery("#formFlat > #pickupaddress2")[0], {});
      var autocomplete7= new google.maps.places.Autocomplete(document.getElementById("pickupaddress2"), {});

      google.maps.event.addListener(autocomplete7, 'place_changed', function() {
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

        jQuery('#formFlat > #lat3').val(place7.geometry.location.lat());
        jQuery('#formFlat > #lng3').val(place7.geometry.location.lng());

      });

      // var autocomplete8 = new google.maps.places.Autocomplete(jQuery("#formFlat > #dropoffaddress2")[0], {});
      var autocomplete8 = new google.maps.places.Autocomplete(document.getElementById("dropoffaddress2"), {});

      google.maps.event.addListener(autocomplete8, 'place_changed', function() {
        var place8 = autocomplete8.getPlace();
        var address8 = place8.formatted_address;


        jQuery('#formFlat > #lat4').val(place8.geometry.location.lat());
        jQuery('#formFlat > #lng4').val(place8.geometry.location.lng());

      });




    </script>

@endsection



