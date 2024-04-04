@extends('layouts.app')

@section('content')
<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="active">Jobs</li>
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
                            <a href="{{ url('job-book-in') }}" class="btn btn-info btn-sm" title="Job Book In">
                                <i class="fa fa-plus" aria-hidden="true"></i> Job Book In
                            </a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Landline</th>
                                <th>Job Date</th>                
                                <th>Status</th>        
                                <th>Send Message</th>               
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Landline</th>
                                <th>Job Date</th>                
                                <th>Status</th>                       
                                <th>Send Message</th>                       
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

    @if(Session::has('service_id'))
    window.open('{{ url("service-sheet/".Hashids::encode(Session::get("service_id"))) }}', '_blank');
    @endif
    @if(Session::has('sticker_id'))
    window.open('{{ url("print-sticker/".Hashids::encode(Session::get("sticker_id"))) }}', '_blank');
    @endif

    var table;
    $("document").ready(function () {
        $('#datatable').DataTable({
            oLanguage: { sProcessing: '<img src="'+ base_url +'/images/bx_loader.gif">' },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{url('get-jobs')}}"                
            }, 
            columns: [
                {data: 'customer_name', name: 'customer_name',width:'10%', className: "text-center"},
                {data: 'mobile_number', name: 'mobile_number',width:'12%'},
                {data: 'landline_number', name: 'landline_number', width: '15%', className: "text-center"},                
                {data: "created_at", name: 'created_at',width:'15%'},
                {data: 'status', name: 'status', width: '10%', className: "text-center", orderable: false, searchable: false},
                {data: 'message', name: 'message', width: '10%', className: "text-center", orderable: false, searchable: false},
                {data: 'action', name: 'action', width: '10%', className: "text-center", orderable: false, searchable: false}
            ],
            "order": [[ 3, "asc"]]
        });   
        
         // $("#datatable_length").append('{!! Form::select("type", [""=>"Search by Admission Type","1"=>"New","2"=>"Old"], null, ["class" => "form-control input-sm filter_by_type","style"=>"margin-left: 20px;"]) !!}');
        
        var reload_datatable = $("#datatable").dataTable( { bRetrieve : true } );
        
        $(document).on('change', '.filter_by_type', function (e) {
            reload_datatable.fnDraw();
        });
        
        $('#datatable').on('click', '.btn-delete', function (e) { 
            e.preventDefault();

            var id = $(this).attr('id');
            var url= "{{url('delete-job')}}"+'/'+id;
            var method = "delete";
        
            remove_record(url,reload_datatable,method);
        }); //..... end of btn-delete .....//
    }); //..... end of ready() .....//
</script>

@endsection