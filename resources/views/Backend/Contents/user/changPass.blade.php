@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">用戶</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#"> 修改密碼</a></li>
            </ol>
        </div>
		<div id="page-content">
		    <div class="panel-body">
		        <div class="panel">
		            <div class="panel">
			            <div class="panel-heading">
			               
			            </div>
			            <form action="{{ route('users.changePassword') }}" method="POST" enctype="multipart/form-data">
			            	@csrf
			            	@method ('POST')
			                <div class="panel-body col-sm-offset-2">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">Mật khẩu mới</label>
			                                <input type="password" name="password" class="form-control">
			                                @if ($errors->has('password'))
				                            	<p class="text-left text-danger">{{ $errors->first('password') }}</p>
				                            @endif
			                            </div>
			                        </div> 
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">Nhập lại mật khẩu mới</label>
			                                <input type="password" name="confirm" class="form-control">
			                                @if ($errors->has('confirm'))
				                            	<p class="text-left text-danger">{{ $errors->first('confirm') }}</p>
				                            @endif
			                            </div>
			                        </div>
			                    </div>
			                    <div class="row">
			                    	<div class="col-sm-10">
			                        	<button type="submit" class="btn btn-primary btn-block">Gửi</button>
			                        </div>
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

