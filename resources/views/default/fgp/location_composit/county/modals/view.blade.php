<style>
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #36a3f7 !important;
    }
    .nav-fill .nav-item {
        flex: none !important;
        text-align: center;
    }
</style>
<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content mp0">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title fs-modal-header">
                <span>County : {{$county->county_name}}</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
        <!-- Modal Body -->
        <!-- <div class="modal-body"> -->
        <div class="modal-body mp0">
            <form class="m-form m-form--label-align-right">
                <!--begin::Form-->
                <div class="m-portlet no-bx-shadow">
                    <div class="m-portlet__body" style="padding-top: 0; padding-bottom: 0;">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h6 style="margin-top: 20px">Associated Tables </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="m-portlet m-portlet--tabs" style="box-shadow: none; background: #eee;">
                                <div class="m-portlet__head" style="padding: 0.1rem 1rem;">
                                    <div class="m-portlet__head-tools">
                                        <ul class="m-widget27__nav-items nav nav-pills nav-fill mytab" role="tablist">

                                            <li class="m-widget27__nav-item nav-item">
                                                <a class="nav-link getTab" data-toggle="pill" href="#" data-text="Update District" data-value="districts" data-table="districts" data-id="{{$county->id}}" data-url="location/getDistrict/">District</a>
                                            </li>
                                            <li class="m-widget27__nav-item nav-item">
                                                <a class="nav-link active getTab" data-text="Update Cities" data-value="cities" data-table="cities" data-id="{{$county->id}}" data-url="location/getCity1/">Cities</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-portlet__body" style="padding:2.2rem 2.2rem">
                                    <div id="county_tab_container">
                                        @include('default.fgp.location_composit.county.table.city')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Form-->
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="float-left btn btn-secondary m-btn--pill" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" data-table="cities" class="float-right btn btn-info m-btn--pill" id="updateChildCity">
                Update Cities
            </button>
        </div>
    </div>
</div>

<script>

    $(function(){

        /*-------- submit form ----------*/
        $(document).off('click','#updateChildCity').on('click','#updateChildCity', function (e) {
            let table = $(this).attr('data-table');
            let data = $('#county_tab_container :input').serializeArray();
            console.log(table, data);
            $.ajax({
                url:'childupdate/county',
                method:'post',
                dataType:'json',
                data:data,
                success:function (response) {
                    toastr.success(response[0].data);
                }
            })
        });

        /*==== load tab content ====*/
        $(document).off('click','.getTab').on('click','.getTab',function (e) {
            $('.getTab').removeClass('active');
            $(this).addClass('active');

            $table = $(this).attr('data-value');

            $('#updateChildCity').attr('data-table',$table);
            $('#updateChildCity').text($(this).attr('data-text'));

            let state_id = $(this).attr('data-id');
            let url = $(this).attr('data-url');
            let request = {
                url:url+state_id,
                method: 'GET',
            };
            addFormLoader();
            ajaxRequest(request,function (response) {
                $('#county_tab_container').empty();
                $('#county_tab_container').html(response.data);
            })
        });

    });


</script>