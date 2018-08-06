ngApp.directive('myRenderImage', function () {
	var link = function(scope, element, attrs) {
        $(element).change(function () {
            if (element[0].files && element[0].files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                   element.parent().parent().find('img').attr('src', e.target.result);
                };
             reader.readAsDataURL(element[0].files[0]);
                }
            });
    }
    return {
       restrict: 'C',
       link: link,
    };
});