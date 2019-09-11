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

$(document).off('click', '.checkAllPet').on('click', '.checkAllPet', function(e){
    var self = $(this);
    if(self.prop('checked')){
        $('.parent_call').each(function(i, v){
            if($(this).hasClass('treatmentChecked')){
                return;
            }
            else{
                $(this).trigger('click');
                $(this).addClass('treatmentChecked');
            }
        });
    }
    else{
        if(!$('.parent_call').hasClass('treatmentChecked')){
            return ;
        }
        $('.parent_call').trigger("click");
    }

});

$(document).off('click', '.parent_call').on('click', '.parent_call', function(e){
    var self = $(this);
    if($('input[type="checkbox"]').prop('checked')){
        self.trigger('click');
        self.removeClass('treatmentChecked');
    }
    else{
        if(self.hasClass('treatmentChecked')){
            self.removeClass('treatmentChecked');
            if($('.checkAllPet').prop('checked')){
                $('.checkAllPet').trigger('click');
            }
        }
        else{
            self.addClass('treatmentChecked');
        }
    }
});


$(document).off('click', '#assign_provider').on('click', '#assign_provider', function(e){
    e.preventDefault();

    if($('.treatmentChecked').length > 0){
        var application_id = $(this).data('application-id');
        var data = [];

        $('.treatmentChecked').each(function(index, value){
            var id = $(this).data('id');
            data.push(id);
        });

        showModal('/pet/assignProvider/'+application_id+'?data='+data);
    }
    else{
        showModal('notFoundError/Pet');
    }
});
//
// $(document).off('click', '.singleTreatment').on('click', '.singleTreatment', function(e){
//     e.preventDefault();
//     var data = [];
//     var application_id = $(this).data('application-id');
//     var id = $(this).data('id');
//     showModal('pet/getTreatment/'+application_id+'/'');
//
// });


/**
 * -------------------------------
 * Pet Input Events For Headning
 * ------------------------------
 */

/**
 * Pet Name
 */
$(document).off('input', '*[name="pet_name[]"]').on('input', '*[name="pet_name[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title').find('.petName');
    if(self.val().length) {
        petHeader.text(self.val());
    } else {
        petHeader.text("Pet");
    }
});

/**
 * Species
 */
$(document).off('change', '*[name="species[]"]').on('change', '*[name="species[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title');

    if(self.val().length) {
        petHeader.find('.species').remove();
        petHeader.append('<span class="species"> <strong>Species </strong> '+self.val()+'</span>');
    } else {
        petHeader.find('.species').remove();
    }
});

/**
 * Breed
 */
$(document).off('input', '*[name="breed[]"]').on('input', '*[name="breed[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title');
    if(self.val().length) {
        petHeader.find('.breeds').remove();
        petHeader.append('<span class="breeds"> <strong>Breed </strong> '+self.val()+'</span>');
    } else {
        petHeader.find('.breeds').remove();
    }
});