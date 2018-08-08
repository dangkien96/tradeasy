ngApp.controller('franchiseCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $franchiseService, $apply) {

	$scope.data = {
		categories: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {

		getCategory: function () {
			$franchiseService.action.getCategory().then(function (resp) {
				if (resp) {
					$scope.data.categories = resp.data.data;
					console.log($scope.data.categories);
				}
			}, function (error) {
			})
		},

		getFranchise: function () {
			$franchiseService.action.getFranchise(params).then(function (resp) {
				if (resp) {
					$scope.data.recruits = resp.data.data;
					$scope.data.page     = resp.data;
				}
			}, function (error) {
			})
		},
	}

	$scope.actions.getCategory();
});