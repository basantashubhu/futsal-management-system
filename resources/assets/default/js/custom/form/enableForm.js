

// function enable_form(element) {
//  	if (element.text() == "Edit") {
//         var id = element.attr("id");
//         element.parent().parent().find(':input').attr("disabled", false);
//         element.hide();
//         element.siblings().show();
//     }
// }

$(document).off('click', '.enable_form').on('click', '.enable_form', function(e){
    e.preventDefault();
    var self = $(this);
        if (self.text() == "Edit") {
        var id = self.attr("id");
        self.parent().parent().find(':input').attr("disabled", false);
        self.hide();
        self.siblings().show();
    }
});
