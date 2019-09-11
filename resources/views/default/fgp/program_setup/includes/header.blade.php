<?php

?>
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Program Setup
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="/" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="javascript:void(0)" class="m-nav__link" data-route="program-setup">
                        <span class="m-nav__link-text">
                            Program setup
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    <!--button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill" id="addTimesheet" data-id="" {{-- data-modal-route="/time-sheets/add/new"
                data-backdrop="static" data-keyboard="false" --}}>
            <span>
                <i class="la la-plus"></i>
                <span>
                    Time Sheet
                </span>
            </span>
        </button-->
        <button class="btn btn-info m-btn btn-sm m-btn--custom m-btn--icon m-btn--pill time-sheet-back" data-route="time-sheets" style="display: none;">
            <span>
                <i class="la la-arrow-left"></i>
                <span>
                    Time Sheets
                </span>
            </span>
        </button>

        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push mr-30" title="Back">
            <a class=" btn btn-sm btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle timesheet_back" style="display: none;">
                <i class="m-menu__link-icon la la-arrow-left"></i>
            </a>
        </div>

    </div>
</div>
<script>
    $("#addTimesheet").off('click').on('click', function(e){
        e.preventDefault();
        let url = 'time-sheets/assign/new';
        var request= {
            url: url,
            method: 'get'
        }
        ajaxRequest(request, function(response){
            $("#tabelTimeSheet").slideUp('slow');
            $("#TimeSheetAssignForm").slideDown('slow');
            $('#dynamicTimeSheet').html(response.data);
            $('#addTimesheet').hide('slow');
            $('.timesheet_back').show('slow');
        });
    })
</script>

