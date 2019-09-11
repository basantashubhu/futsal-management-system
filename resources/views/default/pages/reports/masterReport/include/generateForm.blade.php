<form id="mailForm" class="m-form">
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label for="code" class="required">
                Report Name
            </label>
            <input type="text" name="report_name" class="form-control m-input form-control-sm" autocomplete="off">
        </div>
    </div>
    <div class="row m-t-10-i">
        <div class="col-sm-12">
            <div class="tableContainer">
                @if(count($applications)>0)
                    <table class="table table-bordered m-table m-table--head-bg-success">
                        <thead class="fixedHeader">
                        <tr>
                            <th width="2%">
                                <label class="m-checkbox">
                                    <input type="checkbox" class="checkedAll" checked>
                                    <span></span>
                                </label>
                                <input type="hidden" name="">
                            </th>
                            <th width="10.3%">Date</th>
                            <th width="9.9%">ID</th>
                            <th width="51%;">Owner/Care Taker</th>
                            <th width="10%">Total Pets</th>
                        </tr>
                        </thead>
                        <tbody class="scrollContent">
                        @foreach($applications as $app)
                            <tr>
                                <td width="2%">
                                    <label class="m-checkbox">
                                        <input type="checkbox" class="checkedToGenerate" data-id="{{$app->id}}" checked>
                                        <span></span>
                                    </label>
                                    <input type="hidden" name="id[]" id="myHiddenField_{{$app->id}}"
                                           value="{{$app->id}}">
                                </td>
                                <td width="10.3%">{{date('m/d/Y',strtotime($app->application_date))}}</td>
                                <td width="9.9%">@if(getSiteSettings('alt_id_true') == 'true')<?php echo "IE" . str_pad($app->alt_id, 5, "0", STR_PAD_LEFT); ?>@else {{$app->id}} @endif</td>
                                <td width="51%;">{{ucfirst($app->client->fname)}} {{ucfirst($app->client->lname)}}</td>
                                <td width="10%;">{{$app->pets->count()}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No Result Found
                @endif
            </div>
        </div>
    </div>
</form>
<hr>
<div class="form-footer">
    @if(count($applications)>0)
        <button type="button" class="btn btn-secondary m-btn--pill float-left" id="hideForm">
            Cancel
        </button>
        <button type="button" class="btn btn-success m-btn--pill float-left m-l-10" id="generateFormSubmit"
                data-target="mailForm">
            Apply
        </button>
    @endif
</div>
<script>
    $(document).off('click', '.checkedToGenerate').on('click', '.checkedToGenerate', function (e) {
        var id = $(this).attr('data-id');
        var self = $(this);
        if (self.prop('checked')) {
            $('#myHiddenField_' + id).attr("name", "id[]");
        } else {
            $('#myHiddenField_' + id).removeAttr("name", "id[]");
        }
    });


    $('.checkedAll').on('change', function () {
        if ($(this).is(':checked'))
            $('.scrollContent').find('input[type=checkbox]').prop('checked', true);
        else
            $('.scrollContent').find('input[type=checkbox]').prop('checked', false);
    });

    $('.checkedToGenerate').on('change', function () {
        var checkBoxLen = $('.scrollContent').find('input[type=checkbox]').length;
        var checkedLen = $('.scrollContent').find('input[type=checkbox]:checked').length;
        if (checkBoxLen == checkedLen)
            $('.checkedAll').prop('checked', true);
        else
            $('.checkedAll').prop('checked', false);
    });

    $(document).off('click', '#generateFormSubmit').on('click', '#generateFormSubmit', function (e) {
        var request = {
            url: '/generateMailList',
            method: 'post',
            form: $(this).attr('data-target')
        };
        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                removeFormLoader();
                $("#generateForm").slideUp();
                reloadDatatable('#repostTablem');
            });

        });
    });
</script>