/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - RUNA SIDDHI BAJRACHARYA
 * - RABIN BHANDARI
 * - SHIVA THAPA
 * - PRABHAT GURUNG
 * - KIRAN CHAULAGAIN
 * -----------------------------------------------
 * Created On: 4/7/2018
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/

String.prototype.ucfirst = function(){
	return this.charAt(0).toUpperCase() + this.slice(1);
};

var blackListsInputs =  {};

$(document).off('keyup', 'input').on('keyup', 'input', function(e) {

	var self = $(this);
	// if(blackListsInputs.indexOf())

});