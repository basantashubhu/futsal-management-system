<script>
	$('.cal_type').select2({
            width : "100%",
            dropdownParent: $("[rel='subModalContainer']").length > 0 ? $("[rel='subModalContainer']") : $('#modalContainer'),
            height: "100%",
            ajax : {
                url : 'holiday/cal_type',
                processResults : function(data){
                   let sType = [];
                  $.each(data,function(index, value){
                    sType.push({id:value.text, text:value.text});
                  });
                    return {
                        results:sType
                    }
                }
            }
        }).on('select2:select', function(){
            floatLabelInput(this, true, 30);
        });
</script>