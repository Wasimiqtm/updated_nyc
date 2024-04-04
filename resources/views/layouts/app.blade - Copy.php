<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AlphaRides</title>
    <link rel="icon" href="img/alpha11.png" type="image/ico" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('front_css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/font-awesome.min.css') }}">
</head>
<body>

        
<!-- Menu bar -->
    <div class="container-fluid menubar">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <a class="navbar-brand mr-4" href="{{ url('/') }}">
                    <img src="img/logo.png" width="100" alt="">
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/our-products') }}">Our Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about-uss') }}">About Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/ride#fare-estimate') }}">Fare Estimate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://apps.apple.com/us/app/alpharides/id1471702745"><img width="80" src="img/app-store-logo.png"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://play.google.com/store/apps/details?id=com.kmktech.alpha"><img width="80" src="img/play-store-logo.png"></a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/login') }}">Login</a>
                            </li>
                            <li class="nav-item signup-dropdown">
                                <a class="nav-link btn btn-blue" href="#">Signup</a>
                                <div class="signup-options">
                                    <a href="{{ url('/rider-signup') }}">Signup as Rider <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    <a href="{{ url('/driver-signup') }}">Signup as Driver <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </li>
                        @endauth    
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- /Menu bar -->
        @yield('content')

<!-- Extras -->
        <div class="container-fluid site-extras">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col extra-span">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <strong>About us</strong>
                        <p>AlphaRides is an on-demand system that allows our customers......</p>
                        <a href="{{ url('/about-us') }}">Read more</a>
                    </div>
                    <div class="col extra-span">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <strong>Newsroom</strong>
                        <p>To become a successful alpharides driver....</p>
                        <a href="{{ url('/newsroom') }}">Read more</a>
                    </div>
                    <div class="col extra-span">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        <strong>Community</strong>
                        <p>Connecting communities and strengthening cities</p>
                        <a href="#">Read more</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Extras -->

    <!-- Footer -->
        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col widget">
                        <img src="img/alpha.png" width="50" alt="">
                        <p class="about">Once you have <b>AlphaRides</b> user account, you can request a vehicle to pick you up in a few minutes. Meanwhile, you can follow the vehicle’s location and check exactly how long it’ll take to reach.</p>
                        <ul class="nostyle social-links">
                            <li><a href="https://www.facebook.com/Alpha-Rides-103348837741180/?modal=admin_todo_tour"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/alpharides"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.instagram.com/alpharides365/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UC-zRDIcRS6i4LIfKcWUtm3w?view_as=subscriber"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                        </ul>
                        <a href="https://apps.apple.com/us/app/alpharides/id1471702745"><img width="80" src="img/app-store-logo.png"></a>
                        <a href="https://play.google.com/store/apps/details?id=com.kmktech.alpha"><img width="80" src="img/play-store-logo.png"></a>
                    </div>
                    <div class="col widget contact">
                        <h4 class="footer-heading">Contact us</h4>
                        <ul class="nostyle">
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> info@alpharides.com</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> 929-251-8001</li>
                            <li><i class="fa fa-map" aria-hidden="true"></i> 3100 47th Avenue, Suite 3100,
                            Long Island City, NY 11101</li>
                        </ul>
                    </div>
                    <div class="col widget navigation">
                        <h4 class="footer-heading">Navigation</h4>
                        <ul class="nostyle">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about-us') }}">About us</a></li>
                            <li><a href="{{ url('/ride') }}">How it work</a></li>
                            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Footer -->

        <!-- Copyright -->
        <div class="copyright-bar">
            <div class="container">
                <p>Copyright © 2019 www.alpharides.com</p>
                <ul class="nostyle">
                    <li><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
                    
                    <li><a href="{{ url('/ride') }}">How it Works</a></li>
                </ul>
            </div>
        </div>
        <!-- /Copyright -->

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
    </html>

    

    @include('sections.notification')

    

    @include('sweet::alert')

     

    @yield('css')
    @yield('scripts')

    

    

    

</body>

</html>

