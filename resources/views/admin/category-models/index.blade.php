@extends('admin.layouts.app')



@section('content')

<section id="main-content" >

    <section class="wrapper">

        <div class="row">

            <div class="col-md-12">

                <!--breadcrumbs start -->

                <ul class="breadcrumb">

                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ url('admin/categories') }}"> Categories</a></li>

                    <li class="active">Category Models</li>

                </ul>

                <!--breadcrumbs end -->

            </div>

        </div>                

        

         <div class="row">

            <div class="col-sm-12">

                <section class="panel">

                    <header class="panel-heading">

                        {{ $category->name }} Models

                        <span class="tools pull-right">

                            <a href="{{ url('admin/category-models/create/'.$encoded_id) }}" class="btn btn-info btn-sm" title="Add New Category Model">

                                <i class="fa fa-plus" aria-hidden="true"></i> Add New

                            </a>

                         </span>

                    </header>

                    <div class="panel-body">

                        <table id="datatable" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>Make Name</th>
                                <th>Model Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No matching records found</td></tr>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Make Name</th>
                                <th>Model Name</th>
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
                url: "{{url('admin/get-category-models/'.$id)}}",                
            }, 
            columns: [
                {data: 'make_name'},
                {data: 'model_name'},
                {data: 'action', width: '10%', className: "text-center", orderable: false, searchable: false}
            ],
            "order": []
        });   


        var reload_datatable = $("#datatable").dataTable( { bRetrieve : true } );

        $(document).on('change', '.filter_by_type', function (e) {
            reload_datatable.fnDraw();
        });


        $('#datatable').on('click', '.btn-delete', function (e) { 
            e.preventDefault();

            var id = $(this).attr('id');
            var url= "{{url('admin/delete-category-model')}}"+'/'+id;
            var method = "get";

            remove_record(url,reload_datatable,method);
        }); //..... end of btn-delete .....//
    }); //..... end of ready() .....//

</script>



@endsection