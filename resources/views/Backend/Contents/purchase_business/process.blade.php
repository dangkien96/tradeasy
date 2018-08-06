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
                    	<input type="hidden" name="key" value="{{ App\Libs\Configs\KeyConfig::CONST_BUY_PROCESS }}">
                        <div class="form-group">

                        	<div class="form-group">
                                <label class="control-label">
                                	Content Website <span class="text-danger"> (*)</span>
                                </label>
                                <textarea class="my-ckeditor" name="data">{!! @$buy_process->data ? $buy_process->data : @old('meta_title') !!}</textarea>
                                @if ($errors->has('data'))
	                            	<p class="text-left text-danger">{{ $errors->first('data') }}</p>
	                            @endif
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									Meta title
                                </label>
                                <input type="text" name="meta_title" class="form-control" value="{{ @$buy_process->meta_title ? $buy_process->meta_title: @old('meta_title') }}" placeholder="Meta title">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
									Meta name
                                </label>
                                <input type="text" name="meta_name" class="form-control" value="{{ @$buy_process->meta_name ? $buy_process->meta_name: @old('meta_name') }}" placeholder="Meta name">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta description</label>
                                <textarea placeholder="Meta description" rows="5" class="form-control" name="meta_description">{!! @$buy_process->meta_description ? $buy_process->meta_description: @old('meta_description') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Meta tag</label>
                                <textarea placeholder="Meta tag" rows="5" class="form-control" name="meta_tag">{!! @$buy_process->meta_tag ? $buy_process->meta_tag : @old('meta_tag') !!}</textarea>
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
