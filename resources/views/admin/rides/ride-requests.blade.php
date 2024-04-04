@extends('admin.layouts.app')

@section('content')

<style>
    .dataTables_length{float: left;}
    .dt-buttons{float: right; margin: 14px 0 0 0px;}
    div.dataTables_processing{top:55%;}
</style>

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                    <li class="active">Rider Requests</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

         <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">
                        Rider Requests
                        <div class="pull-right col-md-3">
                            <select id="payment_status" class="form-control">
                                <option value="all" >All</option>
                                <option value="pending" >Payment Pending</option>
                                <option value="done" >Payment Completed</option>
                            </select>
                        </div>

                        <span class="pull-right" style="margin-top: 4px;">
                            <div id="daterange" class="col-md-4 pull-right date-range">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>

                            
                        </span>
                    </header>
                            

                    <div class="panel-body">

                        <table id="datatable" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>Ride ID</th>
                                <th>Confirmation ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Passengers</th>
                                <th>Category Name</th>
                                <th>Pickup Date Time</th>
                                <th>Trip Type</th>

                                <th>Additional Information</th>
                                <th>Dropoff Instruction</th>
                                  <th>App Name</th>
                                <th>Action</th>
                                
                                <th>DATE</th>
                                <th>CONFIRMATION/REFERENCE #</th>
                                <th>JOB SOURCE</th>
                                <th>CUSTOMER NAME</th>
                                <th>PICKUP</th>
                                <th>DROPOFF</th>
                                <th>PICKUP INSTRUCTION</th>
                                <th>DROPOFF INSTRUCTION</th>
                                <th>BASE PRICE</th>
                                <th>GRATUITY (20%)</th>
                                <th>TAX (8.875%)</th>
                                <th>TOLLS</th>
                                <th>NY BLACK CAR FUND (3%)</th>
                                {{-- <th>OTHER CHARGE</th> --}}
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                <tr class="odd"><td valign="top" colspan="10" class="dataTables_empty">No matching records found</td></tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Ride ID</th>
                                <th>Confirmation ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Passengers</th>
                                <th>Category Name</th>
                                <th>Pickup Date Time</th>
                                <th>Trip Type</th>
                                <th>Additional Information</th>
                                <th>Dropoff Instruction</th>
                                <th>App Name</th>
                                <th>Action</th>

                                <th>DATE</th>
                                <th>CONFIRMATION/REFERENCE #</th>
                                <th>JOB SOURCE</th>
                                <th>CUSTOMER NAME</th>
                                <th>PICKUP</th>
                                <th>DROPOFF</th>
                                <th>PICKUP INSTRUCTION</th>
                                <th>DROPOFF INSTRUCTION</th>
                                <th>BASE PRICE</th>
                                <th>GRATUITY (20%)</th>
                                <th>TAX (8.875%)</th>
                                <th>TOLLS</th>
                                <th>NY BLACK CAR FUND (3%)</th>
                                {{-- <th>OTHER CHARGE</th> --}}
                                <th>TOTAL</th>
                            </tr>

                          </tfoot>

                        </table>

                    </div>

                </section>

            </div>

        </div>   

            

    </section>

</section>



@endsection

@section('scripts')
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" ></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js" ></script>
<script>

    var table;

    $("document").ready(function () {

        var start = moment().subtract(6, 'months');
        var end = moment().add(1, 'months');

        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [{
                text: '<span data-toggle="tooltip" title="Export CSV"><i class="fa fa-lg fa-file-text-o"></i> CSV</span>',
                extend: 'csv',
                className: 'btn btn-sm btn-round btn-success',
                title: 'Ride Request Report',
                extension: '.csv',
                footer: true,
                exportOptions: {
                    columns: [ 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26 ]
                }
            }],
            oLanguage: { sProcessing: '<img src="'+ base_url +'/images/bx_loader.gif">' },
            processing: true,
            serverSide: true,
            paging: false,
            ajax: {
                url: "{{url('admin/ride-requests')}}",
                data : function(d){
                    d.from_date= start.format('YYYY-MM-DD');
                    d.to_date= end.format('YYYY-MM-DD');
                    d.payment_status = $("#payment_status").val();
                }                 
            }, 
            columns: [
                {data: 'ride_id'},
                {data: 'unique_id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone_number'},
                {data: 'no_of_passengers', className: "text-center"},
                {data: 'category_name'},
                {data: 'pickup_date', className: "text-center"},
                {data: 'trip_type'},
                {data: 'additional_info'},
                {data: 'dropoff_inst'},
                {data: 'app_name'},
                {data: 'action', className: "text-center"},

                {data: 'date', visible: false},
                {data: 'unique_id', visible: false},
                {data: 'app_name', visible: false},
                {data: 'name', visible: false},
                {data: 'pickup_location', visible: false},
                {data: 'dropoff_location', visible: false},
                {data: 'pickup_inst', visible: false},
                {data: 'dropoff_inst', visible: false},

                {data: 'payment_details.fare_without_taxes', visible: false, searchable: false},
                {data: 'payment_details.gratuty', visible: false, searchable: false},
                {data: 'payment_details.new_york_city_fee', visible: false, searchable: false},
                {data: 'payment_details.toll', visible: false, searchable: false},
                {data: 'payment_details.black_car_finder_fee', visible: false, searchable: false},
                // {data: 'payment_details.charges', visible: false, searchable: false},
                {data: 'payment_details.charges', visible: false, searchable: false}

                // <th>BASE PRICE</th>
                // <th>GRATUITY (20%)</th>
                // <th>TAX (8.875%)</th>
                // <th>TOLLS</th>
                // <th>NY BLACK CAR FUND (3%)</th>
                // <th>OTHER CHARGE</th>
                // <th>TOTAL</th>
            ],
            createdRow: function ( row, data, index ) {
    
                if ( data['payment_status'] == 'done' ) {
                    $('td', row).addClass('success');
                } 
            
            },
            "order": []
        });            
        
        var reload_datatable = $("#datatable").dataTable( { bRetrieve : true } );

        $('#daterange').daterangepicker({

            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
               'Next 7 Days': [moment(), moment().add(6, 'days')],
               'Next 30 Days': [moment(), moment().add(29, 'days')],
               'This Month': [moment().startOf('month'), moment().endOf('month')]
            }

        }, cb);

        $("#payment_status").change(function(){
            cb(start, end);  
        });
 
        cb(start, end);  

        function cb(from_date, end_date) {
            start = from_date;
            end = end_date;
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            reload_datatable.fnDraw();
        } 

    }); //..... end of ready() .....//

</script>

@endsection