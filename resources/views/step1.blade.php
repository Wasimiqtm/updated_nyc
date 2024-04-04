@extends('layouts.app')

@section('css')

  <style>
    .text-warningg {
      color:#E95440;
    }
    .cardborder:hover {
      border: 2px solid #E95440 !important;
    }
    .box-border{
      border: 1px solid #1b1b1a;
      width: 60%;
    }
  </style>
@endsection

@section('content')
  <main class="main">
    <div class="container mt-5 py-5">
      <div class="row">
        <div class="col-lg-5 mb-3">
          <h5>Select Vehical</h5>
          <div class="card cardborder mt-5 mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
                  <h6>Ultra Luxury Sedan</h6>
                  <h6 class="text-warningg">$ 240.85</h6>
                </div>
                <div class="col-lg-4">
                  <img
                          src="assets/imgs/page/page2/car-11.jpg"
                          alt=""
                          class="img-fluid"
                          width="100%"
                          height="180px"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card cardborder mt-5 mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
                  <h6>SUV</h6>
                  <h6 class="text-warningg">$ 340.85</h6>
                </div>
                <div class="col-lg-4">
                  <img
                          src="assets/imgs/page/page2/car-21.jpg"
                          alt=""
                          class="img-fluid"
                          width="100%"
                          height="180px"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card cardborder mt-5 mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
                  <h6>Luxury Sedan</h6>
                  <h6 class="text-warningg">$ 340.85</h6>
                </div>
                <div class="col-lg-4">
                  <img
                          src="assets/imgs/page/page2/car-41.jpg"
                          alt=""
                          class="img-fluid"
                          width="100%"
                          height="180px"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card cardborder mt-5 mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
                  <h6>Executive Sedan</h6>
                  <h6 class="text-warningg">$ 340.85</h6>
                </div>
                <div class="col-lg-4">
                  <img
                          src="assets/imgs/page/page2/car-11.jpg"
                          alt=""
                          class="img-fluid"
                          width="100%"
                          height="180px"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card cardbg mb-3">
            <div class="card-body">
              <h5>Trip Details</h5>
              <div class="row mt-4">
                <div class="col-lg-6">
                  <p> <span class="text-secondary">Select Type:</span> On Way</p>
                  <hr>
                  <p> <span class="text-secondary">From:</span> <span class="ml-2">Time Sequare,NY, USA</span></p>
                  <hr>
                  <p> <span class="text-secondary">To:</span> <span class="ml-2">JFK Airport (JFK),NY, USA</span></p>
                  <hr>
                </div>
                <div class="col-lg-6 mt-2">
                  <div class=" box-border px-4 py-2">
                    <div class="ml-5 mt-3">
                      <p>Date:</p>
                      <h6>02-05-2024</h6>
                    </div>

                    <div class="ml-5">
                      <p>Pick Up Time:</p>
                      <h6>02-05-2024</h6>
                    </div>
                  </div>
                </div>
              </div>
              <form action="">
                <div class="row mt-5">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Number of Passangers</p>
                      <select name="" id="" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                      </select>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Number of Bages</p>
                      <select name="" id="" class="form-control">

                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Pick Up Instructions</p>
                      <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Drop Off Instructions</p>
                      <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">First Name <span class="text-danger">*</span></p>
                      <input type="text" class="form-control" id="" placeholder="Enter First Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Last Name <span class="text-danger">*</span></p>
                      <input type="text" class="form-control" id="" placeholder="Enter Last Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <p class="mb-2">Email <span class="text-danger">*</span></p>
                      <input type="email" class="form-control" id="" placeholder="Enter Email">
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="form-group">
                      <p class="mb-2">Additional Information</p>
                      <textarea class="form-control" id="textAreaExample1" rows="10"></textarea>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary px-3 py-2">Submit</button>
              </form>
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



