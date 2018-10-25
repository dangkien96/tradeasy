@extends('Frontend.Layouts.default')
@section ('title', @$business->intro_2 )
@section ('content')
@php
    $businessHots = app('Home')->getBusinessHot();
@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{{ @$business->intro_2 }}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-8 col-sm-8">
                        <div class="service-text" style="overflow: auto; background-color: #fff">
                            <div class="pt-20">
                            	<div class="col-md-7">
                            	<p><span class="title">{{ trans('fe_business.code') }}</span> {{ @$business->code }}</p>
                            	<p><span class="title"> 頂手費:</span> HKD {{ number_format(@$business->investment, 0,",","," ) }}</p>
                            	<p><span class="title">{{ trans('fe_business.reference_profits') }}: </span> {{ @$business->reference_profits }}</p>
                            	<p><span class="title">{{ trans('fe_business.payback_period') }}:</span> {{ @$business->payback_period }}</p>
                            	<p><span class="title">{{ trans('fe_business.rent') }}: </span> {{ @$business->Rent }}</p>
                            </div>
                            <div class="col-md-5">
                            	<p><span class="title">{{ trans('fe_business.location') }}:</span> {{ @$business->locations->name_2 ? $business->locations->name_2 : 'N/A' }} </p>
                            	<p><span class="title">{{ trans('fe_business.nature') }}:</span> {{ @$business->natures->name_2 }} </p>
                            	<p><span class="title">{{ trans('fe_business.revenue') }}:</span> {{ @$business->Revenue }} </p>
                            	<p><span class="title">{{ trans('fe_business.premise_size') }}:</span> {{ @$business->Premise_Size }}</p>
                            </div>
                            <div class="col-md-12 pt-50">
                            	<span>{{ trans('fe_business.description') }}: </span>
								{!! @$business->desc_2 !!}
                            </div>
							
							<div class="col-md-12 pt-80">
								<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-hide-page-scrollbars="false">
								    <div class="slides"></div>
								    <h3 class="title"></h3>
								    <a class="prev">‹</a>
								    <a class="next">›</a>
								    <a class="play-pause"></a>
								    <ol class="indicator"></ol>
								</div>
								<div id="links">
									@php
										$images = @$business->images ? $business->images : array(); 
									@endphp
								    @foreach (@$images as $image)
								    	<a href="https://www.profidelta.com.hk/data/tbl_opportunities_photo/org/{{ @$image->photo_1 }}" title="{{ @$business->intro_2 }}" data-gallery>
									    	<img style="margin: 10px; border: 1px solid; padding: 10px; box-shadow: 0 10px 13px 0 rgba(0, 0, 0, 0.28);" src="https://www.profidelta.com.hk/data/tbl_opportunities_photo/thu_crop/{{ @$image->photo_1 }}" alt="">
									    </a>
								    @endforeach
								</div>
                            </div>

                            <div class="col-md-12 pt-100 pb-30 text-center">
                            	<div class="button-back">
                            		<a style="background: rgb(140, 140, 140);color: #fff;" href="{{ URL::previous() }}" class="btn-default btn btn-business">
                            			{{ trans('fe_business.button_back') }}  <i class="fa fa-repeat"></i>
                            		</a>
                            		<a style="background: rgb(250, 142, 22);" href="{{ route('fe.buy', ['business' => @$business->id ]) }}" class="btn-success btn btn-business">
                            			{{ trans('fe_business.button_send') }}  <i class="fa fa-caret-right"></i>
                            		</a>
                            	</div>
                            </div>
                            </div>
                        </div>
	                </div>
	                <div class="col-md-4 col-sm-4" style="background: #fff;">
	                    <aside class="single-widget">
	                            <h4 class="widget-title">{{ trans('fe_business.hot_business') }}</h4>
	                            <div class="widget-content">
	                                <ul class="post-cat-list">
	                                    @foreach ($businessHots as $key => $businessHot)
	                                    <li>
	                                        <a href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}">
	                                            <i class="fa fa-angle-double-right"> </i> {{ $businessHot->intro_2 }}</a>
	                                    </li>
	                                    @endforeach 
	                                </ul>
	                            </div>
	                    </aside>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
	<script>
		document.getElementById('links').onclick = function (event) {
		    event = event || window.event;
		    var target = event.target || event.srcElement,
		        link = target.src ? target.parentNode : target,
		        options = {index: link, event: event},
		        links = this.getElementsByTagName('a');
		    blueimp.Gallery(links, options);
		};
	</script>
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name="description" content="{{ @$business->title }}">
	<meta name="keywords" content="{{ @$business->title }}" />
@endsection
@section ('title', @$business->meta_title)