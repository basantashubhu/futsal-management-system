<?php

?>
<style>
    body.modal-open {overflow: hidden !important;}
    body.modal-open .form-control-sm{padding: 0.25rem 0.75rem !important;}
    body .bootstrap-select.btn-group > .btn-redius, .btn-redius {
        border-radius: 0 20px 20px 0 !important;
    }
</style>
<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Stipend Period List
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <form id="StipendPeriodList" class="m-form global-filter">
                <div class="m-portlet mb-0">
                    <div class="m-portlet__body pb-0 toolbar">
                        <div class="row px-0">
                            <div class="col-auto pl-0">
                                <div class="m-form__group m-form__group--inline pill-style mb-0">
                                    <div class="m-form__label left">
                                        <label class="m-label m-label--single" for="periodStatusSelect">
                                            Status
                                        </label>
                                    </div>
                                    <div class="m-form__control custom-selecter-btn">
                                        <select name="pay_stat" data-style="btn-redius" id="periodStatusSelect">
                                            <option value="New" selected>New</option>
                                            <option value="Open">Open</option>
                                            <option value="Posted">Closed<option>
                                            {{--<option value="Posted">Posted</option>--}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="m-form__group m-form__group--inline pill-style mb-0">
                                    <div class="m-form__label left">
                                        <label class="m-label m-label--single" for="generalSearchPeriods">
                                            Date
                                        </label>
                                    </div>
                                    <div class="m-form__control custom-selecter-btn">
                                        <input type="text" name="end_date" id="generalSearchPeriods" class="form-control form-control-sm btn-redius">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="stipendPeriodListTableC" {{--class="scrollbar-light-blue" style="max-height: 400px;overflow-y: auto;"--}}></div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-success m-btn--pill float-right" id="savePeriodChanges">
                Save
            </button>
        </div>
    </div>
</div>

<script>
    $(function (targetTable) {
        window.change_status_to = 'New';
        let finalLength;
        let firstLoad = false;
        targetTable.off('m-datatable--on-ajax-done').on('m-datatable--on-ajax-done', function (e, data) {
            finalLength = data.length - 1;
            firstLoad = true;
        });

        const columns = [
            {title: 'Period #', field: 'period_no', width: 100, textAlign: 'center'},
            {title: 'Period Date', field: 'end_date', width: 100},
            {title: 'Status', field: 'pay_stat', width: 100,

                template({pay_stat}){
                    if(pay_stat === 'Posted') return "Closed";
                    return pay_stat;
                }

            },
            {title: 'Open', field: '#', width: 70, sortable: false, textAlign: 'center',
                template: function ({id}) {
                    return `<label class="m-checkbox m-checkbox--single checkbox-navy m-checkbox--solid no-m inputTarget">
                        <input type="checkbox" class="target${id}" value="${id}">
                        <span class="checkbox-target"></span>
                    </label>`;
                }
            }
        ];

        let StipendDataTable = targetTable.mDatatable({
            data: { type: 'remote', source: {read: {url: '/stipendPeriod/getData', method: 'GET',
                        params: (function (init) {
                            const pay_stat = $('#periodStatusSelect').val();
                            const date = new Date();
                            const end_date = `${date.getFullYear()}-01-01 - ${date.getFullYear()}-12-31`;
                            return init  ? {} : {query: {pay_stat, end_date}};
                        })(firstLoad)
                    }},
                pageSize: 10, saveState: true, serverPaging: false, serverFiltering: true, serverSorting: true
            },
            rows:{
                autohide:true,
                afterTemplate: function (row, {pay_stat}, i) {
                    if (i === finalLength) {
                        targetTable.find('table tbody').addClass('scrollbar-light-blue')
                        .attr('style', 'max-height: 400px;overflow-y: auto;');
                    }
                }
            },
            pagination: false, // no pagination
            sortable: true,
            columns
        });

        // input tags
        $('#periodStatusSelect').selectpicker({width: '100px'})
        .on('change', function () {
            const col_name = {"New": "Open", "Open": "Pending", "Posted" : "Open"};
            const key = this.value;
            if (key in col_name) {
                StipendDataTable.find('thead tr th:last-child span').text(col_name[key]);
                window.change_status_to = key;
            }
            StipendDataTable.search(key, this.name);
        });
        $('#generalSearchPeriods').daterangepicker({
            startDate: new Date('{{ date('Y-4-1') }}'),
            endDate: new Date('{{ date('Y-12-t') }}'),
        }).on('change', function () {
            StipendDataTable.search(this.value, this.name);
        });

        $('#savePeriodChanges').off('click').on('click', function (e) {
            const col_name = {"New": "Open", "Open": "New", "Posted" : "Open"};
            const key = window.change_status_to;

            const inputs = $('.inputTarget input').filter(function (input) {
                return this.checked;
            });

            const stipendP = inputs.map(function () {
                return {stipend_id: this.value, pay_stat: col_name[key]};
            }).toArray();

            sendAjax({
                url: 'stipendPeriod/saveList', method: 'post', loader: true,
                data: {stipendP},
                success: function () {
                    processModal();
                    removeFormLoader();
                    toastr.success('Stipend period updated successfully.');
                },
                error: function (err) {
                    toastr.error('Something went wrong.');
                }
            })
        });
    }( $('#stipendPeriodListTableC') ));
</script>