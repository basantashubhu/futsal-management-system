<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-plus cust_plus_icon"></i>
                <span>New Lookup {{$section == "FinanceCode"}}</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="LookupCreate" class="m-form">
                <div class="form-group m-form__group row">
                    <div class="col-lg-11">
                        <label for="sectionSelect" class="required">
                            Section
                        </label>
                        <input type="text" name="section" class="form-control m-input" autocomplete="off" id="sectionSelect"
                               value="{{isset($section) ? $section : ''}}" data-lookup="lookup/search-section?lookupview=true" data-lookup-callback="selectionSelect">
                        {{--<select name="section" class="form-control m-bootstrap-select m-input" id="sectionSelect" title="Select Section">--}}
                            {{--@foreach($all_sections as $value))--}}
                            {{--<option value="{{$value->section}}" @if(isset($section)) @if($section == $value->section) selected @endif @endif>{{ $value->section }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    </div>
                    <div class="col-lg-1 mt-25 pl-0">
                        <div class="btn-section">
                            <a href="javascript:void(0)" data-sub-modal-route="/lookup/section/add" id="AddSectionFly"
                               class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"
                               style="width:20px !important;height:20px !important;margin-top:5px;" data-modal-callback="AfterSectionFlyClose">
                                <i class="la la-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" id="lookup_code_label" class="required">
                            Code
                        </label>
                        <input type="text" name="code" placeholder="Code" autocomplete="off" value="{{ isset($code) ? $code : '' }}" class="form-control m-input" id="code"
                        data-lookup="{{ url('lookup/search-code') }}?{{ isset($section) ? "section={$section}" : '' }}">
                    </div>
                </div>
      
             {{--   <div class="form-group m-form__group row" hidden id="category_choose">
                                               <div class="col-lg-12 col-md-12 field">
                                                  <label for="category">Category</label>
                                                      <input type="text" class="form-control m-input site" name="category" autocomplete="off" 
                                                      data-lookup="stipend/items/CodeCategoryAll"> 
                         
                        </div>
                </div>
         --}}
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value" id="lookup_value_label" class="required">
                            Value
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="value" placeholder="Value" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" id="lookup_desc_label">
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-grou m-form__group row">
                    <div class="col-lg-6">
                        <label for="myDatatype" class="required">
                            Data Type
                        </label>
                        <select id="myDatatype" name="datatype"  class="form-control m-bootstrap-select m-input">
                            @foreach(['date', 'datetime', 'float', 'integer', 'string'] as $type)
                                <option value="{{ $type }}" {{ 'string' === $type ? 'selected' : ''  }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="inputHasLookup">
                            Has Lookup
                        </label>
                        <div>
                            <div class="m-checkbox-list">
                                <label class="m-checkbox m-l-15-i">
                                    <input type="checkbox" name="has_lookup" id="inputHasLookup" class="isChecked" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="sequence_num" data-container="body" data-toggle="m-tooltip" data-placement="bottom" title data-original-title="Sequence Number" title="Sequence Number">
                            Seq No
                        </label>
                        <input type="text" class="form-control m-input" id="sequence_num" name="sequence_num" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="submitLookup" data-target="LookupCreate" data-dismiss="modal">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $(function () {
        checkFinanceCode();

        BootstrapDatetimepicker.init();
        BootstrapSelect.init();
        // $('#sectionSelect').selectpicker({
        //     liveSearch: true,
        //     showTick: true,
        //     actionsBox: true,
        // });
        window.selectionSelect = function() {
            let value = $('#sectionSelect').val();
            let target = $('#code');
            let url = new URL(target.attr('data-lookup'));
            url.searchParams.set('section', value);
            target.attr('data-lookup', url.toString());

            //check for financeCode
           checkFinanceCode();
        };

        
        $('#myDatatype').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $(document).off('click', '#submitLookup').on('click', '#submitLookup', function (e) {
            console.log($('#LookupCreate').serializeArray());
            var request = {
                url: '/lookup/add',
                method: 'post',
                form: $(this).attr('data-target')
            };
            addFormLoader();
            ajaxRequest(request,function (response) {
                processForm(response, function() {
                    var v = '@if(isset($id)){{$id}} @endif';
                    reloadDatatable('.lookup_val_datatable_1');
                    // reloadDatatable('.lookup_val_datatable_'+v);
                    removeFormLoader();
                });

            });

        });
        $('#sectionSelect').off('keyup').on('keyup', function (e) {
            $('#AddSectionFly').attr('data-sub-modal-route', '/lookup/section/add?section_name=' + this.value);
        });
        window.AfterSectionFlyClose = function (resp) {
            if (!resp.data || !(0 in resp.data) || !resp.data[0].element) return;
            $('#sectionSelect').val(resp.data[0].element);
        };
    });

     $('.si_category').select2({
            width : "100%",
            dropdownParent: $('#modalContainer'),
            ajax : {
                url : 'stipend/items/lookup/?lookup=CodeCategory',
                processResults : function(data){
                    let cate = [];
                      $.each(data,function(index, value){
                        cate.push({id:value.val, text:value.text});
                      });
                      return {
                        results: cate
                      };
                }
            }
        });

        function checkFinanceCode() {
            let abc = $('#sectionSelect').val();
              if (abc=="FinanceCode") {
                    $('label#lookup_value_label').text('Finance Code')
                    $('label#lookup_desc_label').text('Name')
                    $('select#finance_code_type').removeAttr('disabled');
                    // $('#category_choose').removeAttr('disabled');

                }else{
                 
                    $('label#lookup_value_label').text('Value')
                    $('label#lookup_desc_label').text('Description')
                    $('select#finance_code_type').attr('disabled','disabled');
                    // $('#category_choose').attr('disabled');
                }

        }

            
</script>