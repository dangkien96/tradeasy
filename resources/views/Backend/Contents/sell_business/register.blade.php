@extends('Backend.Layouts.default')
@section('content')
	<div id="content-container" ng-controller="registerSellCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">About us</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">List</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel-heading">	
		                
		            </div>
		            <div class="panel-body">
		            	<div class="pad-btm form-inline">
				            <div class="row">
				                <div class="col-sm-6 table-toolbar-left">
				                </div>
				                <div class="col-sm-6 table-toolbar-right">
				                    <div class="form-group col-sm-12">
				                        <input id="demo-input-search2" type="text" placeholder="Tìm kiếm" class="form-control col-sm-
				                        8" autocomplete="off" ng-change="actions.filter()" ng-model="filter.freetext">
				                    </div>
				                </div>
				            </div>
				        </div>
		                <div class="table-responsive">
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>{!! trans('backend.sell_business.name') !!}</th>
		                                <th>{!! trans('backend.sell_business.email') !!}</th>
		                                <th>{!! trans('backend.sell_business.phone') !!}</th>
		                                <th>{!! trans('backend.sell_business.profit') !!}</th>
		                                <th>{!! trans('backend.sell_business.nature') !!}</th>
		                                <th>{!! trans('backend.sell_business.invertment') !!}</th>
		                                <th>{!! trans('backend.sell_business.message') !!}</th>
		                                <th>{!! trans('backend.sell_business.created_at') !!}</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr ng-repeat="(key, ct) in data.contact">
		                                <td class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1   }} </td>
		                                <td style="width: 150px">@{{ ct.name }}</td>
		                                <td style="width: 150px">@{{ ct.email }}</td>
		                                <td class="text-center">@{{ ct.phone }}</td>
		                                <td style="width: 150px">@{{ ct.profit }}</td>
		                                <td style="width: 150px">@{{ ct.nature }}</td>
		                                <td class="text-center">@{{ ct.imvestment }}</td>
		                                <td style="width: 350px" ng-bind-html="ct.message"></td>
		                                <td style="width: 150px"class="text-center">@{{ ct.created_at }}</td>
		                            </tr>
		                        </tbody>
		                    </table>
		                    <div class="text-center"> 
			                    <div paging
			                      page="data.page.current_page"  
	    						  show-first-last="true"
			                      page-size="data.page.per_page" 
			                      total="data.page.total"
			                      paging-action="actions.changePage(page)">
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
	<script src="{{ url('angularJs/uses/factory/services/registerSellService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/registerSellCtrl.js') }}"></script>
	

@endsection

@section ('myCss')
	
@endsection

