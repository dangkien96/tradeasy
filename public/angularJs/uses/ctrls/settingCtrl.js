ngApp.controller('settingCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $settingService, $apply) {

	$scope.data = {
		users: {},
		page: {},
		logo: {},
		banner_home: {},
		contact: {}, 
		aboutUs: {},
		purchaseBusiness: {},
		eventRule: {},
		meta: {}
	}
	$scope.filter = {
		freetext: ""
	}

	$scope.actions = {
		getLogo: function () {
			$settingService.action.getSetting().then(function (resp) {
				angular.forEach(resp.data, function(value, key){
					if (value.key == 'CONTACT') {
						$scope.data.contact = value.setting
					}
					if (value.key == 'ABOUT_US') {
						$scope.data.aboutUs = value.setting
					}
					if (value.key == 'BANNER_HOME') {
						$scope.data.banner = value.setting
					}
					if (value.key == 'RULE_EVENT') {
						$scope.data.eventRule = value.setting
					}
					if (value.key == 'META_SEO') {
						$scope.data.meta = value.setting
					}
					
				});
			}, function (error) {
			})
		},

		changeLogo: function () {
			let params = {
				'setting': JSON.stringify({'url_image': $scope.data.logo.url_image}),
				'key' : 'LOGO'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},
		saveBannerHome: function () {
			let params = {
				'setting': JSON.stringify(
					{'url_header': $scope.data.banner.url_header || '',
					 'banner_header': $scope.data.banner.banner_header || '',

					 'banner_rt_img': $scope.data.banner.banner_rt_img || '',
					 'url_rt': $scope.data.banner.url_rt || '',

					 'banner_rb_img': $scope.data.banner.banner_rb_img || '',
					 'url_rb': $scope.data.banner.url_rb || ''}),
				'key' : 'BANNER_HOME'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveAbout: function () {
			let params = {
				'setting': JSON.stringify(
					{'content': $scope.data.aboutUs.content || ''}),
				'key' : 'ABOUT_US'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveRuleEvent: function () {
			let params = {
				'setting': JSON.stringify(
					{'content': $scope.data.eventRule.content || ''}),
				'key' : 'RULE_EVENT'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
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
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveMeta: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'title': $scope.data.meta.title || '',
						'keyword': $scope.data.meta.keyword || '',
						'description': $scope.data.meta.description || '',
					}),
				'key' : 'META_SEO'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		saveContact: function () {
			let params = {
				'setting': JSON.stringify(
					{
						'address': $scope.data.contact.address || '',
						'phone'  : $scope.data.contact.phone || '',
						'worktime' : $scope.data.contact.worktime || '',
						'fax' : $scope.data.contact.fax || '',
						'email': $scope.data.contact.email || '',
						'fb': $scope.data.contact.fb || '',
						'youtube'  : $scope.data.contact.youtube || '',
						'instagram' : $scope.data.contact.instagram || '',
						'zalo' : $scope.data.contact.zalo || '',
						'iframe' : $scope.data.contact.iframe || '',
						'website' : $scope.data.contact.website || '',
					}
				),
				'key' : 'CONTACT'
			}
			$settingService.action.insertSetting(params).then(function (resp){
				if (resp) {
					$myNotify.success('Success')
				}
			}, function (error) {
				$myNotify.error('Error')
			});
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Are you sure?', function (resp) {
					if (resp) {
					$settingService.action.deleteUser($id).then(function (resp) {
						if (resp) {
							$myNotify.success('Sure!');
							$scope.actions.getAboutTeam();
						}
						}, function (error) {
							$myNotify.error('No!');
						})
					}
				})
			}
		},



	}

	$scope.actions.getLogo();
});