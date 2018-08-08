@extends('Frontend.Layouts.default')

@section ('content')
	<div class="content-section ptb-50 gray-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	                <div class="main-heading-content text-center">
	                    <h2>購入業務流程</h2>
	                </div>
	            </div>
	        </div>
	        <div>
	        	<div class="dock-container text-center">
	        		@foreach ($categories->data as $category) 
        				<li class="dock-item" data-item="{{ $category->id }}">
        					<img style="width: 100%;" src="{{ $category->icon }}" alt="{{ $category->title }}">
        				</li> 
        			@endforeach
        	    </div>
	        </div>

    	    <div class="row mt-50 list-item-franchise">
    	    	@foreach ($categories->data as $category)
		    		<div class="col-md-12 col-sm-12 item-franchise" id="list-category-{{ $category->id }}">
			    		@foreach ($category->franchises as $franchise)
				    		<div class="col-md-4 col-sm-6 " >
			                    <div class="single-blog-post">
			                        <div class="blog-thumb">
			                            <a href="{{ route('fe.franchise_detail', [$franchise->id, $franchise->slug]) }}">
			                            	<img style="width: 100%;" class="img-responsive" src="{{ $franchise->image }}" alt="">
			                            </a>
			                        </div>
			                        <div class="blog-text">
			                            <h3 class="text-center"><a href="{{ route('fe.franchise_detail', [$franchise->id, $franchise->slug]) }}">{{ $franchise->title }}</a></h3>
			                            <p class="text-danger text-bold text-center"> {{ trans('fe_franchise.initial_fee') }}: {{ $franchise->price }}</p>
			                            <br>
			                            <p>{{ $franchise->description }}</p>
			                            <br>
			                            <!-- <a href="{{ route('fe.franchise_detail', [$franchise->id, $franchise->slug]) }}" class="readmore">Read More <i class="fa fa-long-arrow-right"></i></a> -->
			                        </div>
			                    </div>
			                </div> 
			    		@endforeach
		    		</div>
	            @endforeach

    	    </div>
	    </div>
	</div>
@endsection 

@section ('myJs')
<!-- 	<script src="{{ url('angularJs/uses/Frontend/ctrls/franchiseCtrl.js') }}"></script>
	<script src="{{ url('angularJs/uses/Frontend/factory/services/franchiseService.js') }}"></script> -->
	<script>
		$(document).ready(function (){
			var maxHeight = 0;
			$('.single-blog-post').each(function () {
				console.log($(this).height())
				if (maxHeight < $(this).height()) {
					maxHeight = $(this).height();
				}
			});
			console.log(maxHeight);
			$('.single-blog-post').height(maxHeight);



			function loadListItem(categoryId) {
				$('.list-item-franchise .item-franchise').css('display', 'none');
				$('#list-category-'+ categoryId).css('display', 'block');
			}

			$('.dock-item').click(function () {
				categoryId = $(this).data('item');
				loadListItem(categoryId);
			});

			loadListItem('{{ $categories->data[0]->id }}');



		})


	</script>
@endsection
@section ('myCss')
@endsection
@section ('meta')
	<meta name=description content="{{ @$business->meta_description }}">
	<meta name="keywords" content="{{ @$business->meta_name }}" />
@endsection
@section ('title', @$business->meta_title)