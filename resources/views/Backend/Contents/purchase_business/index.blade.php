@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="purchaseCtrl">
		<div id="page-content">
		    <div class="panel">
		        <div class="panel-body">
	                <div class="row">
		                <div class="col-sm-12">
		                    <form>
		                        <div class="form-group">
		                        	<div class="form-group">
		                                <label class="control-label">Order process</label>
		                                <textarea class="my-ckeditor" ng-model="data.purchaseBusiness.orderProcess">
		                            	</textarea>
		                            </div>
		                            <div class="form-group">
		                                <label class="control-label">Buyer guarantee</label>
		                                <textarea class="my-ckeditor" ng-model="data.purchaseBusiness.buyerGuarantee">
		                            	</textarea>
		                            </div>
		                            <div class="form-group">
		                                <label class="control-label">Buying business FAQs</label>
		                                <textarea class="my-ckeditor" ng-model="data.purchaseBusiness.FAQ">
		                            	</textarea>
		                            </div>
		                        </div>
		                        <button type="button" ng-click="actions.saveProcess()" class="btn btn-primary btn-block btn-form-submit"><i class="fa fa-save"></i></button>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/sellService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/purchaseCtrl.js') }}"></script>
@endsection