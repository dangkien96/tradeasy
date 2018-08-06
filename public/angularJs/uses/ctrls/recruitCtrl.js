ngApp.controller('recruitCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $recruitService, $apply) {

	$scope.data = {
		recruits: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getRecruit: function () {
			var params = $recruitService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$recruitService.action.getRecruit(params).then(function (resp) {
				if (resp) {
					$scope.data.recruits = resp.data.data;
					$scope.data.page     = resp.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getRecruit();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('您確定要刪除？', function (resp) {
					if (resp) {
					$recruitService.action.deleteRecruit($id).then(function (resp) {
						if (resp) {
							$myNotify.success('成功！');
							$scope.actions.getRecruit();
						}
						}, function (error) {
							$myNotify.error('失敗!');
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getRecruit();
		}

	}

	$scope.actions.getRecruit();
});