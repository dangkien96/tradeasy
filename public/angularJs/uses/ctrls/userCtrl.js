ngApp.controller('userCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $userService, $apply) {

	$scope.data = {
		users: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getAboutTeam: function () {
			var params = $userService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$userService.action.getUser(params).then(function (resp) {
				if (resp) {
					$scope.data.users = resp.data.data;
					$scope.data.page  = resp.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getAboutTeam();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('您確定要刪除？', function (resp) {
					if (resp) {
					$userService.action.deleteUser($id).then(function (resp) {
						if (resp) {
							$myNotify.success('成功！');
							$scope.actions.getAboutTeam();
						}
						}, function (error) {
							$myNotify.error('失敗!');
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getAboutTeam();
		}

	}

	$scope.actions.getAboutTeam();
});