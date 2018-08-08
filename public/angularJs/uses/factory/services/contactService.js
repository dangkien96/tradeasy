ngApp.factory('$contactService', function ($http, $httpParamSerializer){

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

	service.action.getContact = function (params) {
		var url = SiteUrl + "/rest/admin/contact?" + $httpParamSerializer(params);
        return $http.get(url);
	};


	// service.action.deleteAboutUs = function ($id) {
	// 	var url = SiteUrl + "/rest/admin/about-us/" + $id;
 //        return $http.delete(url);
	// };

	return service;
})