@extends('Frontend.Layouts.default')

@section ('content')
	@php
		$locations = app('Location')->getLocaiton();
		$natures   = app('Location')->getNatrue();
		$contact   = app('AboutUs')->getContact();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>Profi Delta Consultancy Limited 普斯匯達顧問有限公司</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	            	<div class="panel">
	            		<div class="panel-body">
			            	<form action="{{ route('fe.post_contact') }}" method="POST" autocomplete="off">
			            		@csrf
				                <div class="col-md-12 col-sm-12">
		                           <div class="col-md-6">
		                           		<input class="form-control" name="name" type="text" placeholder="{!! trans('fe_contact.name') !!}*"
		                           		value="{{ old('name') }}">
	                                	@if ($errors->has('name'))
			                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
			                            @endif
		                           		<input class="form-control" name="phone" type="text" placeholder="{!! trans('fe_contact.phone') !!}*" 
		                           		value="{{ old('phone') }}">
		                           		@if ($errors->has('phone'))
			                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
			                            @endif
		                           		<input class="form-control" name="email" type="text" placeholder="{!! trans('fe_contact.email') !!}*"
		                           		value="{{ old('email') }}">
		                           		@if ($errors->has('email'))
			                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
			                            @endif
		                            	<textarea class="text-area form-control" name="message" cols="30" rows="1" placeholder="{!! trans('fe_contact.message') !!}*">{{ old('message') }}</textarea>
		                            	<p>
		                            	@php
											echo captcha_img();
		                            	@endphp
		                            	</p>
		                            	<input class="form-control" name="captcha" type="text" placeholder="{!! trans('fe_contact.captcha') !!}">
		                            	@if ($errors->has('captcha'))
   			                            	<p class="text-left text-danger">{{ $errors->first('captcha') }}</p>
   			                            @endif
   			                            <div class="row">
   			                            	<div class="col-md-12 text-center">
   			                            		<button class="button comment-cntact active" type="submit">SEND</button>
   			                            			<p class="bigtech-send-message"></p>
   			                            	</div>
   			                            </div>
		                            </div>
		                            <div class="col-md-6">
		                            	<div class="address">
        	                                <div class="address-item">
        	                                    <div class="address-icon">
        	                                        <i class="fa fa-map-marker"></i>
        	                                    </div>
        	                                    <div class="address-content">
        	                                        <h3>{!! trans('fe_contact.address') !!}</h3>
        	                                        <p>{{ @$contact->data->address }}</p>
        	                                    </div>
        	                                </div>
        	                                <div class="address-item">
        	                                    <div class="address-icon">
        	                                        <i class="fa fa-phone"></i>
        	                                    </div>
        	                                    <div class="address-content">
        	                                        <h3>{!! trans('fe_contact.phone') !!}</h3>
        	                                        <p>{{ @$contact->data->phone }}</p>
        	                                    </div>
        	                                </div>
        	                                <div class="address-item">
        	                                    <div class="address-icon">
        	                                        <i class="fa fa-phone"></i>
        	                                    </div>
        	                                    <div class="address-content">
        	                                        <h3>{!! trans('fe_contact.fax') !!}</h3>
        	                                        <p>{{ @$contact->data->fax }}</p>
        	                                    </div>
        	                                </div>
        	                                <div class="address-item">
        	                                    <div class="address-icon">
        	                                        <i class="fa fa-envelope"></i>
        	                                    </div>
        	                                    <div class="address-content">
        	                                        <h3>{!! trans('fe_contact.email') !!}</h3>
        	                                        <p>{{ @$contact->data->email }}</p>
        	                                    </div>
        	                                </div>
        	                                <div class="address-item">
        	                                    <div class="address-icon">
        	                                        <i class="fa fa-phone"></i>
        	                                    </div>
        	                                    <div class="address-content">
        	                                        <h3>{!! trans('fe_contact.website') !!}</h3>
        	                                        <p>{{ @$contact->data->website }}</p>
        	                                    </div>
        	                                </div>
        	                            </div>
		                            </div>
				                </div>
			                </form>
			                <div class="row map-gg" >
			                	{!! @$contact->data->iframe !!}
			                </div>
	            		</div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
	@if (Session::has('contact') && Session::get('contact') == 'success')
		<script>
			swal({
			  type: 'success',
			  title: 'Success',
			  text: 'Something went success!',
			  timer: 2000
			})
		</script>
	@endif
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name=description content="{{ @$business->meta_description }}">
	<meta name="keywords" content="{{ @$business->meta_name }}" />
@endsection
@section ('title', @$business->meta_title)