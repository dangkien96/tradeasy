@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="settingCtrl">
		<div id="page-content">
		    <div class="panel" style="background-color: #ecf0f5">
		        <div class="panel-body">
					<div class="tab-base tab-stacked-left tab-setting">
			            <ul class="nav nav-tabs">
			            	<li class="active">
			                    <a data-toggle="tab" href="#tab-0"><i class="ti-world"></i> {!! trans('backend.setting.seo_default') !!} </a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-1"><i class="ti-arrow-circle-right"></i> {!! trans('backend.setting.contact') !!}</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-2"><i class="ti-info-alt"></i> {!! trans('backend.setting.about_us') !!}</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-3"><i class="ti-gallery"></i> {!! trans('backend.setting.banner_home') !!}</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-4"><i class="ti-vector"></i> {!! trans('backend.setting.rule_event') !!}</a>
			                </li>
			            </ul>
			            
			            <div class="tab-content">
			            	<div id="tab-0" class="tab-pane fade active in">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="panel-body">
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.meta_keyword') !!}</label>
	 					                                <input type="text" class="form-control" 
	 					                                ng-model="data.meta.keyword"
	 					                                required placeholder="Keyword">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.meta_title') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.meta.title"
	 					                                required placeholder="Title">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.meta_description') !!}</label>
	 					                                <textarea rows="5" class="form-control" placeholder="Description" ng-model="data.meta.description"></textarea>
	 					                            </div>
	 					                        </div>

	 					                        <div class="col-sm-12">
	 					                        	 <button type="button" ng-click="actions.saveMeta()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
	 					                        </div>
		 					                </div>
	        		                    </form>
	        		                </div>
	        		            </div>
			                </div>
			                <div id="tab-1" class="tab-pane fade">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="panel-body">
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.address') !!}</label>
	 					                                <input type="text" class="form-control" 
	 					                                ng-model="data.contact.address"
	 					                                required placeholder="{!! trans('backend.setting.address') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.phone') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.phone"
	 					                                required placeholder="{!! trans('backend.setting.phone') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.fax') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fax"
	 					                                placeholder="Fax">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.email') !!}</label>
	 					                                <input type="email" class="form-control" ng-model="data.contact.email"
	 					                                placeholder="{!! trans('backend.setting.email') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.facebook') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fb"
	 					                                placeholder="{!! trans('backend.setting.facebook') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.youtube') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.youtube"
	 					                                placeholder="{!! trans('backend.setting.youtube') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.instagram') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.instagram"
	 					                                placeholder="{!! trans('backend.setting.instagram') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.zalo') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.zalo"
	 					                                placeholder="{!! trans('backend.setting.zalo') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.website') !!}</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.website"
	 					                                placeholder="{!! trans('backend.setting.website') !!}">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">{!! trans('backend.setting.infram_map') !!}</label>
	 					                                <textarea type="text" rows="5" class="form-control" ng-model="data.contact.iframe" placeholder="{!! trans('backend.setting.infram_map') !!}"
	 					                                ></textarea>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                        	 <button type="button" ng-click="actions.saveContact()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
	 					                        </div>
		 					                </div>
	        		                    </form>
	        		                </div>
	        		            </div>
			                </div>
			                <div id="tab-2" class="tab-pane fade">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="form-group">
	        		                        	<p class="text-danger text-left" ng-repeat="(key, err) in data.aboutUsEr.errors.content">
	        		                        			@{{ err }}
	        		                        	</p>
	        		                            <textarea class="my-ckeditor" ng-model="data.aboutUs.content">
	        		                            </textarea>
	        		                        </div>
	        		                        <button type="button" ng-click="actions.saveAbout()" class="btn btn-primary btn-block">{!! trans('backend.setting.submit') !!}</button>
	        		                    </form>
	        		                </div>
	        		            </div>
			                </div>
			                <div id="tab-3" class="tab-pane fade">
			                    <div class="row">
        		                    <form>
			                            <div class="form-group">
			                            	<div class="col-md-6">
    			                            	<div class="form-group">
    		            	                        <label class="control-label" for="link_url">{!! trans('backend.setting.url_banner') !!}</label>
    		        	                            <input name="url_header" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url" ng-model="data.banner.url_header" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="headerBanner" data-preview="image-banner-header" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.image_banner') !!}
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="headerBanner" class="form-control" type="text" ng-model="data.banner.banner_header"  style="display: none">
    			                            	 </div>
    			                            	 <img id="image-banner-header"  ng-src="{{ url('') }}/@{{ data.banner.banner_header }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
			                            	<div class="col-md-6">
    			                            	<div class="form-group">
    		            	                        <label class="control-label" for="link_url">{!! trans('backend.setting.banner_right_url') !!}</label>
    		        	                            <input name="url_rt" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url"  ng-model="data.banner.url_rt" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="banner-right-top" data-preview="right-top-banner" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_right_image') !!}
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="banner-right-top" class="form-control" type="text" ng-model="data.banner.banner_rt_img"  style="display: none">
    			                            	 </div>
    			                            	 <img id="right-top-banner"  ng-src="{{ url('') }}/@{{ data.banner.banner_rt_img }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
			                            	<div class="col-md-6">
    			                            	<div class="form-group">
    		            	                        <label class="control-label" for="link_url">{!! trans('backend.setting.banner_right_url') !!}</label>
    		        	                            <input name="url_rb" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url" ng-model="data.banner.url_rb" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="banner-bottom-right" data-preview="banbottom-right-top" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_right_image') !!}
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="banner-bottom-right" class="form-control" type="text" ng-model="data.banner.banner_rb_img"  style="display: none">
    			                            	 </div>
    			                            	 <img id="banbottom-right-top"  ng-src="{{ url('') }}/@{{ data.banner.banner_rb_img}}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
		                            	</div>
        		                        <button type="button" ng-click="actions.saveBannerHome()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
        		                    </form>
	        		            </div>
			                </div>
			                <div id="tab-4" class="tab-pane fade">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="form-group">
	        		                        	<p class="text-danger text-left" ng-repeat="(key, err) in data.aboutUsEr.errors.content">
	        		                        			@{{ err }}
	        		                        	</p>
	        		                            <textarea class="my-ckeditor" ng-model="data.eventRule.content">
	        		                            </textarea>
	        		                        </div>
	        		                        <button type="button" ng-click="actions.saveRuleEvent()" class="btn btn-primary btn-block">{!! trans('backend.actions.submit') !!}</button>
	        		                    </form>
	        		                </div>
	        		            </div>
			                </div>
			            </div>
			        </div>
		        </div>
		    </div>
	    </div>
	</div>
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
	<script src="{{ url('') }}/vendor/laravel-filemanager/js/lfm.js"></script>
	<script>
		var domain = '{{ url('') }}' + '/admin/laravel-filemanager';
    	var loadAction = function () {
	    	$('[class*="lfm"]').each(function() {
    	        $('.lfm').filemanager('image', {prefix: domain});
    	    });
    	    $('.delete-imgdetail').click(function () {
	    		$(this).parent().parent().parent().html('');
	    	});
    	}	
    	loadAction();
	</script>
@endsection