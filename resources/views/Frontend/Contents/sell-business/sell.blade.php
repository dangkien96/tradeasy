@extends('Frontend.Layouts.default')

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
	                    <h2>{!! trans('fe_business.sell_business') !!}</h2>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="service-wrapper">
	            	<div class="panel">
	            		<div class="panel-body">
			            	<form action="{{ route('fe.post_sell_business') }}" method="POST">
			            		@csrf
				                <div class="col-md-12 col-sm-12">
		                           <div class="col-md-6">
		                           		<input class="form-control" name="name" type="text" placeholder="姓名*"
		                           		value="{{ old('name') }}">
	                                	@if ($errors->has('name'))
			                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
			                            @endif
		                           		<input class="form-control" name="phone" type="text" placeholder="電話*" 
		                           		value="{{ old('phone') }}">
		                           		@if ($errors->has('phone'))
			                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
			                            @endif
		                           		<input class="form-control" name="email" type="text" placeholder="電郵*"
		                           		value="{{ old('email') }}">
		                           		@if ($errors->has('email'))
			                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
			                            @endif
		                           		<select class="form-control" name="industry">
		                           			<option value="">行業</option>
		                           			@foreach ($natures as $nature)
		                           				<option @if ($nature->id == old('industry')) selected @endif value="{!! $nature->id !!}">{!! $nature->name_2 !!}</option>
		                           			@endforeach
		                           		</select>
	                                	@if ($errors->has('industry'))
			                            	<p class="text-left text-danger">{{ $errors->first('industry') }}</p>
			                            @endif
		                           		<input class="form-control" name="profit" type="text" placeholder="參考利潤*"
		                           		value="{{ old('profit') }}">
		                           		@if ($errors->has('profit'))
			                            	<p class="text-left text-danger">{{ $errors->first('profit') }}</p>
			                            @endif
		                            </div>
		                            <div class="col-md-6">
		                            	<input class="form-control" name="investment" type="text" placeholder="金額*" value="{{ old('investment') }}">
		                            	@if ($errors->has('investment'))
			                            	<p class="text-left text-danger">{{ $errors->first('investment') }}</p>
			                            @endif
		                            	<textarea class="text-area form-control" name="message" cols="30" rows="1" placeholder="備註*">{{ old('message') }}</textarea>
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
	@if (Session::has('sell-business') && Session::get('sell-business') == 'success')
		<script>
			swal({
			  type: 'success',
			  title: 'Success',
			  text: 'Something went success!',
			  timer: 2000
			})
		</script>
		
	@endif
	<script>
	    $(document).ready(function () {
	    	var moneyCode = function ($input) {
	    		$input.on('keyup', function () {
			    	var selection = window.getSelection().toString();
				    if ( selection !== '' ) {
				        return;
				    }
				    var $this = $( this );
				    var input = $this.val();	            
				    var input = input.replace(/[\D\s\._\-]+/g, "");
				        input = input ? parseInt( input, 10 ) : 0;
				        $this.val( function() {
				            return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
				        } );
	    		});
	    	}
	    	// moneyCode($('input[name*="investment"]'));
	    	// moneyCode($('input[name*="profit"]'));
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