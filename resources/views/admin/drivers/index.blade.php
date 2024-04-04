@extends('admin.layouts.app')



@section('content')

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>

                    <li class="active">Drivers</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

         <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">
                        Drivers
                    </header>

                    <div class="panel-body">

                        <table id="datatable" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Category Name </th>
                                <th>Make - Model Name </th>
                                <th>Online Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                <tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No matching records found</td></tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Category Name</th>
                                <th>Make - Model Name </th>
                                <th>Online Status</th>
                                <th>Status</th>
                                <th>Action</th>
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

                url: "{{url('admin/get-drivers')}}",                

            }, 

            columns: [

                {data: 'name'},
                {data: 'email'},
                {data: 'phone_number'},
                {data: 'category_name'},
                {data: 'make_model_name'},
                {data: 'online_status', name: 'status', width: '10%', className: "text-center", orderable: false, searchable: false},
                {data: 'status', name: 'status', width: '10%', className: "text-center", orderable: false, searchable: false},
                {data: 'action', name: 'action', width: '10%', className: "text-center", orderable: false, searchable: false}

            ],

            "order": []

        });   


    }); //..... end of ready() .....//

</script>



@endsection