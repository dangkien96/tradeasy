@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-content">
		    <div class="panel">
		        <div class="panel-body">
                    <form action="{{ route('buy_process.update') }}" method="POST">
                    	@method('POST')
                    	@csrf()
                    	<input type="hidden" name="key" value="{{ App\Libs\Configs\KeyConfig::CONST_BUY_QA }}">
                        <div class="form-group">

                        	<div class="form-group">
                                <label class="control-label">
                                	{!! trans('backend.buy_business.buy_content') !!}<span class="text-danger"> (*)</span>
                                </label>
                                <textarea class="my-ckeditor" name="data">{!! @$buy_qa->data ? $buy_qa->data : @old('meta_title') !!}</textarea>
                                @if ($errors->has('data'))
	                            	<p class="text-left text-danger">{{ $errors->first('data') }}</p>
	                            @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									{!! trans('backend.buy_business.meta_title') !!}
                                </label>
                                <input type="text" name="meta_title" class="form-control" value="{{ @$buy_qa->meta_title ? $buy_qa->meta_title: @old('meta_title') }}" placeholder="Meta title">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									{!! trans('backend.buy_business.meta_keyword') !!}
                                </label>
                                <input type="text" name="meta_name" class="form-control" value="{{ @$buy_qa->meta_name ? $buy_qa->meta_name: @old('meta_name') }}" placeholder="Meta name">
                            </div>

                            <div class="form-group">
                                <label class="control-label">{!! trans('backend.buy_business.meta_description') !!}</label>
                                <textarea placeholder="Meta description" rows="5" class="form-control" name="meta_description">{!! @$buy_qa->meta_description ? $buy_qa->meta_description: @old('meta_description') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">{!! trans('backend.buy_business.meta_tag') !!}</label>
                                <textarea placeholder="Meta tag" rows="5" class="form-control" name="meta_tag">{!! @$buy_qa->meta_tag ? $buy_qa->meta_tag : @old('meta_tag') !!}</textarea>
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
