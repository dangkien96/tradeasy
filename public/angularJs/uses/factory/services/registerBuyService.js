ngApp.factory('$registerBuyService', function ($http, $httpParamSerializer){

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

	service.action.getRegisterBuy = function (params) {
		var url = SiteUrl + "/rest/admin/register-buy?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	return service;
})