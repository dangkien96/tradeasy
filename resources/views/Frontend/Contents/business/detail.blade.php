@extends('Frontend.Layouts.default')

@section ('content')
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{!! trans('title.detailBusiness') !!}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-8 col-sm-12 service-item">
                        <div class="service-text">
                            <div class="col-md-6">
                            	<p><span>代號：</span> {{ @$business->code }}</p>
                            	<p><span>頂手費:</span> HKD {{ number_format(@$business->investment, 0,",","," ) }}</p>
                            	<p><span>參考利潤：</span> HKD90,000</p>
                            	<p><span>回本期:</span> {{ @$business->payback_period }}</p>
                            	<p><span>每月租金：</span> HKD47,500</p>
                            </div>
                            <div class="col-md-6">
                            	<p><span>地區：</span> {{ @$business->natures->name_2 }} </p>
                            	<p><span>行業：</span> {{ @$business->locations->name_2 }} </p>
                            	<p><span>營業額：</span> {{ @$business->Revenue }} </p>
                            	<p><span>面積：</span> {{ @$business->Premise_Size }}</p>
                            </div>
                            <div class="col-md-12 pt-50">
                            	<span>備注：</span>
								{!! @$business->desc_2 !!}
                            </div>
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name=description content="{{ @$business->meta_description }}">
	<meta name="keywords" content="{{ @$business->meta_name }}" />
@endsection
@section ('title', @$business->meta_title)