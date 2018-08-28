ngApp.directive('lfmLoad', function($apply, $timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            if (scope.$last){
                $('[class*="lfm"]').each(function() {
                    $('.lfm').filemanager('image', {prefix: domain});
                });
                $('.delete-imgdetail').click(function () {
                    $(this).parent().parent().parent().html('');
                });
            }
        }
    }
});