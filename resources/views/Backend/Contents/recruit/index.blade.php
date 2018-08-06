@extends('Backend.Layouts.default')
@section('content')
	<div id="content-container" ng-controller="recruitCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Recruits</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">List</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel-body">
		            	<div class="pad-btm form-inline">
				            <div class="row">
				                <div class="col-sm-6 table-toolbar-left">
				                   <a href="{{ route('recruits.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> Add</a>
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
		                                <th>Title</th>
		                                <th>End Date</th>
		                                <th>Actions</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr ng-repeat="(key, recruit) in data.recruits">
		                                <td  style="width: 50px" class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1   }} </td>
		                                <td style="width: 350px">@{{recruit.title}}</td>
		                                <td style="width: 350px">@{{recruit.end_date}}</td>
		                                <td style="width: 170px">
		                                	<a class="btn btn-info btn-icon btn-sm" href="{{ url('admin/recruits') }}/@{{ recruit.id }}/edit">
		                                		Cập nhật
		                                	</a>
		                                	<button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(recruit.id)">
		                                		Xóa
		                                	</button>
		                                </td>
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

	<script src="{{ url('angularJs/uses/factory/services/recruitService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/recruitCtrl.js') }}"></script>
	@if (Session::has('users') && Session::get('users') == 'success')
	<script>
		$.toast({
		    heading: 'Thành công',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection

@section ('myCss')
	
@endsection

