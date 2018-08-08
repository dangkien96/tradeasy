ngApp.controller('contactCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $contactService, $apply) {

	$scope.data = {
		contact: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getContact: function () {
			var params = $contactService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$contactService.action.getContact(params).then(function (resp) {
				if (resp) {
					$scope.data.page  = resp.data;
					if ($scope.data.page.current_page > resp.data.last_page) {
						$scope.data.page.current_page = resp.data.last_page;
						$scope.actions.getContact();
					}
					$scope.data.contact = resp.data.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getContact();
		},


		filter: function () {
			$scope.actions.getContact();
		}

	}

	$scope.actions.getContact();
});