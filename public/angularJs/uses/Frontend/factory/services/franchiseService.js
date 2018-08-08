ngApp.factory('$franchiseService', function ($http, $httpParamSerializer){

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

	service.action.getFranchise = function (id) {
		var config = {
	        headers : {
	            'Access-Control-Allow-Origin': "*",
	            'Access-Control-Allow-Credentials': true,
	            'Access-Control-Allow-Headers': ' Content-Type',
	            'Access-Control-Allow-Methods': 'GET'
	        },
	    }
		var url = 'http://profi.bkav.ooo/api/franchise_category/detail' + id;
        return $http.get(url, config);
	};

	service.action.getCategory = function () {
		var config = {
	        headers : {
	            'Access-Control-Allow-Origin': "*",
	            'Access-Control-Allow-Credentials': true,
	            'Access-Control-Allow-Headers': ' Content-Type',
	            'Access-Control-Allow-Methods': 'GET'
	        },
	    }
		var url = 'http://profi.bkav.ooo/api/franchise_category/all';
        return $http.get(url, config);
	};

	return service;
})