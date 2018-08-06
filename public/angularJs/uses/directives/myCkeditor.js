ngApp.directive('myCkeditor', function($apply, $timeout) {
    return {
        restrict: 'C',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
            $apply (function () {
                var ck = CKEDITOR.replace(element[0], {
                    language: 'vi',
                    filebrowserImageBrowseUrl: SiteUrl + '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: SiteUrl + '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: SiteUrl + '/laravel-filemanager/upload?type=Files&_token=',
                }); 
                if (!ngModel) return;
                ck.on('instanceReady', function () {
                    ck.setData(ngModel.$viewValue);
                });
                function updateModel() {
                    scope.$apply(function () {
                        ngModel.$setViewValue(ck.getData());
                    });
                }
                ck.on('change', updateModel);
                ck.on('key', updateModel);
                ck.on('dataReady', updateModel);

                ngModel.$render = function (value) {
                    ck.setData(ngModel.$viewValue);
                };
            })
        }
    }
});