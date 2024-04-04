@extends('layouts.app')

@section('css')


@endsection

@section('content')
    <main class="main">
      <div class="section pt-60 pb-60 bg-primary">
        <div class="container-sub"> 
          <h1 class="heading-44-medium color-white mb-5">About Us</h1>
          <div class="box-breadcrumb">
            <ul>
              <li> <a href="index.html">Home</a></li>
              <li> <a href="service-grid.html">About</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="section wow fadeInUp"><img src="assets/imgs/page/about/banner.png" alt="luxride"></div>
      <section class="section">
        <div class="container-sub"> 
          <div class="mt-60"> 
            <h2 class="heading-44-medium mb-30 color-text title-fleet wow fadeInUp">We reimagine the way the world moves for the better</h2>
            <div class="content-single wow fadeInUp"> 
              <p>We offer luxury chauffeur driven airport transfers and pickups to London. Exceptional Safe, Meet and Greet. One hour of complimentary wait time and flight tracking. Professional Drivers & Vehicles. Fixed prices on airport transfers. VIP service, get your quote today!</p>
              <p>Et, morbi at sagittis vehicula rutrum. Lacus tortor, quam arcu mi et, at lectus leo nunc. Mattis cras auctor vel pharetra tempor. Rhoncus pellentesque habitant ac tempor. At aliquam euismod est in praesent ornare etiam id. Faucibus libero sit vehicula sed condimentum. Vitae in nam porttitor rutrum sed aliquam donec sed. Sapien facilisi lectus.</p>
              <ul class="list-ticks list-ticks-small">
                <li class="text-16 mb-20">100% Luxurious Fleet</li>
                <li class="text-16 mb-20">All Our Fleet Are Fully Valeted & Serviced</li>
                <li class="text-16 mb-20">A Safe & Secure Journey</li>
                <li class="text-16 mb-20">Comfortable And Enjoyable</li>
                <li class="text-16 mb-20">Clean, Polite & Knowledgeable</li>
              </ul>
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
      <div class="mb-90"></div>
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
      <section class="section pt-130 pb-100 bg-2 box-testimonials">
        <div class="container-sub"> 
          <div class="row"> 
            <div class="col-lg-5 col-md-6 mb-30">
              <div class="box-swiper"> 
                <div class="swiper-container swiper-group-testimonials pb-50">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide"> 
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote"> 
                          <div class="icon-quote bg-secondary"> </div>
                          <div class="info-quote"> 
                            <h5 class="color-text text-18-medium">Jonathan Miller</h5>
                            <p class="color-text text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote color-text">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide"> 
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote"> 
                          <div class="icon-quote bg-secondary"> </div>
                          <div class="info-quote"> 
                            <h5 class="color-text text-18-medium">Jonathan Miller</h5>
                            <p class="color-text text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote color-text">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide"> 
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote"> 
                          <div class="icon-quote bg-secondary"> </div>
                          <div class="info-quote"> 
                            <h5 class="color-text text-18-medium">Jonathan Miller</h5>
                            <p class="color-text text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote color-text">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                    <div class="swiper-slide"> 
                      <div class="cardQuote wow fadeInUp">
                        <div class="box-quote"> 
                          <div class="icon-quote"> </div>
                          <div class="info-quote"> 
                            <h5 class="color-text text-18-medium">Jonathan Miller</h5>
                            <p class="color-text text-14">Web Developer</p>
                          </div>
                        </div>
                        <div class="content-quote color-text">
                           I really can recommend this theme, because it’s coded very well and  it’s really easy to build your own website!</div>
                      </div>
                    </div>
                  </div>
                  <div class="box-pagination-testimonials mt-40 swiper-pagination-grey"> <span class="firstNumber"></span><span class="lastNumber"></span>
                    <div class="swiper-pagination swiper-pagination-testimonials"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-30 text-lg-end text-center d-none d-md-block">
              <div class="box-video wow fadeInUp"> <a class="btn btn-play popup-youtube hover-up" href="https://www.youtube.com/watch?v=sVPYIRF9RCQ"></a><img src="assets/imgs/page/about/img1.png" alt="luxride"></div>
            </div>
          </div>
        </div>
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
      <section class="section pt-80 mb-30">
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
      <section class="section mt-50 bg-download-3 bg-secondary"> 
        <div class="container-sub"> 
          <h2 class="heading-44-medium color-white mb-20 wow fadeInUp">Download the app</h2>
          <p class="color-white text-16 mb-60 wow fadeInUp">Have a personal driver at your fingertips no matter where you <br class="d-none d-md-block">are with our easy-to-use smartphone app.</p>
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
@endsection





@section('scripts')

<script type="text/javascript">


</script>

@endsection



