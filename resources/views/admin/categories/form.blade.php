

<div class="row">            
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">{{ isset($submitButtonText) ? $submitButtonText : 'Create' }} Category</header>
            <div class="panel-body">
                <div class="position-center">                                                                            
                  
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Category Name', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Category Name','required' => 'required']) !!}
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">                     
                    {!! Form::label('image', 'Image', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                @if(@$category->image != '')
                                    <img src="{{ checkImage('categories/'. $category->image) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="image" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>

                <div class="form-group {{ $errors->has('car_icon') ? 'has-error' : ''}}">                     
                    {!! Form::label('car_icon', 'Car Icon', ['class' => 'col-lg-3 col-sm-3 control-label']) !!}                                            
                    <div class="col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                @if(@$category->car_icon != '')
                                    <img src="{{ checkImage('categories/'. $category->car_icon) }}" alt="" />
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="car_icon" accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-info fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                            {!! $errors->first('car_icon', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>                        
                    </div>
                </div>

                    <div class="form-group {{ $errors->has('no_of_bags') ? 'has-error' : ''}}">
                        {!! Form::label('no_of_bags', 'No. Of Bags', ['class' => 'col-md-3 control-label required-input']) !!}
                        <div class="col-md-9">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                                {!! Form::number('no_of_bags', null, ['class' => 'form-control','placeholder'=>'No. Of BagsNo. Of Bags','required' => 'required','min'=>'0','step'=>"1"]) !!}
                            </div>
                            {!! $errors->first('no_of_bags', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('no_of_passengers') ? 'has-error' : ''}}">
                        {!! Form::label('no_of_passengers', 'No. Of Passengers', ['class' => 'col-md-3 control-label required-input']) !!}
                        <div class="col-md-9">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                                {!! Form::number('no_of_passengers', null, ['class' => 'form-control','placeholder'=>'No. Of Passengers','required' => 'required','min'=>'0','step'=>"1"]) !!}
                            </div>
                            {!! $errors->first('no_of_passengers', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                  <div class="form-group {{ $errors->has('base_fare') ? 'has-error' : ''}}">
                    {!! Form::label('base_fare', 'Base Fare', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('base_fare', null, ['class' => 'form-control','placeholder'=>'Base Fare','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>
                        {!! $errors->first('base_fare', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>  
                    </div>
                  </div>

                    <div class="form-group {{ $errors->has('alternate_fare') ? 'has-error' : ''}}">
                        {!! Form::label('alternate_fare', 'Alternate Fare', ['class' => 'col-md-3 control-label required-input']) !!}
                        <div class="col-md-9">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                                {!! Form::number('alternate_fare', null, ['class' => 'form-control','placeholder'=>'Alternate Fare','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                            </div>
                            {!! $errors->first('alternate_fare', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                  <div class="form-group {{ $errors->has('cost_per_mile') ? 'has-error' : ''}}">
                    {!! Form::label('cost_per_mile', 'Cost Per Mile', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('cost_per_mile', null, ['class' => 'form-control','placeholder'=>'Cost Per Mile','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('cost_per_mile', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('cost_per_minute') ? 'has-error' : ''}}">
                    {!! Form::label('cost_per_minute', 'Cost Per Minute', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('cost_per_minute', null, ['class' => 'form-control','placeholder'=>'Cost Per Minute','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('cost_per_minute', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('advance_booking_fee') ? 'has-error' : ''}}">
                    {!! Form::label('advance_booking_fee', 'Rate Per Hour', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('advance_booking_fee', null, ['class' => 'form-control','placeholder'=>'Rate Per Hour','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('advance_booking_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('cancelation_fee') ? 'has-error' : ''}}">
                    {!! Form::label('cancelation_fee', 'Cancelation Fee', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('cancelation_fee', null, ['class' => 'form-control','placeholder'=>'Cancelation Fee','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('cancelation_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('meet_greet_fee') ? 'has-error' : ''}}">
                    {!! Form::label('meet_greet_fee', 'Gratuity', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('meet_greet_fee', null, ['class' => 'form-control','placeholder'=>'Gratuity','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('meet_greet_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('black_car_finder_fee') ? 'has-error' : ''}}">
                    {!! Form::label('black_car_finder_fee', 'Black Car Fund', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">%</button>
                            </span>
                            {!! Form::number('black_car_finder_fee', null, ['class' => 'form-control','placeholder'=>'Black Car Fund','required' => 'required','min'=>'0','max'=>'100','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('black_car_finder_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                    {{--<div class="form-group {{ $errors->has('state_wise_percentage') ? 'has-error' : ''}}">
                        {!! Form::label('state_wise_percentage', 'State Wise Percentage', ['class' => 'col-md-3 control-label required-input']) !!}
                        <div class="col-md-9">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">%</button>
                            </span>
                                {!! Form::number('state_wise_percentage', null, ['class' => 'form-control','placeholder'=>'State Wise Percentage','min'=>'0','max'=>'100','step'=>"0.001"]) !!}
                            </div>
                            {!! $errors->first('state_wise_percentage', '<p class="help-block">:message</p>') !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>--}}

                  <div class="form-group {{ $errors->has('new_york_city_fee') ? 'has-error' : ''}}">
                    {!! Form::label('new_york_city_fee', 'New York State & City Sales Tax', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">%</button>
                            </span>
                            {!! Form::number('new_york_city_fee', null, ['class' => 'form-control','placeholder'=>'New York State & City Sales Tax','required' => 'required','min'=>'0','max'=>'100','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('new_york_city_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  {{--<div class="form-group {{ $errors->has('sr_cancelation_fee') ? 'has-error' : ''}}">
                    {!! Form::label('sr_cancelation_fee', 'Schedule Ride Cancelation Fee', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">$</button>
                            </span>
                            {!! Form::number('sr_cancelation_fee', null, ['class' => 'form-control','placeholder'=>'Schedule Ride Cancelation Fee','required' => 'required','min'=>'0','step'=>"0.001"]) !!}
                        </div>    
                        {!! $errors->first('sr_cancelation_fee', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>--}}

                  <div class="form-group {{ $errors->has('cancel_schedule_ride_min_period') ? 'has-error' : ''}}">
                    {!! Form::label('cancel_schedule_ride_min_period', 'Cancel Schedule Ride Min Period', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                            {!! Form::number('cancel_schedule_ride_min_period', null, ['class' => 'form-control','placeholder'=>'Cancel Schedule Ride Min Period','required' => 'required','min'=>'0']) !!}
                        {!! $errors->first('cancel_schedule_ride_min_period', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('cancel_schedule_ride_max_period') ? 'has-error' : ''}}">
                    {!! Form::label('cancel_schedule_ride_max_period', 'Cancel Schedule Ride Max Period', ['class' => 'col-md-3 control-label required-input']) !!}
                    <div class="col-md-9">
                            {!! Form::number('cancel_schedule_ride_max_period', null, ['class' => 'form-control','placeholder'=>'Cancel Schedule Ride Max Period','required' => 'required','min'=>'0']) !!}
                        {!! $errors->first('cancel_schedule_ride_max_period', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::textarea('description', null, ['class' => 'form-control','rows'=>'3','placeholder'=>'Description']) !!}
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                        <div class="help-block with-errors"></div>
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

