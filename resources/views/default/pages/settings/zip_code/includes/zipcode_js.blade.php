<!-- Zip code js part -->
<script type="text/javascript">
    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('.zipcode_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/zip_code/all',
                            method:'GET'
                        },
                    },
                    pageSize: 10,
                    saveState: false,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // column sorting
                sortable: true,

                pagination: true,

                toolbar: {
                    // toolbar items
                    items: {
                        // pagination
                        pagination: {
                            // page size select
                            pageSizeSelect: [10, 20, 30, 50, 100],
                        },
                    },
                },

                search: {
                    input: $('#generalSearch'),
                },

                rows: {
                    // auto hide columns, if rows overflow
                    autoHide: true,
                    beforeTemplate: function(row, data, index){
                        row.find('td:eq(0)').addClass('m-datatable__toggle--detail');
                    },
                },

                // columns definition
                columns: [
                    {
                        field: "id",
                        title: "#",
                        sortable: false, // disable sort for this column
                        width: 40,
                        selector: {class: 'm-checkbox--solid m-checkbox--brand checkedToDelete'}
                    },
                    {
                        field: 'zip_code',
                        title: 'Zip Code',
                        sortable: 'asc'
                    }, {
                        field: 'city',
                        title: 'City',
                    }, {
                        field: 'state',
                        title: 'State',
                        template:function (row) {
                            if(row.state)
                                return row.state.toUpperCase();
                            else
                                return '-';
                        }
                    },
                    {
                        field: 'county',
                        title: 'County',
                    }, {
                        field: 'action',
                        title: 'Action',
                        template: function(row){
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/zip_code/edit/'+row.id+'">\
                                    <i class="la la-edit"></i></button>';
                        },
                    },]
            });

        };

        return {
            // public functions
            init: function () {
                demo();
            },
        };
    }();

    jQuery(document).ready(function () {
        DatatableAutoColumnHideDemo.init();
    });

    $(document).off('change', '.checkedToDelete:not(.m-checkbox--all):not([disabled]) input[type=checkbox]')
            .on('change', '.checkedToDelete:not(.m-checkbox--all):not([disabled]) input[type=checkbox]', function (e) {
                // console.log($(this));
            var self = $(this);
            self.removeAttr("name", "id[]");
            self.removeClass("demoChecked1");

            if (self.prop('checked')) {
                self.addClass("demoChecked1");
                self.attr('name', 'id[]');
            }

            if($('.demoChecked1').length > 0){
                $('#massDeleteZip').show();
            }else{
                $('#massDeleteZip').hide();
            }

    });

    $(document).off('change', '.m-checkbox--all.checkedToDelete:not([disabled]) input[type=checkbox]')
    .on('change', '.m-checkbox--all.checkedToDelete:not([disabled]) input[type=checkbox]', function (e) {
        var self = $(this);
        $('.demoChecked1').removeClass('demoChecked1');
        if ($(this).prop('checked')) {
            $('#massDeleteZip').show();
            $('.checkedToDelete:not(.m-checkbox--all) input[type=checkbox]').trigger('change');
        }else{
            $('#massDeleteZip').hide();
        }
    });


    $(document).off('click', '#massDeleteZip').on('click', '#massDeleteZip', function (e) {
        e.preventDefault();
        var d = $('#massDelete').find('.demoChecked1');
        if(d.length > 0){

            var request = {
                url: '/generateDeletingData',
                method: 'post',
                form: $(this).attr('data-target')
            };
            addFormLoader();
            ajaxRequest(request, function (response) {
                $('#appendZip').empty();
                $.each(response.data, function(index, value){
                    var t = `
                        <tr>
                            <td><input type="hidden" name="id[]" value="`+value.id+`"></input>`+value.city+`</td>
                            <td>`+value.state+`</td>
                            <td>`+value.zip_code+`</td>
                            <td><button type="button" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill removeZip"><i class="la la-remove"></i></button></td>
                        </tr>
                    `;
                    $('#appendZip').append(t);
                });

            });
        }else{
            return toastr.error('Please Check The CheckBox');
        }
    });

</script>