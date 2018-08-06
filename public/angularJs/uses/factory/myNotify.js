ngApp.factory('$myNotify', ['$rootScope', function ($rootScope) {
    var myNotify = {
        success: function(message) {
            var heading   = 'Success';
            var text      = message;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'success';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },
        error: function(message) {
            var heading   = 'Error';
            var text      = message;
            var position  = position || 'top-right';
            var loaderBg  = '#fcd8dc';
            var bgColor   = '#fcd8dc';
            var icon      = 'error';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },

        warning: function(message) {
            var heading   = "Có lỗi";
            var text      = message;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'warning';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },
    };
        
        return myNotify;
}]);
