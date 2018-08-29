@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$rectuits = app('Home')->getRecruit();
		$seo      = app('AboutUs')->getSeo();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{{ @$recruit->title }}</h2>
	                    <p>{{ trans('fe_recruit.end_date') }}: {{ @$recruit->end_date }}</p>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-8 col-sm-8">
	                    <div class="service-item">
	                    	{!! @$recruit->content !!}
	                    	<div class="pull-right">
	                    		<a href="{{ route('fe.recruits') }}" type="text" class="btn btn-default">
	                    			 {{ trans('fe_business.button_back') }} <i class="fa fa-arrow-right"></i>
	                    		</a>
	                    	</div>
	                    </div>
	                </div>
	                <div class="col-md-4 col-sm-4" style="background: #fff;">
	                	<aside class="single-widget">
	                	        <h4 class="widget-title">{{ trans('fe_business.hot_business') }}</h4>
	                	        <div class="widget-content">
	                	            <ul class="post-cat-list">
	                	                @foreach ($rectuits as $key => $value)
	                	                <li>
	                	                    <a href="{{ route('fe.recruit_detail', [@$value->id, @$value->slug]) }}">
	                	                        <i class="fa fa-angle-double-right"> </i> {!! @$value->title !!}</a>
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
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name="description" content="{!! @$seo->data->description !!}">
	<meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)