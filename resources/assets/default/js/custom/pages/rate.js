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

/* ---------------------------
    Add New Vet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    template = null,
    appendDiv = null;

$(document).off('click', '#addNewRate').on('click', '#addNewRate', function (e) {

    var self = $(this);

    template = $("#newRate_Template");
    appendDiv = $("#newRate_Template_Append");

    if (appendDiv.find('.m-accordion').length > 3) {
        if (petCount >= 5) {
            petCount = 2;
        }
        return toastr.error('Can\'t add more than 5 pets');
    }

    prepareDynamicAccordion(templateId);
    $(".m-accordion").find('.collapse').removeClass('show');
    appendDiv.append(template.html());
    appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

    templateId++;
    petCount++;
});