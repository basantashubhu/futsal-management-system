<!-- BEGIN: Subheader -->
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Courts
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="#" data-route="courts" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Courts
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <button type="button" class="btn m-btn btn-primary m-btn--pill"
            data-modal-route="courts/create">
            <i class="la la-plus"></i> Add Court
        </button>
    </div>
</div>
<!-- END: Subheader -->

<div class="m-content">
    <div class="m_calendar_time_Changable" id="m_portlet" style="background-color: #f2f3f8">
        <div class="m-portlet__body">
            <div class="ts-tab-holder m-portlet m-portlet--mobile with-border"
                style="padding-bottom: 30px; padding: 20px">
                <div class="m-form m-form--label-align-right m--margin-top-bottom">
                    <div class="filters row no-gutters">
                        <div class="col-lg-12">
                            <div class="m-portlet no-m-i m-portlet--bordered-semi">
                                <div class="m-portlet__body pb-2">
                                    <div
                                        class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                        {{-- Advance Form --}}
                                        {{-- <div class="float-left" style="width: 50px;"> --}}
                                        {{-- @include('default.pages.note.includes.advanceForm') --}}
                                        {{-- </div> --}}

                                        <div class="float-left" style="width: calc(100% - 50px);">
                                            <form class="form form-inline" id="CourtFilterForm">
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Title">
                                                                Date&nbsp;Range
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <select name="date_type"
                                                                class="form-control date-type-select" id="DateType"
                                                                title="Date Type" data-style="btn-default">
                                                                <option value="created_at" selected>
                                                                    Created</option>
                                                                <option value="reminder_timestamp">
                                                                    Reminder
                                                                    Date</option>
                                                                <option value="todo_timestamp">Todo
                                                                    Date</option>
                                                                <option value="note_date">Note
                                                                    Date</option>
                                                            </select>
                                                            <input name="date_range" type="text"
                                                                class="form-control btn-redius form-control-sm m-input"
                                                                id="dateRange" />
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>

                                                <div class="col-auto mt-3 mb-3">
                                                    <button type="button" data-route="courts" title="Reset Search"
                                                        onclick="resetCookie('courts_quick', 'courts_advanced')"
                                                        class="m-portlet__nav-link btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
                                                    <button class="searchNotesBtn" data-target="CourtFilterForm"
                                                        style="display: none;"></button>
                                                </div>

                                                <!-- export report -->
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-btn-group m-btn-group--pill btn-group" role="group"
                                                        aria-label="Button group with nested dropdown">
                                                        <div class="m-btn-group btn-group" role="group">
                                                            <button id="ietableExport" type="button" title="Export As"
                                                                data-tooltip=""
                                                                class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="la la-bars"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="ietableExport"
                                                                x-placement="bottom-start">
                                                                <button type="button"
                                                                    class="c-p dropdown-item noteExporter"
                                                                    data-export-type="csv">
                                                                    CSV
                                                                </button>
                                                                <button type="button"
                                                                    class="c-p dropdown-item noteExporter"
                                                                    data-export-type="json">
                                                                    JSON
                                                                </button>
                                                                <button type="button"
                                                                    class="c-p dropdown-item noteExporter"
                                                                    data-export-type="pdf">
                                                                    PDF
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- datatable --}}
                <div id="courtsTable"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function(Form) {

        Form.find('select').selectpicker({
            width : '150px'
        });

        Form.find('#dateRange').daterangepicker({
            startDate : moment().startOf('month'),
            endDate : moment().endOf('month'),
            ranges : {
                "Last 7 Days" : [moment().subtract(7, 'days'), moment()],
                "This Month" : [moment().startOf('month'), moment().endOf('month')],
                "Last 3 Months" : [moment().subtract(3, 'month').startOf('month'), moment().endOf('month')],
            }
        });

        master_table('#courtsTable').init({
            url : 'courts/getData',
            columns: [
                { 
                    field: 'id', title : '#', sortable : false, width : 30,
                    selector : { class : 'selected-courts' }
                }
            ]
        });

    }( $('#CourtFilterForm') ));
</script>