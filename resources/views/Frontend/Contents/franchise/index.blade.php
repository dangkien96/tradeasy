@extends('Frontend.Layouts.default')

@section ('content')
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>{{ trans('fe_business.franchise') }}</h2>
	                </div>
	            </div>
	        </div>
	        <div>
	        	<div class="dock-container text-center">
    				<li class="dock-item active" data-item="1">
			        	<img src="{{ url('Frontend/img/team') }}/1.png" alt="嬰幼兒" />
			        </li>
					<li class="dock-item" data-item="2">
						<img  src="{{ url('Frontend/img/team') }}/2.png" alt="全部" />
					</li> 
			        <li class="dock-item" data-item="3">
			        	<img  src="{{ url('Frontend/img/team') }}/3.png" alt="飲食業" />
			        </li> 
			        <li class="dock-item" data-item="4">
			        	<img src="{{ url('Frontend/img/team') }}/4.png" alt="教育業" />
			        </li> 
			        <li class="dock-item" data-item="5">
			        	<img src="{{ url('Frontend/img/team') }}/5.png" alt="藝術與音樂" />
			        </li> 
			        <li class="dock-item" data-item="6">
			        	<img src="{{ url('Frontend/img/team') }}/6.png" alt="零售業" />
			        </li> 
			        <li class="dock-item" data-item="7">
			        	<img src="{{ url('Frontend/img/team') }}/7.png" alt="服務業" />
			        </li> 
			        
        	    </div>
	        </div>

    	    <div class="row mt-50 list-item-franchise">

	    		<div class="col-md-12 col-sm-12 item-franchise" id="list-category-1">
	    			@php
						$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises1   = $franchisesApp->getFranchises(75, "", "");
	    			@endphp

	    			@foreach ($franchises1 as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>			


	    		<div class="col-md-12 col-sm-12 item-franchise" id="list-category-2">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises2 = $franchisesApp->getFranchises("", 77, "");
	    			@endphp
	    			@foreach ($franchises2 as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>

				<div class="col-md-12 col-sm-12 item-franchise" id="list-category-3">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises3 = $franchisesApp->getFranchises("", 78, 78);
	    			@endphp
	    			@foreach ($franchises3 as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>

				<div class="col-md-12 col-sm-12 item-franchise" id="list-category-4">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises = app('Home')->getFranchises("", 79, 79);
	    			@endphp
	    			@foreach ($franchises as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>

	    		<div class="col-md-12 col-sm-12 item-franchise" id="list-category-5">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises = $franchisesApp->getFranchises("", 80, "");
	    			@endphp
	    			@foreach ($franchises as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>
				
				<div class="col-md-12 col-sm-12 item-franchise" id="list-category-6">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises = $franchisesApp->getFranchises("", 81, 81);
	    			@endphp
	    			@foreach ($franchises as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>

	    		<div class="col-md-12 col-sm-12 item-franchise" id="list-category-7">
	    			@php
	    				$franchisesApp = new App\Libs\Providers\HomeProvider();
						$franchises = $franchisesApp->getFranchises("", 82, 82);
	    			@endphp
	    			@foreach ($franchises as $value)
		    		<div class="col-md-4 col-sm-6">
	                    <div class="single-blog-post">
	                        <div class="blog-thumb">
	                            <a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">
	                            	<img style="width: 100%;" class="img-responsive" src="{{ @$value->photo_2 }}" alt="">
	                            </a>
	                        </div>
	                        <div class="blog-text">
	                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [@$value->id, @$value->code]) }}">{{ @$value->intro_2 }}</a></h3>
	                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ @$value->franchise_user ? : "N/A" }}</p>
	                            <br>
	                            <p>{{ @$value->teacher_introduction }}</p>
	                            <br>
	                        </div>
	                    </div>
	                </div> 
	                @endforeach
	    		</div>

    	    </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
	<script>
		$(document).ready(function (){
			var maxHeight = 0;
			$('.blog-text').each(function () {
				if (maxHeight < $(this).height()) {
					maxHeight = $(this).height();
				}
			});
			$('.blog-text').height(maxHeight);


			function loadListItem(categoryId) {
				$('.list-item-franchise .item-franchise').css('display', 'none');
				$('#list-category-'+ categoryId).css('display', 'block');
			}

			$('.dock-item').click(function () {
				categoryId = $(this).data('item');
				$('.dock-item').removeClass('active');
				$(this).addClass('active');

				loadListItem(categoryId);
			});

			loadListItem('1');



		})


	</script>
@endsection
@section ('myCss')
	<style>
		.single-blog-post img {
            height: 162px;
		}
	</style>
@endsection
@section ('meta')
	<meta name="description" content="{{ @$business->meta_description }}">
	<meta name="keywords" content="{{ @$business->meta_name }}" />
@endsection
@section ('title', @$business->meta_title)