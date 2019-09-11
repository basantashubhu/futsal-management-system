<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                 <i class="la la-edit cust_plus_icon"></i>
                <span>Update Lookup</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="lookupUpdate" class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="sectionSelect" class="required">
                            Section
                        </label>
                        <input type="text" class="form-control m-input" autocomplete="off" id="sectionSelect"
                               value="{{ $lookup->section }}" data-lookup="lookup/search-section?lookupview=true" disabled>
                        {{--<select name="section" class="form-control m-bootstrap-select m-input" id="sectionSelect"title="Select Section">--}}
                            {{--@foreach($all_sections as $key=>$value))--}}
                            {{--<option value="{{$key}}" @if($lookup->section == $key) selected @endif>{{$value}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code" class="required">
                            Code
                        </label>
                        <input type="text" class="form-control m-input" id="code" placeholder="Code"
                               value="{{$lookup->code}}" autocomplete="off" disabled>
                    </div>
                </div>
                
                @if($lookup->type != null)
                 <div class="form-group m-form__group row" id="category_choose">
                     <div class="col-lg-12 col-md-12 field">
                        <label for="category">Category</label>

                                 <input type="text" value="{{$lookup->type}}" class="form-control m-input site" name="type" autocomplete="off" 
                                        data-lookup="stipend/items/CodeCategoryAll">
                        </div>
                </div>
                @endif
               
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="value" class="required">
                            Value
                        </label>
                        <input type="text" class="form-control m-input" id="value" name="value" placeholder="Value"
                               value="{{$lookup->value}}" autocomplete="off">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label for="code">
                            Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{$lookup->description}}</textarea>
                    </div>
                </div>
                <div class="form-grou m-form__group row">
                    <div class="col-lg-6">
                        <label for="myDatatype" class="required">
                            Data Type
                        </label>
                        <select id="myDatatype" name="datatype"  class="form-control m-bootstrap-select m-input">
                            @foreach(['date', 'datetime', 'float', 'integer', 'string'] as $type)
                                <option value="{{ $type }}" {{ $type == $lookup->datatype ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
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
                                    <input type="checkbox" name="has_lookup" id="inputHasLookup" class="isChecked" @if($lookup->has_lookup) checked @endif value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="sequence_num" data-container="body" data-toggle="m-tooltip" data-placement="bottom" title data-original-title="Sequence Number" title="Sequence Number">
                            Seq No
                        </label>
                        <input type="text" class="form-control m-input" id="sequence_num" name="sequence_num" autocomplete="off" value="{{$lookup->sequence_num}}">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left cancelBtn" data-dismiss="modal">
                Cancel
            </button>
            {{--<button type="button" class="btn btn-accent m-btn--pill enable_form float-right">Edit</button>--}}
            <button type="button" class="btn btn-success m-btn--pill float-right" id="updateLookUp"
                    data-target="lookupUpdate" {{--style="display: none;"--}}>Save
            </button>
        </div>
    </div>
</div>

<script>
    $(function() {
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
        BootstrapDatetimepicker.init();
        BootstrapSelect.init();
        $('#sectionSelect').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('#myDatatype').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $(document).off('click', '#updateLookUp').on('click', '#updateLookUp', function (e) {
            var request = {
                url: '/lookup/update/{{$lookup->id}}',
                method: 'post',
                form: $(this).attr('data-target')
            };
            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    reloadDatatable('.lookup_val_datatable_1');
                    removeFormLoader();
                    $('.cancelBtn').trigger('click');
                });

            });

        });
     });


</script>