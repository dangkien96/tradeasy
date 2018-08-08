ngApp.controller('registerBuyCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $registerBuyService, $apply) {

	$scope.data = {
		contact: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getRegisterBuy: function () {
			var params = $registerBuyService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$registerBuyService.action.getRegisterBuy(params).then(function (resp) {
				if (resp) {
					$scope.data.page  = resp.data;
					if ($scope.data.page.current_page > resp.data.last_page) {
						$scope.data.page.current_page = resp.data.last_page;
						$scope.actions.getRegisterBuy();
					}
					$scope.data.contact = resp.data.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getRegisterBuy();
		},


		filter: function () {
			$scope.actions.getRegisterBuy();
		}

	}

	$scope.actions.getRegisterBuy();
});