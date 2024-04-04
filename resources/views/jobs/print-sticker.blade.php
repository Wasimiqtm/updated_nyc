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
.sticker_div b{float: left;margin-left: 10px;}
.sticker_div i{float: left;margin-left: 5px;}
hr{margin-top: 10px;margin-bottom: 10px;}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <center><div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('images/download.png') }}" style="padding-left: 55px;">
                        </div>
                    </div>
                    <div class=""><h3>TEL: 12 3232323332</h3></div>
                    
                    <!--<div class="row my-5" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Date:</b>
                            
                            <i class="mb-1">4 Dec, 2019</i>
                        </div>
                        </div>-->

                    

                   
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;">
                        <div class="col-md-12">
                            <b>Name:</b>                            
                            <i class="mb-1">{{ $job->customer_name }}</i>
                        </div>
                    </div>
                    <hr>                        
                    <div class="row sticker_div" style="padding-left: 10px;">
                            <div class="col-md-12">
                                <b>Contact:</b>                            
                                <i class="mb-1">{{ $job->mobile_number }}</i>
                            </div>
                    </div>
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;">
                            <div class="col-md-12">
                                <b>Device:</b>                            
                                <i class="mb-1"></i>
                            </div>
                    </div>
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;">
                            <div class="col-md-12">
                                <b>Fault:</b>                            
                                <i class="mb-1"></i>
                            </div>
                    </div>
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;">
                        <div class="col-md-12">
                            <b>Date:</b>                            
                            <i class="mb-1">{{ date('d M Y', strtotime($job->created_at)) }}</i>
                        </div>
                    </div>
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;">
                            <div class="col-md-12">
                                <b>Code:</b>                            
                                <i class="mb-1"></i>
                            </div>
                    </div>
                    <hr>
                    <div class="row sticker_div" style="padding-left: 10px;margin-bottom:10px;">
                            <div class="col-md-12">
                                <b>Ref No:</b>                            
                                <i class="mb-1"></i>
                            </div>
                    </div>

                </div>
                </center>
            </div>
        </div>
    </div>
    
    

</div>


<script type="text/javascript">
      window.print();
</script>

</body>
</html>

