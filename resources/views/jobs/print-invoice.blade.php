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
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="{{ asset('images/download.png') }}">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">
                                Invoice # {{ str_pad($job->id,5,'0',STR_PAD_LEFT) }}</p>
                            <p class="text-muted">Date: {{ date('d M Y', strtotime($job->created_at)) }}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Client Information:</b>
                            <i class="mb-1">{{ $job->customer_name }}</i>                            
                        </div>
                        </div>
                    <hr class="my-5">
                    <div class="row" style="padding-left: 50px;">
                        <div class="col-md-12">
                            <b>Address:</b>                            
                            <i>{{ $job->address }}</i>                            
                        </div>
                    </div>
                    
                    <hr class="my-5">
                        <div class="row" style="padding-left: 50px;">
                        <div class="col-md-6">
                            <b>Contact #:</b>                            
                            <i class="mb-1">{{ $job->mobile_number }}</i>
                        </div>
                        
                        <!-- <div class="col-md-6">
                            <b>Date:</b>                            
                            <i class="mb-1">{{ date('d M Y', strtotime($job->created_at)) }}</i>
                        </div> -->
                        </div>
                    <!--<div class="row pb-5 p-5">
                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                        </div>
                    </div>-->
<hr class="my-5">
                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Charges</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($job->job_items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->issue }}</td>
                                        <td>{{ $item->charges }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">${{ $job->total_charges }}</div>
                        </div>

                        
                    </div>
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

