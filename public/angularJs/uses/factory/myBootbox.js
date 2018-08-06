ngApp.factory('$myBootbox', ['$rootScope', function ($rootScope) {
        var myBootbox = {
            basic: function(message){
                swal(message).catch(swal.noop);
            },

            success: function(message, title){
               swal({
                    title: title || 'Good Job' ,
                    text: message,
                    type: 'success',
                    confirmButtonColor: '#4fa7f3'
                });
            },

            successTimeOut: function (message, title, timer) {
                swal({  title: title || 'Good Job',
                        text:  message,
                        type: 'success',
                        confirmButtonColor: '#4fa7f3',
                        timer: timer || 2000
                    }).then(
                        function () {
                        },
                        function (dismiss) {
                        });
            },

            confirm: function(message, callBackTrue, callBackFalse) {
                callBackTrue  = callBackTrue || function(){};
                callBackFalse = callBackFalse || function(){};
                swal({
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4fa7f3',
                    cancelButtonColor: '#d57171',
                    confirmButtonText: '確定',
                    cancelButtonText: '取消'
                }).then(callBackTrue, callBackFalse);
            },

            prompt: function (message, inputType, callback) {
                swal({
                    title: 'Submit email to run ajax request',
                    input:  inputType || 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Gửi',
                    showLoaderOnConfirm: true,
                    cancelButtonText: 'Hủy bỏ',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                }).then(callback, function () {

                });
            },
           

           


            // success: function(message, callBack){
            //     callBack = callBack || function(){};
            //     bootbox.confirm({
            //         message: message, 
            //         callback: callBack
            //     });
            // }
        };
        
        return myBootbox;
}]);