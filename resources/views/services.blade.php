@extends('layouts.app')

@section('css')


@endsection

@section('content')
    <main class="main">
      <div class="section pt-60 pb-60 bg-primary">
        <div class="container-sub"> 
          <h1 class="heading-44-medium color-white mb-5">Services</h1>
          <div class="box-breadcrumb"> 
            <ul>
              <li> <a href="index.html">Home</a></li>
              <li> <a href="service-grid.html">Services</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="section pt-60">
        <div class="container-sub"> 
          <div class="row">
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/homepage2/intercity.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Intercity Rides</h3>
                  </div></a></div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/homepage2/chauffeur.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Chauffeur Hailing</h3>
                  </div></a></div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/homepage2/airport.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Airport Transfers</h3>
                  </div></a></div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/homepage2/intercity.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Sprinter Class</h3>
                  </div></a></div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/services/wedding2.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Wedding Class</h3>
                  </div></a></div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-30"> 
              <div class="cardService cardServiceStyle4 wow fadeInUp"><a href="service-single.html">
                  <div class="cardImage"><img src="assets/imgs/page/services/travel2.png" alt="Luxride"></div>
                  <div class="cardInfo">
                    <h3 class="cardTitle text-20-medium color-white mb-10">Travel Transfer</h3>
                  </div></a></div>
            </div>
          </div>
          <div class="text-center mt-40 mb-120 wow fadeInUp">
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
      </div>
    </main>
@endsection





@section('scripts')

<script type="text/javascript">


</script>

@endsection



