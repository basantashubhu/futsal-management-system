<style>
    .m-widget14 {
        padding-top: 0;
        padding-bottom: 1rem;
    }
    .w-200 {
        width: 170px;
    }
    .select2specials {
        margin-right: 20px;
        min-width: 130px;
    }
    .filters .m-portlet{
        box-shadow: none;
    }
    .filters .m-portlet__body{
        border: 1px solid lightgray;
        border-radius: 10px;
    }
</style>
<div class="m-content" id="note_index">
    <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding pb-0">
            <div class="row m-row--no-padding m-row--col-separator-xl justify-content-center">
                <div class="col-xl-4  col-lg-8 col-md-6">

                    <div class="m-widget14 chart-container">
                        <!--begin:: Widgets/Stats2-1 -->
                        <?php 
                            $total_notes = $notes->count();
                            $completed_notes = $notes->where('is_completed', 1)->count();
                        ?>
                        <canvas class="m-widget1" id="doughnutChartNote"></canvas>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                </div>

                {{-- middle section --}}
                <div class="col-xl-4 col-lg-6 col-md-12 m-form">
                    <div class="m-widget14">
                        <div class="row">
                            <div class="col">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                        Todo
                                    </h3>
                                    <span class="m-widget14__desc">
                                        {{ date('m/d/Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col m--align-right ">
                                <div class="m-form__group m-form__group--inline  pill-style mt15 mb-3">
                                    <div class="m-form__control custom-selecter-btn">
                                        <select name="date_type" class="form-control date-type-select" title="Date Type" data-style="left btn-default">
                                            <option value="created_at">Created</option>
                                            <option value="reminder_timestamp">Reminder Date</option>
                                            <option value="todo_timestamp" selected>Todo Date</option>
                                            <option value="note_date">Note Date</option>
                                        </select>
                                    </div>
                                    <input data-target="#notes-todo" data-url="/notes/todo/today" type="text" class="form-control btn-redius dateRangePicker w-200" name="date">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between px-15">
                            <div><label class="font-weight-bold">Title</label></div>
                            <div class="pr-10"><label class="font-weight-bold"></label></div>
                        </div>
                        <div id="notes-todo" class="scrollbar-navy" style="height: 167px;overflow-y:auto;overflow-x:hidden;">
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-12 m-form">
                    <div class="m-widget14">
                        <div class="row">
                            <div class="col">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                        Reminder
                                    </h3>
                                    <span class="m-widget14__desc">
                                        {{ date('m/d/Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col m--align-right ">
                                <div class="m-form__group m-form__group--inline  pill-style mt15 mb-3">
                                    <div class="m-form__control custom-selecter-btn">
                                        <select name="date_type" class="form-control date-type-select" title="Date Type" data-style="left btn-default">
                                            <option value="created_at">Created</option>
                                            <option value="reminder_timestamp" selected>Reminder Date</option>
                                            <option value="todo_timestamp">Todo Date</option>
                                            <option value="note_date">Note Date</option>
                                        </select>
                                    </div>
                                    <input type="text" data-target="#notes-reminder" data-url="/notes/reminders/today" class="form-control btn-redius dateRangePicker w-200" name="date">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div style="flex-basis: 120px;"><label class="font-weight-bold">Created Date</label></div>
                            <div class="d-flex justify-content-between" style="flex: 1;">
                                <div><label class="font-weight-bold">Title</label></div>
                                <div class="pr-10"><label class="font-weight-bold"></label></div>
                            </div>
                        </div>
                        <div id="notes-reminder" class="scrollbar-navy" style="height: 167px;overflow-y:auto;overflow-x:hidden;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet m-portlet--mobile with-border">
            <div class="m-portlet__body">
                <!--begin: Search Form -->

                <div class="m-form m-form--label-align-right m--margin-top-bottom">
                    <div class="filters row no-gutters">
                        <div class="col-lg-12">
                            <div class="m-portlet no-m-i m-portlet--bordered-semi">
                                <div class="m-portlet__body pb-2">
                                    <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">

                                        {{-- Advance Form --}}
                                        <div class="float-left" style="width: 50px;">
                                            @include('default.pages.note.includes.advanceForm')
                                        </div>
                                        
                                        <div class="float-left" style="width: calc(100% - 50px);">
                                            <form class="form form-inline" id="NotesFilterForm">
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Title">
                                                                Date&nbsp;Range
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <select name="date_type" class="form-control date-type-select" id="DateType" title="Date Type" data-style="btn-default">
                                                                <option value="created_at" selected>Created</option>
                                                                <option value="reminder_timestamp">Reminder Date</option>
                                                                <option value="todo_timestamp">Todo Date</option>
                                                                <option value="note_date">Note Date</option>
                                                            </select>
                                                            <input name="date_range" type="text" class="form-control btn-redius form-control-sm m-input" id="dateRange">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
    
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="note_type">
                                                                Note&nbsp;Type
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <select name="note_type" id="note_type" class="form-control csSelect" title="Choose" 
                                                            data-url="lookup/getData/note_type" data-style="btn-redius select2specials" multiple>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
    
                                                {{-- <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Volunteer">
                                                                Volunteer
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <input class="form-control m-input form-control-sm btn-redius"
                                                                    type="text" value="" name="volunteer" id="Volunteer">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Site">
                                                                Site
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <input class="form-control m-input form-control-sm btn-redius"
                                                                    type="text" value="" name="site" id="Site">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div> --}}
    
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Priority">
                                                                Priority
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn" >
                                                            <select name="priority" data-url="lookup/getData/note_priority" class="form-control csSelect" multiple title="Choose" data-style="btn-redius select2specials"></select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto mt-3 mb-3">
                                                    <div class="m-form__group m-form__group--inline  pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single" for="Status">
                                                                Status
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn" >
                                                            <select name="status" data-url="lookup/getData/note_status" class="form-control csSelect" multiple title="Choose" data-style="btn-redius select2specials"></select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-auto mt-3 mb-3">
                                                    <button type="button" data-route="note" title="Reset Search"
                                                            onclick="resetCookie('notes_quick', 'notes_advanced')"
                                                            class="m-portlet__nav-link btn btn-sm btn-outline-primary  m-btn m-btn--outline-2x m-btn--icon m-btn--icon-only m-btn--pill">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
                                                    <button class="searchNotesBtn" data-target="NotesFilterForm"
                                                            style="display: none;"></button>
                                                </div>
    
                                                <!-- export report -->
                                                <div class="col-auto mt-3 mb-3">
    
                                                    <div class="m-btn-group m-btn-group--pill btn-group"
                                                        role="group"
                                                        aria-label="Button group with nested dropdown">
                                                        <div class="m-btn-group btn-group" role="group">
                                                            <button id="ietableExport" type="button" title="Export As" data-tooltip=""
                                                                    class="btn btn-warning btn-sm m-btn m-btn--pill-last br-60 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="la la-bars"></i>
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="ietableExport"
                                                                x-placement="bottom-start">
                                                                <button type="button" class="c-p dropdown-item noteExporter" data-export-type="csv">
                                                                    CSV
                                                                </button>
                                                                <button type="button" class="c-p dropdown-item noteExporter" data-export-type="json">
                                                                    JSON
                                                                </button>
                                                                <button type="button" class="c-p dropdown-item noteExporter" data-export-type="pdf">
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
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="note_datatable" id="organization_datatable11"></div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


   
    $(function () {
        
        let last_count;
        $('#organization_datatable11').on('m-datatable--on-ajax-done', function(e, data) {
            last_count = data.length - 1;
        });

        var datatable = $('#organization_datatable11').mDatatable({
            data: {
                type: 'remote', source: {read: {url: '/note/getAll', method: 'GET'}},
                pageSize: 50, saveState: false, serverPaging: true, serverFiltering: true, serverSorting: true
            },
            sortable: true,
            pagination: true,
            toolbar: {items: {pagination: {pageSizeSelect: [10, 20, 30, 50, 100]}}},
            rows: { autoHide: true },
            columns: [
                {
                    field: 'id', title: '', sortable: false, width: 0, selector: {
                        class: 'note-checkbox d-none'
                    }
                },
                {field: 'created_at', title: 'Created Date', width: 100, sortable: 'desc',
                    template: ({created_at}) => moment(created_at).format(std.config.date_format)
                },
                {field: 'title', title: 'Title', width: 200},
                {field: 'priority', title: 'Priority', width: 80},
                // {field: 'note_date', title: 'Note Date', width: 100,
                //     template: ({note_date}) => note_date?moment(note_date).format(std.config.date_format):''
                // },
                {field: 'todo_timestamp', title: 'Todo Date', width: 100,
                    template: ({todo_timestamp}) => todo_timestamp?moment(todo_timestamp, 'YYYY-MM-DD HH:mm:ss').format(std.config.date_format):''
                },
                {field: 'reminder_timestamp', title: 'Reminder Date', width: 100,
                    template: ({reminder_timestamp}) => reminder_timestamp?moment(reminder_timestamp, 'YYYY-MM-DD HH:mm:ss').format(std.config.date_format):''
                },
                {field: 'created_user', title: 'Created User', width: 130},
                {field: 'status', title: 'Status', sortable: 'desc', width: 80},
                {
                    field: 'action', title: 'Action', width: 100,
                    template: function (row) {
                        return '<!--button class="m-portlet__nav-link note-view btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-id="' + row.id + '">' +
                            '<i class="la la-eye"></i>' +
                            '</button--><button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' data-modal-route="/note/edit/' + row.id + '">' +
                            '<i class="la la-edit"></i>' +
                            '</button><button class="m-portlet__nav-link btn m-btn m-btn-danger m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' data-modal-route="/note/delete/' + row.id + '">' +
                            '<i class="la la-trash"></i>' +
                            '</button>';
                    }
                }]
        });

        $(document).off('click', '.noteExporter').on('click', '.noteExporter', function() {
            const records = $('.note-checkbox:not(.m-checkbox--all) input[type="checkbox"]').get().map(x => x.value);
            const type = $(this).attr('data-export-type');
            window.open('notes/export/'+ type +'?ids='+ records.join(','));
        });

        $('#Title').off('blur').on('blur', function (e) {
            const name = this.name, value = this.value;
            put_filter('notes_quick', {name, value});
            resetCookie('notes_advanced');
            $('#noteAdvanceFilterSearch').css('border-color', '#716aca');
            datatable.search();
        });

        /** @description init all selectpickers */
        $('select.csSelect').each(function() {
            const element = $(this);
            element.selectpicker({
                doneButton : "true",
                doneButtonText : "Apply"
            }).on('hide.bs.select', function(){
                resetCookie('notes_advanced');
                $('#noteAdvanceFilterSearch').css('border-color', '#716aca');
                $timeout = typeof $timeout !== 'undefined' ? clearTimeout($timeout) : undefined;
                $timeout = setTimeout(lookupSelectSearch, 800, this);
            });

            if(!element.attr('data-url')) {
                return console.log(element)
            }
            sendAjax(element.attr('data-url'), function(results) {
                results = results.map(x => `<option value="${ x.value }">${ x.value }</option>`);
                const cookie = getCookie('notes_quick') || '[]';
                const coookieData = JSON.parse(cookie);
                element.html(results).selectpicker('refresh');;
                loadCookie('notes_quick', '.searchNotesBtn');
                loadCookie('notes_advanced', '.searchNotesBtn');
                $('select.bsSelect').change();
            });
        });

        $('#User').selectpicker('destroy').select2({
            width: '100%', placeholder: 'Choose', dropdownParent: $('#noteAdvancedForm'), allowClear: true,
            ajax: {
                delay: 500, url: '/user/userList', 
                processResults: results => ({results})
            }
        });

        $('.btnNoteAdvSearch').off('click').on('click', function (e) {
            const form = document.getElementById($(this).attr('data-target'));
            const data = $(form).serializeArray().filter(x => x.value.trim().length > 0);
            resetCookie('notes_quick', 'notes_advanced');
            setCookie('notes_advanced', JSON.stringify(data));
            datatable.search();
            $('#noteAdvanceFilterSearch').css('border-color', 'red');
        });

        if (getCookie('notes_advanced')) {
            $('#noteAdvanceFilterSearch').css('border-color', 'red');
        }

        // partials
        $('#notes-todo').load('/notes/todo/today');
        $('#notes-reminder').load('/notes/reminders/today');

        $(document).off('click', '.doneTodo').on('click', '.doneTodo', function(e) {
            $.post("todo/completed/"+ $(this).attr('data-id')).then(response => {
                 $('#notes-todo').load('/notes/todo/today');
                 toastr.options.preventDuplicates = true;
                 toastr.success('Note status changed to done.');
            });
        });

        $('.date-type-select').selectpicker({
            width: '150px'
        }).selectpicker('setWidth', '150px');

        $('.dateRangePicker').daterangepicker({
            opens: 'left'
        }).on('change', function (e) {
            const self = $(this);
            const filter = self.closest('.m-form__group');
            const data = {
                date_type: filter.find('.date-type-select').selectpicker('val'),
                date: this.value
            }
            const url = self.attr('data-url');
            $(self.attr('data-target')).load([url, $.param(data)].join('?'));
        });

        const rangeOption = {
            format: 'mm/dd/yyyy',
            opens: 'right',
            ranges: {
                "Today": [moment().startOf('day'), moment().endOf('day')],
                "This Week": [moment().startOf('week'), moment().endOf('week')],
                "Last Week": [moment().startOf('week').subtract(1, 'weeks'), moment().endOf('week').subtract(1, 'weeks')],
                "This Month": [moment().startOf('month'), moment().endOf('month')],
            }
        };
        if (hasCooke('notes_quick', 'date_range') || hasCooke('notes_advanced', 'date_range')) {
            const cookie = getCookie('notes_quick') || getCookie('notes_advanced') || '[]';
            const rangeData = JSON.parse(cookie);
            const range = rangeData.filter(x => x.name === 'date_range').map(x => moment(x.value, 'MM/DD/YYYY').format('YYYY-MM-DD'));
            const type = rangeData.filter(x => x.name === 'date_type').map(x => x.value);
            for(const dateRange of range) {
                const [start, end] = dateRange.split(' - ');
                Object.assign(rangeOption, {start, end});
            }
            for (const date_type of type) {
                $('#DateType').selectpicker('val', date_type);
            }
        }
        $('#dateRange').daterangepicker(rangeOption).on('change', function () {
            const name = 'date_range', value = this.value;
            if(!value) {
                deleteCookieOf('notes_quick', name);
                deleteCookieOf('notes_quick', 'date_type');
            } else {
                put_filter('notes_quick', {name, value});
                put_filter('notes_quick', {name: 'date_type', value: $('#DateType').selectpicker('val')});
            }
            resetCookie('notes_advanced');
            $('#noteAdvanceFilterSearch').css('border-color', '#716aca');
            $('#organization_datatable11').mDatatable('search');
        });

    });

    function lookupSelectSearch(input) {
        const name = input.name, value = $(input).val();
        if (!value || !value.length) deleteCookieOf('notes_quick', name);
        else put_filter('notes_quick', {name, value});
        $('#organization_datatable11').mDatatable('search');
    }


    $(function() {
        if(!{{$total_notes}}){

            $('#doughnutChartNote').closest('.chart-container').empty().html(`
                <div class="col text-center">
                    <img src="{{'images/nodata.png'}}" style="width: 250px; opacity:0.2;" alt="No Data Available" >
                    <h2 class="mt-4" style="opacity: 0.2">No Data Available</h2>
                </div>
            `);

        }else{
            const ctx = $(document.getElementById("doughnutChartNote")).empty();
            new Chart(ctx, {
                "type": "doughnut",
                "data": {
                    "labels": ["Not Done", "Done"],
                    "datasets": [{
                        "data": [{{ $total_notes - $completed_notes }}, {{ $completed_notes }}],
                        "backgroundColor": ["#00c5dc", "rgb(255, 99, 132)"]
                    }]
                },
                "options": {
                    "legend": {
                        "position": "right"
                    }
                }
            });

            ctx.css('height', ctx.outerWidth() * 0.53);
        }
        

        loadCookie('notes_quick', '.searchNotesBtn');
        loadCookie('notes_advanced', '.btnNoteAdvSearch');
    });
</script>