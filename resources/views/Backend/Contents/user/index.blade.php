@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="userCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Người dùng</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">Danh sách</a></li>
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
				                   <a href="{{ route('users.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> Thêm mới người dùng</a>
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
		                                <th>Tên</th>
		                                <th>Email</th>
		                                <th>Phone</th>
		                                <th>Trạng thái</th>
		                                <th>Thao tác</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr ng-repeat="(key, user) in data.users">
		                                <td class="text-center"> @{{key}} </td>
		                                <td>@{{user.name}}</td>
		                                <td>@{{user.email}}</td>
		                                <td>@{{user.phone}}</td>
		                                <td>
		                                	<span>
		                                		<img style="width: 100px; height: 100px;" ng-src="{{ url('') }}/@{{user.avatar}}" /> 
			                                </span>
			                            </td>
		                                <td style="width: 250px">
		                                	<a class="btn btn-info btn-icon btn-sm" >
		                                		Cập nhật
		                                	</a>
		                                	<a class="btn btn-info btn-icon btn-sm" href="{{ url('admin/users/user-permission') }}/@{{ user.id }}">
		                                		Phân quyền
		                                	</a>
		                                	<button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(user.id)">
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
	<script src="{{ url('angularJs/uses/factory/services/userService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/userCtrl.js') }}"></script>
	
	@if (Session::has('users') && Session::get('users') == 'success')
	<script>
		$.toast({
		    heading: '成功！',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif

@endsection

@section ('myCss')
	
@endsection

