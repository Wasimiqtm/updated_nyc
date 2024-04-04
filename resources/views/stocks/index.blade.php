@extends('layouts.app')

@section('content')
<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="active">Stocks</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>                
        
         <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Students
                        <span class="tools pull-right">
                            <a href="{{ url('stocks/create') }}" class="btn btn-info btn-sm" title="Add New Stock">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Stock Name</th>
                                <th>Cost</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Stock Name</th>
                                <th>Cost</th>
                                <th>Price</th>
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
                url: "{{url('get-stocks')}}",                
            }, 
            columns: [
                {data: 'image', name: 'image',width:'10%', className: "text-center"},
                {data: 'name', name: 'name'},
                {data: 'cost', name: 'cost'},
                {data: 'price', name: 'price'},
                {data: 'action', name: 'action', width: '10%', className: "text-center", orderable: false, searchable: false}
            ],
            "order": []
        });   
        
        
        var reload_datatable = $("#datatable").dataTable( { bRetrieve : true } );        
        
        $('#datatable').on('click', '.btn-delete', function (e) { 
            e.preventDefault();

            var id = $(this).attr('id');
            var url= "{{url('stocks')}}"+'/'+id;
            var method = "delete";
        
            remove_record(url,reload_datatable,method);
        }); //..... end of btn-delete .....//
    }); //..... end of ready() .....//
</script>

@endsection