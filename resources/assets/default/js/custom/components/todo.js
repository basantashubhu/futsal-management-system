


loadList();
function loadList() {
    var request ={
        url:'/note/todo',
        method:'get'
    };
    ajaxRequest(request,function (response) {
        console.log(response.data);
    })
}