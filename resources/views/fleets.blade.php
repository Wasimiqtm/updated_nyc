@extends('layouts.app')

@section('css')


@endsection

@section('content')
    <main class="main">
      <div class="section pt-60 pb-60 bg-primary">
        <div class="container-sub"> 
          <h1 class="heading-44-medium color-white mb-5">Our Fleet</h1>
          <div class="box-breadcrumb"> 
            <ul>
              <li> <a href="index.html">Home</a></li>
              <li> <a href="fleet-list.html">Our Fleet</a></li>
            </ul>
          </div>
        </div>
      </div>
      <section class="section pt-60 bg-white latest-new-white">
        <div class="container-sub"> 
          <div class="row align-items-center"> 
            <div class="col-lg-6 col-md-6 col-sm-6 text-center text-sm-start mb-30"> 
              <h2 class="heading-24-medium wow fadeInUp">Choose Your Fleet</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 text-center text-sm-end mb-30 wow fadeInUp"> 
              <div class="dropdown dropdown-menu-box"><a class="dropdown-toggle" id="dropdownMenuButton1" href="#" data-bs-toggle="dropdown" aria-expanded="false">Vehicle Type</a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="#">Hatchback</a></li>
                  <li><a class="dropdown-item" href="#">Sedan</a></li>
                  <li> <a class="dropdown-item" href="#">SUV</a></li>
                  <li> <a class="dropdown-item" href="#">Crossover</a></li>
                  <li> <a class="dropdown-item" href="#">Sports Car</a></li>
                  <li> <a class="dropdown-item" href="#">Minivan</a></li>
                </ul>
              </div>
              <div class="dropdown dropdown-menu-box"><a class="dropdown-toggle" id="dropdownMenuButton2" href="#" data-bs-toggle="dropdown" aria-expanded="false">Vehicle Make</a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <li><a class="dropdown-item" href="#">Mercedes-Benz</a></li>
                  <li><a class="dropdown-item" href="#">Audi</a></li>
                  <li> <a class="dropdown-item" href="#">Hyundai</a></li>
                  <li> <a class="dropdown-item" href="#">Honda</a></li>
                  <li> <a class="dropdown-item" href="#">Nissan</a></li>
                  <li> <a class="dropdown-item" href="#">Toyota</a></li>
                  <li> <a class="dropdown-item" href="#">Volkswagen</a></li>
                  <li> <a class="dropdown-item" href="#">Subaru</a></li>
                  <li> <a class="dropdown-item" href="#">Lamborghini</a></li>
                  <li> <a class="dropdown-item" href="#">Lincoln</a></li>
                  <li> <a class="dropdown-item" href="#">Bentley</a></li>
                  <li> <a class="dropdown-item" href="#">Chevrolet</a></li>
                  <li> <a class="dropdown-item" href="#">Ford</a></li>
                  <li> <a class="dropdown-item" href="#">Volvo</a></li>
                  <li> <a class="dropdown-item" href="#">GMC</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row mt-30 our-fleet-2"> 
            <div class="col-md-6 mb-30"> 
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
            <div class="col-md-6 mb-30"> 
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
            <div class="col-md-6 mb-30"> 
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
            <div class="col-md-6 mb-30"> 
              <div class="cardFleet wow fadeInUp">
                <div class="cardInfo"><a href="fleet-single.html">
                    <h3 class="text-20-medium color-text mb-10">SUV Class</h3></a>
                  <p class="text-14 color-text mb-30">Mercedes-Benz V-Class, Chevrolet Suburban, Cadillac Escalade, Toyota Alphard or similar</p>
                </div>
                <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/suv-class.png" alt="Luxride"></a></div>
                <div class="cardInfoBottom">
                  <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                  <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-30"> 
              <div class="cardFleet wow fadeInUp">
                <div class="cardInfo"><a href="fleet-single.html">
                    <h3 class="text-20-medium color-text mb-10">Luxury Class</h3></a>
                  <p class="text-14 color-text mb-30">Mercedes-Benz V-Class, Chevrolet Suburban, Cadillac Escalade, Toyota Alphard or similar</p>
                </div>
                <div class="cardImage mb-30"><a href="fleet-single.html"><img src="assets/imgs/page/homepage1/e-class.png" alt="Luxride"></a></div>
                <div class="cardInfoBottom">
                  <div class="passenger"><span class="icon-circle icon-passenger"></span><span class="text-14">Passengers<span>4</span></span></div>
                  <div class="luggage"><span class="icon-circle icon-luggage"></span><span class="text-14">Luggage<span>2</span></span></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-30"> 
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
          <div class="text-center mt-40 mb-120">
            <nav class="box-pagination">
              <ul class="pagination">
                <li class="page-item"><a class="page-link page-prev" href="#">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                    </svg></a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link active" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">10</a></li>
                <li class="page-item"><a class="page-link page-next" href="#">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                    </svg></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </section>
    </main>
@endsection





@section('scripts')

<script type="text/javascript">


</script>

@endsection



