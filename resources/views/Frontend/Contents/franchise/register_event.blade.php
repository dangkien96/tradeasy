@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$contact   = app('AboutUs')->getContact();
		$rule = app('Home')->getRule();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2> {{ trans('fe_event_online.event_online') }} </h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	            	<div class="panel">
	            		<div class="panel-body">
			            	<form action="{{ route('fe.post_event_online') }}" method="POST" autocomplete="off">
			            		@csrf
				                <div class="col-md-12 col-sm-12">
		                            <div class="col-md-6">
		                            	<input type="hidden" value="{{ request()->get('franchise_id') }}" name="franchise_id">
		                            	<input type="hidden" value="{{ request()->get('franchise_name') }}" name="franchise_name" >
		                           		<input class="form-control" name="name" type="text" placeholder="{{ trans('fe_event_online.name') }}*"
		                           		value="{{ old('name') }}">
	                                	@if ($errors->has('name'))
			                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
			                            @endif
		                           		<input class="form-control" name="phone" type="text" placeholder="{{ trans('fe_event_online.phone') }}*" 
		                           		value="{{ old('phone') }}">
		                           		@if ($errors->has('phone'))
			                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
			                            @endif
		                           		<input class="form-control" name="email" type="text" placeholder="{{ trans('fe_event_online.email') }}*"
		                           		value="{{ old('email') }}">
		                           		@if ($errors->has('email'))
			                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
			                            @endif
			                            <input class="form-control" name="number" type="text" placeholder="{{ trans('fe_event_online.number') }}*"
		                           		value="{{ old('number') }}">
		                           		@if ($errors->has('number'))
			                            	<p class="text-left text-danger">{{ $errors->first('number') }}</p>
			                            @endif
			                            <p>
		                            	@php
											echo captcha_img();
		                            	@endphp
		                            	</p>
		                            	<input class="form-control" name="captcha" type="text" placeholder="{!! trans('fe_business.captcha') !!}">
		                            	@if ($errors->has('captcha'))
   			                            	<p class="text-left text-danger">{{ $errors->first('captcha') }}</p>
   			                            @endif
		                            </div>
		                            <div class="col-md-6">
		                            	<div class="rule">
		                            		<div class="rule-content">
		                            			{!! @$rule->data->content !!}
		                            		</div>
		                            	</div>

		                            	<p class="pt-20">
		                            		<input  type="checkbox" name="check_rule" checked /> 
		                            		<span style="margin-left: 15px"> {!! trans('fe_event_online.rule') !!}</span>
		                            	</p>
   			                            <div class="row">
   			                            	<div class="col-md-12 text-center">
   			                            		<button class="button comment-cntact active" type="submit">{!! trans('fe_business.send') !!}</button>
   			                            			<p class="bigtech-send-message"></p>
   			                            	</div>
   			                            </div>
		                            </div>
				                </div>
			                </form>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
	@if (Session::has('event') && Session::get('event') == 'success')
		<script>
			swal({
			  type: 'success',
			  title: 'Success',
			  text: trans('fe_business.success'),
			})
		</script>
	@endif
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name="description" content="{{ @$business->meta_description }}">
	<meta name="keywords" content="{{ @$business->meta_name }}" />
@endsection
@section ('title', @$business->meta_title)