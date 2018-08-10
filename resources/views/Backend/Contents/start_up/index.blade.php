@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-content">
		    <div class="panel">
		        <div class="panel-body">
                    <form action="{{ route('start_up.update') }}" method="POST">
                    	@method('POST')
                    	@csrf()
                    	<input type="hidden" name="key" value="{{ App\Libs\Configs\KeyConfig::CONST_START_UP }}">
                        <div class="form-group">

                        	<div class="form-group">
                                <label class="control-label">
                                	{!! trans('backend.start_up.content') !!} <span class="text-danger"> (*)</span>
                                </label>
                                <textarea class="my-ckeditor" name="data">{!! @$startup->data ? $startup->data : @old('meta_title') !!}</textarea>
                                @if ($errors->has('data'))
	                            	<p class="text-left text-danger">{{ $errors->first('data') }}</p>
	                            @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									{!! trans('backend.start_up.meta_title') !!}
                                </label>
                                <input type="text" name="{!! trans('backend.start_up.meta_title') !!}" class="form-control" value="{{ @$startup->meta_title ? $startup->meta_title: @old('meta_title') }}" placeholder="Meta title">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									{!! trans('backend.start_up.meta_name') !!}
                                </label>
                                <input type="text" name="{!! trans('backend.start_up.meta_name') !!}" class="form-control" value="{{ @$startup->meta_name ? $startup->meta_name: @old('meta_name') }}" placeholder="Meta name">
                            </div>

                            <div class="form-group">
                                <label class="control-label">{!! trans('backend.start_up.meta_description') !!}</label>
                                <textarea placeholder="{!! trans('backend.start_up.meta_description') !!}" rows="5" class="form-control" name="meta_description">{!! @$startup->meta_description ? $startup->meta_description: @old('meta_description') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">{!! trans('backend.start_up.meta_tag') !!}</label>
                                <textarea placeholder="{!! trans('backend.start_up.meta_tag') !!}" rows="5" class="form-control" name="meta_tag">{!! @$startup->meta_tag ? $startup->meta_tag : @old('meta_tag') !!}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-form-submit">
                        	<i class="fa fa-save"></i>
                        </button>
                    </form>
		        </div>
		    </div>
	    </div>
	</div>
@endsection
