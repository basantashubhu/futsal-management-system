<div id="Volunteers" class="tab-pane">
    <div class="mb-0">
        <div class="m-portlet__body toolbar">
            <div class="m-portlet__body global-filter row no-gutters px-0 pt-0">
                <div class="col-12">
                    <form class="m-form form-inline row" id="userVolunteersQuick" >
                            @foreach(['full_name', 'region', 'county', 'city'] as $key)
                            <div class="col-auto m-b-10">
                                <div class="m-form__group m-form__group--inline pill-style">
                                    <div class="m-form__label left">
                                        <label class="m-label m-label--single" for="vol_{{ $key }}">
                                            {{ $key == 'full_name' ? 'Name' : ucfirst($key) }}
                                        </label>
                                    </div>
                                    <div class="m-form__control custom-selecter-btn">
                                        <input type="text" name="{{ $key }}" id="vol_{{ $key }}" class="btn-redius form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            @endforeach
                            <div class="col-auto m-b-10 ml-auto">
                                <button type="button" class="btn m-btn btn-brand m-btn--icon m-btn--pill"
                                data-modal-route="/users/transfer/volunteer">
                                    <i class="la la-reorder"></i> Transfer
                                </button>
                            </div>
                    </form>
                </div>
            </div>
            <table id="volunteer_list"></table>
        </div>
    </div>
</div>

<script>
    $(function(Table) {
        let Volunteers = [];

        let lastIndex;
        Table.off('m-datatable--on-ajax-done').on('m-datatable--on-ajax-done', (e, data) => {
            lastIndex = data.length - 1;
        });

        const DataTable = Table.mDatatable({
            data: { 
                type: 'remote',
                source: { read: { url: '/users/{{ $client->user_id }}/volunteers/getData', method: 'get' } },
                pageSize: 50, saveState: false, serverSorting: true, serverPaging: true, serverFiltering: true
            },
            pagination: true, sortable: true,
            /* search: {
                input: $('#vol_full_name')
            }, */
            rows: {
                afterTemplate(row, data, index) {
                    setTimeout(function(row) {
                        row.find('.checked-volunteer :input').each((i, input) => {
                            const val = Number(input.value);
                            const checked =  Volunteers.indexOf(val) > -1;
                            if(checked) {
                                $(input).prop('checked', checked);
                                Table.find('tbody').prepend(row);
                            }
                        });
                    }, 500, row);
                }
            },
            columns: [
                { title: '#', field: 'id', selector: { class: 'checked-volunteer checkbox-navy' }, sortable: false, width: 30 },
                { title: 'Volunteer', field: 'full_name', width: 150 },
                { title: 'Region', field: 'region', width: 100 },
                { title: 'County', field: 'county', width: 100 },
                { title: 'City', field: 'city', width: 100 },
                /* { title: 'Ations', field: 'actions', width: 100,
                    template({id}) {
                        return `
                        <button type="button" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-id="${id}"> <i class="la la-eye"></i>
                        </button>`;
                    }
                } */
            ]
        });

        Table.off('m-datatable--on-check').on('m-datatable--on-check', (e, arg) => {
            for(let id of arg) {
                id = Number(id);
                const copy = [... Volunteers];
                const index = copy.indexOf(id);
                if(index > -1) {
                    delete copy[index];
                    Volunteers = [... copy.filter(x => !!x)];
                }
            }
            console.log(Volunteers)
        });

        Table.off('m-datatable--on-uncheck').on('m-datatable--on-uncheck', (e, arg) => {
            arg = arg.map(x => Number(x));
            const set = new Set([...Volunteers, ...arg]);
            Volunteers = [... set];
            console.log(Volunteers)
        });

        $(document).off('click', '.checked-volunteer.m-checkbox--all').on('click', '.checked-volunteer.m-checkbox--all', e => {
            const target = $(e.target || e.srcElement);
            if(!target.is('input')) return;
            if(!target.prop('checked')) {
                Volunteers = [];
            } else {
                const values = $('.checked-volunteer:not(.m-checkbox--all) :input').toArray().map(x => Number(x.value));
                const set = new Set([...Volunteers, ...values]);
                Volunteers = [... set];
            }
        });

        $(document).off('click', '#TransferProceed').on('click', '#TransferProceed', function(e) {
            const supervisor = $('#VolTransferForm #Supervisor').val();
            toastr.options.preventDuplicates = true;
            if(!Number(supervisor)) {
                return toastr.error('Choose a supervisor.');
            }
            sendAjax({
                url: '/users/'+ supervisor +'/tansfer/volunteers', method: 'post',
                data: {volunteers: Volunteers}
            }, ({message}) => {
                toastr.success(message);
                processModal();
            }, ({status, responseJSON}) => {
                if(status !== 422) return toastr.error('Volunteer transfer unsuccessful.');
                const errors = Object.entries(responseJSON.errors).map(([key, value]) => value);
                toastr.error(errors.join('<br/>'));
            });
        });

        $('#userVolunteersQuick').off('input', 'input').on('input', 'input', function() {
            DataTable.search(this.value, this.name);
        });

    }( $('#volunteer_list') ));
</script>