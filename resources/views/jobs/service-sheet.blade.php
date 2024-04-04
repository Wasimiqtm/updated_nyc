<html>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body {
    background: grey;
    margin-top: 120px;
    margin-bottom: 120px;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <center><img src="{{ asset('images/download.png') }}"></center>
                        </div>
                    </div>
                    <div class=""><center><h2>Service Sheet</h2></center></div>
                    
                    <!--<div class="row my-5" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Date:</b>
                            
                            <i class="mb-1">4 Dec, 2019</i>
                        </div>
                        </div>-->
                    
                    <div class="col-md-12">
                        <div class="col-md-4" style="margin-left: 34px;">
                            <b>Date:</b>                            
                            <i class="mb-1">{{ date('d M Y', strtotime($job->created_at)) }}</i>
                        </div>
                        <!-- <div class="col-md-6" style="margin-left: 34px;">                            
                            <i class="mb-1">{{ str_pad($job->id,5,'0',STR_PAD_LEFT) }}</i>
                        </div> -->
                    </div>
                    <hr class="">
                    

                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Customer Name:</b>
                            <i class="mb-1">{{ $job->customer_name }}</i> 
                        </div>
                    </div>
                    <div class="my-5"></div>
                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Address:</b>                                                        
                            <i class="mb-1">{{ $job->address }}</i>
                        </div>
                    </div>
                    <div class="my-5"></div>
                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-6">
                            <b>Contact No:</b>                            
                            <i class="mb-1">{{ $job->mobile_number }}</i>
                        </div>
                        
                        
                    </div>
                
 <!--                    <hr style="height:2px; color:black">


                        <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Make & Model No:</b>                            
                            <i class="mb-1">6781 45P</i>
                        </div>
                        </div>
                        <div class="my-5"></div>
                        <div class="row " style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Serial IMEI Number:</b>                            
                            <i class="mb-1">6781 45P</i>
                        </div>
                        </div> -->


<hr class="my-5">
                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Full Description of fault:</b>                            
                             
                        </div>
                        <textarea style="width: 903px; height: 100px;">   </textarea>
                        </div>

                   
<hr>


                        <div class="row" style="padding-left: 50px;">
                            <div class="col-md-6">
                                <b>Date of Collection:</b>                            
                                <i class="mb-1">6781 45P</i>
                            </div>
                           
                            <div class="col-md-6">
                                <b>Estimated Cost:</b>                            
                                <i class="mb-1">6781 45P</i>
                            </div>
                        </div>

                        <div class="row" style="padding-left: 50px;">
                            <div class="col-md-6"></div>
                           
                            <div class="col-md-6">
                                <b>Deposit Taken:</b>                            
                                <i class="mb-1">Yes or No</i>
                            </div>
                        </div>

                        


                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <center><img src="{{ asset('images/41TnFWpbQ7L._SX425_.jpg') }}" style="height:200px; width:200px"></center>
                        </div>
                        
                        <div class="col-md-4">
                            <center><img src="{{ asset('images/best-mobile-phones2_1.jpg') }}" style="height:200px; width:200px"></center>
                        </div>
                        
                        <div class="col-md-4">
                            <center><img src="{{ asset('images/2.jpeg') }}" style="height:200px; width:200px" ></center>
                        </div>
                    </div>

                    <div class="my-3"></div>
                    <div class="row" style="padding-left: 50px;">
                        
                        <div class="col-md-12" style="max-width: 95%;">
                                                        
                            <i class="mb-1 ">{{ settingValue('instructions') }}</i>
                        </div>
                    </div>
                    <div class="my-3"></div>
                </div>
            </div>
        </div>
    </div>
    
    

</div>


<script type="text/javascript">
      window.print();
</script>

</body>
</html>

