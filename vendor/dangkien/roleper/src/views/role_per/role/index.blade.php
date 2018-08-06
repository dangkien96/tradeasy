@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Roles</h1>
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
				                   <a href="{{ route('roles.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="demo-pli-add"></i> Add Role</a>
				                </div>
				                <div class="col-sm-6 table-toolbar-right">
				                    <div class="form-group col-sm-12">
				                        <input id="demo-input-search2" type="text" placeholder="Tìm kiếm" class="form-control col-sm-
				                        8" autocomplete="off">
				                    </div>
				                </div>
				            </div>
				        </div>
		                <div class="table-responsive">
		                	@php
		                		$roles = App\Models\Role::paginate(30);
		                	@endphp
		                    <table class="table table-bordered table-striped">
		                        <thead>
		                            <tr>
		                                <th class="text-center">#</th>
		                                <th>Mã Role</th>
		                                <th>Tên hiện thị</th>
		                                <th>Mô tả về quyền</th>
		                                <th>Thao tác</th>
		                            </tr>
		                        </thead>
		                        <tbody>
	                            	@foreach ($roles as $key => $role) 
	                            	<tr>
		                                <td class="text-center"> {{ $key + 1 }} </td>
		                                <td>{{ $role->name }}</td>
		                                <td>{{ $role->display_name }}</td>
		                                <td>{{ $role->description }}</td>
		                                <td class="text-center" style="width: 150px;">
			                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
			                                	<a class="btn btn-sm btn-info btn-icon" title="update"  href="{{ route('roles.edit', $role->id) }}">
			                                		<i class="fa fa-edit icon-lg"></i>
			                                	</a>
			                                	<a class="btn btn-sm btn-warning" title="permission" 
			                                	href="{{ route('roles-permission.index', $role->id) }}"><i class="fa fa-key"></i></a>
			                                    @csrf
			                                    @method('DELETE')
			                                    <button type="submit" title="delete"  class="btn btn-sm btn-danger"><i class="fa fa-trash icon-lg"></i></button>
			                                </form>
			                            </td>
		                            </tr>
		                            @endforeach
		                        </tbody>
		                    </table>
		                    	{{ $roles->links() }}
		                </div>
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

