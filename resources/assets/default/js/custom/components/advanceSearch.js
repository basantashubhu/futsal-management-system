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

$(document).off('click','*[data-target-search]').on('click','*[data-target-search]', function(e){
	e.preventDefault();
	var self = $(this);
		searchBox = self.attr("data-target-search");
	$(searchBox).toggle("fast");
});



function loadSearchDateRange(name) {
	var input = $("input[name="+name+"]");
	input.daterangepicker({
		autoApply: true,
      	locale: {
          	cancelLabel: 'Clear'
      	}
  });

}
