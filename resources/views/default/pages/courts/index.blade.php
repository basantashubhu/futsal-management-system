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
            data-modal-route="courts/create" data-modal-callback="reloadCourts">
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

                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-bottom">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="Search..."
                                               id="generalSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <button data-modal-route="addNP"
                                class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--pill">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>
                                        Add Application
                                    </span>
                                </span>
                            </button>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div> --}}
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
                },
                {
                    field: 'name', title: 'Name', width: 150,
                    template: ({ name }) => `<span title="${ name }">${ name }</span>`
                },
                {
                    field: 'phone', title: 'Phone', width: 100
                },
                {
                    field: 'email', title: 'Email', width: 100,
                    template: ({ email }) => `<span title="${ email }">${ email }</span>`
                },
                {
                    field: 'website', title: 'Website', width: 150,
                    template: ({ website }) => `<span title="${ website }">${ website }</span>`
                },
                {
                    field: 'add1', title: 'Location', width: 150,
                    template({ add1, city }) {
                        return `${ add1 }, ${ city }`;
                    }
                },
                {
                    field: 'action', title: 'Action', width: 50, sortable: false,
                    template({ id }) {
                        return (
                            `<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" 
                                data-modal-route="/courts/${ id }/edit" data-modal-callback="reloadCourts">
                                <i class="la la-eye"></i>
                            </button>`
                        );
                    }
                }
            ],
            searchfield: $('#generalSearch')
        });

    }( $('#CourtFilterForm') ));

    function reloadCourts() {
        $('#courtsTable').mDatatable('reload');
    }
</script>