@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$start_up = app('Buy')->getBusiness(App\Libs\Configs\KeyConfig::CONST_START_UP);
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{{ trans('fe_business.start_up') }}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-8 col-sm-8">
	                    <div class="service-item">
	                        <div class="service-text">
	                            {!! @$start_up->data !!}
	                        </div>
	                    </div>
	                </div>
	                @includeif ('Frontend.Layouts._hot_business')
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
	<meta name="description" content="{{ @$start_up->meta_description }}">
	<meta name="keywords" content="{{ @$start_up->meta_name }}" />
@endsection
@section ('title', @$start_up->meta_title)