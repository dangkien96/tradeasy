ngApp.factory('$settingService', function ($http, $httpParamSerializer){

	var service = {
		action: {},
		data: {}
	};

	service.data.filter = function (freetext, page) {
		return {
			freetext: freetext || '',
			page: page || 1
		}
	};

	service.action.getSetting = function () {
		var url = SiteUrl + "/rest/admin/setting?";
        return $http.get(url);
	};


	service.action.insertSetting = function (params) {
		var url = SiteUrl + "/rest/admin/insertSetting";
        return $http.post(url, params);
	};

	return service;
})