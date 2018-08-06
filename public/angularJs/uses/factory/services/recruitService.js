ngApp.factory('$recruitService', function ($http, $httpParamSerializer){

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

	service.action.getRecruit = function (params) {
		var url = SiteUrl + "/rest/admin/recruit?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteRecruit = function (params) {
		var url = SiteUrl + "/rest/admin/recruit/" + params;
        return $http.delete(url);
	};

	return service;
})