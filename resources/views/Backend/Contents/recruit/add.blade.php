@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.recruit.lable') !!}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">
				{{ isset($recruit) ? trans('backend.recruit.update') : trans('backend.recruit.create')  }}
				</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            @if (!isset($recruit)) 
						<form action="{{ route('recruits.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
							@method ('POST')
		            @else
						<form action="{{ route('recruits.update', @$recruit->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" data-parsley-form>
						@method ('PUT')	
		            @endif
			            	@csrf
		                    <div class="col-sm-12">
		                    	<div class="panel">
			                    	<div class="panel-body">
					                    <div class="row">
					                        <div class="col-sm-10">
					                            <div class="form-group">
					                                <label class="control-label">
					                                	{!! trans('backend.recruit.title') !!} <span class="text-danger"> (*)</span>
					                                </label>
					                                <input type="text" name="title" class="form-control" value="{{ @$recruit->title }}" required>
					                                @if ($errors->has('title'))
						                            	<p class="text-left text-danger">{{ $errors->first('title') }}</p>
						                            @endif
					                            </div>
					                        </div> 			
	            	                        <div class="col-sm-10">
	            	                        	<div class="form-group">
	                	                            <label class="control-label">
	                	                            	{!! trans('backend.recruit.end_date') !!}<span class="text-danger"> (*)</span>
	                	                            </label>
	                                                <div class="input-group date">
					                                    <input type="text" class="form-control" name="end_date" value="{{ @$recruit->end_date }}" required>
					                                    <span class="input-group-addon"><i class="demo-pli-calendar-4"></i></span>
					                                </div>
	                                                @if ($errors->has('end_date'))
	                	                            	<p class="text-left text-danger">{{ $errors->first('end_date') }}</p>
	                	                            @endif
	                	                        </div>
	            	                        </div>
	            	                        <div class="col-sm-10">
	            	                        	<div class="form-group">
	                	                            <label class="control-label">
	                	                            	{!! trans('backend.recruit.content') !!}<span class="text-danger"> (*)</span>
	                	                            </label>
                                                    <textarea class="my-ckeditor" name="content" name="content">
                                                    	{{ @$recruit->content }}
                                                	</textarea>
	                                                @if ($errors->has('content'))
	                	                            	<p class="text-left text-danger">{{ $errors->first('content') }}</p>
	                	                            @endif
	                	                        </div>
	            	                        </div>		                
					                    </div>
				                    </div>
		                    	</div>
			                 </div>
		                    <button class="btn btn-primary btn-icon btn-form-submit">
		                    	<i class="fa fa-save icon-lg"></i>
		                    </button>
				   		</form>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script>
		$('.input-group.date').datepicker(
			{autoclose:true,
			format: 'yyyy-mm-dd' }
			);
	</script>
@endsection

@section ('myCss')
	
@endsection

