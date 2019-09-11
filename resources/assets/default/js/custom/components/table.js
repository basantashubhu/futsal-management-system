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

// Table pointer action
var guardTable = [],
    guardedLists = "";

$(document).off('click', 'table tbody tr').on('click', 'table tbody tr', function (e) {
    var self = $(this),
        a = "";

    if(guardTable.length) {

        $.each(guardTable, function(index, val) {
            a +=  val+", ";
        });

        guardedLists = a.replace(/,\s*$/, "");
    }

    if(!self.closest(guardedLists).length) {
        self.siblings('tr').removeClass('active_row');
        if (self.hasClass('active_row')) {
            // self.removeClass('active_row');
        } else {
            // self.addClass('active_row');
        }
    }
});