@extends('Frontend.Layouts.default')
@section ('title', trans('fe_business.business'))
@section ('content')
	@php
		$locations    = app('Location')->getLocaiton();
		$locationGr   = app('Location')->getGroupLocaiton();
		$natures      = app('Location')->getNatrue();
		$money_basics = array(
						["value"=> 1, "name"=> "30萬以下"],
						["value"=> 2, "name"=> "30-50萬"],
						["value"=> 3, "name"=> "50-70萬"],
						["value"=> 4, "name"=> "70-100萬"],
						["value"=> 5, "name"=> "100-150萬"],
						["value"=> 6, "name"=> "150-200萬"],
						["value"=> 7, "name"=> "200萬以上"],
						) ;
		$seo          = app('AboutUs')->getSeo();
	@endphp
	<div class="content-section ptb-80">
	    <div class="container">
	    	<div class="row">
	    	    <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	    	        <div class="main-heading-content text-center">
	    	            <h2>{!! trans('fe_business.business') !!}</span></h2>
	    	        </div>
	    	    </div>
	    	</div>
	        <div class="row">
	            <div class="col-md-9 col-sm-9">
	            	<div class="row">
		            	<div class="search col-md-12">
			            	<div class="panel" style="box-shadow: 0 10px 30px 0 rgba(5, 5, 7, 0.5)">
			            		<div class="panel-body">
					            	<form action="{{ route('fe.business') }}" method="GET" class="form-horizontal">
					            		@csrf
						                <div class="col-md-12 col-sm-12">
				                            <div class="col-md-5">
            		                           	<div class="form-group">
            		                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.code') !!} </label>
            		                           	    <div class="col-sm-9">
            		                           	    	<input style="margin-bottom:0px;" class="form-control" name="code" type="text" placeholder="{!! trans('fe_business.code') !!}*"
            	                           		value="{{ old('code') }}">
            		                           	    </div>
            	                           	    </div>
					                           	<div class="form-group">
					                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.location') !!} </label>
					                           	    <div class="col-sm-9">
					                           	    	<select name="location_name[]" class="selectpicker" title="行業" multiple="multiple" data-live-search="true" data-width="100%">
					                           	    		{{ locationSelect(@$locations, $locationGr, " -- ", old('location_name') ? old('location_name') : array() ) }}
					                           	    	</select>
					                           	    </div>
				                           	    </div>
				                           	    <div class="form-group">
					                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.nature') !!}  </label>
					                           	    <div class="col-sm-9">
					                           	    	<select class="selectpicker" title="地區" multiple="multiple" data-live-search="true" data-width="100%" name="nature_name[]">
					                           	    		@php 
					                           	    			$old_nature_name = old('nature_name') ? old('nature_name') : array();
					                           	    		@endphp
					                           	    	    @foreach (@$natures as $nature)
					                           	    	    	@if (in_array(@$nature->id, $old_nature_name) && !empty($old_nature_name) )
																	<option selected="selected" value="{{ @$nature->id }}">
																		{!! @$nature->name_2 !!}
																	</option>
					                           	    	    	@else
																	<option value="{{ @$nature->id }}">
																		{!! @$nature->name_2 !!}
																	</option>
					                           	    	    	@endif
					                           	    	    	
					                           	    	    @endforeach
					                           	    	</select>
					                           	    </div>
				                           	    </div>
				                           	    <div class="form-group">
					                           	    <label for="inputEmail3"  class="col-sm-3 control-label">{!! trans('fe_business.filter.investment') !!} </label>
					                           	    <div class="col-sm-9">
					                           	      	<select name="money_basic" class="form-control" name="industry">
		           		                           			<option value="">-- None --</option>
		           		                           			@foreach ($money_basics as $money_basic) 
												            	<option 
												            	@if($money_basic['value'] == old('money_basic')) selected @endif
												            	value="{{ $money_basic['value'] }}">{{ $money_basic['name'] }}</option>
												            @endforeach
		           		                           		</select>
					                           	    </div>
				                           	    </div>
				                            </div>
				                            <div class="col-md-7">
				                            	<div class="form-group">
            		                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.freetext') !!} </label>
            		                           	    <div class="col-sm-9">
            		                           	    	<input style="margin-bottom:0px;" class="form-control" name="freetext" type="text" placeholder="{!! trans('fe_business.freetext') !!}*"
            	                           		value="{{ old('freetext') }}">
            		                           	    </div>
            	                           	    </div>
    			                           	    <div class="form-group">
    				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.profit') !!} </label>
    				                           	    <div class="col-sm-9">
    				                           	      	<div class="input-daterange input-group" id="datepicker">
  						                                    <input type="text" class="form-control" value="{{ old('start_profit') }}" name="start_profit">
  						                                    <span class="input-group-addon">-</span>
  						                                    <input type="text" class="form-control" value="{{ old('end_profit') }}" name="end_profit">
  						                                </div>
    				                           	    </div>
    			                           	    </div>
				                            </div>
				                            <div class="col-md-7">
    			                           	    <div class="form-group">
    				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.rent') !!} </label>
    				                           	    <div class="col-sm-9">
    				                           	      	<div id="demo-dp-range">
      						                                <div class="input-daterange input-group">
      						                                    <input type="text" class="form-control" value="{{ old('start_rent') }}" name="start_rent">
      						                                    <span class="input-group-addon">-</span>
      						                                    <input type="text" class="form-control" value="{{ old('end_rent') }}" name="end_rent">
      						                                </div>
      						                            </div>
    				                           	    </div>
    			                           	    </div>
				                            </div>
				                            <div class="col-md-7">
    			                           	    <div class="form-group">
    				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.area') !!}</label>
    				                           	    <div class="col-sm-9">
    				                           	      	<div id="demo-dp-range">
      						                                <div class="input-daterange input-group" id="datepicker">
      						                                    <input type="text" class="form-control" value="{{ old('start_premise_size') }}" name="start_premise_size">
      						                                    <span class="input-group-addon">-</span>
      						                                    <input type="text" class="form-control" value="{{ old('end_premise_size') }}" name="end_premise_size">
      						                                </div>
      						                            </div>
    				                           	    </div>
    			                           	    </div>
				                            </div>
						                </div>
										<div class="col-md-12">
											<button class="button comment-cntact active pull-right" type="submit">{{ trans('fe_business.filter.sreach') }}</button>
												<p class="bigtech-send-message"></p>
										</div>
					                </form>
			            		</div>
			            	</div>
		            	</div>
	            	</div>
	            </div>
	            <div class="col-md-3 col-sm-3 send_mail">
	            	<!-- <form action="{{ route('fe.sendMail') }}" method="post" accept-charset="utf-8"> -->
	            		<!-- @csrf -->
	            		<div class="input-send-mail">
	            			<div class="form-group">
	            				<input type="text" name="email" placeholder="your email">
	            				<button class="btn btn-default" type="submit">
	            					{!! trans('fe_business.send') !!}
	            				</button>
	            			</div>
	            		</div>
	            	<!-- </form> -->
	            </div>
	        </div>
	        <div class="team-wrapper-slide mt-40">
	        	@foreach (@$businessNews as $key => $businessNew)
	            <div class="col-md-4 col-sm-6">
	                <div class="team-item" style="background: #fff;">
	                    <div class="team-content">
	                        <div class="team-title-item">
            	            	@if (empty($businessNew->image_business)) 
            	            		<img style="position: absolute; top: 40px; right: 30px; width: 90px; height:90px;" src="{{ url('Frontend/img/noimage.png') }}" alt="">
            	            	@else 
									<img style="position: absolute; top: 40px; right: 30px; width: 90px; height:90px;" src="https://www.profidelta.com.hk/data/tbl_opportunities_4/org/{{@$businessNew->image_business}}" alt="">
            	            	@endif
	                        	<h3><a href="{{ route('fe.business_detail', [@$businessNew->id, @$businessNew->intro_2]) }}">{!! @$businessNew->intro_2 !!} </a> 
	                        		@if (@$businessNew->hot_item == 1)
	                        			<img src="{{ url('Frontend/img/service/hot.gif') }}" alt="">
	                        		@endif
	                        	</h3>
	                        	<span class="position">{!! trans('fe_business.code') !!}: {!! @$businessNew->code !!}</span>
	                        	{!! @$businessNew->desc_3 ? $businessNew->desc_3 : '' !!}
	                        </div>
	                        <div class="progress-bar-wrapper pt-10">
	                        	<div class="single-experience">
	                                <p>{!! trans('fe_business.industry') !!}: {!! @$businessNew->locations->name_2 !!}</p>
	                                <div class="progress">
	                                </div>
	                            </div>
	                            <div class="single-experience">
	                                <p>{!! trans('fe_business.investment') !!}: <span class="text-danger">
											HKD {!! number_format(@$businessNew->investment, 0) !!}
										</span></p>
	                                <div class="progress">
	                                    
	                                </div>
	                            </div>
	                            <div class="single-experience">
	                                <p>{!! trans('fe_business.reference_profits') !!}: {!! @$businessNew->reference_profits !!}</p>
	                                <div class="progress">
	                                    
	                                </div>
	                            </div>
	                            <div class="single-experience">
	                                <p>{!! trans('fe_business.payback_period') !!}: {!! @$businessNew->payback_period ? $businessNew->payback_period : 'N/a' !!}</p>
	                                <div class="progress">
	                                   
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	            <div class="row ">
	            	<div class="col-lg-12 pagination-area text-center">
	            		{{ @$businessNews->appends(Request::all())->links() }}
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
	<script>
		$(document).ready(function (){
			var height = function (itemClass) {
				var maxHeight = 0;
				$(itemClass).each(function() {
					if (maxHeight < $(this).height()) {
						maxHeight = $(this).height();
					}
				});
				$(itemClass).height(maxHeight);
			}		
			height('.team-item');
			height('.team-title-item');
		})
	</script>
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name="description" content="{!! @$seo->data->description !!}">
	<meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)
