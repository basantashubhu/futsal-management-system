(function ($, root, undefined) {

	$(function () {

		'use strict';

		$(document).off('click','.frm_form_fields  .frm_section_heading > h3.agreed, .section > h3.agreed')
                .on('click','.frm_form_fields  .frm_section_heading > h3.agreed, .section > h3.agreed' , function() {

      if ($(this).parent().hasClass('expanded'))
        $(this).parent().css('max-height', '50px').removeClass('expanded')
      else
        $(this).parent().css('max-height', '4000px').addClass('expanded');
    });

    $(document).off('click', '.section .agree').on('click', '.section .agree', function(e) {
      e.preventDefault();
      $(this).parents('.section').css('max-height', '50px').removeClass('expanded');
      $('#frm_field_129_container').css('max-height', '4000px').addClass('expanded');
      $('#frm_field_123_container').css('max-height', '300px').addClass('expanded');
      $('h3').each(function() { $(this).addClass('agreed'); });
    });

    $("#partners").searchable({latency: 50});

    $('.frm_error').each(function() {
      $(this).parents('#frm_field_129_container').css('max-height', '4000px').addClass('expanded');
      $(this).parents('#frm_field_123_container').css('max-height', '300px').addClass('expanded');
    });

    $(document).off('change','#partners').on('change','#partners', function() {
      var target = $('#partners option:selected').attr('value');
      var newMap = $('#map'+target+' .mapURL').text();

      if (target != '') {
        $('.mapInfo').hide();
        $('#map'+target).show();

        $('#post-58 iframe').attr('src', newMap+'&key=AIzaSyBz-HSEfLWgktvteo_NZbXxf96iGXBh-XE')
      }
    });

    $(document).off('change', "#mobileMenu").on('change', "#mobileMenu", function()
    {
        document.location.href = $(this).val();
    });

	});

})(jQuery, this);
