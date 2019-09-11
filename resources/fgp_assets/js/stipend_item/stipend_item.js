/*
* @Author: 
 /** 
 * DEVELOPERS 
 * ------------------------------------------------  
 * - SUMAN THAPA - LEAD(NEPALNME@GMAIL.COM) 
 * ------------------------------------------------  
 * - PRABHAT GURUNG 
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA 
 * - MANISH BUDDHACHARYA 
 * - LEKH RAJ RAJ 
 * - ASCOL PARAJULI 
 * ------------------------------------------------  
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019 
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
* @Date:   2019-03-28 19:38:55
* @Last Modified by:   Lekh Raj Rai
* @Last Modified time: 2019-05-09 18:03:33
*/



$(function(){
$('input[data-lookup]').on('keydown',function(e){
     $(this)[0].hasAttribute('isLookup') ? checkFinanceCode($(this).val(), $(this)) : false;
   });

  /*---------- finance code lookup -------*/
    function getFinanceCode(financeCode, origin){
        typeof origin === "undefined" ? false : origin.val(financeCode);
        if (typeof origin !== "undefined") {
          origin.val(financeCode);
          checkFinanceCode(financeCode,origin);
        }
    }


    function checkFinanceCode(givenCode,element) {
    if (givenCode != "") {
          $.ajax({
            url:'/finance_code/check/value/'+givenCode,
            method:'GET',
            success:function(data){
               let id = element.attr('id') ; 
             $('input#'+id).css("border","1px solid #fff");
            },
            error: function (error) {
              let id = element.attr('id'); 
              $('#'+id).css("border","1px solid #b12704");
            }
          })
        }
      }


    function stipendItemCategorySelected(category_id){
      $.get("/stipend/item/category/name/"+category_id,function(response,status){
          let categoryName = response.value;
             $('.business_unit').attr('data-lookup',`stipend/items/Business/${categoryName}`);


            $('.department_code').attr('data-lookup', `stipend/items/Department/${categoryName}`);
            $('.account_code').attr('data-lookup', `stipend/items/Account/${categoryName}`);
            $('.program_code').attr('data-lookup', `stipend/items/Program/${categoryName}`);
            $('.fund_code').attr('data-lookup', `stipend/items/Fund/${categoryName}`);
            $('.project_code').attr('data-lookup', `stipend/items/Project/${categoryName}`);  


            $('#viewBusiness').attr('data-sub-modal-route', `finance_code/${categoryName}/business`);
            $('#viewDepartment').attr('data-sub-modal-route', `finance_code/${categoryName}/department`);
            $('#viewAccount').attr('data-sub-modal-route', `finance_code/${categoryName}/account`);
            $('#viewProgram').attr('data-sub-modal-route', `finance_code/${categoryName}/program`);
            $('#viewFund').attr('data-sub-modal-route', `finance_code/${categoryName}/fund`);
            $('#viewProject').attr('data-sub-modal-route', `finance_code/${categoryName}/project`);
      });
    }

    function labelFloatNow() {
       $('#AddStipendItem :input').each(function(){
             floatLabelInput(this,true);
        }).off('focus')
        .on('focus', function() {
            floatLabelInput(this);
        })
        .off('blur')
        .on('blur', function() {
            floatLabelInput(this, true);
        })
        .off('change')
        .on('change', function() {
            floatLabelInput(this, true);
        });
  }   

  function labelFloatUpdateNow() {
       $('#stipendItemUpdate :input').each(function(){
             floatLabelInput(this,true);
        }).off('focus')
        .on('focus', function() {
            floatLabelInput(this);
        })
        .off('blur')
        .on('blur', function() {
            floatLabelInput(this, true);
        })
        .off('change')
        .on('change', function() {
            floatLabelInput(this, true);
        });
  }


 function clickSubmodalTable(element, attribute){
 
       let remove = $('.my-submodal-table').find('tr');
        remove.removeClass('rowBg');
        element.addClass('rowBg');
        var data = element.find("td.myvalue");
        if(data) {
           let fcode = data[0].innerHTML;
          let newValue = $("[data-table-value="+attribute+"]");
            newValue.val() == "";
            newValue.val(fcode);
            checkFinanceCode(fcode,newValue);
            labelFloatUpdateNow()
            labelFloatNow();
            processModal();
        }
  }




	
    /*-------- submit form ----------*/
    $(document).off('click','#btnUpdateItem').on('click','#btnUpdateItem', function (e) {
        e.preventDefault();
        var form = $(this).attr('data-target');
        let formData = $('#'+form).serializeArray();
        let stipendItem = $(this).attr('data-id');

        var request = {
            url: '/stipend/items/update/'+stipendItem,
            method: 'post',
            data: formData,
            loader: true
        };

        sendAjax(request, function(response){
            processModal();
            reloadDatatable('#stipend_item_data_table');
            toastr.success("Successfully updated")


        }, function({responseJSON}){

            toastr.error("Please fill in the required fields")

            $('#'+form).find(`input`).css('border-color', "#ccc")
            $('#'+form).find('.select2-selection--single').css('border-color', "#ccc")
            
            for(let error in responseJSON.errors){
                $('#'+form).find(`[name="${error}"]`).css('border-color', "#b12704")
                $('#'+form).find(`[name="${error}"]`).next().find('.select2-selection--single').css('border-color', "#b12704")
            }

        })



    });
});

$(document).off('click','a.selectCode').on('click','a.selectCode',function(e) {
  let value =  $(this).attr('data-code-value');
  let id = $(this).attr('data-select-id');
  clickedSelectItem(value,id);
});
