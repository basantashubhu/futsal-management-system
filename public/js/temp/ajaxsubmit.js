
var xhra;

// function sendAjax(request, callback = '') {
//     var checkImport;
//     var url = request.url ? request.url : '';
//     var method = request.method ? request.method : 'get';
//     var data = request.data ? request.data : {};

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $.ajax({
//         type: method,
//         url: url,
//         data: data,
//         beforeSend: function () {


//         },
//         success: function (response) {
//             clearInterval(checkImport);
//             if (typeof(callback) != 'string') {
//                 callback(response);
//             }

//         }
//     });
// }