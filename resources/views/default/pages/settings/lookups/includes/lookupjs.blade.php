<script type="text/javascript">
    $(document).off('click', '.makeActiveClass').on('click', '.makeActiveClass', function(){
        $('.c-p').removeClass('petInfoRow');
        $(this).addClass('petInfoRow');
    });

    $(function () {
        // load individual section
        $(document).off('click', '.LookupSingleView').on('click', '.LookupSingleView', function (e) {
            let request = { url: this.getAttribute('data-c-route'), beforeSend: addFormLoader };
            location.hash = request.url;
            makeActiveRow({id: this.getAttribute('data-id')});
            ajaxRequest(request, function (response) {
                $('#singleLookup').html(response.data);
                removeFormLoader();
            });
        });
        // search sections
        $('#SiteSection').select2({ width: '100%', placeholder: 'Search Section',
            ajax: { url: 'lookup/search-section', delay: 500, processResults: results => ({ results }) }
        }).on('select2:select', e => {
            let data = e.params.data;
            let request = { url: 'lookup/singleView/'+ data.id, beforeSend: addFormLoader };
            location.hash = request.url;
            makeActiveRow(data);
            ajaxRequest(request, function (response) {
                $('#singleLookup').html(response.data);
                removeFormLoader();
            });
        });
    });
    function makeActiveRow({id}) {
        $('#SiteSectionTable .LookupSingleView[data-id="'+ id +'"]').addClass('active_row').siblings('.LookupSingleView').removeClass('active_row');
    }
// <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/lookup/delete/'+row.id+'">\
//                                     <i class="la la-trash"></i></button>
</script>