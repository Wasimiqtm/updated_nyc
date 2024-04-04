@extends('admin.layouts.app')



@section('content')

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                    <li class="active">Rides</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>



         <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">
                        Rides
                    </header>

                    <div class="panel-body">

                        <table id="datatable" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Driver Name</th>
                                <th>Rider Name</th>
                                <th>Total Charges</th>
                                <th>Cancelation Charges</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                 <th>App Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No matching records found</td></tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Category Name</th>
                                <th>Driver Name</th>
                                <th>Rider Name</th>
                                <th>Total Charges</th>
                                <th>Cancelation Charges</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>App Name</th>
                                <th>Status</th>
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



<script>



    var table;

    $("document").ready(function () {

        $('#datatable').DataTable({
            oLanguage: { sProcessing: '<img src="'+ base_url +'/images/bx_loader.gif">' },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{url('admin/get-rides')}}",
                data : function(d){
                    d.driver_id = $(".filter_by_driver option:selected").val();
                    d.rider_id = $(".filter_by_rider option:selected").val();
                }
            },
            columns: [
                {data: 'category_name'},
                {data: 'driver_name'},
                {data: 'rider_name'},
                {data: 'total_charges', className: "text-center"},
                {data: 'cancelation_charges', className: "text-center"},
                {data: 'start_date', className: "text-center"},
                {data: 'end_date', className: "text-center"},
                   {data: 'app_name', className: "text-center"},
                {data: 'status', name: 'status', width: '10%', className: "text-center", orderable: false, searchable: false}
            ],
            "order": []
        });


        $("#datatable_length").append('{!! Form::select("driver_id", getDriversFilterDropdown(), null, ["class" => "form-control input-sm filter_by_driver select2","style"=>"margin-left: 20px;"]) !!}');
        $("#datatable_length").append('{!! Form::select("rider_id", getRidersFilterDropdown(), null, ["class" => "form-control input-sm filter_by_rider select2","style"=>"margin-left: 10px;"]) !!}');

        var reload_datatable = $("#datatable").dataTable( { bRetrieve : true } );

        $(document).on('change', '.filter_by_driver', function (e) {
            reload_datatable.fnDraw();
        });
        $(document).on('change', '.filter_by_rider', function (e) {
            reload_datatable.fnDraw();
        });

    }); //..... end of ready() .....//

</script>



@endsection