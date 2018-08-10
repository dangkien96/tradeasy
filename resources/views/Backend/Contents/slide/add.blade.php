@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.slide.lable') !!}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">
				{{ isset($slide) ? trans('backend.actions.update') : trans('backend.actions.create') }}
				</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			            </div>
			            @if (!isset($slide)) 
							<form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
								@method ('POST')
			            @else
							<form action="{{ route('slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
								@method ('PUT')	
			            @endif
				            	@csrf
				                <div class="panel-body col-sm-offset-1">
				                    <div class="row">
				                        <div class="col-sm-10">
				                            <div class="form-group">
				                                <label class="control-label text-bold">
				                                	{!! trans('backend.slide.title') !!} <span class="text-danger"> (*)</span>
				                                </label>
				                                <input type="text" name="title" class="form-control" value="{{ @$slide->title ? $slide->title : @old('title') }}" required>
				                                @if ($errors->has('title'))
					                            	<p class="text-left text-danger">{{ $errors->first('title') }}</p>
					                            @endif
				                            </div>
				                        </div> 
						
				                        <div class="col-sm-10">
				                            <div class="form-group">
				                                <label class="control-label text-bold">
				                                	{!! trans('backend.slide.link') !!} <span class="text-danger"> (*)</span>
				                                </label>
				                                <input type="text" name="url_link" class="form-control" value="{{ @$slide->url_link ? $slide->url_link: @old('url_link') }}" required>
				                                @if ($errors->has('url_link'))
					                            	<p class="text-left text-danger">{{ $errors->first('url_link') }}</p>
					                            @endif
				                            </div>
				                        </div> 

				                        <div class="col-sm-10">
				                            <div class="form-group">
				                                <label class="control-label text-bold">
				                                	{!! trans('backend.slide.description') !!}
				                                </label>
				                                <textarea name="description" id="description">{!! @$slide->description ? $slide->description : @old('description') !!}</textarea>
				                                @if ($errors->has('url_link'))
					                            	<p class="text-left text-danger">{{ $errors->first('url_link') }}</p>
					                            @endif
				                            </div>
				                        </div> 

        		                        <div class="col-sm-10">
    			                            <div class="form-group">
    			                                <label class="control-label">
    			                                	{!! trans('backend.actions.sort_by') !!} <span class="text-danger"> (*)</span>
    			                                </label>

    			                                <select class="selectpicker" data-width="100%" name="sort_by">
    			                                    @foreach ($sort_bys as $sort_by) 
    													<option value="{{ @$sort_by->sort_by }}"
    														@if (@$slide->sort_by == $sort_by->sort_by) 
    															selected
    														@endif
    														> 
    														{{ $sort_by->sort_by }}
    													</option>
    			                                    @endforeach
    			                                    @if (!isset($slide))
    													<option selected value="{{ count($sort_bys) + 1  }}">
    														{{ count($sort_bys) + 1 }}
    													</option>
    			                                    @endif
    			                                </select>
    			                                @if ($errors->has('sort_by'))
    				                            	<p class="text-left text-danger">{{ $errors->first('sort_by') }}</p>
    				                            @endif
    			                            </div>
    			                        </div>	

    			                        <div class="col-sm-10">
				                            <div class="form-group">
				                                <label class="control-label text-bold">
				                                	{!! trans('backend.slide.image') !!} <span class="text-danger"> (*)</span>
				                                </label>
				                                 <div class="input-group">
													<span class="input-group-btn">
														<a data-input="thumbnail" data-preview="holder" class="btn btn-primary my-lfm" type="'image'">
															<i class="fa fa-picture-o"></i> {!! trans('backend.slide.image') !!}
														</a>
													</span>
													<input id="thumbnail" class="form-control" type="text" name="url_image" value="{{ @$slide->url_image ? $slide->url_image: @old('url_image') }}">
												</div>
												<img id="holder" 
													@if (@$slide->url_image || @old('url_image'))
	    			                            	 	src="{{ url('') }}/{{ @$slide->url_image ? $slide->url_image : @old('url_image') }}" 
													@endif style="margin-top:15px;max-height:100px;">
				                                @if ($errors->has('url_image'))
					                            	<p class="text-left text-danger">{{ $errors->first('url_image') }}</p>
					                            @endif
				                            </div>
				                        </div>

				                        <div class="col-sm-10"  style="margin-bottom: 15px;">
				                            <div class="form-group has-feedback">
					                            <label class="col-lg-3 control-label" style="padding-top: 10px;">{!! trans('backend.status.lable') !!}<span class="text-danger"> (*)</span></label>
					                            <div class="col-lg-7">
					                                <div class="radio">
					                                    <input id="demo-radio-7" class="magic-radio" type="radio" name="status" value="AVAILABLE" data-bv-field="member" 
														@if (@$slide->status == 'AVAILABLE' || @old('status') == 'AVAILABLE')
															{{ 'checked' }}
														@endif
					                                    checked>
					                                    <label for="demo-radio-7"> {!! trans('backend.status.available') !!}</label>
					
					                                    <input id="demo-radio-8" class="magic-radio" type="radio" name="status" value="DISABLE" data-bv-field="member"
					                                    @if (@$slide->status == 'DISABLE' || @old('status') == 'DISABLE')
															{{ 'checked' }}
														@endif>
					                                    <label for="demo-radio-8"> {!! trans('backend.status.disable') !!}</label>
					                                </div>
                                                    @if ($errors->has('status'))
                    	                            	<p class="text-left text-danger">{{ $errors->first('status') }}</p>
                    	                            @endif
					                        </div>
				                        </div>

				                    </div>
                                	<div class="row">
                                    	<button class="btn btn-primary btn-icon btn-form-submit">
                	                    	<i class="fa fa-save icon-lg"></i>
                	                    </button>
                                    </div>
				                </div>
					   		</form>
			        </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script>
		toolbar = [
               [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
               [ 'FontSize', 'TextColor', 'BGColor' ]
           ];
		CKEDITOR.replace('description', {toolbar: toolbar});
	</script>
@endsection

@section ('myCss')
	
@endsection

