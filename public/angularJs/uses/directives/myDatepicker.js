ngApp.directive('myDatepicker', function($apply) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {
            $apply(function () {
                $('.datepicker').datepicker();
                $('#sandbox-container input').datepicker({
                    language: "vi"
                });
            });
        }
    };
});