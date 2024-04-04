@extends('layouts.app')

@section('css')

  <style>
    .cardborder:hover {
      border:2px solid #ffc107;
    }
    .cardbg{
      background-color: #E5E5E5;
    }
    hr {
      border: 1px solid #1b1b1a;
      margin: 20px 0;
    }
    .box-border{
      border: 1px solid #1b1b1a;
    }

    .box-border2{
      border: 2px solid #1b1b1a;

    }
    .main{
      color:#1b1b1a
    }




  </style>
@endsection

@section('content')
  <main class="main">
    <div class="container mt-5 py-5">
      <div class="card cardbg">
        <div class="card-body">
          <h5>Trip Details</h5>
          <div class="row mt-4">
            <div class="col-lg-6">
              <p>
                <span class="text-secondary">Select Type :</span>
                <span class="ml-5"> On Way</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">From :</span>
                <span class="ml-5"> Time Sequare,NY, USA</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">To :</span>
                <span class="ml-5"> JFK Airport (JFK),NY, USA</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">Vehicle :</span>
                <span class="ml-5"> Luxury Sedan</span>
              </p>
              <hr />
            </div>
            <div class="col-lg-6">
              <p>
                <span class="text-secondary">Date :</span>
                <span class="ml-5"> 02-05-2024</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">Pick Up Time :</span>
                <span class="ml-5"> 01:25:00 am</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">Distance :</span>
                <span class="ml-5"> 17.3 Miles</span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">Pick Up Instructions :</span>
                <span class="ml-5"></span>
              </p>
              <hr />
              <p>
                <span class="text-secondary">Drop Off Instructions :</span>
                <span class="ml-5"></span>
              </p>
              <hr />
            </div>
          </div>

          <h5 class="mt-5">Passangers Details</h5>
          <div class="row mt-5">
            <div class="col-lg-5">
              <div class="box-border p-3">
                <div class="row">
                  <div class="col-lg-5 mb-3">
                    <p class="mb-2">
                      <span class="text-secondary">Passanger :</span>
                      <span class=""> 1</span>
                    </p>
                    <p >
                      <span class="text-secondary">Bags :</span>
                      <span class=""> 1</span>
                    </p>
                  </div>
                  <div class="col-lg-7">
                    <p class="mb-2">
                      <span class="text-secondary">Name :</span>
                      <span class=""> Ali</span>
                    </p>
                    <p class="mb-2">
                      <span class="text-secondary">Email :</span>
                      <span class=""> ali@gmail.com</span>
                    </p>
                    <p>
                      <span class="text-secondary">Phone Number :</span>
                      <span class=""> 03xxxxxxxxxx</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 ">
              <div class="box-border p-3">
                <p>
                  <span class="text-secondary">Additional Information :</span>
                  <span class=""> </span>
                </p>
              </div>
            </div>
          </div>
          <div class="row mt-5 mb-3">
            <div class="col-lg-5">
              <div class="box-border2 p-3">
                <p class="mb-2">
                  <span class="text-secondary">Trip Type :</span>
                  <span class=""> On Way</span>
                </p>
                <p class="mb-2">
                  <span class="text-secondary">Base Fare :</span>
                  <span class=""> $ 203.5</span>
                </p>
                <p class="mb-2">
                  <span class="text-secondary">Black Car Fund :</span>
                  <span class=""> $ 7.5</span>
                </p>
                <p class="mb-2">
                  <span class="text-secondary">Gratituty :</span>
                  <span class=""> $ 48.5</span>
                </p>
                <p class="mb-2">
                  <span class="text-secondary">Congestion :</span>
                  <span class=""> $ 2.5</span>
                </p>
                <p class="mb-2">
                  <span class="text-secondary">Sales Tex :</span>
                  <span class=""> $ 21.5</span>
                </p>
                <div class="text-center">
                  <h4>
                    <span class="text-secondary">Total Price :</span>
                    <span class=""> $ 380.5</span>
                  </h4>
                  <h6 class="text-danger">* Tolls Maybe Applicable</h6>
                </div>
                <hr>
                <button class="btn btn-primary rounded-pill px-3 py-2">Proceed To Payment</button>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </main>
@endsection





@section('scripts')

<script type="text/javascript">


</script>

@endsection



