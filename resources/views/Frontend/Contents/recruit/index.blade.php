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
	                    <h2>{{ trans('fe_recruit.title') }}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	                <div class="col-md-12 col-sm-12 pt-50 pb-20 plr-20" style="background: #fff;">
	                    	<table style="width: 100%;" class="col-md-12 ptb-30 table-hover table-striped">
	                    		<tbody>
	                    			@foreach ($recruits as $key => $recruit)
										<tr class="ptb-20">
											<td class="col-md-7 ptbl-10">
												<a href="{{ route('fe.recruit_detail', [@$recruit->id, @$recruit->slug]) }}"> {!! @$recruit->title !!} </a>
											</td>
											<td class="text-center col-md-5 ptb-10">
												<p> {!! @$recruit->end_date !!} </p>
											</td>
										</tr>
	                    			@endforeach
	                    		</tbody>
	                    	</table>
	                    <!-- </div> -->
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