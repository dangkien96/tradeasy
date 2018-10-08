@extends('Frontend.Layouts.default')
@section ('title', trans('fe_menu.about_us') )
@section ('content')
	@php
		$about_us     = app('AboutUs')->aboutUs();
		$businessHots = app('Home')->getBusinessHot();
		$seo          = app('AboutUs')->getSeo();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{!! trans('fe_menu.about_us') !!}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
                <div class="col-md-8 col-sm-8">
                	<div class="service-wrapper">
	                    <div class="service-item">
	                        <div class="service-text">
	                            {!! @$about_us->data->content !!}
	                        </div>
	                    </div>
	                </div>
	            </div>
                @includeif ('Frontend.Layouts._hot_business')
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