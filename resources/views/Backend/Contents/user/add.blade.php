@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.users.lable') !!}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">{!! trans('backend.actions.create') !!}</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			               
			            </div>
			            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
			            	@csrf
			            	@method ('POST')
			                <div class="panel-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.users.name') !!}</label>
			                                <input type="text" name="name" class="form-control">
			                                @if ($errors->has('name'))
				                            	<p class="text-left text-danger">{{ $errors->first('name') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.users.phone') !!}</label>
			                                <input type="text" name="phone" class="form-control">
			                                @if ($errors->has('phone'))
				                            	<p class="text-left text-danger">{{ $errors->first('phone') }}</p>
				                            @endif
			                            </div>
			                        </div>

			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">{!! trans('backend.users.email') !!}</label>
			                                <input type="text" name="email" class="form-control">
			                                @if ($errors->has('email'))
				                            	<p class="text-left text-danger">{{ $errors->first('email') }}</p>
				                            @endif
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                               	<div>
			                               		<span class="btn btn-primary btn-file">{!! trans('backend.users.avatar') !!}... 
			                               			<input class="myRenderImage" type="file" name="avatar">
			                               		</span>
			                               		<div style="margin-top: 15px;">
			                               			<img id="blah" alt="true" src="{{ url('Nifty/img/profile-photos/1.png') }}" style="width: 140px; height: 150px;">
				                               	</div>
			                               </div>
			                            </div>
			                        </div>
			                        <div class="col-sm-10"  style="margin-bottom: 15px;">
			                            <div class="form-group has-feedback">
				                            <label class="col-lg-3 control-label" style="padding-top: 10px;">{!! trans('backend.status.lable') !!}</label>
				                            <div class="col-lg-7">
				                                <div class="radio">
				                                    <input id="demo-radio-7" class="magic-radio" type="radio" name="status" value="AVAILABLE" data-bv-field="member" checked>
				                                    <label for="demo-radio-7">{!! trans('backend.status.available') !!}</label>
				
				                                    <input id="demo-radio-8" class="magic-radio" type="radio" name="status" value="DISABLE" data-bv-field="member">
				                                    <label for="demo-radio-8">{!! trans('backend.users.disable') !!}</label>
				                                </div>
				                        </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                    	<button type="submit" class="btn btn-primary btn-block btn-form-submit">
        	                        	<i class="fa fa-save"></i>
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
	
@endsection

@section ('myCss')
	
@endsection

