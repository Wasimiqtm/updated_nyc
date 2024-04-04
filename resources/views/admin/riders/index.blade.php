@extends('admin.layouts.app')



@section('content')

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                    <li class="active">Riders</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

         <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">
                        Riders
                    </header>

                    <div class="panel-body">

                        <table id="datatable" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Rides</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No matching records found</td></tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Rides</th>
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
            serverSide: true,
            ajax: {
                url: "{{url('admin/get-riders')}}",                
            }, 
            columns: [
                {data: 'name'},
                {data: 'email'},
                {data: 'phone_number'},
                {data: 'total_rides', className: "text-center"},
            ],
            "order": []
        });   


    }); //..... end of ready() .....//

</script>



@endsection