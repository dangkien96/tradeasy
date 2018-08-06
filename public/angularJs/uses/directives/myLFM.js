ngApp.directive('myLfm', function($apply) {
    return {
        restrict: 'C',
        scope: {
            type: "=type"
        },
        link: function(scope, element, attrs) {
            var domain = SiteUrl + '/admin/laravel-filemanager/';
            $(element).filemanager(scope.type, {prefix: domain});
        }
    };
});