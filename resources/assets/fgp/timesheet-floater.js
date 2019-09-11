
/**
 * Flaoter js
 * 
 * */

class Floater {
    constructor(period, site) {
        this.floater = { period, site };
        this.loadModal();
    }

    loadModal() {
        const url = `time-sheet/create-floater/${this.floater.period}/${this.floater.site}`;
        showModal(url);
    }

    static DataTable(container, options) {
        const Floaters = [];

        let lastCount = 0;
        const default_options = {
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'get',
                        url: '/volunteers/all',
                    }
                },
                pageSize: options.pageSize || 50, serverFiltering: true, serverSorting: true, serverPaging: true,
                saveState: true
            },
            pagination: options.hasOwnProperty('pagination') ? options.pagination : true,
            sortable: true,
            /* toolbar: {
                item: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            }, */
            layout: {
                height: 400,
            },
            rows: {
                autoHide: false,
                afterTemplate(row, data, index) {
                    if (index === lastCount) {
                        $(container).find('tbody').addClass('scrollbar-navy scrollbar-y').css({ height: options.height });
                    }
                    if (Floaters.indexOf(data.id) > 0) {
                        setTimeout(function () {
                            row.find('.selected-floater :input').prop('checked', true);
                            $(container).find('tbody').prepend(row);
                        }, 500);
                    }
                }
            },
            columns: [
                {
                    title: '#', field: 'id', width: 30, sortable: false,
                    selector: { class: 'selected-floater checkbox-navy' }
                },
                {
                    title: 'Name', field: 'full_name', width: 150, sortable: 'asc',
                    template({ full_name }) {
                        return `<span title="${full_name}">${full_name}</span>`;
                    }
                },
                { title: 'Email', field: 'email', width: 120 },
                { title: 'County', field: 'county', width: 100 },
                { title: 'City', field: 'city', width: 100 },
            ]
        };

        $(container).on('m-datatable--on-ajax-done', function (e, data) {
            lastCount = data.length - 1;
        });

        const fDataTable = $(container).mDatatable(default_options);

        if (options.quickFilterForm) {
            $(options.quickFilterForm).off('input').on('input', function () {
                const data = $(this).serializeArray().filter(x => !!x.value);
                setCookie('floaterQuick', JSON.stringify(data));
                fDataTable.search();
            });
        }


        $(document).on('change', '.selected-floater:not(.m-checkbox--all) :input', function (e) {
            const vol_id = Number(this.value);
            let index = -1;
            if (this.checked && Floaters.indexOf(vol_id) < 0) {
                Floaters.push(vol_id);
            } else if (!this.checked && (index = Floaters.indexOf(vol_id)) > -1) {
                Floaters.splice(index, 1);
            }
        });

        $(document).on('change', '.selected-floater.m-checkbox--all :input', function (e) {
            const value = this.checked;
            $('.selected-floater:not(.m-checkbox--all) :input').each(function () {
                $(this).prop('checked', value).change();
            });
        });

        if (options.addFloater) {
            $(options.addFloater).off('click').on('click', e => {
                let data = Floaters.map(x => ({ name: 'vol_ids[]', value: x }));
                data = data.concat($('#floater-info').serializeArray());
                sendAjax({
                    url: '/time-sheets/floater-add',
                    method: 'post', data
                }, function (response) {
                    const site_id = $('#floater-site').val();
                    toastr.success(response.message);
                    processModal();
                    Floater.loadFloater(site_id);
                }, function (err) {
                    if (err.status === 422) {
                        toastr.error(err.responseJSON.message);
                    }
                });
            });
        }
    }

    static loadFloater(site_id) {
        sendAjax('time-sheets/load-floater/' + site_id, function (results) {
            const container = $('.vol-lists-item.ofSite' + site_id);
            container.find('li.floater-vol').remove();
            const floaters = results.map(x => {
                return `<li style="display: flex; align-items: center; justify-content: space-between;" 
                title="${ [x.first_name, x.middle_name || '', x.last_name].join(' ')}">
                    <p style="display: flex; margin-bottom: 0">
                      <label class="m-checkbox">
                          <input class="selected_volunteer" type="checkbox"  value="${ x.vol_id}"> 
                          <span></span>
                      </label>
                      <i class="flaticon-user m-r-5"></i>${ [x.first_name, x.middle_name || '', x.last_name].join(' ')}
                    </p>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-light" title="Floater"><i class="fa fa-facebook text-muted"></i></span> &nbsp; &nbsp;
                        <span class="badge badge-pill badge-light" title="No default template"><i class="fa fa-exclamation" style="color: #dc3545"></i></span>
                    </div>

                </li>`;
            });
            if (container.find('.normal-vol').length) {
                container.find('.normal-vol:last').after(floaters);
            } else {
                container.find('li:not(.create-floater)').remove();
                container.prepend(floaters);
            }

            $('.vol-ts-details ul.vol-lists-item li').off('click')
                .on('click', vol_list_action);
        });
    }
}
