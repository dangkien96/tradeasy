ngApp.controller('sellCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $sellService, $apply) {

	$scope.data = {
		purchaseBusiness: {},
		sellBusiness: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getSell: function () {
			$sellService.action.getSetting({key: 'SELL_BUSINESS'}).then(function (resp) {
				angular.forEach(resp.data, function(value, key){
					if (value.key == 'SELL_BUSINESS') {
						$scope.data.sellBusiness = value.setting
					}
				});
			}, function (error) {
			})
		},
		saveSell: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'orderProcess': $scope.data.sellBusiness.orderProcess || '',
						'buyerGuarantee': $scope.data.sellBusiness.buyerGuarantee || '',
						'FAQ': $scope.data.sellBusiness.FAQ || '',
						'review': $scope.data.sellBusiness.review || '',
					}),
				'key' : 'SELL_BUSINESS'
			}
			$sellService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$scope.actions.getSell();
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},
	}
	$scope.actions.getSell();
});