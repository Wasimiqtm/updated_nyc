@extends('layouts.app')

@section('css')
<style>
    .mini-stat{background: #f7f7f7;}
</style>
@endsection
@section('content')
<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li class="active"><i class="fa fa-home"></i> Dashboard</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Dashboard                        
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ url('jobs') }}">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon pink"><i class="fa fa-shopping-cart"></i></span>
                                        <div class="mini-stat-info" data-toggle="tooltip" title="Total Jobs">
                                            <span>{{ totalJobs() }}</span>
                                            Total Jobs
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('company-assets') }}">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon tar"><i class="fa fa-th-list"></i></span>
                                        <div class="mini-stat-info" data-toggle="tooltip" title="Total Company Assets">
                                            <span>{{ totalAssets() }}</span>
                                            Company Assets
                                        </div>
                                    </div>
                                </a>
                            </div>                            

                            <div class="col-md-3">
                                <a href="{{ url('stocks') }}">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon pink"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info" data-toggle="tooltip" title="Total Stocks">
                                            <span>{{ totalStocks() }}</span>
                                            Total Stocks
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <!-- <div class="col-md-3">
                                <a href="javascript:void(0)">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon tar"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info" data-toggle="tooltip" title="Current Month Received Fees">
                                            <span>3</span>
                                            Received Fees
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon orange"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info"  data-toggle="tooltip" title="Current Month Pending Fees">
                                            <span>3</span>
                                            Pending Fees
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon orange"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info"  data-toggle="tooltip" title="Current Month Discount">
                                            <span>23</span>
                                            Total Discount
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon tar"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info"  data-toggle="tooltip" title="Current Month Arrears">
                                            <span>3</span>
                                            Total Arrears
                                        </div>
                                    </div>
                                </a>    
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon tar"><i class="fa fa-money"></i></span>
                                        <div class="mini-stat-info"  data-toggle="tooltip" title="Current Month Printing Charges">
                                            <span>3</span>
                                            Total Printings Charges
                                        </div>
                                    </div>
                                </a>    
                            </div> -->

                            <!-- <div class="col-md-3">
                                <a href="{{ url('company/customers') }}">
                                    <div class="mini-stat clearfix">
                                        <span class="mini-stat-icon pink"><i class="fa fa-users"></i></span>
                                        <div class="mini-stat-info">
                                            <span>0</span>
                                            Customers
                                        </div>
                                    </div>
                                </a>    
                            </div> --> 
                        </div>
                    </div>
                </section>
            </div>
        </div>       
    </section>
</section>
      
@endsection


@section('scripts')
<script type="text/javascript">
    
    $(document).ready(function () {
        
    var start = moment().subtract(6, 'days');
    var end = moment();

    function cb(from_date, end_date) {
        
        $(".retail-dashboard").LoadingOverlay("show");
        
        start = from_date;
        end = end_date;
        var store_id = $('#store_reports').val();
        
        $.ajax({
            url :  '{{ url("company/reports/retail-dashboard") }}',
            type: 'post',
            data: 'store_id='+store_id+'&from_date='+start.format('YYYY/MM/DD')+'&to_date='+end.format('YYYY/MM/DD'),
            //data: {'from_date':start, 'to_date': end},
            success: function (result) { 
                console.log(result);
                var data = result.result;
                $('#total_income').text(data.total_income);
                $('#total_sales').text(data.total_sales);
                $('#total_customers').text(data.total_customers);
                $('#total_profit').text(data.total_profit);
                $('#total_discount').text(data.total_discount);
                $('#discount_percentage').text(data.discount_percentage);
                $('#basket_value').text(data.basket_value);
                $('#basket_size').text(data.basket_size); 
        
                $(".retail-dashboard").LoadingOverlay("hide");
               
            }
        });
        
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
    }
    
    $(document).on('change', '#store_reports', function(){
        cb(start, end)
     });
    
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    //cb(start, end);

    });
    
</script>
@endsection                            

