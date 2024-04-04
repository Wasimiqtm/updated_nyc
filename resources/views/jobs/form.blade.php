
<div class="row">            
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">Job Book In</header>
            <div class="panel-body">
                <div class="position-center">                                                                                                                

                  <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                    {!! Form::label('customer_name', 'Customer Name', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {!! Form::text('customer_name', null, ['class' => 'form-control','placeholder'=>'Customer Name','required' => 'required']) !!}
                        {!! $errors->first('customer_name', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : ''}}">
                    {!! Form::label('mobile_number', 'Mobile Number', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('mobile_number', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Mobile Number']) !!}
                        {!! $errors->first('mobile_number', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('landline_number') ? 'has-error' : ''}}">
                    {!! Form::label('landline_number', 'Landline Number', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('landline_number', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Landline Number']) !!}
                        {!! $errors->first('landline_number', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    {!! Form::label('email', 'Contact Email', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('email', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Contact Email']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    {!! Form::label('address', 'Address', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::textarea('address', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Address']) !!}
                        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>                                                                                        

                  <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                    {!! Form::label('status', 'Status', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {{ Form::select('status',  ['0'=>'In Progress','1'=>'Completed','2'=>'Collected'], null,['class' => 'form-control select2']) }}
                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                    </div>
                  </div>                                                                                 

                  <hr/><h4>Repairing Items</h4><hr/>
                  
                  <div id="items">

                    @if(isset($job) && $job->job_items->count()>0)
                    @foreach($job->job_items as $item)
                        <div class="item item-{{$item->id}}">
                            <input type="hidden" name="item_id" class="item_id" value="{{ $item->id }}">
                            <div class="col-md-3">
                                {!! Form::text('name', $item->name, ['class' => 'form-control item_name','placeholder'=>'Item Name','required' => 'required']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('issue', $item->issue, ['class' => 'form-control item_issue','placeholder'=>'Description']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::text('charges', $item->charges, ['class' => 'form-control item_charges','placeholder'=>'Charges']) !!}
                            </div>                  
                            @if ($loop->first)
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success addNewItem" ><i class="fa fa-plus-circle"></i></button>
                            </div> 
                            @else
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger removeItem" ><i class="fa fa-minus-circle"></i></button>
                            </div> 
                            @endif
                        </div>  
                    @endforeach    
                    @else
                        <div class="item">
                            <input type="hidden" name="item_id" class="item_id" value="0">
                            <div class="col-md-3">
                                {!! Form::text('name', null, ['class' => 'form-control item_name','placeholder'=>'Item Name','required' => 'required']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('issue', null, ['class' => 'form-control item_issue','placeholder'=>'Description','required' => 'required']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::text('charges', null, ['class' => 'form-control item_charges','placeholder'=>'Charges']) !!}
                            </div>                  
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success addNewItem" ><i class="fa fa-plus-circle"></i></button>
                            </div> 
                        </div>
                    @endif
                 </div>    

                 <div class="payment">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('payment_status') ? 'has-error' : ''}}">                        
                            <div class="col-md-12">
                                {!! Form::radio('payment_status', 1,1, ['class' => 'payment_status']) !!} Paid
                                {!! Form::radio('payment_status', 2,null, ['class' => 'payment_status']) !!} Partial
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                     <div class="form-group {{ $errors->has('total_charges') ? 'has-error' : ''}}">
                        {!! Form::label('total_charges', 'Total Charges', ['class' => 'col-md-6 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('total_charges', null, ['class' => 'form-control total_charges','placeholder'=>'Total Charges','readonly'=>'readonly']) !!}
                            {!! $errors->first('total_charges', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    </div>
                     
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('payment_status') ? 'has-error' : ''}}">                        
                            <div class="col-md-12">
                                {!! Form::number('service_warranty',null, ['class' => 'form-control','min'=>0,'placeholder'=>'Service Warranty']) !!}
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group paid_amount {{ $errors->has('total_paid') ? 'has-error' : ''}}">
                        {!! Form::label('total_paid', 'Total Paid', ['class' => 'col-md-6 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('total_paid', null, ['class' => 'form-control total_paid','placeholder'=>'Total Paid']) !!}
                            {!! $errors->first('total_paid', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="form-group paid_amount {{ $errors->has('reciveable') ? 'has-error' : ''}}">
                        {!! Form::label('reciveable', 'Reciveable', ['class' => 'col-md-6 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('reciveable', null, ['class' => 'form-control reciveable','placeholder'=>'Reciveable','readonly'=>'readonly']) !!}
                            {!! $errors->first('reciveable', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-info pull-right']) !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
    
</div>

<div id="hidden_fields"></div>
<div id="item_html" style="display: none;">
    <div class="item">
        <input type="hidden" name="item_id" class="item_id" value="0">
        <div class="col-md-3">
            {!! Form::text('name', null, ['class' => 'form-control item_name','placeholder'=>'Item Name']) !!}
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-md-6">
            {!! Form::text('issue', null, ['class' => 'form-control item_issue','placeholder'=>'Description']) !!}
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-md-2">
            {!! Form::text('charges', null, ['class' => 'form-control item_charges','placeholder'=>'Charges']) !!}
        </div>                  
        <div class="col-md-1">
            <button type="button" class="btn btn-danger removeItem" ><i class="fa fa-minus-circle"></i></button>
        </div> 
    </div> 
</div>

<style type="text/css">
    .item{display: inline-block;}
    .payment{margin-top: 50px;}
    .paid_amount{display: none;}
</style>
@section('scripts')
<script type="text/javascript">
    
    $(document).ready(function(){                                        
        
        refine_html();

         $(document).on('click','.addNewItem',function(){
            var el = $("#items");
            
            el.append($("#item_html").html());             
            refine_html();
        });
        
        $(document).on('click','.removeItem',function(){

            var item_id = $(this).parents(".item").find("input.item_id").val();
            if(item_id==0){
                $(this).parents(".item").remove();    
                refine_html();  
            }else{
                $.ajax({
                    url: "{{ url('delete-job-item') }}"+'/'+item_id,
                    type: 'delete',
                    success: function (result) { 
                        $(".item-"+item_id).remove();
                        refine_html();
                    }
                    });
            }
            
        });
        
        $(document).on("blur",".item_charges",function(){
            refine_html();  
        });

        $(document).on("blur",".total_paid",function(){
            refine_html();  
        });

        $(document).on("change",".payment_status",function(){
            $(".paid_amount").hide();
            if($(this).val()==2)
                $(".paid_amount").show();            
        });
        
        function refine_html()
        {
            var items_html = $("#items");
            var hidden_fields = $("#hidden_fields");
            var total_items = items_html.find(".item").length;
            hidden_fields.html('<input type="hidden" name="total_items" value="'+ total_items +'" />'); 
            
            var total_charges = 0;            
            items_html.find(".item").each(function(index) { 
                var item_index = index+1;
                var item_html = $(this);   
                var item_id = item_html.find('input.item_id');
                var item_name = item_html.find('input.item_name');
                var item_issue = item_html.find('input.item_issue');
                var item_charges = item_html.find('input.item_charges');

                item_id.attr("name", 'item_id-' +item_index);            
                item_name.attr("name", 'item_name-' +item_index);
                item_issue.attr("name", 'item_issue-' +item_index);
                item_charges.attr("name", 'item_charges-' +item_index);                           
                                
                var price = item_charges.val();
                if (isNaN(price) || price=="") price = 0; 
                total_charges = parseInt(total_charges) + parseInt(price);               
                $(".total_charges").val(total_charges);
                var total_paid = $(".total_paid").val();
                if (isNaN(total_paid) || total_paid=="") total_paid = 0; 

                $(".reciveable").val(total_charges - parseInt(total_paid));

                if($(".payment_status[checked]").val()==2)
                    $(".paid_amount").show();  
            });  

        } 
    });
    


   
</script>
@endsection
