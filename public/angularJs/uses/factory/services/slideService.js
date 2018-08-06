ngApp.factory('$slideService', function ($http, $httpParamSerializer){

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

	service.action.getSlide = function (params) {
		var url = SiteUrl + "/rest/admin/slides?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteSlide = function ($id) {
		var url = SiteUrl + "/rest/admin/slides/" + $id;
        return $http.delete(url);
	};

	return service;
})