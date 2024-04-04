@extends('layouts.app')

@section('title') {{ltrim('NYC Black Car Service')}}@endsection

@section('meta_description'){{ltrim('NycBlackCarService offers transportation services to and from your appointments. Get directions, comfortable units and services of our professional staff.')}}@endsection

@section('meta_keywords'){{ltrim('Jfk car service, black car nyc, car service in ny, car service in ny, new york black car service')}}@endsection

@section('css')


@endsection

@section('content')


<style type="text/css">
    .master-header{
        background-image: linear-gradient(180deg,#222222 0%,rgba(204,204,204,0) 100%),url(https://nycblackcarservice.com/images/business-travel-red-oak-transportation.jpg);
        position: relative;
        height: calc(100vh - 280px);
        background-repeat: no-repeat;
        background-size: cover;
    }
    .master-header .overlay-wrap{
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        left: 0;
        right: 0;
        margin: 0 auto;
        text-align: center;
        color: #fff;
        max-width: 540px;
        background-color: rgb(0 0 0 / 51%);
        border-radius: 10px;
        padding: 20px;
    }
    .master-header .overlay-wrap h1{
        font-weight: 700;
        color: white;
    }
    .master-header .overlay-wrap p{
        margin-bottom: 0;
    }
    .action-bar{
        text-align: center;
        background-color: #f8f8ff;
    }
    .action-bar a{
        display: inline-block;
        padding: 30px;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="service-wrapper">
    <div class="master-header">
        <div class="overlay-wrap">
            <h1>Corporate, Business, Leisure</h1>
            <p>A full service offering for every customer.</p>
        </div>
    </div>
    
    <div class="action-bar">
        <a href="#">Daily Commuting</a>
        <a href="#">Private Car Service</a>
        <a href="#">Airport Car Service</a>
        <a href="#">Long Distance Car Service</a>
    </div>
    
    <div class="main-content-wrapper py-5">
        <div class="container">
            <div class="introw">
            <h2 class="text-primary text-center font-weight-bold">Personal Car Service Tailored for You</h2>
            <h4 class="text-center">NYC Black Car Service professional chauffeurs and pristine vehicles allow individuals to travel in comfort and luxury.</h4>
            <p>Whether your travel is personal or business, NYC Black Car Service can take the worry of transportation out of your hands and allow you to focus on more important priorities.  Our professional services are offered locally in the New York, New Jersey, Connecticut and Pennsylvania. We offer long distance car service between NY and any city in the US. No matter where you need to be, NYC Black Car Service will provide you with professional chauffeured service for comfort and safety. </p>
            </div>
            <hr />
            <div class="row align-items-center">
                <div class="col-md-6 d-md-none">
                    <img src="{{asset('images/chevy_surburban.jpg')}}" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-success">Daily Commute Car Service</h4>
                    <p>
                        We appreciate the value of time and know every minute counts. With other commuting methods, time is often wasted navigating traffic, parking, chasing trains, finding seats, or waiting. Let a NYC Black Car Service personal driver take you door to door and further maximize your day. Our daily commute customers find that a private car environment is very conducive and efficient for working compared to other means of transportation. Let your commute be newfound time to prepare for meetings, take calls or update on emails, and avoid having to play catch-up after the commute. On the way back, give yourself the opportunity to close out the day before arriving back home. Optimizing your commute frees up more hours in your day. Let NYC Black Car Service simplify your life.
                    </p>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{asset('images/chevy_surburban.jpg')}}" class="img-fluid" />
                </div>
            </div>
            <hr />
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{asset('images/bmw_series.png')}}" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-success">Private Car Service</h4>
                    <p>
                        Driving can be hassle, which is why so many individuals rely on NYC Black Car Service for their daily transportation needs. We provide professionally chauffeured services for any occasion. We service both local travel and long distance car service spanning state lines. Choose from our wide variety of vehicles, including luxury SUVs and sedans, to find the best option that suites you. Whether it be attending meetings, running errands, visiting family and friends, trust NYC Black Car Service to do the driving and allow you to focus on other priorities.
                    </p>
                </div>
            </div>
            <hr />
            <div class="row align-items-center">
                <div class="col-md-6 d-md-none">
                    <img src="{{asset('images/escalade.png')}}" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-success">Airport Car Service</h4>
                    <p>
                        Our door-to-door airport service is relied upon daily at the following airports:
                    </p>
                    <ul>
                        <li><strong>John F. Kennedy International Airport (JFK)</strong></li>
                        <li><strong>Newark Liberty International Airport (EWR)</strong></li>
                        <li><strong>LaGuardia Airport (LGA)</strong></li>
                        <li><strong>Westchester County Airport (HPN)</strong></li>
                        
<li><strong>Long Island MacArthur Airport</strong></li>
<li><strong>Republic Airport Farmingdale</strong></li>
<li><strong>Teterboro Airport</strong></li>
                        
                    </ul>
                    <p>
                        We also provide airport transportation throughout New York, New Jersey, Connecticut and Pennsylvania. We serve the area’s regional airports and FBOs (Avitat, Panorama, Million Air, Netjets, Jet Systems and Signature), making our services an excellent choice for individuals or families flying either private or commercial carriers.
                    </p>
                    <p>
                        The level of service we provide can be customized to meet your needs. Traveling without checked baggage. We can arrange curbside airport pickups for the busy executive or on the go meet and greet service in  the Baggage Claims area. Whichever service style you prefer, after you make a reservation with us, we will track your flight arrival time to ensure that we are always punctual and at your service.


                    </p>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{asset('images/escalade.png')}}" class="img-fluid" />
                </div>
            </div>
            <hr />
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{asset('images/WhatsApp Image 2020-09-10 at 5.19.02 AM.jpeg')}}" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-success">Long Distance Car Service</h4>
                    <p>
                        When flying is not the best option, NYC Black Car Service provides long distance car service. Our customers have relied on us for trips between New York, Boston and Washington DC. Whether it be New York, New Jersey, Connecticut, Pennsylvania, Delaware, MaryLand, Massachusetts or any state in between. NYC Black Car Service provides reliable and comfortable multi-city transportation services. For long distance trips, we aim to accommodate our passengers to make your trip as comfortable as possible. We can arrange trip specific requests such as providing ice coolers to store food and beverages. Our long distance car service can be offered on a same-day or multi-day basis for regional cities such as Boston, Philadelphia, Providence, Baltimore, Washington DC, etc. Call NYC Black Car Service today to plan your long distance ground transportation.


                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection