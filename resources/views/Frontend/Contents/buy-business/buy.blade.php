@extends('Frontend.Layouts.default')
@section ('title', trans('fe_business.register_business'))
@section ('content')
	@php
		$locations = app('Location')->getLocaiton();
		$natures   = app('Location')->getNatrue();
		$seo       = app('AboutUs')->getSeo();
	@endphp
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{!! trans('fe_business.register_business') !!}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	            	<div class="panel">
	            		<div class="panel-body">
			            	<form action="{{ route('fe.buy-business') }}" method="POST">
			            		@csrf
				                <div class="col-md-12 col-sm-12">
		                           <div class="col-md-6">
		                           		@if (isset($business)) 
											<p>
												<input class="form-control" name="business_code" type="hidden" value="{{ @$business->code }}">
												<input class="form-control" name="business_id" type="hidden" value="{{ @$business->id }}">
												<label>
													<span class="text-bold"> {{ trans('fe_business.code') }}</span>:  {{ @$business->code }}
												</label>
												<br>
											</p>
		                           		@endif
		                           		<input class="form-control" name="name" type="text" placeholder="{!! trans('fe_business.name') !!}*" 
		                           		value="{{ old('name') }}">
   		                                @if ($errors->has('name'))
   			                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
   			                            @endif
		                           		<input class="form-control" name="phone" type="text" placeholder="{!! trans('fe_business.phone') !!}*" 
		                           		value="{{ old('phone') }}">
		                           		@if ($errors->has('phone'))
   			                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
   			                            @endif
		                           		<input class="form-control" name="email" type="text" placeholder="{!! trans('fe_business.email') !!}*" 
		                           		value="{{ old('email') }}">
		                           		@if ($errors->has('email'))
   			                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
   			                            @endif
		                           		<select id="demo-select2-placeholder" class="form-control" name="location_name">
		                           			<option value="0">{!! trans('fe_business.select_location') !!}</option>
		                           			@foreach ($locations as $location)
		                           				<option @if ($location->id == old('location_name')) selected @endif value="{!! $location->id !!}">{!! $location->name_2 !!}</option>
		                           			@endforeach
			                            </select>
			                            @if ($errors->has('location_name'))
   			                            	<p class="text-left text-danger">{{ $errors->first('location_name') }}</p>
   			                            @endif
		                           		<select class="form-control" name="industry" >
		                           			<option value="0">{!! trans('fe_business.select_industry') !!}</option>
		                           			@foreach ($natures as $nature)
		                           				<option @if ($nature->id == old('industry')) selected @endif value="{!! $nature->id !!}">{!! $nature->name_2 !!}</option>
		                           			@endforeach
		                           		</select>
		                           		@if ($errors->has('industry'))
   			                            	<p class="text-left text-danger">{{ $errors->first('industry') }}</p>
   			                            @endif
		                            </div>
		                            <div class="col-md-6">
		                            	@if (isset($business->code)) 
											<p>
		                           				<label>
		                           					<input class="form-control" name="business_name" type="hidden" value="{{ @$business->intro_2 }}">
			                           				<span class="text-bold"> {{ trans('fe_business.title') }}</span>:  {{ @$business->intro_2 }}
			                           			</label>
			                           			<br>
											</p>
		                           		@endif
		                            	
		                            	<input class="form-control" name="investment" type="text" placeholder="{!! trans('fe_business.investment') !!}*" value="{{ old('investment') }}" >
		                            	@if ($errors->has('investment'))
   			                            	<p class="text-left text-danger">{{ $errors->first('investment') }}</p>
   			                            @endif
		                            	<textarea class="text-area" name="message" placeholder="{!! trans('fe_business.message') !!}*" style="height: 133px;">{{ old('message') }}</textarea>
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
				                </div>
								<div class="col-md-12 pb-10">
									<button style="margin-left: 10px; background: rgb(140, 140, 140); border-color: rgb(140, 140, 140)" class="button comment-cntact active pull-right" type="reset">{!! trans('fe_business.reset') !!}</button>
									<button class="button comment-cntact active pull-right" type="submit">{!! trans('fe_business.send') !!}</button>
									<p class="bigtech-send-message"></p>
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
	@if (Session::has('buy-business') && Session::get('buy-business') == 'success')
		<script>
			swal({
			  type: 'success',
			  title: "{!! trans('fe_business.success_title') !!}",
			  text: '{!! trans("fe_business.success") !!}',
			})
		</script>
		
	@endif
	<script>
	    $(document).ready(function () {
	        // $('input[name*="investment"]').on('keyup', function () {
	        // 	var selection = window.getSelection().toString();
        	//     if ( selection !== '' ) {
        	//         return;
        	//     }
        	//     var $this = $( this );
        	//     var input = $this.val();	            
        	//     var input = input.replace(/[\D\s\._\-]+/g, "");
        	//         input = input ? parseInt( input, 10 ) : 0;
        	//         $this.val( function() {
        	//             return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
        	//         } );
	        // });
	    })
	</script>
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name="description" content="{!! @$seo->data->description !!}">
	<meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)