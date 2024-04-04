@extends('admin.layouts.app')



@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                   <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Calculator</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                

            {!! Form::open(['url' => 'admin/calculator', 'data-toggle' => 'validator', 'data-disable' => 'false', 'class' => 'form-horizontal', 'files' => true]) !!}

                

                <div class="row">            
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">Calculator</header>
                            <div class="panel-body">
                                <div class="position-center">  

                                  <div class="form-group {{ $errors->has('driver_id') ? 'has-error' : ''}}">
                                    {!! Form::label('driver_id', 'Driver Name', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::select('driver_id', $drivers,null, ['class' => 'form-control select2','placeholder'=>'Select Driver Name','required' => 'required']) !!}
                                        {!! $errors->first('driver_id', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>

                                  <div class="form-group {{ $errors->has('daterange') ? 'has-error' : ''}}">
                                    {!! Form::label('daterange', 'Date Range', ['class' => 'col-md-3 control-label required-input']) !!}
                                    <div class="col-md-9">
                                        {!! Form::text('daterange', null, ['class' => 'form-control','placeholder'=>'Date Range','required' => 'required','id' => 'daterange']) !!}
                                        {!! $errors->first('daterange', '<p class="help-block">:message</p>') !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            {!! Form::submit('Calculate', ['class' => 'btn btn-info pull-right']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                        @if($rides)
                        <section class="panel">
                            <header class="panel-heading">Rides</header>
                            <div class="panel-body">
                                <div class="position-center1">  

                                 
                                  <table id="datatable" class="table table-bordered table-striped">

                                    <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Rider Name</th>
                                        <th>Total Charges</th>
                                        <th>Driver Commission</th>
                                        <th>Ride Date</th>
                                        <th>Status</th>                                
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($rides as $ride)   
                                    @if(@$ride->ride_bill->payment_status=='done') 
                                    <tr>
                                        <td>{{ @$ride->category->name }}</td>
                                        <td>{{ @$ride->rider->name }}</td>
                                        <td align="center">{{ number_format(@$ride->ride_bill->total_charges,2) }}</td>
                                        <td align="center">{{ number_format(@$ride->driver_commission,2) }}</td>
                                        <td>{{ date('d m Y', strtotime($ride->created_at)) }}</td>
                                        <td>{{ $ride->status }}</td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                        <td colspan="6" align="center">No rides found against this criteria</td>                                        
                                    </tr>
                                    @endforelse
                                    @if($total_driver_commission>0)
                                    <tr>
                                        <td colspan="4"></td>
                                        <td><b>Total Driver Commission</b></td>
                                        <td align="center"><b>{{ number_format($total_driver_commission,2) }}</b></td>
                                    </tr>
                                    @endif
                                  </tbody>

                                </table>
                                

                                </div>
                            </div>
                        </section>
                        @endif

                    </div>
                </div>





            {!! Form::close() !!}
    </section>
</section>

@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {

        var start = moment().subtract(6, 'days');
        var end = moment();

        function cb(from_date, end_date) {
    
            start = from_date;
            end = end_date;

            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        }
        

        $('#daterange').daterangepicker({

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

    });

    

</script>

@endsection   