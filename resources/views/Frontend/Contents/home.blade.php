@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$locations    = app('Location')->getLocaiton();
		$locationGr   = app('Location')->getGroupLocaiton();
		$natures      = app('Location')->getNatrue();
		$businessNews = app('Home')->getBusinessNew();
		$businessHots = app('Home')->getBusinessHot();
		$money_basics = array(
						["value"=> 1, "name"=> "30萬以下"],
						["value"=> 2, "name"=> "30-50萬"],
						["value"=> 3, "name"=> "50-70萬"],
						["value"=> 4, "name"=> "70-100萬"],
						["value"=> 5, "name"=> "100-150萬"],
						["value"=> 6, "name"=> "150-200萬"],
						["value"=> 7, "name"=> "200萬以上"],
						);
		$bannerHome  = app('Home')->getBannerHome();
		$seo         = app('AboutUs')->getSeo();
	@endphp
	<!-- End call to action -->
	<!-- Start creative team -->
	<div class="content-section pt-50">
		<div class="container">
			<div class="col-md-12" class="banner-header ">
	    		<a href="{{ $bannerHome->data->url_header }}" >
	    			<img style="width: 100%;" src="{{ url('') }}{{ $bannerHome->data->banner_header }}" alt="">
	    		</a>
	    	</div>
	    </div>
	</div>
	<div class="content-section pb-100 pt-50">
	    <div class="container">
            <div class="row">
	            <div class="col-md-9 col-sm-9">
	            	<div class="search col-md-12 mt-50">
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
       	                                	@if ($errors->has('code'))
       			                            	<p class="text-left text-danger">{{ $errors->first('code') }}</p>
       			                            @endif
				                           	<div class="form-group">
				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.location') !!} </label>
				                           	    <div class="col-sm-9">
				                           	    	<select name="location_name[]" class="selectpicker" title="{!! trans('fe_business.filter.location') !!}" multiple="multiple" data-live-search="true" data-width="100%">
				                           	    		{{ locationSelect(@$locations, $locationGr, " -- ", array() ) }}
				                           	    	</select>
				                           	    </div>
			                           	    </div>
			                           	    <div class="form-group">
				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.nature') !!} </label>
				                           	    <div class="col-sm-9">
				                           	    	<select class="selectpicker" title="{!! trans('fe_business.filter.nature') !!}" multiple="multiple" data-live-search="true" data-width="100%" name="nature_name[]">
				                           	    	    @foreach (@$natures as $nature)
				                           	    	    	<option value="">{!! @$nature->name_2 !!}</option>
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
       			                           	    	<input style="margin-bottom:0px;" class="form-control" name="freetext" type="text" placeholder="{!! trans('fe_contact.freetext') !!}*"
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
				                           	    <label for="inputEmail3" class="col-sm-3 control-label">{!! trans('fe_business.filter.area') !!}	 </label>
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
	            	<div class="row">
	            	    <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	            	        <div class="main-heading-content text-center">
	            	            <h2>{{ trans('fe_business.new_business') }}</h2>
	            	        </div>
	            	    </div>
	            	</div>
	            	<div class="team-wrapper-slide">
	            		@foreach (@$businessNews as $key => $businessNew)
	            	    <div class="col-md-4 col-sm-6">
	            	        <div class="team-item">
	            	            <div class="team-content">
	            	            	@if (empty($businessNew->image_business)) 
	            	            		<img style="position: absolute; top: 40px; right: 20px; width: 70px; height:70px;" src="{{ url('Frontend/img/noimage.png') }}" alt="">
	            	            	@else 
										<img style="position: absolute; top: 40px; right: 20px; width: 70px; height:70px;" src="https://www.profidelta.com.hk/data/tbl_opportunities_4/org/{{@$businessNew->image_business}}" alt="">
	            	            	@endif
	            	                <h3><a href="{{ route('fe.business_detail', [@$businessNew->id, @$businessNew->intro_2]) }}">{!! @$businessNew->intro_2 !!}</a>
	                        		</h3>
	            	                <span class="position">{!! trans('fe_business.code') !!}: {!! @$businessNew->code !!}</span>
	            	                <p class="pt-20" >{!! trans('fe_business.industry') !!}: {!! @$businessNew->locations->name_2 !!}</p>
	            	                <div class="progress-bar-wrapper">
	            	                    <div class="single-experience">
	            	                        <p>{!! trans('fe_business.sell_price') !!}: HKD {!! number_format(@$businessNew->investment, 0) !!}</p>
	            	                        <div class="progress">
	            	                            
	            	                        </div>
	            	                    </div>
	            	                    <div class="single-experience">
	            	                        <p>{!! trans('fe_business.reference_profit') !!}: {!! @$businessNew->reference_profits !!}</p>
	            	                        <div class="progress">
	            	                            
	            	                        </div>
	            	                    </div>
	            	                    <div class="single-experience">
	            	                        <p>{!! trans('fe_business.this_issue') !!}: {!! @$businessNew->payback_period ? $businessNew->payback_period : "N/A" !!}</p>
	            	                        <div class="progress">
	            	                            
	            	                        </div>
	            	                    </div>
	            	                </div>
	            	            </div>
	            	        </div>
	            	    </div>
	            	    @endforeach
	            	</div>
	            </div>
	            <div class="col-md-3 col-sm-3 banner-r mt-50">
	            	<div class="rt-banner">
	            		<a href="{{ $bannerHome->data->url_rt }}">
	            			<img style="width: 100%" src="{{ url('') }}{{ $bannerHome->data->banner_rt_img }}" alt="">
	            		</a>
	            	</div>
	            	<div class="rb-banner mt-40">
	            		<a href="{{ $bannerHome->data->url_rb }}">
	            			<img style="width: 100%" src="{{ url('') }}{{ $bannerHome->data->banner_rb_img }}" alt="">
	            		</a>
	            	</div>
	            </div>
            </div>
	    </div>
	</div>
	<!-- End creative team -->
	<!-- Start Testimonial section -->
    <!-- Start about us section -->
    
    <div class="content-section ptb-100 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <div class="main-heading-content text-center">
                        <h2>{{ trans('fe_business.hot_business') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="service-wrapper">
                	@foreach ($businessHots as $key => $businessHot)
                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                        	<a href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}">
	                            <div class="service-icon text-center">
	                                <img style="height: 200px; width: 291px" src="https://www.profidelta.com.hk/data/tbl_opportunities_4/org/{{@$businessHot->photo_1}}" alt="">
	                            </div>
	                            <div class="service-text">
	                                <h3>{{ @$businessHot->intro_2 }}</h3>
	                                <p>{!! trans('fe_business.sell_price') !!}：HKD {{ number_format(@$businessHot->investment, 0) }}
										<br>{!! trans('fe_business.reference_profit') !!}：{{ @$businessHot->reference_profits }}
	                                </p>
	                                <a href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}" class="read-more">{{trans('fe_business.read_more')}}</a>
	                            </div>
	                        </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection 

@section ('slide')
	@includeif ('Frontend.Layouts._slide')
@endsection

@section ('myJs')
	<script src="">
		$('.selectpicker').selectpicker({
		    style: 'btn-default'
		  });
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
		})
	</script>
	</script>
@endsection
@section ('myCss')
@endsection

@section ('meta')
	<meta name="description" content="{!! @$seo->data->description !!}">
	<meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)