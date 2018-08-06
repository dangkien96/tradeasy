ngApp.controller('slideCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $slideService, $apply) {

	$scope.data = {
		slides: {},
		page: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getSlide: function () {
			var params = $slideService.data.filter($scope.filter.freetext, $scope.data.page.current_page);
			$slideService.action.getSlide(params).then(function (resp) {
				if (resp) {
					$scope.data.slides = resp.data.data;
					$scope.data.page  = resp.data;
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getSlide();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Are you sure？', function (resp) {
					if (resp) {
					$slideService.action.deleteSlide($id).then(function (resp) {
						if (resp) {
							$myNotify.success('Sure！');
							$scope.actions.getSlide();
						}
						}, function (error) {
							$myNotify.error('No!');
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getSlide();
		}

	}

	$scope.actions.getSlide();
});