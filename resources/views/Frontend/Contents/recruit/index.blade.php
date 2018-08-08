@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$business = app('Buy')->getBusiness(App\Libs\Configs\KeyConfig::CONST_SELL_CRITERIA);
		$seo      = app('AboutUs')->getSeo();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>購入業務流程</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-12 col-sm-12">
	                    <div class="service-item">
	                    	<table class="col-md-12">
	                    		<tbody>
	                    			@foreach ($recruits as $key => $recruit)
										<tr>
											<td class="col-md-7">
												<a href="{{ route('fe.recruit_detail', [@$recruit->id, @$recruit->slug]) }}"> {!! @$recruit->title !!} </a>
											</td>
											<td class="text-center col-md-5">
												<p> {!! @$recruit->end_date !!} </p>
											</td>
										</tr>
	                    			@endforeach
	                    		</tbody>
	                    	</table>
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
	<meta name="description" content="{!! @$seo->data->description !!}">
	<meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)