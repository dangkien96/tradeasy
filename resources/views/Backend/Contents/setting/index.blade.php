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
			                    <a data-toggle="tab" href="#tab-1"><i class="ti-world"></i> Contact</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-2"><i class="ti-info-alt"></i> About-us</a>
			                </li>
			                <li>
			                    <a data-toggle="tab" href="#tab-3"><i class="ti-info-alt"></i> Banner Home</a>
			                </li>
			            </ul>
			            <div class="tab-content">
			                <div id="tab-1" class="tab-pane fade active in">
			                    <div class="row">
	        		                <div class="col-sm-12">
	        		                    <form>
	        		                        <div class="panel-body">
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Address</label>
	 					                                <input type="text" class="form-control" 
	 					                                ng-model="data.contact.address"
	 					                                required placeholder="Address">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Phone</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.phone"
	 					                                required placeholder="Phone">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Fax</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fax"
	 					                                placeholder="Fax">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Email</label>
	 					                                <input type="email" class="form-control" ng-model="data.contact.email"
	 					                                placeholder="Email">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Facebook</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.fb"
	 					                                placeholder="Facebook">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Youtube</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.youtube"
	 					                                placeholder="Youtube">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Instagram</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.instagram"
	 					                                placeholder="Instagram">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Zalo</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.zalo"
	 					                                placeholder="Zalo">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Website</label>
	 					                                <input type="text" class="form-control" ng-model="data.contact.website"
	 					                                placeholder="Website">
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                            <div class="form-group">
	 					                                <label class="control-label">Iframe Map</label>
	 					                                <textarea type="text" rows="5" class="form-control" ng-model="data.contact.iframe" placeholder="Iframe Map"
	 					                                ></textarea>
	 					                            </div>
	 					                        </div>
	 					                        <div class="col-sm-12">
	 					                        	 <button type="button" ng-click="actions.saveContact()" class="btn btn-primary btn-block">Submit</button>
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
	        		                        <button type="button" ng-click="actions.saveAbout()" class="btn btn-primary btn-block">確定</button>
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
    		            	                        <label class="control-label" for="link_url">Url banner</label>
    		        	                            <input name="url_header" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url" ng-model="data.banner.url_header" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="headerBanner" data-preview="image-banner-header" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> Image banner
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="headerBanner" class="form-control" type="text" ng-model="data.banner.banner_header"  style="display: none">
    			                            	 </div>
    			                            	 <img id="image-banner-header"  ng-src="{{ url('') }}/@{{ data.banner.banner_header }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
			                            	<div class="col-md-6">
    			                            	<div class="form-group">
    		            	                        <label class="control-label" for="link_url">Url banner</label>
    		        	                            <input name="url_rt" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url"  ng-model="data.banner.url_rt" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="banner-right-top" data-preview="right-top-banner" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> Image banner
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="banner-right-top" class="form-control" type="text" ng-model="data.banner.banner_rt_img"  style="display: none">
    			                            	 </div>
    			                            	 <img id="right-top-banner"  ng-src="{{ url('') }}/@{{ data.banner.banner_rt_img }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
			                            	<div class="col-md-6">
    			                            	<div class="form-group">
    		            	                        <label class="control-label" for="link_url">Url banner</label>
    		        	                            <input name="url_rb" type="text" placeholder="{!! trans('backend.menu.url') !!}" id="link_url" ng-model="data.banner.url_rb" class="form-control" autocomplete="off">
    		        	                        </div>
    			                            	<div class="input-group">
    			                            	   <span class="input-group-btn">
    			                            	    <a data-input="banner-bottom-right" data-preview="banbottom-right-top" class="lfm btn btn-primary">
    			                            	       <i class="fa fa-picture-o"></i> Image banner
    			                            	    </a>
    			                            	    </span>
    			                            	    <input id="banner-bottom-right" class="form-control" type="text" ng-model="data.banner.banner_rb_img"  style="display: none">
    			                            	 </div>
    			                            	 <img id="banbottom-right-top"  ng-src="{{ url('') }}/@{{ data.banner.banner_rb_img}}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
			                            	</div>
		                            	</div>
        		                        <button type="button" ng-click="actions.saveBannerHome()" class="btn btn-primary btn-block">確定</button>
        		                    </form>
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