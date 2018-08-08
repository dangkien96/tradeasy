ngApp.controller('registerSellCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $registerSellService, $apply) {

	$scope.data = {
		contact: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getRegisterSell: function () {
			var params = $registerSellService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$registerSellService.action.getRegisterSell(params).then(function (resp) {
				if (resp) {
					$scope.data.page  = resp.data;
					if ($scope.data.page.current_page > resp.data.last_page) {
						$scope.data.page.current_page = resp.data.last_page;
						$scope.actions.getRegisterSell();
					}
					$scope.data.contact = resp.data.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getRegisterSell();
		},


		filter: function () {
			$scope.actions.getRegisterSell();
		}

	}

	$scope.actions.getRegisterSell();
});