ngApp.controller('purchaseCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $sellService, $apply) {

	$scope.data = {
		purchaseBusiness: {},
		sellBusiness: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getPurchase: function () {
			$sellService.action.getSetting({key: 'PURCHASE_BUSINESS'}).then(function (resp) {
				console.log(resp.data);
				angular.forEach(resp.data, function(value, key){
					if (value.key == 'PURCHASE_BUSINESS') {
						$scope.data.purchaseBusiness = value.setting
					}
				});
			}, function (error) {
			})
		},
		saveProcess: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'orderProcess': $scope.data.purchaseBusiness.orderProcess || '',
						'buyerGuarantee': $scope.data.purchaseBusiness.buyerGuarantee || '',
						'FAQ': $scope.data.purchaseBusiness.FAQ || '',
					}),
				'key' : 'PURCHASE_BUSINESS'
			}
			$sellService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
					$scope.actions.getPurchase();
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},
	}
	$scope.actions.getPurchase();
});