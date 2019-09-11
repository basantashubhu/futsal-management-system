/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

$(document).off('click','.toggleSSN').on('click','.toggleSSN', function(e) {
    e.preventDefault();
    var targetInput = $(this).attr('data-target-input');
    if(targetInput) {
        var input = $('#'+targetInput);
        if(input.attr('type') == "password") {
            input.attr('type','text');
        } else if(input.attr('type') == "text") {
            input.attr('type','password');
        }
    }
});